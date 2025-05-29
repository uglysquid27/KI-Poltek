@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen flex flex-col">
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

        <div class="flex-grow flex flex-col md:flex-row pt-28">
            <div class="w-full md:w-1/5 bg-white shadow-md p-6 rounded-none border-r border-gray-200">
                <h2 class="text-lg font-bold text-gray-700 mb-4">Dashboard Menu</h2>
                <ul class="space-y-3">
                    <li><a href="{{ route('dashboard.dashboard') }}" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Overview</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">My Applications</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Settings</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Reports</a></li>
                    <li class="mt-4 pt-4 border-t border-gray-200"><h3 class="text-md font-semibold text-gray-700 mb-2">Unggah Data</h3></li>
                    {{-- Updated link to the new Hak Cipta Sentra page --}}
                    <li><a href="{{ route('dashboard.hak_cipta.create') }}" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Hak Cipta Sentra</a></li>
                    <li><a href="{{ route('dashboard.paten.create') }}" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Paten Sentra</a></li>
                </ul>
            </div>

            <div class="flex-1 p-6 bg-gray-100">
                <h1 class="text-3xl font-bold text-gray-700 mb-6">Selamat Datang di Dashboard Anda!</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0 bg-[#68C5CC] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.029M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Aplikasi</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalApplications ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0 bg-blue-500 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l3 3m0 0l3-3m-3 3v2.25M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Persetujuan Tertunda</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $pendingApprovals ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                        <div class="flex-shrink-0 bg-green-500 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Aplikasi Disetujui</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $approvedApplications ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-white p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Aktivitas Terbaru</h2>
                    <ul class="divide-y divide-gray-200">
                        @forelse($recentActivities ?? [] as $activity)
                            <li class="py-3 flex justify-between items-center">
                                <span class="text-gray-700">{{ $activity['description'] }}</span>
                                <span class="text-gray-500 text-sm">{{ $activity['time'] }}</span>
                            </li>
                        @empty
                            <li class="py-3 text-gray-500">Tidak ada aktivitas terbaru.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Paten Sentra Upload Form (Remains unchanged - will be moved to its own page later) --}}
                <div id="paten-form" class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Unggah Data Paten Sentra</h2>
                    <form action="{{-- route('paten_sentra.store') --}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label for="paten_title" class="block text-gray-600 text-sm font-medium mb-2">Judul Paten:</label>
                            <input type="text" name="paten_title" id="paten_title" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="paten_abstract" class="block text-gray-600 text-sm font-medium mb-2">Abstrak:</label>
                            <textarea name="paten_abstract" id="paten_abstract" rows="4" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700"></textarea>
                        </div>
                        <div>
                            <label for="paten_file" class="block text-gray-600 text-sm font-medium mb-2">Unggah Dokumen (PDF/DOCX):</label>
                            <input type="file" name="paten_file" id="paten_file" accept=".pdf,.docx" required
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                        </div>
                        <button type="submit"
                                class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                            Unggah Paten
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
