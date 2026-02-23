@php
    // 1. GLOBAL SALE LOGIC (Run this once, outside the loop for performance)
    $activeSale = \App\Models\Sale::where('is_active', true)
        ->where('starts_at', '<=', now())
        ->where(function($q) {
            $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
        })->first();
@endphp

{{-- START PRODUCT LOOP --}}
@foreach($products as $product)
    @php
        
        $mainImage = $product->images->firstWhere('is_default', true) ?? $product->images->first();
        $mainImagePath = $mainImage ? asset('storage/app/public/' . $mainImage->image_path) : asset('images/default-product.jpg');
        
        // B. Rating Logic
        $rating = $product->reviews->avg('rating') ?? 0;

        // C. Price & Discount Logic
        $finalPrice = $product->sale_price ?? $product->price;
        $discountPercent = 0;
        $saleBadgeText = null;

        if ($product->sale_price && $product->price > $product->sale_price) {
            $discountPercent = round((($product->price - $product->sale_price) / $product->price) * 100);
            $saleBadgeText = "-{$discountPercent}%";
        } 
        elseif ($activeSale && $activeSale->discount_percent > 0) {
            $discountPercent = $activeSale->discount_percent;
            $saleBadgeText = $activeSale->name ?? "-{$discountPercent}%";
        }
    @endphp

    <div class="group relative block h-full w-full" data-product-id="{{ $product->id }}">
        
        <div class="relative w-full aspect-[3/4] overflow-hidden bg-[#F5F5F7]">
            
            <a href="{{ route('product.detail', $product->id) }}">
                <img src="{{ $mainImagePath }}" 
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover transition-all duration-[1000ms] ease-out 
                            grayscale-[15%] group-hover:grayscale-0 group-hover:scale-105"
                     loading="lazy">
            </a>

            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-700 pointer-events-none"></div>

            <div class="absolute top-4 left-4 flex flex-col gap-2 items-start z-10">
                @if($saleBadgeText)
                    <div class="bg-white/95 backdrop-blur-sm text-black border border-black/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.2em] shadow-sm">
                        {{ $saleBadgeText }}
                    </div>
                @endif

                @if(str_contains(strtolower($product->name), 'luxe'))
                    <div class="bg-black text-white px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.2em] shadow-lg">
                        Luxe
                    </div>
                @endif
            </div>

            <div class="absolute bottom-4 left-0 w-full flex justify-center items-center gap-3 translate-y-8 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out z-20">
                <button onclick="openAddToCartModal({{ $product->id }})"
                        class="w-11 h-11 bg-white text-black hover:bg-black hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-xl hover:scale-110"
                        title="Quick Add">
                    <i class="far fa-eye text-sm"></i>
                </button>
                <a href="{{ route('product.detail', $product->id) }}"
                   class="w-11 h-11 bg-white text-black hover:bg-black hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-xl hover:scale-110"
                   title="View Details">
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>
        </div>

        <div class="pt-5 pb-2 flex flex-col items-center text-center space-y-1">
            @if($product->category)
                <span class="text-[9px] font-bold uppercase tracking-[0.25em] text-gray-400">
                    {{ $product->category->name }}
                </span>
            @endif

            <h3 class="font-serif text-lg text-gray-900 group-hover:text-black transition-colors duration-300">
                <a href="{{ route('product.detail', $product->id) }}">
                    {{ $product->name }}
                </a>
            </h3>

            <div class="flex items-center gap-3 text-sm font-medium mt-1">
                @if($product->cut_price && $product->price < $product->cut_price)
                    <span class="text text-[var(--primary-color)]">${{ number_format($product->price, 2) }}</span>
                    <span class="text-gray-400 line-through text-xs">${{ number_format($product->cut_price, 2) }}</span>
                @else
                    <span class="text-gray-900">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            @if($rating > 0)
                <div class="flex gap-0.5 text-[9px] text-gray-400 pt-1 group-hover:text-black transition-colors duration-500">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($rating))
                            <i class="fas fa-star"></i>
                        @elseif($i - 0.5 <= $rating)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star text-gray-200"></i>
                        @endif
                    @endfor
                </div>
            @endif
        </div>
    </div>
@endforeach