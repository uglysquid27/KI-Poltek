@extends('layouts.dashboard')

@section('title', 'Ubah Status Desain Industri')

@section('content')
    <div class="flex flex-col min-h-screen">
        <div class="flex md:flex-row flex-col flex-grow bg-gray-100 p-6">
            @include('dashboard.layouts.sidebar')

            <div class="flex flex-1 justify-center items-start p-6">
                <div class="bg-white shadow-xl p-8 rounded-lg w-full max-w-2xl">
                    <h1 class="mb-6 font-bold text-gray-700 text-3xl text-center">Ubah Status Desain Industri</h1>

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

                    <form action="{{ route('dashboard.desain_industri.update_status', $desain->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="judul_desain" class="block mb-2 font-medium text-gray-600 text-sm">Judul Desain:</label>
                            <p class="font-semibold text-gray-900 text-lg">{{ $desain->judul_desain }}</p>
                        </div>

                        <div>
                            <label for="current_status" class="block mb-2 font-medium text-gray-600 text-sm">Status Saat Ini:</label>
                            <p class="font-semibold text-gray-900 text-lg">
                                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                    @if(isset($desain->kekayaanIntelektual->status))
                                        @if($desain->kekayaanIntelektual->status == 'Didaftar') bg-green-100 text-green-800 border-green-300
                                        @elseif($desain->kekayaanIntelektual->status == 'Dalam Proses') bg-blue-100 text-blue-800 border-blue-300
                                        @elseif($desain->kekayaanIntelektual->status == 'Ditolak') bg-red-100 text-red-800 border-red-300
                                        @elseif($desain->kekayaanIntelektual->status == 'Dibatalkan') bg-yellow-100 text-yellow-800 border-yellow-300
                                        @elseif($desain->kekayaanIntelektual->status == 'Ditarik kembali') bg-orange-100 text-orange-800 border-orange-300
                                        @elseif($desain->kekayaanIntelektual->status == 'Berakhir') bg-gray-100 text-gray-800 border-gray-300
                                        @else bg-gray-100 text-gray-800 border-gray-300 @endif
                                    @else
                                        bg-gray-100 text-gray-800 border-gray-300
                                    @endif">
                                    {{ $desain->kekayaanIntelektual->status ?? 'N/A' }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label for="status" class="block mb-2 font-medium text-gray-600 text-sm">Ubah Status Menjadi:</label>
                            <select name="status" id="status" required
                                    class="px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-[#68C5CC] focus:ring-2 w-full text-gray-700">
                                @foreach($statusOptions as $option)
                                    <option value="{{ $option }}" {{ ($desain->kekayaanIntelektual->status ?? '') == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-4 mt-6">
                            <a href="{{ route('dashboard.desain_industri.show', $desain->id) }}"
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