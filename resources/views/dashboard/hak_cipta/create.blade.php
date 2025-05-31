@extends('layouts.dashboard')

@section('title', 'Unggah Hak Cipta Sentra')

@section('content')
    <div class="min-h-screen flex flex-col ">

        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            {{-- Include the sidebar from its new layout location --}}
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6 flex justify-center items-start"> {{-- Adjusted for sidebar layout --}}
                <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-4xl">
                    <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Unggah Data Hak Cipta Sentra</h1>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dashboard.hak_cipta.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Judul Karya --}}
                        <div>
                            <label for="judul_karya" class="block text-gray-600 text-sm font-medium mb-2">Judul Karya:</label>
                            <input type="text" name="judul_karya" id="judul_karya" value="{{ old('judul_karya') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Uraian Singkat Ciptaan --}}
                        <div>
                            <label for="uraian_singkat_ciptaan" class="block text-gray-600 text-sm font-medium mb-2">Uraian Singkat Ciptaan (Rangkuman Karya):</label>
                            <textarea name="uraian_singkat_ciptaan" id="uraian_singkat_ciptaan" rows="4" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">{{ old('uraian_singkat_ciptaan') }}</textarea>
                        </div>

                        {{-- Jenis Karya --}}
                        <div>
                            <label class="block text-gray-600 text-sm font-medium mb-2">Jenis Karya:</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach(['Karya Tulis', 'Karya Seni', 'Komposisi Musik', 'Karya Audio Visual', 'Karya Fotografi', 'Karya Drama & Koreografi', 'Karya Rekaman', 'Karya Lainnya'] as $type)
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_karya" value="{{ $type }}" class="form-radio text-[#68C5CC]" {{ old('jenis_karya') == $type ? 'checked' : '' }} required>
                                        <span class="ml-2 text-gray-700">{{ $type }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Data Pencipta Utama --}}
                        <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-2">Data Pencipta Utama</h3>
                        <div>
                            <label for="pencipta_nik" class="block text-gray-600 text-sm font-medium mb-2">NIK:</label>
                            <input type="text" name="pencipta_nik" id="pencipta_nik" value="{{ old('pencipta_nik') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_nama" class="block text-gray-600 text-sm font-medium mb-2">Nama Lengkap:</label>
                            <input type="text" name="pencipta_nama" id="pencipta_nama" value="{{ old('pencipta_nama') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_email" class="block text-gray-600 text-sm font-medium mb-2">E-mail:</label>
                            <input type="email" name="pencipta_email" id="pencipta_email" value="{{ old('pencipta_email') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_hp" class="block text-gray-600 text-sm font-medium mb-2">No. Handphone (Whatsapp):</label>
                            <input type="tel" name="pencipta_hp" id="pencipta_hp" value="{{ old('pencipta_hp') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_alamat" class="block text-gray-600 text-sm font-medium mb-2">Alamat Lengkap (Sesuai KTP):</label>
                            <textarea name="pencipta_alamat" id="pencipta_alamat" rows="2" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">{{ old('pencipta_alamat') }}</textarea>
                        </div>
                        <div>
                            <label for="pencipta_kecamatan" class="block text-gray-600 text-sm font-medium mb-2">Kecamatan:</label>
                            <input type="text" name="pencipta_kecamatan" id="pencipta_kecamatan" value="{{ old('pencipta_kecamatan') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_kodepos" class="block text-gray-600 text-sm font-medium mb-2">Kode POS:</label>
                            <input type="text" name="pencipta_kodepos" id="pencipta_kodepos" value="{{ old('pencipta_kodepos') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="pencipta_jurusan" class="block text-gray-600 text-sm font-medium mb-2">Jurusan:</label>
                            <input type="text" name="pencipta_jurusan" id="pencipta_jurusan" value="{{ old('pencipta_jurusan') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Anggota Berstatus Mahasiswa --}}
                        <div class="mt-6">
                            <label class="block text-gray-600 text-sm font-medium mb-2">Adakah Anggota Berstatus Mahasiswa?</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Ya" class="form-radio text-[#68C5CC]" id="mahasiswa_yes" {{ old('ada_anggota_mahasiswa') == 'Ya' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Tidak" class="form-radio text-[#68C5CC]" id="mahasiswa_no" {{ old('ada_anggota_mahasiswa') == 'Tidak' || !old('ada_anggota_mahasiswa') ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <div id="daftar_anggota_mahasiswa_section" class="space-y-4 border border-gray-200 p-4 rounded-lg hidden">
                            <h4 class="text-md font-semibold text-gray-700">Daftar Nama Anggota Berstatus Mahasiswa</h4>
                            <div id="mahasiswa_list">
                                {{-- Mahasiswa fields will be added here dynamically --}}
                                @if(old('anggota_mahasiswa'))
                                    @foreach(old('anggota_mahasiswa') as $index => $mahasiswa)
                                        <div class="mahasiswa-item flex flex-col gap-2 mb-4 p-3 border border-gray-200 rounded-lg relative">
                                            <button type="button" class="remove-mahasiswa-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <div>
                                                <label for="mahasiswa_nama_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Nama Mahasiswa:</label>
                                                <input type="text" name="anggota_mahasiswa[{{ $index }}][nama]" id="mahasiswa_nama_{{ $index }}" value="{{ $mahasiswa['nama'] ?? '' }}" required
                                                       class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                            </div>
                                            <div>
                                                <label for="mahasiswa_nim_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">NIM Mahasiswa:</label>
                                                <input type="text" name="anggota_mahasiswa[{{ $index }}][nim]" id="mahasiswa_nim_{{ $index }}" value="{{ $mahasiswa['nim'] ?? '' }}" required
                                                       class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add_mahasiswa_btn" class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-600 transition duration-200">
                                Tambah Mahasiswa
                            </button>
                        </div>

                        {{-- Jumlah Anggota Pencipta (Dynamic Creator Members) --}}
                        <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-2">Anggota Pencipta Lain (Jika Ada)</h3>
                        <div id="anggota_pencipta_container" class="space-y-6">
                            @if(old('anggota_pencipta'))
                                @foreach(old('anggota_pencipta') as $index => $anggota)
                                    <div class="anggota-pencipta-item space-y-4 border border-gray-300 p-4 rounded-lg relative">
                                        <h4 class="text-md font-semibold text-gray-700">Anggota Pencipta #{{ $index + 1 }}</h4>
                                        <button type="button" class="remove-anggota-pencipta-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <div>
                                            <label for="anggota_nik_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">NIK:</label>
                                            <input type="text" name="anggota_pencipta[{{ $index }}][nik]" id="anggota_nik_{{ $index }}" value="{{ $anggota['nik'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                        <div>
                                            <label for="anggota_nama_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Nama Lengkap:</label>
                                            <input type="text" name="anggota_pencipta[{{ $index }}][nama]" id="anggota_nama_{{ $index }}" value="{{ $anggota['nama'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                        <div>
                                            <label for="anggota_email_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">E-mail:</label>
                                            <input type="email" name="anggota_pencipta[{{ $index }}][email]" id="anggota_email_{{ $index }}" value="{{ $anggota['email'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                        <div>
                                            <label for="anggota_hp_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">No. Handphone (Whatsapp):</label>
                                            <input type="tel" name="anggota_pencipta[{{ $index }}][hp]" id="anggota_hp_{{ $index }}" value="{{ $anggota['hp'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                        <div>
                                            <label for="anggota_alamat_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Alamat Lengkap (Sesuai KTP):</label>
                                            <textarea name="anggota_pencipta[{{ $index }}][alamat]" id="anggota_alamat_{{ $index }}" rows="2" required
                                                      class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">{{ $anggota['alamat'] ?? '' }}</textarea>
                                        </div>
                                        <div>
                                            <label for="anggota_kecamatan_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Kecamatan:</label>
                                            <input type="text" name="anggota_pencipta[{{ $index }}][kecamatan]" id="anggota_kecamatan_{{ $index }}" value="{{ $anggota['kecamatan'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                        <div>
                                            <label for="anggota_kodepos_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Kode POS:</label>
                                            <input type="text" name="anggota_pencipta[{{ $index }}][kodepos]" id="anggota_kodepos_{{ $index }}" value="{{ $anggota['kodepos'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" id="add_anggota_pencipta_btn" class="px-6 py-3 text-white bg-blue-500 hover:bg-blue-600 transition duration-200 cursor-pointer rounded-full font-semibold text-md shadow-md">
                            Tambah Anggota Pencipta
                        </button>


                        {{-- Scan KTP Pencipta --}}
                        <div class="mt-6">
                            <label for="scan_ktp_pencipta" class="block text-gray-600 text-sm font-medium mb-2">Scan KTP Pencipta (pdf. Apabila ada anggota, dilampirkan dan disatukan dalam satu file pdf):</label>
                            <input type="file" name="scan_ktp_pencipta" id="scan_ktp_pencipta" accept=".pdf" {{ old('scan_ktp_pencipta') ? '' : 'required' }}
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                            @if(old('scan_ktp_pencipta'))
                                <p class="text-sm text-gray-500 mt-1">File sebelumnya: {{ old('scan_ktp_pencipta')->getClientOriginalName() }}</p>
                            @endif
                        </div>

                        {{-- Kota Pertama Kali Karya Diumumkan --}}
                        <div>
                            <label for="kota_pengumuman" class="block text-gray-600 text-sm font-medium mb-2">Kota Pertama Kali Karya Diumumkan:</label>
                            <input type="text" name="kota_pengumuman" id="kota_pengumuman" value="{{ old('kota_pengumuman') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Tanggal Karya Diumumkan/Diterbitkan/Selesai Dibuat --}}
                        <div>
                            <label for="tanggal_pengumuman" class="block text-gray-600 text-sm font-medium mb-2">Tanggal Karya Diumumkan/Diterbitkan/Tanggal selesai dibuatnya karya (Bulan, Hari, Tahun):</label>
                            <input type="date" name="tanggal_pengumuman" id="tanggal_pengumuman" value="{{ old('tanggal_pengumuman') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Dokumen Ciptaan --}}
                        <div>
                            <label for="dokumen_ciptaan" class="block text-gray-600 text-sm font-medium mb-2">Dokumen Ciptaan (PDF/DOCX):</label>
                            <input type="file" name="dokumen_ciptaan" id="dokumen_ciptaan" accept=".pdf,.docx" {{ old('dokumen_ciptaan') ? '' : 'required' }}
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                            @if(old('dokumen_ciptaan'))
                                <p class="text-sm text-gray-500 mt-1">File sebelumnya: {{ old('dokumen_ciptaan')->getClientOriginalName() }}</p>
                            @endif
                        </div>

                        {{-- Pernyataan --}}
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="pernyataan_setuju" id="pernyataan_setuju" class="form-checkbox text-[#68C5CC]" {{ old('pernyataan_setuju') ? 'checked' : '' }} required>
                            <label for="pernyataan_setuju" class="ml-2 text-gray-700 text-sm">Saya menyetujui bahwa data yang diisikan sudah benar dan sesuai. Apabila ada kesalahan data ciptaan, nama, gelar dan alamat adalah tanggung jawab dosen dan anggota tim.</label>
                        </div>

                        <button type="submit"
                                class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md mt-6">
                            Unggah Hak Cipta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- JavaScript for Dynamic Mahasiswa Fields ---
        let mahasiswaCount = {{ count(old('anggota_mahasiswa', [])) }};
        const mahasiswaList = document.getElementById('mahasiswa_list');
        const addMahasiswaBtn = document.getElementById('add_mahasiswa_btn');
        const mahasiswaYesRadio = document.getElementById('mahasiswa_yes');
        const mahasiswaNoRadio = document.getElementById('mahasiswa_no');
        const mahasiswaSection = document.getElementById('daftar_anggota_mahasiswa_section');

        function toggleMahasiswaSection() {
            if (mahasiswaYesRadio.checked) {
                mahasiswaSection.classList.remove('hidden');
                if (mahasiswaList.children.length === 0) { // Check actual child count
                    addMahasiswaField();
                }
            } else {
                mahasiswaSection.classList.add('hidden');
                mahasiswaList.innerHTML = '';
                mahasiswaCount = 0;
            }
        }

        function addMahasiswaField() {
            const div = document.createElement('div');
            div.classList.add('mahasiswa-item', 'flex', 'flex-col', 'gap-2', 'mb-4', 'p-3', 'border', 'border-gray-200', 'rounded-lg', 'relative');
            const currentIndex = mahasiswaList.children.length; // Use current number of children for index
            div.innerHTML = `
                <button type="button" class="remove-mahasiswa-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div>
                    <label for="mahasiswa_nama_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Nama Mahasiswa:</label>
                    <input type="text" name="anggota_mahasiswa[${currentIndex}][nama]" id="mahasiswa_nama_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="mahasiswa_nim_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">NIM Mahasiswa:</label>
                    <input type="text" name="anggota_mahasiswa[${currentIndex}][nim]" id="mahasiswa_nim_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
            `;
            mahasiswaList.appendChild(div);

            div.querySelector('.remove-mahasiswa-btn').addEventListener('click', function() {
                div.remove();
                // Re-index remaining fields
                reindexFields(mahasiswaList, 'anggota_mahasiswa', 'mahasiswa');
                if (mahasiswaYesRadio.checked && mahasiswaList.children.length === 0) {
                    addMahasiswaField();
                }
            });
            mahasiswaCount++; // Increment overall count
        }

        mahasiswaYesRadio.addEventListener('change', toggleMahasiswaSection);
        mahasiswaNoRadio.addEventListener('change', toggleMahasiswaSection);
        addMahasiswaBtn.addEventListener('click', addMahasiswaField);

        // Initial check on page load and attach listeners to existing remove buttons
        toggleMahasiswaSection();
        document.querySelectorAll('#mahasiswa_list .remove-mahasiswa-btn').forEach(button => {
            button.addEventListener('click', function() {
                button.closest('.mahasiswa-item').remove();
                reindexFields(mahasiswaList, 'anggota_mahasiswa', 'mahasiswa');
                if (mahasiswaYesRadio.checked && mahasiswaList.children.length === 0) {
                    addMahasiswaField();
                }
            });
        });


        // --- JavaScript for Dynamic Anggota Pencipta Fields ---
        let anggotaPenciptaCount = {{ count(old('anggota_pencipta', [])) }};
        const anggotaPenciptaContainer = document.getElementById('anggota_pencipta_container');
        const addAnggotaPenciptaBtn = document.getElementById('add_anggota_pencipta_btn');

        function addAnggotaPenciptaField() {
            const div = document.createElement('div');
            div.classList.add('anggota-pencipta-item', 'space-y-4', 'border', 'border-gray-300', 'p-4', 'rounded-lg', 'relative');
            const currentIndex = anggotaPenciptaContainer.children.length; // Use current number of children for index
            div.innerHTML = `
                <h4 class="text-md font-semibold text-gray-700">Anggota Pencipta #${currentIndex + 1}</h4>
                <button type="button" class="remove-anggota-pencipta-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div>
                    <label for="anggota_nik_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">NIK:</label>
                    <input type="text" name="anggota_pencipta[${currentIndex}][nik]" id="anggota_nik_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_nama_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Nama Lengkap:</label>
                    <input type="text" name="anggota_pencipta[${currentIndex}][nama]" id="anggota_nama_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_email_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">E-mail:</label>
                    <input type="email" name="anggota_pencipta[${currentIndex}][email]" id="anggota_email_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_hp_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">No. Handphone (Whatsapp):</label>
                    <input type="tel" name="anggota_pencipta[${currentIndex}][hp]" id="anggota_hp_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_alamat_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Alamat Lengkap (Sesuai KTP):</label>
                    <textarea name="anggota_pencipta[${currentIndex}][alamat]" id="anggota_alamat_${currentIndex}" rows="2" required
                              class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700"></textarea>
                </div>
                <div>
                    <label for="anggota_kecamatan_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Kecamatan:</label>
                    <input type="text" name="anggota_pencipta[${currentIndex}][kecamatan]" id="anggota_kecamatan_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_kodepos_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Kode POS:</label>
                    <input type="text" name="anggota_pencipta[${currentIndex}][kodepos]" id="anggota_kodepos_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
            `;
            anggotaPenciptaContainer.appendChild(div);

            div.querySelector('.remove-anggota-pencipta-btn').addEventListener('click', function() {
                div.remove();
                reindexFields(anggotaPenciptaContainer, 'anggota_pencipta', 'anggota');
            });
            anggotaPenciptaCount++; // Increment overall count
        }

        addAnggotaPenciptaBtn.addEventListener('click', addAnggotaPenciptaField);

        // Attach listeners to existing remove buttons for anggota pencipta
        document.querySelectorAll('#anggota_pencipta_container .remove-anggota-pencipta-btn').forEach(button => {
            button.addEventListener('click', function() {
                button.closest('.anggota-pencipta-item').remove();
                reindexFields(anggotaPenciptaContainer, 'anggota_pencipta', 'anggota');
            });
        });

        // Helper function to reindex dynamic fields after removal
        function reindexFields(container, baseName, idPrefix) {
            Array.from(container.children).forEach((item, index) => {
                item.querySelectorAll(`[name^="${baseName}["]`).forEach(input => {
                    const oldName = input.name;
                    const newName = oldName.replace(/\[\d+\]/, `[${index}]`);
                    input.name = newName;
                    input.id = input.id.replace(/_\d+/, `_${index}`);
                });
                item.querySelectorAll(`label[for^="${idPrefix}_"]`).forEach(label => {
                    const oldFor = label.getAttribute('for');
                    const newFor = oldFor.replace(/_\d+/, `_${index}`);
                    label.setAttribute('for', newFor);
                });
                // Update title for anggota pencipta
                if (item.querySelector('h4')) {
                    item.querySelector('h4').textContent = `Anggota Pencipta #${index + 1}`;
                }
            });
        }

        // Initialize dynamic fields if old input exists on page load
        if (mahasiswaCount > 0 && mahasiswaYesRadio.checked) {
            mahasiswaSection.classList.remove('hidden');
        }
    </script>
@endsection
