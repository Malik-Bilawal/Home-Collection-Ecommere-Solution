@extends("user.layouts.master-layouts.plain")

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<title>Inhouse Textiles | Premium Home Textiles</title>

@push("style")
<style>
    /* Prevent horizontal overflow globally */

    /* 
    * {
        max-width: 100%;
        box-sizing: border-box;
    } */


    * {
        font-family: 'Inter', sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Playfair Display', serif;
    }

    /* Modern Scrollbar */
    ::-webkit-scrollbar {
        width: 10px;
    }

    ::-webkit-scrollbar-track {
        background: var(--background-color);
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 5px;
    }

    /* Custom Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(10deg);
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }

        100% {
            background-position: 1000px 0;
        }
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-marquee {
        display: inline-flex;
        /* Important: no shrink */
        animation: marquee 12s linear infinite;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0%);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    /* Premium Glass Effect */
    .glass-effect {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .premium-gradient {
        background: linear-gradient(135deg,
                rgba(107, 66, 38, 0.1) 0%,
                rgba(200, 161, 101, 0.1) 50%,
                rgba(140, 94, 60, 0.1) 100%);
    }

    .premium-text-gradient {
        background: linear-gradient(135deg,
                var(--primary-color) 0%,
                var(--secondary-color) 50%,
                var(--accent-color) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Premium Card Hover Effects */
    .premium-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        background: var(--surface-light);
        position: relative;
        overflow: hidden;
    }

    .premium-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent);
        transition: left 0.7s;
    }

    .premium-card:hover::before {
        left: 100%;
    }

    .premium-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(107, 66, 38, 0.15),
            0 5px 15px rgba(200, 161, 101, 0.1);
    }

    /* Modern Button Styles */
    .btn-modern {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg,
                var(--primary-color) 0%,
                var(--accent-color) 100%);
        color: white;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.4s ease;
        isolation: isolate;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent);
        transition: left 0.6s;
    }

    .btn-modern:hover::before {
        left: 100%;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(107, 66, 38, 0.3);
    }

    .btn-modern-outline {
        background: transparent;
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        padding: 12px 30px;
    }

    .btn-modern-outline:hover {
        background: var(--primary-color);
        color: white;
    }

    /* Premium Trust Cards */
    .trust-card-modern {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 1px solid var(--border-color);
        transition: all 0.4s ease;
    }

    .trust-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg,
                var(--primary-color),
                var(--secondary-color),
                var(--accent-color));
        opacity: 0;
        transition: opacity 0.4s;
    }

    .trust-card-modern:hover::before {
        opacity: 1;
    }

    .trust-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(107, 66, 38, 0.1);
    }

    /* Modern Testimonial Card */
    .modern-testimonial-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        position: relative;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .modern-testimonial-card::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 40px;
        font-size: 120px;
        font-family: 'Playfair Display', serif;
        color: var(--secondary-color);
        opacity: 0.1;
    }

    /* Custom Utility Classes */
    .text-balance {
        text-wrap: balance;
    }

    .perspective-1000 {
        perspective: 1000px;
    }

    .hover-lift {
        transition: transform 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
    }

    /* Loading Skeleton */
    .skeleton {
        background: linear-gradient(90deg,
                rgba(248, 245, 242, 1) 0%,
                rgba(255, 255, 255, 0.8) 50%,
                rgba(248, 245, 242, 1) 100%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    /* Parallax Sections */
    .parallax-section {
        position: relative;
        overflow: hidden;
    }

    .parallax-bg {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background-size: cover;
        background-position: center;
        transform: translateZ(0);
        will-change: transform;
    }

    /* Modern Navigation Effects */
    .nav-link-modern {
        position: relative;
        padding: 10px 0;
    }

    .nav-link-modern::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--secondary-color);
        transition: width 0.3s ease;
    }

    .nav-link-modern:hover::after {
        width: 100%;
    }

    /* Premium Badge */
    .premium-badge {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        display: inline-block;
        position: relative;
        overflow: hidden;
    }

    .premium-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent);
        transition: left 0.5s;
    }

    .premium-badge:hover::before {
        left: 100%;
    }

    /* Modern Input Fields */
    .input-modern {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid var(--border-color);
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .input-modern:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(200, 161, 101, 0.2);
    }

    /* Mobile-specific fixes */
    @media (max-width: 768px) {

        /* Hero section mobile fixes */
        .hero-slide-container {
            width: 100vw;
            overflow: hidden;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
        }

        /* Fix for text overflow on mobile */
        h1,
        h2,
        h3 {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Reduce padding on mobile */
        .px-6 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .px-12 {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
        }

        /* Adjust text sizes for mobile */
        .text-9xl {
            font-size: 4rem !important;
            line-height: 1 !important;
        }

        .text-8xl {
            font-size: 3.5rem !important;
            line-height: 1 !important;
        }

        .text-6xl {
            font-size: 3rem !important;
            line-height: 1 !important;
        }
    }
</style>
@endpush

@section("content")
<section class="relative w-screen left-[50%] -translate-x-[50%] overflow-hidden bg-[var(--primary-color)] text-[var(--text-on-primary)]
                h-[30dvh] md:h-[40vh] lg:h-[80vh]"
    x-data="{ 
        activeSlide: 0, 
        slides: {{ $banners->count() }},
        timer: null,
        startTimer() {
            this.timer = setInterval(() => {
                this.activeSlide = (this.activeSlide === this.slides - 1) ? 0 : this.activeSlide + 1;
            }, 6000);
        }
    }"
    x-init="startTimer()"
    @mouseenter="clearInterval(timer)"
    @mouseleave="startTimer()">

    <div class="absolute inset-0 z-20 pointer-events-none opacity-[0.08] w-full h-full mix-blend-overlay"
        style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.7%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22 opacity=%221%22/%3E%3C/svg%3E');">
    </div>

    @foreach($banners as $index => $banner)
    <div x-show="activeSlide === {{ $index }}"
        x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0 scale-105"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-1000"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 w-full h-full z-0">

        @if($banner->type === 'video' && $banner->video)
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset($banner->video) }}" type="video/mp4">
        </video>
        @else
        <img src="{{ asset('storage/app/public/' . $banner->image) }}"
            alt="{{ $banner->title }}"
            class="absolute inset-0 w-full h-full object-cover select-none pointer-events-none"
            loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
        <div class="absolute inset-0 bg-black/40 lg:hidden"></div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/40 to-transparent mix-blend-multiply pointer-events-none"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/20 pointer-events-none"></div>

        <div class="absolute inset-0 flex items-center z-30 pointer-events-none">
            <div class="w-full px-4 sm:px-6 md:px-12 pointer-events-auto">
                <div class="w-full max-w-7xl mx-auto">
                    <div class="overflow-hidden mb-2 md:mb-4">
                        <span class="block text-[10px] md:text-xs font-mono uppercase tracking-[0.3em] text-[var(--secondary-color)] transform transition-transform duration-700 delay-300 translate-y-full"
                            :class="{ '!translate-y-0': activeSlide === {{ $index }} }">
                            {{ $banner->badge }}
                        </span>
                    </div>

                    <div class="overflow-hidden mb-2 md:mb-6">
                        <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl font-serif font-medium leading-[1.1] tracking-tight transform transition-transform duration-1000 delay-300 translate-y-full break-words hyphens-auto"
                            :class="{ '!translate-y-0': activeSlide === {{ $index }} }">
                            {{ $banner->title }}
                        </h1>
                    </div>

                    <div class="flex items-start gap-6 transform transition-all duration-1000 delay-500 opacity-0 translate-y-10"
                        :class="{ '!opacity-100 !translate-y-0': activeSlide === {{ $index }} }">
                        <div class="w-12 h-px bg-[var(--secondary-color)] mt-4 hidden md:block"></div>

                        <p class="hidden md:block text-lg md:text-xl font-light text-white/90 leading-relaxed max-w-xl">
                            {{ $banner->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="absolute bottom-0 left-0 w-full z-40 bg-black/40 backdrop-blur-md border-t border-white/10">
        <div class="flex items-center justify-between px-4 sm:px-6 md:px-12 h-14 md:h-20 w-full max-w-[100vw]">
            <div class="flex items-center gap-4 sm:gap-6">
                <span class="text-[10px] md:text-xs font-mono text-white/50">01</span>
                <div class="flex gap-2">
                    @foreach($banners as $index => $banner)
                    <button @click="activeSlide = {{ $index }}"
                        class="relative w-8 md:w-10 h-1 flex items-center justify-center group focus:outline-none">
                        <span class="absolute inset-0 bg-white/20 transition-all duration-500 rounded-full"
                            :class="{ '!bg-[var(--secondary-color)]': activeSlide === {{ $index }} }"></span>
                    </button>
                    @endforeach
                </div>
                <span class="text-[10px] md:text-xs font-mono text-white/50">0{{ $banners->count() }}</span>
            </div>

            <div class="hidden lg:flex flex-1 justify-end overflow-hidden ml-12">
                <div class="animate-marquee flex whitespace-nowrap gap-12 opacity-60">
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">
                        EXPORT GRADE QUALITY
                    </span>
                    <span class="text-xs font-mono text-[var(--secondary-color)]">•</span>
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">
                        THREE GENERATIONS OF EXPERTISE
                    </span>
                    <span class="text-xs font-mono text-[var(--secondary-color)]">•</span>
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">
                        TRUSTED BY PAKISTANI FAMILIES
                    </span>

                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">
                        EXPORT GRADE QUALITY
                    </span>
                    <span class="text-xs font-mono text-[var(--secondary-color)]">•</span>
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">
                        THREE GENERATIONS OF EXPERTISE
                    </span>
                    <span class="text-xs font-mono text-[var(--secondary-color)]">•</span>
                    <span class="text-xs font-mono uppercase tracking-[0.3em] text-white/70">
                        TRUSTED BY PAKISTANI FAMILIES
                    </span>
                </div>
            </div>


        </div>
    </div>
    </div>
    </div>
</section>
<section class="py-12 md:py-24 bg-[#FBF7EE]">
    <div class="container mx-auto px-2 md:px-12">

        <div class="text-center mb-16">
            <span class="text-[10px] font-bold uppercase tracking-[0.4em] text-[#B89A6B] mb-2 block">2026 Series</span>
            <h2 class="text-4xl md:text-6xl font-serif text-[#680626] italic">Curated <span class="not-italic">Mosaic</span></h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 auto-rows-[minmax(200px,auto)] md:grid-flow-dense">

            @foreach($categories as $index => $category)
            @php
            // --- 1. MOBILE LOGIC (The one you liked) ---
            // Pattern: [Small] [Small] [Big Full Width]
            // The cycle repeats every 3 items.
            $mPos = ($index + 1) % 3;
            $mobileClass = ($mPos === 0) ? 'col-span-2 aspect-square' : 'col-span-1 aspect-square';

            // --- 2. DESKTOP LOGIC (The "Bento" Puzzle) ---
            // Pattern: Repeats every 6 items to create a weaving effect.
            // 0 = Big (Left)
            // 1, 2 = Small Stacked (Right)
            // 3, 4 = Small Stacked (Left)
            // 5 = Big (Right)

            $dPos = $index % 6;
            $desktopClass = '';
            $isDesktopBig = false;

            switch ($dPos) {
            case 0: // Big Box (Left Side)
            $desktopClass = 'md:col-span-2 md:row-span-2';
            $isDesktopBig = true;
            break;
            case 1: // Small (Right Top)
            case 2: // Small (Right Bottom)
            $desktopClass = 'md:col-span-1 md:row-span-1';
            break;
            case 3: // Small (Left Top)
            case 4: // Small (Left Bottom)
            $desktopClass = 'md:col-span-1 md:row-span-1'; // Logic handled by grid-flow-dense
            break;
            case 5: // Big Box (Right Side)
            $desktopClass = 'md:col-span-2 md:row-span-2';
            $isDesktopBig = true;
            break;
            }
            @endphp

            <div class="relative group {{ $mobileClass }} {{ $desktopClass }} overflow-hidden bg-[#E2DBD1]">

                <a href="{{ route('product', ['category_id' => $category->id]) }}" class="block w-full h-full">

                    <img src="{{ $category->image ? asset('storage/app/public/' . $category->image) : 'https://placehold.co/800x800/E2DBD1/680626?text=' . urlencode($category->name) }}"
                        alt="{{ $category->name }}"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-105">

                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-all duration-500"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-90 md:opacity-60 transition-opacity duration-500"></div>

                    <div class="absolute inset-0 p-4 md:p-8 flex flex-col justify-end items-start">

                        <h3 class="font-serif text-white leading-none mb-2 transition-all duration-500 group-hover:translate-x-2 
                                {{ $isDesktopBig ? 'text-3xl md:text-5xl' : 'text-lg md:text-2xl' }}
                                {{ ($mPos === 0) ? 'text-3xl' : '' }} ">
                            {{ $category->name }}
                        </h3>

                        <div class="flex items-center gap-3 opacity-80 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="h-px bg-white/70 transition-all duration-500 group-hover:w-12 {{ $isDesktopBig ? 'w-12' : 'w-4' }}"></div>
                            <span class="text-[9px] font-bold text-white uppercase tracking-widest">
                                {{ $category->products_count ?? 'Explore' }}
                            </span>
                        </div>

                    </div>

                    @if($isDesktopBig)
                    <div class="absolute top-6 right-6 hidden md:block">
                        <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                    </div>
                    @endif
                </a>
            </div>
            @endforeach

        </div>

        <div class="mt-8 text-center md:hidden">
            <p class="text-[9px] text-[#680626]/40 uppercase tracking-widest">Swipe for more</p>
        </div>
    </div>
</section>
<section
    class="bg-[#FBF7EE] py-20 overflow-hidden select-none"
    x-data="infiniteCarousel()"
    x-init="initCarousel()"
    @mouseenter="stopAutoplay()"
    @mouseleave="startAutoplay()">
    <div class="container mx-auto px-6 mb-12 text-center relative z-10">
        <h2 class="text-4xl md:text-5xl font-serif text-[#680626] font-medium tracking-tight mb-4">Curated Best Sellers</h2>
        <p class="text-[#B89A6B] uppercase tracking-[0.2em] text-xs font-medium">Excellence in Every Detail</p>
    </div>

    <div class="relative w-full">
        <div class="absolute left-0 top-0 bottom-0 w-12 md:w-40 bg-gradient-to-r from-[#FBF7EE] to-transparent z-20 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-12 md:w-40 bg-gradient-to-l from-[#FBF7EE] to-transparent z-20 pointer-events-none"></div>

        <div
            x-ref="track"
            class="flex ease-[cubic-bezier(0.25,1,0.5,1)]"
            :style="`transform: translateX(-${currentIndex * (window.innerWidth < 768 ? 100 : 25)}%); transition-duration: ${transitionDuration}ms`">
            @php
            $originals = $topSellingProduct;
            $clones = $originals->count() >= 4 ? $originals->take(4) : $originals;
            while($clones->count() < 4 && $originals->isNotEmpty()) {
                $clones = $clones->concat($originals);
                }
                $clones = $clones->take(4);
                $allProducts = $originals->concat($clones);
                @endphp

                @foreach($allProducts as $index => $product)
                <div class="w-full md:w-1/4 flex-shrink-0 px-3 md:px-6 relative group">
                    <div class="bg-white h-full flex flex-col relative overflow-hidden transition-all duration-500 hover:shadow-[0_10px_40px_-15px_rgba(104,6,38,0.2)] border border-transparent hover:border-[#D6CEC3]/30">

                        <div class="relative aspect-[3/4] overflow-hidden bg-[#F0EBE6]">
                            @if($product->offer_price && $product->offer_price < $product->price)
                                <div class="absolute top-3 left-3 bg-white/95 backdrop-blur text-[#680626] text-[10px] font-bold px-3 py-1 uppercase tracking-widest z-20 shadow-sm">
                                    Sale
                                </div>
                                @endif

                                <img
                                    src="{{ $product->defaultImage
        ? asset('storage/' . $product->defaultImage->image_path)
        : 'https://placehold.co/600x800/E2DBD1/680626?text=Image' }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110">

                                <div class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-[cubic-bezier(0.25,1,0.5,1)] z-20">
                                    <button
                                        class="btn-cta w-full bg-[#680626] text-white py-4 uppercase text-xs tracking-[0.2em] font-medium hover:bg-[#52041E] transition-colors"
                                        data-url="{{ route('product.detail', $product->id) }}">
                                        Add to Cart
                                    </button>
                                </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow text-center bg-white relative z-10">
                            <div class="text-[#B89A6B] text-[10px] font-bold uppercase tracking-widest mb-3">
                                {{ $product->category->name ?? 'Signature Collection' }}
                            </div>

                            <h3 class="text-[#1A1A1A] text-xl font-serif mb-2 group-hover:text-[#680626] transition-colors duration-300 truncate">
                                {{ $product->name }}
                            </h3>

                            <div class="flex justify-center gap-1 mb-3">
                                @php $rating = $product->rating ?? 0; @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= $rating ? 'text-[#B89A6B] fill-current' : 'text-[#E2DBD1] fill-current' }}" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg>
                                    @endfor
                            </div>

                            <div class="mt-auto pt-3 border-t border-[#FBF7EE] flex justify-center items-baseline gap-3">
                                @if($product->offer_price)
                                <span class="text-gray-400 line-through text-xs font-light">
                                    Rs.{{ number_format($product->price, 2) }}
                                </span>
                                <span class="text-[#680626] text-lg font-medium">
                                    Rs.{{ number_format($product->offer_price, 2) }}
                                </span>
                                @else
                                <span class="text-[#680626] text-lg font-medium">
                                    Rs.{{ number_format($product->price, 2) }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>

        <div class="flex justify-center mt-10 gap-2">
            @foreach($topSellingProduct as $index => $p)
            <button
                @click="currentIndex = {{ $index }}"
                class="h-1 rounded-full transition-all duration-500"
                :class="(currentIndex % {{ $topSellingProduct->count() }}) === {{ $index }} ? 'w-8 bg-[#680626]' : 'w-2 bg-[#D6CEC3]'"></button>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-cta')) {
            window.location.href = e.target.dataset.url;
        }
    });

    function infiniteCarousel() {
        return {
            currentIndex: 0,
            totalItems: {
                {
                    $topSellingProduct - > count()
                }
            },
            transitionDuration: 1000,
            interval: null,
            autoplayDelay: 3000,
            isResetting: false,
            initCarousel() {
                this.startAutoplay();
                window.addEventListener('resize', () => {
                    this.transitionDuration = 0;
                    this.currentIndex = 0;
                    setTimeout(() => this.transitionDuration = 1000, 100);
                });
            },
            startAutoplay() {
                this.interval = setInterval(() => {
                    this.next();
                }, this.autoplayDelay);
            },
            stopAutoplay() {
                clearInterval(this.interval);
            },
            next() {
                if (this.isResetting) return;

                this.transitionDuration = 1000;
                this.currentIndex++;

                if (this.currentIndex >= this.totalItems) {
                    this.isResetting = true;
                    setTimeout(() => {
                        this.transitionDuration = 0;
                        this.currentIndex = 0;
                        setTimeout(() => {
                            this.transitionDuration = 1000;
                            this.isResetting = false;
                        }, 50);
                    }, 1000);
                }
            }
        }
    }
</script>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">

    <div class="flex flex-col md:flex-row justify-between items-end mb-32 gap-8">
        <div class="max-w-2xl">
            <span class="text-[10px] font-bold uppercase tracking-[0.5em] text-[#B89A6B] mb-4 block">HERITAGE COLLECTIONS</span>
            <h2 class="text-5xl md:text-7xl lg:text-8xl font-serif text-[#680626] leading-[0.85] tracking-tighter">
                Generational <br> <span class="italic font-light ml-12 md:ml-24">Craft</span>
            </h2>
        </div>
        <div class="md:w-1/3 text-right">
            <p class="text-xs text-[#680626]/60 font-light uppercase tracking-widest leading-loose border-r-2 border-[#B89A6B] pr-6">
                Three generations of expertise,<br>woven into every thread.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-20 items-start">

        @foreach($categories as $index => $category)
        @php
        // Define unique heights and offsets for a "Non-Boxy" expensive look
        $itemStyles = [
        0 => 'aspect-[3/4] md:translate-y-0', // Col 1: Tall
        1 => 'aspect-square md:translate-y-24', // Col 2: Square & Dropped
        2 => 'aspect-[4/5] md:-translate-y-12', // Col 3: Medium & Raised
        ];
        $currentStyle = $itemStyles[$index % 3];
        @endphp

        <div class="relative group {{ explode(' ', $currentStyle)[1] }}">
            <a href="{{ route('product', ['category_id' => $category->id]) }}" class="block">

                <div class="relative w-full {{ explode(' ', $currentStyle)[0] }} overflow-hidden bg-[#D6CEC3]">
                    <img src="{{ $category->image ? asset('storage/app/public/' . $category->image) : 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200' }}"
                        alt="{{ $category->name }}"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2.5s] ease-[cubic-bezier(0.2,1,0.3,1)] group-hover:scale-105">

                    <div class="absolute inset-0 bg-[#680626]/5 group-hover:bg-transparent transition-colors duration-700"></div>
                </div>

                <div class="mt-10 {{ ($index % 3 == 2) ? 'md:text-right' : 'text-left' }}">
                    <div class="inline-flex flex-col {{ ($index % 3 == 2) ? 'md:items-end' : 'items-start' }}">
                        <span class="text-[9px] font-bold text-[#B89A6B] tracking-[0.4em] mb-4">
                            SERIES // 0{{ $index + 1 }}
                        </span>

                        <h3 class="text-3xl md:text-4xl font-serif text-[#680626] leading-none mb-6 group-hover:text-[#B89A6B] transition-colors duration-500">
                            {{ $category->name }}
                        </h3>

                        <div class="h-px w-8 bg-[#B89A6B] group-hover:w-20 transition-all duration-700"></div>

                        <div class="mt-8 overflow-hidden">
                            <span class="inline-block text-[10px] font-bold uppercase tracking-[0.3em] text-[#680626] transition-all duration-500 transform translate-y-full group-hover:translate-y-0">
                                Explore Collection &rarr;
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach

    </div>

    <div class="absolute bottom-10 left-6 pointer-events-none opacity-[0.03] select-none">
        <span class="text-[10rem] font-serif italic text-[#680626]">Curated</span>
    </div>
    </div>
    </section>

    <section
        class="bg-[#FBF7EE] py-24 overflow-hidden select-none"
        x-data="infiniteCarousel()"
        x-init="initCarousel()"
        @mouseenter="stopAutoplay()"
        @mouseleave="startAutoplay()">
        <div class="container mx-auto px-6 mb-16 relative z-10 text-center">
            <h2 class="text-5xl md:text-6xl font-serif text-[#680626] font-light tracking-tight mb-4 italic">The <span class="font-medium not-italic">Heritage</span> Collection</h2>
            <div class="flex items-center justify-center gap-4">
                <div class="h-[1px] w-12 bg-[#B89A6B]/40"></div>
                <p class="text-[#B89A6B] uppercase tracking-[0.4em] text-[10px] font-bold">Export Grade Quality</p>
                <div class="h-[1px] w-12 bg-[#B89A6B]/40"></div>
            </div>
        </div>

        <div class="relative w-full">
            <div class="absolute left-0 top-0 bottom-0 w-20 md:w-64 bg-gradient-to-r from-[#FBF7EE] to-transparent z-20 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-20 md:w-64 bg-gradient-to-l from-[#FBF7EE] to-transparent z-20 pointer-events-none"></div>

            <div
                x-ref="track"
                class="flex ease-[cubic-bezier(0.23,1,0.32,1)]"
                :style="`transform: translateX(-${currentIndex * (window.innerWidth < 768 ? 100 : 33.333)}%); transition-duration: ${transitionDuration}ms`">
                @php
                // Using exactly your cloning logic for stability
                $originals = $popularProducts;
                $clones = $originals->count() >= 3 ? $originals->take(3) : $originals;
                while($clones->count() < 3 && $originals->isNotEmpty()) {
                    $clones = $clones->concat($originals);
                    }
                    $clones = $clones->take(3);
                    $allProducts = $originals->concat($clones);
                    @endphp

                    @foreach($allProducts as $index => $product)
                    <div class="w-full md:w-1/3 flex-shrink-0 px-4 md:px-8 relative group">
                        <div class="relative flex flex-col h-full bg-white p-4 border border-[#E2DBD1]/30 transition-all duration-700 hover:shadow-[0_20px_50px_rgba(104,6,38,0.08)]">

                            @if($product->offer_price && $product->offer_price < $product->price)
                                <div class="absolute top-6 left-6 z-20">
                                    <span class="bg-[#680626] text-white text-[9px] font-bold px-3 py-1 uppercase tracking-widest">EXPORT QUALITY</span>
                                </div>
                                @endif

                                <div class="relative aspect-[4/5] overflow-hidden bg-[#FBF7EE]">
                                    <img
                                        src="{{ $product->image_url ?? 'https://placehold.co/800x1000/F4F0EB/680626?text=' . urlencode($product->name) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover grayscale-[0.2] group-hover:grayscale-0 transition-all duration-[2s] ease-out group-hover:scale-110">

                                    <div class="absolute inset-0 bg-[#680626]/0 group-hover:bg-[#680626]/5 transition-all duration-700 flex flex-col justify-end p-6">
                                        <div class="translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 delay-100">
                                            <button
                                                class="btn-cta w-full bg-white text-[#680626] py-4 text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-[#680626] hover:text-white transition-all shadow-xl"
                                                data-url="{{ route('product.detail', $product->id) }}">
                                                Experience Quality
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 mb-4 text-center">
                                    <p class="text-[#B89A6B] text-[9px] uppercase tracking-[0.3em] font-bold mb-2">{{ $product->category->name ?? 'Premium Collection' }}</p>
                                    <h3 class="text-[#1A1A1A] text-2xl font-serif mb-4 group-hover:text-[#680626] transition-colors duration-500 truncate px-4">
                                        {{ $product->name }}
                                    </h3>

                                    <div class="flex items-center justify-center gap-3">
                                        @if($product->offer_price)
                                        <span class="text-[#B89A6B]/50 line-through text-xs font-light tracking-wider">
                                            Rs.{{ number_format($product->price, 0) }}
                                        </span>
                                        <span class="text-[#680626] text-xl font-medium tracking-tight">
                                            Rs.{{ number_format($product->offer_price, 0) }}
                                        </span>
                                        @else
                                        <span class="text-[#680626] text-xl font-medium tracking-tight">
                                            Rs.{{ number_format($product->price, 0) }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[2px] bg-[#680626] group-hover:w-full transition-all duration-700"></div>
                        </div>
                    </div>
                    @endforeach
            </div>

            <div class="flex justify-center mt-16 gap-3">
                @foreach($popularProducts as $index => $p)
                <button
                    @click="currentIndex = {{ $index }}"
                    class="h-[2px] transition-all duration-700"
                    :class="(currentIndex % {{ $popularProducts->count() }}) === {{ $index }} ? 'w-12 bg-[#680626]' : 'w-4 bg-[#D6CEC3]'"></button>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        // Keeping your logic intact as requested, just adjusting for 3-card width
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-cta')) {
                window.location.href = e.target.dataset.url;
            }
        });

        function infiniteCarousel() {
            return {
                currentIndex: 0,
                totalItems: {
                    {
                        $popularProducts - > count()
                    }
                },
                transitionDuration: 1000,
                interval: null,
                autoplayDelay: 4000, // Slightly slower for luxury feel
                isResetting: false,
                initCarousel() {
                    this.startAutoplay();
                    window.addEventListener('resize', () => {
                        this.transitionDuration = 0;
                        this.currentIndex = 0;
                        setTimeout(() => this.transitionDuration = 1000, 100);
                    });
                },
                startAutoplay() {
                    this.interval = setInterval(() => {
                        this.next();
                    }, this.autoplayDelay);
                },
                stopAutoplay() {
                    clearInterval(this.interval);
                },
                next() {
                    if (this.isResetting) return;

                    this.transitionDuration = 1000;
                    this.currentIndex++;

                    if (this.currentIndex >= this.totalItems) {
                        this.isResetting = true;
                        setTimeout(() => {
                            this.transitionDuration = 0;
                            this.currentIndex = 0;
                            setTimeout(() => {
                                this.transitionDuration = 1000;
                                this.isResetting = false;
                            }, 50);
                        }, 1000);
                    }
                }
            }
        }
    </script>

    <section class="py-16 md:py-24 bg-[var(--background-color)]">
        <div class="container mx-auto px-4 md:px-6">

            <div class="text-center mb-12 md:mb-20" data-aos="fade-up">
                <span class="inline-block px-3 py-1 md:px-4 md:py-1.5 mb-4 md:mb-6 text-[10px] md:text-[11px] font-bold tracking-[0.3em] uppercase text-[var(--secondary-color)] border border-[var(--border-color)] rounded-full">
                    HERITAGE COLLECTION
                </span>
                <h2 class="text-2xl md:text-3xl lg:text-4xl xl:text-5xl font-serif font-light mb-4 md:mb-6 text-[var(--primary-color)]">
                    Family Curated
                </h2>
                <div class="w-12 md:w-16 h-px bg-[var(--secondary-color)] mx-auto mb-4 md:mb-6"></div>
                <p class="text-neutral-600 max-w-xl mx-auto leading-relaxed text-sm md:text-base">
                    Three generations of textile expertise, bringing export-grade quality to Pakistani homes.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 lg:gap-10">
                @foreach ($products as $product)
                @include('user.partials.home-product-cards', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-12 md:mt-20 text-center" data-aos="fade-up">
                <a href="{{ route('product') }}" class="relative inline-flex items-center gap-3 md:gap-4 group">
                    <span class="text-xs md:text-sm font-bold uppercase tracking-[0.3em] text-[var(--primary-color)]">
                        Discover Heritage Collection
                    </span>
                    <div class="w-8 md:w-12 h-px bg-[var(--primary-color)] transition-all group-hover:w-12 md:group-hover:w-20"></div>
                    <svg class="w-4 h-4 md:w-5 md:h-5 text-[var(--primary-color)] transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    @if($activeSale = $sale->first())
    <section class="relative min-h-[70vh] md:min-h-[90vh] flex items-center bg-[var(--primary-color)] overflow-hidden py-12 md:py-20">

        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute inset-0" style="background: radial-gradient(circle at 70% 50%, rgba(200,161,101,0.12) 0%, transparent 70%);"></div>
            <div class="absolute inset-0 opacity-[0.05] mix-blend-overlay" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
        </div>

        <div class="container relative z-10 mx-auto px-4 md:px-6 lg:px-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 md:gap-20 items-center">

                <div class="lg:col-span-6" data-aos="fade-right">
                    <div class="mb-8 md:mb-10">
                        <span class="inline-block uppercase tracking-[0.6em] text-[8px] md:text-[10px] font-bold text-[var(--secondary-color)] mb-4 md:mb-6 border-b border-[var(--secondary-color)] pb-1 md:pb-2">
                            FAMILY EXCLUSIVE
                        </span>
                        <h2 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl 2xl:text-9xl font-serif text-white leading-[0.8] mb-6 md:mb-8">
                            {{ $activeSale->name }}
                        </h2>
                        <div class="w-12 md:w-16 lg:w-20 h-px bg-[var(--secondary-color)] my-6 md:my-8 lg:my-10"></div>
                        <p class="text-white opacity-60 text-base md:text-lg font-light leading-relaxed max-w-md italic">
                            "{{ $activeSale->description }}"
                        </p>
                    </div>

                    <a href="{{ route('product', ['sale' => $activeSale->id]) }}"
                        class="group inline-flex items-center gap-4 md:gap-6">
                        <div class="w-12 h-12 md:w-16 md:h-16 rounded-full border border-white/20 flex items-center justify-center group-hover:bg-[var(--secondary-color)] group-hover:border-[var(--secondary-color)] transition-all duration-500">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-white transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </div>
                        <span class="uppercase tracking-[0.4em] text-[10px] md:text-xs font-bold text-white group-hover:text-[var(--secondary-color)] transition-colors">
                            Discover Quality
                        </span>
                    </a>
                </div>

                <div class="lg:col-span-6 flex justify-center lg:justify-end" data-aos="fade-left">
                    <div class="relative w-full max-w-sm md:max-w-md">
                        <div class="absolute -inset-2 md:-inset-4 border border-[var(--secondary-color)]/20 pointer-events-none"></div>

                        <div id="timer-container" class="relative bg-[var(--primary-color)] p-6 md:p-10 lg:p-16 opacity-0 transition-opacity duration-1000">

                            <div class="text-center mb-8 md:mb-12">
                                <h4 class="text-[8px] md:text-[10px] uppercase tracking-[0.5em] text-[var(--secondary-color)]">Closing Soon</h4>
                            </div>

                            <div class="grid grid-cols-2 gap-y-8 md:gap-y-12 gap-x-4 md:gap-x-8">
                                <div class="flex flex-col items-center">
                                    <span id="days" class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-light text-white">00</span>
                                    <span class="text-[8px] md:text-[9px] uppercase tracking-[0.3em] text-[var(--secondary-color)] mt-2 md:mt-4">Days</span>
                                </div>
                                <div class="flex flex-col items-center border-l border-white/5">
                                    <span id="hours" class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-light text-white">00</span>
                                    <span class="text-[8px] md:text-[9px] uppercase tracking-[0.3em] text-[var(--secondary-color)] mt-2 md:mt-4">Hours</span>
                                </div>
                                <div class="flex flex-col items-center">
                                    <span id="minutes" class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-light text-white">00</span>
                                    <span class="text-[8px] md:text-[9px] uppercase tracking-[0.3em] text-[var(--secondary-color)] mt-2 md:mt-4">Minutes</span>
                                </div>
                                <div class="flex flex-col items-center border-l border-white/5 relative">
                                    <div class="absolute top-0 right-0 w-1 h-1 bg-[var(--secondary-color)] rounded-full animate-ping"></div>
                                    <span id="seconds" class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-serif font-light text-[var(--secondary-color)]">00</span>
                                    <span class="text-[8px] md:text-[9px] uppercase tracking-[0.3em] text-white/40 mt-2 md:mt-4">Seconds</span>
                                </div>
                            </div>

                            <div class="mt-8 md:mt-12 lg:mt-16 text-center">
                                <p class="text-[8px] md:text-[10px] text-white/20 uppercase tracking-[0.2em]">EXPORT GRADE TEXTILES</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script>
        (function() {
            // Convert PHP Carbon date to JS timestamp (milliseconds)
            const countDownDate = {
                {
                    \
                    Carbon\ Carbon::parse($activeSale - > ends_at) - > timestamp * 1000
                }
            };

            const timerContainer = document.getElementById("timer-container");
            const daysEl = document.getElementById("days");
            const hoursEl = document.getElementById("hours");
            const minutesEl = document.getElementById("minutes");
            const secondsEl = document.getElementById("seconds");

            function updateTimer() {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                if (distance < 0) {
                    clearInterval(interval);
                    if (timerContainer) {
                        timerContainer.innerHTML = "<div class='py-10 md:py-20 text-center text-[var(--secondary-color)] text-lg md:text-xl font-serif tracking-[0.3em] uppercase'>The Event has Concluded</div>";
                        timerContainer.classList.remove('opacity-0');
                    }
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                const pad = (n) => n < 10 ? '0' + n : n;

                if (daysEl && hoursEl && minutesEl && secondsEl) {
                    daysEl.innerText = pad(days);
                    hoursEl.innerText = pad(hours);
                    minutesEl.innerText = pad(minutes);
                    secondsEl.innerText = pad(seconds);
                }

                if (timerContainer) timerContainer.classList.remove('opacity-0');
            }

            updateTimer();
            const interval = setInterval(updateTimer, 1000);
        })();
    </script>

    @endif

    <section class="py-16 md:py-24 lg:py-32 bg-white border-y border-[var(--border-color)]">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col lg:flex-row justify-between items-end mb-12 md:mb-20 gap-6 md:gap-8">
                <div class="max-w-2xl" data-aos="fade-right">
                    <span class="text-[10px] md:text-[11px] font-bold tracking-[0.4em] text-[var(--secondary-color)] uppercase block mb-3 md:mb-4">OUR HERITAGE</span>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl xl:text-7xl font-serif text-[var(--primary-color)] leading-tight">
                        Three Generations of <br><span class="italic text-[var(--secondary-color)]">Expertise</span>
                    </h2>
                </div>
                <div class="lg:w-1/3" data-aos="fade-left">
                    <p class="text-neutral-500 leading-relaxed border-l-2 border-[var(--secondary-color)] pl-4 md:pl-6 text-sm md:text-base">
                        From a grandfather's textile business in India to export-grade quality for Pakistani homes. Every thread tells a story of resilience, skill, and dedication passed down through generations.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 border-t border-l border-[var(--border-color)]">
                @foreach([
                ['num' => '01', 'title' => 'EXPORT QUALITY', 'desc' => 'Bringing the same quality standards we use for international exports to Pakistani homes.'],
                ['num' => '02', 'title' => 'GENERATIONAL EXPERTISE', 'desc' => 'Three generations of textile knowledge and craftsmanship passed down through family.'],
                ['num' => '03', 'title' => 'ACCESSIBLE PREMIUM', 'desc' => 'Premium quality textiles at prices accessible for middle and upper-middle class households.'],
                ['num' => '04', 'title' => 'TRUSTED LEGACY', 'desc' => 'Built on decades of manufacturing experience and reputation in international markets.']
                ] as $trust)
                <div class="p-6 md:p-8 lg:p-10 border-r border-b border-[var(--border-color)] group hover:bg-[var(--background-color)] transition-colors duration-500">
                    <span class="text-sm font-serif italic text-[var(--secondary-color)] mb-4 md:mb-6 lg:mb-8 block">{{ $trust['num'] }}</span>
                    <h3 class="text-base md:text-lg font-bold text-[var(--primary-color)] mb-3 md:mb-4 tracking-tight uppercase">{{ $trust['title'] }}</h3>
                    <p class="text-neutral-500 text-xs md:text-sm leading-relaxed">{{ $trust['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 lg:py-32 bg-[var(--background-color)]">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12 lg:gap-16 items-center">

                    <div class="hidden lg:block lg:col-span-1 text-6xl md:text-8xl font-serif text-[var(--secondary-color)] opacity-30">
                        "
                    </div>

                    <div class="lg:col-span-11">
                        <div class="space-y-8 md:space-y-12">
                            @foreach([
                            ['name' => 'Fatima Ali', 'role' => 'Home Decor Enthusiast', 'text' => 'Finally, Pakistani textiles that match international quality standards. The craftsmanship shows three generations of expertise, and you can feel the difference in every thread.'],
                            ] as $testimonial)
                            <div class="space-y-6 md:space-y-8" data-aos="fade-up">
                                <p class="text-xl md:text-2xl lg:text-3xl xl:text-4xl font-serif italic text-[var(--primary-color)] leading-snug">
                                    {{ $testimonial['text'] }}
                                </p>
                                <div class="flex items-center gap-4 md:gap-6">
                                    <div class="w-8 md:w-12 lg:w-16 h-px bg-[var(--secondary-color)]"></div>
                                    <div>
                                        <h4 class="font-bold text-[var(--primary-color)] uppercase tracking-widest text-xs md:text-sm">{{ $testimonial['name'] }}</h4>
                                        <p class="text-[var(--secondary-color)] text-[9px] md:text-[10px] uppercase tracking-widest mt-1">{{ $testimonial['role'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection

    @push("script")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        // Initialize AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic'
            });

            // Initialize GSAP ScrollTrigger
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // Parallax effect for hero background
                gsap.to('.parallax-bg', {
                    yPercent: 30,
                    ease: "none",
                    scrollTrigger: {
                        trigger: '.hero-section',
                        start: "top top",
                        end: "bottom top",
                        scrub: true
                    }
                });

                // Stagger animations for product cards
                gsap.from('.modern-product-card', {
                    scrollTrigger: {
                        trigger: '.modern-product-card:first-child',
                        start: "top 80%",
                        toggleActions: "play none none reverse"
                    },
                    y: 50,
                    opacity: 0,
                    stagger: 0.1,
                    duration: 0.8,
                    ease: "power2.out"
                });
            }

            // Sale countdown timer
            @if($activeSale = $sale -> first())
            const endDate = new Date("{{ $activeSale->ends_at->toIso8601String() }}").getTime();

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = endDate - now;

                if (distance <= 0) {
                    const timerContainer = document.querySelector('.modern-sale-timer');
                    if (timerContainer) {
                        timerContainer.innerHTML = `
                    <div class="text-xl md:text-2xl lg:text-3xl font-bold text-white text-center py-6 md:py-8">
                        Sale Ended
                    </div>
                `;
                    }
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                const daysEl = document.getElementById('days');
                const hoursEl = document.getElementById('hours');
                const minutesEl = document.getElementById('minutes');
                const secondsEl = document.getElementById('seconds');

                if (daysEl && hoursEl && minutesEl && secondsEl) {
                    daysEl.textContent = String(days).padStart(2, '0');
                    hoursEl.textContent = String(hours).padStart(2, '0');
                    minutesEl.textContent = String(minutes).padStart(2, '0');
                    secondsEl.textContent = String(seconds).padStart(2, '0');
                }
            }

            setInterval(updateCountdown, 1000);
            updateCountdown();
            @endif

            // Hover tilt effect for cards - only on desktop
            if (window.innerWidth > 768) {
                const cards = document.querySelectorAll('.premium-card');
                cards.forEach(card => {
                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        const centerX = rect.width / 2;
                        const centerY = rect.height / 2;

                        const rotateY = (x - centerX) / 25;
                        const rotateX = (centerY - y) / 25;

                        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px)`;
                    });

                    card.addEventListener('mouseleave', () => {
                        card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(-10px)';
                    });
                });
            }

            // Product image zoom on hover
            const productImages = document.querySelectorAll('.product-image img');
            productImages.forEach(img => {
                img.parentElement.addEventListener('mouseenter', () => {
                    img.style.transform = 'scale(1.1)';
                });

                img.parentElement.addEventListener('mouseleave', () => {
                    img.style.transform = 'scale(1)';
                });
            });

            // Add to cart animation
            document.querySelectorAll('.modern-product-card button').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const originalText = this.innerHTML;

                    // Animation
                    if (typeof gsap !== 'undefined') {
                        gsap.to(this, {
                            scale: 0.95,
                            duration: 0.1,
                            yoyo: true,
                            repeat: 1,
                            onComplete: () => {
                                this.innerHTML = '<svg class="w-4 h-4 md:w-5 md:h-5 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';

                                setTimeout(() => {
                                    this.innerHTML = originalText;
                                }, 1500);
                            }
                        });
                    }

                    // Show notification
                    showNotification('Product added to cart!');
                });
            });

            // Wishlist functionality
            document.querySelectorAll('.product-actions button:first-child').forEach(btn => {
                btn.addEventListener('click', function() {
                    const icon = this.querySelector('svg');
                    const isActive = icon.style.fill === 'currentColor';

                    if (typeof gsap !== 'undefined') {
                        gsap.to(this, {
                            scale: 1.2,
                            duration: 0.2,
                            yoyo: true,
                            repeat: 1
                        });
                    }

                    if (isActive) {
                        icon.style.fill = 'none';
                        showNotification('Removed from wishlist');
                    } else {
                        icon.style.fill = 'currentColor';
                        showNotification('Added to wishlist');
                    }
                });
            });

            // Notification function
            function showNotification(message) {
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 md:top-6 right-4 md:right-6 bg-white shadow-xl rounded-lg md:rounded-xl p-3 md:p-4 border-l-4 border-[var(--secondary-color)] z-50 max-w-xs md:max-w-sm';
                notification.innerHTML = `
            <div class="flex items-center gap-2 md:gap-3">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-[var(--secondary-color)]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-800 font-medium text-sm md:text-base">${message}</span>
            </div>
        `;

                document.body.appendChild(notification);

                // Animate in
                if (typeof gsap !== 'undefined') {
                    gsap.from(notification, {
                        x: 100,
                        opacity: 0,
                        duration: 0.3
                    });
                }

                // Remove after 3 seconds
                setTimeout(() => {
                    if (typeof gsap !== 'undefined') {
                        gsap.to(notification, {
                            x: 100,
                            opacity: 0,
                            duration: 0.3,
                            onComplete: () => notification.remove()
                        });
                    } else {
                        notification.remove();
                    }
                }, 3000);
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        if (typeof gsap !== 'undefined') {
                            gsap.to(window, {
                                duration: 1,
                                scrollTo: target,
                                ease: "power2.inOut"
                            });
                        } else {
                            target.scrollIntoView({
                                behavior: 'smooth'
                            });
                        }
                    }
                });
            });

            // Animate floating elements
            if (typeof gsap !== 'undefined') {
                gsap.to('.animate-float', {
                    y: -20,
                    duration: 2,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut"
                });
            }
        });

        // Mouse move spotlight effect - only on desktop
        if (window.innerWidth > 768) {
            document.addEventListener('mousemove', (e) => {
                const spotlight = document.createElement('div');
                spotlight.style.cssText = `
            position: fixed;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle at ${e.clientX}px ${e.clientY}px, 
                rgba(200, 161, 101, 0.1) 0%, 
                transparent 50%);
            pointer-events: none;
            z-index: 9999;
            top: 0;
            left: 0;
            mix-blend-mode: screen;
        `;
                document.body.appendChild(spotlight);

                // Remove old spotlights
                const oldSpotlights = document.querySelectorAll('body > div[style*="radial-gradient"]');
                if (oldSpotlights.length > 3) {
                    oldSpotlights[0].remove();
                }

                setTimeout(() => spotlight.remove(), 1000);
            });
        }
    </script>
    @endpush