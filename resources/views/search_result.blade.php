{{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\search_result.blade.php --}}
@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="h-screen w-full flex flex-col pt-28">
        <div class="grid grid-cols-12 h-full">
            <!-- Filter Options (Left - Smaller) -->
            <div class="col-span-2 p-3">
                <h2 class="text-lg font-bold text-gray-700 mb-3">Filter Options</h2>
                <form action="{{ route('search') }}" method="GET" class="space-y-3">
                    {{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\search_result.blade.php --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-700 mb-2">Status</h3>
                        <div class="grid grid-cols-2 gap-2"> <!-- Changed grid-cols-1 to grid-cols-2 -->
                            @foreach(App\Models\KekayaanIntelektual::select('status')->distinct()->get() as $status)
                                <div class="flex items-center space-x-1 bg-gray-100 px-2 py-1 rounded">
                                    <input 
                                        type="checkbox" 
                                        name="status[]" 
                                        id="status_{{ $status->status }}" 
                                        value="{{ $status->status }}" 
                                        class="checkbox checkbox-primary scale-90"
                                        {{ in_array($status->status, request('status', [])) ? 'checked' : '' }}>
                                    <label for="status_{{ $status->status }}" class="text-sm text-gray-600">
                                        {{ $status->status }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <select name="category" id="category" class="select select-bordered w-full">
                            <option value="">All Categories</option>
                            <option value="patent" {{ request('category') == 'patent' ? 'selected' : '' }}>Patent</option>
                            <option value="copyright" {{ request('category') == 'copyright' ? 'selected' : '' }}>Copyright</option>
                            <option value="trademark" {{ request('category') == 'trademark' ? 'selected' : '' }}>Trademark</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Apply Filters</button>
                </form>
            </div>

            <!-- Search Results (Wider Center) -->
            <div class="col-span-8 bg-white shadow-md rounded-none p-3">
                <!-- Search Bar -->
                <form action="{{ route('search') }}" method="GET" class="mb-5">
                    <div class="flex items-center space-x-2">
                        <input 
                            type="text" 
                            name="query" 
                            value="{{ request('query') }}" 
                            placeholder="Search again..." 
                            class="input input-bordered w-full"
                            required>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

                <!-- Search Results -->
                <h1 class="text-xl font-bold text-gray-500 mb-3">Search Results for: "{{ request('query') }}"</h1>

                @if($results->isEmpty())
                    <p class="text-red-500 mt-3">No results found.</p>
                @else
                    <ul class="mt-3 space-y-2">
                        @foreach($results as $result)
                            <li class="p-2 border-b text-gray-600">
                                <strong>{{ $result->title }}</strong> - {{ $result->category }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-5">
                    <a href="{{ url('/') }}" class="btn btn-secondary w-full">Back to Search</a>
                </div>
            </div>

            <!-- Related Results (Right - Smaller) -->
            <div class="col-span-2 bg-white shadow-md rounded-none p-3">
                <h2 class="text-lg font-bold text-gray-700 mb-3">Related Results</h2>
                <ul class="space-y-2">
                    {{-- Add related results here if needed --}}
                </ul>
            </div>
        </div>
    </div>
@endsection