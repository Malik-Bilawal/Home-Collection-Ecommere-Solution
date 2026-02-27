@extends("user.layouts.master-layouts.plain")
@php
    $pageTitle = request('categories') ? 'Filtered Products | Home Collection' : 'Premium Home Collection';
@endphp
<meta name="csrf-token" content="{{ csrf_token() }}">
<<<<<<< HEAD
<title>Inhouse Textiles | Premium Textile Products</title>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

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
    --surface-color: #FFFFFF;
    --border-color: #E2DBD1;
}

body {
  font-family: 'Inter', sans-serif;
  color: var(--text-on-secondary); 
  overflow-x: hidden;
  background-color: var(--background-color);
}

.filter-sidebar.active {
  left: 0;
}

.overlay.active {
  opacity: 1;
  visibility: visible;
}

.loading-spinner.active {
  display: block;
}

.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

/* --- SVG Wave Colors --- */
#grad1 stop[offset="0%"] { stop-color: var(--primary-color); }
#grad1 stop[offset="50%"] { stop-color: var(--secondary-color); }
#grad1 stop[offset="100%"] { stop-color: var(--accent-color); }

#grad2 stop[offset="0%"] { stop-color: var(--accent-color); }
#grad2 stop[offset="50%"] { stop-color: var(--secondary-color); }
#grad2 stop[offset="100%"] { stop-color: var(--primary-color); }
</style>
=======
<title>{{ $pageTitle }}</title>
>>>>>>> 26d0e50 (hello world)

@section("content")

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
    --surface-color: #FFFFFF;
    --border-color: #E2DBD1;
}

/* Product Card Base Styles */
.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border: 1px solid var(--border-color);
    height: 100%;
    display: flex;
    flex-direction: column;
    cursor: pointer;
    position: relative;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(104, 6, 38, 0.1);
    border-color: var(--primary-color);
}

.product-image-container {
    position: relative;
    overflow: hidden;
    flex: 1;
}

/* Grid-specific styles */
.grid-2 .product-card {
    height: 500px;
}

.grid-3 .product-card {
    height: 420px;
}

.grid-4 .product-card {
    height: 320px;
}

/* Image aspect ratios */
.grid-2 .product-image-container {
    aspect-ratio: 1/1;
}

.grid-3 .product-image-container {
    aspect-ratio: 1/1;
}

.grid-4 .product-image-container {
    aspect-ratio: 1/1;
}

/* Plus icon for 4-column grid */
.plus-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(104, 6, 38, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .plus-overlay {
    opacity: 1;
}

.plus-icon {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: var(--primary-color);
    transition: all 0.3s ease;
}

.plus-icon:hover {
    transform: scale(1.1);
    background: var(--primary-color);
    color: white;
}

/* Product Info */
.product-info {
    padding: 16px;
}

.grid-2 .product-info {
    padding: 20px;
}

.grid-3 .product-info {
    padding: 16px;
}

.grid-4 .product-info {
    padding: 12px;
    text-align: center;
}

/* Hide details for 4-column grid */
.grid-4 .product-details {
    display: none;
}

/* Badges */
.sale-badge,
.luxe-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.5px;
    z-index: 10;
    text-transform: uppercase;
}

.sale-badge {
    background: var(--primary-color);
    color: white;
}

.luxe-badge {
    background: var(--secondary-color);
    color: white;
}

/* Grid controls */
.grid-controls {
    display: flex;
    gap: 8px;
    align-items: center;
}

.grid-btn {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.grid-btn:hover {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.grid-btn.active {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: white;
}

/* Loading animation */
.loading-dots {
    display: flex;
    gap: 6px;
}

.loading-dots span {
    width: 8px;
    height: 8px;
    background: var(--primary-color);
    border-radius: 50%;
    animation: bounce 1.4s infinite ease-in-out both;
}

.loading-dots span:nth-child(1) {
    animation-delay: -0.32s;
}

.loading-dots span:nth-child(2) {
    animation-delay: -0.16s;
}

@keyframes bounce {
    0%, 80%, 100% {
        transform: scale(0);
    }
    40% {
        transform: scale(1);
    }
}

/* Modal styles */
.add-to-cart-modal {
    max-width: 500px;
}

/* Responsive */
@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 12px !important;
    }
    
    .product-card {
        height: 280px !important;
    }
    
    .product-info {
        padding: 10px !important;
    }
    
    .grid-controls {
        display: none;
    }
}
</style>

<!-- Hero Section -->
<section class="relative min-h-[85vh] flex items-center bg-[#FBF7EE] overflow-hidden pt-20 md:pt-0">

    <div class="absolute inset-0 pointer-events-none select-none">
        <div class="container mx-auto px-4 h-full border-l border-r border-[#680626]/5">
            <div class="grid grid-cols-12 h-full">
                <div class="col-span-3 border-r border-[#680626]/5 h-full hidden md:block"></div>
                <div class="col-span-3 border-r border-[#680626]/5 h-full hidden md:block"></div>
                <div class="col-span-3 border-r border-[#680626]/5 h-full hidden md:block"></div>
            </div>
        </div>
    </div>

    <div class="absolute inset-0 opacity-[0.03] bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23680626\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>

    <div class="container mx-auto px-4 relative z-10 w-full">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">

            <div class="md:col-span-7 flex flex-col items-start text-left">
                
                <div class="flex items-center gap-4 mb-6 overflow-hidden">
                    <div class="h-[1px] w-12 bg-[#B89A6B]"></div>
                    <span class="text-[11px] font-bold tracking-[0.4em] uppercase text-[#B89A6B] animate-fade-in-up">
                        Est. 2026 Collection
                    </span>
                </div>

                <h1 class="text-5xl md:text-7xl lg:text-8xl leading-[0.9] font-serif text-[#680626] mb-8">
                    <span class="block opacity-0 animate-[fadeInUp_0.8s_ease-out_forwards]">Timeless</span>
                    <span class="block italic font-light ml-4 md:ml-12 opacity-0 animate-[fadeInUp_0.8s_ease-out_0.2s_forwards]">
                        Aesthetics
                    </span>
                </h1>

                <p class="text-sm md:text-base leading-relaxed text-[#680626]/70 max-w-md ml-1 md:ml-2 mb-10 opacity-0 animate-[fadeInUp_0.8s_ease-out_0.4s_forwards]">
                    Where architectural precision meets organic warmth. Discover a curated selection of home essentials designed for the modern connoisseur.
                </p>

                <div class="opacity-0 animate-[fadeInUp_0.8s_ease-out_0.6s_forwards] ml-1 md:ml-2">
                    <a href="#collection" class="group relative inline-flex items-center gap-3 px-8 py-4 bg-[#680626] text-[#FBF7EE] overflow-hidden transition-all duration-300 hover:pr-12">
                        <span class="relative z-10 text-xs font-bold uppercase tracking-[0.2em]">Explore Catalogue</span>
                        <i class="fas fa-arrow-right absolute right-4 opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300 z-10"></i>
                        <div class="absolute inset-0 bg-[#4a041b] transform scale-x-0 origin-left group-hover:scale-x-100 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>
            </div>

            <div class="md:col-span-5 relative mt-12 md:mt-0 h-[50vh] md:h-[70vh] flex items-center justify-center">
                
                <div class="relative w-[85%] h-[90%] z-10 opacity-0 animate-[scaleIn_1s_cubic-bezier(0.16,1,0.3,1)_0.2s_forwards]">
                    <div class="absolute inset-0 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=1000&auto=format&fit=crop" 
                             alt="Luxury Interior" 
                             class="w-full h-full object-cover transform scale-110 hover:scale-100 transition-transform duration-[2s] ease-out">
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-full h-full border border-[#B89A6B] z-[-1]"></div>
                </div>

                <div class="absolute bottom-12 left-0 w-40 h-48 shadow-2xl z-20 hidden md:block opacity-0 animate-[fadeInUp_1s_ease-out_0.5s_forwards]">
                    <div class="p-2 bg-white w-full h-full">
                        <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=400&auto=format&fit=crop" 
                             alt="Detail" 
                             class="w-full h-full object-cover grayscale-[20%]">
                    </div>
                </div>

                <div class="absolute -top-6 -right-6 md:top-10 md:-right-10 z-30">
                    <div class="relative w-32 h-32 flex items-center justify-center animate-[spin_10s_linear_infinite]">
                        <svg viewBox="0 0 100 100" class="w-full h-full fill-[#B89A6B]">
                            <path id="curve" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="transparent"/>
                            <text class="text-[12px] uppercase font-bold tracking-widest">
                                <textPath href="#curve">
                                    • Premium Quality • Since 2026
                                </textPath>
                            </text>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-crown text-[#680626] text-xl"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
<!-- Main Content -->
<section class="py-8 md:py-12 relative">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            
        <div class="hidden lg:block w-full lg:w-1/4 xl:w-1/5">
    
    <div class="filter-sidebar bg-white border-r border-b border-[#B89A6B]/30 p-8 sticky top-24">
        
        <div class="flex items-center justify-between mb-10 border-b border-[#B89A6B]/20 pb-4">
            <h3 class="font-serif text-2xl italic text-[#680626]">
                Refine
            </h3>
            
            <button id="clear-filters" class="text-[10px] uppercase tracking-widest text-[#B89A6B] hover:text-[#680626] border-b border-transparent hover:border-[#680626] transition-all duration-300">
                Reset
            </button>
        </div>
        
        <div class="mb-12">
            <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#B89A6B] mb-6">
                Collections
            </h4>
            
            <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($allCategories as $category)
                    @php
                        $isChecked = request('category_id') == $category->id 
                                     || in_array($category->id, explode(',', request('categories', '')));
                    @endphp

                    <label class="group flex items-start cursor-pointer">
                        <div class="relative flex items-center mt-1">
                            <input type="checkbox" 
                                   name="category[]" 
                                   value="{{ $category->id }}"
                                   {{ $isChecked ? 'checked' : '' }}
                                   class="peer appearance-none w-4 h-4 border border-[#D6CEC3] checked:border-[#680626] checked:bg-[#680626] transition-all duration-300 cursor-pointer">
                            
                            <i class="fas fa-check text-[8px] text-white absolute left-[3px] opacity-0 peer-checked:opacity-100 transition-opacity duration-300 pointer-events-none"></i>
                        </div>

                        <div class="ml-4 flex-1 flex justify-between items-center">
                            <span class="text-sm font-serif text-[#680626]/80 group-hover:text-[#680626] group-hover:italic transition-all duration-300">
                                {{ $category->name }}
                            </span>
                            <span class="text-[9px] text-[#B89A6B]">0{{ $category->products_count ?? 0 }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
        
        <div class="mb-12">
            <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#B89A6B] mb-6">
                Price Point
            </h4>
            
            <div class="space-y-6">
                <div class="flex items-center justify-between text-xs font-serif text-[#680626]">
                    <span>Rs.{{ $minPrice }}</span>
                    <span>Rs.{{ $maxPrice }}</span>
                </div>
                
                <div class="relative h-1 bg-[#FBF7EE] w-full">
                    <input type="range" 
                           min="{{ $minPrice }}" 
                           max="{{ $maxPrice }}" 
                           value="{{ $defaultPrice }}"
                           id="price-range"
                           class="absolute w-full h-1 opacity-0 z-20 cursor-pointer">
                           
                    <div class="absolute inset-0 bg-[#E2DBD1] z-0"></div>
                    <div class="absolute inset-y-0 left-0 bg-[#680626] z-10 w-1/2" id="price-track-visual"></div> <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3 h-3 bg-[#680626] rotate-45 z-10 pointer-events-none transition-all" id="price-thumb-visual"></div>
                </div>

                <div class="text-left">
                    <span class="text-xs text-[#680626]">
                        Max: <span class="font-serif italic text-lg ml-2">Rs.<span id="current-price">{{ $defaultPrice }}</span></span>
                    </span>
                </div>
            </div>
        </div>
        
        <div class="mb-12">
            <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#B89A6B] mb-6">
                Rating
            </h4>
            <div class="space-y-3">
                @for($i = 5; $i >= 3; $i--)
                <label class="group flex items-center cursor-pointer">
                    <div class="relative flex items-center">
                        <input type="checkbox" 
                               name="rating[]" 
                               value="{{ $i }}"
                               class="peer appearance-none w-4 h-4 border border-[#D6CEC3] checked:border-[#680626] checked:bg-[#680626] transition-all duration-300 cursor-pointer">
                         <i class="fas fa-check text-[8px] text-white absolute left-[3px] opacity-0 peer-checked:opacity-100 transition-opacity duration-300 pointer-events-none"></i>
                    </div>
                    
                    <div class="ml-4 flex items-center gap-1">
                        @for($j = 1; $j <= 5; $j++)
                        <i class="{{ $j <= $i ? 'fas text-[#B89A6B]' : 'far text-[#D6CEC3]' }} fa-star text-[10px]"></i>
                        @endfor
                        <span class="text-[10px] uppercase tracking-widest text-[#680626]/60 ml-2 group-hover:text-[#680626] transition-colors">& Up</span>
                    </div>
                </label>
                @endfor
            </div>
        </div>
        
        <button id="apply-filters" 
                class="w-full py-4 bg-[#680626] text-[#FBF7EE] hover:bg-[#4a041b] transition-all duration-500 group relative overflow-hidden">
            <span class="relative z-10 text-[10px] font-bold uppercase tracking-[0.2em] group-hover:tracking-[0.3em] transition-all duration-500">
                Update View
            </span>
        </button>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 2px; }
    .custom-scrollbar::-webkit-scrollbar-track { bg: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #E2DBD1; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #B89A6B; }
</style>
            
            <!-- Products Section -->
            <div class="w-full lg:w-3/4 xl:w-4/5">
                <!-- Header Bar -->
                <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 mb-8 border border-[var(--border-color)]">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <!-- Mobile Filter Toggle -->
                            <button id="mobile-filter-toggle" 
                                    class="lg:hidden px-4 py-2 bg-[var(--background-color)] hover:bg-[var(--primary-color)]/10 rounded-lg flex items-center gap-2 transition-colors group">
                                <i class="fas fa-filter text-[var(--primary-color)]"></i>
                                <span class="font-medium">Filters</span>
                                <span id="active-filter-count" class="px-2 py-1 bg-[var(--primary-color)] text-white text-xs rounded-full hidden">
                                    0
                                </span>
                            </button>
                            
                            <!-- Results Count -->
                            <div class="text-sm text-gray-600">
                                <span id="product-count">{{ $totalProducts }}</span> Products Found
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <!-- Sort Options -->
                            <div class="relative">
                                <select id="sort-by" class="appearance-none bg-transparent border border-[var(--border-color)] rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)]/20 focus:border-[var(--primary-color)] cursor-pointer text-sm">
                                    <option value="featured">Featured</option>
                                    <option value="price_asc">Price: Low to High</option>
                                    <option value="price_desc">Price: High to Low</option>
                                    <option value="rating">Top Rated</option>
                                    <option value="newest">Newest Arrivals</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none text-sm"></i>
                            </div>
                            
                            <!-- Grid Options (Desktop Only) -->
                            <div class="hidden lg:flex items-center gap-2 grid-controls">
                                <span class="text-sm text-gray-600 mr-2">View:</span>
                                <button class="grid-btn {{ $gridPreference == 2 ? 'active' : '' }}"
                                        data-grid="2"
                                        title="2 cards per row">
                                    <i class="fas fa-th-large"></i>
                                </button>
                                <button class="grid-btn {{ $gridPreference == 3 ? 'active' : '' }}"
                                        data-grid="3"
                                        title="3 cards per row">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button class="grid-btn {{ $gridPreference == 4 ? 'active' : '' }}"
                                        data-grid="4"
                                        title="4 cards per row">
                                    <i class="fas fa-th-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Active Filters (Mobile) -->
                    <div class="lg:hidden flex flex-wrap gap-2 mt-4" id="active-filters">
                        <!-- Active filters will appear here -->
                    </div>
                </div>
                
                <!-- Loading Spinner -->
                <div id="loading-spinner" class="hidden text-center py-16">
                    <div class="inline-flex flex-col items-center">
                        <div class="loading-dots mb-4">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <p class="text-gray-600 text-sm">Loading products</p>
                    </div>
                </div>
                
                <!-- Products Grid -->
                <div id="products-grid" class="product-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ $gridPreference }} gap-6 grid-{{ $gridPreference }}">
                    @include('user.partials.product_grid_items', [
                        'products' => $products,
                        'gridPreference' => $gridPreference
                    ])
                </div>
                
                <!-- Load More Button -->
                @if($products->hasMorePages())
                <div class="text-center mt-12" id="load-more-container">
                    <button id="load-more" 
                            class="px-8 py-3 bg-white border border-[var(--primary-color)] text-[var(--primary-color)] rounded-lg hover:bg-[var(--primary-color)] hover:text-white transition-colors font-medium">
                        Load More Products
                    </button>
                </div>
                @endif
                
                <!-- No Products Message -->
                <div id="no-products-message" class="hidden text-center py-16">
                    <div class="max-w-md mx-auto">
                        <div class="w-20 h-20 bg-[var(--background-color)] rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-2xl text-[var(--primary-color)]"></i>
                        </div>
                        <h3 class="text-xl font-serif font-bold text-[var(--primary-color)] mb-3">No Products Found</h3>
                        <p class="text-gray-600 mb-8 text-sm">Try adjusting your filters or browse our other collections</p>
                        <button id="reset-filters" class="px-6 py-2.5 border border-[var(--primary-color)] text-[var(--primary-color)] font-medium rounded-lg hover:bg-[var(--primary-color)] hover:text-white transition-colors text-sm">
                            Reset Filters
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="mobile-filter-sidebar" class="lg:hidden fixed inset-y-0 left-0 w-[85vw] max-w-[320px] bg-white z-50 transform -translate-x-full transition-transform duration-500 border-r border-[#B89A6B]/30">
    <div class="h-full flex flex-col">
        
        <div class="p-8 border-b border-[#B89A6B]/20">
            <div class="flex items-center justify-between">
                <h3 class="font-serif text-2xl italic text-[#680626]">
                    Refine
                </h3>
                <button id="close-mobile-filters" class="group flex items-center gap-2 text-[10px] uppercase tracking-widest text-[#B89A6B] hover:text-[#680626] transition-colors">
                    <span>Close</span>
                    <i class="fas fa-times text-lg group-hover:rotate-90 transition-transform duration-300"></i>
                </button>
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            
            <div class="mb-10">
                <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#B89A6B] mb-6">
                    Collections
                </h4>
                <div class="space-y-4">
                    @foreach($allCategories as $category)
                        @php
                            // LOGIC: Check URL for category_id or categories array
                            $isChecked = request('category_id') == $category->id 
                                         || in_array($category->id, explode(',', request('categories', '')));
                        @endphp

                        <label class="group flex items-start cursor-pointer">
                            <div class="relative flex items-center mt-1">
                                <input type="checkbox" 
                                       name="category[]" 
                                       value="{{ $category->id }}"
                                       {{ $isChecked ? 'checked' : '' }}
                                       class="peer appearance-none w-4 h-4 border border-[#D6CEC3] checked:border-[#680626] checked:bg-[#680626] transition-all duration-300 cursor-pointer">
                                
                                <i class="fas fa-check text-[8px] text-white absolute left-[3px] opacity-0 peer-checked:opacity-100 transition-opacity duration-300 pointer-events-none"></i>
                            </div>

                            <div class="ml-4 flex-1 flex justify-between items-center">
                                <span class="text-sm font-serif text-[#680626]/80 group-hover:text-[#680626] group-hover:italic transition-all duration-300">
                                    {{ $category->name }}
                                </span>
                                <span class="text-[9px] text-[#B89A6B]">0{{ $category->products_count ?? 0 }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
            
            <div class="mb-10">
                <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#B89A6B] mb-6">
                    Price Point
                </h4>
                <div class="space-y-6">
                    <div class="flex items-center justify-between text-xs font-serif text-[#680626]">
                        <span>${{ $minPrice }}</span>
                        <span>${{ $maxPrice }}</span>
                    </div>
                    
                    <div class="relative h-1 bg-[#FBF7EE] w-full">
                        <input type="range" 
                               min="{{ $minPrice }}" 
                               max="{{ $maxPrice }}" 
                               value="{{ $defaultPrice }}"
                               id="mobile-price-range"
                               class="absolute w-full h-1 opacity-0 z-20 cursor-pointer">
                        
                        <div class="absolute inset-0 bg-[#E2DBD1] z-0"></div>
                        <div class="absolute inset-y-0 left-0 bg-[#680626] z-10 w-1/2"></div> <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-4 h-4 bg-[#680626] rounded-full z-10 pointer-events-none shadow-md"></div>
                    </div>

                    <div class="text-left">
                         <span class="text-xs text-[#680626]">
                            Max: <span class="font-serif italic text-lg ml-2">$<span id="mobile-current-price">{{ $defaultPrice }}</span></span>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="mb-10">
                <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-[#B89A6B] mb-6">
                    Rating
                </h4>
                <div class="space-y-3">
                    @for($i = 5; $i >= 3; $i--)
                    <label class="group flex items-center cursor-pointer">
                        <div class="relative flex items-center">
                            <input type="checkbox" 
                                   name="rating[]" 
                                   value="{{ $i }}"
                                   class="peer appearance-none w-4 h-4 border border-[#D6CEC3] checked:border-[#680626] checked:bg-[#680626] transition-all duration-300 cursor-pointer">
                             <i class="fas fa-check text-[8px] text-white absolute left-[3px] opacity-0 peer-checked:opacity-100 transition-opacity duration-300 pointer-events-none"></i>
                        </div>
                        
                        <div class="ml-4 flex items-center gap-1">
                            @for($j = 1; $j <= 5; $j++)
                            <i class="{{ $j <= $i ? 'fas text-[#B89A6B]' : 'far text-[#D6CEC3]' }} fa-star text-[10px]"></i>
                            @endfor
                            <span class="text-[10px] uppercase tracking-widest text-[#680626]/60 ml-2 group-hover:text-[#680626] transition-colors">& Up</span>
                        </div>
                    </label>
                    @endfor
                </div>
            </div>
        </div>
        
        <div class="p-8 border-t border-[#B89A6B]/20 bg-white">
            <button id="mobile-apply-filters" 
                    class="w-full py-4 bg-[#680626] text-[#FBF7EE] hover:bg-[#4a041b] transition-all duration-300 shadow-none hover:shadow-lg">
                <span class="text-[10px] font-bold uppercase tracking-[0.2em]">
                    Update View
                </span>
            </button>
        </div>
    </div>
</div>

<div id="mobile-filter-overlay" class="lg:hidden fixed inset-0 bg-[#680626]/20 backdrop-blur-sm z-40 hidden transition-all duration-300"></div>
   <!-- Add to Cart Modal -->
<div id="add-to-cart-modal" 
     class="fixed inset-0 bg-black/50 z-[9999] hidden flex items-center justify-center p-4 overflow-auto">

    <div class="bg-white rounded-2xl w-full max-w-lg mx-auto relative">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-[var(--primary-color)]">Add to Cart</h3>
                <button id="close-add-to-cart-modal" class="text-gray-500 hover:text-[var(--primary-color)]">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Modal Content Loaded via AJAX -->
            <div id="add-to-cart-content" class="w-full flex justify-center">
                <!-- AJAX content here -->
            </div>
        </div>
    </div>
</div>

</section>

@endsection

@push("script")
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const mobileFilterToggle = document.getElementById('mobile-filter-toggle');
    const mobileFilterSidebar = document.getElementById('mobile-filter-sidebar');
    const mobileFilterOverlay = document.getElementById('mobile-filter-overlay');
    const closeMobileFilters = document.getElementById('close-mobile-filters');
    const priceRange = document.getElementById('price-range');
    const mobilePriceRange = document.getElementById('mobile-price-range');
    const currentPrice = document.getElementById('current-price');
    const mobileCurrentPrice = document.getElementById('mobile-current-price');
    const applyFiltersBtn = document.getElementById('apply-filters');
    const mobileApplyFiltersBtn = document.getElementById('mobile-apply-filters');
    const clearFiltersBtn = document.getElementById('clear-filters');
    const resetFiltersBtn = document.getElementById('reset-filters');
    const sortSelect = document.getElementById('sort-by');
    const loadingSpinner = document.getElementById('loading-spinner');
    const productsGrid = document.getElementById('products-grid');
    const noProductsMessage = document.getElementById('no-products-message');
    const activeFilterCount = document.getElementById('active-filter-count');
    const activeFiltersContainer = document.getElementById('active-filters');
    const productCount = document.getElementById('product-count');
    const gridBtns = document.querySelectorAll('.grid-btn');
    const loadMoreBtn = document.getElementById('load-more');
    const loadMoreContainer = document.getElementById('load-more-container');
    const addToCartModal = document.getElementById('add-to-cart-modal');
    const closeAddToCartModal = document.getElementById('close-add-to-cart-modal');
    const addToCartContent = document.getElementById('add-to-cart-content');

    // Current state
    let currentPage = 1;
    let isLoading = false;
    let hasMore = {{ $products->hasMorePages() ? 'true' : 'false' }};
    let currentGrid = {{ $gridPreference }};

    // Toggle mobile filter sidebar
    mobileFilterToggle.addEventListener('click', () => {
        mobileFilterSidebar.style.transform = 'translateX(0)';
        mobileFilterOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    closeMobileFilters.addEventListener('click', () => {
        mobileFilterSidebar.style.transform = 'translateX(-100%)';
        mobileFilterOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    });

    mobileFilterOverlay.addEventListener('click', () => {
        mobileFilterSidebar.style.transform = 'translateX(-100%)';
        mobileFilterOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    });

    // Update price display
    function updatePriceDisplay(rangeElement, displayElement) {
        if (rangeElement && displayElement) {
            displayElement.textContent = rangeElement.value;
            rangeElement.addEventListener('input', function() {
                displayElement.textContent = this.value;
            });
        }
    }

    updatePriceDisplay(priceRange, currentPrice);
    updatePriceDisplay(mobilePriceRange, mobileCurrentPrice);

    // Grid switching without page reload
    gridBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const gridValue = parseInt(this.dataset.grid);
            
            // Update active state
            gridBtns.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            
            // Update grid layout
            updateGridLayout(gridValue);
            
            // Save preference via AJAX
            saveGridPreference(gridValue);
        });
    });

    function updateGridLayout(gridValue) {
        currentGrid = gridValue;
        
        // Update grid classes
        productsGrid.className = `product-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-${gridValue} gap-6 grid-${gridValue}`;
        
        // Update product cards based on grid
        const productCards = productsGrid.querySelectorAll('.product-card');
        productCards.forEach(card => {
            updateProductCardLayout(card, gridValue);
        });
    }

    function updateProductCardLayout(card, gridValue) {
        // Update plus overlay visibility
        const plusOverlay = card.querySelector('.plus-overlay');
        if (plusOverlay) {
            plusOverlay.style.display = gridValue === 4 ? 'flex' : 'none';
        }
        
        // Update card height
        card.style.height = gridValue === 2 ? '500px' : 
                           gridValue === 3 ? '420px' : '320px';
        
        // Update details visibility
        const details = card.querySelector('.product-details');
        if (details) {
            details.style.display = gridValue === 4 ? 'none' : 'block';
        }
    }

    async function saveGridPreference(gridValue) {
        try {
            const response = await fetch('/set-grid-preference', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ grid: gridValue })
            });
            
            const data = await response.json();
            console.log('Grid preference saved:', data);
        } catch (error) {
            console.error('Error saving grid preference:', error);
        }
    }

    // Apply filters
    async function applyFilters(resetPage = true) {
        if (isLoading) return;
        
        if (resetPage) {
            currentPage = 1;
            hasMore = true;
        }
        
        if (loadingSpinner) loadingSpinner.classList.remove('hidden');
        isLoading = true;
        
        const categories = Array.from(document.querySelectorAll('input[name="category[]"]:checked'))
            .map(cb => cb.value);
        const price = priceRange?.value || mobilePriceRange?.value || 0;
        const ratings = Array.from(document.querySelectorAll('input[name="rating[]"]:checked'))
            .map(cb => cb.value);
        const sort = sortSelect?.value || 'featured';
        
        const params = new URLSearchParams();
        if (categories.length > 0) params.append('categories', categories.join(','));
        if (price > 0) params.append('price', price);
        if (ratings.length > 0) params.append('ratings', ratings.join(','));
        if (sort !== 'featured') params.append('sort', sort);
        if (!resetPage) params.append('page', currentPage);
        
        const url = `/products?${params.toString()}`;
        
        // Update URL without page reload
        if (resetPage) {
            window.history.pushState({path: url}, '', url);
        }
        
        try {
            const response = await fetch(`${url}&ajax=1`, {
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) throw new Error('Network response was not ok');
            
            const data = await response.json();
            
            if (resetPage) {
                // Replace existing products
                productsGrid.innerHTML = data.html;
                hasMore = data.hasMore;
                
                if (loadMoreContainer) {
                    loadMoreContainer.style.display = hasMore ? 'block' : 'none';
                }
                
                if (noProductsMessage) {
                    const productCards = productsGrid.querySelectorAll('.product-card');
                    if (productCards.length === 0) {
                        noProductsMessage.classList.remove('hidden');
                    } else {
                        noProductsMessage.classList.add('hidden');
                    }
                }
            } else {
                // Append new products
                productsGrid.insertAdjacentHTML('beforeend', data.html);
                hasMore = data.hasMore;
                
                if (loadMoreContainer) {
                    loadMoreContainer.style.display = hasMore ? 'block' : 'none';
                }
                
                // Update newly added cards
                const newCards = productsGrid.querySelectorAll('.product-card:not([data-processed])');
                newCards.forEach(card => {
                    card.setAttribute('data-processed', 'true');
                    updateProductCardLayout(card, currentGrid);
                });
            }
            
            // Update product count
            const productCards = productsGrid.querySelectorAll('.product-card');
            if (productCount) {
                productCount.textContent = productCards.length;
            }
            
            // Update active filter count
            updateActiveFilterCount(categories.length, ratings.length, price > 0);
            
            // Update active filters display
            updateActiveFiltersDisplay(categories, ratings, price);
            
        } catch (error) {
            console.error('Error loading products:', error);
            if (resetPage && productsGrid) {
                productsGrid.innerHTML = '<p class="text-red-500 text-center py-10 col-span-full">Error loading products. Please try again.</p>';
            }
        } finally {
            if (loadingSpinner) loadingSpinner.classList.add('hidden');
            isLoading = false;
        }
    }

    // Load more products
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', async () => {
            if (isLoading || !hasMore) return;
            
            currentPage++;
            loadMoreBtn.disabled = true;
            loadMoreBtn.innerHTML = '<div class="loading-dots"><span></span><span></span><span></span></div>';
            
            await applyFilters(false);
            
            loadMoreBtn.disabled = false;
            loadMoreBtn.textContent = 'Load More Products';
        });
    }

    // Update active filter count
    function updateActiveFilterCount(categoryCount, ratingCount, hasPrice) {
        if (!activeFilterCount) return;
        
        const total = categoryCount + ratingCount + (hasPrice ? 1 : 0);
        if (total > 0) {
            activeFilterCount.textContent = total;
            activeFilterCount.classList.remove('hidden');
        } else {
            activeFilterCount.classList.add('hidden');
        }
    }

    // Update active filters display
    function updateActiveFiltersDisplay(categories, ratings, price) {
        if (!activeFiltersContainer) return;
        
        activeFiltersContainer.innerHTML = '';
        
        // Add category filters
        categories.forEach(catId => {
            const catCheckbox = document.querySelector(`input[name="category[]"][value="${catId}"]`);
            if (catCheckbox) {
                const catName = catCheckbox.nextElementSibling?.textContent?.trim() || 'Category';
                const filterChip = createFilterChip(`${catName}`, 'category', catId);
                activeFiltersContainer.appendChild(filterChip);
            }
        });
        
        // Add rating filters
        ratings.forEach(rating => {
            const filterChip = createFilterChip(`${rating}+ Stars`, 'rating', rating);
            activeFiltersContainer.appendChild(filterChip);
        });
        
        // Add price filter
        if (price > 0) {
            const filterChip = createFilterChip(`Under $${price}`, 'price', price);
            activeFiltersContainer.appendChild(filterChip);
        }
    }

    // Create filter chip element
    function createFilterChip(text, type, value) {
        const chip = document.createElement('div');
        chip.className = 'inline-flex items-center bg-[var(--primary-color)]/10 text-[var(--primary-color)] px-3 py-1 rounded-full text-sm';
        chip.innerHTML = `
            <span>${text}</span>
            <button type="button" class="ml-2 text-[var(--primary-color)] hover:text-[var(--primary-hover)] remove-filter" data-type="${type}" data-value="${value}">
                <i class="fas fa-times text-xs"></i>
            </button>
        `;
        return chip;
    }

    // Clear filters
    function clearFilters() {
        document.querySelectorAll('input[name="category[]"]').forEach(cb => cb.checked = false);
        document.querySelectorAll('input[name="rating[]"]').forEach(cb => cb.checked = false);
        
        if (priceRange) {
            priceRange.value = priceRange.max;
            currentPrice.textContent = priceRange.max;
        }
        
        if (mobilePriceRange) {
            mobilePriceRange.value = mobilePriceRange.max;
            mobileCurrentPrice.textContent = mobilePriceRange.max;
        }
        
        if (sortSelect) sortSelect.value = 'featured';
        
        applyFilters();
    }

    // Open add to cart modal
    window.openAddToCartModal = async function (productId) {
      try {
            const response = await fetch(`/product/${productId}/add-to-cart-modal`);
            const html = await response.text();
            
            addToCartContent.innerHTML = html;
            addToCartModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } catch (error) {
            console.error('Error loading add to cart modal:', error);
            alert('Failed to load product details. Please try again.');
        }
    }

    // Close add to cart modal
    function closeAddToCartModalFunc() {
        addToCartModal.classList.add('hidden');
        document.body.style.overflow = '';
        addToCartContent.innerHTML = '';
    }

    // Event Listeners
    applyFiltersBtn.addEventListener('click', () => applyFilters(true));
    mobileApplyFiltersBtn.addEventListener('click', () => {
        applyFilters(true);
        mobileFilterSidebar.style.transform = 'translateX(-100%)';
        mobileFilterOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    });
    
    clearFiltersBtn.addEventListener('click', clearFilters);
    resetFiltersBtn.addEventListener('click', clearFilters);
    
    sortSelect.addEventListener('change', () => applyFilters(true));
    
    closeAddToCartModal.addEventListener('click', closeAddToCartModalFunc);
    
    // Close modal on overlay click
    addToCartModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeAddToCartModalFunc();
        }
    });
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !addToCartModal.classList.contains('hidden')) {
            closeAddToCartModalFunc();
        }
    });

    // Product card interactions
    document.addEventListener('click', function(e) {
        // Plus icon click (for 4-column grid)
        const plusIcon = e.target.closest('.plus-icon');
        if (plusIcon) {
            e.preventDefault();
            e.stopPropagation();
            const productCard = plusIcon.closest('.product-card');
            const productId = productCard.dataset.productId;
            openAddToCartModal(productId);
            return;
        }
        
        // Remove filter chip
        const removeFilterBtn = e.target.closest('.remove-filter');
        if (removeFilterBtn) {
            e.preventDefault();
            const type = removeFilterBtn.dataset.type;
            const value = removeFilterBtn.dataset.value;
            
            if (type === 'category') {
                const checkbox = document.querySelector(`input[name="category[]"][value="${value}"]`);
                if (checkbox) checkbox.checked = false;
            } else if (type === 'rating') {
                const checkbox = document.querySelector(`input[name="rating[]"][value="${value}"]`);
                if (checkbox) checkbox.checked = false;
            } else if (type === 'price') {
                if (priceRange) {
                    priceRange.value = priceRange.max;
                    currentPrice.textContent = priceRange.max;
                }
                if (mobilePriceRange) {
                    mobilePriceRange.value = mobilePriceRange.max;
                    mobileCurrentPrice.textContent = mobilePriceRange.max;
                }
            }
            
            applyFilters(true);
            return;
        }
        


        // Product card click (redirect to detail page)
        const productCard = e.target.closest('.product-card');
        if (productCard && !e.target.closest('.plus-icon')) {
            const productId = productCard.dataset.productId;
            window.location.href = `/product/${productId}`;
        }
    });

    // Handle back/forward navigation
    window.addEventListener('popstate', function() {
        applyFilters(true);
    });
});

    // 1. Global Quantity Function
    window.updateQty = function(change) {
        const input = document.getElementById('modal_quantity');
        if(!input) return;
        
        let val = parseInt(input.value);
        val += change;
        if (val < 1) val = 1;
        if (val > 10) val = 10; // Or whatever your max is
        input.value = val;
    }

    // 2. Global Add to Cart Submission
    window.submitAddToCartForm = function(btn) {
        const form = document.getElementById('addToCartForm');
        const spinner = btn.querySelector('.btn-spinner');
        
        // UI Loading State
        btn.disabled = true;
        btn.classList.add('opacity-75');
        if(spinner) spinner.classList.remove('hidden');

        const formData = new FormData(form);

        fetch('/add-to-cart', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Close the modal
                if(typeof closeAddToCartModalFunc === 'function') {
                    closeAddToCartModalFunc();
                }
                
                // Alert or Toast
                alert(data.message);
                
                // Update Cart Count (If you have a listener for this)
                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cart_count } }));
            } else {
                alert(data.message || 'Something went wrong');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        })
        .finally(() => {
            // Reset Button State
            btn.disabled = false;
            btn.classList.remove('opacity-75');
            if(spinner) spinner.classList.add('hidden');
        });
    }


</script>
@endpush