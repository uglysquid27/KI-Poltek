@extends('layouts.dashboard')

@section('title', 'Ubah Status Paten')

@section('content')
    <div class="min-h-screen flex flex-col">
        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6 flex justify-center items-start">
                <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-2xl">
                    <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Ubah Status Paten</h1>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dashboard.paten.update_status', $paten->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT') {{-- Gunakan metode PUT untuk update --}}

                        <div>
                            <label for="judul_paten" class="block text-gray-600 text-sm font-medium mb-2">Judul Paten:</label>
                            <p class="text-gray-900 text-lg font-semibold">{{ $paten->judul_paten }}</p>
                        </div>

                        <div>
                            <label for="current_status" class="block text-gray-600 text-sm font-medium mb-2">Status Saat Ini:</label>
                            <p class="text-gray-900 text-lg font-semibold">
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
                            </p>
                        </div>

                        <div>
                            <label for="status" class="block text-gray-600 text-sm font-medium mb-2">Ubah Status Menjadi:</label>
                            <select name="status" id="status" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                                @foreach($statusOptions as $option)
                                    <option value="{{ $option }}" {{ ($paten->kekayaanIntelektual->status ?? '') == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="{{ route('dashboard.paten.show', $paten->id) }}"
                               class="px-6 py-3 text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                                Batal
                            </a>
                            <button type="submit"
                                    class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                                Perbarui Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
