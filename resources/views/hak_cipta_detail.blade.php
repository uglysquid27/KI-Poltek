@extends('layouts.app')

@section('title', 'Hak Cipta Detail')

@section('content')
    <div class="min-h-screen w-full flex flex-col pt-28 text-gray-600">
        <div class="container mx-auto">
            <form action="{{ route('search') }}" method="GET"
                class="mb-5 input-bordered border border-gray-600 p-2 rounded-full">

                <div class="flex items-center space-x-2 ">
                    <div class="relative w-1/7">
                        <button id="dropdownButton" type="button"
                            class="w-full bg-transparent border border-gray-600 text-gray-600 rounded-full px-4 py-2 text-left focus:outline-none">
                            <span id="dropdownSelected">
                                {{ request('filter') ? ucfirst(request('filter')) : 'Hak Cipta' }}
                            </span>
                            <svg class="w-5 h-5 inline-block float-right" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul id="dropdownMenu"
                            class="absolute z-10 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-full mt-1 opacity-0 transform scale-95 transition-all duration-300 ease-in-out">
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-600" data-value="hak_cipta">
                                Hak Cipta
                            </li>
                            <li class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-gray-600" data-value="paten">
                                Paten</li>
                        </ul>
                        <input type="hidden" name="filter" id="filter" value="{{ request('filter') ?? 'hak_cipta' }}">
                    </div>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search again..."
                        class="w-full bg-transparent rounded-lg px-4 py-2 text-gray-500 focus:outline-none focus:ring-0"
                        required>
                    <button type="submit"
                        class="px-3 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full">
                        <svg fill="#f0f0f0" height="20px" width="20px" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 490.4 490.4" xml:space="preserve">
                            <g>
                                <path
                                    d="M484.1,454.796l-110.5-110.6c29.8-36.3,47.6-82.8,47.6-133.4c0-116.3-94.3-210.6-210.6-210.6S0,94.496,0,210.796
                                                            s94.3,210.6,210.6,210.6c50.8,0,97.4-18,133.8-48l110.5,110.5c12.9,11.8,25,4.2,29.2,0C492.5,475.596,492.5,463.096,484.1,454.796z
                                                            M41.1,210.796c0-93.6,75.9-169.5,169.5-169.5s169.6,75.9,169.6,169.5s-75.9,169.5-169.5,169.5S41.1,304.396,41.1,210.796z" />
                            </g>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Top Section: Nomor, Tanggal, and Status -->
            <div
                class="flex flex-col md:flex-row justify-between items-center mb-5 border-1 border-gray-600 rounded-md h-16">
                <!-- Nomor -->
                <div class="flex flex-col justify-center w-full md:w-1/3 px-2 md:px-5">
                    <div class="text-xs text-gray-700 font-bold">Nomor Hak Cipta</div>
                    <div class="font-semibold text-gray-800">{{ $hakCipta->hak_cipta_number }}</div>
                </div>
                <div class="h-full border-r-1 border-gray-600 mx-2"></div>

                <!-- Tanggal -->
                <div class="flex flex-col justify-center w-full md:w-1/3 px-2 md:px-5">
                    <div class="text-xs text-gray-700 font-bold">Tanggal</div>
                    <div class="font-semibold text-gray-800">{{ $hakCipta->kekayaanIntelektual->submission_date }}</div>
                </div>
                <div class="h-full border-r-1 border-gray-600 mx-2"></div>

                <!-- Status -->
                <div class="flex flex-col justify-center w-full md:w-1/3 px-2 md:px-5">
                    <div class="text-xs text-gray-700 font-bold">Status</div>
                    <div class="pt-1">
                        <div
                            class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-sm font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-blue-200 text-blue-700 hover:bg-blue-200">
                            {{ ucfirst($hakCipta->kekayaanIntelektual->status ?? 'Unknown') }}
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-2xl mb-4"><strong> {{ $hakCipta->kekayaanIntelektual->title ?? 'N/A' }} </strong></p>
            <div class="bg-white shadow-md rounded-lg p-5 mb-3">
                <!-- Data from Hak Cipta -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Nomor Hak Cipta -->
                    <div>
                        <p class="text-xs text-gray-700 font-bold">Nomor Hak Cipta</p>
                        <p class="font-semibold text-gray-800">{{ $hakCipta->hak_cipta_number }}</p>
                    </div>

                    <!-- Tanggal Permohonan -->
                    <div>
                        <p class="text-xs text-gray-700 font-bold">Tanggal Permohonan</p>
                        <p class="font-semibold text-gray-800">
                            {{ $hakCipta->kekayaanIntelektual->submission_date ?? 'N/A' }}</p>
                    </div>

                    <!-- Tanggal Pertama Kali Diumumkan -->
                    <div>
                        <p class="text-xs text-gray-700 font-bold">Tanggal Pertama Kali Diumumkan</p>
                        <p class="font-semibold text-gray-800">
                            {{ $hakCipta->kekayaanIntelektual->publication_date ?? 'N/A' }}</p>
                    </div>

                    <!-- Tanggal Habis Masa Perlindungan -->
                    <div>
                        <p class="text-xs text-gray-700 font-bold">Tanggal Habis Masa Perlindungan</p>
                        <p class="font-semibold text-gray-800">
                            {{ $hakCipta->kekayaanIntelektual->publication_date ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="p-5 mb-20">
                <div class="grid grid-cols-12 gap-y-15">
                    <!-- Uraian -->
                    <div class="col-span-2">
                        <p class="text-lg text-gray-700 font-bold">Uraian</p>
                    </div>
                    <div class="col-span-10">
                        <p class="font-semibold text-lg text-gray-800">{{ $hakCipta->kekayaanIntelektual->description ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Jenis Ciptaan -->
                    <div class="col-span-2">
                        <p class="text-lg text-gray-700 font-bold">Jenis Ciptaan</p>
                    </div>
                    <div class="col-span-10">
                        <p class="font-semibold text-lg text-gray-800">{{ $hakCipta->kekayaanIntelektual->category ?? 'N/A' }}</p>
                    </div>

                    <!-- Pemegang -->
                    <!-- Pemegang -->
                    <div class="col-span-2">
                        <p class="text-lg text-gray-700 font-bold">Pemegang</p>
                    </div>
                    <div class="col-span-10">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class=" px-4 py-2 text-left text-lg text-gray-700 font-bold w-1/2">Nama</th>
                                    <th class=" px-4 py-2 text-left text-lg text-gray-700 font-bold w-1/2">Kewarganegaraan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hakCipta->pemegangs as $pemegang)
                                    <tr>
                                        <td class=" px-4 py-2 text-lg text-gray-800 w-1/2">{{ $pemegang->name }}</td>
                                        <td class=" px-4 py-2 text-lg text-gray-800 w-1/2">{{ $pemegang->nationality }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pencipta -->
                    <div class="col-span-2">
                        <p class="text-lg text-gray-700 font-bold">Pencipta</p>
                    </div>
                    <div class="col-span-10">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left text-lg text-gray-700 font-bold w-1/2 ">Nama</th>
                                    <th class="px-4 py-2 text-left text-lg text-gray-700 font-bold w-1/2">Kewarganegaraan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hakCipta->penciptas as $pencipta)
                                    <tr>
                                        <td class="px-4 py-2 text-lg text-gray-800 w-1/2">{{ $pencipta->name }}</td>
                                        <td class="px-4 py-2 text-lg text-gray-800 w-1/2">{{ $pencipta->nationality }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Konsultan / Kuasa -->
                    <div class="col-span-2">
                        <p class="text-lg text-gray-700 font-bold">Konsultan / Kuasa</p>
                    </div>
                    <div class="col-span-10">
                        <ul>
                            @foreach($hakCipta->konsultans as $konsultan)
                                <li class="font-semibold text-lg text-gray-800">{{ $konsultan->name }} ({{ $konsultan->nationality }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection