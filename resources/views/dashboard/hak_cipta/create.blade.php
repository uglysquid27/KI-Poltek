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
                                <select name="pencipta_provinsi" id="pencipta_provinsi" required
                                        class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                            <div>
                                <label for="pencipta_kabupaten" class="block mb-2 font-medium text-gray-600 text-sm">Kabupaten/Kota:</label>
                                <select name="pencipta_kabupaten" id="pencipta_kabupaten" required disabled
                                        class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                            </div>
                            <div>
                                <label for="pencipta_kecamatan" class="block mb-2 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                <select name="pencipta_kecamatan" id="pencipta_kecamatan" required disabled
                                        class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
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
                                <select name="pencipta_jurusan" id="pencipta_jurusan" required
                                        class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach([
                                        'Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 
                                        'Teknik Mesin', 'Teknik Sipil', 'Arsitektur', 
                                        'Desain Komunikasi Visual', 'Manajemen', 'Akuntansi'
                                    ] as $jurusan)
                                        <option value="{{ $jurusan }}" {{ old('pencipta_jurusan') == $jurusan ? 'selected' : '' }}>
                                            {{ $jurusan }}
                                        </option>
                                    @endforeach
                                </select>
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

                        <div id="daftar_anggota_mahasiswa_section" class="hidden space-y-4 p-4 border border-gray-200 rounded-lg">
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
                                                <select name="anggota_mahasiswa[{{ $index }}][jurusan]" id="mahasiswa_jurusan_{{ $index }}" required
                                                        class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                                    <option value="">Pilih Jurusan</option>
                                                    @foreach([
                                                        'Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 
                                                        'Teknik Mesin', 'Teknik Sipil', 'Arsitektur', 
                                                        'Desain Komunikasi Visual', 'Manajemen', 'Akuntansi'
                                                    ] as $jurusan)
                                                        <option value="{{ $jurusan }}" {{ ($mahasiswa['jurusan'] ?? '') == $jurusan ? 'selected' : '' }}>
                                                            {{ $jurusan }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                                <select name="anggota_pencipta[{{ $index }}][provinsi]" id="anggota_provinsi_{{ $index }}" required
                                                        class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                                    <option value="">Pilih Provinsi</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="anggota_kabupaten_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kabupaten/Kota:</label>
                                                <select name="anggota_pencipta[{{ $index }}][kabupaten]" id="anggota_kabupaten_{{ $index }}" required disabled
                                                        class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                                    <option value="">Pilih Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="anggota_kecamatan_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                                <select name="anggota_pencipta[{{ $index }}][kecamatan]" id="anggota_kecamatan_{{ $index }}" required disabled
                                                        class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
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
                            <select name="kota_pengumuman" id="kota_pengumuman" required
                                    class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                <option value="">Pilih Kota</option>
                            </select>
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

    @push('scripts')
        <script>
            // Pass old form values to JavaScript
            window.oldPenciptaProvinsi = "{{ old('pencipta_provinsi', '') }}";
            window.oldPenciptaKabupaten = "{{ old('pencipta_kabupaten', '') }}";
            window.oldPenciptaKecamatan = "{{ old('pencipta_kecamatan', '') }}";
            window.oldKotaPengumuman = "{{ old('kota_pengumuman', '') }}";
            
            @if(old('anggota_pencipta', []))
                @foreach(old('anggota_pencipta', []) as $index => $anggota)
                    window[`oldAnggotaProvinsi_{{ $index }}`] = "{{ $anggota['provinsi'] ?? '' }}";
                    window[`oldAnggotaKabupaten_{{ $index }}`] = "{{ $anggota['kabupaten'] ?? '' }}";
                    window[`oldAnggotaKecamatan_{{ $index }}`] = "{{ $anggota['kecamatan'] ?? '' }}";
                @endforeach
            @endif
        </script>
        
        <script src="{{ asset('js/region-selector.js') }}"></script>
        <script>
            // --- JavaScript for Dynamic Fields ---
            let mahasiswaCount = {{ count(old('anggota_mahasiswa', [])) }};
            const mahasiswaList = document.getElementById('mahasiswa_list');
            const addMahasiswaBtn = document.getElementById('add_mahasiswa_btn');
            const mahasiswaYesRadio = document.getElementById('mahasiswa_yes');
            const mahasiswaNoRadio = document.getElementById('mahasiswa_no');
            const mahasiswaSection = document.getElementById('daftar_anggota_mahasiswa_section');

            function toggleMahasiswaSection() {
                if (mahasiswaYesRadio.checked) {
                    mahasiswaSection.classList.remove('hidden');
                    if (mahasiswaList.children.length === 0) {
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
                const currentIndex = mahasiswaList.children.length;
                div.innerHTML = `
                    <button type="button" class="top-2 right-2 absolute text-red-500 hover:text-red-700 transition duration-200 remove-mahasiswa-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <label for="mahasiswa_nama_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Nama:</label>
                            <input type="text" name="anggota_mahasiswa[${currentIndex}][nama]" id="mahasiswa_nama_${currentIndex}" required
                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                        </div>
                        <div>
                            <label for="mahasiswa_nim_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">NIM:</label>
                            <input type="text" name="anggota_mahasiswa[${currentIndex}][nim]" id="mahasiswa_nim_${currentIndex}" required
                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                        </div>
                    </div>
                    <div>
                        <label for="mahasiswa_jurusan_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Jurusan:</label>
                        <select name="anggota_mahasiswa[${currentIndex}][jurusan]" id="mahasiswa_jurusan_${currentIndex}" required
                                class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            <option value="">Pilih Jurusan</option>
                            @foreach([
                                'Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 
                                'Teknik Mesin', 'Teknik Sipil', 'Arsitektur', 
                                'Desain Komunikasi Visual', 'Manajemen', 'Akuntansi'
                            ] as $jurusan)
                                <option value="{{ $jurusan }}">{{ $jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                `;
                mahasiswaList.appendChild(div);

                div.querySelector('.remove-mahasiswa-btn').addEventListener('click', function() {
                    div.remove();
                    reindexFields(mahasiswaList, 'anggota_mahasiswa', 'mahasiswa');
                    if (mahasiswaYesRadio.checked && mahasiswaList.children.length === 0) {
                        addMahasiswaField();
                    }
                });
                mahasiswaCount++;
            }

            let anggotaPenciptaCount = {{ count(old('anggota_pencipta', [])) }};
            const anggotaPenciptaContainer = document.getElementById('anggota_pencipta_container');
            const addAnggotaPenciptaBtn = document.getElementById('add_anggota_pencipta_btn');

            function addAnggotaPenciptaField() {
                const div = document.createElement('div');
                div.classList.add('anggota-pencipta-item', 'space-y-4', 'border', 'border-gray-300', 'p-4', 'rounded-lg', 'relative');
                const currentIndex = anggotaPenciptaContainer.children.length;
                div.innerHTML = `
                    <h4 class="font-semibold text-gray-700 text-md">Anggota Pencipta #${currentIndex + 1}</h4>
                    <button type="button" class="top-2 right-2 absolute text-red-500 hover:text-red-700 transition duration-200 remove-anggota-pencipta-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <label for="anggota_nik_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">NIK:</label>
                            <input type="text" name="anggota_pencipta[${currentIndex}][nik]" id="anggota_nik_${currentIndex}" required
                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                        </div>
                        <div>
                            <label for="anggota_nama_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Nama Lengkap:</label>
                            <input type="text" name="anggota_pencipta[${currentIndex}][nama]" id="anggota_nama_${currentIndex}" required
                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                        </div>
                        <div>
                            <label for="anggota_email_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">E-mail:</label>
                            <input type="email" name="anggota_pencipta[${currentIndex}][email]" id="anggota_email_${currentIndex}" required
                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                        </div>
                        <div>
                            <label for="anggota_hp_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">No. HP:</label>
                            <input type="tel" name="anggota_pencipta[${currentIndex}][hp]" id="anggota_hp_${currentIndex}" required
                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                        </div>
                    </div>
                    <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                        <div>
                            <label for="anggota_provinsi_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Provinsi:</label>
                            <select name="anggota_pencipta[${currentIndex}][provinsi]" id="anggota_provinsi_${currentIndex}" required
                                    class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>
                        <div>
                            <label for="anggota_kabupaten_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Kabupaten/Kota:</label>
                            <select name="anggota_pencipta[${currentIndex}][kabupaten]" id="anggota_kabupaten_${currentIndex}" required disabled
                                    class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div>
                            <label for="anggota_kecamatan_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Kecamatan:</label>
                            <select name="anggota_pencipta[${currentIndex}][kecamatan]" id="anggota_kecamatan_${currentIndex}" required disabled
                                    class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="anggota_alamat_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Alamat:</label>
                        <textarea name="anggota_pencipta[${currentIndex}][alamat]" id="anggota_alamat_${currentIndex}" rows="2" required
                                  class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700"></textarea>
                    </div>
                    <div>
                        <label for="anggota_kodepos_${currentIndex}" class="block mb-1 font-medium text-gray-600 text-sm">Kode POS:</label>
                        <input type="text" name="anggota_pencipta[${currentIndex}][kodepos]" id="anggota_kodepos_${currentIndex}" required
                               class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                    </div>
                `;
                anggotaPenciptaContainer.appendChild(div);

                // Initialize region selectors for new member
                initRegionSelectors(
                    `#anggota_provinsi_${currentIndex}`,
                    `#anggota_kabupaten_${currentIndex}`,
                    `#anggota_kecamatan_${currentIndex}`
                );

                div.querySelector('.remove-anggota-pencipta-btn').addEventListener('click', function() {
                    div.remove();
                    reindexFields(anggotaPenciptaContainer, 'anggota_pencipta', 'anggota');
                });
                anggotaPenciptaCount++;
            }

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
                    if (item.querySelector('h4')) {
                        item.querySelector('h4').textContent = `Anggota Pencipta #${index + 1}`;
                    }
                });
            }

            // Initialize
            mahasiswaYesRadio.addEventListener('change', toggleMahasiswaSection);
            mahasiswaNoRadio.addEventListener('change', toggleMahasiswaSection);
            addMahasiswaBtn.addEventListener('click', addMahasiswaField);
            addAnggotaPenciptaBtn.addEventListener('click', addAnggotaPenciptaField);

            if (mahasiswaCount > 0 && mahasiswaYesRadio.checked) {
                mahasiswaSection.classList.remove('hidden');
            }
        </script>
    @endpush
@endsection