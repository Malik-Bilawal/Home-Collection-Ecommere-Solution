<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeCollection - Premium Home Decor</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
        
            --card-background: #FFFFFF;
        }

/* 
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--background-color);
            overflow-x: hidden;
        } */

        /* Glass morphism effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(139, 95, 191, 0.05);
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 10px;
        }

        /* Floating animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* Shimmer effect for loading */
        .shimmer {
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.8) 50%,
                    rgba(255, 255, 255, 0) 100%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* Slide in animation */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in-right {
            animation: slideInRight 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Pulse animation for cart */
        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 5px var(--secondary-color);
            }

            50% {
                box-shadow: 0 0 20px var(--secondary-color), 0 0 30px rgba(255, 107, 139, 0.3);
            }
        }

        .pulse-glow {
            animation: pulse-glow 2s infinite;
        }

        /* Navbar link hover effect */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: width 0.3s ease;
        }

        .nav-link:hover::before {
            width: 100%;
        }

        /* Button hover effect */
        .btn-hover-effect {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-hover-effect::before {
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
            transition: left 0.7s;
            z-index: -1;
        }

        .btn-hover-effect:hover::before {
            left: 100%;
        }

        /* Drawer animations */
        .drawer-overlay {
            backdrop-filter: blur(5px);
            background: rgba(0, 0, 0, 0.5);
        }

        /* Category icon hover */
        .category-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-icon:hover {
            transform: scale(1.1) rotate(5deg);
        }

        /* Product card hover */
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Search input glow */
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(139, 95, 191, 0.1),
                0 0 20px rgba(139, 95, 191, 0.2);
        }

        /* Loading dots */
        .loading-dots {
            display: inline-flex;
            align-items: center;
        }

        .loading-dots span {
            width: 8px;
            height: 8px;
            margin: 0 2px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            animation: dotPulse 1.5s infinite ease-in-out;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loading-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes dotPulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(0.5);
                opacity: 0.5;
            }
        }

        /* Gradient border */
        .gradient-border {
            position: relative;
            background: linear-gradient(var(--card-background), var(--card-background)) padding-box,
                linear-gradient(135deg, var(--primary-color), var(--secondary-color)) border-box;
            border: 2px solid transparent;
        }

        /* Notification badge */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, #FF6B8B, #FF8E53);
            color: white;
            font-size: 11px;
            font-weight: bold;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-3px);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .mobile-menu {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(10px);
            }

            .search-drawer {
                width: 90% !important;
                max-width: 100% !important;
            }
        }

        /* Smooth transitions */
        .transition-all-custom {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': 'var(--primary-color)',
                        'primary-hover': 'var(--primary-hover)',
                        'secondary': 'var(--secondary-color)',
                        'secondary-hover': 'var(--secondary-hover)',
                        'accent': 'var(--accent-color)',
                        'accent-hover': 'var(--accent-hover)',
                        'background': 'var(--background-color)',
                        'card': 'var(--card-background)',
                        'border': 'var(--border-color)'
                    },
                    fontFamily: {
                        'sans': ['Outfit', 'system-ui', 'sans-serif'],
                        'heading': ['Poppins', 'system-ui', 'sans-serif']
                    },
                    animation: {
                        'float': 'float 3s ease-in-out infinite',
                        'pulse-glow': 'pulse-glow 2s infinite',
                        'shimmer': 'shimmer 1.5s infinite',
                        'slide-in-right': 'slideInRight 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)',
                        'bounce': 'bounce 2s infinite',
                        'dot-pulse': 'dotPulse 1.5s infinite ease-in-out'
                    },
                    boxShadow: {
                        'glass': '0 8px 32px rgba(31, 38, 135, 0.1)',
                        'hover': '0 20px 40px rgba(0, 0, 0, 0.1)',
                        'glow': '0 0 20px rgba(139, 95, 191, 0.2)',
                        'inner-glow': 'inset 0 0 20px rgba(139, 95, 191, 0.1)'
                    },
                    backdropBlur: {
                        'xs': '2px',
                        'sm': '4px',
                        'md': '8px',
                        'lg': '12px',
                        'xl': '20px'
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans bg-background">


<div class="w-full bg-[var(--primary-color)] text-[var(--text-on-primary)] text-xs uppercase tracking-widest overflow-hidden select-none z-50 fixed top-0 left-0">
    <div class="marquee flex whitespace-nowrap gap-12 px-4 py-1 animate-marquee">
        <span>World Wide Shipping</span>
        <span class="text-[var(--secondary-color)]">•</span>
        <span>Premium Quality</span>
        <span class="text-[var(--secondary-color)]">•</span>
        <span>30-Day Returns</span>

        <!-- Duplicate for smooth scroll -->
        <span>World Wide Shipping</span>
        <span class="text-[var(--secondary-color)]">•</span>
        <span>Premium Quality</span>
        <span class="text-[var(--secondary-color)]">•</span>
        <span>30-Day Returns</span>
    </div>
</div>
<nav 
    x-data="{ mobileMenuOpen: false, searchOpen: false }"
    class="fixed top-0 left-0 right-0 z-50 bg-[#FBF7EE]/80 top-[20px] backdrop-blur-xl border-b border-[#E2DBD1] transition-all duration-500"
>
    <div class="h-1 w-full bg-gradient-to-r from-[#680626] via-[#B89A6B] to-[#680626]"></div>

    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
        
        <a href="{{ route('home') }}" class="flex items-center group">
            <div class="relative flex items-center justify-center w-12 h-12 rounded-full bg-[#680626] text-white shadow-2xl transition-transform duration-500 group-hover:rotate-[360deg]">
                <i class="fas fa-crown text-lg"></i>
            </div>
            <span class="ml-3 font-serif text-2xl tracking-tighter text-[#680626] hidden sm:block">
                MAISON <span class="italic font-light text-[#B89A6B]">ELITE</span>
            </span>
        </a>

        <div class="hidden lg:flex items-center bg-white/40 px-2 py-1.5 rounded-full border border-[#E2DBD1] shadow-inner">
            @php
                $navLinks = [
                    ['route' => 'home', 'label' => 'Home', 'icon' => 'fa-home'],
                    ['route' => 'product', 'label' => 'Boutique', 'icon' => 'fa-shopping-bag'],
                    ['route' => 'category', 'label' => 'Collections', 'icon' => 'fa-gem'],
                    ['route' => 'about', 'label' => 'Heritage', 'icon' => 'fa-leaf'],
                    ['route' => 'contact', 'label' => 'Concierge', 'icon' => 'fa-envelope'],
                ];
            @endphp
            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                    class="px-6 py-2.5 text-[11px] uppercase tracking-[0.2em] font-bold text-gray-600 rounded-full hover:bg-[#680626] hover:text-white transition-all duration-500 flex items-center">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-4">
            
            <button id="search-button"
            class="group flex items-center pl-3 pr-4 py-2 rounded-full bg-white border border-[#E5D5C3] hover:border-[#6B4226] transition-colors duration-300">
            <i class="fas fa-search text-[#6B4226] text-sm group-hover:scale-110 transition-transform"></i>
            <span class="hidden md:inline ml-2 text-sm font-medium text-gray-500 group-hover:text-[#6B4226]">Search</span>
            <span class="ml-2 px-1.5 py-0.5 text-[10px] font-bold bg-[#F8F5F2] text-gray-400 rounded border border-[#E5D5C3]">⌘K</span>
            </button>

            <a href="{{ route('cart.index') }}"
                class="relative w-11 h-11 flex items-center justify-center rounded-full bg-white border border-[#E2DBD1] text-[#680626] hover:bg-[#680626] hover:text-white transition-all duration-500 shadow-sm">
                <i class="fas fa-shopping-cart text-sm"></i>

                @php
                    $cartCount = 0;
                    if (auth()->check()) {
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                    } else {
                        $guestToken = session()->get('guest_token');
                        if ($guestToken) {
                            $cartCount = \App\Models\Cart::where('guest_token', $guestToken)->sum('quantity');
                        } else {
                            $sessionCart = session('cart', []);
                            $cartCount = collect($sessionCart)->sum('quantity') ?: count($sessionCart);
                        }
                    }
                @endphp

                @if($cartCount > 0)
                <span class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center bg-[#B89A6B] text-white text-[9px] font-bold rounded-full border-2 border-[#FBF7EE]">
                    {{ $cartCount > 99 ? '99+' : $cartCount }}
                </span>
                @endif
            </a>

            <div class="relative inline-block text-left">
    <button onclick="toggleUserMenu()" id="user-menu-btn" 
        class="w-11 h-11 flex items-center justify-center rounded-full bg-white border border-[#E2DBD1] text-[#680626] hover:shadow-lg transition-all duration-300">
        <i class="fas fa-user text-sm"></i> 
    </button>

    <div id="user-menu-dropdown" 
        class="hidden absolute right-0 mt-4 w-72 bg-white rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-[#E2DBD1] overflow-hidden z-[999]">

        @auth
        <div class="p-6 text-center border-b border-[#FBF7EE] bg-[#FBF7EE]/50">
            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-gradient-to-tr from-[#680626] to-[#B89A6B] p-1 shadow-lg">
                <div class="w-full h-full rounded-full bg-white flex items-center justify-center text-[#680626] font-serif text-xl">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
            <p class="font-serif text-lg text-[#1A1A1A]">{{ auth()->user()->name }}</p>
            <p class="text-[10px] uppercase tracking-widest text-[#B89A6B]">{{ auth()->user()->email }}</p>
        </div>

        <div class="p-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-[11px] uppercase tracking-widest font-bold text-gray-500 hover:bg-red-50 hover:text-red-600 transition-all rounded-xl">
                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                </button>
            </form>
        </div>
        @else
        <div class="p-6">
            <p class="text-[10px] font-bold text-[#B89A6B] uppercase tracking-[0.3em] mb-4 text-center">Membership</p>
            <div class="space-y-3">
                <a href="{{ route('user.login') }}" class="block w-full text-center bg-[#680626] text-white py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-[#52041E] transition-all">Login</a>
                <a href="{{ route('user.register') }}" class="block w-full text-center border border-[#680626] text-[#680626] py-3 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-[#680626] hover:text-white transition-all">Join Now</a>
            </div>
        </div>
        @endauth
    </div>
</div>

<script>
    function toggleUserMenu() {
        const menu = document.getElementById('user-menu-dropdown');
        menu.classList.toggle('hidden');
    }

    // Optional: Close if clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('user-menu-dropdown');
        const btn = document.getElementById('user-menu-btn');
        
        // If the click happened outside the menu AND outside the button
        if (!menu.contains(event.target) && !btn.contains(event.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-11 h-11 flex items-center justify-center rounded-full bg-[#680626] text-white">
                <i class="fas" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
            </button>
        </div>
    </div>


    <!-- MOBILE MENU - FIXED VERSION -->
    <div x-show="mobileMenuOpen"
     class="fixed inset-0 z-[9999] lg:hidden"
     x-transition:enter="transition-opacity duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <!-- overlay -->
    <div class="absolute inset-0 bg-black/50" @click="mobileMenuOpen = false"></div>

    <!-- slide-in menu -->
    <nav class="absolute right-0 top-0 bottom-0 w-[80%] max-w-sm bg-[#FBF7EE] shadow-2xl p-8 flex flex-col"
         x-transition:enter="transition transform duration-500 ease-out"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition transform duration-500 ease-in"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full">
            <div class="mb-12">
                <p class="text-[10px] uppercase tracking-[0.5em] text-[#B89A6B] font-bold mb-8">Navigation</p>
                <div class="space-y-4">
                    @foreach($navLinks as $link)
                        <a href="{{ route($link['route']) }}" 
                           class="flex items-center text-2xl font-serif text-[#680626] bg-white px-6 py-4 w-full rounded-lg hover:bg-gray-50 transition-all duration-300">
                            <span class="mr-4 text-xs text-[#B89A6B]">0{{ $loop->iteration }}</span>
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mt-auto pt-8 border-t border-[#E2DBD1]">
                @guest
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('user.login') }}" class="text-center bg-[#680626] text-white py-4 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-[#52041E] transition-all">Login</a>
                        <a href="{{ route('user.register') }}" class="text-center border border-[#680626] text-[#680626] py-4 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-[#680626] hover:text-white transition-all">Join</a>
                    </div>
                @endguest
            </div>
        </nav>
    </div>
</nav>

<div class="h-20"></div>
    <!-- Search Drawer -->
    <div id="search-drawer"
        class="fixed inset-y-0 right-0 w-full md:w-3/4 lg:w-1/2 xl:w-2/5 bg-card shadow-2xl transform translate-x-full z-[60] transition-transform duration-500 ease-out">
        <div class="h-full flex flex-col">
            <!-- Drawer Header -->
            <div class="p-6 border-b border-border">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-xl bg-gradient-to-br from-primary to-secondary">
                            <i class="fas fa-search text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-heading font-bold text-gray-800">Discover Products</h2>
                            <p class="text-sm text-gray-500">Search across 10,000+ home decor items</p>
                        </div>
                    </div>
                    <button id="close-search"
                        class="p-3 rounded-xl hover:bg-gray-100 transition-all duration-200">
                        <i class="fas fa-times text-xl text-gray-500 hover:text-gray-700"></i>
                    </button>
                </div>
            </div>

            <!-- Search Input Section -->
            <div class="p-6 border-b border-border bg-gradient-to-r from-gray-50 to-white">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
                    <input type="text"
                        id="search-input"
                        placeholder="Search furniture, decor, lighting, textiles..."
                        class="search-input w-full pl-12 pr-20 py-4 rounded-2xl border-2 border-border bg-white focus:outline-none focus:border-primary transition-all duration-300 shadow-sm">
                    <div class="absolute right-2 top-1/2 transform -translate-y-1/2 flex items-center space-x-2">
                        <kbd class="px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded-md hidden md:inline">⌘K</kbd>
                        <span id="results-count" class="text-sm text-gray-500 hidden">0 results</span>
                    </div>
                </div>
            </div>

            <!-- Drawer Content -->
            <div class="flex-1 overflow-hidden">
                <!-- Loading State -->
                <div id="search-loading" class="hidden p-8">
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div class="loading-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <p class="text-gray-500">Searching our collection...</p>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="search-empty" class="hidden p-8">
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <i class="fas fa-search text-gray-400 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700">No results found</h3>
                        <p class="text-gray-500 text-center">Try different keywords or browse categories below</p>
                    </div>
                </div>

                <!-- Main Content Container -->
                <div class="h-full overflow-y-auto custom-scrollbar p-6">
                    <!-- Results Section (Initially hidden) -->
                    <div id="search-results" class="space-y-6 hidden">
                        <!-- Results will be populated here -->
                    </div>

                    <!-- Default Content (Visible when no search) -->
                    <div id="search-default-content">
                        <!-- Recent Searches -->
                        <div id="recent-searches-section" class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800">Recent Searches</h3>
                                <button id="clear-recent" class="text-sm text-gray-500 hover:text-red-500 transition-colors">
                                    Clear all
                                </button>
                            </div>
                            <div id="recent-searches-list" class="space-y-2">
                                <!-- Recent searches will be loaded here -->
                            </div>
                        </div>

                        <!-- Trending Now -->
                        <div id="trending-section" class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">🔥 Trending Now</h3>
                            <div id="trending-products" class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <!-- Trending products will be loaded here -->
                            </div>
                        </div>

                        <!-- Popular Categories -->
                        <div id="categories-section">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">✨ Popular Categories</h3>
                            <div id="categories-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <!-- Categories will be loaded here -->
                            </div>
                        </div>

                        <!-- Quick Suggestions -->
                        <div id="suggestions-section" class="mt-8 pt-6 border-t border-border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">💡 Quick Suggestions</h3>
                            <div class="flex flex-wrap gap-2">
                                <!-- Suggestions will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Drawer Footer -->
            <div class="p-4 border-t border-border bg-gray-50">
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <div class="flex items-center space-x-4">
                        <span><i class="fas fa-shipping-fast mr-1"></i> Free shipping over $50</span>
                        <span><i class="fas fa-shield-alt mr-1"></i> Secure checkout</span>
                    </div>
                    <span><i class="fas fa-bolt mr-1"></i> Live search powered by AI</span>
                </div>
            </div>
        </div>
    </div>


    @php
    $categories = \App\Models\Category::where('status', 1)
        ->limit(6)
        ->get();
@endphp
    <!-- Overlay -->
    <div id="search-overlay"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[55] opacity-0 pointer-events-none transition-opacity duration-300 drawer-overlay"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize variables
            let searchTimeout = null;
            let recentSearches = JSON.parse(localStorage.getItem('homecollection_recent_searches')) || [];
            let isSearching = false;

            // User dropdown toggle
            $('#userMenuButton').on('click', function(e) {
                e.stopPropagation();
                $('#userMenuDropdown').toggleClass('hidden');
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#userMenuButton, #userMenuDropdown').length) {
                    $('#userMenuDropdown').addClass('hidden');
                }
            });

            // Mobile menu toggle
            $('#mobile-menu-button').on('click', function() {
                $('#mobile-menu').toggleClass('hidden');
            });

            // Search drawer functionality
            const searchButton = $('#search-button');
            const searchDrawer = $('#search-drawer');
            const closeSearch = $('#close-search');
            const overlay = $('#search-overlay');

            function openSearchDrawer() {
                searchDrawer.removeClass('translate-x-full');
                overlay.removeClass('opacity-0 pointer-events-none');
                overlay.addClass('opacity-100 pointer-events-auto');
                $('body').css('overflow', 'hidden');
                $('#search-input').focus();
                loadDefaultContent();
            }

            function closeSearchDrawer() {
                searchDrawer.addClass('translate-x-full');
                overlay.removeClass('opacity-100 pointer-events-auto');
                overlay.addClass('opacity-0 pointer-events-none');
                $('body').css('overflow', '');
                $('#search-input').val('');
                showDefaultContent();
            }

            // Keyboard shortcut for search
            $(document).on('keydown', function(e) {
                if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                    e.preventDefault();
                    openSearchDrawer();
                }
                if (e.key === 'Escape') {
                    closeSearchDrawer();
                }
            });

            // Load default content (trending, categories, recent searches)
            function loadDefaultContent() {
                // Load recent searches
                loadRecentSearches();

                // Load trending products
                loadTrendingProducts();

                // Load categories
                loadCategories();

                // Load suggestions
                loadSuggestions();
            }

            function loadRecentSearches() {
                const recentList = $('#recent-searches-list');
                if (recentSearches.length === 0) {
                    recentList.html(`
                        <div class="text-center py-8">
                            <i class="fas fa-history text-3xl text-gray-300 mb-3"></i>
                            <p class="text-gray-500">No recent searches</p>
                        </div>
                    `);
                    return;
                }

                let html = '';
                recentSearches.slice(0, 5).forEach((search, index) => {
                    html += `
                        <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-all duration-200 group recent-search-item" data-query="${search.query}">
                            <div class="flex items-center space-x-3 flex-1 cursor-pointer">
                                <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">
                                    <i class="fas fa-history text-primary text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <span class="text-gray-700 group-hover:text-primary transition-colors">${search.query}</span>
                                    <span class="text-xs text-gray-400 ml-2">${search.time}</span>
                                </div>
                            </div>
                            <button class="p-2 text-gray-400 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-all remove-recent-search" data-index="${index}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                });
                recentList.html(html);
            }

            function loadTrendingProducts() {
                $.ajax({
                    url: '/navbar/trending',
                    method: 'GET',
                    success: function(products) {
                        const container = $('#trending-products');
                        if (products.length === 0) return;

                        let html = '';
                        products.forEach(product => {
                            const discount = product.offer_price ?
                                Math.round(((product.price - product.offer_price) / product.price) * 100) : null;

                            html += `
                                <a href="/product/${product.id}" class="product-card block p-3 rounded-xl bg-white border border-border hover:border-primary/30 transition-all">
                                    <div class="relative h-32 w-full mb-3 overflow-hidden rounded-lg">
                                        ${discount ? `
                                            <span class="absolute top-2 left-2 bg-secondary text-white text-xs font-bold px-2 py-1 rounded-md z-10">
                                                -${discount}%
                                            </span>
                                        ` : ''}
                                        <img src="${product.image}" alt="${product.name}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <h4 class="font-medium text-gray-800 truncate mb-1">${product.name}</h4>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-bold text-primary">$${product.offer_price || product.price}</span>
                                            ${product.offer_price ? `
                                                <span class="text-sm text-gray-400 line-through">$${product.price}</span>
                                            ` : ''}
                                        </div>
                                        <span class="text-xs text-gray-500">${product.category}</span>
                                    </div>
                                </a>
                            `;
                        });
                        container.html(html);
                    }
                });
            }

            function loadCategories() {
    const categories = [
        @foreach($categories as $category)
        {
            id: {{ $category->id }},
            name: @json($category->name),
            image: @json(
                $category->image
                    ? asset('storage/app/public/'.$category->image)
                    : asset('images/category-placeholder.jpg')
            ),
        },
        @endforeach
    ];

    const container = $('#categories-grid');
    let html = '';

    categories.forEach(category => {
        html += `
            <div class="category-card cursor-pointer group" data-id="${category.id}">
                <div class="relative overflow-hidden rounded-xl shadow-sm
                            transition-all duration-300 transform group-hover:scale-105">

                    <img src="${category.image}"
                         alt="${category.name}"
                         class="w-full h-32 object-cover">

                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                        <p class="text-white font-semibold text-lg">
                            ${category.name}
                        </p>
                    </div>
                </div>
            </div>
        `;
    });

    container.html(html);
}

$(document).ready(function () {
    loadCategories();
});

            function loadSuggestions() {
                const suggestions = [
                    'Modern Sofa', 'Coffee Table', 'Dining Chair', 'Wall Art',
                    'Floor Lamp', 'Bookshelf', 'Area Rug', 'Throw Pillow'
                ];

                const container = $('#suggestions-section .flex');
                let html = '';
                suggestions.forEach(suggestion => {
                    html += `
                        <button class="px-4 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-primary hover:text-white transition-all duration-300 suggestion-tag">
                            ${suggestion}
                        </button>
                    `;
                });
                container.html(html);
            }

            // Search functionality
            $('#search-input').on('input', function() {
                const query = $(this).val().trim();

                if (query.length === 0) {
                    showDefaultContent();
                    return;
                }

                if (query.length < 2) return;

                // Show loading
                $('#search-default-content').hide();
                $('#search-results').hide();
                $('#search-loading').show();
                $('#search-empty').hide();

                // Clear previous timeout
                if (searchTimeout) clearTimeout(searchTimeout);

                // Set new timeout for debouncing
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300);
            });

            function performSearch(query) {
                isSearching = true;

                $.ajax({
                    url: '{{ route("navbar.search") }}',
                    method: 'GET',
                    data: {
                        q: query
                    },
                    success: function(response) {
                        $('#search-loading').hide();

                        if (response.products.length === 0) {
                            showNoResults();
                            return;
                        }

                        displaySearchResults(response);
                        saveRecentSearch(query);
                    },
                    error: function() {
                        $('#search-loading').hide();
                        $('#search-empty').show().find('p').text('Error loading results. Please try again.');
                    }
                });
            }

            function displaySearchResults(response) {
                const container = $('#search-results');
                const resultsCount = $('#results-count');

                resultsCount.text(`${response.products.length} results`).show();

                let html = '';

                // Group products by category
                const groupedProducts = {};
                response.products.forEach(product => {
                    if (!groupedProducts[product.category]) {
                        groupedProducts[product.category] = [];
                    }
                    groupedProducts[product.category].push(product);
                });

                // Render grouped results
                Object.entries(groupedProducts).forEach(([category, products]) => {
                    html += `
                        <div class="category-results mb-8">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-heading font-semibold text-gray-800">${category}</h3>
                                <span class="text-sm text-gray-500">${products.length} items</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    `;

                    products.forEach(product => {
                        const discount = product.discount_percent;

                        html += `
                            <a href="/product/${product.id}" class="product-card group block p-4 rounded-xl bg-white border border-border hover:border-primary transition-all">
                                <div class="flex space-x-4">
                                    <div class="relative w-24 h-24 flex-shrink-0 overflow-hidden rounded-lg">
                                        ${discount ? `
                                            <span class="absolute top-0 left-0 bg-secondary text-white text-xs font-bold px-2 py-1 rounded-br-lg z-10">
                                                -${discount}%
                                            </span>
                                        ` : ''}
                                        ${product.in_stock ? '' : `
                                            <span class="absolute top-0 right-0 bg-gray-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                                                Out of stock
                                            </span>
                                        `}
                                        <img src="${product.image}" alt="${product.name}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-semibold text-gray-800 group-hover:text-primary transition-colors line-clamp-1">${product.name}</h4>
                                            ${product.is_featured ? `
                                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Featured</span>
                                            ` : ''}
                                        </div>
                                        
                                        <div class="flex items-center space-x-2 mb-2">
                                            <div class="flex items-center">
                                                ${generateStars(product.rating)}
                                                <span class="text-xs text-gray-500 ml-2">(${product.review_count})</span>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-xl font-bold text-primary">Rs.${product.offer_price || product.price}</span>
                                                ${product.offer_price ? `
                                                    <span class="text-sm text-gray-400 line-through">Rs.${product.price}</span>
                                                ` : ''}
                                            </div>
                                            <button class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2 rounded-full bg-primary text-white hover:bg-primary-hover">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `;
                    });

                    html += `
                            </div>
                        </div>
                    `;
                });

                // Add suggestions section
                if (response.suggestions.length > 0) {
                    html += `
                        <div class="suggestions-section mt-8 pt-6 border-t border-border">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">💡 Related Searches</h3>
                            <div class="flex flex-wrap gap-2">
                    `;

                    response.suggestions.forEach(suggestion => {
                        html += `
                            <button class="suggestion-chip px-4 py-2 rounded-full bg-gray-100 text-gray-700 hover:bg-primary hover:text-white transition-all duration-300" data-suggestion="${suggestion.text}">
                                ${suggestion.text}
                                <span class="text-xs text-gray-500 ml-1">in ${suggestion.category}</span>
                            </button>
                        `;
                    });

                    html += `
                            </div>
                        </div>
                    `;
                }

                container.html(html).show();
                $('#search-default-content').hide();
                $('#search-empty').hide();
            }

            function generateStars(rating) {
                let stars = '';
                const fullStars = Math.floor(rating);
                const hasHalfStar = rating % 1 >= 0.5;

                for (let i = 1; i <= 5; i++) {
                    if (i <= fullStars) {
                        stars += '<i class="fas fa-star text-yellow-400 text-xs"></i>';
                    } else if (i === fullStars + 1 && hasHalfStar) {
                        stars += '<i class="fas fa-star-half-alt text-yellow-400 text-xs"></i>';
                    } else {
                        stars += '<i class="far fa-star text-yellow-400 text-xs"></i>';
                    }
                }
                return stars;
            }

            function showNoResults() {
                $('#search-results').hide();
                $('#search-empty').show();
                $('#results-count').hide();
            }

            function showDefaultContent() {
                $('#search-default-content').show();
                $('#search-results').hide();
                $('#search-loading').hide();
                $('#search-empty').hide();
                $('#results-count').hide();
                isSearching = false;
            }

            function saveRecentSearch(query) {
                const searchData = {
                    query: query,
                    time: new Date().toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    }),
                    timestamp: Date.now()
                };

                // Remove duplicates
                recentSearches = recentSearches.filter(s => s.query.toLowerCase() !== query.toLowerCase());

                // Add to beginning
                recentSearches.unshift(searchData);

                // Keep only last 10
                recentSearches = recentSearches.slice(0, 10);

                // Save to localStorage
                localStorage.setItem('homecollection_recent_searches', JSON.stringify(recentSearches));

                // Update UI
                if (!$('#search-default-content').is(':visible')) {
                    loadRecentSearches();
                }
            }

            // Event listeners
            searchButton.on('click', openSearchDrawer);
            closeSearch.on('click', closeSearchDrawer);
            overlay.on('click', closeSearchDrawer);

            // Clear recent searches
            $('#clear-recent').on('click', function() {
                recentSearches = [];
                localStorage.removeItem('homecollection_recent_searches');
                loadRecentSearches();
            });

            // Handle suggestion clicks
            $(document).on('click', '.suggestion-tag, .suggestion-chip', function() {
                const query = $(this).data('suggestion') || $(this).text();
                $('#search-input').val(query).focus().trigger('input');
            });

            // Handle recent search clicks
            $(document).on('click', '.recent-search-item', function(e) {
                if (!$(e.target).closest('.remove-recent-search').length) {
                    const query = $(this).data('query');
                    $('#search-input').val(query).focus().trigger('input');
                }
            });

            // Remove recent search
            $(document).on('click', '.remove-recent-search', function(e) {
                e.stopPropagation();
                const index = $(this).data('index');
                recentSearches.splice(index, 1);
                localStorage.setItem('homecollection_recent_searches', JSON.stringify(recentSearches));
                loadRecentSearches();
            });

            // Category clicks
            $(document).on('click', '.category-card', function() {
                const category = $(this).find('p').text();
                $('#search-input').val(category).focus().trigger('input');
            });

            // Initialize
            loadDefaultContent();
        });
    </script>
</body>

</html>