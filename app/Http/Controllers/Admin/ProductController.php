<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $products = Product::with('category', 'allColors', 'allSizes', 'allVariants')
            ->latest()
            ->paginate(10);
        return view('admin.product.index', compact('categories', 'products'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::create([
                'name' => $request->product_name,
                'description' => $request->description,
                'sku' => $request->sku,
                'price' => $request->price,
                'cut_price' => $request->cut_price,
                'rating' => $request->rating ?? 0,
                'category_id' => $request->category_id,
                'is_active' => $request->status === 'active',
                'is_top_selling' => $request->boolean('is_top_selling'),
            ]);

            // Handle default image
            if ($request->hasFile('default_image') && $request->file('default_image')->isValid()) {
                $path = $request->file('default_image')->store("products/{$product->id}", 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_default' => true,
                ]);
            }

            // Handle gallery images
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $imageFile) {
                    if ($imageFile->isValid()) {
                        $path = $imageFile->store("products/{$product->id}", 'public');
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_path' => $path,
                            'is_default' => false,
                        ]);
                    }
                }
            }

            // Create colors
            $colorIds = [];
            if ($request->has('colors')) {
                foreach ($request->colors as $colorData) {
                    if (!empty($colorData['name'])) {
                        $color = ProductColor::create([
                            'product_id' => $product->id,
                            'name' => $colorData['name'],
                            'hex_code' => $colorData['hex'] ?? null,
                            'is_active' => true,
                        ]);
                        $colorIds[] = $color->id;
                    }
                }
            }

            // Create sizes
            $sizeIds = [];
            if ($request->has('sizes')) {
                foreach ($request->sizes as $sizeData) {
                    if (!empty($sizeData['name'])) {
                        $size = ProductSize::create([
                            'product_id' => $product->id,
                            'name' => $sizeData['name'],
                            'display_name' => $sizeData['display_name'] ?? $sizeData['name'],
                            'is_active' => true,
                        ]);
                        $sizeIds[] = $size->id;
                    }
                }
            }

            // Create variants (color + size combinations)
            if (!empty($colorIds) && !empty($sizeIds)) {
                foreach ($colorIds as $colorId) {
                    foreach ($sizeIds as $sizeId) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'color_id' => $colorId,
                            'size_id' => $sizeId,
                            'price' => null,
                            'stock' => 0,
                            'is_active' => true,
                        ]);
                    }
                }
            }

            // Set stock from variants if no base stock
            if (!empty($colorIds) && !empty($sizeIds)) {
                $product->update(['stock' => 0]);
            }
        });

        return redirect()->route('admin.products')
            ->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = Product::with([
            'allColors',
            'allSizes',
            'allVariants',
            'defaultImage',
            'images',
        ])->findOrFail($id);

        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::with(['images', 'allColors', 'allSizes', 'allVariants'])->findOrFail($id);

        try {
            DB::transaction(function () use ($request, $product) {
                // Update product basic info
                $product->update([
                    'name' => $request->product_name,
                    'description' => $request->description,
                    'sku' => $request->sku,
                    'price' => $request->price,
                    'cut_price' => $request->cut_price,
                    'rating' => $request->rating ?? 0,
                    'category_id' => $request->category_id,
                    'is_active' => $request->status === 'active',
                    'is_top_selling' => $request->boolean('is_top_selling'),
                ]);

                // Update default image
                if ($request->hasFile('default_image') && $request->file('default_image')->isValid()) {
                    $oldDefault = $product->images()->where('is_default', true)->first();
                    if ($oldDefault) {
                        Storage::disk('public')->delete($oldDefault->image_path);
                        $oldDefault->delete();
                    }
                    $path = $request->file('default_image')->store("products/{$product->id}", 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path,
                        'is_default' => true,
                    ]);
                }

                // Update gallery images
                if ($request->hasFile('gallery_images')) {
                    foreach ($request->file('gallery_images') as $imageFile) {
                        if ($imageFile->isValid()) {
                            $path = $imageFile->store("products/{$product->id}", 'public');
                            ProductImage::create([
                                'product_id' => $product->id,
                                'image_path' => $path,
                                'is_default' => false,
                            ]);
                        }
                    }
                }

                // Update colors
                $colorIds = [];
                if ($request->has('colors')) {
                    foreach ($request->colors as $colorId => $colorData) {
                        if (is_numeric($colorId)) {
                            $color = ProductColor::find($colorId);
                            if ($color) {
                                $color->update([
                                    'name' => $colorData['name'],
                                    'hex_code' => $colorData['hex'] ?? null,
                                ]);
                            }
                            $colorIds[] = $colorId;
                        } else {
                            $color = ProductColor::create([
                                'product_id' => $product->id,
                                'name' => $colorData['name'],
                                'hex_code' => $colorData['hex'] ?? null,
                                'is_active' => true,
                            ]);
                            $colorIds[] = $color->id;
                        }
                    }
                }

                // Delete removed colors
                $existingColorIds = $product->allColors()->pluck('id')->toArray();
                $deletedColorIds = array_diff($existingColorIds, $colorIds);
                if (!empty($deletedColorIds)) {
                    ProductColor::destroy($deletedColorIds);
                }

                // Update sizes
                $sizeIds = [];
                if ($request->has('sizes')) {
                    foreach ($request->sizes as $sizeId => $sizeData) {
                        if (is_numeric($sizeId)) {
                            $size = ProductSize::find($sizeId);
                            if ($size) {
                                $size->update([
                                    'name' => $sizeData['name'],
                                    'display_name' => $sizeData['display_name'] ?? $sizeData['name'],
                                ]);
                            }
                            $sizeIds[] = $sizeId;
                        } else {
                            $size = ProductSize::create([
                                'product_id' => $product->id,
                                'name' => $sizeData['name'],
                                'display_name' => $sizeData['display_name'] ?? $sizeData['name'],
                                'is_active' => true,
                            ]);
                            $sizeIds[] = $size->id;
                        }
                    }
                }

                // Delete removed sizes
                $existingSizeIds = $product->allSizes()->pluck('id')->toArray();
                $deletedSizeIds = array_diff($existingSizeIds, $sizeIds);
                if (!empty($deletedSizeIds)) {
                    ProductSize::destroy($deletedSizeIds);
                }

                // Sync variants
                $colorIdForVariant = !empty($colorIds) ? $colorIds[0] : null;
                $sizeIdForVariant = !empty($sizeIds) ? $sizeIds[0] : null;

                if ($colorIdForVariant && $sizeIdForVariant) {
                    ProductVariant::updateOrCreate(
                        ['product_id' => $product->id, 'color_id' => $colorIdForVariant, 'size_id' => $sizeIdForVariant],
                        [
                            'price' => $request->variant_price,
                            'stock' => $request->variant_stock ?? 0,
                            'is_active' => true,
                        ]
                    );
                }
            });

            return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $product = Product::with(['images', 'allColors', 'allSizes', 'allVariants'])->findOrFail($id);

        DB::transaction(function () use ($product) {
            // Delete images
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image_path);
            }
            $product->images()->delete();

            // Delete variants (cascade will handle colors/sizes)
            $product->allVariants()->delete();

            // Delete colors and sizes
            $product->allColors()->delete();
            $product->allSizes()->delete();

            $product->delete();
        });

        return redirect()->route('admin.products')
            ->with('success', 'Product deleted successfully!');
    }
}