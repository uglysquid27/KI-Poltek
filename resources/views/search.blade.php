@extends('layouts.app')

@section('title', 'Search')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen space-y-5" style="font-family: 'Montserrat', sans-serif;">
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
    <button id="advancedSearchBtn" class="mt-2 px-6 py-2 rounded-lg text-white bg-[#E77817] hover:bg-[#9c5212] transition duration-200 cursor-pointer">
       Pencarian Lanjutan
    </button>
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-transparent bg-opacity-10 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full transform scale-95 opacity-0 transition-all duration-300 ease-in" id="modalContent">
        <h2 class="text-2xl font-bold mb-4">Pencarian Lanjutan</h2>
        <form action="{{ route('advancedSearch') }}" method="GET" class="space-y-4">
            <input type="text" name="title" placeholder="Judul" class="w-full px-4 py-2 border rounded-lg" />
            <input type="text" name="category" placeholder="Kategori" class="w-full px-4 py-2 border rounded-lg" />
            <input type="text" name="patent_number" placeholder="Nomor Hak Cipta/Paten" class="w-full px-4 py-2 border rounded-lg" />
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 bg-[#68C5CC] text-white rounded-lg">Cari</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('advancedSearchBtn').addEventListener('click', function() {
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
    });
    
    document.getElementById('closeModal').addEventListener('click', function() {
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modalContent');
        modalContent.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    });
</script>
@endsection
