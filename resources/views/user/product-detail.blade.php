@extends("user.layouts.master-layouts.plain")

<title>Inhouse Textiles | {{ $product->name }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

@push("style")
<style>
    :root {
        --primary-color: #680626;
        --primary-hover: #52041E;
        --secondary-color: #B89A6B;
        --secondary-hover: #967B52;
        --accent-color: #D6CEC3;
        --accent-hover: #C8BFB3;
        --text-on-primary: #FFFFFF;
        --text-on-secondary: #2A2A2A;
        --background-color: #FBF7EE;
        --card-background: #FFFFFF;
        --border-color: #E2DBD1;
        --success-color: #10B981;
        --error-color: #EF4444;
        --warning-color: #F59E0B;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--background-color);
        color: #333;
        overflow-x: hidden;
    }

    /* Glass morphism effects */
    .glass-effect {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Custom animations */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes shimmer {
        0% {
            background-position: -200% 0;
        }

        100% {
            background-position: 200% 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    /* Utility classes */
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    .animate-bounce {
        animation: bounce 1s infinite;
    }

    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }

    /* Image zoom effect */
    .image-zoom-container {
        overflow: hidden;
        border-radius: 1.5rem;
        position: relative;
    }

    .image-zoom {
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .image-zoom:hover {
        transform: scale(1.05);
    }

    /* Custom scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: rgba(139, 115, 85, 0.1);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        border-radius: 10px;
    }

    /* Button styles */
    .btn-gradient {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        background-size: 200% 200%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-gradient:hover {
        background-position: right center;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.3);
    }

    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.7s;
    }

    .btn-gradient:hover::before {
        left: 100%;
    }

    .btn-outline-gold {
        border: 2px solid var(--secondary-color);
        color: var(--secondary-color);
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-gold:hover {
        background: var(--secondary-color);
        color: var(--text-on-secondary);
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(193, 154, 107, 0.3);
    }

    /* Color selection */
    .color-option {
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 3px solid transparent;
    }

    .color-option:hover {
        transform: scale(1.15);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .color-option.selected {
        border-color: var(--primary-color);
        transform: scale(1.1);
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.2);
    }

    .color-option::after {
        content: '✓';
        position: absolute;
        top: -8px;
        right: -8px;
        width: 24px;
        height: 24px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
        opacity: 0;
        transform: scale(0);
        transition: all 0.3s ease;
    }

    .color-option.selected::after {
        opacity: 1;
        transform: scale(1);
    }

    /* Size selection */
    .size-option {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .size-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .size-option.selected {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(139, 115, 85, 0.3);
    }

    .size-option.out-of-stock {
        opacity: 0.5;
        cursor: not-allowed;
        position: relative;
    }

    .size-option.out-of-stock::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: var(--error-color);
        transform: rotate(-45deg);
        opacity: 0.7;
    }

    /* Quantity selector */
    .quantity-selector {
        border: 2px solid var(--border-color);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .quantity-selector:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(139, 115, 85, 0.1);
    }

    .quantity-btn {
        transition: all 0.2s ease;
        background: var(--background-color);
    }

    .quantity-btn:hover {
        background: var(--primary-color);
        color: white;
    }

    .quantity-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Notification badge */
    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        font-size: 12px;
        font-weight: bold;
        min-width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: bounce 2s infinite;
    }

    /* Loading skeleton */
    .skeleton {
        background: linear-gradient(90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.4) 50%,
                rgba(255, 255, 255, 0) 100%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }

    /* Price tag animation */
    .price-tag {
        position: relative;
        overflow: hidden;
    }

    .price-tag::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent);
        animation: shimmer 2s infinite;
    }

    /* Review star animation */
    .star-rating {
        display: inline-flex;
    }

    .star-rating i {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .star-rating i:hover {
        transform: scale(1.2);
    }

    /* Image gallery */
    .gallery-thumb {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        border-radius: 10px;
        overflow: hidden;
    }

    .gallery-thumb:hover {
        transform: translateY(-3px);
        border-color: var(--primary-color);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .gallery-thumb.active {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(193, 154, 107, 0.2);
    }

    /* Product card hover */
    .product-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    /* Progress bar */
    .progress-bar {
        background: linear-gradient(90deg,
                var(--secondary-color),
                var(--primary-color));
        border-radius: 10px;
        position: relative;
        overflow: hidden;
    }

    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent);
        animation: shimmer 2s infinite;
    }

    /* Tooltip */
    .tooltip {
        position: relative;
    }

    .tooltip:hover::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 1000;
        margin-bottom: 8px;
    }

    .tooltip:hover::before {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        border: 6px solid transparent;
        border-top-color: rgba(0, 0, 0, 0.8);
        margin-bottom: 2px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .mobile-hidden {
            display: none;
        }

        .mobile-stack {
            flex-direction: column;
        }

        .mobile-full {
            width: 100% !important;
        }
    }

    /* Custom swal (sweet alert) styles */
    .swal2-popup {
        border-radius: 20px !important;
        padding: 2rem !important;
    }

    .swal2-confirm {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
        border-radius: 10px !important;
        padding: 12px 32px !important;
    }

    /* Floating cart button */
    .floating-cart-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(139, 115, 85, 0.4);
        transition: all 0.3s ease;
        animation: float 3s ease-in-out infinite;
    }

    .floating-cart-btn:hover {
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 15px 40px rgba(139, 115, 85, 0.6);
    }

    /* Breadcrumb animation */
    .breadcrumb-item {
        position: relative;
        transition: all 0.3s ease;
    }

    .breadcrumb-item:hover {
        transform: translateX(5px);
        color: var(--primary-color);
    }

    /* Tag styles */
    .tag {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        margin: 2px;
    }

    .tag-new {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
    }

    .tag-featured {
        background: linear-gradient(135deg, #F59E0B, #D97706);
        color: white;
    }

    .tag-sale {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
    }

    /* Animation delays */
    .delay-100 {
        animation-delay: 100ms;
    }

    .delay-200 {
        animation-delay: 200ms;
    }

    .delay-300 {
        animation-delay: 300ms;
    }

    .delay-400 {
        animation-delay: 400ms;
    }

    .delay-500 {
        animation-delay: 500ms;
    }

    /* Gradient text */
    .gradient-text {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Disabled state for buttons */
    .btn-gradient:disabled,
    .btn-outline-gold:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .btn-gradient:disabled:hover,
    .btn-outline-gold:disabled:hover {
        background-position: initial;
        transform: none;
    }

    /* Section divider */
    .section-divider {
        height: 1px;
        background: linear-gradient(90deg,
                transparent,
                var(--border-color),
                transparent);
    }
</style>
@endpush

@section("content")

<!-- Breadcrumb Navigation -->
<nav class="bg-white shadow-sm py-4">
    <div class="container mx-auto px-4">
        <div class="flex items-center space-x-2 text-sm">
            <a href="{{ route('home') }}" class="breadcrumb-item text-gray-600 hover:text-primary transition-all">
                <i class="fas fa-home mr-1"></i> Home
            </a>
            <span class="text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <a href="{{ route('product') }}" class="breadcrumb-item text-gray-600 hover:text-primary transition-all">
                Products
            </a>
            <span class="text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <a href="{{ route('category') }}" class="breadcrumb-item text-gray-600 hover:text-primary transition-all">
                {{ $product->category->name ?? 'Category' }}
            </a>
            <span class="text-gray-400"><i class="fas fa-chevron-right"></i></span>
            <span class="text-primary font-medium">{{ $product->name }}</span>
        </div>
    </div>
</nav>

<!-- Product Main Section -->
<div class="container mx-auto px-4 py-8 animate-fade-in">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- Left Column - Images -->
        <div class="lg:col-span-7">
            <div class="sticky top-24">

                <!-- Main Image Container -->
                <div class="relative mb-6">
                    <!-- Badges -->
                    <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                        @if(isset($showNewTag) && $showNewTag && $product->created_at->gt(now()->subDays(30)))
                        <span class="tag tag-new animate-pulse">NEW</span>
                        @endif

                        @if(isset($showSaleTag) && $showSaleTag && $product->offer_price)
                        <span class="tag tag-sale animate-bounce">
                            -{{ round((($product->price - $product->offer_price) / $product->price) * 100) }}% OFF
                        </span>
                        @endif

                        @if(isset($showFeaturedTag) && $showFeaturedTag && $product->is_featured)
                        <span class="tag tag-featured">FEATURED</span>
                        @endif

                    </div>

                    <!-- Favorite Button -->
                    <button id="favorite-btn" class="absolute top-4 right-4 z-10 w-12 h-12 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center shadow-lg hover:shadow-xl transition-all hover:scale-110">
                        <i class="far fa-heart text-xl text-red-400"></i>
                    </button>

                    <!-- Main Image -->
                    <div class="image-zoom-container rounded-3xl overflow-hidden shadow-2xl">
                        <img id="main-image"
                            src="{{ $product->images->first() ? asset('storage/app/public/' . $product->images->first()->image_path) : asset('images/default-product.jpg') }}"
                            alt="{{ $product->name }}"
                            class="image-zoom w-full h-auto max-h-[600px] object-cover cursor-zoom-in">
                    </div>

                    <!-- Zoom Indicator -->
                    <div class="absolute bottom-4 right-4 bg-black/50 text-white text-xs px-3 py-1 rounded-full backdrop-blur-sm">
                        <i class="fas fa-search-plus mr-1"></i> Hover to zoom
                    </div>
                </div>

                <!-- Thumbnails Gallery -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Gallery</h3>
                    <div class="grid grid-cols-4 sm:grid-cols-6 gap-3" id="thumbnails-container">
                        <!-- Thumbnails will be loaded dynamically -->
                    </div>
                </div>

                <!-- Product Stats -->
                <div class="bg-gradient-to-r from-white to-gray-50 rounded-2xl p-6 shadow-lg">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="w-12 h-12 mx-auto bg-primary/10 rounded-xl flex items-center justify-center mb-3">
                                <i class="fas fa-shipping-fast text-xl text-primary"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Instant Delievery</p>
                            <p class="text-xs text-gray-500">Max 5 days</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 mx-auto bg-secondary/10 rounded-xl flex items-center justify-center mb-3">
                                <i class="fas fa-shield-alt text-xl text-secondary"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">2 Year Warranty</p>
                            <p class="text-xs text-gray-500">Quality Assured</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 mx-auto bg-success-color/10 rounded-xl flex items-center justify-center mb-3">
                                <i class="fas fa-undo-alt text-xl text-success-color"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">14-Day Returns</p>
                            <p class="text-xs text-gray-500">Easy Returns</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 mx-auto bg-warning-color/10 rounded-xl flex items-center justify-center mb-3">
                                <i class="fas fa-headset text-xl text-warning-color"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">24/7 Support</p>
                            <p class="text-xs text-gray-500">We're Here to Help</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Column - Product Info -->
        <div class="lg:col-span-5">
            <div class="bg-white rounded-3xl p-8 shadow-xl sticky top-24">

                <!-- Product Title & Category -->
                <div class="mb-6">
                    <span class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                        {{ $product->category->name ?? 'Premium Home Decor' }}
                    </span>
                    <h1 id="product-name" class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-3 gradient-text">
                        {{ $product->name }}
                    </h1>

                    <!-- Rating -->
                    <div class="flex items-center mb-4">
                        <div class="flex items-center">
                            @php
                            $rating = $product->reviews->avg('rating') ?? 4.5;
                            $fullStars = floor($rating);
                            $hasHalfStar = $rating - $fullStars >= 0.5;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <=$fullStars)
                                <i class="fas fa-star text-yellow-400 text-lg"></i>
                                @elseif($i == $fullStars + 1 && $hasHalfStar)
                                <i class="fas fa-star-half-alt text-yellow-400 text-lg"></i>
                                @else
                                <i class="far fa-star text-yellow-400 text-lg"></i>
                                @endif
                                @endfor
                                <span class="ml-2 text-gray-700 font-medium">{{ number_format($rating, 1) }}</span>
                                <span class="ml-2 text-gray-500">({{ $product->reviews->count() }} reviews)</span>
                        </div>
                    </div>
                </div>

                <!-- Price -->
                <div class="mb-8">
                    <div class="flex items-center gap-4">
                        <span id="product-price" class="text-4xl font-bold text-primary price-tag">
                            Rs.{{ number_format($product->price ?? 2) }}
                        </span>
                        @if($product->cut_price)
                        <span class="text-2xl text-gray-400 line-through">
                            Rs.{{ number_format($product->cut_price, 2) }}
                        </span>

                        <span class="bg-red-100 text-red-600 text-sm font-bold px-3 py-1 rounded-full">
                            Save Rs.{{ number_format($product->cut_price - $product->price, 2) }}
                        </span>
                        @endif
                    </div>
                    @if($product->cut_price)
                    <p class="text-sm text-gray-500 mt-2">
                        <i class="fas fa-clock mr-1"></i> Offer ends in
                        <span class="font-semibold text-primary">2 days, 14 hours</span>
                    </p>
                    @endif
                </div>

                <!-- Product Description -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Description</h3>
                    <p id="product-description" class="text-gray-700 leading-relaxed">
                        {{ $product->description ?? 'No description available.' }}
                    </p>
                </div>

                <!-- Color Selection -->
                <div class="mb-8" id="color-section">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Color: <span id="selected-color-name" class="font-normal text-gray-600">Select a color</span>
                        </h3>
                        <span id="selected-color-hex" class="text-sm text-gray-500"></span>
                    </div>
                    <div class="flex flex-wrap gap-3" id="color-options">
                        <!-- Colors will be loaded dynamically -->
                    </div>
                </div>

                <!-- Size Selection -->
                <div class="mb-8" id="size-section">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Size: <span id="selected-size-name" class="font-normal text-gray-600">Select a size</span>
                        </h3>
                        <span id="size-guide" class="text-sm text-primary cursor-pointer hover:underline">
                            <i class="fas fa-ruler mr-1"></i> Size Guide
                        </span>
                    </div>
                    <div class="flex flex-wrap gap-3" id="size-options">
                        <!-- Sizes will be loaded dynamically -->
                    </div>
                </div>




                <!-- Stock Status -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium text-gray-700">Stock Status</span>
                        <span id="stock-status" class="text-sm font-semibold text-success-color">
                            <i class="fas fa-check-circle mr-1"></i> In Stock
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="progress-bar h-2.5 rounded-full" style="width: 85%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Stock is based on size selection</p>
                    @if($product->sizes && count($product->sizes) > 0)
                    <p class="text-xs text-gray-500">Select a size to see available quantity</p>
                    @endif
                </div>

                <!-- Quantity -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quantity</h3>
                    <div class="flex items-center">
                        <div class="quantity-selector flex items-center rounded-xl">
                            <button id="decrease-qty"
                                class="quantity-btn w-12 h-12 text-xl disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-minus"></i>
                            </button>
                            <span id="quantity" class="w-20 text-center text-xl font-semibold">1</span>
                            <button id="increase-qty"
                                class="quantity-btn w-12 h-12 text-xl">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="ml-6">
                            <p class="text-sm text-gray-500">Max. 10 items per order</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4 mb-8">
                    <button id="add-to-cart"
                        class="btn-gradient w-full py-4 rounded-xl text-white font-bold text-lg hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-shopping-cart mr-3"></i> Add to Cart
                    </button>

                    <button id="buy-now"
                        class="btn-outline-gold w-full py-4 rounded-xl font-bold text-lg hover:shadow-lg transition-all duration-300">
                        <i class="fas fa-bolt mr-3"></i> Buy Now
                    </button>
                </div>

                <!-- Additional Info -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="space-y-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-tag text-primary mr-3"></i>
                            <span>SKU: <span class="font-mono">{{ $product->sku ?? 'N/A' }}</span></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-layer-group text-primary mr-3"></i>
                            <span>Category: {{ $product->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar-alt text-primary mr-3"></i>
                            @if($product->created_at)
                            <span>Added: {{ $product->created_at->format('M d, Y') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Reviews Section -->
<section id="reviews" class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Customer Reviews</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Hear what our customers have to say about this product</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Reviews Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl p-8 shadow-lg sticky top-24">
                    <div class="text-center mb-8">
                        <div class="text-5xl font-bold text-primary mb-2">
                            {{ number_format($product->reviews->avg('rating') ?? 4.5, 1) }}
                        </div>
                        <div class="flex justify-center mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-yellow-400 text-lg"></i>
                                @endfor
                        </div>
                        <p class="text-gray-600">{{ $product->reviews->count() }} verified reviews</p>
                    </div>

                    <!-- Rating Distribution -->
                    <div class="space-y-3 mb-8">
                        @for($i = 5; $i >= 1; $i--)
                        @php
                        $count = $product->reviews->where('rating', $i)->count();
                        $percentage = $product->reviews->count() ? ($count / $product->reviews->count() * 100) : 0;
                        @endphp
                        <div class="flex items-center">
                            <span class="text-sm text-gray-600 w-8">{{ $i }}★</span>
                            <div class="flex-1 mx-3">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                            </div>
                            <span class="text-sm text-gray-600 w-8 text-right">{{ $count }}</span>
                        </div>
                        @endfor
                    </div>

                    <!-- Review Form -->
                    @auth
                    @if($product->currentUserHasPurchased())
                    @if(!$product->currentUserHasReviewed())
                    <div class="bg-gradient-to-r from-primary/5 to-secondary/5 rounded-2xl p-6">
                        <h4 class="font-bold text-gray-800 mb-4">Share Your Experience</h4>
                        <form action="{{ route('review.store', $product->id) }}" method="POST" id="review-form">
                            @csrf
                            <div class="mb-4">
                                <div class="star-rating text-2xl" id="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star cursor-pointer" data-rating="{{ $i }}"></i>
                                        @endfor
                                </div>
                                <input type="hidden" name="rating" id="selected-rating" required>
                            </div>
                            <div class="mb-4">
                                <textarea name="comment"
                                    rows="4"
                                    placeholder="Share your thoughts about this product..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                    required></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:bg-primary-hover transition-all">
                                Submit Review
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="bg-green-50 text-green-700 p-6 rounded-2xl text-center">
                        <i class="fas fa-check-circle text-3xl mb-3"></i>
                        <p class="font-semibold">Review Submitted</p>
                        <p class="text-sm">Thank you for your feedback!</p>
                    </div>
                    @endif
                    @else
                    <div class="bg-gray-50 text-gray-600 p-6 rounded-2xl text-center">
                        <i class="fas fa-lock text-3xl mb-3"></i>
                        <p class="font-semibold">Purchase to Review</p>
                        <p class="text-sm">Only verified buyers can review this product</p>
                    </div>
                    @endif
                    @else
                    <div class="bg-primary/5 text-primary p-6 rounded-2xl text-center">
                        <i class="fas fa-user-circle text-3xl mb-3"></i>
                        <p class="font-semibold">Login to Review</p>
                        <p class="text-sm mb-4">Share your experience with others</p>
                        <a href="{{ url('/login') }}"
                            class="inline-block bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-hover transition-all">
                            Sign In
                        </a>
                    </div>
                    @endauth
                </div>
            </div>

            <!-- Reviews List -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    @forelse($product->reviews as $review)
                    <div class="bg-white rounded-3xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg mr-4">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900">{{ $review->user->name }}</h5>
                                    <div class="flex items-center text-sm text-gray-500">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                            @endfor
                                            <span class="ml-2">{{ $review->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-3 py-1 rounded-full">
                                Verified Purchase
                            </span>
                        </div>
                        <p class="text-gray-700 leading-relaxed">"{{ $review->comment }}"</p>
                        @if($review->created_at->diffInDays(now()) < 7)
                            <span class="inline-block mt-3 bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">
                            New Review
                            </span>
                            @endif
                    </div>
                    @empty
                    <div class="bg-white rounded-3xl p-12 text-center">
                        <i class="fas fa-comment text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Reviews Yet</h3>
                        <p class="text-gray-500">Be the first to share your experience!</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Floating Cart Button -->
<a href="{{ route('cart.index') }}" class="floating-cart-btn tooltip" data-tooltip="View Cart">
    <i class="fas fa-shopping-cart text-xl"></i>
    <span id="floating-cart-count" class="notification-badge">
        {{ $cartCount ?? 0 }}
    </span>
</a>

<!-- Image Modal -->
<div id="image-modal" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-6xl max-h-[90vh]">
        <button id="close-modal" class="absolute top-4 right-4 text-white text-3xl z-10">
            <i class="fas fa-times"></i>
        </button>
        <img id="modal-image" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain rounded-lg">
    </div>
</div>

@endsection

@push("script")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let selectedColor = null;
    let selectedSize = null;
    let quantity = 1;
    let isAddingToCart = false;

    document.addEventListener('DOMContentLoaded', function() {
        initializeProductPage();
        initializeEventListeners();
        loadProductData();
    });

    function initializeProductPage() {
        // Initialize product data from Laravel
        const product = @json($product);

        // Load product images
        loadProductImages(product);

        // Load color options
        if (product.colors && product.colors.length > 0) {
            loadColorOptions(product.colors);
            selectColor(product.colors[0]);
        } else {
            document.getElementById('color-section').style.display = 'none';
        }

        // Load size options
        if (product.sizes && product.sizes.length > 0) {
            loadSizeOptions(product.sizes);

            // Try to select first available size
            const firstAvailableSize = product.sizes.find(size => size.stock > 0);
            if (firstAvailableSize) {
                selectSize(firstAvailableSize);
            } else {
                // If no sizes have stock, show out of stock message
                document.getElementById('selected-size-name').textContent = 'Select a size';
                updateStockStatus({
                    stock: 0
                });
            }
        } else {
            document.getElementById('size-section').style.display = 'none';
            // If no sizes, use product stock
            updateStockStatus(product);
        }

        updateQuantityDisplay();

        updateCartCount();
    }

    function loadProductData() {
        console.log('Product loaded');
    }

    function initializeEventListeners() {
        // Quantity controls
        document.getElementById('increase-qty').addEventListener('click', increaseQuantity);
        document.getElementById('decrease-qty').addEventListener('click', decreaseQuantity);

        // Action buttons
        document.getElementById('add-to-cart').addEventListener('click', addToCart);
        document.getElementById('buy-now').addEventListener('click', buyNow);

        // Favorite button
        document.getElementById('favorite-btn').addEventListener('click', toggleFavorite);

        // Image modal
        document.getElementById('main-image').addEventListener('click', openImageModal);
        document.getElementById('close-modal').addEventListener('click', closeImageModal);
        document.getElementById('image-modal').addEventListener('click', function(e) {
            if (e.target === this) closeImageModal();
        });

        // Size guide
        document.getElementById('size-guide').addEventListener('click', showSizeGuide);

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeImageModal();
            if (e.key === '+' && e.ctrlKey) {
                e.preventDefault();
                increaseQuantity();
            }
            if (e.key === '-' && e.ctrlKey) {
                e.preventDefault();
                decreaseQuantity();
            }
        });

        // Star rating for review form
        initializeStarRating();
    }

    function loadProductImages(product) {
        const mainImage = document.getElementById('main-image');
        const thumbnailsContainer = document.getElementById('thumbnails-container');

        if (!thumbnailsContainer) return;

        // Set main image
        if (product.images && product.images.length > 0) {
            mainImage.src = '{{ asset("storage/app/public/") }}/' + product.images[0].image_path;
        }

        // Create thumbnails
        thumbnailsContainer.innerHTML = '';

        product.images.forEach((img, index) => {
            const thumbDiv = document.createElement('div');
            thumbDiv.className = `gallery-thumb ${index === 0 ? 'active' : ''}`;
            thumbDiv.style.cursor = 'pointer';

            const thumbImg = document.createElement('img');
            thumbImg.src = '{{ asset("storage/app/public/") }}/' + img.image_path;
            thumbImg.alt = `${product.name} - Image ${index + 1}`;
            thumbImg.className = 'w-full h-24 object-cover rounded-lg';

            thumbDiv.appendChild(thumbImg);

            thumbDiv.addEventListener('click', function() {
                // Update main image
                mainImage.src = thumbImg.src;

                // Update active thumbnail
                document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });

            thumbnailsContainer.appendChild(thumbDiv);
        });
    }

    function loadColorOptions(colors) {
        const container = document.getElementById('color-options');
        if (!container) return;

        container.innerHTML = '';

        colors.forEach(color => {
            const colorDiv = document.createElement('div');
            colorDiv.className = 'color-option w-12 h-12 rounded-full cursor-pointer shadow-md';
            colorDiv.style.backgroundColor = color.hex_code || '#cccccc';
            colorDiv.dataset.colorId = color.id;
            colorDiv.title = color.name;

            colorDiv.addEventListener('click', () => selectColor(color));
            container.appendChild(colorDiv);
        });
    }

    function selectColor(color) {
        selectedColor = color;

        // Update UI
        document.getElementById('selected-color-name').textContent = color.name;
        document.getElementById('selected-color-hex').textContent = color.hex_code;

        document.querySelectorAll('.color-option').forEach(option => {
            option.classList.remove('selected');
            if (parseInt(option.dataset.colorId) === color.id) {
                option.classList.add('selected');
            }
        });

        if (color.images && color.images.length > 0) {
            const mainImage = document.getElementById('main-image');
            mainImage.src = '{{ asset("storage/app/public/") }}/' + color.images[0].image_path;
        }

        showNotification(`Color selected: ${color.name}`, 'success');
    }

    function loadSizeOptions(sizes) {
        const container = document.getElementById('size-options');
        if (!container) return;

        container.innerHTML = '';

        let firstInStockSize = null;

        sizes.forEach(size => {
            const sizeBtn = document.createElement('button');
            sizeBtn.type = 'button';

            // Check if this size has stock
            const hasStock = size.stock > 0;

            sizeBtn.className = `size-option px-6 py-3 rounded-lg border-2 font-medium transition-all duration-300 
                           ${!hasStock ? 'out-of-stock bg-gray-100 text-gray-400 border-gray-300 cursor-not-allowed' : 
                           'bg-white text-gray-800 border-gray-300 hover:border-primary hover:bg-primary/5 hover:text-primary'}`;
            sizeBtn.textContent = size.name;
            sizeBtn.dataset.sizeId = size.id;

            // Save the first in-stock size
            if (hasStock && !firstInStockSize) {
                firstInStockSize = size;
            }

            // Add event listener for ALL sizes (including out of stock)
            sizeBtn.addEventListener('click', () => {
                if (hasStock) {
                    selectSize(size);
                } else {
                    showNotification('This size is out of stock', 'warning');
                }
            });

            container.appendChild(sizeBtn);
        });

        // Automatically select the first in-stock size
        if (firstInStockSize) {
            selectSize(firstInStockSize);
        }
    }

    function selectSize(size) {
        selectedSize = size;

        // Update UI text
        document.getElementById('selected-size-name').textContent = size.name;

        // Update selected state visually
        document.querySelectorAll('.size-option').forEach(option => {
            // Remove selected class from all options
            option.classList.remove('selected', 'bg-primary', 'text-white');

            // Reset styles for in-stock options
            if (!option.classList.contains('out-of-stock')) {
                option.classList.add('bg-white', 'text-gray-800', 'border-gray-300');
            }

            // Add selected class to the clicked option (if it has stock)
            if (parseInt(option.dataset.sizeId) === size.id) {
                if (size.stock > 0) {
                    option.classList.add('selected', 'bg-primary', 'text-white');
                    option.classList.remove('bg-white', 'text-gray-800', 'border-gray-300');
                }
            }
        });

        updatePriceDisplay();

        updateStockStatus(size);

        updateQuantityDisplay();

        showNotification(`Size selected: ${size.name}`, 'success');
    }

    function updatePriceDisplay() {
        const product = @json($product);
        const priceElement = document.getElementById('product-price');
        let price = product.offer_price || product.price;

        // If selected size has specific price, use that
        if (selectedSize && selectedSize.price) {
            price = selectedSize.price;
        }

        priceElement.textContent = `Rs.${parseFloat(price).toFixed(2)}`;
    }

    function updateStockStatus(item) {
        const stockStatus = document.getElementById('stock-status');
        const progressBar = document.querySelector('.progress-bar');

        if (!item) {
            stockStatus.innerHTML = '<i class="fas fa-times-circle mr-1"></i> Out of Stock';
            stockStatus.className = 'text-sm font-semibold text-red-600';
            progressBar.style.width = '0%';
            return;
        }

        const stockQuantity = item.stock || 0;

        if (stockQuantity > 10) {
            stockStatus.innerHTML = '<i class="fas fa-check-circle mr-1"></i> In Stock';
            stockStatus.className = 'text-sm font-semibold text-green-600';
            progressBar.style.width = '100%';
        } else if (stockQuantity > 0) {
            stockStatus.innerHTML = `<i class="fas fa-exclamation-triangle mr-1"></i> Low Stock (${stockQuantity} left)`;
            stockStatus.className = 'text-sm font-semibold text-yellow-600';
            progressBar.style.width = `${(stockQuantity / 10) * 100}%`;
        } else {
            stockStatus.innerHTML = '<i class="fas fa-times-circle mr-1"></i> Out of Stock';
            stockStatus.className = 'text-sm font-semibold text-red-600';
            progressBar.style.width = '0%';
        }
    }

    function increaseQuantity() {
        const product = @json($product);

        // Get max quantity based on selected size or product stock
        let maxQuantity;
        if (product.sizes && product.sizes.length > 0) {
            // If product has sizes
            if (selectedSize) {
                maxQuantity = selectedSize.stock;
            } else {
                maxQuantity = 0; // No size selected
            }
        } else {
            // If product doesn't have sizes
            maxQuantity = product.stock_quantity;
        }

        const maxAllowed = Math.min(maxQuantity, 10);

        if (quantity < maxAllowed) {
            quantity++;
            updateQuantityDisplay();
        } else {
            showNotification(`Maximum quantity is ${maxAllowed}`, 'warning');
        }
    }

    function decreaseQuantity() {
        if (quantity > 1) {
            quantity--;
            updateQuantityDisplay();
        }
    }

    function updateQuantityDisplay() {
        const quantityElement = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decrease-qty');
        const increaseBtn = document.getElementById('increase-qty');
        const product = @json($product);

        quantityElement.textContent = quantity;
        decreaseBtn.disabled = quantity <= 1;

        // Get max quantity based on selected size or product stock
        let maxQuantity;
        if (product.sizes && product.sizes.length > 0) {
            // If product has sizes
            if (selectedSize) {
                maxQuantity = selectedSize.stock;
            } else {
                maxQuantity = 0; // No size selected
            }
        } else {
            // If product doesn't have sizes
            maxQuantity = product.stock_quantity;
        }

        const maxAllowed = Math.min(maxQuantity, 10);
        increaseBtn.disabled = quantity >= maxAllowed;

        // Also disable/enable add to cart and buy now buttons
        const addToCartBtn = document.getElementById('add-to-cart');
        const buyNowBtn = document.getElementById('buy-now');

        if (product.sizes && product.sizes.length > 0 && !selectedSize) {
            // If product has sizes but none selected, disable buttons
            addToCartBtn.disabled = true;
            buyNowBtn.disabled = true;
            addToCartBtn.classList.add('opacity-50', 'cursor-not-allowed');
            buyNowBtn.classList.add('opacity-50', 'cursor-not-allowed');
        } else {
            addToCartBtn.disabled = false;
            buyNowBtn.disabled = false;
            addToCartBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            buyNowBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }
    async function addToCart() {
        if (isAddingToCart) return;

        const product = @json($product);

        // Validate selection
        if (product.colors && product.colors.length > 0 && !selectedColor) {
            showNotification('Please select a color', 'warning');
            return;
        }

        if (product.sizes && product.sizes.length > 0 && !selectedSize) {
            showNotification('Please select a size', 'warning');
            return;
        }

        // Check if selected size is out of stock
        if (selectedSize && selectedSize.stock <= 0) {
            showNotification('Selected size is out of stock', 'warning');
            return;
        }

        // Check stock quantity
        let availableStock;
        if (product.sizes && product.sizes.length > 0) {
            availableStock = selectedSize ? selectedSize.stock : 0;
        } else {
            availableStock = product.stock_quantity;
        }

        if (availableStock < quantity) {
            showNotification(`Only ${availableStock} items available in stock`, 'warning');
            return;
        }

        // Rest of the function remains the same...
        isAddingToCart = true;
        // ... existing code ...

        // ... existing code ...

        // Show loading state
        const addBtn = document.getElementById('add-to-cart');
        const originalText = addBtn.innerHTML;
        addBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Adding...';
        addBtn.disabled = true;

        // Prepare data
        const cartData = {
            product_id: product.id,
            size_id: selectedSize ? selectedSize.id : null,
            color_id: selectedColor ? selectedColor.id : null,
            quantity: quantity
        };

        try {
            const response = await fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(cartData)
            });

            const data = await response.json();

            if (data.success) {
                // Show success animation
                addBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Added!';
                addBtn.classList.add('bg-green-600');

                // Update cart count
                updateCartCount();

                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart!',
                    html: `
                    <div class="text-center">
                        <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
                        <p class="text-lg font-semibold mb-2">${product.name}</p>
                        <div class="space-y-1 text-gray-600">
                            <p>Quantity: ${quantity}</p>
                            ${selectedColor ? `<p>Color: ${selectedColor.name}</p>` : ''}
                            ${selectedSize ? `<p>Size: ${selectedSize.name}</p>` : ''}
                        </div>
                    </div>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'View Cart',
                    cancelButtonText: 'Continue Shopping',
                    confirmButtonColor: 'var(--primary-color)',
                    cancelButtonColor: '#6b7280',
                    backdrop: true,
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '{{ route("cart.index") }}';
                    }
                });

            } else {
                throw new Error(data.message || 'Failed to add to cart');
            }

        } catch (error) {
            console.error('Error adding to cart:', error);
            showNotification(error.message || 'Failed to add to cart', 'error');

            // Show error state
            addBtn.innerHTML = '<i class="fas fa-exclamation-circle mr-2"></i> Try Again';
            addBtn.classList.add('bg-red-600');

            setTimeout(() => {
                addBtn.classList.remove('bg-red-600');
            }, 2000);

        } finally {
            // Reset button after 1 second
            setTimeout(() => {
                addBtn.innerHTML = originalText;
                addBtn.disabled = false;
                addBtn.classList.remove('bg-green-600', 'bg-red-600');
                isAddingToCart = false;
            }, 1000);
        }
    }

    async function buyNow() {
        const product = @json($product);

        // Validate selection
        if (product.colors && product.colors.length > 0 && !selectedColor) {
            showNotification('Please select a color', 'warning');
            return;
        }

        if (product.sizes && product.sizes.length > 0 && !selectedSize) {
            showNotification('Please select a size', 'warning');
            return;
        }

        // Check stock
        if (selectedSize && selectedSize.stock < quantity) {
            showNotification(`Only ${selectedSize.stock} items available in stock`, 'warning');
            return;
        }

        // Show loading
        const buyBtn = document.getElementById('buy-now');
        const originalText = buyBtn.innerHTML;
        buyBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
        buyBtn.disabled = true;

        // Prepare data
        const orderData = {
            product_id: product.id,
            size_id: selectedSize ? selectedSize.id : null,
            color_id: selectedColor ? selectedColor.id : null,
            quantity: quantity
        };

        try {
            const response = await fetch('{{ route("buy.now") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(orderData)
            });

            const data = await response.json();

            if (data.success) {
                // Redirect to checkout
                window.location.href = data.redirect_url || '{{ route("checkout.index") }}';
            } else {
                throw new Error(data.message || 'Failed to process buy now');
            }

        } catch (error) {
            console.error('Error processing buy now:', error);
            showNotification(error.message || 'Failed to process buy now', 'error');

            // Reset button
            buyBtn.innerHTML = originalText;
            buyBtn.disabled = false;
        }
    }

    function toggleFavorite() {
        const favoriteBtn = document.getElementById('favorite-btn');
        const heartIcon = favoriteBtn.querySelector('i');

        if (heartIcon.classList.contains('far')) {
            // Add to favorites
            heartIcon.classList.remove('far');
            heartIcon.classList.add('fas', 'text-red-500');
            favoriteBtn.classList.add('bg-red-50');
            showNotification('Added to favorites', 'success');

            // Animate button
            favoriteBtn.style.transform = 'scale(1.2)';
            setTimeout(() => {
                favoriteBtn.style.transform = 'scale(1)';
            }, 300);

        } else {
            // Remove from favorites
            heartIcon.classList.remove('fas', 'text-red-500');
            heartIcon.classList.add('far', 'text-gray-400');
            favoriteBtn.classList.remove('bg-red-50');
            showNotification('Removed from favorites', 'info');
        }
    }

    function updateCartCount() {
        fetch('{{ route("cart.count") }}')
            .then(response => response.json())
            .then(data => {
                const cartCount = document.getElementById('floating-cart-count');
                if (cartCount) {
                    cartCount.textContent = data.count;
                    if (data.count > 0) {
                        cartCount.style.display = 'flex';
                    } else {
                        cartCount.style.display = 'none';
                    }
                }
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg animate-slide-in 
                            ${type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' :
                              type === 'error' ? 'bg-red-100 text-red-800 border border-red-200' :
                              type === 'warning' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' :
                              'bg-blue-100 text-blue-800 border border-blue-200'}`;
        notification.innerHTML = `
        <div class="flex items-center">
            <i class="${type === 'success' ? 'fas fa-check-circle' :
                       type === 'error' ? 'fas fa-exclamation-circle' :
                       type === 'warning' ? 'fas fa-exclamation-triangle' :
                       'fas fa-info-circle'} mr-3"></i>
            <span class="font-medium">${message}</span>
        </div>
    `;

        document.body.appendChild(notification);

        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    function openImageModal() {
        const modal = document.getElementById('image-modal');
        const modalImage = document.getElementById('modal-image');
        const mainImage = document.getElementById('main-image');

        modalImage.src = mainImage.src;
        modalImage.alt = mainImage.alt;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        const modal = document.getElementById('image-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function showSizeGuide() {
        Swal.fire({
            title: 'Size Guide',
            html: `
            <div class="text-left">
                <h4 class="font-bold text-gray-800 mb-3">How to Choose the Right Size</h4>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-ruler mr-2 text-primary"></i> Measure the space where the item will be placed</li>
                    <li><i class="fas fa-tape mr-2 text-primary"></i> Compare with the dimensions provided</li>
                    <li><i class="fas fa-check-circle mr-2 text-primary"></i> Consider the item's purpose and placement</li>
                </ul>
                <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Need more help? <a href="#" class="text-primary hover:underline">Contact our support team</a></p>
                </div>
            </div>
        `,
            icon: 'info',
            confirmButtonText: 'Got it!',
            confirmButtonColor: 'var(--primary-color)'
        });
    }

    function initializeStarRating() {
        const starRating = document.getElementById('star-rating');
        if (!starRating) return;

        const stars = starRating.querySelectorAll('i');
        const ratingInput = document.getElementById('selected-rating');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                ratingInput.value = rating;

                // Update stars display
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.remove('far');
                        s.classList.add('fas', 'text-yellow-400');
                    } else {
                        s.classList.remove('fas', 'text-yellow-400');
                        s.classList.add('far');
                    }
                });
            });

            star.addEventListener('mouseover', function() {
                const rating = parseInt(this.dataset.rating);
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.remove('far');
                        s.classList.add('fas', 'text-yellow-300');
                    }
                });
            });

            star.addEventListener('mouseout', function() {
                const currentRating = ratingInput.value || 0;
                stars.forEach((s, index) => {
                    if (index < currentRating) {
                        s.classList.remove('far');
                        s.classList.add('fas', 'text-yellow-400');
                    } else {
                        s.classList.remove('fas', 'text-yellow-300');
                        s.classList.add('far');
                    }
                });
            });
        });
    }

    // Quick add for related products
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-to-cart-btn')) {
            const productCard = e.target.closest('.product-card');
            const productId = productCard ? productCard.dataset.productId : null;
            if (productId) {
                addRelatedToCart(productId);
            }
        }
    });

    async function addRelatedToCart(productId) {
        try {
            const response = await fetch(`/products/${productId}/quick-add`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                showNotification('Product added to cart!', 'success');
                updateCartCount();
            } else {
                showNotification(data.message, 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Failed to add product to cart', 'error');
        }
    }

    // Initialize when page loads
    window.addEventListener('load', function() {
        console.log('Product detail page loaded');

        document.querySelectorAll('.product-card').forEach((card, index) => {
            card.dataset.productId = index + 1;
        });
    });
</script>
@endpush