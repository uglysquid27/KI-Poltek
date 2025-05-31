@extends('layouts.dashboard')

@section('title', 'Detail Hak Cipta')

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6">
                <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-4xl mx-auto">
                    <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Detail Hak Cipta</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-6">
                        {{-- Judul Karya --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Judul Karya:</p>
                            <p class="text-gray-900 text-lg font-semibold">{{ $hakCipta->judul_karya }}</p>
                        </div>

                        {{-- Jenis Karya --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Jenis Karya:</p>
                            <p class="text-gray-800">{{ $hakCipta->jenis_karya }}</p>
                        </div>

                        {{-- Uraian Singkat Ciptaan --}}
                        <div class="md:col-span-2">
                            <p class="text-gray-600 text-sm font-medium">Uraian Singkat Ciptaan:</p>
                            <p class="text-gray-800">{{ $hakCipta->uraian_singkat_ciptaan }}</p>
                        </div>

                        {{-- Kota Pengumuman --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Kota Pengumuman:</p>
                            <p class="text-gray-800">{{ $hakCipta->kota_pengumuman }}</p>
                        </div>

                        {{-- Tanggal Pengumuman --}}
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Tanggal Pengumuman:</p>
                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($hakCipta->tanggal_pengumuman)->format('d M Y') }}</p>
                        </div>

                        {{-- Status KI (from KekayaanIntelektual) --}}
                        <div class="md:col-span-2">
                            <p class="text-gray-600 text-sm font-medium">Status Kekayaan Intelektual:</p>
                            <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                @if(isset($hakCipta->kekayaanIntelektual->status))
                                    @if($hakCipta->kekayaanIntelektual->status == 'Didaftar') bg-green-100 text-green-800 border-green-300
                                    @elseif($hakCipta->kekayaanIntelektual->status == 'Dalam Proses') bg-blue-100 text-blue-800 border-blue-300
                                    @elseif($hakCipta->kekayaanIntelektual->status == 'Ditolak') bg-red-100 text-red-800 border-red-300
                                    @else bg-gray-100 text-gray-800 border-gray-300 @endif
                                @else
                                    bg-gray-100 text-gray-800 border-gray-300
                                @endif">
                                {{ $hakCipta->kekayaanIntelektual->status ?? 'N/A' }}
                            </span>
                        </div>

                        {{-- Data Pencipta Utama --}}
                        <div class="md:col-span-2 mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Data Pencipta Utama</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                                <div><p class="text-gray-600 text-sm">NIK:</p><p class="text-gray-800">{{ $hakCipta->pencipta_nik }}</p></div>
                                <div><p class="text-gray-600 text-sm">Nama:</p><p class="text-gray-800">{{ $hakCipta->pencipta_nama }}</p></div>
                                <div><p class="text-gray-600 text-sm">Email:</p><p class="text-gray-800">{{ $hakCipta->pencipta_email }}</p></div>
                                <div><p class="text-gray-600 text-sm">No. HP:</p><p class="text-gray-800">{{ $hakCipta->pencipta_hp }}</p></div>
                                <div><p class="text-gray-600 text-sm">Jurusan:</p><p class="text-gray-800">{{ $hakCipta->pencipta_jurusan }}</p></div>
                                <div class="md:col-span-2"><p class="text-gray-600 text-sm">Alamat:</p><p class="text-gray-800">{{ $hakCipta->pencipta_alamat }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kecamatan:</p><p class="text-gray-800">{{ $hakCipta->pencipta_kecamatan }}</p></div>
                                <div><p class="text-gray-600 text-sm">Kode POS:</p><p class="text-gray-800">{{ $hakCipta->pencipta_kodepos }}</p></div>
                            </div>
                        </div>

                        {{-- Anggota Pencipta Lain (if any) --}}
                        @if($hakCipta->anggota_pencipta)
                            <div class="md:col-span-2 mt-6 border-t pt-4">
                                <h3 class="text-lg font-semibold text-gray-700 mb-2">Anggota Pencipta Lain</h3>
                                @foreach($hakCipta->anggota_pencipta as $index => $anggota) {{-- json_decode() removed here --}}
                                    <div class="border border-gray-200 p-3 rounded-lg mb-4 bg-gray-50">
                                        <h4 class="font-medium text-gray-800 mb-2">Anggota Pencipta #{{ $index + 1 }}</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-1 gap-x-4 text-sm">
                                            <div><p class="text-gray-600">NIK:</p><p class="text-gray-800">{{ $anggota['nik'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Nama:</p><p class="text-gray-800">{{ $anggota['nama'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Email:</p><p class="text-gray-800">{{ $anggota['email'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">No. HP:</p><p class="text-gray-800">{{ $anggota['hp'] ?? '-' }}</p></div>
                                            <div class="md:col-span-2"><p class="text-gray-600">Alamat:</p><p class="text-gray-800">{{ $anggota['alamat'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Kecamatan:</p><p class="text-gray-800">{{ $anggota['kecamatan'] ?? '-' }}</p></div>
                                            <div><p class="text-gray-600">Kode POS:</p><p class="text-gray-800">{{ $anggota['kodepos'] ?? '-' }}</p></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Anggota Berstatus Mahasiswa (if any) --}}
                        <div class="md:col-span-2 mt-6 border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Anggota Berstatus Mahasiswa</h3>
                            @if($hakCipta->anggota_mahasiswa)
                                @foreach($hakCipta->anggota_mahasiswa as $index => $mahasiswa) {{-- json_decode() removed here --}}
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
                                @if($hakCipta->file_path_ktp)
                                    <p>
                                        <span class="text-gray-600 text-sm">Scan KTP Pencipta: </span>
                                        <a href="{{ Storage::url($hakCipta->file_path_ktp) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat File KTP
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">Scan KTP Pencipta: Belum diunggah.</p>
                                @endif

                                @if($hakCipta->file_path_ciptaan)
                                    <p>
                                        <span class="text-gray-600 text-sm">Dokumen Ciptaan: </span>
                                        <a href="{{ Storage::url($hakCipta->file_path_ciptaan) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Lihat Dokumen Ciptaan
                                        </a>
                                    </p>
                                @else
                                    <p class="text-gray-800">Dokumen Ciptaan: Belum diunggah.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('dashboard.hak_cipta.index') }}" class="px-6 py-3 text-white bg-gray-600 hover:bg-gray-700 transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                            Kembali ke Daftar Hak Cipta
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
