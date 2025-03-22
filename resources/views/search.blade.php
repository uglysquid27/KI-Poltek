@extends('layouts.app')

@section('title', 'Search')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen space-y-5 " style="font-family: 'Montserrat', sans-serif;">
    <!-- Title at the Top -->
    <h1 class="text-8xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2D2E2E] to-[#68C5CC] text-center">
        Halo!
    </h1>
    <h1 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#2D2E2E] to-[#68C5CC] text-center">
        Jelajahi pangkalan data Kekayaan Intelektual Politeknik Negeri Malang
    </h1>

    <!-- Form in the Center -->
    <form action="{{ route('search') }}" method="GET" class="flex items-center w-full max-w-3xl space-x-2">
        <input 
            type="text" 
            name="query" 
            placeholder="Cari berdasarkan judul, kategori, atau nomor hak cipta/paten"
            class="input input-bordered w-full bg-white border border-gray-300 rounded-lg px-4 py-2 text-gray-500"
            required>
        <button type="submit" class="px-6 py-2 rounded-lg text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer">
            Cari
        </button>
    </form>

    <!-- Additional Button Below -->
    <button class="mt-2 px-6 py-2 rounded-lg text-white bg-[#E77817] hover:bg-[#9c5212] transition duration-200 cursor-pointer">
       Pencarian Lanjutan
    </button>
</div>
@endsection