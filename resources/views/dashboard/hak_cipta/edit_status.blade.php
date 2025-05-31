@extends('layouts.dashboard') {{-- Diubah dari layouts.dashboard menjadi layouts.app --}}

@section('title', 'Ubah Status Hak Cipta')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex md:flex-row flex-col flex-grow bg-gray-100 p-6">
            @include('dashboard.layouts.sidebar')

            <div class="flex flex-1 justify-center items-start p-6">
                <div class="bg-white shadow-xl p-8 rounded-lg w-full max-w-2xl">
                    <h1 class="mb-6 font-bold text-gray-700 text-3xl text-center">Ubah Status Hak Cipta</h1>

                    @if (session('success'))
                        <div class="relative bg-green-100 mb-4 px-4 py-3 border border-green-400 rounded text-green-700" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="relative bg-red-100 mb-4 px-4 py-3 border border-red-400 rounded text-red-700" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="relative bg-red-100 mb-4 px-4 py-3 border border-red-400 rounded text-red-700" role="alert">
                            <ul class="pl-5 list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dashboard.hak_cipta.update_status', $hakCipta->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- Gunakan metode PUT untuk update --}}

                        <div>
                            <label for="judul_karya" class="block mb-2 font-medium text-gray-600 text-sm">Judul Karya:</label>
                            <p class="font-semibold text-gray-900 text-lg">{{ $hakCipta->judul_karya }}</p>
                        </div>

                        <div>
                            <label for="current_status" class="block mb-2 font-medium text-gray-600 text-sm">Status Saat Ini:</label>
                            <p class="font-semibold text-gray-900 text-lg">
                                <span class="inline-flex items-center bg-blue-100 bg-gray-100 bg-gray-100 bg-green-100 bg-red-100 px-2.5 py-0.5 border border-gray-300 border-gray-300 border-green-300 border-red-300 border-blue-300 rounded-full font-semibold text-blue-800 text-gray-800 text-gray-800 text-green-800 text-red-800 text-xs @if(isset($hakCipta->kekayaanIntelektual->status)) @if($hakCipta->kekayaanIntelektual->status == 'Didaftar') @elseif($hakCipta->kekayaanIntelektual->status == 'Dalam Proses') @elseif($hakCipta->kekayaanIntelektual->status == 'Ditolak') @else @endif @else @endif">
                                    {{ $hakCipta->kekayaanIntelektual->status ?? 'N/A' }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label for="status" class="block mb-2 font-medium text-gray-600 text-sm">Ubah Status Menjadi:</label>
                            <select name="status" id="status" required
                                    class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                @foreach($statusOptions as $option)
                                    <option value="{{ $option }}" {{ ($hakCipta->kekayaanIntelektual->status ?? '') == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="{{ route('dashboard.hak_cipta.show', $hakCipta->id) }}"
                               class="bg-gray-200 hover:bg-gray-300 shadow-md px-6 py-3 rounded-full font-semibold text-gray-700 text-lg transition duration-200 cursor-pointer">
                                Batal
                            </a>
                            <button type="submit"
                                    class="bg-[#68C5CC] hover:bg-[#5bb3b8] shadow-md px-6 py-3 rounded-full font-semibold text-white text-lg transition duration-200 cursor-pointer">
                                Perbarui Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
