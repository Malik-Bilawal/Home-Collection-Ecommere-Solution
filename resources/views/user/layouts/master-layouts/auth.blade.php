<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ config('app.name', 'Grocery Store') }}</title>
</head>
<body class="bg-background text-text">

<style>
     
     :root {
    /* Primary - Dark Premium Black */
    --primary-color: #111827;
    --primary-hover: #000000;
    --secondary-color: #ffffff;
    --secondary-hover: #f3f4f6;
    --accent-color: #10b981;
    --accent-hover: #059669;

    /* Cards */
    --card-background: #FFFFFF;

    /* Text */
    --text-on-primary: #FFFFFF;
    --text-on-secondary: #1f2937;

    /* Backgrounds */
    --background-color: #ffffff;
    --surface-color: #FFFFFF;

    /* Borders */
    --border-color: #e5e7eb;
}
</style>

    <main class="p-6">
        @yield('content')
    </main>

    <footer class="bg-secondary text-black p-4 text-center">
        <p>&copy; {{ date('Y') }} Grocery Store. All rights reserved.</p>
    </footer>

</body>
</html>
