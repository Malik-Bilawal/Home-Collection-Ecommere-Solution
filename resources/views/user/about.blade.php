@extends("user.layouts.master-layouts.plain")

@section("title", "Inhouse Textiles | About Us")

@push("style")
<style>
    /* Define CSS variables */
:root {
    --primary-color: #111827;
    --primary-hover: #000000;
    --secondary-color: #ffffff;
    --secondary-hover: #f3f4f6;
    --card-background: #FFFFFF;
    --accent-color: #10b981;
    --accent-hover: #059669;
    --text-on-primary: #FFFFFF;
    --text-on-secondary: #1f2937;
    --background-color: #ffffff;
    --surface-color: #FFFFFF;
    --border-color: #e5e7eb;
}

    /* Custom animations */
    @keyframes float {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }
        33% {
            transform: translate(30px, -50px) rotate(120deg);
        }
        66% {
            transform: translate(-20px, 20px) rotate(240deg);
        }
        100% {
            transform: translate(0, 0) rotate(360deg);
        }
    }

    .animate-float {
        animation: float 20s infinite linear;
    }

    .animate-float-delay-5 {
        animation: float 25s infinite linear;
        animation-delay: -5s;
    }

    .animate-float-delay-10 {
        animation: float 30s infinite linear;
        animation-delay: -10s;
    }

    /* Button hover effect */
    .modern-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: 0.5s;
    }

    .modern-btn:hover::before {
        left: 100%;
    }

    /* Scroll animation */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>
@endpush

@section("content")
<!-- Modern Hero Section -->
<section class="relative min-h-[85vh] bg-gradient-to-br from-[#680626] via-[#680626] to-[#52041E] bg-cover bg-center bg-fixed overflow-hidden"
         style="background-image: linear-gradient(135deg, rgba(104, 6, 38, 0.95) 0%, rgba(82, 4, 30, 0.85) 100%), url('https://images.unsplash.com/photo-1615529328331-f8917597711f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80')">
    
    <!-- Floating Elements -->
    <div class="absolute top-[10%] right-[5%] w-[300px] h-[300px] rounded-full bg-[rgba(184,154,107,0.1)] border border-[rgba(184,154,107,0.2)] backdrop-blur-sm animate-float"></div>
    <div class="absolute bottom-[15%] left-[10%] w-[200px] h-[200px] rounded-full bg-[rgba(184,154,107,0.1)] border border-[rgba(184,154,107,0.2)] backdrop-blur-sm animate-float-delay-5"></div>
    <div class="absolute top-[40%] left-[15%] w-[150px] h-[150px] rounded-full bg-[rgba(184,154,107,0.1)] border border-[rgba(184,154,107,0.2)] backdrop-blur-sm animate-float-delay-10"></div>
    
    <div class="container mx-auto px-4 relative z-10 flex items-center min-h-[85vh]">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 leading-tight">
                <span class="bg-gradient-to-r from-[#D6CEC3] via-[#B89A6B] to-[#D6CEC3] bg-clip-text text-transparent">
                    Redefining Home<br>
                </span>
                <span class="text-white">Experiences</span>
            </h1>
            <p class="text-xl text-white/90 mb-10 max-w-2xl font-light leading-relaxed">
                We blend traditional craftsmanship with contemporary design to create 
                home essentials that tell stories of comfort, quality, and timeless elegance.
            </p>
            <div class="flex flex-wrap gap-6">
                <a href="/shop" class="relative modern-btn inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-white rounded-full bg-gradient-to-r from-[#B89A6B] to-[#680626] shadow-lg shadow-[#680626]/30 transition-all duration-400 hover:shadow-xl hover:shadow-[#680626]/40 hover:-translate-y-1 overflow-hidden">
                    <i class="fas fa-shopping-bag"></i>
                    Explore Collection
                </a>
                <a href="#our-story" class="inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-white rounded-full border-2 border-white transition-all duration-400 hover:bg-white/10">
                    <i class="fas fa-play-circle"></i>
                    Our Story
                </a>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
        <div class="animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </div>
</section>

<!-- Modern Stats -->
<section class="bg-gradient-to-br from-white to-[#FBF7EE] py-24">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-award"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    13+
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Years of Excellence</div>
                <p class="text-gray-600 mt-4">Dedicated to quality since 2010</p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden" style="transition-delay: 0.1s">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-smile"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    50K+
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Happy Families</div>
                <p class="text-gray-600 mt-4">Transforming homes nationwide</p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden" style="transition-delay: 0.2s">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-gem"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    500+
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Premium Products</div>
                <p class="text-gray-600 mt-4">Curated with meticulous care</p>
            </div>
            
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-[#680626]/10 transition-all duration-400 hover:-translate-y-5 hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden" style="transition-delay: 0.3s">
                <div class="absolute -top-5 -right-5 w-20 h-20 bg-[#FBF7EE] rounded-full flex items-center justify-center text-[#680626] text-3xl opacity-70">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="text-6xl font-extrabold mb-4 bg-gradient-to-r from-[#680626] to-[#B89A6B] bg-clip-text text-transparent">
                    100%
                </div>
                <div class="text-lg font-medium text-[#2A2A2A]">Eco-Friendly</div>
                <p class="text-gray-600 mt-4">Sustainable sourcing & practices</p>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section id="our-story" class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Our Journey
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#680626] mb-6">The Inhouse Textiles Story</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                From a small workshop to a national name, our journey is one of passion, 
                innovation, and unwavering commitment to quality.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="fade-in">
                <div class="relative">
                    <div class="rounded-3xl overflow-hidden shadow-2xl">
                        <img 
                            src="https://images.unsplash.com/photo-1615529328331-f8917597711f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                            alt="Our Workshop" 
                            class="w-full h-[500px] object-cover"
                        >
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-br from-[#680626] to-[#B89A6B] rounded-3xl shadow-xl flex items-center justify-center">
                        <span class="text-white text-5xl font-bold">2010</span>
                    </div>
                </div>
            </div>
            
            <div class="fade-in" style="transition-delay: 0.2s">
                <h3 class="text-3xl font-bold text-[#2A2A2A] mb-8">Crafting Excellence Since 2010</h3>
                <p class="text-lg text-gray-700 mb-6">
                    Rooted in decades of export and wholesale manufacturing experience, Inhouse Textiles is now bringing export-quality textiles at accessible prices. Our story began with a grandfather who ran a textile business in India, and today the third generation is giving that legacy a new direction - connecting directly with customers.
                </p>
                <p class="text-lg text-gray-700 mb-10">
                    Today, we combine traditional craftsmanship with modern design principles, 
                    creating products that are not just functional but tell a story of quality, 
                    sustainability, and timeless beauty.
                </p>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[#FBF7EE] flex items-center justify-center">
                                <i class="fas fa-check text-[#680626]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[#2A2A2A] text-lg">Artisan Quality</h4>
                            <p class="text-gray-600">Every product is crafted with attention to detail and passion.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[#FBF7EE] flex items-center justify-center">
                                <i class="fas fa-check text-[#680626]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[#2A2A2A] text-lg">Sustainable Practices</h4>
                            <p class="text-gray-600">We prioritize eco-friendly materials and ethical production.</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="w-8 h-8 rounded-full bg-[#FBF7EE] flex items-center justify-center">
                                <i class="fas fa-check text-[#680626]"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-semibold text-[#2A2A2A] text-lg">Modern Innovation</h4>
                            <p class="text-gray-600">Blending tradition with contemporary design sensibilities.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Timeline -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Milestones
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#2A2A2A] mb-6">Our Evolution</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Key moments that shaped our journey</p>
        </div>
        
        <div class="relative max-w-6xl mx-auto">
            <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-[#680626] to-[#B89A6B] transform -translate-x-1/2"></div>
            
            <div class="fade-in timeline-item flex items-center mb-20">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        1947
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] ml-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">The Foundation</h3>
                    <p class="text-gray-600">
                        Our grandfather's textile business in India was left behind during partition.
                        Only skill, courage, and belief were carried forward to rebuild in Pakistan.
                    </p>
                </div>
            </div>

            <div class="fade-in timeline-item flex items-center mb-20 flex-row-reverse" style="transition-delay: 0.1s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        1970
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] mr-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">Building Expertise</h3>
                    <p class="text-gray-600">
                        Our father transformed experience into execution, building a strong
                        manufacturing, wholesale and export business for international markets.
                    </p>
                </div>
            </div>

            <div class="fade-in timeline-item flex items-center mb-20" style="transition-delay: 0.2s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2020
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] ml-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">Export Excellence</h3>
                    <p class="text-gray-600">
                        Decades of manufacturing expertise established us as a trusted supplier
                        of export-grade textiles to international brands and retailers.
                    </p>
                </div>
            </div>

            <div class="fade-in timeline-item flex items-center mb-20 flex-row-reverse" style="transition-delay: 0.3s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2024
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] mr-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">Direct to Customer</h3>
                    <p class="text-gray-600">
                        Third generation gives the legacy a new direction, connecting directly
                        with Pakistani customers and bringing export quality to local homes.
                    </p>
                </div>
            </div>

            <div class="fade-in timeline-item flex items-center" style="transition-delay: 0.4s">
                <div class="w-[150px] text-center relative z-10">
                    <span class="bg-gradient-to-r from-[#680626] to-[#B89A6B] text-white px-8 py-4 rounded-full font-bold text-lg inline-block shadow-lg">
                        2026
                    </span>
                </div>
                <div class="flex-1 bg-white p-10 rounded-2xl shadow-lg border border-[#E2DBD1] ml-10">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-4">Future Vision</h3>
                    <p class="text-gray-600">
                        Committed to becoming a trusted household name in Pakistan by
                        delivering export-quality textiles that blend comfort, quality & affordability.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-24 bg-gradient-to-br from-[#FCF9F5] to-[#F5F0E9]">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Our Philosophy
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#2A2A2A] mb-6">Core Values</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Principles that guide every decision we make</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-transparent transition-all duration-400 hover:-translate-y-4 hover:border-[#B89A6B] hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden h-full">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] rounded-2xl flex items-center justify-center text-4xl text-[#680626] mb-10">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#2A2A2A] mb-6">Accessibility</h3>
                <p class="text-gray-600">
                    Premium quality made affordable for everyday homes.
                    We believe export-grade textiles should be accessible to
                    middle and upper-middle class households.
                </p>
            </div>

            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-transparent transition-all duration-400 hover:-translate-y-4 hover:border-[#B89A6B] hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden h-full" style="transition-delay: 0.1s">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] rounded-2xl flex items-center justify-center text-4xl text-[#680626] mb-10">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#2A2A2A] mb-6">Legacy</h3>
                <p class="text-gray-600">
                    Honoring generations of textile expertise. Three generations
                    of skill and knowledge passed down through family, now
                    serving Pakistani homes directly.
                </p>
            </div>

            <div class="fade-in bg-white p-12 rounded-3xl shadow-2xl shadow-[#680626]/10 border border-transparent transition-all duration-400 hover:-translate-y-4 hover:border-[#B89A6B] hover:shadow-3xl hover:shadow-[#680626]/15 relative overflow-hidden h-full" style="transition-delay: 0.2s">
                <div class="w-20 h-20 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] rounded-2xl flex items-center justify-center text-4xl text-[#680626] mb-10">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#2A2A2A] mb-6">Trust</h3>
                <p class="text-gray-600">
                    Built on decades of manufacturing experience and reputation
                    in international markets. Transparent pricing and consistent
                    delivery of export-grade quality.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Heritage -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-20">
            <span class="inline-block px-5 py-2 bg-gradient-to-r from-[#FBF7EE] to-[#F5F0E9] text-[#680626] text-sm font-semibold tracking-widest uppercase rounded-full mb-6">
                Our Heritage
            </span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#2A2A2A] mb-6">Three Generations of Excellence</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">From a grandfather's textile business to export-grade quality for Pakistani homes</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-in bg-white rounded-3xl shadow-2xl shadow-[#680626]/10 overflow-hidden transition-all duration-400 hover:-translate-y-4 hover:shadow-3xl hover:shadow-[#680626]/15 h-full">
                <div class="overflow-hidden h-80">
                    <div class="w-full h-full bg-[#FBF7EE] flex items-center justify-center">
                        <i class="fas fa-user text-[#680626] text-6xl"></i>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-2">Our Grandfather</h3>
                    <p class="text-[#680626] font-semibold mb-4">Founder</p>
                    <p class="text-gray-600 mb-6">
                        Started a textile business in India. During partition,
                        everything was left behind except skill, courage, and belief.
                        In Pakistan, he began again, working in a home-textile shop,
                        learning, observing, and dreaming of rebuilding what was lost.
                    </p>
                </div>
            </div>

            <div class="fade-in bg-white rounded-3xl shadow-2xl shadow-[#680626]/10 overflow-hidden transition-all duration-400 hover:-translate-y-4 hover:shadow-3xl hover:shadow-[#680626]/15 h-full" style="transition-delay: 0.1s">
                <div class="overflow-hidden h-80">
                    <div class="w-full h-full bg-[#FBF7EE] flex items-center justify-center">
                        <i class="fas fa-user text-[#680626] text-6xl"></i>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-2">Our Father</h3>
                    <p class="text-[#680626] font-semibold mb-4">Builder</p>
                    <p class="text-gray-600 mb-6">
                        Transformed experience into execution and built a strong
                        manufacturing, wholesale and export business, supplying
                        quality textiles to international markets for years.
                    </p>
                </div>
            </div>

            <div class="fade-in bg-white rounded-3xl shadow-2xl shadow-[#680626]/10 overflow-hidden transition-all duration-400 hover:-translate-y-4 hover:shadow-3xl hover:shadow-[#680626]/15 h-full" style="transition-delay: 0.2s">
                <div class="overflow-hidden h-80">
                    <div class="w-full h-full bg-[#FBF7EE] flex items-center justify-center">
                        <i class="fas fa-user text-[#680626] text-6xl"></i>
                    </div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-[#2A2A2A] mb-2">Our Generation</h3>
                    <p class="text-[#680626] font-semibold mb-4">Innovation</p>
                    <p class="text-gray-600 mb-6">
                        Today, the third generation is giving that legacy a new direction.
                        Inhouse Textiles is stepping out from behind the scenes to connect
                        directly with customers—bringing the same export grade quality
                        and honesty into Pakistani homes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Heritage CTA -->
<section class="relative py-24 bg-gradient-to-r from-[#680626] to-[#B89A6B] overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10">
        <div class="absolute -top-20 -left-20 w-64 h-64 rounded-full bg-white"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-white"></div>
    </div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="fade-in text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-10 leading-tight">
            Experience Three Generations<br>
            Of Textile Excellence
        </h2>
        <p class="fade-in text-xl text-white/90 max-w-2xl mx-auto mb-12" style="transition-delay: 0.1s">
            Discover our heritage collection of export-grade textiles,
            bringing decades of manufacturing expertise directly to Pakistani homes.
        </p>
        <div class="fade-in flex flex-wrap gap-6 justify-center" style="transition-delay: 0.2s">
            <a href="/shop" class="relative modern-btn inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-[#680626] rounded-full bg-white shadow-lg shadow-black/20 transition-all duration-400 hover:shadow-xl hover:shadow-black/30 hover:-translate-y-1 overflow-hidden">
                <i class="fas fa-shopping-cart"></i>
                Shop Collection
            </a>
            <a href="/contact" class="inline-flex items-center gap-3 px-9 py-5 text-lg font-semibold text-white rounded-full border-2 border-white transition-all duration-400 hover:bg-white/10">
                <i class="fas fa-comment-alt"></i>
                Book Consultation
            </a>
        </div>
    </div>
</section>
@endsection

@push("script")
<script>
    // Scroll Animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

    // Parallax effect for hero
    document.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('section[style*="background-image"]');
        if (parallax) {
            parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Animate stats on view
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.text-6xl');
                statNumbers.forEach(stat => {
                    const text = stat.textContent;
                    const target = parseInt(text.replace('+', ''));
                    const suffix = text.includes('+') ? '+' : '';
                    let current = 0;
                    const increment = target / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            stat.textContent = target + suffix;
                            clearInterval(timer);
                        } else {
                            stat.textContent = Math.floor(current) + suffix;
                        }
                    }, 30);
                });
            }
        });
    }, { threshold: 0.5 });

    // Observe stats section
    const statsSection = document.querySelector('section.bg-gradient-to-br.from-white');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Team card hover effect
    document.querySelectorAll('.group-hover\\:opacity-100').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('group');
        });
    });
</script>
@endpush