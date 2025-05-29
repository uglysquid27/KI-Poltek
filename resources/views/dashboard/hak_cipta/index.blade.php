@extends('layouts.app')

@section('title', 'Daftar Hak Cipta')

@section('content')
    <div class="min-h-screen flex flex-col pt-28">
        {{-- Navbar (copy from create.blade.php or use a partial) --}}
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
            <div class="w-full md:w-1/5 bg-white shadow-md p-6 rounded-none border-r border-gray-200">
                <h2 class="text-lg font-bold text-gray-700 mb-4">Dashboard Menu</h2>
                <ul class="space-y-3">
                    <li><a href="{{ route('dashboard.dashboard') }}" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Overview</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">My Applications</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Settings</a></li>
                    <li><a href="#" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Reports</a></li>
                    <li class="mt-4 pt-4 border-t border-gray-200"><h3 class="text-md font-semibold text-gray-700 mb-2">Unggah Data</h3></li>
                    <li><a href="{{ route('dashboard.hak_cipta.create') }}" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Hak Cipta Sentra</a></li>
                    <li><a href="{{ route('dashboard.paten.create') }}" class="text-gray-600 hover:text-[#68C5CC] transition duration-200 block p-2 rounded-md hover:bg-gray-50">Paten Sentra</a></li>
                </ul>
            </div>

            <div class="flex-1 p-6">
                <h1 class="text-3xl font-bold text-gray-700 mb-6">Daftar Hak Cipta Anda</h1>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-700">Ini adalah halaman daftar Hak Cipta Anda. Anda dapat menambahkan tabel untuk menampilkan data Hak Cipta dari database di sini.</p>
                    <p class="mt-4">
                        <a href="{{ route('dashboard.hak_cipta.create') }}" class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                            Unggah Hak Cipta Baru
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
