{{-- resources/views/user/partials/add_to_cart_modal.blade.php --}}

@php
    $mainImage = $product->images->firstWhere('is_default', true) ?? $product->images->first();
    $imagePath = $mainImage ? asset('storage/app/public/' . $mainImage->image_path) : asset('images/default-product.jpg');
    $currentPrice = $product->sale_price ?? $product->price;
@endphp

<div class="bg-white w-full max-w-lg mx-auto shadow-2xl relative flex flex-col max-h-[90vh] overflow-y-auto rounded-lg">
    
    <button onclick="closeAddToCartModalFunc()" class="absolute top-4 right-4 z-50 p-2 bg-white/60 hover:bg-white rounded-full text-gray-600 hover:text-black transition-colors shadow-sm">
        <i class="fas fa-times text-xl"></i>
    </button>

    <div class="w-full h-72 flex-shrink-0 bg-gray-50 relative">
        <img src="{{ $imagePath }}" 
             alt="{{ $product->name }}" 
             class="w-full h-full object-cover">
    </div>

    <div class="w-full flex flex-col bg-white">
        <div class="p-6 md:p-8">
            
            <div class="mb-6">
                <h2 class="font-serif text-2xl text-gray-900 mb-2 leading-tight">{{ $product->name }}</h2>
                <div class="flex items-center gap-3">
                    <span class="text-xl font-medium text-gray-900">${{ number_format($currentPrice, 2) }}</span>
                    @if($product->sale_price)
                        <span class="text-sm text-gray-400 line-through">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
            </div>

            <form id="addToCartForm" class="space-y-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                @if($product->colors->count() > 0)
                <div>
                    <h3 class="text-[11px] uppercase tracking-widest font-bold text-gray-900 mb-3">Select Color</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->colors as $color)
                            <label class="cursor-pointer group relative">
                                <input type="radio" name="color_id" value="{{ $color->id }}" class="peer sr-only" {{ $loop->first ? 'checked' : '' }}>
                                <span class="block w-8 h-8 rounded-full border border-gray-200 peer-checked:ring-1 peer-checked:ring-offset-2 peer-checked:ring-black peer-checked:border-transparent transition-all"
                                      style="background-color: {{ $color->hex_code ?? $color->code ?? '#D6CEC3' }};"
                                      title="{{ $color->name }}">
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($product->sizes->count() > 0)
                <div>
                    <h3 class="text-[11px] uppercase tracking-widest font-bold text-gray-900 mb-3">Select Size</h3>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->sizes as $size)
                            <label class="cursor-pointer">
                                <input type="radio" name="size_id" value="{{ $size->id }}" class="peer sr-only" {{ $loop->first ? 'checked' : '' }}>
                                <div class="w-full py-3 text-center text-xs font-bold border border-gray-200 text-gray-600 hover:border-black transition-all peer-checked:bg-black peer-checked:text-white peer-checked:border-black">
                                    {{ $size->name }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif

                <div>
                    <h3 class="text-[11px] uppercase tracking-widest font-bold text-gray-900 mb-3">Quantity</h3>
                    <div class="inline-flex border border-gray-300 h-10 w-32">
                        <button type="button" class="w-10 flex items-center justify-center text-gray-600 hover:bg-gray-100" onclick="updateQty(-1)">
                            <i class="fas fa-minus text-xs"></i>
                        </button>
                        <input type="number" name="quantity" id="modal_quantity" value="1" min="1" max="10" 
                               class="w-full text-center border-none p-0 text-sm font-medium focus:ring-0 appearance-none bg-transparent">
                        <button type="button" class="w-10 flex items-center justify-center text-gray-600 hover:bg-gray-100" onclick="updateQty(1)">
                            <i class="fas fa-plus text-xs"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="p-6 pt-0 bg-white sticky bottom-0">
            <button type="button" 
                    onclick="submitAddToCartForm(this)"
                    class="w-full bg-black text-white h-12 text-xs font-bold uppercase tracking-[0.15em] hover:bg-gray-800 transition-all duration-300 flex items-center justify-center gap-2">
                <span>Add to Cart</span>
                <span class="btn-spinner hidden">
                   <i class="fas fa-circle-notch fa-spin"></i>
                </span>
            </button>
        </div>
    </div>
</div>