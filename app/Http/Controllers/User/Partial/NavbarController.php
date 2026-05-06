<?php

namespace App\Http\Controllers\User\Partial;

use App\Models\Product;
use App\Models\Category;
use App\Models\RecentSearch;
use Illuminate\Http\Request;
use App\Models\FeaturedProduct;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NavbarController extends Controller
{
    
public function search(Request $request)
{
    $query = $request->get('q');
    Log::info("Search query received: '{$query}'");

    if (strlen($query) < 2) {
        Log::info("Search query too short, returning empty result.");
        return response()->json([]);
    }

    $popularSearches = Cache::remember('popular_searches', 3600, function () {
        $products = Product::query()
            ->with('images')
            ->orderByDesc(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('order_items')
                    ->whereColumn('product_id', 'products.id');
            })
            ->limit(8)
            ->get();

        Log::info("Popular searches cached: " . $products->pluck('name')->join(', '));

        return $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'type' => 'popular'
            ];
        });
    });

    // Search products with multiple criteria
    $products = Product::query()
        ->with(['images', 'category'])
        ->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('description', 'LIKE', "%{$query}%");
        })
        ->orderBy('created_at', 'desc')
        ->limit(10)
        ->get()
        ->map(function ($product) {
            $image = $product->images->where('is_default', 1)->first() ?? $product->images->first();
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'offer_price' => $product->offer_price,
                'category' => $product->category->name ?? 'Uncategorized',
                'rating' => $product->average_rating ?? 4.5,
                'review_count' => $product->reviews_count ?? 0,
                'image' => $image ? asset('storage/' . $image->image_path) : asset('images/default-product.jpg'),
                'in_stock' => $product->stock_quantity > 0,
                'is_featured' => $product->is_featured,
                'discount_percent' => $product->offer_price 
                    ? round((($product->price - $product->offer_price) / $product->price) * 100)
                    : null,
            ];
        });

    Log::info("Found " . $products->count() . " products for query '{$query}'");


    try {
        // Save search for logged-in users
        if (Auth::check() && $products->isNotEmpty()) {
            RecentSearch::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'query' => $query
                ],
                [
                    'results_count' => $products->count(),
                    'searched_at' => now()
                ]
            );
            Log::info("✅ Saved search for user_id: " . Auth::id(), [
                'query' => $query,
                'results_count' => $products->count()
            ]);
        }
    } catch (\Exception $e) {
        Log::error("❌ Failed to save recent search for user_id: " . Auth::id(), [
            'query' => $query,
            'error_message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);
    }
    

    // Get trending categories
    $trendingCategories = Cache::remember('trending_categories', 3600, function () {
        $categories = Category::query()
            ->withCount('products')
            ->having('products_count', '>', 0)
            ->orderByDesc('products_count')
            ->limit(6)
            ->get();

        Log::info("Trending categories cached: " . $categories->pluck('name')->join(', '));

        return $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'icon' => $category->icon ?? 'fas fa-tag',
                'product_count' => $category->products_count,
            ];
        });
    });

    return response()->json([
        'products' => $products,
        'suggestions' => $this->getSearchSuggestions($query),
        'trending_categories' => $trendingCategories,
        'popular_searches' => $popularSearches,
    ]);
}
    private function getSearchSuggestions($query)
    {
        if (strlen($query) < 2) return [];

        $suggestions = collect([
            'sneakers' => ['Running Shoes', 'Sports Sneakers', 'Canvas Sneakers', 'Leather Sneakers'],
            'formal' => ['Oxford Shoes', 'Derby Shoes', 'Loafers', 'Brogues'],
            'sandals' => ['Slides', 'Flip Flops', 'Strappy Sandals', 'Fisherman Sandals'],
            'boots' => ['Chelsea Boots', 'Work Boots', 'Hiking Boots', 'Snow Boots'],
            'slippers' => ['House Slippers', 'Moccasins', 'Boat Shoes', 'Slide Sandals'],
        ]);

        $matched = collect();
        foreach ($suggestions as $category => $items) {
            foreach ($items as $item) {
                if (stripos($item, $query) !== false) {
                    $matched->push([
                        'text' => $item,
                        'category' => ucfirst($category),
                        'type' => 'suggestion'
                    ]);
                }
            }
        }

        return $matched->take(5)->toArray();
    }

    public function storeRecentSearch(Request $request)
    {
        $validated = $request->validate([
            'query' => 'required|string|max:100'
        ]);

        if (Auth::check()) {
            RecentSearch::create([
                'user_id' => Auth::id(),
                'query' => $validated['query'],
                'searched_at' => now()
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function deleteRecentSearch($id)
    {
        if (Auth::check()) {
            RecentSearch::where('user_id', Auth::id())
                ->where('id', $id)
                ->delete();
        }

        return response()->json(['success' => true]);
    }

    public function getTrendingProducts()
    {
        $trending = Cache::remember('trending_products_navbar', 1800, function () {
            return Product::query()
                ->with(['images', 'category'])
                ->where('is_top_selling', true)
                ->where('is_active', 1)
                ->limit(4)
                ->get()
                ->map(function ($product) {
                    $image = $product->images->where('is_default', 1)->first() ?? $product->images->first();
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'offer_price' => $product->offer_price,
                        'image' => $image ? asset('storage/' . $image->image_path) : asset('images/default-product.jpg'),
                        'category' => $product->category->name ?? 'Uncategorized',
                    ];
                });
        });

        return response()->json($trending);
    }
}