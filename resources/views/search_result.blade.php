<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    @vite('resources/css/app.css')
</head>
<body>
    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">daisyUI</a>
        </div>
        <div class="flex-none">
            <a href="{{ url('/') }}" class="btn btn-secondary">Back to Search</a>
        </div>
    </div>

    <!-- Search Results -->
    <div class="container mx-auto mt-10 p-5">
        <h1 class="text-2xl font-bold">Search Results for: "{{ $query }}"</h1>
        
        @if($results->isEmpty())
            <p class="text-red-500 mt-4">No results found.</p>
        @else
            <ul class="mt-4">
                @foreach($results as $result)
                    <li class="p-2 border-b">{{ $result->title }} - {{ $result->category }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>
