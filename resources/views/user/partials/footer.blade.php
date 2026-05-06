<footer class="bg-[var(--primary-color)] text-white pt-16 pb-8">
    <!-- Newsletter Section -->
    <div class="border-b border-white/10">
        <div class="container mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-center md:text-left">
                    <h3 class="font-serif text-2xl md:text-3xl mb-2">Subscribe to Our Newsletter</h3>
                    <p class="text-white/60 text-sm">Get the latest updates on new arrivals and exclusive offers</p>
                </div>
                <form class="flex w-full md:w-auto gap-2">
                    <input type="email" 
                           placeholder="Enter your email" 
                           class="flex-1 md:w-72 px-4 py-3 rounded-full bg-white/10 border border-white/20 text-white placeholder-white/50 focus:outline-none focus:border-[var(--accent-color)]">
                    <button type="submit" 
                            class="px-6 py-3 bg-[var(--accent-color)] text-white font-medium rounded-full hover:bg-[var(--accent-hover)] transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 lg:gap-12">
            
            <!-- Brand -->
            <div class="col-span-2 lg:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-10 h-10 bg-[var(--accent-color)] rounded-lg flex items-center justify-center">
                        <i class="fas fa-shoe-prints text-white text-lg"></i>
                    </div>
                    <div>
                        <span class="font-serif text-xl font-bold">FOOTWEAR</span>
                        <span class="text-[var(--accent-color)] text-xs block -mt-1">PREMIUM</span>
                    </div>
                </div>
                <p class="text-white/60 text-sm mb-6 leading-relaxed">
                    Your destination for premium quality footwear. Crafted for comfort, designed for style.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-[var(--accent-color)] transition-colors">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-[var(--accent-color)] transition-colors">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-[var(--accent-color)] transition-colors">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="#" class="w-9 h-9 flex items-center justify-center rounded-full bg-white/10 hover:bg-[var(--accent-color)] transition-colors">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Shop Categories -->
            @php
            $categories = \App\Models\Category::where('status', 1)->take(6)->get();
            @endphp
            <div>
                <h4 class="text-[var(--accent-color)] font-bold text-xs uppercase tracking-[0.2em] mb-6">Shop</h4>
                <ul class="space-y-3">
                    @foreach($categories as $cat)
                    <li>
                        <a href="{{ route('product', ['category_id' => $cat->id]) }}" 
                           class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                    <li>
                        <a href="{{ route('product') }}" 
                           class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">
                            All Products
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-[var(--accent-color)] font-bold text-xs uppercase tracking-[0.2em] mb-6">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">Home</a></li>
                    <li><a href="{{ route('product') }}" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">Shop</a></li>
                    <li><a href="{{ route('about') }}" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">Contact</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 class="text-[var(--accent-color)] font-bold text-xs uppercase tracking-[0.2em] mb-6">Service</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">Shipping Policy</a></li>
                    <li><a href="#" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">Returns & Exchanges</a></li>
                    <li><a href="#" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">Privacy Policy</a></li>
                    <li><a href="#" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">Terms & Conditions</a></li>
                    <li><a href="#" class="text-white/60 text-sm hover:text-[var(--accent-color)] hover:translate-x-1 transition-all">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-[var(--accent-color)] font-bold text-xs uppercase tracking-[0.2em] mb-6">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-[var(--accent-color)] mt-1"></i>
                        <span class="text-white/60 text-sm">123 Shoe Street, City, Country</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-phone text-[var(--accent-color)]"></i>
                        <span class="text-white/60 text-sm">+92 300 1234567</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope text-[var(--accent-color)]"></i>
                        <span class="text-white/60 text-sm">info@footwear.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Features -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12 pt-12 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                    <i class="fas fa-truck text-[var(--accent-color)]"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">Free Shipping</p>
                    <p class="text-xs text-white/50">On orders over Rs.5000</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                    <i class="fas fa-undo text-[var(--accent-color)]"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">Easy Returns</p>
                    <p class="text-xs text-white/50">30-day return policy</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                    <i class="fas fa-shield-alt text-[var(--accent-color)]"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">Secure Payment</p>
                    <p class="text-xs text-white/50">100% secure checkout</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                    <i class="fas fa-headset text-[var(--accent-color)]"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">24/7 Support</p>
                    <p class="text-xs text-white/50">Dedicated support</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white/10">
        <div class="container mx-auto px-6 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white/30 text-xs uppercase tracking-[0.2em]">
                    © {{ date('Y') }} Footwear Premium. All rights reserved.
                </p>
                <div class="flex items-center gap-6 text-xs text-white/30">
                    <a href="#" class="hover:text-[var(--accent-color)] transition-colors">Privacy</a>
                    <a href="#" class="hover:text-[var(--accent-color)] transition-colors">Terms</a>
                    <a href="#" class="hover:text-[var(--accent-color)] transition-colors">Shipping</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    footer a {
        transition: all 0.3s ease;
    }
    footer a:hover {
        color: var(--accent-color) !important;
    }
</style>