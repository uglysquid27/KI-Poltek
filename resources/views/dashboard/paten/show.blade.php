@extends('layouts.app')

@section('title', 'Detail Paten')

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6">
                <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-4xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Detail Paten</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                        {{-- Judul Paten --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Judul Paten:</p>
                            <p class="text-gray-900 text-lg font-semibold">{{ $paten->judul_paten }}</p>
                        </div>

                        {{-- Abstrak --}}
                        <div class="md:col-span-2">
                            <p class="text-gray-600 text-sm font-medium">Abstrak:</p>
                            <p class="text-gray-800">{{ $paten->abstrak }}</p>
                        </div>

                        {{-- Jumlah Klaim --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Jumlah Klaim:</p>
                            <p class="text-gray-800">{{ $paten->jumlah_klaim }}</p>
                        </div>

                        {{-- Jenis Paten --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Jenis Paten:</p>
                            <p class="text-gray-800">{{ $paten->jenis_paten }}</p>
                        </div>

                        {{-- Tanggal Upload Draft --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Tanggal Upload Draft:</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($paten->tanggal_upload_draft)->format('d M Y') }}</p>
                        </div>

                        {{-- Status KI (from KekayaanIntelektual) --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Status Kekayaan Intelektual:</p>
                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                @if(isset($paten->kekayaanIntelektual->status))
                                    @if($paten->kekayaanIntelektual->status == 'Didaftar') bg-green-100 text-green-800 border-green-300
                                    @elseif($paten->kekayaanIntelektual->status == 'Dalam Proses') bg-blue-100 text-blue-800 border-blue-300
                                    @elseif($paten->kekayaanIntelektual->status == 'Ditolak') bg-red-100 text-red-800 border-red-300
                                    @else bg-gray-100 text-gray-800 border-gray-300 @endif
                                @else
                                    bg-gray-100 text-gray-800 border-gray-300
                                @endif">
                                {{ $paten->kekayaanIntelektual->status ?? 'N/A' }}
                            </span>
                        </div>

                        {{-- Data Ketua Inventor --}}
                        <div class="md:col-span-2 mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Data Ketua Inventor</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                                <div><p class="text-gray-600 text-sm">Nama:</p><p class="text-gray-800">{{ $paten->ketua_inventor_nama }}</p></div>
                                <div><p class="text-gray-600 text-sm">Email:</p><p class="text-gray-800">{{ $paten->ketua_inventor_email }}</p></div>
                                <div><p class="text-gray-600 text-sm">No. HP:</p><p class="text-gray-800">{{ $paten->ketua_inventor_hp }}</p></div>
                                <div><p class="text-gray-600 text-sm">Jurusan:</p><p class="text-gray-800">{{ $paten->ketua_inventor_jurusan }}</p></div>
                                <div class="md:col-span-2"><p class="text-gray-600 text-sm">Alamat:</p><p class="text-gray-800">{{ $paten->ketua_inventor_alamat }}</p></div>
                            </div>
                        </div>

                        {{-- Anggota Inventor (if any) --}}
                        @if($paten->anggota_inventor)
                            <div class="md:col-span-2 mt-6 border-t pt-4">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Anggota Inventor Lain</h3>
                                @foreach($paten->anggota_inventor as $index => $anggota) {{-- json_decode() removed here --}}
                                    <div class="border border-gray-200 p-3 rounded-lg mb-4 bg-gray-50">
                                        <h4 class="font-medium text-gray-800 mb-2">Anggota Inventor #{{ $index + 1 }}</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-1 gap-x-4 text-sm">
                                            <div><p class="text-gray-600">Nama:</p><p class="text-gray-800">{{ $anggota['nama'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Email:</p><p class="text-gray-800">{{ $anggota['email'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">No. HP:</p><p class="text-gray-800">{{ $anggota['hp'] ?? '-' }}</p></div>
                                            <div class="md:col-span-2"><p class="text-gray-600">Alamat:</p><p class="text-gray-800">{{ $anggota['alamat'] ?? '-' }}</p></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Anggota Mahasiswa (if any) --}}
                        <div class="md:col-span-2 mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Anggota Berstatus Mahasiswa</h3>
                            @if($paten->ada_anggota_mahasiswa == 'Ya' && $paten->anggota_mahasiswa)
                                @foreach($paten->anggota_mahasiswa as $index => $mahasiswa) {{-- json_decode() removed here --}}
                                    <div class="border border-gray-200 p-3 rounded-lg mb-4 bg-gray-50">
                                        <h4 class="font-medium text-gray-800 mb-2">Mahasiswa #{{ $index + 1 }}</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-1 gap-x-4 text-sm">
                                            <div><p class="text-gray-600">Nama:</p><p class="text-gray-800">{{ $mahasiswa['nama'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">NIM:</p><p class="text-gray-800">{{ $mahasiswa['nim'] ?? '-' }}</p></div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-800">Tidak ada anggota berstatus mahasiswa.</p>
                            @endif
                        </div>

                        {{-- File Dokumen --}}
                        <div class="md:col-span-2 mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Dokumen Terkait</h3>
                            <div class="space-y-2">
                                @if($paten->file_path_ktp)
                                    <p>
                                        <span class="text-gray-600 text-sm">KTP Seluruh Inventor: </span>
                                        <a href="{{ Storage::url($paten->file_path_ktp) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat File KTP
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">KTP Seluruh Inventor: Belum diunggah.</p>
                                @endif

                                @if($paten->file_path_draft)
                                    <p>
                                        <span class="text-gray-600 text-sm">Draft Deskripsi dan Gambar Paten: </span>
                                        <a href="{{ Storage::url($paten->file_path_draft) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat File Draft
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">Draft Deskripsi dan Gambar Paten: Belum diunggah.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('dashboard.paten.index') }}" class="px-6 py-3 text-white bg-gray-600 hover:bg-gray-700 transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                            Kembali ke Daftar Paten
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
