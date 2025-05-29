@extends('layouts.app')

@section('title', 'Detail Hak Cipta')

@section('content')
    <div class="min-h-screen w-full flex flex-col pt-28 text-gray-600">
        {{-- Navbar --}}
        <div class="navbar bg-[#ffffff] shadow-sm w-full z-50 fixed top-0">
            <div class="flex-1 flex items-center m-2">
                <a href="/" class="text-xl flex items-center space-x-2 ml-5">
                    <img src="{{ asset('img/logo_polinema.png') }}" alt="Logo" class="h-13 w-auto">
                    <span class="text-sm font-semibold text-gray-700" style="font-family: 'Montserrat', sans-serif;">
                        Kekayaan Intelektual Politeknik Negeri Malang
                    </span>
                </a>
            </div>
            <div class="flex-none flex items-center space-x-5 mr-5">
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Penelurusan</a>
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Total</a>
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Panduan</a>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-5 py-2 text-white bg-red-500 hover:bg-red-600 transition duration-200 cursor-pointer rounded-full font-semibold shadow-md">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold shadow-md">
                        Login
                    </a>
                @endauth
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <form action="{{ route('search') }}" method="GET"
                class="mb-5 input-bordered border border-gray-300 p-2 rounded-full flex items-center space-x-2">
                <div class="relative w-1/7">
                    <button id="dropdownButton" type="button"
                        class="w-full bg-transparent border border-gray-300 text-gray-600 rounded-full px-4 py-2 text-left focus:outline-none">
                        <span id="dropdownSelected">
                            {{ request('filter') ? ucfirst(request('filter')) : 'Hak Cipta' }}
                        </span>
                        <svg class="w-5 h-5 inline-block float-right" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
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
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari lagi..."
                    class="w-full bg-transparent rounded-lg px-4 py-2 text-gray-500 focus:outline-none focus:ring-0"
                    required>
                <button type="submit"
                    class="px-3 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full">
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
            </form>

            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $hakCipta->judul_karya ?? 'N/A' }}</h1>

                <div class="flex flex-col md:flex-row justify-between items-center mb-5 border border-gray-200 rounded-md p-4">
                    <div class="flex flex-col justify-center w-full md:w-1/3 px-2 md:px-5 py-2">
                        <div class="text-xs text-gray-700 font-bold">ID Hak Cipta</div>
                        <div class="font-semibold text-gray-800">{{ $hakCipta->id ?? 'N/A' }}</div>
                    </div>
                    <div class="h-full border-r border-gray-300 mx-2 hidden md:block"></div>

                    <div class="flex flex-col justify-center w-full md:w-1/3 px-2 md:px-5 py-2">
                        <div class="text-xs text-gray-700 font-bold">Tanggal Permohonan</div>
                        <div class="font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($hakCipta->kekayaanIntelektual->submission_date ?? '')->format('d F Y') ?? 'N/A' }}
                        </div>
                    </div>
                    <div class="h-full border-r border-gray-300 mx-2 hidden md:block"></div>

                    <div class="flex flex-col justify-center w-full md:w-1/3 px-2 md:px-5 py-2">
                        <div class="text-xs text-gray-700 font-bold">Status</div>
                        <div class="pt-1">
                            <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-sm font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-blue-200 text-blue-700 hover:bg-blue-200">
                                {{ ucfirst($hakCipta->kekayaanIntelektual->status ?? 'Unknown') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <p class="text-sm text-gray-700 font-bold">Uraian Singkat Ciptaan</p>
                        <p class="font-semibold text-gray-800">{{ $hakCipta->uraian_singkat_ciptaan ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700 font-bold">Jenis Karya</p>
                        <p class="font-semibold text-gray-800">{{ $hakCipta->jenis_karya ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700 font-bold">Kota Pertama Kali Karya Diumumkan</p>
                        <p class="font-semibold text-gray-800">{{ $hakCipta->kota_pengumuman ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-700 font-bold">Tanggal Karya Diumumkan/Diterbitkan</p>
                        <p class="font-semibold text-gray-800">
                            {{ \Carbon\Carbon::parse($hakCipta->tanggal_pengumuman ?? '')->format('d F Y') ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-700 mb-3">Data Pencipta Utama</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Nama Lengkap</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_nama ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">NIK</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_nik ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Email</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">No. Handphone (Whatsapp)</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_hp ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Alamat Lengkap (Sesuai KTP)</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_alamat ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Kecamatan</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_kecamatan ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Kode POS</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_kodepos ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Jurusan</p>
                            <p class="font-semibold text-gray-800">{{ $hakCipta->pencipta_jurusan ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                @if($hakCipta->anggota_mahasiswa && count($hakCipta->anggota_mahasiswa) > 0)
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-700 mb-3">Anggota Berstatus Mahasiswa</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Nama Mahasiswa</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">NIM Mahasiswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hakCipta->anggota_mahasiswa as $mahasiswa)
                                        <tr>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $mahasiswa['nama'] ?? 'N/A' }}</td>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $mahasiswa['nim'] ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if($hakCipta->anggota_pencipta && count($hakCipta->anggota_pencipta) > 0)
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-700 mb-3">Anggota Pencipta Lain</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">NIK</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Nama</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Email</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">No. HP</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Alamat</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Kecamatan</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 border-b">Kode POS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hakCipta->anggota_pencipta as $anggota)
                                        <tr>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $anggota['nik'] ?? 'N/A' }}</td>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $anggota['nama'] ?? 'N/A' }}</td>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $anggota['email'] ?? 'N/A' }}</td>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $anggota['hp'] ?? 'N/A' }}</td>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $anggota['alamat'] ?? 'N/A' }}</td>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $anggota['kecamatan'] ?? 'N/A' }}</td>
                                            <td class="px-4 py-2 border-b text-gray-800">{{ $anggota['kodepos'] ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-700 mb-3">Dokumen Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Scan KTP Pencipta</p>
                            @if($hakCipta->file_path_ktp)
                                <a href="{{ Storage::url($hakCipta->file_path_ktp) }}" target="_blank" class="text-[#68C5CC] hover:underline">
                                    Lihat Dokumen KTP
                                </a>
                            @else
                                <p class="text-gray-800">Tidak ada dokumen KTP.</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-700 font-bold">Dokumen Ciptaan</p>
                            @if($hakCipta->file_path_ciptaan)
                                <a href="{{ Storage::url($hakCipta->file_path_ciptaan) }}" target="_blank" class="text-[#68C5CC] hover:underline">
                                    Lihat Dokumen Ciptaan
                                </a>
                            @else
                                <p class="text-gray-800">Tidak ada dokumen ciptaan.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <p class="text-sm text-gray-700 font-bold">Pernyataan Persetujuan:</p>
                    <p class="text-gray-800">
                        @if($hakCipta->pernyataan_setuju)
                            Saya menyetujui bahwa data yang diisikan sudah benar dan sesuai. Apabila ada kesalahan data ciptaan, nama, gelar dan alamat adalah tanggung jawab dosen dan anggota tim.
                        @else
                            Pernyataan persetujuan belum diberikan.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dropdown functionality for search filter
        const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const dropdownSelected = document.getElementById('dropdownSelected');
        const filterInput = document.getElementById('filter');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
            dropdownMenu.classList.toggle('opacity-0');
            dropdownMenu.classList.toggle('scale-95');
        });

        dropdownMenu.querySelectorAll('li').forEach(item => {
            item.addEventListener('click', () => {
                const value = item.getAttribute('data-value');
                const text = item.textContent.trim();
                dropdownSelected.textContent = text;
                filterInput.value = value;
                dropdownMenu.classList.add('hidden', 'opacity-0', 'scale-95');
            });
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden', 'opacity-0', 'scale-95');
            }
        });
    </script>
@endsection
