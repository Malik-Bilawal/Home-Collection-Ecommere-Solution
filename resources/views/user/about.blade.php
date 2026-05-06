@extends("user.layouts.master-layouts.plain")

@section("title", "Footwear Premium | About Us")

@push("style")
<style>
    :root {
        --primary-color: #111827;
        --accent-color: #10b981;
        --accent-hover: #059669;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-fade-in {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    .hero-bg {
        background: linear-gradient(135deg, rgba(17, 24, 39, 0.95) 0%, rgba(17, 24, 39, 0.8) 100%), 
            url('https://images.unsplash.com/photo-1552308995-4b8c7d5d0d5c?w=1920&q=80');
        background-size: cover;
        background-position: center;
    }

    .stat-card {
        transition: all 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
    }
</style>
@endpush

@section("content")

<!-- Hero Section -->
<section class="relative min-h-[80vh] hero-bg overflow-hidden flex items-center">
    <!-- Floating Elements -->
    <div class="absolute top-20 right-10 w-32 h-32 rounded-full bg-emerald-500/10 border border-emerald-500/20 animate-float"></div>
    <div class="absolute bottom-20 left-10 w-24 h-24 rounded-full bg-emerald-500/10 border border-emerald-500/20 animate-float" style="animation-delay: -2s"></div>
    <div class="absolute top-1/2 right-1/4 w-16 h-16 rounded-full bg-emerald-500/10 border border-emerald-500/20 animate-float" style="animation-delay: -4s"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-block text-xs font-bold text-emerald-400 uppercase tracking-[0.3em] mb-4">About Us</span>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight">
                Step Into <br>
                <span class="text-emerald-400">Quality & Style</span>
            </h1>
            <p class="text-lg text-white/80 mb-8 max-w-xl leading-relaxed">
                We are dedicated to providing premium footwear that combines comfort, durability, and contemporary design. Every step you take is a testament to our commitment to quality.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('product') }}" class="px-8 py-4 bg-emerald-500 text-white font-semibold rounded-full hover:bg-emerald-600 transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/30">
                    Shop Now
                </a>
                <a href="#our-story" class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-full hover:bg-white/10 transition-all duration-300">
                    Our Story
                </a>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <i class="fas fa-chevron-down text-white/50 text-xl"></i>
    </div>
</section>

<!-- Stats Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="stat-card bg-white p-8 rounded-2xl shadow-sm text-center border border-gray-100">
                <div class="text-4xl font-bold text-emerald-600 mb-2">10+</div>
                <div class="text-gray-600 font-medium">Years Experience</div>
            </div>
            <div class="stat-card bg-white p-8 rounded-2xl shadow-sm text-center border border-gray-100">
                <div class="text-4xl font-bold text-emerald-600 mb-2">50K+</div>
                <div class="text-gray-600 font-medium">Happy Customers</div>
            </div>
            <div class="stat-card bg-white p-8 rounded-2xl shadow-sm text-center border border-gray-100">
                <div class="text-4xl font-bold text-emerald-600 mb-2">100+</div>
                <div class="text-gray-600 font-medium">Premium Styles</div>
            </div>
            <div class="stat-card bg-white p-8 rounded-2xl shadow-sm text-center border border-gray-100">
                <div class="text-4xl font-bold text-emerald-600 mb-2">4.9</div>
                <div class="text-gray-600 font-medium">Average Rating</div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section id="our-story" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">Our Journey</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mt-3">The Footwear Premium Story</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">From humble beginnings to becoming a trusted name in premium footwear</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <div class="rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80" 
                         alt="Premium Shoes" 
                         class="w-full h-[400px] object-cover">
                </div>
                <div class="absolute -bottom-6 -right-6 bg-emerald-500 text-white p-6 rounded-xl shadow-lg">
                    <div class="text-3xl font-bold">Since</div>
                    <div class="text-xl">2016</div>
                </div>
            </div>

            <div>
                <h3 class="text-2xl font-serif font-bold text-gray-900 mb-4">Crafting Comfort Since 2016</h3>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Founded with a vision to revolutionize the footwear industry, Footwear Premium has been committed to delivering shoes that blend style with exceptional comfort. Our journey began with a simple belief: everyone deserves footwear that feels as good as it looks.
                </p>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Today, we offer an extensive collection of shoes, sandals, and footwear accessories, all crafted with premium materials and designed for the modern lifestyle. Our commitment to quality has made us a trusted choice for thousands of customers across the country.
                </p>

                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-award text-emerald-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Premium Quality</h4>
                            <p class="text-sm text-gray-500">Certified materials</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-shoe-prints text-emerald-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Comfort First</h4>
                            <p class="text-sm text-gray-500">Ergonomic design</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-truck text-emerald-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Fast Delivery</h4>
                            <p class="text-sm text-gray-500">Nationwide shipping</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-headset text-emerald-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">24/7 Support</h4>
                            <p class="text-sm text-gray-500">Always here to help</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-20 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-[0.3em]">Why Choose Us</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold mt-3">The Footwear Premium Difference</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-800/50 p-8 rounded-2xl border border-gray-700 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-14 h-14 rounded-xl bg-emerald-500/20 flex items-center justify-center mb-6">
                    <i class="fas fa-gem text-2xl text-emerald-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Premium Materials</h3>
                <p class="text-gray-400 leading-relaxed">We source only the finest materials to ensure durability, comfort, and style that lasts.</p>
            </div>

            <div class="bg-gray-800/50 p-8 rounded-2xl border border-gray-700 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-14 h-14 rounded-xl bg-emerald-500/20 flex items-center justify-center mb-6">
                    <i class="fas fa-pencil-ruler text-2xl text-emerald-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Expert Craftsmanship</h3>
                <p class="text-gray-400 leading-relaxed">Every pair is crafted with precision and attention to detail by skilled artisans.</p>
            </div>

            <div class="bg-gray-800/50 p-8 rounded-2xl border border-gray-700 hover:border-emerald-500/50 transition-all duration-300">
                <div class="w-14 h-14 rounded-xl bg-emerald-500/20 flex items-center justify-center mb-6">
                    <i class="fas fa-heart text-2xl text-emerald-400"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">Customer First</h3>
                <p class="text-gray-400 leading-relaxed">Your satisfaction is our priority. We offer easy returns and dedicated support.</p>
            </div>
        </div>
    </div>
</section>

<!-- Categories We Offer -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">What We Offer</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mt-3">Our Collection</h2>
            <p class="text-gray-600 mt-4 max-w-xl mx-auto">Discover our wide range of premium footwear</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @php
            $categories = [
                ['name' => 'Sneakers', 'icon' => 'fa-running', 'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&q=80'],
                ['name' => 'Formal Shoes', 'icon' => 'fa-briefcase', 'image' => 'https://images.unsplash.com/photo-1614252369475-531eba835eb1?w=400&q=80'],
                ['name' => 'Sandals', 'icon' => 'fa-shoe-prints', 'image' => 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?w=400&q=80'],
                ['name' => 'Loafers', 'icon' => 'fa-walking', 'image' => 'https://images.unsplash.com/photo-1533867617858-e7b97e060509?w=400&q=80'],
                ['name' => 'Boots', 'icon' => 'fa-boot', 'image' => 'https://images.unsplash.com/photo-1608256246200-53e635b5b65f?w=400&q=80'],
                ['name' => 'Slippers', 'icon' => 'fa-home', 'image' => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=400&q=80'],
            ];
            @endphp

            @foreach($categories as $cat)
            <a href="{{ route('product') }}" class="group relative aspect-square rounded-xl overflow-hidden">
                <img src="{{ $cat['image'] }}" alt="{{ $cat['name'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <i class="fas {{ $cat['icon'] }} text-emerald-400 mb-2 block"></i>
                    <span class="text-white font-semibold">{{ $cat['name'] }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">Testimonials</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mt-3">What Our Customers Say</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex text-yellow-400 mb-4">
                    @for($i = 0; $i < 5; $i++) <i class="fas fa-star"></i> @endfor
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">"The quality is outstanding! These are the most comfortable shoes I've ever owned. Highly recommended!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">A</div>
                    <div>
                        <p class="font-semibold text-gray-900">Ali Ahmad</p>
                        <p class="text-sm text-gray-500">Verified Buyer</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex text-yellow-400 mb-4">
                    @for($i = 0; $i < 5; $i++) <i class="fas fa-star"></i> @endfor
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">"Great variety and excellent customer service. Fast delivery and the shoes look exactly as shown."</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">S</div>
                    <div>
                        <p class="font-semibold text-gray-900">Sara Khan</p>
                        <p class="text-sm text-gray-500">Verified Buyer</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex text-yellow-400 mb-4">
                    @for($i = 0; $i < 5; $i++) <i class="fas fa-star"></i> @endfor
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">"Perfect fit and amazing style. I've been shopping here for years and never been disappointed!"</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">M</div>
                    <div>
                        <p class="font-semibold text-gray-900">Muhammad Rashid</p>
                        <p class="text-sm text-gray-500">Verified Buyer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-emerald-500">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-serif font-bold text-white mb-4">Ready to Step In Style?</h2>
        <p class="text-white/80 mb-8 max-w-xl mx-auto">Explore our premium collection of footwear and find your perfect pair today.</p>
        <a href="{{ route('product') }}" class="inline-flex items-center gap-3 px-10 py-5 bg-white text-emerald-600 font-bold rounded-full hover:shadow-xl transition-all duration-300">
            <span>Shop Now</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

@endsection