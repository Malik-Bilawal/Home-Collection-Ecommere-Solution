<footer class="relative mt-32 pt-24 pb-12 overflow-hidden bg-[var(--primary-color)] text-[var(--surface-color)]">

    <div class="absolute inset-0 opacity-[0.08] pointer-events-none mix-blend-overlay"
        style="background-image: url('https://www.transparenttextures.com/patterns/asfalt-light.png');"></div>

    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-24 bg-gradient-to-b from-[var(--secondary-color)] to-transparent"></div>

    <div class="container mx-auto px-6 relative z-10">


        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-12 mb-20">

            <div class="col-span-2 lg:col-span-2 space-y-8">
                <a href="/" class="text-3xl font-serif tracking-widest text-white">
                    INHOUSE<span class="text-[var(--secondary-color)]"> TEXTILES</span>

                </a>
                <p class="text-white/50 font-light leading-relaxed max-w-xs text-sm">
                    Elevating the art of living through sustainable craftsmanship and timeless aesthetic. Your sanctuary, perfected.
                </p>
                <div class="flex gap-6 opacity-60">
                    <a href="#" class="hover:text-[var(--secondary-color)] hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="hover:text-[var(--secondary-color)] hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="hover:text-[var(--secondary-color)] hover:-translate-y-1 transition-all duration-300">
                        <i class="fab fa-pinterest-p text-xl"></i>
                    </a>
                </div>
            </div>
            @php
            use App\Models\Category;
            $categories = Category::where('status', 1)->take('5')->orderBy('created_at', 'desc')->get();
            @endphp
            <div>
                <h4 class="text-[var(--secondary-color)] font-bold tracking-[0.2em] text-[10px] uppercase mb-8">Collections</h4>
                <ul class="space-y-4">
                    @foreach($categories as $cat)
                    <li><a href="{{ route('product', ['category_id' => $cat->id]) }}" class="footer-link text-xs uppercase tracking-widest text-white/60">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-[var(--secondary-color)] font-bold tracking-[0.2em] text-[10px] uppercase mb-8">Heritage</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('/') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Home</a></li>
                    <li><a href="{{ url('/product')  }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Product</a></li>
                    <li><a href="{{ url('/category') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Category</a></li>
                    <li><a href="{{ url('/about') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">About</a></li>
                    <li><a href="{{ url('/contact') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Contact</a></li>

                </ul>
            </div>

            <div>
                <h4 class="text-[var(--secondary-color)] font-bold tracking-[0.2em] text-[10px] uppercase mb-8">Services</h4>
                <ul class="space-y-4">
                    <li><a href="{{ url('policies') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Shipping Policy</a></li>
                    <li><a href="{{ url('policies') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Privacy Policy</a></li>
                    <li><a href="{{ url('policies') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Warranty InformatioN</a></li>
                    <li><a href="{{ url('policies') }}" class="footer-link text-xs uppercase tracking-widest text-white/60">Terms & Services</a></li>

                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-white/20 text-[10px] uppercase tracking-[0.2em]">© {{ date('Y') }} Developed By The Helpex Pvt Ltd.</p>

            <div class="absolute bottom-0 left-0 w-full overflow-hidden pointer-events-none opacity-[0.02]">
                <h2 class="text-[18vw] font-serif leading-none translate-y-1/2">INHOUSE</h2>
            </div>

            <div class="flex gap-8 text-[10px] uppercase tracking-[0.2em] text-white/30">
                <a href="" data-name="privacy" class=" link hover:text-[var(--secondary-color)] transition-colors">Privacy</a>
                <a href="" data-name="terms" class="link hover:text-[var(--secondary-color)] transition-colors">Terms</a>
                <a href="" data-name="shipping" class="link hover:text-[var(--secondary-color)] transition-colors">Shipping</a>

            </div>
        </div>
    </div>
</footer>
<script>
const links = document.querySelectorAll('.link');
links.forEach(li => {
    li.addEventListener('click', (e) => {
        const page = li.getAttribute('data-name');
        localStorage.setItem('selectedPolicy', page); 
        window.location.href = '/policies'; 
    });
});

</script>

<style>
    /* Premium Hover Animation */
    .footer-link {
        display: inline-block;
        transition: all 0.4s ease;
        position: relative;
    }

    .footer-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background-color: var(--secondary-color);
        transition: width 0.4s ease;
    }

    .footer-link:hover {
        color: white;
        letter-spacing: 0.2em;
    }

    .footer-link:hover::after {
        width: 100%;
    }
</style>