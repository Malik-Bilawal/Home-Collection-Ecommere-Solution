<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductColorImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {

        $categories = Category::where('status', 1)->get();
        $products = Product::with('category', 'sizes', 'colors.images')->paginate('8');
        return view('admin.product.index', compact('categories', 'products'));
    }
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $product = Product::create([
                'name' => $request->product_name,
                'description' => $request->description,
                'sku' => $request->sku,
                'price' => $request->price,
                'cut_price'         => $request->cut_price,
                'rating' => $request->rating,
                'category_id' => $request->category_id,
                'is_active' => $request->status === 'active' ? 1 : 0,
                'is_top_selling' => $request->boolean('is_top_selling'),
            ]);

            if ($request->hasFile('default_image') && $request->file('default_image')->isValid()) {
                $path = $request->file('default_image')->store("products/{$product->id}", 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_default' => 1,
                ]);
            }

            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $imageFile) {
                    if ($imageFile && $imageFile->isValid()) {
                        $path = $imageFile->store("products/{$product->id}", 'public');

                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_path' => $path,
                            'is_default' => 0,
                        ]);
                    }
                }
            }

            if ($request->has('sizes')) {
                foreach ($request->sizes as $sizeData) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'name' => $sizeData['name'],
                        'price' => $sizeData['price'],
                        'stock' => $sizeData['stock'] ?? 0,
                    ]);
                }
            }

            if ($request->has('new_sizes')) {
                foreach ($request->new_sizes as $sizeData) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'name' => $sizeData['name'],
                        'price' => $sizeData['price'],
                        'stock' => $sizeData['stock'] ?? 0,
                    ]);
                }
            }

            if ($request->has('colors')) {
                foreach ($request->colors as $colorData) {
                    $color = ProductColor::create([
                        'product_id' => $product->id,
                        'name' => $colorData['name'],
                        'hex_code' => $colorData['hex'] ?? null,
                    ]);

                    if (!empty($colorData['images'])) {
                        foreach ($colorData['images'] as $imageFile) {
                            if ($imageFile && $imageFile->isValid()) {
                                $path = $imageFile->store("products/colors/{$color->id}", 'public');

                                ProductColorImage::create([
                                    'color_id' => $color->id,
                                    'image_path' => $path,
                                ]);
                            }
                        }
                    }
                }
            }
        });

        return redirect()->route('admin.products')
            ->with('success', 'Product created successfully!');
    }



    public function edit($id)
    {
        $product = Product::with([
            'sizes',
            'colors.images',
            'images',
            'defaultImage',
        ])->findOrFail($id);

        $categories = Category::all();

        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::with(['images', 'sizes', 'colors.images'])->findOrFail($id);

        $normalizeToArray = function ($value) {
            if (is_array($value)) {
                return array_values(array_filter($value, fn($v) => $v !== '' && $v !== null));
            }

            if (is_null($value) || $value === '') {
                return [];
            }

            if (is_string($value)) {
                $trimmed = trim($value);

                if (Str::startsWith($trimmed, '[') && Str::endsWith($trimmed, ']')) {
                    $decoded = json_decode($trimmed, true);
                    if (is_array($decoded)) {
                        return array_values(array_filter($decoded, fn($v) => $v !== '' && $v !== null));
                    }
                }

                if (strpos($trimmed, ',') !== false) {
                    $parts = array_map('trim', explode(',', $trimmed));
                    return array_values(array_filter($parts, fn($v) => $v !== '' && $v !== null));
                }

                return [$trimmed];
            }

            return [];
        };

        $deletedImages = $normalizeToArray($request->input('deleted_images'));
        $deletedSizes  = $normalizeToArray($request->input('deleted_sizes'));
        $deletedColors = $normalizeToArray($request->input('deleted_colors'));

        try {
            DB::transaction(function () use ($request, $product, $deletedImages, $deletedSizes, $deletedColors) {

                $product->update([
                    'name'        => $request->product_name,
                    'description' => $request->description,
                    'sku'         => $request->sku,
                    'cut_price'         => $request->cut_price,

                    'price'       => $request->price,
                    'rating'      => $request->rating,
                    'category_id' => $request->category_id,
                    'is_active'   => $request->status === 'active' ? 1 : 0,
                    'is_top_selling' => $request->boolean('is_top_selling'),
                ]);

                if ($request->hasFile('default_image')) {
                    $oldDefault = $product->images()->where('is_default', 1)->first();
                    if ($oldDefault) {
                        Storage::disk('public')->delete(str_replace('/storage/', '', $oldDefault->image_path));
                        $oldDefault->delete();
                    }

                    $path = $request->file('default_image')->store("products/{$product->id}", 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => Storage::url($path),
                        'is_default' => 1,
                    ]);
                }

                if ($request->hasFile('gallery_images')) {
                    $galleryFiles = $request->file('gallery_images');
                    foreach ($galleryFiles as $imageFile) {
                        if ($imageFile && $imageFile->isValid()) {
                            $path = $imageFile->store("products/{$product->id}", 'public');
                            ProductImage::create([
                                'product_id' => $product->id,
                                'image_path' => Storage::url($path),
                                'is_default' => 0,
                            ]);
                        }
                    }
                }

                if (!empty($deletedImages)) {
                    $ids = array_values(array_map(fn($v) => is_numeric($v) ? (int) $v : $v, $deletedImages));
                    $imagesToDelete = ProductImage::whereIn('id', $ids)->get();

                    foreach ($imagesToDelete as $img) {
                        Storage::disk('public')->delete(str_replace('/storage/', '', $img->image_path));
                        $img->delete();
                    }
                }

                if ($request->has('sizes')) {
                    foreach ($request->sizes as $id => $sizeData) {
                        if (is_numeric($id)) {
                            ProductSize::where('id', $id)->update([
                                'name' => $sizeData['name'],
                                'price' => $sizeData['price'],
                                'stock' => $sizeData['stock'] ?? 0,
                            ]);
                        }
                    }
                }

                if ($request->has('new_sizes')) {
                    foreach ($request->new_sizes as $sizeData) {
                        ProductSize::create([
                            'product_id' => $product->id,
                            'name' => $sizeData['name'],
                            'price' => $sizeData['price'],
                            'stock' => $sizeData['stock'] ?? 0,
                        ]);
                    }
                }

                if (!empty($deletedSizes)) {
                    $sizeIds = array_values(array_map(fn($v) => is_numeric($v) ? (int) $v : $v, $deletedSizes));
                    ProductSize::whereIn('id', $sizeIds)->delete();
                }

                if ($request->has('colors') || $request->has('new_colors')) {

                    if ($request->has('colors')) {
                        foreach ($request->colors as $id => $colorData) {
                            if (!is_numeric($id)) continue;

                            $color = ProductColor::find($id);
                            if ($color) {
                                $color->update([
                                    'name' => $colorData['name'] ?? $color->name,
                                    'hex_code' => $colorData['hex'] ?? $color->hex_code,
                                ]);
                            }

                            if ($request->hasFile("colors.$id.images")) {
                                $files = $request->file("colors.$id.images");
                                foreach ($files as $file) {
                                    if ($file->isValid()) {
                                        $path = $file->store("products/colors/{$color->id}", 'public');
                                        ProductColorImage::create([
                                            'color_id' => $color->id,
                                            'image_path' => Storage::url($path),
                                        ]);
                                    }
                                }
                            }
                        }
                    }

                    if ($request->has('new_colors')) {
                        foreach ($request->new_colors as $index => $colorData) {

                            $color = ProductColor::create([
                                'product_id' => $product->id,
                                'name' => $colorData['name'] ?? 'Unnamed',
                                'hex_code' => $colorData['hex'] ?? null,
                            ]);

                            if ($request->hasFile("new_colors.$index.images")) {
                                $files = $request->file("new_colors.$index.images");
                                foreach ($files as $file) {
                                    if ($file->isValid()) {
                                        $path = $file->store("products/colors/{$color->id}", 'public');
                                        ProductColorImage::create([
                                            'color_id' => $color->id,
                                            'image_path' => Storage::url($path),
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }

                if (!empty($deletedColors)) {
                    $colorIds = array_values(array_map(fn($v) => is_numeric($v) ? (int) $v : $v, $deletedColors));
                    $colorsToDelete = ProductColor::whereIn('id', $colorIds)->get();

                    foreach ($colorsToDelete as $color) {
                        foreach ($color->images as $img) {
                            Storage::disk('public')->delete(str_replace('/storage/', '', $img->image_path));
                            $img->delete();
                        }
                        $color->delete();
                    }
                }
            });

            return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Something went wrong while updating the product. Check logs for details.');
        }
    }
    public function destroy($id)
    {
        $product = Product::with('sizes', 'colors.images', 'images', 'colors.images')->findOrFail($id);

        DB::transaction(function () use ($product) {

            foreach ($product->images as $img) {
                $oldPath = str_replace('/storage/', '', $img->image_path);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
                $img->delete();
            }

            foreach ($product->colors as $color) {
                foreach ($color->images as $img) {
                    $oldPath = str_replace('/storage/', '', $img->image_path);
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                    }
                    $img->delete();
                }
                $color->delete();
            }

            foreach ($product->sizes as $size) {
                $size->delete();
            }

            $product->delete();
        });

        return redirect()->route('admin.products')
            ->with('success', 'Product deleted successfully!');
    }
}
