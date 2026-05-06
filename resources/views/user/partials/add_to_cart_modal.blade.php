@php
    $mainImage = $product->images->firstWhere('is_default', true) ?? $product->images->first();
    $imagePath = $mainImage ? asset('storage/app/public/' . $mainImage->image_path) : asset('images/default-product.jpg');
    $currentPrice = $product->cut_price ?? $product->price;
    $hasDiscount = $product->cut_price && $product->cut_price < $product->price;
@endphp

<style>
    .modal-product-image {
        transition: transform 0.5s ease;
    }
    
    .color-swatch:checked + span {
        box-shadow: 0 0 0 3px white, 0 0 0 5px #111827;
    }
    
    .size-btn:checked + div {
        background: #111827;
        color: white;
        border-color: #111827;
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeInUp 0.4s ease-out forwards;
    }
</style>

<div class="bg-white w-full max-w-2xl mx-auto shadow-2xl relative flex flex-col rounded-2xl animate-fade-in" style="max-height: 90vh; overflow-y: auto;">
    
    <!-- Close Button -->
    <button onclick="closeAddToCartModalFunc()" 
            class="absolute top-4 right-4 z-50 p-2.5 bg-white/80 hover:bg-white rounded-full text-gray-500 hover:text-gray-900 transition-all shadow-lg backdrop-blur-sm">
        <i class="fas fa-times text-lg"></i>
    </button>

    <!-- Product Image -->
    <div class="w-full h-64 md:h-80 bg-gradient-to-br from-gray-50 to-gray-100 relative overflow-hidden">
        <img src="{{ $imagePath }}" 
             alt="{{ $product->name }}" 
             class="w-full h-full object-cover modal-product-image hover:scale-105 transition-transform duration-500">
        
        @if($hasDiscount)
        <div class="absolute top-4 left-4 bg-emerald-500 text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider">
            {{ round((($product->price - $product->cut_price) / $product->price) * 100) }}% OFF
        </div>
        @endif
        
        <!-- Category Badge -->
        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full">
            <span class="text-[10px] font-bold uppercase tracking-wider text-gray-900">
                {{ $product->category->name ?? 'Footwear' }}
            </span>
        </div>
    </div>

    <!-- Content -->
    <div class="w-full flex flex-col bg-white">
        <div class="p-6 md:p-8 flex-1 overflow-y-auto">
            
            <!-- Product Info -->
            <div class="mb-6">
                <h2 class="font-serif text-2xl md:text-3xl text-gray-900 mb-3 leading-tight">
                    {{ $product->name }}
                </h2>
                
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-bold text-emerald-500">
                        Rs.{{ number_format($currentPrice) }}
                    </span>
                    @if($hasDiscount)
                    <span class="text-base text-gray-400 line-through">
                        Rs.{{ number_format($product->price) }}
                    </span>
                    @endif
                </div>
                
                @if($product->rating)
                <div class="flex items-center gap-2 mt-3">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $product->rating ? 'text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    @endfor
                    <span class="text-xs text-gray-500">({{ $product->rating }} rating)</span>
                </div>
                @endif
            </div>

            <!-- Form -->
            <form id="addToCartForm" class="space-y-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <!-- Colors -->
                @if($product->colors && $product->colors->count() > 0)
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs uppercase tracking-widest font-bold text-gray-900">Select Color</h3>
                        <span id="selected-color-name" class="text-xs text-gray-500"></span>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->colors as $color)
                            <label class="cursor-pointer group">
                                <input type="radio" name="color_id" value="{{ $color->id }}" 
                                       class="peer sr-only color-swatch" 
                                       {{ $loop->first ? 'checked' : '' }}
                                       onchange="document.getElementById('selected-color-name').textContent = '{{ $color->name }}'">
                                <span class="block w-10 h-10 rounded-full border-2 border-gray-200 peer-checked:border-gray-900 peer-checked:ring-2 peer-checked:ring-gray-900/30 transition-all hover:scale-110"
                                      style="background-color: {{ $color->hex_code ?? $color->code ?? '#D6CEC3' }};"
                                      title="{{ $color->name }}">
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Sizes -->
                @if($product->sizes && $product->sizes->count() > 0)
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs uppercase tracking-widest font-bold text-gray-900">Select Size</h3>
                        <a href="#" class="text-xs text-emerald-500 hover:underline">Size Guide</a>
                    </div>
                    <div class="grid grid-cols-4 md:grid-cols-5 gap-2">
                        @foreach($product->sizes as $size)
                            <label class="cursor-pointer">
                                <input type="radio" name="size_id" value="{{ $size->id }}" 
                                       class="peer sr-only size-btn" 
                                       {{ $loop->first ? 'checked' : '' }}>
                                <div class="w-full py-3 text-center text-xs font-semibold border border-gray-200 text-gray-600 hover:border-gray-900 transition-all peer-checked:bg-gray-900 peer-checked:text-white peer-checked:border-gray-900 rounded-lg">
                                    {{ $size->name }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Quantity -->
                <div>
                    <h3 class="text-xs uppercase tracking-widest font-bold text-gray-900 mb-3">Quantity</h3>
                    <div class="inline-flex items-center border-2 border-gray-200 rounded-xl h-12 overflow-hidden">
                        <button type="button" class="qty-btn w-12 flex items-center justify-center text-gray-600 hover:bg-gray-50" onclick="updateQty(-1)">
                            <i class="fas fa-minus text-sm"></i>
                        </button>
                        <input type="number" name="quantity" id="modal_quantity" value="1" min="1" max="{{ $product->stock ?? 10 }}" 
                               class="w-16 text-center border-none p-0 text-sm font-bold focus:ring-0 appearance-none bg-transparent text-gray-900">
                        <button type="button" class="qty-btn w-12 flex items-center justify-center text-gray-600 hover:bg-gray-50" onclick="updateQty(1)">
                            <i class="fas fa-plus text-sm"></i>
                        </button>
                    </div>
                    @if(($product->stock ?? 0) > 0)
                    <span class="ml-4 text-xs text-emerald-500">In Stock ({{ $product->stock ?? 'available' }})</span>
                    @else
                    <span class="ml-4 text-xs text-red-500">Out of Stock</span>
                    @endif
                </div>
            </form>
        </div>

        <!-- Actions -->
        <div class="p-6 pt-0 bg-white border-t border-gray-100">
            <div class="flex gap-3">
                <button type="button" 
                        onclick="submitAddToCartForm(this)"
                        class="flex-1 bg-gray-900 hover:bg-emerald-600 text-white h-14 text-sm font-bold uppercase tracking-[0.15em] transition-all duration-300 flex items-center justify-center gap-3 rounded-xl">
                    <i class="fas fa-shopping-bag text-lg"></i>
                    <span>Add to Cart</span>
                    <span class="btn-spinner hidden">
                       <i class="fas fa-circle-notch fa-spin"></i>
                    </span>
                </button>
                
                <a href="{{ route('product.detail', $product->id) }}" 
                   class="w-14 h-14 flex items-center justify-center border-2 border-gray-200 text-gray-600 hover:border-gray-900 hover:text-gray-900 transition-all rounded-xl">
                    <i class="fas fa-eye text-lg"></i>
                </a>
            </div>
            
            <!-- Trust Badges -->
            <div class="flex items-center justify-center gap-6 mt-4 text-xs text-gray-500">
                <span class="flex items-center gap-1">
                    <i class="fas fa-truck text-emerald-500"></i> Free Shipping
                </span>
                <span class="flex items-center gap-1">
                    <i class="fas fa-undo text-emerald-500"></i> Easy Returns
                </span>
            </div>
        </div>
    </div>
</div>