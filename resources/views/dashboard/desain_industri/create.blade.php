@extends('layouts.dashboard')

@section('title', 'Unggah Desain Industri')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex md:flex-row flex-col flex-grow bg-gray-100 p-6">
            @include('dashboard.layouts.sidebar')

            <div class="flex flex-1 justify-center items-start p-6">
                <div class="bg-white shadow-xl p-8 rounded-lg w-full max-w-4xl">
                    <h1 class="mb-6 font-bold text-gray-700 text-3xl text-center">Unggah Data Desain Industri</h1>

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

                    <form action="{{ route('dashboard.desain_industri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Basic Information --}}
                        <div>
                            <label for="judul_desain" class="block mb-2 font-medium text-gray-600 text-sm">Judul Desain:</label>
                            <input type="text" name="judul_desain" id="judul_desain" value="{{ old('judul_desain') }}" required
                                   class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700"
                                   placeholder="Contoh: Botol, Kursi, Lampu">
                        </div>

                        <div>
                            <label for="kegunaan" class="block mb-2 font-medium text-gray-600 text-sm">Kegunaan:</label>
                            <textarea name="kegunaan" id="kegunaan" rows="3" required
                                      class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700"
                                      placeholder="Contoh: Sebagai kemasan minuman berkarbonasi">{{ old('kegunaan') }}</textarea>
                        </div>

                        {{-- Claims --}}
                        <div>
                            <label class="block mb-2 font-medium text-gray-600 text-sm">Klaim Desain:</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="klaim_desain[]" value="bentuk" class="text-[#68C5CC] form-checkbox"
                                           {{ is_array(old('klaim_desain')) && in_array('bentuk', old('klaim_desain')) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Bentuk (Kontur terluar dari wujud 3D)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="klaim_desain[]" value="konfigurasi" class="text-[#68C5CC] form-checkbox"
                                           {{ is_array(old('klaim_desain')) && in_array('konfigurasi', old('klaim_desain')) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Konfigurasi (Kombinasi bentuk 3D dengan ornamen)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="klaim_desain[]" value="komposisi_garis_warna" class="text-[#68C5CC] form-checkbox"
                                           {{ is_array(old('klaim_desain')) && in_array('komposisi_garis_warna', old('klaim_desain')) ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Komposisi Garis dan/atau Warna</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="uraian_klaim" class="block mb-2 font-medium text-gray-600 text-sm">Uraian Klaim:</label>
                            <textarea name="uraian_klaim" id="uraian_klaim" rows="3"
                                      class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">{{ old('uraian_klaim') }}</textarea>
                        </div>

                        {{-- Applicant Information --}}
                        <h3 class="mt-6 mb-2 font-semibold text-gray-700 text-lg">Data Pemohon</h3>
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="pemohon_nama" class="block mb-2 font-medium text-gray-600 text-sm">Nama Pemohon:</label>
                                <input type="text" name="pemohon_nama" id="pemohon_nama" value="{{ old('pemohon_nama') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pemohon_kewarganegaraan" class="block mb-2 font-medium text-gray-600 text-sm">Kewarganegaraan Pemohon:</label>
                                <input type="text" name="pemohon_kewarganegaraan" id="pemohon_kewarganegaraan" value="{{ old('pemohon_kewarganegaraan', 'Indonesia') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium text-gray-600 text-sm">Jenis Pemohon:</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pemohon_jenis" value="perorangan" class="text-[#68C5CC] form-radio"
                                           {{ old('pemohon_jenis', 'perorangan') == 'perorangan' ? 'checked' : '' }} required>
                                    <span class="ml-2 text-gray-700">Perorangan</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="pemohon_jenis" value="badan_hukum" class="text-[#68C5CC] form-radio"
                                           {{ old('pemohon_jenis') == 'badan_hukum' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Badan Hukum</span>
                                </label>
                            </div>
                        </div>

                        <div id="badan_hukum_fields" class="{{ old('pemohon_jenis') == 'badan_hukum' ? '' : 'hidden' }}">
                            <div>
                                <label for="pemohon_badan_hukum" class="block mb-2 font-medium text-gray-600 text-sm">Nama Badan Hukum:</label>
                                <input type="text" name="pemohon_badan_hukum" id="pemohon_badan_hukum" value="{{ old('pemohon_badan_hukum') }}"
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="pemohon_alamat" class="block mb-2 font-medium text-gray-600 text-sm">Alamat:</label>
                                <textarea name="pemohon_alamat" id="pemohon_alamat" rows="2" required
                                          class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">{{ old('pemohon_alamat') }}</textarea>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label for="pemohon_rt_rw" class="block mb-2 font-medium text-gray-600 text-sm">RT/RW:</label>
                                    <input type="text" name="pemohon_rt_rw" id="pemohon_rt_rw" value="{{ old('pemohon_rt_rw') }}" required
                                           class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                </div>
                                <div>
                                    <label for="pemohon_kelurahan" class="block mb-2 font-medium text-gray-600 text-sm">Kelurahan:</label>
                                    <input type="text" name="pemohon_kelurahan" id="pemohon_kelurahan" value="{{ old('pemohon_kelurahan') }}" required
                                           class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                </div>
                            </div>
                        </div>

                        <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                            <div>
                                <label for="pemohon_kecamatan" class="block mb-2 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                <input type="text" name="pemohon_kecamatan" id="pemohon_kecamatan" value="{{ old('pemohon_kecamatan') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pemohon_kota_kabupaten" class="block mb-2 font-medium text-gray-600 text-sm">Kota/Kabupaten:</label>
                                <input type="text" name="pemohon_kota_kabupaten" id="pemohon_kota_kabupaten" value="{{ old('pemohon_kota_kabupaten') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pemohon_kodepos" class="block mb-2 font-medium text-gray-600 text-sm">Kode POS:</label>
                                <input type="text" name="pemohon_kodepos" id="pemohon_kodepos" value="{{ old('pemohon_kodepos') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label for="pemohon_provinsi" class="block mb-2 font-medium text-gray-600 text-sm">Provinsi:</label>
                            <input type="text" name="pemohon_provinsi" id="pemohon_provinsi" value="{{ old('pemohon_provinsi') }}" required
                                   class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                        </div>

                        {{-- Designer Information --}}
                        <h3 class="mt-6 mb-2 font-semibold text-gray-700 text-lg">Data Pendesain Utama</h3>
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="pendesain_nama" class="block mb-2 font-medium text-gray-600 text-sm">Nama Pendesain:</label>
                                <input type="text" name="pendesain_nama" id="pendesain_nama" value="{{ old('pendesain_nama') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pendesain_kewarganegaraan" class="block mb-2 font-medium text-gray-600 text-sm">Kewarganegaraan:</label>
                                <input type="text" name="pendesain_kewarganegaraan" id="pendesain_kewarganegaraan" value="{{ old('pendesain_kewarganegaraan', 'Indonesia') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label for="pendesain_alamat" class="block mb-2 font-medium text-gray-600 text-sm">Alamat:</label>
                            <textarea name="pendesain_alamat" id="pendesain_alamat" rows="2" required
                                      class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">{{ old('pendesain_alamat') }}</textarea>
                        </div>

                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="pendesain_rt_rw" class="block mb-2 font-medium text-gray-600 text-sm">RT/RW:</label>
                                <input type="text" name="pendesain_rt_rw" id="pendesain_rt_rw" value="{{ old('pendesain_rt_rw') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pendesain_kelurahan" class="block mb-2 font-medium text-gray-600 text-sm">Kelurahan:</label>
                                <input type="text" name="pendesain_kelurahan" id="pendesain_kelurahan" value="{{ old('pendesain_kelurahan') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                            <div>
                                <label for="pendesain_kecamatan" class="block mb-2 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                <input type="text" name="pendesain_kecamatan" id="pendesain_kecamatan" value="{{ old('pendesain_kecamatan') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pendesain_kota_kabupaten" class="block mb-2 font-medium text-gray-600 text-sm">Kota/Kabupaten:</label>
                                <input type="text" name="pendesain_kota_kabupaten" id="pendesain_kota_kabupaten" value="{{ old('pendesain_kota_kabupaten') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="pendesain_kodepos" class="block mb-2 font-medium text-gray-600 text-sm">Kode POS:</label>
                                <input type="text" name="pendesain_kodepos" id="pendesain_kodepos" value="{{ old('pendesain_kodepos') }}" required
                                       class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                            </div>
                        </div>

                        <div>
                            <label for="pendesain_provinsi" class="block mb-2 font-medium text-gray-600 text-sm">Provinsi:</label>
                            <input type="text" name="pendesain_provinsi" id="pendesain_provinsi" value="{{ old('pendesain_provinsi') }}" required
                                   class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                        </div>

                        {{-- Additional Designers --}}
                        <h3 class="mt-6 mb-2 font-semibold text-gray-700 text-lg">Anggota Pendesain Lain (Opsional)</h3>
                        <div id="anggota_pendesain_container" class="space-y-6">
                            @if(old('anggota_pendesain'))
                                @foreach(old('anggota_pendesain') as $index => $anggota)
                                    <div class="relative space-y-4 p-4 border border-gray-300 rounded-lg anggota-pendesain-item">
                                        <h4 class="font-semibold text-gray-700 text-md">Anggota Pendesain #{{ $index + 1 }}</h4>
                                        <button type="button" class="top-2 right-2 absolute text-red-500 hover:text-red-700 transition duration-200 remove-anggota-pendesain-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                                            <div>
                                                <label for="anggota_nama_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Nama:</label>
                                                <input type="text" name="anggota_pendesain[{{ $index }}][nama]" id="anggota_nama_{{ $index }}" value="{{ $anggota['nama'] ?? '' }}"
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_kewarganegaraan_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kewarganegaraan:</label>
                                                <input type="text" name="anggota_pendesain[{{ $index }}][kewarganegaraan]" id="anggota_kewarganegaraan_{{ $index }}" value="{{ $anggota['kewarganegaraan'] ?? 'Indonesia' }}" 
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="anggota_alamat_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Alamat:</label>
                                            <textarea name="anggota_pendesain[{{ $index }}][alamat]" id="anggota_alamat_{{ $index }}" rows="2"
                                                      class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">{{ $anggota['alamat'] ?? '' }}</textarea>
                                        </div>
                                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                                            <div>
                                                <label for="anggota_rt_rw_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">RT/RW:</label>
                                                <input type="text" name="anggota_pendesain[{{ $index }}][rt_rw]" id="anggota_rt_rw_{{ $index }}" value="{{ $anggota['rt_rw'] ?? '' }}"
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_kelurahan_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kelurahan:</label>
                                                <input type="text" name="anggota_pendesain[{{ $index }}][kelurahan]" id="anggota_kelurahan_{{ $index }}" value="{{ $anggota['kelurahan'] ?? '' }}"
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                        </div>
                                        <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                                            <div>
                                                <label for="anggota_kecamatan_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                                <input type="text" name="anggota_pendesain[{{ $index }}][kecamatan]" id="anggota_kecamatan_{{ $index }}" value="{{ $anggota['kecamatan'] ?? '' }}"
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_kota_kabupaten_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kota/Kabupaten:</label>
                                                <input type="text" name="anggota_pendesain[{{ $index }}][kota_kabupaten]" id="anggota_kota_kabupaten_{{ $index }}" value="{{ $anggota['kota_kabupaten'] ?? '' }}"
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                            <div>
                                                <label for="anggota_kodepos_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Kode POS:</label>
                                                <input type="text" name="anggota_pendesain[{{ $index }}][kodepos]" id="anggota_kodepos_{{ $index }}" value="{{ $anggota['kodepos'] ?? '' }}"
                                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="anggota_provinsi_{{ $index }}" class="block mb-1 font-medium text-gray-600 text-sm">Provinsi:</label>
                                            <input type="text" name="anggota_pendesain[{{ $index }}][provinsi]" id="anggota_provinsi_{{ $index }}" value="{{ $anggota['provinsi'] ?? '' }}"
                                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" id="add_anggota_pendesain_btn" class="bg-blue-500 hover:bg-blue-600 shadow-md px-6 py-3 rounded-full font-semibold text-md text-white transition duration-200 cursor-pointer">
                            Tambah Anggota Pendesain
                        </button>

                        {{-- Files --}}
                        <h3 class="mt-6 mb-2 font-semibold text-gray-700 text-lg">Dokumen Pendukung</h3>
                        
                        <div>
                            <label for="file_path_gambar_desain" class="block mb-2 font-medium text-gray-600 text-sm">Gambar Desain (PDF/JPG/PNG, Max: 10MB):</label>
                            <input type="file" name="file_path_gambar_desain" id="file_path_gambar_desain" accept=".pdf,.jpg,.jpeg,.png" required
                                   class="block hover:file:bg-[#5bb3b8] file:bg-[#68C5CC] file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-700 file:text-white text-sm file:text-sm cursor-pointer">
                        </div>

                        <div>
                            <label for="file_path_ktp_pendesain" class="block mb-2 font-medium text-gray-600 text-sm">Scan KTP Pendesain (PDF, Max: 2MB):</label>
                            <input type="file" name="file_path_ktp_pendesain" id="file_path_ktp_pendesain" accept=".pdf" required
                                   class="block hover:file:bg-[#5bb3b8] file:bg-[#68C5CC] file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-700 file:text-white text-sm file:text-sm cursor-pointer">
                        </div>

                        <div>
                            <label for="file_path_surat_pernyataan_kepemilikan" class="block mb-2 font-medium text-gray-600 text-sm">Surat Pernyataan Kepemilikan (PDF, Max: 2MB):</label>
                            <input type="file" name="file_path_surat_pernyataan_kepemilikan" id="file_path_surat_pernyataan_kepemilikan" accept=".pdf" required
                                   class="block hover:file:bg-[#5bb3b8] file:bg-[#68C5CC] file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-700 file:text-white text-sm file:text-sm cursor-pointer">
                        </div>

                        <div>
                            <label for="file_path_surat_pengalihan_hak" class="block mb-2 font-medium text-gray-600 text-sm">Surat Pengalihan Hak (PDF, Max: 2MB) - Opsional:</label>
                            <input type="file" name="file_path_surat_pengalihan_hak" id="file_path_surat_pengalihan_hak" accept=".pdf"
                                   class="block hover:file:bg-[#5bb3b8] file:bg-[#68C5CC] file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-700 file:text-white text-sm file:text-sm cursor-pointer">
                        </div>

                        <div id="file_path_akta_badan_hukum_container" class="{{ old('pemohon_jenis') == 'badan_hukum' ? '' : 'hidden' }}">
                            <label for="file_path_akta_badan_hukum" class="block mb-2 font-medium text-gray-600 text-sm">Akta Badan Hukum (PDF, Max: 2MB):</label>
                            <input type="file" name="file_path_akta_badan_hukum" id="file_path_akta_badan_hukum" accept=".pdf"
                                   class="block hover:file:bg-[#5bb3b8] file:bg-[#68C5CC] file:mr-4 file:px-4 file:py-2 file:border-0 file:rounded-full w-full file:font-semibold text-gray-700 file:text-white text-sm file:text-sm cursor-pointer">
                        </div>

                        {{-- Agreements --}}
                        <h3 class="mt-6 mb-2 font-semibold text-gray-700 text-lg">Pernyataan</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="pernyataan_kebaruan" id="pernyataan_kebaruan" value="1" class="text-[#68C5CC] form-checkbox" required
                                       {{ old('pernyataan_kebaruan') ? 'checked' : '' }}>
                                <label for="pernyataan_kebaruan" class="ml-2 text-gray-700 text-sm">Saya menyatakan bahwa desain industri ini memiliki nilai kebaruan.</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="pernyataan_tidak_sengketa" id="pernyataan_tidak_sengketa" value="1" class="text-[#68C5CC] form-checkbox" required
                                       {{ old('pernyataan_tidak_sengketa') ? 'checked' : '' }}>
                                <label for="pernyataan_tidak_sengketa" class="ml-2 text-gray-700 text-sm">Saya menyatakan bahwa desain industri ini tidak dalam sengketa.</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" name="pernyataan_pengalihan_hak" id="pernyataan_pengalihan_hak" value="1" class="text-[#68C5CC] form-checkbox"
                                       {{ old('pernyataan_pengalihan_hak') ? 'checked' : '' }}>
                                <label for="pernyataan_pengalihan_hak" class="ml-2 text-gray-700 text-sm">Saya menyatakan telah mengalihkan hak atas desain industri ini (centang jika ada surat pengalihan hak).</label>
                            </div>
                        </div>

                        <button type="submit" class="bg-[#68C5CC] hover:bg-[#5bb3b8] shadow-md mt-6 px-6 py-3 rounded-full w-full font-semibold text-white text-lg transition duration-200 cursor-pointer">
                            Unggah Desain Industri
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Toggle badan hukum fields
                const pemohonJenisRadios = document.querySelectorAll('input[name="pemohon_jenis"]');
                const badanHukumFields = document.getElementById('badan_hukum_fields');
                const aktaBadanHukumContainer = document.getElementById('file_path_akta_badan_hukum_container');
                const pemohonBadanHukumInput = document.getElementById('pemohon_badan_hukum');
                const aktaBadanHukumInput = document.getElementById('file_path_akta_badan_hukum');

                function toggleBadanHukumFields() {
                    const selectedValue = document.querySelector('input[name="pemohon_jenis"]:checked')?.value;
                    
                    if (selectedValue === 'badan_hukum') {
                        badanHukumFields.classList.remove('hidden');
                        aktaBadanHukumContainer.classList.remove('hidden');
                        pemohonBadanHukumInput.required = true;
                        aktaBadanHukumInput.required = true;
                    } else {
                        badanHukumFields.classList.add('hidden');
                        aktaBadanHukumContainer.classList.add('hidden');
                        pemohonBadanHukumInput.required = false;
                        aktaBadanHukumInput.required = false;
                        pemohonBadanHukumInput.value = '';
                        aktaBadanHukumInput.value = '';
                    }
                }

                pemohonJenisRadios.forEach(radio => {
                    radio.addEventListener('change', toggleBadanHukumFields);
                });

                // Initialize on page load
                toggleBadanHukumFields();

                // Dynamic anggota pendesain fields
                let anggotaPendesainIndex = {{ count(old('anggota_pendesain', [])) }};
                const anggotaPendesainContainer = document.getElementById('anggota_pendesain_container');
                const addAnggotaPendesainBtn = document.getElementById('add_anggota_pendesain_btn');

                function createAnggotaPendesainField(index) {
                    const div = document.createElement('div');
                    div.classList.add('anggota-pendesain-item', 'space-y-4', 'border', 'border-gray-300', 'p-4', 'rounded-lg', 'relative');
                    div.innerHTML = `
                        <h4 class="font-semibold text-gray-700 text-md">Anggota Pendesain #${index + 1}</h4>
                        <button type="button" class="top-2 right-2 absolute text-red-500 hover:text-red-700 transition duration-200 remove-anggota-pendesain-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="anggota_nama_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Nama:</label>
                                <input type="text" name="anggota_pendesain[${index}][nama]" id="anggota_nama_${index}"
                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="anggota_kewarganegaraan_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Kewarganegaraan:</label>
                                <input type="text" name="anggota_pendesain[${index}][kewarganegaraan]" id="anggota_kewarganegaraan_${index}" value="Indonesia"
                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            </div>
                        </div>
                        <div>
                            <label for="anggota_alamat_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Alamat:</label>
                            <textarea name="anggota_pendesain[${index}][alamat]" id="anggota_alamat_${index}" rows="2"
                                      class="px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700"></textarea>
                        </div>
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-2">
                            <div>
                                <label for="anggota_rt_rw_${index}" class="block mb-1 font-medium text-gray-600 text-sm">RT/RW:</label>
                                <input type="text" name="anggota_pendesain[${index}][rt_rw]" id="anggota_rt_rw_${index}"
                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="anggota_kelurahan_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Kelurahan:</label>
                                <input type="text" name="anggota_pendesain[${index}][kelurahan]" id="anggota_kelurahan_${index}"
                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            </div>
                        </div>
                        <div class="gap-4 grid grid-cols-1 md:grid-cols-3">
                            <div>
                                <label for="anggota_kecamatan_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Kecamatan:</label>
                                <input type="text" name="anggota_pendesain[${index}][kecamatan]" id="anggota_kecamatan_${index}"
                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="anggota_kota_kabupaten_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Kota/Kabupaten:</label>
                                <input type="text" name="anggota_pendesain[${index}][kota_kabupaten]" id="anggota_kota_kabupaten_${index}"
                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            </div>
                            <div>
                                <label for="anggota_kodepos_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Kode POS:</label>
                                <input type="text" name="anggota_pendesain[${index}][kodepos]" id="anggota_kodepos_${index}"
                                       class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                            </div>
                        </div>
                        <div>
                            <label for="anggota_provinsi_${index}" class="block mb-1 font-medium text-gray-600 text-sm">Provinsi:</label>
                            <input type="text" name="anggota_pendesain[${index}][provinsi]" id="anggota_provinsi_${index}"
                                   class="px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-1 w-full text-gray-700">
                        </div>
                    `;
                    return div;
                }

                function reindexAnggotaPendesain() {
                    const items = anggotaPendesainContainer.querySelectorAll('.anggota-pendesain-item');
                    items.forEach((item, index) => {
                        // Update title
                        const title = item.querySelector('h4');
                        if (title) {
                            title.textContent = `Anggota Pendesain #${index + 1}`;
                        }

                        // Update all input names and IDs
                        const inputs = item.querySelectorAll('input, textarea');
                        inputs.forEach(input => {
                            const name = input.name;
                            const id = input.id;
                            
                            if (name && name.includes('anggota_pendesain')) {
                                input.name = name.replace(/\[\d+\]/, `[${index}]`);
                            }
                            
                            if (id && id.includes('anggota_')) {
                                const newId = id.replace(/_\d+$/, `_${index}`);
                                input.id = newId;
                                
                                // Update corresponding label
                                const label = item.querySelector(`label[for="${id}"]`);
                                if (label) {
                                    label.setAttribute('for', newId);
                                }
                            }
                        });
                    });
                    anggotaPendesainIndex = items.length;
                }

                function addAnggotaPendesainField() {
                    const newField = createAnggotaPendesainField(anggotaPendesainIndex);
                    anggotaPendesainContainer.appendChild(newField);
                    
                    // Add remove event listener
                    const removeBtn = newField.querySelector('.remove-anggota-pendesain-btn');
                    removeBtn.addEventListener('click', function() {
                        newField.remove();
                        reindexAnggotaPendesain();
                    });
                    
                    anggotaPendesainIndex++;
                }

                addAnggotaPendesainBtn.addEventListener('click', addAnggotaPendesainField);

                // Add remove event listeners to existing items
                document.querySelectorAll('.remove-anggota-pendesain-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        btn.closest('.anggota-pendesain-item').remove();
                        reindexAnggotaPendesain();
                    });
                });

                // Form validation
                const form = document.querySelector('form');
                form.addEventListener('submit', function(e) {
                    const klaimDesain = document.querySelectorAll('input[name="klaim_desain[]"]:checked');
                    if (klaimDesain.length === 0) {
                        e.preventDefault();
                        alert('Pilih minimal satu klaim desain.');
                        return false;
                    }
                });
            });
        </script>
    @endpush
@endsection