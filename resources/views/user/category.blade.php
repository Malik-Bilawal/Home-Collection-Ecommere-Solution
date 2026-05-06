@extends("user.layouts.master-layouts.plain")

<title>Footwear Premium | Categories</title>

@push("style")
<style>
    :root {
        --primary-color: #111827;
        --accent-color: #10b981;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .category-card {
        transition: all 0.4s ease;
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
    }

    .category-card:hover .category-image {
        transform: scale(1.1);
    }
</style>
@endpush

@section("content")

<!-- Hero Section -->
<section class="relative min-h-[70vh] flex items-center justify-center bg-[var(--primary-color)] overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-[0.05]" 
         style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%2310b981\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 right-10 w-24 h-24 rounded-full bg-emerald-500/10 border border-emerald-500/20 animate-float"></div>
    <div class="absolute bottom-20 left-10 w-16 h-16 rounded-full bg-emerald-500/10 border border-emerald-500/20 animate-float" style="animation-delay: -2s"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col items-center text-center">
            <span class="inline-flex items-center gap-3 uppercase tracking-[0.3em] text-xs font-bold text-emerald-400 mb-6">
                <span class="w-8 h-px bg-emerald-400/50"></span>
                Premium Collection
                <span class="w-8 h-px bg-emerald-400/50"></span>
            </span>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-serif font-bold text-white mb-6 leading-tight">
                Step Into <br>
                <span class="italic font-light text-emerald-400">Elegance</span>
            </h1>

            <p class="max-w-xl text-lg text-white/70 font-light leading-relaxed mb-10 px-4">
                Discover our curated collection of premium footwear designed for comfort, style, and durability.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 items-center">
                <a href="#categories" 
                   class="px-8 py-4 bg-emerald-500 text-white font-semibold rounded-full hover:bg-emerald-600 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/30">
                    Explore Categories
                </a>
                <a href="{{ route('product') }}" 
                   class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-full hover:bg-white/10 transition-all duration-300">
                    View All Products
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <i class="fas fa-chevron-down text-white/30 text-xl"></i>
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">Browse By</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mt-3">Our Categories</h2>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">Find the perfect footwear for every occasion</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            @php
            $categories = [
                ['name' => 'Sneakers', 'slug' => 'sneakers', 'count' => 25, 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80', 'icon' => 'fa-running'],
                ['name' => 'Formal Shoes', 'slug' => 'formal-shoes', 'count' => 18, 'image' => 'https://images.unsplash.com/photo-1614252369475-531eba835eb1?w=600&q=80', 'icon' => 'fa-briefcase'],
                ['name' => 'Sandals', 'slug' => 'sandals', 'count' => 15, 'image' => 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?w=600&q=80', 'icon' => 'fa-shoe-prints'],
                ['name' => 'Loafers', 'slug' => 'loafers', 'count' => 12, 'image' => 'https://images.unsplash.com/photo-1533867617858-e7b97e060509?w=600&q=80', 'icon' => 'fa-walking'],
                ['name' => 'Boots', 'slug' => 'boots', 'count' => 20, 'image' => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?w=600&q=80', 'icon' => 'fa-boot'],
                ['name' => 'Slippers', 'slug' => 'slippers', 'count' => 10, 'image' => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600&q=80', 'icon' => 'fa-home'],
            ];
            @endphp

            @foreach($categories as $category)
            <a href="{{ route('product', ['category_id' => \App\Models\Category::where('slug', $category['slug'])->first()?->id]) }}" 
               class="category-card group relative aspect-[4/5] rounded-2xl overflow-hidden">
                <img src="{{ $category['image'] }}" 
                     alt="{{ $category['name'] }}" 
                     class="category-image absolute inset-0 w-full h-full object-cover transition-transform duration-500">
                
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent"></div>
                
                <!-- Content -->
                <div class="absolute inset-0 flex flex-col items-center justify-center p-6">
                    <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mb-4 group-hover:bg-emerald-500 group-hover:scale-110 transition-all duration-300">
                        <i class="fas {{ $category['icon'] }} text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ $category['name'] }}</h3>
                    <span class="text-white/70 text-sm">{{ $category['count'] }} Products</span>
                </div>

                <!-- Hover Effect -->
                <div class="absolute inset-0 border-2 border-transparent group-hover:border-emerald-500/50 rounded-2xl transition-all duration-300"></div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">Popular Picks</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mt-3">Trending Now</h2>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">Our most loved styles by customers</p>
        </div>

        @php
        $featuredProducts = \App\Models\Product::where('is_top_selling', 1)
            ->with('defaultImage')
            ->take(4)
            ->get();
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
            <a href="{{ route('product.detail', $product->id) }}" class="group">
                <div class="relative aspect-square rounded-xl overflow-hidden mb-4 bg-gray-100">
                    <img src="{{ $product->defaultImage ? asset('storage/app/public/' . $product->defaultImage->image_path) : 'https://placehold.co/400x400/f3f4f6/111827?text=Product' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    @if($product->cut_price && $product->cut_price < $product->price)
                    <span class="absolute top-3 left-3 bg-emerald-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ round((($product->price - $product->cut_price) / $product->price) * 100) }}% OFF
                    </span>
                    @endif
                </div>
                <h3 class="font-medium text-gray-900 mb-1 group-hover:text-emerald-600 transition-colors">{{ $product->name }}</h3>
                <div class="flex items-center gap-2">
                    <span class="font-bold text-emerald-600">Rs.{{ number_format($product->cut_price ?? $product->price) }}</span>
                    @if($product->cut_price)
                    <span class="text-sm text-gray-400 line-through">Rs.{{ number_format($product->price) }}</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('product') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white font-semibold rounded-full hover:bg-emerald-600 transition-all duration-300">
                <span>View All Products</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Why Shop With Us -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">Why Choose Us</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mt-3">The Footwear Premium Advantage</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="text-center p-6">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-shipping-fast text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Free Shipping</h3>
                <p class="text-sm text-gray-500">On orders over Rs.5000</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-undo text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Easy Returns</h3>
                <p class="text-sm text-gray-500">30-day return policy</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-shield-alt text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Secure Payment</h3>
                <p class="text-sm text-gray-500">100% secure checkout</p>
            </div>

            <div class="text-center p-6">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-headset text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">24/7 Support</h3>
                <p class="text-sm text-gray-500">Dedicated assistance</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-white mb-4">Stay Updated</h2>
            <p class="text-white/70 mb-8">Subscribe to get the latest updates on new arrivals and exclusive offers.</p>
            <form class="flex flex-col sm:flex-row gap-4">
                <input type="email" 
                       placeholder="Enter your email" 
                       class="flex-1 px-6 py-4 rounded-full bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:border-emerald-500">
                <button type="submit" 
                        class="px-8 py-4 bg-emerald-500 text-white font-semibold rounded-full hover:bg-emerald-600 transition-all duration-300">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</section>

@endsection