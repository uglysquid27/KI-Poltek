@extends('layouts.dashboard')

@section('title', 'Detail Desain Industri')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex md:flex-row flex-col flex-grow bg-gray-100 p-6">
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6">
                <div class="bg-white shadow-xl mx-auto p-8 rounded-lg w-full max-w-4xl">
                    <h1 class="mb-2 font-bold text-gray-700 text-3xl text-center">Detail Desain Industri</h1>
                    
                    {{-- Status Badge --}}
                    <div class="text-center mb-6">
                        <span class="inline-flex items-center rounded-full border px-3 py-1 text-sm font-semibold
                            @if(isset($desain->kekayaanIntelektual->status))
                                @if($desain->kekayaanIntelektual->status == 'Didaftar') bg-green-100 text-green-800 border-green-300
                                @elseif($desain->kekayaanIntelektual->status == 'Dalam Proses') bg-blue-100 text-blue-800 border-blue-300
                                @elseif($desain->kekayaanIntelektual->status == 'Ditolak') bg-red-100 text-red-800 border-red-300
                                @elseif($desain->kekayaanIntelektual->status == 'Dibatalkan') bg-yellow-100 text-yellow-800 border-yellow-300
                                @elseif($desain->kekayaanIntelektual->status == 'Ditarik kembali') bg-orange-100 text-orange-800 border-orange-300
                                @elseif($desain->kekayaanIntelektual->status == 'Berakhir') bg-gray-100 text-gray-800 border-gray-300
                                @else bg-gray-100 text-gray-800 border-gray-300 @endif
                            @else
                                bg-gray-100 text-gray-800 border-gray-300
                            @endif">
                            {{ $desain->kekayaanIntelektual->status ?? 'Dalam Proses' }}
                        </span>
                    </div>

                    <div class="gap-x-6 gap-y-4 grid grid-cols-1 md:grid-cols-2">
                        {{-- Judul Desain --}}
                        <div>
                            <p class="font-medium text-gray-600 text-sm">Judul Desain:</p>
                            <p class="font-semibold text-gray-900 text-lg">{{ $desain->judul_desain }}</p>
                        </div>

                        {{-- Klaim Desain --}}
                        <div>
                            <p class="font-medium text-gray-600 text-sm">Klaim Desain:</p>
                            <p class="text-gray-800">
                                @php
                                    // Handle both array and JSON string
                                    $klaimDesain = is_array($desain->klaim_desain) 
                                        ? $desain->klaim_desain 
                                        : json_decode($desain->klaim_desain, true);
                                @endphp
                                {{ implode(', ', $klaimDesain ?? []) }}
                            </p>
                        </div>

                        {{-- Kegunaan --}}
                        <div class="md:col-span-2">
                            <p class="font-medium text-gray-600 text-sm">Kegunaan:</p>
                            <p class="text-gray-800">{{ $desain->kegunaan }}</p>
                        </div>

                        {{-- Uraian Klaim --}}
                        <div class="md:col-span-2">
                            <p class="font-medium text-gray-600 text-sm">Uraian Klaim:</p>
                            <p class="text-gray-800">{{ $desain->uraian_klaim ?? '-' }}</p>
                        </div>

                        {{-- Data Pemohon --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-4 font-semibold text-gray-700 text-lg">Data Pemohon</h3>
                            <div class="gap-x-4 gap-y-3 grid grid-cols-1 md:grid-cols-2">
                                <div>
                                    <p class="text-gray-600 text-sm">Nama:</p>
                                    <p class="text-gray-800 font-medium">{{ $desain->pemohon_nama }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Jenis:</p>
                                    <p class="text-gray-800 font-medium">
                                        {{ $desain->pemohon_jenis == 'badan_hukum' ? 'Badan Hukum' : 'Perorangan' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kewarganegaraan:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_kewarganegaraan }}</p>
                                </div>
                                @if($desain->pemohon_jenis == 'badan_hukum')
                                    <div>
                                        <p class="text-gray-600 text-sm">Badan Hukum:</p>
                                        <p class="text-gray-800">{{ $desain->pemohon_badan_hukum }}</p>
                                    </div>
                                @endif
                                <div class="md:col-span-2">
                                    <p class="text-gray-600 text-sm">Alamat:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_alamat }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">RT/RW:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_rt_rw }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kelurahan:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_kelurahan }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kecamatan:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_kecamatan }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kota/Kabupaten:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_kota_kabupaten }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kode POS:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_kodepos }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Provinsi:</p>
                                    <p class="text-gray-800">{{ $desain->pemohon_provinsi }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Data Pendesain Utama --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-4 font-semibold text-gray-700 text-lg">Data Pendesain Utama</h3>
                            <div class="gap-x-4 gap-y-3 grid grid-cols-1 md:grid-cols-2">
                                <div>
                                    <p class="text-gray-600 text-sm">Nama:</p>
                                    <p class="text-gray-800 font-medium">{{ $desain->pendesain_nama }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kewarganegaraan:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_kewarganegaraan }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-gray-600 text-sm">Alamat:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_alamat }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">RT/RW:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_rt_rw }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kelurahan:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_kelurahan }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kecamatan:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_kecamatan }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kota/Kabupaten:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_kota_kabupaten }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Kode POS:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_kodepos }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm">Provinsi:</p>
                                    <p class="text-gray-800">{{ $desain->pendesain_provinsi }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Anggota Pendesain Lain --}}
                        @php
                            // Handle both array and JSON string for anggota_pendesain
                            $anggotaPendesain = is_array($desain->anggota_pendesain) 
                                ? $desain->anggota_pendesain 
                                : json_decode($desain->anggota_pendesain, true);
                        @endphp

                        @if(!empty($anggotaPendesain) && is_array($anggotaPendesain))
                            <div class="md:col-span-2 mt-6 pt-4 border-t">
                                <h3 class="mb-4 font-semibold text-gray-700 text-lg">Anggota Pendesain Lain</h3>
                                <div class="space-y-4">
                                    @foreach($anggotaPendesain as $index => $anggota)
                                        <div class="bg-gray-50 p-4 border border-gray-200 rounded-lg">
                                            <h4 class="mb-3 font-medium text-gray-800 text-md">Anggota Pendesain #{{ $index + 1 }}</h4>
                                            <div class="gap-x-4 gap-y-2 grid grid-cols-1 md:grid-cols-2 text-sm">
                                                <div>
                                                    <p class="text-gray-600">Nama:</p>
                                                    <p class="text-gray-800 font-medium">{{ $anggota['nama'] ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Kewarganegaraan:</p>
                                                    <p class="text-gray-800">{{ $anggota['kewarganegaraan'] ?? '-' }}</p>
                                                </div>
                                                <div class="md:col-span-2">
                                                    <p class="text-gray-600">Alamat:</p>
                                                    <p class="text-gray-800">{{ $anggota['alamat'] ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">RT/RW:</p>
                                                    <p class="text-gray-800">{{ $anggota['rt_rw'] ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Kelurahan:</p>
                                                    <p class="text-gray-800">{{ $anggota['kelurahan'] ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Kecamatan:</p>
                                                    <p class="text-gray-800">{{ $anggota['kecamatan'] ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Kota/Kabupaten:</p>
                                                    <p class="text-gray-800">{{ $anggota['kota_kabupaten'] ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Kode POS:</p>
                                                    <p class="text-gray-800">{{ $anggota['kodepos'] ?? '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-gray-600">Provinsi:</p>
                                                    <p class="text-gray-800">{{ $anggota['provinsi'] ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Pernyataan --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-4 font-semibold text-gray-700 text-lg">Pernyataan</h3>
                            <div class="space-y-3">
                                <p class="flex items-center text-gray-800">
                                    @if($desain->pernyataan_kebaruan)
                                        <svg class="mr-2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-green-700 font-medium">Memiliki nilai kebaruan</span>
                                    @else
                                        <svg class="mr-2 w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="text-red-700">Tidak memiliki nilai kebaruan</span>
                                    @endif
                                </p>
                                <p class="flex items-center text-gray-800">
                                    @if($desain->pernyataan_tidak_sengketa)
                                        <svg class="mr-2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-green-700 font-medium">Tidak dalam sengketa</span>
                                    @else
                                        <svg class="mr-2 w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="text-red-700">Dalam sengketa</span>
                                    @endif
                                </p>
                                <p class="flex items-center text-gray-800">
                                    @if($desain->pernyataan_pengalihan_hak)
                                        <svg class="mr-2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-green-700 font-medium">Telah mengalihkan hak</span>
                                    @else
                                        <svg class="mr-2 w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="text-red-700">Belum mengalihkan hak</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- File Dokumen --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-4 font-semibold text-gray-700 text-lg">Dokumen Terkait</h3>
                            <div class="space-y-4">
                                {{-- Gambar Desain --}}
                                <div>
                                    <p class="text-gray-600 text-sm mb-2">Gambar Desain:</p>
                                    @if($desain->file_path_gambar_desain)
                                        <a href="{{ Storage::url($desain->file_path_gambar_desain) }}" target="_blank" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Lihat Gambar Desain
                                        </a>
                                        @if($desain->keterangan_gambar)
                                            @php
                                                $keteranganGambar = is_array($desain->keterangan_gambar) 
                                                    ? $desain->keterangan_gambar 
                                                    : json_decode($desain->keterangan_gambar, true);
                                            @endphp
                                            <p class="text-gray-500 text-xs mt-1">
                                                Keterangan: {{ implode(', ', $keteranganGambar ?? []) }}
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-gray-800">Belum diunggah.</p>
                                    @endif
                                </div>

                                {{-- KTP Pendesain --}}
                                <div>
                                    <p class="text-gray-600 text-sm mb-2">Scan KTP Pendesain:</p>
                                    @if($desain->file_path_ktp_pendesain)
                                        <a href="{{ Storage::url($desain->file_path_ktp_pendesain) }}" target="_blank" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Lihat KTP Pendesain
                                        </a>
                                    @else
                                        <p class="text-gray-800">Belum diunggah.</p>
                                    @endif
                                </div>

                                {{-- Surat Pernyataan Kepemilikan --}}
                                <div>
                                    <p class="text-gray-600 text-sm mb-2">Surat Pernyataan Kepemilikan:</p>
                                    @if($desain->file_path_surat_pernyataan_kepemilikan)
                                        <a href="{{ Storage::url($desain->file_path_surat_pernyataan_kepemilikan) }}" target="_blank" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Lihat Surat Pernyataan
                                        </a>
                                    @else
                                        <p class="text-gray-800">Belum diunggah.</p>
                                    @endif
                                </div>

                                {{-- Surat Pengalihan Hak --}}
                                <div>
                                    <p class="text-gray-600 text-sm mb-2">Surat Pengalihan Hak:</p>
                                    @if($desain->file_path_surat_pengalihan_hak)
                                        <a href="{{ Storage::url($desain->file_path_surat_pengalihan_hak) }}" target="_blank" 
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                            <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Lihat Surat Pengalihan Hak
                                        </a>
                                    @else
                                        <p class="text-gray-800">Tidak ada.</p>
                                    @endif
                                </div>

                                {{-- Akta Badan Hukum --}}
                                @if($desain->pemohon_jenis == 'badan_hukum')
                                    <div>
                                        <p class="text-gray-600 text-sm mb-2">Akta Badan Hukum:</p>
                                        @if($desain->file_path_akta_badan_hukum)
                                            <a href="{{ Storage::url($desain->file_path_akta_badan_hukum) }}" target="_blank" 
                                               class="inline-flex items-center text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                                <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Lihat Akta Badan Hukum
                                            </a>
                                        @else
                                            <p class="text-gray-800">Belum diunggah.</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('dashboard.desain_industri.index') }}" 
                           class="bg-gray-600 hover:bg-gray-700 shadow-md px-6 py-3 rounded-full font-semibold text-white text-lg transition duration-200 cursor-pointer text-center">
                            Kembali ke Daftar Desain Industri
                        </a>
                        
                        {{-- Edit Status Button (for admin only) --}}
                        @auth
                            @if(auth()->user()->role == 1)
                                <a href="{{ route('dashboard.desain_industri.edit-status', $desain->id) }}" 
                                   class="bg-blue-600 hover:bg-blue-700 shadow-md px-6 py-3 rounded-full font-semibold text-white text-lg transition duration-200 cursor-pointer text-center">
                                    Edit Status
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection