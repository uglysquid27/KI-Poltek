[file name]: create.blade.php
[file content begin]
@extends('layouts.dashboard')

@section('title', 'Unggah Hak Cipta Sentra')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex md:flex-row flex-col flex-grow bg-gray-100 p-6">
            @include('dashboard.layouts.sidebar')

            <div class="flex flex-1 justify-center items-start p-6">
                <div class="bg-white shadow-xl p-8 rounded-lg w-full max-w-4xl">
                    <h1 class="mb-6 font-bold text-gray-700 text-3xl text-center">Unggah Data Hak Cipta Sentra</h1>

                    @if (session('success'))
                        <div class="relative bg-green-100 mb-4 px-4 py-3 border border-green-400 rounded text-green-700" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="relative bg-red-100 mb-4 px-4 py-3 border border-red-400 rounded text-red-700" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="relative bg-red-100 mb-4 px-4 py-3 border border-red-400 rounded text-red-700" role="alert">
                            <ul class="pl-5 list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dashboard.hak_cipta.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Basic Information --}}
                        <div>
                            <label for="judul_karya" class="block mb-2 font-medium text-gray-600 text-sm">Judul Karya:</label>
                            <input type="text" name="judul_karya" id="judul_karya" value="{{ old('judul_karya') }}" required
                                   class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                        </div>

                        <div>
                            <label for="uraian_singkat_ciptaan" class="block mb-2 font-medium text-gray-600 text-sm">Uraian Singkat Ciptaan:</label>
                            <textarea name="uraian_singkat_ciptaan" id="uraian_singkat_ciptaan" rows="4" required
                                      class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">{{ old('uraian_singkat_ciptaan') }}</textarea>
                        </div>

                        {{-- Work Type --}}
                        <div>
                            <label class="block mb-2 font-medium text-gray-600 text-sm">Jenis Karya:</label>
                            <div class="flex flex-wrap gap-4">
                                @foreach(['Karya Tulis', 'Karya Seni', 'Komposisi Musik', 'Karya Audio Visual', 'Karya Fotografi', 'Karya Drama & Koreografi', 'Karya Rekaman', 'Karya Lainnya'] as $type)
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="jenis_karya" value="{{ $type }}" class="text-[#68C5CC] form-radio" {{ old('jenis_karya') == $type ? 'checked' : '' }} required>
                                        <span class="ml-2 text-gray-700">{{ $type }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Main Creator --}}
                        <h3 class="mt-6 mb-2 font-semibold text-gray-700 text-lg">Data Pencipta Utama</h3>
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="pencipta_nik" class="block mb-2 font-medium text-gray-600 text-sm">NIK:</label>
                                <input type="text" name="pencipta_nik" id="pencipta_nik" value="{{ old('pencipta_nik') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pencipta_nama" class="block mb-2 font-medium text-gray-600 text-sm">Nama Lengkap:</label>
                                <input type="text" name="pencipta_nama" id="pencipta_nama" value="{{ old('pencipta_nama') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pencipta_email" class="block mb-2 font-medium text-gray-600 text-sm">E-mail:</label>
                                <input type="email" name="pencipta_email" id="pencipta_email" value="{{ old('pencipta_email') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pencipta_hp" class="block mb-2 font-medium text-gray-600 text-sm">No. Handphone:</label>
                                <input type="tel" name="pencipta_hp" id="pencipta_hp" value="{{ old('pencipta_hp') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        {{-- Address Fields --}}
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                            <div>
                                <label for="pencipta_provinsi" class="block mb-2 font-medium text-gray-600 text-sm">Provinsi:</label>
                                <input type="text" name="pencipta_provinsi" id="pencipta_provinsi" value="{{ old('pencipta_provinsi') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pencipta_kabupaten" class="block mb-2 font-medium text-gray-600 text-sm">Kabupaten/Kota:</label>
                                <input type="text" name="pencipta_kabupaten" id="pencipta_kabupaten" value="{{ old('pencipta_kabupaten') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pencipta_kecamatan" class="block mb-2 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                <input type="text" name="pencipta_kecamatan" id="pencipta_kecamatan" value="{{ old('pencipta_kecamatan') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label for="pencipta_alamat" class="block mb-2 font-medium text-gray-600 text-sm">Alamat Lengkap:</label>
                            <textarea name="pencipta_alamat" id="pencipta_alamat" rows="2" required
                                      class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">{{ old('pencipta_alamat') }}</textarea>
                        </div>

                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="pencipta_kodepos" class="block mb-2 font-medium text-gray-600 text-sm">Kode POS:</label>
                                <input type="text" name="pencipta_kodepos" id="pencipta_kodepos" value="{{ old('pencipta_kodepos') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pencipta_jurusan" class="block mb-2 font-medium text-gray-600 text-sm">Jurusan:</label>
                                <input type="text" name="pencipta_jurusan" id="pencipta_jurusan" value="{{ old('pencipta_jurusan') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700"
                                       placeholder="Contoh: Teknik Informatika">
                            </div>
                        </div>

                        {{-- Student Members --}}
                        <div class="mt-6">
                            <label class="block mb-2 font-medium text-gray-600 text-sm">Adakah Anggota Berstatus Mahasiswa?</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Ya" class="text-[#68C5CC] form-radio" id="mahasiswa_yes" {{ old('ada_anggota_mahasiswa') == 'Ya' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Tidak" class="text-[#68C5CC] form-radio" id="mahasiswa_no" {{ old('ada_anggota_mahasiswa') == 'Tidak' || !old('ada_anggota_mahasiswa') ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <div id="daftar_anggota_mahasiswa_section" class="{{ old('ada_anggota_mahasiswa') == 'Ya' ? '' : 'hidden' }} space-y-4 p-4 border border-gray-200 rounded-lg">
                            <h4 class="font-semibold text-gray-700 text-md">Daftar Anggota Mahasiswa</h4>
                            <div id="mahasiswa_list">
                                @if(old('anggota_mahasiswa'))
                                    @foreach(old('anggota_mahasiswa') as $index => $mahasiswa)
                                        <div class="relative flex flex-col gap-2 mb-4 p-3 border border-gray-200 rounded-lg mahasiswa-item">
                                            <button type="button" class="top-2 right-2 absolute text-red-500 hover:text-red-700 transition duration-200 remove-mahasiswa-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                                                <div>
                                                    <label for="mahasiswa_nama_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Nama:</label>
                                                    <input type="text" name="anggota_mahasiswa[{{ $index }}][nama]" id="mahasiswa_nama_{{ $index }}" value="{{ $mahasiswa['nama'] ?? '' }}" required
                                                           class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                                </div>
                                                <div>
                                                    <label for="mahasiswa_nim_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">NIM:</label>
                                                    <input type="text" name="anggota_mahasiswa[{{ $index }}][nim]" id="mahasiswa_nim_{{ $index }}" value="{{ $mahasiswa['nim'] ?? '' }}" required
                                                           class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="mahasiswa_jurusan_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Jurusan:</label>
                                                <input type="text" name="anggota_mahasiswa[{{ $index }}][jurusan]" id="mahasiswa_jurusan_{{ $index }}" value="{{ $mahasiswa['jurusan'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add_mahasiswa_btn" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-full text-white text-sm transition duration-200">
                                Tambah Mahasiswa
                            </button>
                        </div>

                        {{-- Additional Creators --}}
                        <h3 class="mt-6 mb-2 font-semibold text-gray-700 text-lg">Anggota Pencipta Lain</h3>
                        <div id="anggota_pencipta_container" class="space-y-6">
                            @if(old('anggota_pencipta'))
                                @foreach(old('anggota_pencipta') as $index => $anggota)
                                    <div class="relative space-y-4 p-4 border border-gray-300 rounded-lg anggota-pencipta-item">
                                        <h4 class="font-semibold text-gray-700 text-md">Anggota Pencipta #{{ $index + 1 }}</h4>
                                        <button type="button" class="top-2 right-2 absolute text-red-500 hover:text-red-700 transition duration-200 remove-anggota-pencipta-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                                            <div>
                                                <label for="anggota_nik_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">NIK:</label>
                                                <input type="text" name="anggota_pencipta[{{ $index }}][nik]" id="anggota_nik_{{ $index }}" value="{{ $anggota['nik'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_nama_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Nama Lengkap:</label>
                                                <input type="text" name="anggota_pencipta[{{ $index }}][nama]" id="anggota_nama_{{ $index }}" value="{{ $anggota['nama'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_email_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">E-mail:</label>
                                                <input type="email" name="anggota_pencipta[{{ $index }}][email]" id="anggota_email_{{ $index }}" value="{{ $anggota['email'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_hp_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">No. HP:</label>
                                                <input type="tel" name="anggota_pencipta[{{ $index }}][hp]" id="anggota_hp_{{ $index }}" value="{{ $anggota['hp'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                        </div>
                                        <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                                            <div>
                                                <label for="anggota_provinsi_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Provinsi:</label>
                                                <input type="text" name="anggota_pencipta[{{ $index }}][provinsi]" id="anggota_provinsi_{{ $index }}" value="{{ $anggota['provinsi'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_kabupaten_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kabupaten/Kota:</label>
                                                <input type="text" name="anggota_pencipta[{{ $index }}][kabupaten]" id="anggota_kabupaten_{{ $index }}" value="{{ $anggota['kabupaten'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_kecamatan_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                                <input type="text" name="anggota_pencipta[{{ $index }}][kecamatan]" id="anggota_kecamatan_{{ $index }}" value="{{ $anggota['kecamatan'] ?? '' }}" required
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="anggota_alamat_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Alamat:</label>
                                            <textarea name="anggota_pencipta[{{ $index }}][alamat]" id="anggota_alamat_{{ $index }}" rows="2" required
                                                      class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">{{ $anggota['alamat'] ?? '' }}</textarea>
                                        </div>
                                        <div>
                                            <label for="anggota_kodepos_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kode POS:</label>
                                            <input type="text" name="anggota_pencipta[{{ $index }}][kodepos]" id="anggota_kodepos_{{ $index }}" value="{{ $anggota['kodepos'] ?? '' }}" required
                                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" id="add_anggota_pencipta_btn" class="bg-blue-500 hover:bg-blue-600 shadow-md px-6 py-3 rounded-full font-semibold text-md text-white transition duration-200 cursor-pointer">
                            Tambah Anggota Pencipta
                        </button>

                        {{-- Files --}}
                        <div class="mt-6">
                            <label for="scan_ktp_pencipta" class="block mb-2 font-medium text-gray-600 text-sm">Scan KTP Pencipta (PDF):</label>
                            <input type="file" name="scan_ktp_pencipta" id="scan_ktp_pencipta" accept=".pdf" {{ old('scan_ktp_pencipta') ? '' : 'required' }}
                                   class="block hover:file:bg-[#5bb3b8] file:bg-[#68C5CC] file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-700 file:text-white text-sm file:text-sm cursor-pointer">
                            @if(old('scan_ktp_pencipta'))
                                <p class="mt-1 text-gray-500 text-sm">File sebelumnya: {{ old('scan_ktp_pencipta')->getClientOriginalName() }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="kota_pengumuman" class="block mb-2 font-medium text-gray-600 text-sm">Kota Pengumuman:</label>
                            <input type="text" name="kota_pengumuman" id="kota_pengumuman" value="{{ old('kota_pengumuman') }}" required
                                   class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                        </div>

                        <div>
                            <label for="tanggal_pengumuman" class="block mb-2 font-medium text-gray-600 text-sm">Tanggal Pengumuman:</label>
                            <input type="date" name="tanggal_pengumuman" id="tanggal_pengumuman" value="{{ old('tanggal_pengumuman') }}" required
                                   class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                        </div>

                        <div>
                            <label for="dokumen_ciptaan" class="block mb-2 font-medium text-gray-600 text-sm">Dokumen Ciptaan (PDF/DOCX):</label>
                            <input type="file" name="dokumen_ciptaan" id="dokumen_ciptaan" accept=".pdf,.docx" {{ old('dokumen_ciptaan') ? '' : 'required' }}
                                   class="block hover:file:bg-[#5bb3b8] file:bg-[#68C5CC] file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-700 file:text-white text-sm file:text-sm cursor-pointer">
                            @if(old('dokumen_ciptaan'))
                                <p class="mt-1 text-gray-500 text-sm">File sebelumnya: {{ old('dokumen_ciptaan')->getClientOriginalName() }}</p>
                            @endif
                        </div>

                        {{-- Agreement --}}
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="pernyataan_setuju" id="pernyataan_setuju" class="text-[#68C5CC] form-checkbox" {{ old('pernyataan_setuju') ? 'checked' : '' }} required>
                            <label for="pernyataan_setuju" class="ml-2 text-gray-700 text-sm">Saya menyetujui bahwa data yang diisikan sudah benar dan sesuai.</label>
                        </div>

                        <button type="submit" class="bg-[#68C5CC] hover:bg-[#5bb3b8] shadow-md mt-6 px-6 py-3 rounded-full w-full font-semibold text-white text-lg transition duration-200 cursor-pointer">
                            Unggah Hak Cipta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Complete functionality in one script - Anggota Pencipta
        function addAnggotaPenciptaField() {
            console.log('addAnggotaPenciptaField function executing');
            
            const anggotaPenciptaContainer = document.getElementById('anggota_pencipta_container');
            if (!anggotaPenciptaContainer) {
                console.error('anggota_pencipta_container not found');
                return;
            }
            
            const div = document.createElement('div');
            div.classList.add('anggota-pencipta-item', 'space-y-4', 'border', 'border-gray-300', 'p-4', 'rounded-lg', 'relative');
            const currentIndex = anggotaPenciptaContainer.children.length;
            
            div.innerHTML = `
                <h4 class="font-semibold text-gray-700 text-md">Anggota Pencipta #${currentIndex + 1}</h4>
                <button type="button" class="remove-anggota-pencipta-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">NIK:</label>
                        <input type="text" name="anggota_pencipta[${currentIndex}][nik]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">Nama Lengkap:</label>
                        <input type="text" name="anggota_pencipta[${currentIndex}][nama]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">E-mail:</label>
                        <input type="email" name="anggota_pencipta[${currentIndex}][email]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">No. HP:</label>
                        <input type="tel" name="anggota_pencipta[${currentIndex}][hp]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                </div>
                <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">Provinsi:</label>
                        <input type="text" name="anggota_pencipta[${currentIndex}][provinsi]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">Kabupaten/Kota:</label>
                        <input type="text" name="anggota_pencipta[${currentIndex}][kabupaten]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">Kecamatan:</label>
                        <input type="text" name="anggota_pencipta[${currentIndex}][kecamatan]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-600 text-sm">Alamat:</label>
                    <textarea name="anggota_pencipta[${currentIndex}][alamat]" rows="2" required
                              class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700"></textarea>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-600 text-sm">Kode POS:</label>
                    <input type="text" name="anggota_pencipta[${currentIndex}][kodepos]" required
                           class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                </div>
            `;
            
            anggotaPenciptaContainer.appendChild(div);
            console.log('New anggota pencipta field added successfully');

            // Add remove functionality to the new button
            const removeBtn = div.querySelector('.remove-anggota-pencipta-btn');
            removeBtn.addEventListener('click', function() {
                console.log('Remove button clicked');
                div.remove();
                reindexPenciptaFields();
            });
        }

        function reindexPenciptaFields() {
            const container = document.getElementById('anggota_pencipta_container');
            const items = container.querySelectorAll('.anggota-pencipta-item');
            
            items.forEach((item, index) => {
                const title = item.querySelector('h4');
                if (title) {
                    title.textContent = `Anggota Pencipta #${index + 1}`;
                }

                // Update input names
                item.querySelectorAll('input, textarea').forEach(input => {
                    const oldName = input.name;
                    if (oldName && oldName.includes('anggota_pencipta')) {
                        const newName = oldName.replace(/\[\d+\]/, `[${index}]`);
                        input.name = newName;
                    }
                });
            });
        }

        // Mahasiswa functionality
        function addMahasiswaField() {
            const mahasiswaList = document.getElementById('mahasiswa_list');
            const div = document.createElement('div');
            div.classList.add('mahasiswa-item', 'flex', 'flex-col', 'gap-2', 'mb-4', 'p-3', 'border', 'border-gray-200', 'rounded-lg', 'relative');
            const currentIndex = mahasiswaList.children.length;
            div.innerHTML = `
                <button type="button" class="remove-mahasiswa-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">Nama:</label>
                        <input type="text" name="anggota_mahasiswa[${currentIndex}][nama]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600 text-sm">NIM:</label>
                        <input type="text" name="anggota_mahasiswa[${currentIndex}][nim]" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                </div>
                <div>
                    <label class="block mb-1 font-medium text-gray-600 text-sm">Jurusan:</label>
                    <input type="text" name="anggota_mahasiswa[${currentIndex}][jurusan]" required
                           class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                </div>
            `;
            mahasiswaList.appendChild(div);

            div.querySelector('.remove-mahasiswa-btn').addEventListener('click', function() {
                div.remove();
                reindexMahasiswaFields();
                const mahasiswaYesRadio = document.getElementById('mahasiswa_yes');
                if (mahasiswaYesRadio.checked && mahasiswaList.children.length === 0) {
                    addMahasiswaField();
                }
            });
        }

        function reindexMahasiswaFields() {
            const mahasiswaList = document.getElementById('mahasiswa_list');
            const items = mahasiswaList.querySelectorAll('.mahasiswa-item');
            items.forEach((item, index) => {
                item.querySelectorAll('input').forEach(input => {
                    const oldName = input.name;
                    const newName = oldName.replace(/\[\d+\]/, `[${index}]`);
                    input.name = newName;
                });
            });
        }

        function toggleMahasiswaSection() {
            const mahasiswaYesRadio = document.getElementById('mahasiswa_yes');
            const mahasiswaNoRadio = document.getElementById('mahasiswa_no');
            const mahasiswaSection = document.getElementById('daftar_anggota_mahasiswa_section');
            const mahasiswaList = document.getElementById('mahasiswa_list');

            if (mahasiswaYesRadio.checked) {
                mahasiswaSection.classList.remove('hidden');
                if (mahasiswaList.children.length === 0) {
                    addMahasiswaField();
                }
            } else {
                mahasiswaSection.classList.add('hidden');
                mahasiswaList.innerHTML = '';
            }
        }

        // Add event listener to the buttons
        document.getElementById('add_anggota_pencipta_btn').addEventListener('click', function() {
            // console.log('Tambah Anggota Pencipta button clicked!');
            addAnggotaPenciptaField();
        });

        document.getElementById('add_mahasiswa_btn').addEventListener('click', function() {
            // console.log('Tambah Mahasiswa button clicked!');
            addMahasiswaField();
        });

        // Add remove listeners to existing items when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // console.log('DOM loaded - adding remove listeners to existing items');
            
            // Anggota Pencipta remove listeners
            document.querySelectorAll('.remove-anggota-pencipta-btn').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.anggota-pencipta-item').remove();
                    reindexPenciptaFields();
                });
            });

            // Mahasiswa remove listeners
            document.querySelectorAll('.remove-mahasiswa-btn').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.mahasiswa-item').remove();
                    reindexMahasiswaFields();
                    const mahasiswaYesRadio = document.getElementById('mahasiswa_yes');
                    const mahasiswaList = document.getElementById('mahasiswa_list');
                    if (mahasiswaYesRadio.checked && mahasiswaList.children.length === 0) {
                        addMahasiswaField();
                    }
                });
            });

            // Mahasiswa radio button listeners
            document.getElementById('mahasiswa_yes').addEventListener('change', toggleMahasiswaSection);
            document.getElementById('mahasiswa_no').addEventListener('change', toggleMahasiswaSection);

            // console.log('All JavaScript functionality initialized');
        });

        // console.log('Script loaded - buttons should work now');
    </script>
@endsection
[file content end]