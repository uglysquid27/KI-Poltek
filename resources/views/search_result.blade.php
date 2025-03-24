@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="min-h-screen w-full flex flex-col pt-28">
        <div class="grid grid-cols-12">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Search Results (Center) -->
            <div class="col-span-8 p-3">
                <!-- Search Bar -->
                <form action="{{ route('search') }}" method="GET"
                    class="mb-5 input-bordered border border-gray-300 p-2 rounded-full">
                    <div class="flex items-center space-x-2 ">
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search again..."
                        class="w-full bg-transparent rounded-lg px-4 py-2 text-gray-500 focus:outline-none focus:ring-0" required>
                        <button type="submit"
                            class="w-10 h-10 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-full transition">
                            <svg fill="#f0f0f0" height="20px" width="20px" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 490.4 490.4" xml:space="preserve">
                                <g>
                                    <path
                                        d="M484.1,454.796l-110.5-110.6c29.8-36.3,47.6-82.8,47.6-133.4c0-116.3-94.3-210.6-210.6-210.6S0,94.496,0,210.796
                                            s94.3,210.6,210.6,210.6c50.8,0,97.4-18,133.8-48l110.5,110.5c12.9,11.8,25,4.2,29.2,0C492.5,475.596,492.5,463.096,484.1,454.796z
                                            M41.1,210.796c0-93.6,75.9-169.5,169.5-169.5s169.6,75.9,169.6,169.5s-75.9,169.5-169.5,169.5S41.1,304.396,41.1,210.796z" />
                                </g>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Search Results -->
                <h1 class="text-xl font-bold text-gray-500 mb-3">Search Results for: "{{ request('query') }}"</h1>

                <!-- Filter Options -->
                 <form action="{{ route('search') }}" method="GET" id="filterForm" class="flex items-center space-x-2 my-3">
        <!-- Preserve the search query -->
        <input type="hidden" name="query" value="{{ request('query') }}">

        <!-- Sort Dropdown -->
        {{-- <label for="sort" class="text-sm font-medium text-gray-600">Sort By:</label> --}}
        <select name="sort" id="sort" class="select select-bordered text-gray-600 bg-transparent w-1/8 border-1 border-gray-500 rounded-full" onchange="document.getElementById('filterForm').submit();">
            <option value="">Select</option>
            <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Date</option>
            <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A - Z</option>
        </select>
    </form>

                @if($results->isEmpty())
                    <p class="text-red-500 mt-3">No results found.</p>
                @else
                    <!-- Card-based Search Results -->
                    <div class="space-y-4">
                        @foreach($results as $result)
                            <a href="/link/{{ $result->id }}" class="block">
                                <div class="flex flex-col border-b pb-4 border-gray-300">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-start w-full gap-4">
                                            <div class="flex flex-col gap-1 flex-1">
                                                <!-- Title -->
                                                <h1 class="text-md md:text-lg font-bold cursor-pointer text-gray-600">
                                                    <span>{{ $result->title }}</span>
                                                </h1>
                                                <!-- Status and Registration Number -->
                                                <div class="flex flex-col md:flex-row gap-2 md:items-center">
                                                    <div>
                                                        <div
                                                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-blue-200 text-blue-700 hover:bg-blue-200">
                                                            {{ ucfirst($result->status) }}
                                                        </div>
                                                    </div>
                                                    <p class="text-gray-400 font-medium text-sm text-gray-500">
                                                        {{ $result->registration_number }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

<!-- Pagination -->
@if ($results->hasPages())
    <div class="mt-5">
        {{ $results->appends(request()->query())->links() }}
    </div>
@endif
            </div>

            <!-- Related Results (Right - Smaller) -->
            {{-- <div class="col-span-2 bg-white shadow-md rounded-none p-3">
                <h2 class="text-lg font-bold text-gray-700 mb-3">Related Results</h2>
                <ul class="space-y-2">
                </ul>
            </div> --}}
        </div>
    </div>
@endsection