<?php

namespace App\Http\Controllers\User;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\HeroSlider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index() {
        $categories = Category::where('status', 1)
            ->whereIn('slug', ['sneakers', 'formal-shoes', 'sandals', 'loafers', 'boots', 'slippers'])
            ->get();
        
        $topSellingProduct = Product::where('is_top_selling', 1)
            ->with('defaultImage')
            ->take(8)
            ->get();
        
        $products = Product::with('defaultImage', 'images')
            ->latest()
            ->take(12)
            ->get();
        
        $banners = HeroSlider::where('status', 1)->get();
        $sale = Sale::where('is_active', 1)->get();
    
        return view('user.home', compact(
            'categories', 
            'banners', 
            'products', 
            'sale', 
            'topSellingProduct', 
            'popularProducts' => collect()
        ));
    }
    
}
    

