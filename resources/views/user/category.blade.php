@extends("user.layouts.master-layouts.plain")

<title>Inhouse Textiles | Category</title>



@push("style")
<style>
  :root {
    --primary-color: #111827;
    --primary-hover: #000000;
    --secondary-color: #ffffff;
    --secondary-hover: #f3f4f6;
    --accent-color: #10b981;
    --accent-hover: #059669;
    --text-on-primary: #FFFFFF;
    --text-on-secondary: #1f2937;
    --background-color: #ffffff;
    --card-background: #FFFFFF;
    --border-color: #e5e7eb;
    --text-color: #1f2937;
  }

  body {
    font-family: 'Inter', sans-serif;
    color: var(--text-color);
  }

  .btn-primary {
    background-color: var(--primary-color);
    color: white;
  }

  .btn-primary:hover {
    background-color: var(--secondary-color);
  }

  .text-primary {
    color: var(--primary-color);
  }

  .bg-primary {
    background-color: var(--primary-color);
  }

  .border-primary {
    border-color: var(--primary-color);
  }

  .bg-accent {
    background-color: var(--accent-color);
  }

  .categories-hero-bg {
    background: linear-gradient(135deg, rgba(75, 54, 33, 0.85) 0%, rgba(107, 79, 51, 0.8) 100%), url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
    background-size: cover;
    background-position: center;
  }

  .color-picker {
    position: fixed;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    background: white;
    padding: 10px;
    border-radius: 8px 0 0 8px;
    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .color-option {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin: 5px;
    cursor: pointer;
    border: 2px solid transparent;
  }

  .color-option.active {
    border-color: #333;
  }

  .category-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
  }

  .category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
  }

  .category-image {
    transition: transform 0.5s ease;
  }

  .category-card:hover .category-image {
    transform: scale(1.05);
  }

  .filter-btn {
    transition: all 0.3s ease;
  }

  .filter-btn.active {
    background-color: var(--primary-color);
    color: white;
  }
</style>
@endpush


@section("content")
<section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-[var(--background-color)]">

  <div class="absolute inset-0 opacity-[0.04] pointer-events-none"
    style="background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png');"></div>

  <div class="absolute inset-0"
    style="background: radial-gradient(circle at center, transparent 0%, rgba(229, 213, 195, 0.3) 100%);"></div>

  <div class="absolute top-20 left-10 w-[300px] h-[1px] bg-[var(--secondary-color)] opacity-20 hidden md:block"></div>
  <div class="absolute bottom-20 right-10 w-[300px] h-[1px] bg-[var(--secondary-color)] opacity-20 hidden md:block"></div>

  <div class="container mx-auto px-6 relative z-20">
    <div class="flex flex-col items-center text-center">

      <div class="mb-8" data-aos="fade-down">
        <span class="inline-flex items-center gap-3 uppercase tracking-[0.5em] text-[10px] font-bold text-[var(--accent-color)]">
          <span class="w-8 h-[1px] bg-[var(--secondary-color)]"></span>
          The 2024 Collection
          <span class="w-8 h-[1px] bg-[var(--secondary-color)]"></span>
        </span>
      </div>

      <h1 class="text-6xl md:text-9xl font-serif text-[var(--primary-color)] leading-[0.9] mb-10" data-aos="zoom-out" data-aos-duration="1500">
        Quiet <br>
        <span class="italic font-light text-[var(--secondary-color)] ml-4 md:ml-20">Luxury.</span>
      </h1>

      <p class="max-w-xl text-lg md:text-xl text-[var(--primary-color)] opacity-70 font-light leading-relaxed mb-14 px-4" data-aos="fade-up" data-aos-delay="400">
        Step into a world where every detail is deliberate. Our furniture blends
        <span class="font-medium text-[var(--primary-color)]">organic textures</span> with
        <span class="font-medium text-[var(--primary-color)]">timeless silhouettes</span>.
      </p>

      <div class="flex flex-col sm:flex-row gap-10 items-center" data-aos="fade-up" data-aos-delay="600">

        <a href="#categories"
          class="group relative px-14 py-5 bg-[var(--primary-color)] text-[var(--text-on-primary)] transition-all duration-500 hover:shadow-[0_20px_40px_rgba(107,66,38,0.2)]">
          <span class="relative z-10 uppercase tracking-[0.3em] text-xs font-bold">Discover More</span>
          <div class="absolute inset-0 bg-[var(--primary-hover)] scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-500"></div>
        </a>

        <a href="#products"
          class="group flex items-center gap-5 text-[var(--primary-color)]">
          <span class="uppercase tracking-[0.3em] text-xs font-bold group-hover:text-[var(--secondary-color)] transition-colors">View Lookbook</span>
          <div class="relative w-12 h-12 flex items-center justify-center border border-[var(--border-color)] rounded-full group-hover:border-[var(--secondary-color)] group-hover:bg-[var(--secondary-color)] group-hover:text-white transition-all duration-500">
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="absolute bottom-10 left-10 text-[var(--border-color)] text-[10px] uppercase tracking-[1em] vertical-text hidden lg:block" style="writing-mode: vertical-rl;">
    Crafted For Comfort
  </div>

</section>

<section id="categories" class="relative py-28 bg-[var(--background-color)] overflow-hidden">
  <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-[var(--border-color)] opacity-20 rounded-full blur-[120px]"></div>
  <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-[var(--secondary-color)] opacity-10 rounded-full blur-[100px]"></div>

  <div class="container mx-auto px-6 relative z-10">
    <div class="max-w-3xl mx-auto text-center mb-20" data-aos="fade-up">
      <h2 class="text-4xl md:text-6xl font-serif text-[var(--primary-color)] mb-6 tracking-tight">
        The <span class="italic text-[var(--secondary-color)]">Signature</span> Series
      </h2>
      <p class="text-[var(--primary-color)] opacity-70 uppercase tracking-[0.2em] text-sm font-medium">
        Curated Excellence • Handcrafted Quality
      </p>
      <div class="mt-8 flex justify-center items-center gap-4">
        <div class="h-[1px] w-12 bg-[var(--border-color)]"></div>
        <div class="w-2 h-2 rotate-45 border border-[var(--secondary-color)]"></div>
        <div class="h-[1px] w-12 bg-[var(--border-color)]"></div>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
      @foreach ($categories as $index => $category)
      <div class="group relative bg-[var(--surface-color)] p-4 border border-[var(--border-color)] transition-all duration-700 hover:border-[var(--secondary-color)] shadow-sm hover:shadow-2xl"
        data-aos="fade-up"
        data-aos-delay="{{ $index * 100 }}">

        <div class="relative h-[450px] overflow-hidden bg-[var(--background-color)]">
          <img
            src="{{ $category->image ? asset('storage/app/public/' . $category->image) : asset('images/default-category.jpg') }}"
            alt="{{ $category->name }}"
            class="w-full h-full object-cover transition-transform duration-[2s] group-hover:scale-110">

          <div class="absolute top-4 right-4 bg-[var(--surface-color)]/90 backdrop-blur-md px-4 py-1 border border-[var(--border-color)] z-20">
            <p class="text-[10px] tracking-[0.2em] uppercase text-[var(--primary-color)]">
              Est. 2024
            </p>
          </div>

          <div class="absolute inset-0 bg-[var(--primary-color)]/10 opacity-0 group-hover:opacity-100 transition-opacity duration-700 z-10"></div>
        </div>

        <div class="pt-8 pb-4 text-center">
          <h3 class="text-2xl font-serif text-[var(--primary-color)] group-hover:text-[var(--secondary-color)] transition-colors duration-500 mb-3">
            {{ $category->name }}
          </h3>

          <p class="text-sm text-[var(--primary-color)] opacity-60 mb-6 px-4 line-clamp-2 italic">
            {{ $category->description ?? 'Redefining the standards of modern luxury and craftsmanship.' }}
          </p>

          <div class="relative overflow-hidden inline-block">
            <a href="{{ route('product', ['category_id' => $category->id]) }}"
              class="inline-block text-[var(--primary-color)] text-xs uppercase tracking-[0.3em] font-bold py-2 group-hover:text-[var(--secondary-hover)] transition-colors">
              View Collection
            </a>
            <div class="h-[1px] w-full bg-[var(--secondary-color)] transform translate-x-[-101%] group-hover:translate-x-0 transition-transform duration-500"></div>
          </div>
        </div>

        <div class="absolute bottom-0 left-0 w-0 h-0 border-b-2 border-l-2 border-[var(--secondary-color)] transition-all duration-500 group-hover:w-8 group-hover:h-8"></div>
      </div> @endforeach
    </div> </div>
</section>

<!-- Featured Products Section -->
<section id="featured" class="py-16 bg-white">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12" data-aos="fade-up">
      <div class="mb-8" data-aos="fade-down">
        <div class="max-w-3xl mx-auto text-center mb-20" data-aos="fade-up">
          <h2 class="text-4xl md:text-6xl font-serif text-[var(--primary-color)] mb-6 tracking-tight">
            The <span class="italic text-[var(--secondary-color)]">Signature</span> Series
          </h2>
          <p class="text-[var(--primary-color)] opacity-70 uppercase tracking-[0.2em] text-sm font-medium">
            Curated Excellence • Handcrafted Quality
          </p>
          <div class="mt-8 flex justify-center items-center gap-4">
            <div class="h-[1px] w-12 bg-[var(--border-color)]"></div>
            <div class="w-2 h-2 rotate-45 border border-[var(--secondary-color)]"></div>
            <div class="h-[1px] w-12 bg-[var(--border-color)]"></div>
          </div>
        </div>

      </div>

      <div class="w-full px-4 lg:px-8 mx-auto">
        <div class="products-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          @foreach($products as $product)
          @include('user.partials.home-product-cards', ['product' => $product])
          @endforeach
        </div>
      </div>
      <div class="text-center mt-10" data-aos="fade-up">
        <a href="/product" class="btn-primary px-8 py-3 rounded-lg font-medium text-lg">View All Products</a>
      </div>
    </div>
</section>


@endsection


@push("script")

<script>
  // Initialize AOS (Animate On Scroll)
  document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }

    // Category filtering functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const categoryCards = document.querySelectorAll('.category-card');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        // Update active button
        filterButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const filterValue = button.getAttribute('data-filter');

        // Filter category cards
        categoryCards.forEach(card => {
          if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
            card.style.display = 'block';
            // Add animation
            card.style.animation = 'fadeIn 0.5s ease forwards';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // Theme color changer
    const colorOptions = document.querySelectorAll('.color-option');

    colorOptions.forEach(option => {
      option.addEventListener('click', () => {
        // Update active color
        colorOptions.forEach(opt => opt.classList.remove('active'));
        option.classList.add('active');

        // Get the selected color
        const newColor = option.getAttribute('data-color');

        // Update CSS variables
        document.documentElement.style.setProperty('--primary-color', newColor);

        // Calculate secondary color (darker shade)
        const secondaryColor = shadeColor(newColor, -20);
        document.documentElement.style.setProperty('--secondary-color', secondaryColor);
      });
    });

    // Helper function to shade colors
    function shadeColor(color, percent) {
      let R = parseInt(color.substring(1, 3), 16);
      let G = parseInt(color.substring(3, 5), 16);
      let B = parseInt(color.substring(5, 7), 16);

      R = parseInt(R * (100 + percent) / 100);
      G = parseInt(G * (100 + percent) / 100);
      B = parseInt(B * (100 + percent) / 100);

      R = (R < 255) ? R : 255;
      G = (G < 255) ? G : 255;
      B = (B < 255) ? B : 255;

      const RR = ((R.toString(16).length == 1) ? "0" + R.toString(16) : R.toString(16));
      const GG = ((G.toString(16).length == 1) ? "0" + G.toString(16) : G.toString(16));
      const BB = ((B.toString(16).length == 1) ? "0" + B.toString(16) : B.toString(16));

      return "#" + RR + GG + BB;
    }
  });
</script>
@endpush