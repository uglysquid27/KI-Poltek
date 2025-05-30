@extends('layouts.app')

@section('title', 'Daftar Hak Cipta')

@section('content')
    <div class="min-h-screen flex flex-col pt-28">
        {{-- Navbar --}}
        <div class="navbar bg-[#ffffff] shadow-sm w-full z-50 fixed top-0">
            <div class="flex-1 flex items-center m-2">
                <a href="/" class="text-xl flex items-center space-x-2 ml-5">
                    <img src="{{ asset('img/logo_polinema.png') }}" alt="Logo" class="h-13 w-auto">
                    <span class="text-sm font-semibold text-gray-700" style="font-family: 'Montserrat', sans-serif;">
                        Kekayaan Intelektual Politeknik Negeri Malang
                    </span>
                </a>
            </div>
            <div class="flex-none flex items-center space-x-5 mr-5">
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Penelurusan</a>
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Total</a>
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Panduan</a>
                @php
                    // Manual authentication check for Blade
                    $authenticatedUser = null;
                    $token = request()->cookie('auth_token');
                    if ($token) {
                        $authenticatedUser = \App\Models\User::where('remember_token', $token)->first();
                    }
                @endphp
                @if($authenticatedUser)
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-5 py-2 text-white bg-red-500 hover:bg-red-600 transition duration-200 cursor-pointer rounded-full font-semibold shadow-md">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold shadow-md">
                        Login
                    </a>
                @endif
            </div>
        </div>

        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            {{-- Include the sidebar from its new layout location --}}
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6">
                <h1 class="text-3xl font-bold text-gray-700 mb-6">Daftar Hak Cipta Anda</h1>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert"> {{-- Added rounded-lg shadow-sm --}}
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert"> {{-- Added rounded-lg shadow-sm --}}
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="bg-white p-6 rounded-lg shadow-xl"> {{-- Increased shadow for main content card --}}
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dashboard.hak_cipta.create') }}" class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-base shadow-md transform hover:scale-105"> {{-- Enhanced button style --}}
                            + Unggah Hak Cipta Baru
                        </a>
                    </div>

                    @if($hakCiptas->isEmpty())
                        <p class="text-gray-700 text-center py-8 text-lg">Belum ada data Hak Cipta yang diunggah.</p> {{-- Increased text size --}}
                    @else
                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm"> {{-- Added rounded-lg, border, shadow to table container --}}
                            <table class="min-w-full divide-y divide-gray-200"> {{-- Removed bg-white, added divide-y --}}
                                <thead class="bg-gray-50"> {{-- Light background for header --}}
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th> {{-- Increased padding, smaller text, uppercase, tracking --}}
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Karya</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Karya</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pencipta Utama</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pengumuman</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status KI</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200"> {{-- Background for body, divide-y for rows --}}
                                    @foreach($hakCiptas as $hakCipta)
                                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out"> {{-- Hover effect for rows --}}
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $hakCipta->id }}</td> {{-- Increased padding, text size, font weight --}}
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ Str::limit($hakCipta->judul_karya, 50) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $hakCipta->jenis_karya }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $hakCipta->pencipta_nama }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ \Carbon\Carbon::parse($hakCipta->tanggal_pengumuman)->format('d M Y') }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
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
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                                {{-- <a href="{{ route('dashboard.hak_cipta.show', $hakCipta->id) }}" class="text-[#68C5CC] hover:text-[#5bb3b8] hover:underline font-medium">Detail</a> Enhanced link style --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination Links --}}
                        <div class="mt-6">
                            {{ $hakCiptas->links('pagination::tailwind') }} {{-- Use Tailwind pagination view --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
