@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <div class="flex flex-col justify-center items-center space-y-5 min-h-screen"
        style="font-family: 'Montserrat', sans-serif;">
        <h1
            class="bg-clip-text bg-gradient-to-r from-[#2D2E2E] to-[#68C5CC] font-bold text-transparent text-8xl text-center">
            Halo!
        </h1>
        <h1
            class="bg-clip-text bg-gradient-to-r from-[#2D2E2E] to-[#68C5CC] font-bold text-transparent text-3xl text-center">
            Jelajahi pangkalan data Kekayaan Intelektual Politeknik Negeri Malang
        </h1>

        <form action="{{ route('search') }}" method="GET"
            class="flex items-center space-x-2 p-2 border input-bordered border-gray-600 rounded-full w-full max-w-4xl font-montserrat">
            <div class="relative w-1/4">
                <button id="dropdownButton" type="button"
                    class="bg-transparent px-4 py-2 border border-gray-600 rounded-full focus:outline-none w-full text-gray-600 text-left">
                    <span id="dropdownSelected">
                        {{ request('filter') ? ucfirst(request('filter')) : 'Hak Cipta' }}
                    </span>
                    <svg class="inline-block float-right w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                {{-- Di bagian dropdown menu, tambahkan opsi Desain Industri --}}
                <ul id="dropdownMenu"
                    class="hidden z-10 absolute bg-white opacity-0 shadow-lg mt-1 border border-gray-300 rounded-lg w-full scale-95 transition-all duration-300 ease-in-out transform">
                    <li class="hover:bg-gray-100 px-4 py-2 text-gray-600 cursor-pointer" data-value="hak_cipta">Hak Cipta
                    </li>
                    <li class="hover:bg-gray-100 px-4 py-2 text-gray-600 cursor-pointer" data-value="paten">Paten</li>
                    <li class="hover:bg-gray-100 px-4 py-2 text-gray-600 cursor-pointer" data-value="desain_industri">Desain
                        Industri</li>
                </ul>
                <input type="hidden" name="filter" id="filter" value="{{ request('filter') ?? 'hak_cipta' }}">
            </div>

            <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by title, author, etc."
                class="bg-transparent px-4 py-2 input-bordered focus:ring-0 w-full text-gray-600 input" required>

            <button type="submit"
                class="bg-[#68C5CC] hover:bg-[#5bb3b8] px-3 py-3 rounded-full text-white transition duration-200 cursor-pointer">
                <svg fill="#f0f0f0" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 490.4 490.4" xml:space="preserve">
                    <g>
                        <path
                            d="M484.1,454.796l-110.5-110.6c29.8-36.3,47.6-82.8,47.6-133.4c0-116.3-94.3-210.6-210.6-210.6S0,94.496,0,210.796
                                        s94.3,210.6,210.6,210.6c50.8,0,97.4-18,133.8-48l110.5,110.5c12.9,11.8,25,4.2,29.2,0C492.5,475.596,492.5,463.096,484.1,454.796z
                                        M41.1,210.796c0-93.6,75.9-169.5,169.5-169.5s169.6,75.9,169.6,169.5s-75.9,169.5-169.5-169.5S41.1,304.396,41.1,210.796z" />
                    </g>
                </svg>
            </button>
        </form>

        <button id="advancedSearchBtn"
            class="bg-[#E77817] hover:bg-[#9c5212] px-6 py-2 rounded-full font-montserrat text-white transition duration-200 cursor-pointer">
            Pencarian Lanjutan
        </button>
    </div>

    <div id="modal" class="hidden z-50 fixed inset-0 flex justify-center items-center bg-black/30 backdrop-blur-sm">
        <div class="bg-white opacity-0 shadow-lg p-6 rounded-lg w-full max-w-lg scale-95 transition-all duration-300 ease-in transform"
            id="modalContent">
            <h2 class="mb-4 font-bold text-gray-600 text-2xl">Pencarian Lanjutan</h2>
            <form action="{{ route('advancedSearch') }}" method="GET" class="space-y-4 text-gray-500">
                <input type="text" name="title" placeholder="Judul"
                    class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input"
                    value="{{ request('title') }}" />
                <input type="text" name="category" placeholder="Kategori"
                    class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input"
                    value="{{ request('category') }}" />

                <div class="flex md:flex-row flex-col md:space-x-4 space-y-4 md:space-y-0">
                    <div class="w-full md:w-1/2">
                        <label for="type_filter" class="block mb-1 font-medium text-gray-700 text-sm">Jenis Kekayaan
                            Intelektual:</label>
                        <select name="type_filter" id="type_filter"
                            class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input">
                            <option value="">Pilih Jenis</option>
                            <option value="hak_cipta" {{ request('type_filter') == 'hak_cipta' ? 'selected' : '' }}>Hak Cipta
                            </option>
                            <option value="paten" {{ request('type_filter') == 'paten' ? 'selected' : '' }}>Paten</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2">
                        <label for="status" class="block mb-1 font-medium text-gray-700 text-sm">Status:</label>
                        <select name="status" id="status"
                            class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input">
                            <option value="">Pilih Status</option>
                            <option value="Dalam Proses" {{ request('status') == 'Dalam Proses' ? 'selected' : '' }}>Dalam
                                Proses</option>
                            <option value="Dibatalkan" {{ request('status') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan
                            </option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Dihapus" {{ request('status') == 'Dihapus' ? 'selected' : '' }}>Dihapus</option>
                            <option value="Didaftar" {{ request('status') == 'Didaftar' ? 'selected' : '' }}>Didaftar</option>
                            <option value="Ditarik kembali" {{ request('status') == 'Ditarik kembali' ? 'selected' : '' }}>
                                Ditarik kembali</option>
                            <option value="Berakhir" {{ request('status') == 'Berakhir' ? 'selected' : '' }}>Berakhir</option>
                        </select>
                    </div>
                </div>

                <input type="text" name="patent_number" placeholder="Nomor Hak Cipta/Paten"
                    class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input"
                    value="{{ request('patent_number') }}" />

                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label for="submission_date_from" class="block mb-1 font-medium text-gray-700 text-sm">Tanggal
                            Pengajuan (Dari):</label>
                        <input type="date" name="submission_date_from" id="submission_date_from"
                            class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input"
                            value="{{ request('submission_date_from') }}" />
                    </div>
                    <div>
                        <label for="submission_date_to" class="block mb-1 font-medium text-gray-700 text-sm">Tanggal
                            Pengajuan (Sampai):</label>
                        <input type="date" name="submission_date_to" id="submission_date_to"
                            class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input"
                            value="{{ request('submission_date_to') }}" />
                    </div>
                    <div>
                        <label for="publication_date_from" class="block mb-1 font-medium text-gray-700 text-sm">Tanggal
                            Publikasi (Dari):</label>
                        <input type="date" name="publication_date_from" id="publication_date_from"
                            class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input"
                            value="{{ request('publication_date_from') }}" />
                    </div>
                    <div>
                        <label for="publication_date_to" class="block mb-1 font-medium text-gray-700 text-sm">Tanggal
                            Publikasi (Sampai):</label>
                        <input type="date" name="publication_date_to" id="publication_date_to"
                            class="px-4 py-2 border input-bordered rounded-lg focus:ring-0 w-full input"
                            value="{{ request('publication_date_to') }}" />
                    </div>
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeModal"
                        class="bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-lg text-white transition duration-200">Batal</button>
                    <button type="submit"
                        class="bg-[#68C5CC] hover:bg-[#5bb3b8] px-4 py-2 rounded-lg text-white transition duration-200">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const advancedSearchBtn = document.getElementById('advancedSearchBtn');
        const closeModalBtn = document.getElementById('closeModal');
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modalContent');

        function openModal() {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        advancedSearchBtn.addEventListener('click', openModal);
        closeModalBtn.addEventListener('click', closeModal);

        // This is the crucial part for clicking outside to close
        modal.addEventListener('click', (e) => {
            // Check if the click target is the modal overlay itself, not its children (modalContent)
            if (e.target === modal) {
                closeModal();
            }
        });

        // Dropdown functionality (already present and functional)
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
                }, 300);
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
                }, 300);
            });
        });

        document.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('opacity-100', 'scale-100');
                dropdownMenu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    dropdownMenu.classList.add('hidden');
                }, 300);
            }
        });
    </script>
@endsection