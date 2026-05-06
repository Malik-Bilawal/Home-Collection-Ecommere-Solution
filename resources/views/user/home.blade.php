@extends("user.layouts.master-layouts.plain")

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<title>Footwear Premium | Premium Shoes & Sandals</title>

@push("style")
<style>
    * {
        font-family: 'Inter', sans-serif;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Playfair Display', serif;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--background-color);
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 4px;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    .glass-effect {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .premium-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: var(--surface-color);
    }

    .premium-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(17, 24, 39, 0.15);
    }

    .btn-premium {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }

    .category-card {
        position: relative;
        overflow: hidden;
    }

    .category-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(17, 24, 39, 0.9), rgba(17, 24, 39, 0.7));
        transition: opacity 0.3s;
    }

    .category-card:hover::before {
        opacity: 0.8;
    }

    .category-card img {
        transition: transform 0.5s ease;
    }

    .category-card:hover img {
        transform: scale(1.1);
    }

    .product-card {
        transition: all 0.4s ease;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(17, 24, 39, 0.12);
    }

    .badge-offer {
        background: var(--accent-color);
    }

    @media (max-width: 768px) {
        .text-8xl { font-size: 3rem !important; }
        .text-7xl { font-size: 2.5rem !important; }
        .text-6xl { font-size: 2rem !important; }
    }
</style>
@endpush

@section("content")

@if($banners->count() > 0)
<section class="relative w-screen left-[50%] -translate-x-[50%] overflow-hidden bg-[var(--primary-color)] text-[var(--text-on-primary)] h-[40vh] md:h-[70vh] lg:h-[85vh]"
    x-data="{ 
        activeSlide: 0, 
        slides: {{ $banners->count() }},
        timer: null,
        startTimer() {
            this.timer = setInterval(() => {
                this.activeSlide = (this.activeSlide === this.slides - 1) ? 0 : this.activeSlide + 1;
            }, 5000);
        }
    }"
    x-init="startTimer()"
    @mouseenter="clearInterval(timer)"
    @mouseleave="startTimer()">

    @foreach($banners as $index => $banner)
    <div x-show="activeSlide === {{ $index }}"
        x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0 scale-105"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-700"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 w-full h-full">

        @if($banner->type === 'video' && $banner->video)
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset($banner->video) }}" type="video/mp4">
        </video>
        @else
        <img src="{{ asset('storage/app/public/' . $banner->image) }}"
            alt="{{ $banner->title }}"
            class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
        @endif

        <div class="absolute inset-0 flex items-center">
            <div class="w-full px-6 md:px-16 lg:px-24">
                <div class="max-w-4xl">
                    @if($banner->badge)
                    <span class="inline-block text-xs font-bold uppercase tracking-[0.3em] text-[var(--accent-color)] mb-4">
                        {{ $banner->badge }}
                    </span>
                    @endif

                    <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-serif font-medium leading-[1.1] text-white mb-6">
                        {{ $banner->title }}
                    </h1>

                    @if($banner->description)
                    <p class="text-lg md:text-xl text-white/80 leading-relaxed max-w-2xl mb-8">
                        {{ $banner->description }}
                    </p>
                    @endif

                    @if($banner->link)
                    <a href="{{ $banner->link }}" class="btn-premium inline-block">
                        Shop Now
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="absolute bottom-0 left-0 w-full z-30 bg-black/50 backdrop-blur-sm border-t border-white/10">
        <div class="flex items-center justify-between px-6 md:px-16 h-16 md:h-20">
            <div class="flex items-center gap-4">
                <span class="text-xs font-mono text-white/50">01</span>
                <div class="flex gap-2">
                    @foreach($banners as $index => $banner)
                    <button @click="activeSlide = {{ $index }}" class="w-8 md:w-12 h-1 bg-white/20 hover:bg-[var(--accent-color)] transition-colors rounded-full"
                        :class="{ '!bg-[var(--accent-color)]': activeSlide === {{ $index }} }"></button>
                    @endforeach
                </div>
                <span class="text-xs font-mono text-white/50">0{{ $banners->count() }}</span>
            </div>

            <div class="hidden lg:flex items-center gap-6 text-white/60">
                <span class="text-xs uppercase tracking-[0.2em]">Premium Quality</span>
                <span class="text-[var(--accent-color)]">•</span>
                <span class="text-xs uppercase tracking-[0.2em]">Free Shipping</span>
                <span class="text-[var(--accent-color)]">•</span>
                <span class="text-xs uppercase tracking-[0.2em]">30-Day Returns</span>
            </div>
        </div>
    </div>
</section>
@endif

@if($categories->count() > 0)
<section class="py-16 md:py-24 bg-[var(--background-color)]">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-12 md:mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.4em] text-[var(--accent-color)] mb-3 block">Browse Collection</span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-serif text-[var(--primary-color)]">SHOP BY <span class="text-[var(--accent-color)]">CATEGORY</span></h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 md:gap-6">
            @foreach($categories as $category)
            <a href="{{ route('product', ['category_id' => $category->id]) }}" 
               class="category-card group relative aspect-square rounded-xl overflow-hidden">
                @if($category->image)
                <img src="{{ asset('storage/app/public/' . $category->image) }}" 
                     alt="{{ $category->name }}"
                     class="absolute inset-0 w-full h-full object-cover">
                @else
                <div class="absolute inset-0 bg-gradient-to-br from-[var(--primary-color)] to-[var(--primary-hover)]"></div>
                @endif
                
                <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                    @switch($category->slug)
                        @case('sneakers')
                            <i class="fas fa-running text-2xl md:text-3xl text-white mb-2 md:mb-3"></i>
                            @break
                        @case('formal-shoes')
                            <i class="fas fa-briefcase text-2xl md:text-3xl text-white mb-2 md:mb-3"></i>
                            @break
                        @case('sandals')
                            <i class="fas fa-shoe-prints text-2xl md:text-3xl text-white mb-2 md:mb-3"></i>
                            @break
                        @case('loafers')
                            <i class="fas fa-walking text-2xl md:text-3xl text-white mb-2 md:mb-3"></i>
                            @break
                        @case('boots')
                            <i class="fas fa-boot text-2xl md:text-3xl text-white mb-2 md:mb-3"></i>
                            @break
                        @case('slippers')
                            <i class="fas fa-home text-2xl md:text-3xl text-white mb-2 md:mb-3"></i>
                            @break
                        @default
                            <i class="fas fa-shoe text-2xl md:text-3xl text-white mb-2 md:mb-3"></i>
                    @endswitch
                    <h3 class="text-sm md:text-base font-medium text-white text-center">{{ $category->name }}</h3>
                    <span class="text-xs text-white/70 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">Explore</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($topSellingProduct->count() > 0)
<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-12 md:mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.4em] text-[var(--accent-color)] mb-3 block">Most Popular</span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-serif text-[var(--primary-color)]">TOP <span class="italic">SELLING</span></h2>
            <p class="text-[var(--primary-color)]/60 mt-4 max-w-xl mx-auto">Discover our most loved products, chosen by thousands of satisfied customers.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
            @foreach($topSellingProduct as $product)
            <div class="product-card group bg-white rounded-xl overflow-hidden border border-[var(--border-color)] hover:border-[var(--accent-color)]/30">
                <a href="{{ route('product.detail', $product->id) }}" class="block">
                    <div class="relative aspect-square overflow-hidden bg-gray-100">
                        @if($product->cut_price && $product->cut_price < $product->price)
                        <div class="absolute top-3 left-3 badge-offer text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest z-10 rounded">
                            {{ round((($product->price - $product->cut_price) / $product->price) * 100) }}% OFF
                        </div>
                        @endif

                        <img src="{{ $product->defaultImage ? asset('storage/app/public/' . $product->defaultImage->image_path) : 'https://placehold.co/600x600/f3f4f6/111827?text=Product' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                        <div class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-[var(--accent-color)]">
                            <div class="py-3 text-center text-white text-xs uppercase tracking-wider font-medium">
                                View Details
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="text-[var(--accent-color)] text-[10px] font-bold uppercase tracking-widest mb-2">
                            {{ $product->category->name ?? 'Footwear' }}
                        </div>

                        <h3 class="text-[var(--primary-color)] font-medium mb-2 truncate group-hover:text-[var(--accent-color)] transition-colors">
                            {{ $product->name }}
                        </h3>

                        @if($product->rating)
                        <div class="flex items-center gap-1 mb-3">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-3 h-3 {{ $i <= $product->rating ? 'text-[var(--accent-color)]' : 'text-gray-300' }}" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                            @endfor
                        </div>
                        @endif

                        <div class="flex items-baseline gap-2">
                            @if($product->cut_price)
                            <span class="text-gray-400 line-through text-sm">Rs.{{ number_format($product->price) }}</span>
                            <span class="text-[var(--accent-color)] text-lg font-bold">Rs.{{ number_format($product->cut_price) }}</span>
                            @else
                            <span class="text-[var(--primary-color)] text-lg font-bold">Rs.{{ number_format($product->price) }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('product') }}" class="inline-flex items-center gap-3 text-[var(--primary-color)] hover:text-[var(--accent-color)] transition-colors">
                <span class="text-sm font-medium uppercase tracking-wider">View All Products</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif

@if($popularProducts->count() > 0)
<section class="py-16 md:py-24 bg-[var(--primary-color)] text-white">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-12 md:mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.4em] text-[var(--accent-color)] mb-3 block">Handpicked For You</span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-serif">BEST <span class="italic text-[var(--accent-color)]">SELLERS</span></h2>
            <p class="text-white/60 mt-4 max-w-xl mx-auto">Premium quality footwear crafted for comfort and style.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8">
            @foreach($popularProducts as $product)
            <div class="product-card group bg-white/5 backdrop-blur-sm rounded-xl overflow-hidden border border-white/10 hover:border-[var(--accent-color)]/50 transition-all">
                <a href="{{ route('product.detail', $product->id) }}" class="block">
                    <div class="relative aspect-[4/5] overflow-hidden">
                        @if($product->offer_price && $product->offer_price < $product->price)
                        <div class="absolute top-4 left-4 bg-[var(--accent-color)] text-white text-[9px] font-bold px-3 py-1 uppercase tracking-widest z-10 rounded">
                            SALE
                        </div>
                        @endif

                        <img src="{{ $product->defaultImage ? asset('storage/app/public/' . $product->defaultImage->image_path) : 'https://placehold.co/600x800/1f2937/10b981?text=Product' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 grayscale-[0.2] group-hover:grayscale-0">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="bg-white/90 backdrop-blur text-center py-3 rounded-lg text-[var(--primary-color)] text-xs uppercase tracking-wider font-medium hover:bg-[var(--accent-color)] hover:text-white transition-colors">
                                    View Details
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 text-center">
                        <div class="text-[var(--accent-color)] text-[9px] font-bold uppercase tracking-[0.3em] mb-2">
                            {{ $product->category->name ?? 'Premium' }}
                        </div>

                        <h3 class="text-white font-serif text-lg mb-2 truncate group-hover:text-[var(--accent-color)] transition-colors">
                            {{ $product->name }}
                        </h3>

                        <div class="flex items-center justify-center gap-2">
                            @if($product->offer_price)
                            <span class="text-white/40 line-through text-sm">Rs.{{ number_format($product->price, 0) }}</span>
                            <span class="text-[var(--accent-color)] text-xl font-bold">Rs.{{ number_format($product->offer_price, 0) }}</span>
                            @else
                            <span class="text-white text-xl font-bold">Rs.{{ number_format($product->price, 0) }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($products->count() > 0)
<section class="py-16 md:py-24 bg-[var(--background-color)]">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-12 md:mb-16">
            <span class="text-xs font-bold uppercase tracking-[0.4em] text-[var(--accent-color)] mb-3 block">New Arrivals</span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-serif text-[var(--primary-color)]">FEATURED <span class="italic">PRODUCTS</span></h2>
            <p class="text-[var(--primary-color)]/60 mt-4 max-w-xl mx-auto">Explore our latest collection of premium footwear.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
            @foreach($products as $product)
            <div class="product-card group bg-white rounded-xl overflow-hidden border border-[var(--border-color)] hover:border-[var(--accent-color)]/30">
                <a href="{{ route('product.detail', $product->id) }}" class="block">
                    <div class="relative aspect-square overflow-hidden bg-gray-100">
                        @if($product->cut_price && $product->cut_price < $product->price)
                        <div class="absolute top-3 left-3 badge-offer text-white text-[10px] font-bold px-3 py-1 uppercase tracking-widest z-10 rounded">
                            {{ round((($product->price - $product->cut_price) / $product->price) * 100) }}% OFF
                        </div>
                        @endif

                        <img src="{{ $product->defaultImage ? asset('storage/app/public/' . $product->defaultImage->image_path) : 'https://placehold.co/600x600/f3f4f6/111827?text=Product' }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                        <div class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-[var(--accent-color)]">
                            <div class="py-3 text-center text-white text-xs uppercase tracking-wider font-medium">
                                View Details
                            </div>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="text-[var(--accent-color)] text-[10px] font-bold uppercase tracking-widest mb-2">
                            {{ $product->category->name ?? 'Footwear' }}
                        </div>

                        <h3 class="text-[var(--primary-color)] font-medium mb-2 truncate group-hover:text-[var(--accent-color)] transition-colors">
                            {{ $product->name }}
                        </h3>

                        <div class="flex items-baseline gap-2">
                            @if($product->cut_price)
                            <span class="text-gray-400 line-through text-sm">Rs.{{ number_format($product->price) }}</span>
                            <span class="text-[var(--accent-color)] text-lg font-bold">Rs.{{ number_format($product->cut_price) }}</span>
                            @else
                            <span class="text-[var(--primary-color)] text-lg font-bold">Rs.{{ number_format($product->price) }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('product') }}" class="btn-premium">
                Explore All Products
            </a>
        </div>
    </div>
</section>
@endif

@if($sale->first())
@php $activeSale = $sale->first(); @endphp
<section class="relative py-16 md:py-24 bg-[var(--primary-color)] overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0" style="background: radial-gradient(circle at 70% 50%, rgba(16, 185, 129, 0.15) 0%, transparent 70%);"></div>
    </div>

    <div class="container mx-auto px-4 md:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-center">
            <div class="text-center lg:text-left">
                <span class="inline-block text-xs font-bold uppercase tracking-[0.5em] text-[var(--accent-color)] mb-4">Limited Time Offer</span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-serif text-white mb-4">{{ $activeSale->name }}</h2>
                <p class="text-white/70 text-lg mb-6 max-w-lg">{{ $activeSale->description }}</p>
                
                <a href="{{ route('product', ['sale' => $activeSale->id]) }}" class="btn-premium">
                    Shop Now
                </a>
            </div>

            <div class="relative">
                <div class="bg-[var(--primary-hover)]/50 backdrop-blur-sm border border-[var(--accent-color)]/20 rounded-2xl p-6 md:p-10">
                    <div class="text-center mb-6">
                        <span class="text-[var(--accent-color)] text-xs uppercase tracking-[0.3em]">Ends In</span>
                    </div>

                    <div class="grid grid-cols-4 gap-4 text-center">
                        <div>
                            <span id="days" class="text-3xl md:text-4xl font-serif text-white block">00</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-white/50">Days</span>
                        </div>
                        <div class="border-l border-white/10">
                            <span id="hours" class="text-3xl md:text-4xl font-serif text-white block">00</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-white/50">Hours</span>
                        </div>
                        <div class="border-l border-white/10">
                            <span id="minutes" class="text-3xl md:text-4xl font-serif text-white block">00</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-white/50">Min</span>
                        </div>
                        <div class="border-l border-white/10">
                            <span id="seconds" class="text-3xl md:text-4xl font-serif text-[var(--accent-color)] block">00</span>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-white/50">Sec</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    const countDownDate = {{ \Carbon\Carbon::parse($activeSale->ends_at)->timestamp * 1000 }};
    
    const daysEl = document.getElementById("days");
    const hoursEl = document.getElementById("hours");
    const minutesEl = document.getElementById("minutes");
    const secondsEl = document.getElementById("seconds");

    function updateTimer() {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        if (distance < 0) return;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const pad = (n) => n < 10 ? '0' + n : n;

        if (daysEl) daysEl.innerText = pad(days);
        if (hoursEl) hoursEl.innerText = pad(hours);
        if (minutesEl) minutesEl.innerText = pad(minutes);
        if (secondsEl) secondsEl.innerText = pad(seconds);
    }

    updateTimer();
    setInterval(updateTimer, 1000);
})();
</script>
@endif

<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 md:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            <div class="text-center p-6">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-[var(--accent-color)]/10 flex items-center justify-center">
                    <i class="fas fa-shipping-fast text-xl text-[var(--accent-color)]"></i>
                </div>
                <h3 class="text-[var(--primary-color)] font-semibold mb-2">Free Shipping</h3>
                <p class="text-[var(--primary-color)]/60 text-sm">On orders over Rs. 5000</p>
            </div>
            <div class="text-center p-6">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-[var(--accent-color)]/10 flex items-center justify-center">
                    <i class="fas fa-undo text-xl text-[var(--accent-color)]"></i>
                </div>
                <h3 class="text-[var(--primary-color)] font-semibold mb-2">Easy Returns</h3>
                <p class="text-[var(--primary-color)]/60 text-sm">30-day return policy</p>
            </div>
            <div class="text-center p-6">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-[var(--accent-color)]/10 flex items-center justify-center">
                    <i class="fas fa-shield-alt text-xl text-[var(--accent-color)]"></i>
                </div>
                <h3 class="text-[var(--primary-color)] font-semibold mb-2">Secure Payment</h3>
                <p class="text-[var(--primary-color)]/60 text-sm">100% secure checkout</p>
            </div>
            <div class="text-center p-6">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-[var(--accent-color)]/10 flex items-center justify-center">
                    <i class="fas fa-headset text-xl text-[var(--accent-color)]"></i>
                </div>
                <h3 class="text-[var(--primary-color)] font-semibold mb-2">24/7 Support</h3>
                <p class="text-[var(--primary-color)]/60 text-sm">Dedicated customer support</p>
            </div>
        </div>
    </div>
</section>

@endsection