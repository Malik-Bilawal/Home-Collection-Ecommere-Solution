@php
    $defaultImage = $product->images->firstWhere('is_default', true) ?? $product->images->first();
    $defaultImagePath = $defaultImage ? $defaultImage->image_path : '';
    $firstColor = $product->colors->first();
    $colorImagePath = $firstColor ? ($firstColor->images->first()->image_path ?? $defaultImagePath) : $defaultImagePath;
@endphp

<div class="product-card" data-product-id="{{ $product->id }}">
    <!-- Quick View Button -->
    <button class="quick-view-btn" data-product-id="{{ $product->id }}">
        <i class="fas fa-eye"></i>
    </button>
    
    <!-- Sale Badge -->
    @if($product->sale_price)
        <div class="sale-badge">
            SAVE {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
        </div>
    @endif
    
    <!-- Product Image -->
    <div class="relative overflow-hidden h-3/4">
        <img src="{{ asset('storage/app/public/' . $colorImagePath) }}" 
             alt="{{ $product->name }}"
             class="w-full h-full object-cover product-image transition-transform duration-500">
    </div>
    
    <!-- Product Info -->
    <div class="p-4 h-1/4 flex flex-col justify-center">
        <!-- Grid-dependent content -->
        @php
            $gridPreference = request()->cookie('grid_preference') ?? 4;
        @endphp
        
        @if($gridPreference == 2)
            <!-- 2 cards per row: Show full details -->
            <div class="mb-2">
                <span class="text-xs text-gray-500 uppercase tracking-wide">{{ $product->category->name ?? 'Home' }}</span>
            </div>
            <h3 class="font-serif text-lg font-bold text-[var(--primary-color)] mb-1 line-clamp-1">
                {{ $product->name }}
            </h3>
            <p class="text-gray-600 text-sm mb-2 line-clamp-2">
                {{ $product->short_description ?? 'Premium home essential crafted with care.' }}
            </p>
            <div class="flex items-center justify-between mt-auto">
                <div class="flex items-baseline gap-2">
                    <span class="text-xl font-bold text-[var(--primary-color)]">
                        ${{ number_format($product->sale_price ?? $product->price, 2) }}
                    </span>
                    @if($product->sale_price)
                        <span class="text-sm text-gray-400 line-through">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
                @if($product->rating)
                    <div class="flex items-center gap-1">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <span class="text-xs font-medium">{{ number_format($product->rating, 1) }}</span>
                    </div>
                @endif
            </div>
            
        @elseif($gridPreference == 3)
            <!-- 3 cards per row: Show name and price -->
            <div class="mb-2">
                <span class="text-xs text-gray-500 uppercase tracking-wide">{{ $product->category->name ?? 'Home' }}</span>
            </div>
            <h3 class="font-serif font-bold text-[var(--primary-color)] mb-2 line-clamp-1">
                {{ $product->name }}
            </h3>
            <div class="flex items-center justify-between">
                <div class="flex items-baseline gap-2">
                    <span class="text-lg font-bold text-[var(--primary-color)]">
                        Rs.{{ number_format($product->sale_price ?? $product->price, 2) }}
                    </span>
                    @if($product->sale_price)
                        <span class="text-sm text-gray-400 line-through">Rs.{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
                @if($product->rating)
                    <div class="flex items-center gap-1">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <span class="text-xs">{{ number_format($product->rating, 1) }}</span>
                    </div>
                @endif
            </div>
            
        @else
            <!-- 4 cards per row: Show only price -->
            <div class="text-center">
                <h3 class="font-serif font-bold text-[var(--primary-color)] mb-2 line-clamp-1 text-sm">
                    {{ $product->name }}
                </h3>
                <div class="flex items-center justify-center gap-2">
                    <span class="text-base font-bold text-[var(--primary-color)]">
                        Rs.{{ number_format($product->sale_price ?? $product->price, 2) }}
                    </span>
                    @if($product->sale_price)
                        <span class="text-xs text-gray-400 line-through">Rs.{{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>