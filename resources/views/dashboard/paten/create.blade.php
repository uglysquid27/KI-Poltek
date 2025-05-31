@extends('layouts.dashboard')

@section('title', 'Unggah Paten Sentra')

@section('content')
    <div class="min-h-screen flex flex-col"> {{-- Removed pt-28 as it's in layouts/app.blade.php --}}
        <div class="flex-grow flex flex-col md:flex-row p-6 bg-gray-100">
            {{-- Include the sidebar from its new layout location --}}
            @include('dashboard.layouts.sidebar')

            <div class="flex-1 p-6 flex justify-center items-start">
                <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-4xl">
                    <h1 class="text-3xl font-bold text-gray-700 mb-6 text-center">Unggah Data Paten Sentra</h1>

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

                    <form action="{{ route('dashboard.paten.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- Judul Paten --}}
                        <div>
                            <label for="judul_paten" class="block text-gray-600 text-sm font-medium mb-2">Judul Paten:</label>
                            <input type="text" name="judul_paten" id="judul_paten" value="{{ old('judul_paten') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Abstrak --}}
                        <div>
                            <label for="abstrak" class="block text-gray-600 text-sm font-medium mb-2">Abstrak:</label>
                            <textarea name="abstrak" id="abstrak" rows="4" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">{{ old('abstrak') }}</textarea>
                        </div>

                        {{-- Jumlah Klaim --}}
                        <div>
                            <label for="jumlah_klaim" class="block text-gray-600 text-sm font-medium mb-2">Jumlah Klaim:</label>
                            <input type="number" name="jumlah_klaim" id="jumlah_klaim" value="{{ old('jumlah_klaim') }}" required min="1"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Data Ketua Inventor --}}
                        <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-2">Data Ketua Inventor</h3>
                        <div>
                            <label for="ketua_inventor_nama" class="block text-gray-600 text-sm font-medium mb-2">Nama Lengkap:</label>
                            <input type="text" name="ketua_inventor_nama" id="ketua_inventor_nama" value="{{ old('ketua_inventor_nama') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="ketua_inventor_alamat" class="block text-gray-600 text-sm font-medium mb-2">Alamat Lengkap:</label>
                            <textarea name="ketua_inventor_alamat" id="ketua_inventor_alamat" rows="2" required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">{{ old('ketua_inventor_alamat') }}</textarea>
                        </div>
                        <div>
                            <label for="ketua_inventor_email" class="block text-gray-600 text-sm font-medium mb-2">E-mail:</label>
                            <input type="email" name="ketua_inventor_email" id="ketua_inventor_email" value="{{ old('ketua_inventor_email') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="ketua_inventor_hp" class="block text-gray-600 text-sm font-medium mb-2">No. Handphone:</label>
                            <input type="tel" name="ketua_inventor_hp" id="ketua_inventor_hp" value="{{ old('ketua_inventor_hp') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>
                        <div>
                            <label for="ketua_inventor_jurusan" class="block text-gray-600 text-sm font-medium mb-2">Jurusan:</label>
                            <input type="text" name="ketua_inventor_jurusan" id="ketua_inventor_jurusan" value="{{ old('ketua_inventor_jurusan') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Anggota Inventor (Dynamic Fields) --}}
                        <h3 class="text-lg font-semibold text-gray-700 mt-6 mb-2">Anggota Inventor Lain (Jika Ada)</h3>
                        <div id="anggota_inventor_container" class="space-y-6">
                            @if(old('anggota_inventor'))
                                @foreach(old('anggota_inventor') as $index => $anggota)
                                    <div class="anggota-inventor-item space-y-4 border border-gray-300 p-4 rounded-lg relative">
                                        <h4 class="text-md font-semibold text-gray-700">Anggota Inventor #{{ $index + 1 }}</h4>
                                        <button type="button" class="remove-anggota-inventor-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                        <div>
                                            <label for="anggota_inventor_nama_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Nama Lengkap:</label>
                                            <input type="text" name="anggota_inventor[{{ $index }}][nama]" id="anggota_inventor_nama_{{ $index }}" value="{{ $anggota['nama'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                        <div>
                                            <label for="anggota_inventor_alamat_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Alamat:</label>
                                            <textarea name="anggota_inventor[{{ $index }}][alamat]" id="anggota_inventor_alamat_{{ $index }}" rows="2" required
                                                      class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">{{ $anggota['alamat'] ?? '' }}</textarea>
                                        </div>
                                        <div>
                                            <label for="anggota_inventor_email_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">E-mail:</label>
                                            <input type="email" name="anggota_inventor[{{ $index }}][email]" id="anggota_inventor_email_{{ $index }}" value="{{ $anggota['email'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                        <div>
                                            <label for="anggota_inventor_hp_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">No. Handphone:</label>
                                            <input type="tel" name="anggota_inventor[{{ $index }}][hp]" id="anggota_inventor_hp_{{ $index }}" value="{{ $anggota['hp'] ?? '' }}" required
                                                   class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" id="add_anggota_inventor_btn" class="px-6 py-3 text-white bg-blue-500 hover:bg-blue-600 transition duration-200 cursor-pointer rounded-full font-semibold text-md shadow-md">
                            Tambah Anggota Inventor
                        </button>

                        {{-- Jenis Paten --}}
                        <div class="mt-6">
                            <label class="block text-gray-600 text-sm font-medium mb-2">Jenis Paten yang Didaftarkan:</label>
                            <div class="flex flex-wrap gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_paten" value="Paten Biasa" class="form-radio text-[#68C5CC]" {{ old('jenis_paten') == 'Paten Biasa' ? 'checked' : '' }} required>
                                    <span class="ml-2 text-gray-700">Paten Biasa (lebih dari 1 klaim)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="jenis_paten" value="Paten Sederhana" class="form-radio text-[#68C5CC]" {{ old('jenis_paten') == 'Paten Sederhana' ? 'checked' : '' }} required>
                                    <span class="ml-2 text-gray-700">Paten Sederhana (1 klaim)</span>
                                </label>
                            </div>
                        </div>

                        {{-- Upload KTP Seluruh Inventor --}}
                        <div class="mt-6">
                            <label for="file_path_ktp" class="block text-gray-600 text-sm font-medium mb-2">Upload KTP Seluruh Inventor (dalam format .pdf):</label>
                            <input type="file" name="file_path_ktp" id="file_path_ktp" accept=".pdf" {{ old('file_path_ktp') ? '' : 'required' }}
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                            @if(old('file_path_ktp'))
                                <p class="text-sm text-gray-500 mt-1">File sebelumnya: {{ old('file_path_ktp')->getClientOriginalName() }}</p>
                            @endif
                        </div>

                        {{-- Adakah Anggota Berstatus Mahasiswa? --}}
                        <div class="mt-6">
                            <label class="block text-gray-600 text-sm font-medium mb-2">Adakah Anggota Berstatus Mahasiswa?</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Ya" class="form-radio text-[#68C5CC]" id="mahasiswa_yes_paten" {{ old('ada_anggota_mahasiswa') == 'Ya' ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Ya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="ada_anggota_mahasiswa" value="Tidak" class="form-radio text-[#68C5CC]" id="mahasiswa_no_paten" {{ old('ada_anggota_mahasiswa') == 'Tidak' || !old('ada_anggota_mahasiswa') ? 'checked' : '' }}>
                                    <span class="ml-2 text-gray-700">Tidak</span>
                                </label>
                            </div>
                        </div>

                        <div id="daftar_anggota_mahasiswa_section_paten" class="space-y-4 border border-gray-200 p-4 rounded-lg hidden">
                            <h4 class="text-md font-semibold text-gray-700">Daftar Nama Anggota Berstatus Mahasiswa</h4>
                            <div id="mahasiswa_list_paten">
                                {{-- Mahasiswa fields will be added here dynamically --}}
                                @if(old('anggota_mahasiswa'))
                                    @foreach(old('anggota_mahasiswa') as $index => $mahasiswa)
                                        <div class="mahasiswa-item-paten flex flex-col gap-2 mb-4 p-3 border border-gray-200 rounded-lg relative">
                                            <button type="button" class="remove-mahasiswa-btn-paten absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <div>
                                                <label for="mahasiswa_nama_paten_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">Nama Mahasiswa:</label>
                                                <input type="text" name="anggota_mahasiswa[{{ $index }}][nama]" id="mahasiswa_nama_paten_{{ $index }}" value="{{ $mahasiswa['nama'] ?? '' }}" required
                                                       class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                            </div>
                                            <div>
                                                <label for="mahasiswa_nim_paten_{{ $index }}" class="block text-gray-600 text-sm font-medium mb-1">NIM Mahasiswa:</label>
                                                <input type="text" name="anggota_mahasiswa[{{ $index }}][nim]" id="mahasiswa_nim_paten_{{ $index }}" value="{{ $mahasiswa['nim'] ?? '' }}" required
                                                       class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" id="add_mahasiswa_btn_paten" class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-600 transition duration-200">
                                Tambah Mahasiswa
                            </button>
                        </div>

                        {{-- Tanggal Upload Draft --}}
                        <div>
                            <label for="tanggal_upload_draft" class="block text-gray-600 text-sm font-medium mb-2">Tanggal Upload Draft Deskripsi dan Gambar Paten (Bulan, Hari, Tahun):</label>
                            <input type="date" name="tanggal_upload_draft" id="tanggal_upload_draft" value="{{ old('tanggal_upload_draft') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                        </div>

                        {{-- Upload Draft Deskripsi dan Gambar Paten --}}
                        <div>
                            <label for="file_path_draft" class="block text-gray-600 text-sm font-medium mb-2">Upload Draft Deskripsi dan Gambar Paten (1 file dalam format .word):</label>
                            <input type="file" name="file_path_draft" id="file_path_draft" accept=".doc,.docx" {{ old('file_path_draft') ? '' : 'required' }}
                                   class="block w-full text-sm text-gray-700
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-[#68C5CC] file:text-white
                                          hover:file:bg-[#5bb3b8] cursor-pointer">
                            @if(old('file_path_draft'))
                                <p class="text-sm text-gray-500 mt-1">File sebelumnya: {{ old('file_path_draft')->getClientOriginalName() }}</p>
                            @endif
                            <p class="text-xs text-gray-500 mt-1">Contoh template dan dokumen paten granted dapat diakses di <a href="https://bit.ly/3A5xg09" target="_blank" class="text-blue-500 hover:underline">https://bit.ly/3A5xg09</a></p>
                        </div>

                        {{-- Pernyataan --}}
                        <div class="flex items-center mt-6">
                            <input type="checkbox" name="pernyataan_setuju" id="pernyataan_setuju" class="form-checkbox text-[#68C5CC]" {{ old('pernyataan_setuju') ? 'checked' : '' }} required>
                            <label for="pernyataan_setuju" class="ml-2 text-gray-700 text-sm">Saya menyetujui bahwa data yang diisikan sudah benar dan sesuai. Apabila ada kesalahan data paten, nama, gelar dan alamat adalah tanggung jawab dosen dan anggota tim.</label>
                        </div>

                        <button type="submit"
                                class="px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md mt-6">
                            Unggah Paten
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- JavaScript for Dynamic Anggota Inventor Fields ---
        let anggotaInventorCount = {{ count(old('anggota_inventor', [])) }};
        const anggotaInventorContainer = document.getElementById('anggota_inventor_container');
        const addAnggotaInventorBtn = document.getElementById('add_anggota_inventor_btn');

        function addAnggotaInventorField() {
            const div = document.createElement('div');
            div.classList.add('anggota-inventor-item', 'space-y-4', 'border', 'border-gray-300', 'p-4', 'rounded-lg', 'relative');
            const currentIndex = anggotaInventorContainer.children.length;
            div.innerHTML = `
                <h4 class="text-md font-semibold text-gray-700">Anggota Inventor #${currentIndex + 1}</h4>
                <button type="button" class="remove-anggota-inventor-btn absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div>
                    <label for="anggota_inventor_nama_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Nama Lengkap:</label>
                    <input type="text" name="anggota_inventor[${currentIndex}][nama]" id="anggota_inventor_nama_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_inventor_alamat_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Alamat:</label>
                    <textarea name="anggota_inventor[${currentIndex}][alamat]" id="anggota_inventor_alamat_${currentIndex}" rows="2" required
                              class="w-full px-3 py-1.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700"></textarea>
                </div>
                <div>
                    <label for="anggota_inventor_email_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">E-mail:</label>
                    <input type="email" name="anggota_inventor[${currentIndex}][email]" id="anggota_inventor_email_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="anggota_inventor_hp_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">No. Handphone:</label>
                    <input type="tel" name="anggota_inventor[${currentIndex}][hp]" id="anggota_inventor_hp_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
            `;
            anggotaInventorContainer.appendChild(div);

            div.querySelector('.remove-anggota-inventor-btn').addEventListener('click', function() {
                div.remove();
                reindexFields(anggotaInventorContainer, 'anggota_inventor', 'anggota_inventor');
            });
            anggotaInventorCount++;
        }

        addAnggotaInventorBtn.addEventListener('click', addAnggotaInventorField);

        // Attach listeners to existing remove buttons for anggota inventor
        document.querySelectorAll('#anggota_inventor_container .remove-anggota-inventor-btn').forEach(button => {
            button.addEventListener('click', function() {
                button.closest('.anggota-inventor-item').remove();
                reindexFields(anggotaInventorContainer, 'anggota_inventor', 'anggota_inventor');
            });
        });

        // --- JavaScript for Dynamic Mahasiswa Fields (for Paten) ---
        let mahasiswaCountPaten = {{ count(old('anggota_mahasiswa', [])) }};
        const mahasiswaListPaten = document.getElementById('mahasiswa_list_paten');
        const addMahasiswaBtnPaten = document.getElementById('add_mahasiswa_btn_paten');
        const mahasiswaYesRadioPaten = document.getElementById('mahasiswa_yes_paten');
        const mahasiswaNoRadioPaten = document.getElementById('mahasiswa_no_paten');
        const mahasiswaSectionPaten = document.getElementById('daftar_anggota_mahasiswa_section_paten');

        function toggleMahasiswaSectionPaten() {
            if (mahasiswaYesRadioPaten.checked) {
                mahasiswaSectionPaten.classList.remove('hidden');
                if (mahasiswaListPaten.children.length === 0) {
                    addMahasiswaFieldPaten();
                }
            } else {
                mahasiswaSectionPaten.classList.add('hidden');
                mahasiswaListPaten.innerHTML = '';
                mahasiswaCountPaten = 0;
            }
        }

        function addMahasiswaFieldPaten() {
            const div = document.createElement('div');
            div.classList.add('mahasiswa-item-paten', 'flex', 'flex-col', 'gap-2', 'mb-4', 'p-3', 'border', 'border-gray-200', 'rounded-lg', 'relative');
            const currentIndex = mahasiswaListPaten.children.length;
            div.innerHTML = `
                <button type="button" class="remove-mahasiswa-btn-paten absolute top-2 right-2 text-red-500 hover:text-red-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div>
                    <label for="mahasiswa_nama_paten_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">Nama Mahasiswa:</label>
                    <input type="text" name="anggota_mahasiswa[${currentIndex}][nama]" id="mahasiswa_nama_paten_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
                <div>
                    <label for="mahasiswa_nim_paten_${currentIndex}" class="block text-gray-600 text-sm font-medium mb-1">NIM Mahasiswa:</label>
                    <input type="text" name="anggota_mahasiswa[${currentIndex}][nim]" id="mahasiswa_nim_paten_${currentIndex}" required
                           class="w-full px-3 py-1.5 border border-gray-300 rounded-full focus:outline-none focus:ring-1 focus:ring-[#68C5CC] text-gray-700">
                </div>
            `;
            mahasiswaListPaten.appendChild(div);

            div.querySelector('.remove-mahasiswa-btn-paten').addEventListener('click', function() {
                div.remove();
                reindexFields(mahasiswaListPaten, 'anggota_mahasiswa', 'mahasiswa_paten');
                if (mahasiswaYesRadioPaten.checked && mahasiswaListPaten.children.length === 0) {
                    addMahasiswaFieldPaten();
                }
            });
            mahasiswaCountPaten++;
        }

        mahasiswaYesRadioPaten.addEventListener('change', toggleMahasiswaSectionPaten);
        mahasiswaNoRadioPaten.addEventListener('change', toggleMahasiswaSectionPaten);
        addMahasiswaBtnPaten.addEventListener('click', addMahasiswaFieldPaten);

        // Initial check on page load and attach listeners to existing remove buttons
        toggleMahasiswaSectionPaten();
        document.querySelectorAll('#mahasiswa_list_paten .remove-mahasiswa-btn-paten').forEach(button => {
            button.addEventListener('click', function() {
                button.closest('.mahasiswa-item-paten').remove();
                reindexFields(mahasiswaListPaten, 'anggota_mahasiswa', 'mahasiswa_paten');
                if (mahasiswaYesRadioPaten.checked && mahasiswaListPaten.children.length === 0) {
                    addMahasiswaFieldPaten();
                }
            });
        });

        // Helper function to reindex dynamic fields after removal
        function reindexFields(container, baseName, idPrefix) {
            Array.from(container.children).forEach((item, index) => {
                item.querySelectorAll(`[name^="${baseName}["]`).forEach(input => {
                    const oldName = input.name;
                    const newName = oldName.replace(/\[\d+\]/, `[${index}]`);
                    input.name = newName;
                    input.id = input.id.replace(/_\d+/, `_${index}`);
                });
                item.querySelectorAll(`label[for^="${idPrefix}_"]`).forEach(label => {
                    const oldFor = label.getAttribute('for');
                    const newFor = oldFor.replace(/_\d+/, `_${index}`);
                    label.setAttribute('for', newFor);
                });
                // Update title for anggota inventor
                if (item.querySelector('h4') && baseName === 'anggota_inventor') {
                    item.querySelector('h4').textContent = `Anggota Inventor #${index + 1}`;
                }
            });
        }
    </script>
@endsection
