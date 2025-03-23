@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div class="h-screen w-full flex flex-col pt-28">
    <div class="grid grid-cols-12 h-full">
        <!-- Filter Options (Left - Smaller) -->
        <div class="col-span-2 p-3">
            <h2 class="text-lg font-bold text-gray-700 mb-3">Filter Options</h2>
            <form action="{{ route('search') }}" method="GET" class="space-y-3">
                <div>
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Status</h3>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(App\Models\KekayaanIntelektual::select('status')->distinct()->get() as $status)
                        <div class="flex items-center space-x-1 px-2 py-1 rounded">
                            <input type="checkbox" name="status[]" id="status_{{ $status->status }}" value="{{ $status->status }}" class="checkbox checkbox-primary scale-90" {{ in_array($status->status, request('status', [])) ? 'checked' : '' }}>
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

        <!-- Search Results (Center) -->
        <div class="col-span-8 p-3">
            <!-- Search Bar -->
            <form action="{{ route('search') }}" method="GET" class="mb-5 input-bordered border border-gray-300 p-2 rounded-full">
                <div class="flex items-center space-x-2">
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search again..." class="w-full bg-transparent rounded-lg px-4 py-2 text-gray-500" required>
                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full transition">
                        <svg fill="#f0f0f0" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490.4 490.4" xml:space="preserve">
                            <g>
                                <path d="M484.1,454.796l-110.5-110.6c29.8-36.3,47.6-82.8,47.6-133.4c0-116.3-94.3-210.6-210.6-210.6S0,94.496,0,210.796
                    s94.3,210.6,210.6,210.6c50.8,0,97.4-18,133.8-48l110.5,110.5c12.9,11.8,25,4.2,29.2,0C492.5,475.596,492.5,463.096,484.1,454.796z
                    M41.1,210.796c0-93.6,75.9-169.5,169.5-169.5s169.6,75.9,169.6,169.5s-75.9,169.5-169.5,169.5S41.1,304.396,41.1,210.796z" />
                            </g>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Search Results -->
            <h1 class="text-xl font-bold text-gray-500 mb-3">Search Results for: "{{ request('query') }}"</h1>

            @if($results->isEmpty())
            <p class="text-red-500 mt-3">No results found.</p>
            @else
            <!-- Table for search results -->
            <div class="overflow-x-auto text-gray-500">
                <table class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-gray-100">
                        <tr class="text-left">
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Nomor Registrasi</th>
                            <th class="px-4 py-2 border">Status</th>
                            <th class="px-4 py-2 border">Pemilik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $result)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $result->title }}</td>
                            <td class="px-4 py-2 border">{{ $result->registration_number }}</td>
                            <td class="px-4 py-2 border">{{ $result->status }}</td>
                            <td class="px-4 py-2 border">{{ $result->owner }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $results->links() }}
            </div>
            @endif

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