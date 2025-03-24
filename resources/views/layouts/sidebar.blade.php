{{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\layouts\sidebar.blade.php --}}
<div class="col-span-2 p-3">
    <h2 class="text-lg font-bold text-gray-700 mb-3">Pencarian Lanjut</h2>
    <form action="{{ route('search') }}" method="GET" class="space-y-3">
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Berdasarkan Status</label>
            
            <div class="flex flex-col w-full mb-5">
                <div data-orientation="horizontal" role="none" class="shrink-0 bg-[#051D47] h-[2px] w-full"></div>
                <div data-orientation="horizontal" role="none" class="shrink-0 bg-[#051D47] h-[3px] w-5/12"></div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                @foreach(App\Models\KekayaanIntelektual::select('status')->distinct()->get() as $status)
                    <div class="flex items-center space-x-1 px-2 py-1 rounded">
                        <input type="checkbox" name="status[]" id="status_{{ $status->status }}"
                            value="{{ $status->status }}" class="checkbox checkbox-primary scale-90" {{ in_array($status->status, request('status', [])) ? 'checked' : '' }}>
                        <label for="status_{{ $status->status }}" class="text-sm text-gray-600">
                            {{ $status->status }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
            <h3 class="text-sm font-medium text-gray-700 mb-2">Berdasarkan Nomor</h3>
            
            <div class="flex flex-col w-full mb-5">
                <div data-orientation="horizontal" role="none" class="shrink-0 bg-[#051D47] h-[2px] w-full"></div>
                <div data-orientation="horizontal" role="none" class="shrink-0 bg-[#051D47] h-[3px] w-5/12"></div>
            </div>
            <div class="my-2">
                <label for="permohonan" class="block text-sm font-medium text-gray-700 mb-2">Nomor permohonan</label>
                <input type="text" name="category" id="category" value="{{ request('category') }}" 
                    placeholder="Enter category (e.g., patent, copyright, trademark)" 
                    class="input input-bordered w-full bg-transparent text-gray-600 border-1 border-gray-600">
            </div>
            <div class="my-2">
                <label for="pendaftaran" class="block text-sm font-medium text-gray-700 mb-2">Nomor pendaftaran</label>
                <input type="text" name="category" id="category" value="{{ request('category') }}" 
                    placeholder="Enter category (e.g., patent, copyright, trademark)" 
                    class="input input-bordered w-full bg-transparent text-gray-600 border-1 border-gray-600">
            </div>
        </div>

        <div class="flex justify-between space-x-2">
            <!-- Reset Filters Button -->
            <button type="reset" class="bg-gray-500 rounded-lg p-2 cursor-pointer transition ease-in-out hover:bg-gray-600 w-1/2">
                Reset Filters
            </button>
        
            <!-- Apply Filters Button -->
            <button type="submit" class="bg-[#051D47] rounded-lg p-2 cursor-pointer transition ease-in-out hover:bg-blue-800 w-1/2">
                Apply Filters
            </button>
        </div>
    </form>
</div>