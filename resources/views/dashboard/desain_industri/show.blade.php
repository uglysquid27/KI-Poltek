@extends('layouts.dashboard')

@section('title', 'Detail Desain Industri')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex md:flex-row flex-col flex-grow bg-gray-100 p-6">
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6">
                <div class="bg-white shadow-xl mx-auto p-8 rounded-lg w-full max-w-4xl">
                    <h1 class="mb-6 font-bold text-gray-700 text-3xl text-center">Detail Desain Industri</h1>

                    <div class="gap-x-6 gap-y-4 grid grid-cols-1 md:grid-cols-2">
                        {{-- Judul Desain --}}
                        <div>
                            <p class="font-medium text-gray-600 text-sm">Judul Desain:</p>
                            <p class="font-semibold text-gray-900 text-lg">{{ $desain->judul_desain }}</p>
                        </div>

                        {{-- Klaim Desain --}}
                        <div>
                            <p class="font-medium text-gray-600 text-sm">Klaim Desain:</p>
                            <p class="text-gray-800">{{ implode(', ', json_decode($desain->klaim_desain, true)) }}</p>
                        </div>

                        {{-- Kegunaan --}}
                        <div class="md:col-span-2">
                            <p class="font-medium text-gray-600 text-sm">Kegunaan:</p>
                            <p class="text-gray-800">{{ $desain->kegunaan }}</p>
                        </div>

                        {{-- Uraian Klaim --}}
                        <div class="md:col-span-2">
                            <p class="font-medium text-gray-600 text-sm">Uraian Klaim:</p>
                            <p class="text-gray-800">{{ $desain->uraian_klaim }}</p>
                        </div>

                        {{-- Status KI (from KekayaanIntelektual) --}}
                        <div class="md:col-span-2">
                            <p class="font-medium text-gray-600 text-sm">Status Kekayaan Intelektual:</p>
                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                @if(isset($desain->kekayaanIntelektual->status))
                                    @if($desain->kekayaanIntelektual->status == 'Didaftar') bg-green-100 text-green-800 border-green-300
                                    @elseif($desain->kekayaanIntelektual->status == 'Dalam Proses') bg-blue-100 text-blue-800 border-blue-300
                                    @elseif($desain->kekayaanIntelektual->status == 'Ditolak') bg-red-100 text-red-800 border-red-300
                                    @else bg-gray-100 text-gray-800 border-gray-300 @endif
                                @else
                                    bg-gray-100 text-gray-800 border-gray-300
                                @endif">
                                {{ $desain->kekayaanIntelektual->status ?? 'N/A' }}
                            </span>
                        </div>

                        {{-- Data Pemohon --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-2 font-semibold text-gray-700 text-lg">Data Pemohon</h3>
                            <div class="gap-x-4 gap-y-2 grid grid-cols-1 md:grid-cols-2">
                                <div><p class="text-gray-600 text-sm">Nama:</p><p class="text-gray-800">{{ $desain->pemohon_nama }}</p></div>
                                <div><p class="text-gray-600 text-sm">Jenis:</p><p class="text-gray-800">{{ $desain->pemohon_jenis }}</p></div>
                                @if($desain->pemohon_jenis == 'badan_hukum')
                                    <div><p class="text-gray-600 text-sm">Badan Hukum:</p><p class="text-gray-800">{{ $desain->pemohon_badan_hukum }}</p></div>
                                @endif
                                <div class="md:col-span-2"><p class="text-gray-600 text-sm">Alamat:</p><p class="text-gray-800">{{ $desain->pemohon_alamat }}</p></div>
                                <div><p class="text-gray-600 text-sm">RT/RW:</p><p class="text-gray-800">{{ $desain->pemohon_rt_rw }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kelurahan:</p><p class="text-gray-800">{{ $desain->pemohon_kelurahan }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kecamatan:</p><p class="text-gray-800">{{ $desain->pemohon_kecamatan }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kota/Kabupaten:</p><p class="text-gray-800">{{ $desain->pemohon_kota_kabupaten }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kode POS:</p><p class="text-gray-800">{{ $desain->pemohon_kodepos }}</p></div>
                                <div><p class="text-gray-600 text-sm">Provinsi:</p><p class="text-gray-800">{{ $desain->pemohon_provinsi }}</p></div>
                            </div>
                        </div>

                        {{-- Data Pendesain Utama --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-2 font-semibold text-gray-700 text-lg">Data Pendesain Utama</h3>
                            <div class="gap-x-4 gap-y-2 grid grid-cols-1 md:grid-cols-2">
                                <div><p class="text-gray-600 text-sm">Nama:</p><p class="text-gray-800">{{ $desain->pendesain_nama }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kewarganegaraan:</p><p class="text-gray-800">{{ $desain->pendesain_kewarganegaraan }}</p></div>
                                <div class="md:col-span-2"><p class="text-gray-600 text-sm">Alamat:</p><p class="text-gray-800">{{ $desain->pendesain_alamat }}</p></div>
                                <div><p class="text-gray-600 text-sm">RT/RW:</p><p class="text-gray-800">{{ $desain->pendesain_rt_rw }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kelurahan:</p><p class="text-gray-800">{{ $desain->pendesain_kelurahan }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kecamatan:</p><p class="text-gray-800">{{ $desain->pendesain_kecamatan }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kota/Kabupaten:</p><p class="text-gray-800">{{ $desain->pendesain_kota_kabupaten }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kode POS:</p><p class="text-gray-800">{{ $desain->pendesain_kodepos }}</p></div>
                                <div><p class="text-gray-600 text-sm">Provinsi:</p><p class="text-gray-800">{{ $desain->pendesain_provinsi }}</p></div>
                            </div>
                        </div>

                        {{-- Anggota Pendesain Lain (if any) --}}
                        @if($desain->anggota_pendesain)
                            <div class="md:col-span-2 mt-6 pt-4 border-t">
                                <h3 class="mb-2 font-semibold text-gray-700 text-lg">Anggota Pendesain Lain</h3>
                                @foreach(json_decode($desain->anggota_pendesain, true) as $index => $anggota)
                                    <div class="bg-gray-50 mb-4 p-3 border border-gray-200 rounded-lg">
                                        <h4 class="mb-2 font-medium text-gray-800">Anggota Pendesain #{{ $index + 1 }}</h4>
                                        <div class="gap-x-4 gap-y-1 grid grid-cols-1 md:grid-cols-2 text-sm">
                                            <div><p class="text-gray-600">Nama:</p><p class="text-gray-800">{{ $anggota['nama'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Kewarganegaraan:</p><p class="text-gray-800">{{ $anggota['kewarganegaraan'] ?? '-' }}</p></div>
                                            <div class="md:col-span-2"><p class="text-gray-600">Alamat:</p><p class="text-gray-800">{{ $anggota['alamat'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">RT/RW:</p><p class="text-gray-800">{{ $anggota['rt_rw'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Kelurahan:</p><p class="text-gray-800">{{ $anggota['kelurahan'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Kecamatan:</p><p class="text-gray-800">{{ $anggota['kecamatan'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Kota/Kabupaten:</p><p class="text-gray-800">{{ $anggota['kota_kabupaten'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Kode POS:</p><p class="text-gray-800">{{ $anggota['kodepos'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Provinsi:</p><p class="text-gray-800">{{ $anggota['provinsi'] ?? '-' }}</p></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Pernyataan --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-2 font-semibold text-gray-700 text-lg">Pernyataan</h3>
                            <div class="space-y-2">
                                <p class="flex items-center text-gray-800">
                                    @if($desain->pernyataan_kebaruan)
                                        <svg class="mr-2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <svg class="mr-2 w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    @endif
                                    Memiliki nilai kebaruan
                                </p>
                                <p class="flex items-center text-gray-800">
                                    @if($desain->pernyataan_tidak_sengketa)
                                        <svg class="mr-2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <svg class="mr-2 w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    @endif
                                    Tidak dalam sengketa
                                </p>
                                <p class="flex items-center text-gray-800">
                                    @if($desain->pernyataan_pengalihan_hak)
                                        <svg class="mr-2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <svg class="mr-2 w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    @endif
                                    Telah mengalihkan hak
                                </p>
                            </div>
                        </div>

                        {{-- File Dokumen --}}
                        <div class="md:col-span-2 mt-6 pt-4 border-t">
                            <h3 class="mb-2 font-semibold text-gray-700 text-lg">Dokumen Terkait</h3>
                            <div class="space-y-2">
                                @if($desain->file_path_gambar_desain)
                                    <p>
                                        <span class="text-gray-600 text-sm">Gambar Desain: </span>
                                        <a href="{{ Storage::url($desain->file_path_gambar_desain) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                                            <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat Gambar Desain
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">Gambar Desain: Belum diunggah.</p>
                                @endif

                                @if($desain->file_path_ktp_pendesain)
                                    <p>
                                        <span class="text-gray-600 text-sm">Scan KTP Pendesain: </span>
                                        <a href="{{ Storage::url($desain->file_path_ktp_pendesain) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                                            <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat KTP Pendesain
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">Scan KTP Pendesain: Belum diunggah.</p>
                                @endif

                                @if($desain->file_path_surat_pernyataan_kepemilikan)
                                    <p>
                                        <span class="text-gray-600 text-sm">Surat Pernyataan Kepemilikan: </span>
                                        <a href="{{ Storage::url($desain->file_path_surat_pernyataan_kepemilikan) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                                            <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat Surat Pernyataan
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">Surat Pernyataan Kepemilikan: Belum diunggah.</p>
                                @endif

                                @if($desain->file_path_surat_pengalihan_hak)
                                    <p>
                                        <span class="text-gray-600 text-sm">Surat Pengalihan Hak: </span>
                                        <a href="{{ Storage::url($desain->file_path_surat_pengalihan_hak) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                                            <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat Surat Pengalihan Hak
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">Surat Pengalihan Hak: Tidak ada.</p>
                                @endif

                                @if($desain->file_path_akta_badan_hukum)
                                    <p>
                                        <span class="text-gray-600 text-sm">Akta Badan Hukum: </span>
                                        <a href="{{ Storage::url($desain->file_path_akta_badan_hukum) }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                                            <svg class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat Akta Badan Hukum
                                        </a>
                                    </p>
                                @elseif($desain->pemohon_jenis == 'badan_hukum')
                                    <p class="text-gray-800">Akta Badan Hukum: Belum diunggah.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('dashboard.desain_industri.index') }}" class="bg-gray-600 hover:bg-gray-700 shadow-md px-6 py-3 rounded-full font-semibold text-white text-lg transition duration-200 cursor-pointer">
                            Kembali ke Daftar Desain Industri
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection