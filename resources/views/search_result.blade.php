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
                    class="mb-5 input-bordered border border-gray-600 p-2 rounded-full">

                    <div class="flex items-center space-x-2 ">
                        <div class="relative w-1/7">
                            <button id="dropdownButton" type="button"
                                class="w-full bg-transparent border border-gray-600 text-gray-600 rounded-full px-4 py-2 text-left focus:outline-none">
                                <span id="dropdownSelected">
                                    {{ request('filter') ? ucfirst(request('filter')) : 'Hak Cipta' }}
                                </span>
                                <svg class="w-5 h-5 inline-block float-right" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul id="dropdownMenu"
                                class="absolute z-10 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-full mt-1 opacity-0 transform scale-95 transition-all duration-300 ease-in-out">
                                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-600" data-value="hak_cipta">
                                    Hak Cipta
                                </li>
                                <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-600" data-value="paten">
                                    Paten</li>
                            </ul>
                            <input type="hidden" name="filter" id="filter" value="{{ request('filter') ?? 'hak_cipta' }}">
                        </div>
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search again..."
                            class="w-full bg-transparent rounded-lg px-4 py-2 text-gray-500 focus:outline-none focus:ring-0"
                            required>
                            <button type="submit"
                            class="px-3 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full">
                            <svg fill="#f0f0f0" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490.4 490.4" xml:space="preserve">
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
                <h1 class="text-xl font-bold text-gray-500 mb-3">
                    {{ $results->total() }} result{{ $results->total() > 1 ? 's' : '' }} for "{{ request('query') }}"
                </h1>
                <div class="flex items-center space-x-4 my-3">
                    <!-- Sort Dropdowns -->
                    <form action="{{ route('search') }}" method="GET" id="sortForm" class="flex items-center space-x-4">
                        <!-- Preserve the search query and filter -->
                        <input type="hidden" name="query" value="{{ request('query') }}">
                        <input type="hidden" name="filter" value="{{ request('filter') }}">
                
                        <!-- Date Sort Dropdown -->
                        <select name="sort" id="sortDate"
                            class="select select-bordered text-gray-600 bg-transparent w-40 border-1 border-gray-500 rounded-full"
                            onchange="document.getElementById('sortForm').submit();">
                            <option value="">Sort By Date</option>
                            <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Date (Ascending)</option>
                            <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Date (Descending)</option>
                        </select>
                
                        <!-- Alphabetical Sort Dropdown -->
                        <select name="sort" id="sortAlpha"
                            class="select select-bordered text-gray-600 bg-transparent w-40 border-1 border-gray-500 rounded-full"
                            onchange="document.getElementById('sortForm').submit();">
                            <option value="">Sort Alphabetically</option>
                            <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A - Z</option>
                            <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z - A</option>
                        </select>
                    </form>
                </div>
                
                

                @if($results->isEmpty())
                    <p class="text-red-500 mt-3">No results found.</p>
                @else
                    <!-- Card-based Search Results -->
                    <div class="space-y-4">
                        @foreach($results as $result)
                        {{-- <pre>{{ $result }}</pre>
                        <script>
                            console.log(@json($result));
                        </script> --}}
                        <a href="{{ $result->type === 'hak_cipta' ? route('hak_cipta.detail', ['ki_id' => $result->ki_id]) : route('paten.detail', ['id' => $result->ki_id]) }}" class="block">
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
                                                    <!-- Conditional Number Field -->
                                                    <p class=" font-medium text-sm text-gray-500">
                                                        @if ($result->type === 'hak_cipta' && $result->hakCipta)
                                                            {{ $result->hakCipta->hak_cipta_number }}
                                                        @elseif ($result->type === 'paten' && $result->paten)
                                                            {{ $result->paten->paten_number }}
                                                        @else
                                                            {{ $result->registration_number }}
                                                        @endif
                                                    </p>
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
                    <div class="my-5">
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
            <script>
                const dropdownButton = document.getElementById('dropdownButton');
                const dropdownMenu = document.getElementById('dropdownMenu');
                const dropdownSelected = document.getElementById('dropdownSelected');
                const filterInput = document.getElementById('filter');

                dropdownButton.addEventListener('click', () => {
                    if (dropdownMenu.classList.contains('hidden')) {
                        dropdownMenu.classList.remove('hidden', 'opacity-0', 'scale-95');
                        dropdownMenu.classList.add('opacity-100', 'scale-100');
                    } else {
                        dropdownMenu.classList.remove('opacity-100', 'scale-100');
                        dropdownMenu.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => {
                            dropdownMenu.classList.add('hidden');
                        }, 300); // Matches the transition duration
                    }
                });

                dropdownMenu.querySelectorAll('li').forEach(item => {
                    item.addEventListener('click', () => {
                        const value = item.getAttribute('data-value');
                        const text = item.textContent;

                        filterInput.value = value;
                        dropdownSelected.textContent = text;

                        dropdownMenu.classList.remove('opacity-100', 'scale-100');
                        dropdownMenu.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => {
                            dropdownMenu.classList.add('hidden');
                        }, 300); // Matches the transition duration
                    });
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.remove('opacity-100', 'scale-100');
                        dropdownMenu.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => {
                            dropdownMenu.classList.add('hidden');
                        }, 300); // Matches the transition duration
                    }
                });
            </script>
        </div>
    </div>
@endsection