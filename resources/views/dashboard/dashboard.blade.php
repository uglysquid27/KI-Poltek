@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen flex flex-col">
        {{-- Navbar --}}
        <div class="navbar bg-[#ffffff] shadow-sm w-full z-50">
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
                {{-- Conditional Login/Logout Button --}}
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

        <div class="flex-grow flex flex-col md:flex-row pt-28"> {{-- Added pt-28 to account for fixed navbar height --}}
            <div class="w-full md:w-1/5 bg-white shadow-md p-6 rounded-none border-r border-gray-200">
                <h2 class="text-lg font-bold text-gray-700 mb-4">Dashboard Menu</h2>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Overview</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">My Applications</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Settings</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Reports</a></li>
                    <li class="mt-4 pt-4 border-t border-gray-200"><h3 class="text-md font-semibold text-gray-700 mb-2">Unggah Data</h3></li>
                    <li><a href="#hak-cipta-form" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Hak Cipta Sentra</a></li>
                    <li><a href="#paten-form" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Paten Sentra</a></li>
                </ul>
            </div>

            <div class="flex-1 p-6 bg-gray-100">
                <h1 class="text-3xl font-bold text-gray-700 mb-6">Selamat Datang di Dashboard Anda!</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0 bg-[#68C5CC] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.029M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Aplikasi</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalApplications ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0 bg-blue-500 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v2.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Persetujuan Tertunda</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $pendingApprovals ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0 bg-green-500 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Aplikasi Disetujui</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $approvedApplications ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-white p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Aktivitas Terbaru</h2>
                    <ul class="divide-y divide-gray-200">
                        @forelse($recentActivities ?? [] as $activity)
                            <li class="py-3 flex justify-between items-center">
                                <span class="text-gray-700">{{ $activity['description'] }}</span>
                                <span class="text-gray-500 text-sm">{{ $activity['time'] }}</span>
                            </li>
                        @empty
                            <li class="py-3 text-gray-500">Tidak ada aktivitas terbaru.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Hak Cipta Sentra Upload Form --}}
                <div id="hak-cipta-form" class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Unggah Data Hak Cipta Sentra</h2>
                    <form action="{{-- route('hak_cipta_sentra.store') --}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        {{-- Judul Karya --}}
                        <div>
                            <label for="judul_karya" class="block text-gray-600 text-sm font-medium mb-2">Judul Karya:</label>
                            <input type="text" name="judul_karya" id="judul_karya" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Uraian Singkat Ciptaan --}}
                        <div>
                            <label for="uraian_singkat_ciptaan" class="block text-gray-600 text-sm font-medium mb-2">Uraian Singkat Ciptaan (Rangkuman Karya):</label>
                            <textarea name="uraian_singkat_ciptaan" id="uraian_singkat_ciptaan" rows="4" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700"></textarea>
                        </div>

                        {{-- Jenis Karya --}}
                        <div>
                            <label class="block text-gray-600 text-sm font-medium mb-2">Jenis Karya:</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Karya Tulis" class="form-radio text-[#68C5CC]" required>
                                    <span class="ml-2 text-gray-700">Karya Tulis</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Karya Seni" class="form-radio text-[#68C5CC]">
                                    <span class="ml-2 text-gray-700">Karya Seni</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Komposisi Musik" class="form-radio text-[#68C5CC]">
                                    <span class="ml-2 text-gray-700">Komposisi Musik</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Karya Audio Visual" class="form-radio text-[#68C5CC]">
                                    <span class="ml-2 text-gray-700">Karya Audio Visual</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Karya Fotografi" class="form-radio text-[#68C5CC]">
                                    <span class="ml-2 text-gray-700">Karya Fotografi</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Karya Drama & Koreografi" class="form-radio text-[#68C5CC]">
                                    <span class="ml-2 text-gray-700">Karya Drama & Koreografi</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Karya Rekaman" class="form-radio text-[#68C5CC]">
                                    <span class="ml-2 text-gray-700">Karya Rekaman</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_karya" value="Karya Lainnya" class="form-radio text-[#68C5CC]">
                                    <span class="ml-2 text-gray-700">Karya Lainnya</span>
                                </label>
                            </div>
                        </div>

                        {{-- Data Pencipta Utama --}}
                        <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-2">Data Pencipta Utama</h3>
                        <div>
                            <label for="pencipta_nik" class="block text-gray-600 text-sm font-medium mb-2">NIK:</label>
                            <input type="text" name="pencipta_nik" id="pencipta_nik" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_nama" class="block text-gray-600 text-sm font-medium mb-2">Nama Lengkap:</label>
                            <input type="text" name="pencipta_nama" id="pencipta_nama" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_email" class="block text-gray-600 text-sm font-medium mb-2">E-mail:</label>
                            <input type="email" name="pencipta_email" id="pencipta_email" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_hp" class="block text-gray-600 text-sm font-medium mb-2">No. Handphone (Whatsapp):</label>
                            <input type="tel" name="pencipta_hp" id="pencipta_hp" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_alamat" class="block text-gray-600 text-sm font-medium mb-2">Alamat Lengkap (Sesuai KTP):</label>
                            <textarea name="pencipta_alamat" id="pencipta_alamat" rows="2" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700"></textarea>
                        </div>
                        <div>
                            <label for="pencipta_kecamatan" class="block text-gray-600 text-sm font-medium mb-2">Kecamatan:</label>
                            <input type="text" name="pencipta_kecamatan" id="pencipta_kecamatan" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_kodepos" class="block text-gray-600 text-sm font-medium mb-2">Kode POS:</label>
                            <input type="text" name="pencipta_kodepos" id="pencipta_kodepos" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_jurusan" class="block text-gray-600 text-sm font-medium mb-2">Jurusan:</label>
                            <input type="text" name="pencipta_jurusan" id="pencipta_jurusan" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Anggota Berstatus Mahasiswa --}}
                        <div class="mt-6">
                            <label class="block text-gray-600 text-sm font-medium mb-2">Adakah Anggota Berstatus Mahasiswa?</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Ya" class="form-radio text-[#68C5CC]" id="mahasiswa_yes">
                                    <span class="ml-2 text-gray-700">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Tidak" class="form-radio text-[#68C5CC]" id="mahasiswa_no" checked>
                                    <span class="ml-2 text-gray-700">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <div id="daftar_anggota_mahasiswa_section" class="space-y-4 border border-gray-200 p-4 rounded-lg hidden">
                            <h4 class="text-md font-semibold text-gray-700">Daftar Nama Anggota Berstatus Mahasiswa</h4>
                            <div id="mahasiswa_list">
                                {{-- Mahasiswa fields will be added here dynamically --}}
                            </div>
                            <button type="button" id="add_mahasiswa_btn" class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-600 transition duration-200">
                                Tambah Mahasiswa
                            </button>
                        </div>

                        {{-- Jumlah Anggota Pencipta (Dynamic Creator Members) --}}
                        <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-2">Anggota Pencipta Lain (Jika Ada)</h3>
                        <div id="anggota_pencipta_container" class="space-y-6">
                            {{-- Dynamic creator member fields will be added here --}}
                        </div>
                        <button type="button" id="add_anggota_pencipta_btn" class="px-6 py-3 text-white bg-blue-500 hover:bg-blue-600 transition duration-200 cursor-pointer rounded-full font-semibold text-md shadow-md">
                            Tambah Anggota Pencipta
                        </button>


                        {{-- Scan KTP Pencipta --}}
                        <div class="mt-6">
                            <label for="scan_ktp_pencipta" class="block text-gray-600 text-sm font-medium mb-2">Scan KTP Pencipta (pdf. Apabila ada anggota, dilampirkan dan disatukan dalam satu file pdf):</label>
                            <input type="file" name="scan_ktp_pencipta" id="scan_ktp_pencipta" accept=".pdf" required
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                        </div>

                        {{-- Kota Pertama Kali Karya Diumumkan --}}
                        <div>
                            <label for="kota_pengumuman" class="block text-gray-600 text-sm font-medium mb-2">Kota Pertama Kali Karya Diumumkan:</label>
                            <input type="text" name="kota_pengumuman" id="kota_pengumuman" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Tanggal Karya Diumumkan/Diterbitkan/Selesai Dibuat --}}
                        <div>
                            <label for="tanggal_pengumuman" class="block text-gray-600 text-sm font-medium mb-2">Tanggal Karya Diumumkan/Diterbitkan/Tanggal selesai dibuatnya karya (Bulan, Hari, Tahun):</label>
                            <input type="date" name="tanggal_pengumuman" id="tanggal_pengumuman" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Dokumen Ciptaan --}}
                        <div>
                            <label for="dokumen_ciptaan" class="block text-gray-600 text-sm font-medium mb-2">Dokumen Ciptaan (PDF/DOCX):</label>
                            <input type="file" name="dokumen_ciptaan" id="dokumen_ciptaan" accept=".pdf,.docx" required
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                        </div>

                        {{-- Pernyataan --}}
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="pernyataan_setuju" id="pernyataan_setuju" class="form-checkbox text-[#68C5CC]" required>
                            <label for="pernyataan_setuju" class="ml-2 text-gray-700 text-sm">Saya menyetujui bahwa data yang diisikan sudah benar dan sesuai. Apabila ada kesalahan data ciptaan, nama, gelar dan alamat adalah tanggung jawab dosen dan anggota tim.</label>
                        </div>

                        <button type="submit"
                                class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md mt-6">
                            Unggah Hak Cipta
                        </button>
                    </form>
                </div>

                {{-- Paten Sentra Upload Form (Remains unchanged) --}}
                <div id="paten-form" class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Unggah Data Paten Sentra</h2>
                    <form action="{{-- route('paten_sentra.store') --}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label for="paten_title" class="block text-gray-600 text-sm font-medium mb-2">Judul Paten:</label>
                            <input type="text" name="paten_title" id="paten_title" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="paten_abstract" class="block text-gray-600 text-sm font-medium mb-2">Abstrak:</label>
                            <textarea name="paten_abstract" id="paten_abstract" rows="4" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700"></textarea>
                        </div>
                        <div>
                            <label for="paten_file" class="block text-gray-600 text-sm font-medium mb-2">Unggah Dokumen (PDF/DOCX):</label>
                            <input type="file" name="paten_file" id="paten_file" accept=".pdf,.docx" required
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                        </div>
                        <button type="submit"
                                class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                            Unggah Paten
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        // --- JavaScript for Dynamic Mahasiswa Fields ---
        let mahasiswaCount = 0;
        const mahasiswaList = document.getElementById('mahasiswa_list');
        const addMahasiswaBtn = document.getElementById('add_mahasiswa_btn');
        const mahasiswaYesRadio = document.getElementById('mahasiswa_yes');
        const mahasiswaNoRadio = document.getElementById('mahasiswa_no');
        const mahasiswaSection = document.getElementById('daftar_anggota_mahasiswa_section');

        function toggleMahasiswaSection() {
            if (mahasiswaYesRadio.checked) {
                mahasiswaSection.classList.remove('hidden');
                // Ensure at least one field exists if 'Ya' is selected and list is empty
                if (mahasiswaCount === 0) {
                    addMahasiswaField();
                }
            } else {
                mahasiswaSection.classList.add('hidden');
                // Clear all mahasiswa fields when 'Tidak' is selected
                mahasiswaList.innerHTML = '';
                mahasiswaCount = 0;
            }
        }

        function addMahasiswaField() {
            const div = document.createElement('div');
            div.classList.add('mahasiswa-item', 'flex', 'flex-col', 'gap-2', 'mb-4', 'p-3', 'border', 'border-gray-200', 'rounded-lg', 'relative');
            div.innerHTML = `
                <button type="button" class="remove-mahasiswa-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div>
                    <label for="mahasiswa_nama_${mahasiswaCount}" class="block text-gray-600 text-sm font-medium mb-1">Nama Mahasiswa:</label>
                    <input type="text" name="anggota_mahasiswa[${mahasiswaCount}][nama]" id="mahasiswa_nama_${mahasiswaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="mahasiswa_nim_${mahasiswaCount}" class="block text-gray-600 text-sm font-medium mb-1">NIM Mahasiswa:</label>
                    <input type="text" name="anggota_mahasiswa[${mahasiswaCount}][nim]" id="mahasiswa_nim_${mahasiswaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
            `;
            mahasiswaList.appendChild(div);

            // Add event listener for remove button
            div.querySelector('.remove-mahasiswa-btn').addEventListener('click', function() {
                div.remove();
                mahasiswaCount--; // Decrement count
                // If all fields removed and 'Ya' is selected, add one back
                if (mahasiswaYesRadio.checked && mahasiswaCount === 0) {
                    addMahasiswaField();
                }
            });

            mahasiswaCount++;
        }

        mahasiswaYesRadio.addEventListener('change', toggleMahasiswaSection);
        mahasiswaNoRadio.addEventListener('change', toggleMahasiswaSection);
        addMahasiswaBtn.addEventListener('click', addMahasiswaField);

        // Initial check on page load
        toggleMahasiswaSection();


        // --- JavaScript for Dynamic Anggota Pencipta Fields ---
        let anggotaPenciptaCount = 0;
        const anggotaPenciptaContainer = document.getElementById('anggota_pencipta_container');
        const addAnggotaPenciptaBtn = document.getElementById('add_anggota_pencipta_btn');

        function addAnggotaPenciptaField() {
            const div = document.createElement('div');
            div.classList.add('anggota-pencipta-item', 'space-y-4', 'border', 'border-gray-300', 'p-4', 'rounded-lg', 'relative');
            div.innerHTML = `
                <h4 class="text-md font-semibold text-gray-700">Anggota Pencipta #${anggotaPenciptaCount + 1}</h4>
                <button type="button" class="remove-anggota-pencipta-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div>
                    <label for="anggota_nik_${anggotaPenciptaCount}" class="block text-gray-600 text-sm font-medium mb-1">NIK:</label>
                    <input type="text" name="anggota_pencipta[${anggotaPenciptaCount}][nik]" id="anggota_nik_${anggotaPenciptaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_nama_${anggotaPenciptaCount}" class="block text-gray-600 text-sm font-medium mb-1">Nama Lengkap:</label>
                    <input type="text" name="anggota_pencipta[${anggotaPenciptaCount}][nama]" id="anggota_nama_${anggotaPenciptaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_email_${anggotaPenciptaCount}" class="block text-gray-600 text-sm font-medium mb-1">E-mail:</label>
                    <input type="email" name="anggota_pencipta[${anggotaPenciptaCount}][email]" id="anggota_email_${anggotaPenciptaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_hp_${anggotaPenciptaCount}" class="block text-gray-600 text-sm font-medium mb-1">No. Handphone (Whatsapp):</label>
                    <input type="tel" name="anggota_pencipta[${anggotaPenciptaCount}][hp]" id="anggota_hp_${anggotaPenciptaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_alamat_${anggotaPenciptaCount}" class="block text-gray-600 text-sm font-medium mb-1">Alamat Lengkap (Sesuai KTP):</label>
                    <textarea name="anggota_pencipta[${anggotaPenciptaCount}][alamat]" id="anggota_alamat_${anggotaPenciptaCount}" rows="2" required
                              class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700"></textarea>
                </div>
                <div>
                    <label for="anggota_kecamatan_${anggotaPenciptaCount}" class="block text-gray-600 text-sm font-medium mb-1">Kecamatan:</label>
                    <input type="text" name="anggota_pencipta[${anggotaPenciptaCount}][kecamatan]" id="anggota_kecamatan_${anggotaPenciptaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_kodepos_${anggotaPenciptaCount}" class="block text-gray-600 text-sm font-medium mb-1">Kode POS:</label>
                    <input type="text" name="anggota_pencipta[${anggotaPenciptaCount}][kodepos]" id="anggota_kodepos_${anggotaPenciptaCount}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
            `;
            anggotaPenciptaContainer.appendChild(div);

            // Add event listener for remove button
            div.querySelector('.remove-anggota-pencipta-btn').addEventListener('click', function() {
                div.remove();
                anggotaPenciptaCount--; // Decrement count
                // Re-index remaining elements (optional but good for clean data)
                document.querySelectorAll('.anggota-pencipta-item').forEach((item, index) => {
                    item.querySelectorAll('[name^="anggota_pencipta["]').forEach(input => {
                        const oldName = input.name;
                        const newName = oldName.replace(/\[\d+\]/, `[${index}]`);
                        input.name = newName;
                        input.id = input.id.replace(/_\d+/, `_${index}`);
                        item.querySelector(`label[for^="anggota_"]`).setAttribute('for', input.id);
                    });
                    item.querySelector('h4').textContent = `Anggota Pencipta #${index + 1}`;
                });
            });

            anggotaPenciptaCount++;
        }

        addAnggotaPenciptaBtn.addEventListener('click', addAnggotaPenciptaField);

        // Initial call if you want to start with one dynamic field
        // addAnggotaPenciptaField();
    </script>
@endsection
