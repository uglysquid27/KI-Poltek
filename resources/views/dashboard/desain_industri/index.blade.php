@extends('layouts.dashboard')

@section('title', 'Daftar Desain Industri')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex md:flex-row flex-col flex-grow bg-gray-100 p-6">
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6">
                <h1 class="mb-6 font-bold text-gray-700 text-3xl">Daftar Desain Industri Anda</h1>

                @if (session('success'))
                    <div class="relative bg-green-100 shadow-sm mb-4 px-4 py-3 border border-green-400 rounded-lg text-green-700" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="relative bg-red-100 shadow-sm mb-4 px-4 py-3 border border-red-400 rounded-lg text-red-700" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="bg-white shadow-xl p-6 rounded-lg">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dashboard.desain_industri.create') }}" class="bg-[#68C5CC] hover:bg-[#5bb3b8] shadow-md px-6 py-3 rounded-full font-semibold text-white text-base hover:scale-105 transition duration-200 cursor-pointer transform">
                            + Unggah Desain Industri Baru
                        </a>
                    </div>

                    @if($desainIndustris->isEmpty())
                        <p class="py-8 text-gray-700 text-lg text-center">Belum ada data Desain Industri yang diunggah.</p>
                    @else
                        <div class="shadow-sm border border-gray-200 rounded-lg overflow-x-auto">
                            <table class="divide-y divide-gray-200 min-w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        {{-- <th class="px-4 py-3 font-semibold text-gray-600 text-xs text-left uppercase tracking-wider">ID</th> --}}
                                        <th class="px-4 py-3 font-semibold text-gray-600 text-xs text-left uppercase tracking-wider">Judul Desain</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 text-xs text-left uppercase tracking-wider">Klaim</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 text-xs text-left uppercase tracking-wider">Pendesain Utama</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 text-xs text-left uppercase tracking-wider">Status KI</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 text-xs text-left uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($desainIndustris as $desain)
                                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                            {{-- <td class="px-4 py-3 font-medium text-gray-900 text-sm whitespace-nowrap">{{ $desain->id }}</td> --}}
                                            <td class="px-4 py-3 text-gray-800 text-sm whitespace-nowrap">{{ Str::limit($desain->judul_desain, 50) }}</td>
                                           <td class="px-4 py-3 text-gray-800 text-sm whitespace-nowrap">
                                                {{ is_array($desain->klaim_desain) ? implode(', ', $desain->klaim_desain) : implode(', ', json_decode($desain->klaim_desain, true)) }}
                                            </td>
                                            <td class="px-4 py-3 text-gray-800 text-sm whitespace-nowrap">{{ $desain->pendesain_nama }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
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
                                            </td>
                                            <td class="flex items-center space-x-2 px-4 py-3 text-gray-800 text-sm whitespace-nowrap">
                                                <a href="{{ route('dashboard.desain_industri.show', $desain->id) }}" class="font-medium text-[#68C5CC] hover:text-[#5bb3b8] hover:underline">Detail</a>
                                                <a href="{{ route('dashboard.desain_industri.edit_status', $desain->id) }}" class="ml-2 font-medium text-blue-600 hover:text-blue-800 hover:underline">Ubah Status</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Links --}}
                        <div class="mt-6">
                            {{ $desainIndustris->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection