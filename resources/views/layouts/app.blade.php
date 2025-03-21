{{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\layouts\app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f0f0f0] min-h-screen flex flex-col">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <div class="flex-grow">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>