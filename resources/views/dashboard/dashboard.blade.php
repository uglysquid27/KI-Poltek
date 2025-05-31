@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen flex flex-col">
        {{-- The navbar is now included via layouts/app.blade.php --}}

        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            @include('dashboard.layouts.sidebar')

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

                {{-- Hak Cipta Data Table --}}
                <div class="mt-8 bg-white p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Daftar Hak Cipta</h2>
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dashboard.hak_cipta.create') }}" class="px-4 py-2 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-sm shadow-md">
                            + Unggah Hak Cipta Baru
                        </a>
                    </div>
                    @if($hakCiptas->isEmpty())
                        <p class="text-gray-700 text-center py-8 text-lg">Belum ada data Hak Cipta yang diunggah.</p>
                    @else
                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Karya</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Karya</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pencipta Utama</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pengumuman</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status KI</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($hakCiptas as $hakCipta)
                                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $hakCipta->id }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ Str::limit($hakCipta->judul_karya, 50) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $hakCipta->jenis_karya }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $hakCipta->pencipta_nama }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ \Carbon\Carbon::parse($hakCipta->tanggal_pengumuman)->format('d M Y') }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
                                                <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold
                                                    @if(isset($hakCipta->kekayaanIntelektual->status))
                                                        @if($hakCipta->kekayaanIntelektual->status == 'Didaftar') bg-green-100 text-green-800 border-green-300
                                                        @elseif($hakCipta->kekayaanIntelektual->status == 'Dalam Proses') bg-blue-100 text-blue-800 border-blue-300
                                                        @elseif($hakCipta->kekayaanIntelektual->status == 'Ditolak') bg-red-100 text-red-800 border-red-300
                                                        @else bg-gray-100 text-gray-800 border-gray-300 @endif
                                                    @else
                                                        bg-gray-100 text-gray-800 border-gray-300
                                                    @endif">
                                                    {{ $hakCipta->kekayaanIntelektual->status ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                                {{-- <a href="{{ route('dashboard.hak_cipta.show', $hakCipta->id) }}" class="text-[#68C5CC] hover:text-[#5bb3b8] hover:underline font-medium">Detail</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $hakCiptas->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>

                {{-- Paten Data Table --}}
                <div class="mt-8 bg-white p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Daftar Paten</h2>
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dashboard.paten.create') }}" class="px-4 py-2 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-sm shadow-md">
                            + Unggah Paten Baru
                        </a>
                    </div>
                    @if($patens->isEmpty())
                        <p class="text-gray-700 text-center py-8 text-lg">Belum ada data Paten yang diunggah.</p>
                    @else
                        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Paten</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Inventor Utama</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pengajuan</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status KI</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($patens as $paten)
                                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                            <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $paten->id }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ Str::limit($paten->judul_paten, 50) }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ $paten->inventor_nama }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">{{ \Carbon\Carbon::parse($paten->kekayaanIntelektual->submission_date)->format('d M Y') }}</td>
                                            <td class="px-4 py-3 whitespace-nowrap">
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
                                            </td>
                                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-800">
                                                {{-- <a href="{{ route('dashboard.paten.show', $paten->id) }}" class="text-[#68C5CC] hover:text-[#5bb3b8] hover:underline font-medium">Detail</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            {{ $patens->links('pagination::tailwind') }}
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
