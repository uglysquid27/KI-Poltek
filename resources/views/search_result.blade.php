@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="flex flex-col pt-28 w-full min-h-screen">
        <div class="grid grid-cols-12">
            @include('layouts.sidebar')

            <div class="col-span-8 p-3">
                <form action="{{ route('search') }}" method="GET"
                    class="mb-5 p-2 border input-bordered border-gray-600 rounded-full">

                    <div class="flex items-center space-x-2">
                        <div class="relative w-1/6">
                            <button id="dropdownButton" type="button"
                                class="bg-transparent px-4 py-2 border border-gray-600 rounded-full focus:outline-none w-full text-gray-600 text-left">
                                <span id="dropdownSelected">
                                    {{ request('filter') ? ucfirst(request('filter')) : 'Hak Cipta' }}
                                </span>
                                <svg class="inline-block float-right w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul id="dropdownMenu"
                                class="hidden z-10 absolute bg-white opacity-0 shadow-lg mt-1 border border-gray-300 rounded-lg w-full scale-95 transition-all duration-300 ease-in-out transform">
                                <li class="hover:bg-gray-100 px-4 py-2 text-gray-600 cursor-pointer" data-value="hak_cipta">
                                    Hak Cipta
                                </li>
                                <li class="hover:bg-gray-100 px-4 py-2 text-gray-600 cursor-pointer" data-value="paten">
                                    Paten</li>
                            </ul>
                            <input type="hidden" name="filter" id="filter" value="{{ request('filter') ?? 'hak_cipta' }}">
                        </div>
                        <input type="text" name="query" value="{{ request('query') }}" placeholder="Search again..."
                            class="bg-transparent px-4 py-2 rounded-lg focus:outline-none focus:ring-0 w-full text-gray-500"
                            required>
                        <button type="submit"
                            class="bg-[#68C5CC] hover:bg-[#5bb3b8] px-3 py-3 rounded-full text-white transition duration-200 cursor-pointer">
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

                <h1 class="mb-3 font-bold text-gray-500 text-xl">
                    {{ $results->total() }} result{{ $results->total() > 1 ? 's' : '' }} for "{{ request('query') }}"
                </h1>
                <div class="flex items-center space-x-4 my-3">
                    <div class="flex items-center space-x-4 my-3">
                        <form action="{{ route('search') }}" method="GET" class="inline-block">
                            <input type="hidden" name="query" value="{{ request('query') }}">
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                            <select name="sort" onchange="this.form.submit()"
                                class="bg-transparent border-1 border-gray-500 rounded-full w-40 text-gray-600 select-bordered select">
                                <option value="">Sort By Date</option>
                                <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Date
                                    (Ascending)</option>
                                <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Date
                                    (Descending)</option>
                            </select>
                        </form>

                        <form action="{{ route('search') }}" method="GET" class="inline-block">
                            <input type="hidden" name="query" value="{{ request('query') }}">
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                            <select name="sort" onchange="this.form.submit()"
                                class="bg-transparent border-1 border-gray-500 rounded-full w-40 text-gray-600 select-bordered select">
                                <option value="">Sort Alphabetically</option>
                                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A - Z</option>
                                <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>Z - A</option>
                            </select>
                        </form>
                    </div>

                </div>



                @if($results->isEmpty())
                    <p class="mt-3 text-red-500">No results found.</p>
                @else
                    <div class="space-y-4">
                        @foreach($results as $result)

                            <a href="{{ $result->type === 'hak_cipta' ? route('hak_cipta.detail', ['id' => $result->ki_id]) : route('paten.detail', ['id' => $result->ki_id]) }}"
                                class="block">
                                <div class="flex flex-col pb-4 border-gray-300 border-b">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex justify-between items-start gap-4 w-full">
                                            <div class="flex flex-col flex-1 gap-1">
                                                <h1 class="font-bold text-gray-600 text-md md:text-lg cursor-pointer">
                                                    <span>{{ $result->title }}</span>
                                                </h1>
                                                <div class="flex md:flex-row flex-col md:items-center gap-2">
                                                    <div>
                                                        <div
                                                            class="inline-flex items-center bg-blue-200 hover:bg-blue-200 px-2.5 py-0.5 border border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 font-semibold text-blue-700 text-xs transition-colors">
                                                            {{ ucfirst($result->status) }}
                                                        </div>
                                                    </div>
                                                    <p class="font-medium text-gray-500 text-sm">
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

                @if ($results->hasPages())
                    <div class="my-5">
                        {{ $results->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>

            {{-- <div class="col-span-2 bg-white shadow-md p-3 rounded-none">
                <h2 class="mb-3 font-bold text-gray-700 text-lg">Related Results</h2>
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