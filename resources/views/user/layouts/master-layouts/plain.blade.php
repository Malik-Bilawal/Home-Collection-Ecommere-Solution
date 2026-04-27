<!DOCTYPE html>
<html lang="en" class="h-full">

<head>




  <meta charset="UTF-8">
  <title>@yield('title', 'Page')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <link rel="icon" href="/abc.png" type="image/png">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>



  @stack('style')
  <style>
    :root {
      /* Primary - Dark Premium Black */
      --primary-color: #111827;
      /* Darker Black */
      --primary-hover: #000000;
      /* Secondary - White */
      --secondary-color: #ffffff;
      /* White hover */
      --secondary-hover: #f3f4f6;
      /* Accent - Emerald Teal */
      --accent-color: #10b981;
      /* Deeper Teal */
      --accent-hover: #059669;
      /* Cards */
      --card-background: #FFFFFF;
      /* Text */
      --text-on-primary: #FFFFFF;
      --text-on-secondary: #1f2937;
      /* Backgrounds */
      --background-color: #ffffff;
      /* White */
      --surface-color: #FFFFFF;
      /* Borders */
      --border-color: #e5e7eb;
    }

    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body class="overflow-x-hidden bg-body">
  <div id="loader">
    <div class="spinner"></div>
  </div>

  <!-- Navbar -->

  @include('user.partials.navbar')

  @yield('content')

  <!-- Footer -->
  @include('user.partials.footer')

  <script>
    console.log('loader showing')
    window.addEventListener('load', () => {
      const loader = document.getElementById('loader');
      console.log('loader hiding')
      loader.style.display = 'none';
    });
  </script>

  @stack('script')
</body>

</html>