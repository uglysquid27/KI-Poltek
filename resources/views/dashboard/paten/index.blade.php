@extends('layouts.dashboard')

@section('title', 'Daftar Paten')

@section('content')
    <div class="min-h-screen flex flex-col"> {{-- Removed pt-28 as it's in layouts/app.blade.php --}}
        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6">
                <h1 class="text-3xl font-bold text-gray-700 mb-6">Daftar Paten Anda</h1>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dashboard.paten.create') }}" class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-base shadow-md transform hover:scale-105">
                            + Unggah Paten Baru
                        </a>
                    </div>

                    @if($patens->isEmpty())
                        <p class="text-gray-700 text-center py-8 text-lg">Belum ada data Paten yang diunggah.</p>
                    @else
                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        {{-- <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th> --}}
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Paten</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Ketua Inventor</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Paten</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Upload Draft</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status KI</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($patens as $paten)
                                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                            {{-- <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $paten->id }}</td> --}}
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ Str::limit($paten->judul_paten, 50) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $paten->ketua_inventor_nama }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $paten->jenis_paten }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ \Carbon\Carbon::parse($paten->tanggal_upload_draft)->format('d M Y') }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
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
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                                <a href="{{ route('dashboard.paten.show', $paten->id) }}" class="text-[#68C5CC] hover:text-[#5bb3b8] hover:underline font-medium">Detail</a>
                                                 <a href="{{ route('dashboard.paten.edit_status', $paten->id) }}" class="text-blue-600 hover:text-blue-800 hover:underline font-medium ml-2">Ubah Status</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $patens->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
