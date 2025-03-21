{{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\search.blade.php --}}
@extends('layouts.app')

@section('title', 'Search')

@section('content')
<div class="flex items-center justify-center min-h-screen">
    <div class="p-5 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold text-gray-500 mb-4">Search Kekayaan Intelektual</h1>
        <form action="{{ route('search') }}" method="GET" class="space-y-4">
            <input 
                type="text" 
                name="query" 
                placeholder="Cari berdasarkan judul, kategori, atau nomor hak cipta/paten"
                class="input input-bordered w-full"
                required>
            <button type="submit" class="btn btn-primary w-full">Search</button>
        </form>
    </div>
</div>
@endsection