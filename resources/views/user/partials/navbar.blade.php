<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footwear Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': 'var(--primary-color)',
                        'accent': 'var(--accent-color)',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'serif': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; }

        :root {
            --primary-color: #111827;
            --accent-color: #10b981;
            --secondary-color: #ffffff;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--accent-color);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }

        .mobile-menu-panel {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .search-overlay {
            animation: fadeIn 0.3s ease-out;
        }

        .search-panel {
            animation: slideIn 0.4s ease-out;
        }

        .product-card-hover {
            transition: all 0.3s ease;
        }

        .product-card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .cart-badge {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body class="bg-white">
    @php
    $categories = \App\Models\Category::where('status', 1)->take(6)->get();
    @endphp

    <div x-data="{ 
        mobileMenuOpen: false, 
        searchOpen: false,
        userMenuOpen: false 
    }">
        
        <!-- Top Bar -->
        <div class="hidden md:block bg-[var(--primary-color)] text-white text-[10px] uppercase tracking-[0.3em] py-2">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <span class="flex items-center gap-2">
                        <i class="fas fa-phone text-[var(--accent-color)]"></i>
                        <a href="tel:+923001234567" class="hover:text-[var(--accent-color)] transition-colors">+92 300 1234567</a>
                    </span>
                    <span class="text-white/30">|</span>
                    <span class="flex items-center gap-2">
                        <i class="fas fa-envelope text-[var(--accent-color)]"></i>
                        <a href="mailto:info@footwear.com" class="hover:text-[var(--accent-color)] transition-colors">info@footwear.com</a>
                    </span>
                </div>
                <div class="flex items-center gap-6">
                    <span><i class="fas fa-truck mr-2 text-[var(--accent-color)]"></i> Free Shipping On Orders Over Rs.5000</span>
                    <span class="text-white/30">|</span>
                    <span><i class="fas fa-undo mr-2 text-[var(--accent-color)]"></i> 30-Day Returns</span>
                </div>
            </div>
        </div>

        <!-- Main Navbar -->
        <nav class="fixed top-0 left-0 right-0 z-50 glass-nav border-b border-gray-100 shadow-sm h-16 md:h-20">
            <div class="container mx-auto px-4 md:px-6 h-full">
                <div class="flex items-center justify-between h-full">
                    
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-[var(--primary-color)] rounded-lg flex items-center justify-center">
                            <i class="fas fa-shoe-prints text-white text-lg md:text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <span class="font-serif text-xl md:text-2xl font-bold text-[var(--primary-color)]">FOOTWEAR</span>
                            <span class="text-[var(--accent-color)] text-xs block -mt-1">PREMIUM</span>
                        </div>
                    </a>

                    <!-- Desktop Menu -->
                    <div class="hidden lg:flex items-center gap-6">
                        <a href="{{ route('home') }}" class="nav-link text-sm font-medium text-[var(--primary-color)]">Home</a>
                        <a href="{{ route('product') }}" class="nav-link text-sm font-medium text-[var(--primary-color)]">Shop</a>
                        <div class="relative" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" class="nav-link text-sm font-medium text-[var(--primary-color)] flex items-center gap-1">
                                Categories <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" 
                                 x-transition class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-100 py-3 z-50"
                                 style="display: none;">
                                @foreach($categories as $cat)
                                <a href="{{ route('product', ['category_id' => $cat->id]) }}" 
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-[var(--accent-color)]/10 hover:text-[var(--accent-color)] transition-colors">
                                    <i class="fas fa-shoe-prints text-xs text-[var(--accent-color)]"></i>
                                    {{ $cat->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('about') }}" class="nav-link text-sm font-medium text-[var(--primary-color)]">About</a>
                        <a href="{{ route('contact') }}" class="nav-link text-sm font-medium text-[var(--primary-color)]">Contact</a>
                        <a href="{{ route('product') }}" class="px-5 py-2.5 bg-[var(--accent-color)] text-white text-sm font-medium rounded-full hover:bg-emerald-600 transition-colors">
                            Shop Now
                        </a>
                    </div>

                    <!-- Icons -->
                    <div class="flex items-center gap-1 md:gap-3">
                        <!-- Search Button -->
                        <button @click="searchOpen = true" 
                                class="w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-full bg-gray-50 hover:bg-[var(--accent-color)]/10 text-[var(--primary-color)] hover:text-[var(--accent-color)] transition-colors"
                                title="Search">
                            <i class="fas fa-search text-sm"></i>
                        </button>

                        <!-- Wishlist -->
                        <a href="#" 
                           class="hidden sm:flex w-10 h-10 md:w-11 md:h-11 items-center justify-center rounded-full bg-gray-50 hover:bg-red-50 text-[var(--primary-color)] hover:text-red-500 transition-colors"
                           title="Wishlist">
                            <i class="far fa-heart text-sm"></i>
                        </a>

                        <!-- Cart -->
                        @php
                        $cartCount = 0;
                        if (auth()->check()) {
                            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                        } else {
                            $guestToken = session()->get('guest_token');
                            $cartCount = $guestToken ? \App\Models\Cart::where('guest_token', $guestToken)->sum('quantity') : collect(session('cart', []))->sum('quantity');
                        }
                        @endphp
                        <a href="{{ route('cart.index') }}" 
                           class="relative w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-full bg-gray-50 hover:bg-[var(--accent-color)]/10 text-[var(--primary-color)] hover:text-[var(--accent-color)] transition-colors"
                           title="Cart">
                            <i class="fas fa-shopping-bag text-sm"></i>
                            @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 h-5 w-5 flex items-center justify-center bg-[var(--accent-color)] text-white text-[10px] font-bold rounded-full">
                                {{ $cartCount > 99 ? '99+' : $cartCount }}
                            </span>
                            @endif
                        </a>

                        <!-- User Menu -->
                        <div class="relative hidden md:block">
                            <button @click="userMenuOpen = !userMenuOpen" 
                                    class="w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-full bg-gray-50 hover:bg-[var(--accent-color)]/10 text-[var(--primary-color)] hover:text-[var(--accent-color)] transition-colors">
                                <i class="fas fa-user text-sm"></i>
                            </button>
                            <div x-show="userMenuOpen" @click.away="userMenuOpen = false"
                                 x-transition class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50"
                                 style="display: none;">
                                @auth
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="font-medium text-[var(--primary-color)]">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Orders</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                                </form>
                                @else
                                <a href="{{ route('user.login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Login</a>
                                <a href="{{ route('user.register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Register</a>
                                @endauth
                            </div>
                        </div>

                        <!-- Mobile Menu Toggle -->
                        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                                class="lg:hidden w-10 h-10 md:w-11 md:h-11 flex items-center justify-center rounded-full bg-[var(--primary-color)] text-white">
                            <i class="fas text-sm" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Spacer -->
        <div class="h-16 md:h-20"></div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenuOpen = false"
             class="fixed inset-0 bg-black/50 z-[60] lg:hidden">
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed top-0 right-0 h-full w-80 max-w-full bg-white shadow-2xl z-[70] lg:hidden mobile-menu-panel overflow-y-auto">
            
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <span class="font-serif text-xl font-bold text-[var(--primary-color)]">Menu</span>
                <button @click="mobileMenuOpen = false" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100">
                    <i class="fas fa-times text-gray-600"></i>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="font-medium text-[var(--primary-color)]">Home</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
                <a href="{{ route('product') }}" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="font-medium text-[var(--primary-color)]">Shop All</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
                
                <div class="py-2">
                    <p class="text-xs font-bold text-[var(--accent-color)] uppercase tracking-wider mb-3">Categories</p>
                    @foreach($categories as $cat)
                    <a href="{{ route('product', ['category_id' => $cat->id]) }}" 
                       class="flex items-center py-2 text-gray-600 hover:text-[var(--accent-color)]">
                        <i class="fas fa-shoe-prints w-6 text-xs"></i>
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>

                <a href="{{ route('about') }}" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="font-medium text-[var(--primary-color)]">About</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center justify-between py-3 border-b border-gray-100">
                    <span class="font-medium text-[var(--primary-color)]">Contact</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
            </div>

            <div class="p-6 border-t border-gray-100">
                @auth
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-[var(--primary-color)] text-white flex items-center justify-center font-serif">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-medium text-[var(--primary-color)]">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">View Account</p>
                    </div>
                </div>
                @else
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('user.login') }}" class="py-3 text-center bg-[var(--primary-color)] text-white rounded-lg text-sm font-medium">Login</a>
                    <a href="{{ route('user.register') }}" class="py-3 text-center border border-[var(--primary-color)] text-[var(--primary-color)] rounded-lg text-sm font-medium">Register</a>
                </div>
                @endauth
            </div>
        </div>

        <!-- Search Overlay -->
        <div x-show="searchOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="searchOpen = false"
             class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[80] search-overlay">
        </div>

        <!-- Search Panel -->
        <div x-show="searchOpen"
             x-transition:enter="transition ease-out duration-400"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed top-0 right-0 h-full w-full md:w-[500px] lg:w-[600px] bg-white shadow-2xl z-[90] search-panel overflow-hidden">
            
            <div class="h-full flex flex-col">
                <!-- Search Header -->
                <div class="p-4 md:p-6 border-b border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-serif text-xl font-bold text-[var(--primary-color)]">Search Products</h2>
                        <button @click="searchOpen = false" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100">
                            <i class="fas fa-times text-gray-600"></i>
                        </button>
                    </div>
                    
                    <!-- Search Input -->
                    <div class="relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" 
                               id="navbar-search-input"
                               placeholder="Search shoes, sneakers, sandals..." 
                               class="w-full pl-12 pr-4 py-4 rounded-xl border border-gray-200 focus:border-[var(--accent-color)] focus:ring-2 focus:ring-[var(--accent-color)]/20 outline-none transition-all"
                               autofocus>
                        <button id="search-close-btn" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <!-- Search Results -->
                <div class="flex-1 overflow-y-auto p-4 md:p-6" id="search-content">
                    <!-- Default Content -->
                    <div id="search-default">
                        <div class="mb-6">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Popular Categories</h3>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($categories as $cat)
                                <a href="{{ route('product', ['category_id' => $cat->id]) }}" 
                                   class="p-3 rounded-xl border border-gray-100 hover:border-[var(--accent-color)]/50 hover:bg-[var(--accent-color)]/5 transition-colors text-center">
                                    <i class="fas fa-shoe-prints text-[var(--accent-color)] mb-2"></i>
                                    <p class="text-sm font-medium text-[var(--primary-color)]">{{ $cat->name }}</p>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Trending Now</h3>
                            <div id="trending-products" class="grid grid-cols-2 gap-3">
                                <!-- Loaded via AJAX -->
                            </div>
                        </div>
                    </div>

                    <!-- Results -->
                    <div id="search-results" class="hidden">
                        <div id="search-results-list" class="space-y-4"></div>
                    </div>

                    <!-- Loading -->
                    <div id="search-loading" class="hidden py-12 text-center">
                        <i class="fas fa-spinner fa-spin text-2xl text-[var(--accent-color)]"></i>
                        <p class="text-gray-500 mt-3">Searching...</p>
                    </div>

                    <!-- No Results -->
                    <div id="search-no-results" class="hidden py-12 text-center">
                        <i class="fas fa-search text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">No products found</p>
                    </div>
                </div>

                <!-- Search Footer -->
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>Press <kbd class="px-2 py-1 bg-gray-200 rounded">ESC</kbd> to close</span>
                        <span class="text-[var(--accent-color)]"><i class="fas fa-bolt mr-1"></i> Fast Search</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let searchTimeout = null;
            
            // Load trending products
            loadTrendingProducts();

            function loadTrendingProducts() {
                $.ajax({
                    url: '/navbar/trending',
                    method: 'GET',
                    success: function(products) {
                        const container = $('#trending-products');
                        if (products.length === 0) {
                            container.html('<p class="col-span-2 text-center text-gray-400 text-sm">No trending products</p>');
                            return;
                        }
                        
                        let html = '';
                        products.forEach(product => {
                            const discount = product.offer_price ? Math.round(((product.price - product.offer_price) / product.price) * 100) : null;
                            html += `
                                <a href="/product/${product.id}" class="product-card-hover block p-3 rounded-xl border border-gray-100 hover:border-[var(--accent-color)]/30">
                                    <div class="relative h-24 mb-2 overflow-hidden rounded-lg bg-gray-50">
                                        ${discount ? `<span class="absolute top-1 left-1 bg-[var(--accent-color)] text-white text-[10px] font-bold px-2 py-0.5 rounded">-${discount}%</span>` : ''}
                                        <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-sm font-medium text-[var(--primary-color)] truncate">${product.name}</p>
                                    <p class="text-xs font-bold text-[var(--accent-color)]">Rs.${product.offer_price || product.price}</p>
                                </a>
                            `;
                        });
                        container.html(html);
                    }
                });
            }

            // Search functionality
            $('#navbar-search-input').on('input', function() {
                const query = $(this).val().trim();
                
                if (query.length === 0) {
                    $('#search-default').show();
                    $('#search-results').hide();
                    $('#search-loading').hide();
                    $('#search-no-results').hide();
                    return;
                }

                if (query.length < 2) return;

                // Show loading
                $('#search-default').hide();
                $('#search-results').hide();
                $('#search-loading').show();
                $('#search-no-results').hide();

                // Debounce
                if (searchTimeout) clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => performSearch(query), 300);
            });

            function performSearch(query) {
                $.ajax({
                    url: '{{ route("navbar.search") }}',
                    method: 'GET',
                    data: { q: query },
                    success: function(response) {
                        $('#search-loading').hide();
                        
                        if (response.products.length === 0) {
                            $('#search-no-results').show();
                            return;
                        }

                        displayResults(response.products);
                    },
                    error: function() {
                        $('#search-loading').hide();
                        $('#search-no-results').show();
                    }
                });
            }

            function displayResults(products) {
                const container = $('#search-results-list');
                let html = '';

                products.forEach(product => {
                    const discount = product.discount_percent;
                    html += `
                        <a href="/product/${product.id}" class="product-card-hover flex gap-4 p-3 rounded-xl border border-gray-100 hover:border-[var(--accent-color)]/30">
                            <div class="relative w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-50">
                                ${discount ? `<span class="absolute top-0 left-0 bg-[var(--accent-color)] text-white text-[9px] font-bold px-2 py-0.5 rounded-tl-lg">-${discount}%</span>` : ''}
                                <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-[var(--accent-color)] uppercase tracking-wider">${product.category}</p>
                                <h4 class="font-medium text-[var(--primary-color)] mb-1">${product.name}</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-bold text-[var(--accent-color)]">Rs.${product.offer_price || product.price}</span>
                                    ${product.offer_price ? `<span class="text-xs text-gray-400 line-through">Rs.${product.price}</span>` : ''}
                                </div>
                            </div>
                        </a>
                    `;
                });

                container.html(html);
                $('#search-results').show();
            }

            // ESC key to close search
            $(document).on('keydown', function(e) {
                if (e.key === 'Escape') {
                    $('.search-panel').css('transform', 'translateX(100%)');
                    $('.search-overlay').fadeOut();
                    $('body').css('overflow', '');
                }
            });

            // Close button
            $('#search-close-btn').on('click', function() {
                $('#navbar-search-input').val('');
                $('#search-default').show();
                $('#search-results').hide();
            });
        });
    </script>
</body>
</html>