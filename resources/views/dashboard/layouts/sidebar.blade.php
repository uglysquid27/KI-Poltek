<div class="w-full md:w-1/5 bg-white shadow-md p-6 rounded-lg border-r border-gray-200 sticky top-28 self-start"> {{-- Added sticky, top-28, and self-start --}}
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
