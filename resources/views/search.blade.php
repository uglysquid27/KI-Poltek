<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    @vite('resources/css/app.css')
</head>
<body>
    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">daisyUI</a>
        </div>
    </div>

    <!-- Search Form -->
    <div class="container mx-auto mt-10 p-5">
        <h1 class="text-2xl font-bold">Search Kekayaan Intelektual</h1>
        <form action="{{ route('search') }}" method="GET" class="mt-4">
            <input 
                type="text" 
                name="query" 
                placeholder="Cari berdasarkan judul, kategori, atau nomor hak cipta/paten"
                class="input input-bordered w-full max-w-xs"
                required>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</body>
</html>
