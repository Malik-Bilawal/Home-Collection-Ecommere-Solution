<?php

namespace App\Http\Controllers\User;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function index() {
        $mostSoldIds = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->pluck('product_id');
    

        $popularProducts = Product::with(['defaultImage', 'images', 'colors.images', 'sizes'])
            ->whereIn('id', $mostSoldIds)
            ->when($mostSoldIds->isNotEmpty(), function($query) use ($mostSoldIds) {
                return $query->orderByRaw("FIELD(id, " . implode(',', $mostSoldIds->toArray()) . ")");
            })
            ->get();
    
        $products = Product::with('defaultImage', 'images', 'colors.images', 'sizes')->take(8)->get();
        $sale = Sale::where('is_active', 1)->get();
        
        $topSellingProduct = Product::with('images') -> where('is_top_selling', 1)->get();
    
        $categories = Category::where('status', 1)->take(3)->get();
        $banners = HeroSlider::where('status', 1)->get();               
    
        return view('user.home', compact(
            'categories', 
            'banners', 
            'products', 
            'sale', 
            'topSellingProduct', 
            'popularProducts' 
        ));
    }
    
}
