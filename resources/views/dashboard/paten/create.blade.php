@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
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
            <label for="paten_file" class="block text-gray-600 text-sm font-medium mb-2">Unggah Dokumen
                (PDF/DOCX):</label>
            <input type="file" name="paten_file" id="paten_file" accept=".pdf,.docx" required class="block w-full text-sm text-gray-700
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