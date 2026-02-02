            <div class="group relative bg-[var(--surface-color)] border border-transparent hover:border-[var(--border-color)] transition-all duration-500 p-2">
                
                <div class="relative w-full aspect-[4/5] overflow-hidden bg-[#F3EFEC]">
                    @if($product->defaultImage)
                    <img
                                    src="{{ $product->defaultImage
        ? asset('storage/' . $product->defaultImage->image_path)
        : 'https://placehold.co/600x800/E2DBD1/680626?text=Image' }}"
                                    alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center text-[var(--secondary-color)] text-xs tracking-widest uppercase">
                            Coming Soon
                        </div>
                    @endif

                    @if($product->is_featured)
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-[9px] font-bold tracking-tighter text-white bg-[var(--secondary-color)] uppercase">
                                Exclusive
                            </span>
                        </div>
                    @endif

                    <div class="absolute top-4 right-4 flex flex-col gap-2 opacity-0 translate-y-2 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 ease-out">
                        <button class="w-9 h-9 flex items-center justify-center bg-white/80 backdrop-blur-sm text-[var(--primary-color)] hover:bg-[var(--primary-color)] hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>

                    <div class="absolute inset-x-0 bottom-0 translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out">
                        <button data-id="{{ $product->id }}" class="add-btn w-full py-4 text-xs font-bold uppercase tracking-widest text-white bg-[var(--primary-color)] hover:bg-[var(--primary-hover)] transition-colors">
                            Quick Add to Cart
                        </button>
                    </div>
                </div>
                <script>
document.querySelectorAll('.add-btn').forEach(button => {
    button.addEventListener('click', (event) => {
        const id = event.target.dataset.id;
        window.location.href = `/product/${id}`;
    });
});
</script>

                <div class="mt-6 px-2 pb-4 text-center">
                    <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[var(--secondary-color)] mb-2 block">
                        {{ $product->category->name ?? 'Essentials' }}
                    </span>

                    <h3 class="text-lg font-serif italic text-[var(--text-on-secondary)] mb-2">
                        <a href="{{ route('product.detail', $product->id) }}" class="hover:text-[var(--accent-color)] transition-colors">
                            {{ $product->name }}
                        </a>
                    </h3>

                    <div class="flex items-center justify-center gap-3">
                        <span class="text-base font-medium text-[var(--primary-color)]">
                            Rs.{{ number_format($product->price, 2) }}
                        </span>
                        @if($product->old_price)
                            <span class="text-sm text-neutral-400 line-through decoration-[var(--secondary-color)]">
                                Rs.{{ number_format($product->old_price, 2) }}
                            </span>
                        @endif
                    </div>

                    @if($product->rating)
                        <div class="flex items-center justify-center gap-1 mt-3">
                           <div class="flex text-[var(--secondary-color)]">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-3 h-3 {{ $i < $product->rating ? 'fill-current' : 'text-neutral-300' }}" viewBox="0 0 20 20"><polygon points="10,1 12.6,7 19,7 13.7,11 15.6,17 10,13.5 4.4,17 6.3,11 1,7 7.4,7"/></svg>
                                @endfor
                           </div>
                        </div>
                    @endif
                </div>
            </div>
