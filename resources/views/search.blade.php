@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen space-y-5"
        style="font-family: 'Montserrat', sans-serif;">
        <!-- Title at the Top -->
        <h1
            class="text-8xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2D2E2E] to-[#68C5CC] text-center">
            Halo!
        </h1>
        <h1
            class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2D2E2E] to-[#68C5CC] text-center">
            Jelajahi pangkalan data Kekayaan Intelektual Politeknik Negeri Malang
        </h1>

        <!-- Form in the Center -->
        <form action="{{ route('search') }}" method="GET"
            class="flex items-center w-full max-w-4xl space-x-2 input-bordered border border-gray-300 p-2 rounded-full font-montserrat">
            <!-- Custom Dropdown -->
            <div class="relative w-1/4">
                <button id="dropdownButton" type="button"
                    class="w-full bg-transparent border border-gray-300 text-gray-600 rounded-full px-4 py-2 text-left focus:outline-none">
                    <span
                        id="dropdownSelected">{{ request('filter') ? ucfirst(request('filter')) : 'Select Filter' }}</span>
                    <svg class="w-5 h-5 inline-block float-right" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <ul id="dropdownMenu"
                    class="absolute z-10 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-full mt-1 opacity-0 transform scale-95 transition-all duration-300 ease-in-out">
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-600" data-value="hak_cipta">Hak Cipta
                    </li>
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-600" data-value="paten">Paten</li>
                    <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-600" data-value="">All</li>
                </ul>
                <input type="hidden" name="filter" id="filter" value="{{ request('filter') }}">
            </div>

            <!-- Search Input -->
            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by title, author, etc."
                class="input input-bordered w-full px-4 py-2 text-gray-600 bg-transparent focus:bg-transparent" required>

            <!-- Search Button -->
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
        </form>

        <!-- Additional Button Below -->
        <button id="advancedSearchBtn"
            class=" px-6 py-2 rounded-full text-white bg-[#E77817] hover:bg-[#9c5212] transition duration-200 cursor-pointer font-montserrat">
            Pencarian Lanjutan
        </button>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-transparent bg-opacity-10 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full transform scale-95 opacity-0 transition-all duration-300 ease-in"
            id="modalContent">
            <h2 class="text-2xl font-bold mb-4 text-gray-600">Pencarian Lanjutan</h2>
            <form action="{{ route('advancedSearch') }}" method="GET" class="space-y-4 text-gray-500">
                <input type="text" name="title" placeholder="Judul" class="w-full px-4 py-2 border rounded-lg" />
                <input type="text" name="category" placeholder="Kategori" class="w-full px-4 py-2 border rounded-lg" />
                <input type="text" name="patent_number" placeholder="Nomor Hak Cipta/Paten"
                    class="w-full px-4 py-2 border rounded-lg" />
                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#68C5CC] text-white rounded-lg">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('advancedSearchBtn').addEventListener('click', function () {
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        });

        document.getElementById('closeModal').addEventListener('click', function () {
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); // Matches the transition duration
        });
    </script>

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
    
@endsection