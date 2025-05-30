<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual; // Import model KekayaanIntelektual
use App\Models\HakCipta; // Import model HakCipta
use App\Models\User; // Import model User untuk mendapatkan user_id
use Illuminate\Support\Facades\Log; // Untuk logging
use Illuminate\Support\Facades\Storage; // Untuk link file

class DashboardHakCiptaController extends Controller
{
    public function index()
    {
        // Pastikan hanya pengguna terautentikasi yang bisa mengakses
        $token = request()->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }
        if (!$authenticatedUser) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // Mengambil daftar Hak Cipta.
        // Jika Anda ingin hanya menampilkan Hak Cipta milik pengguna yang login,
        // ubah menjadi: $hakCiptas = HakCipta::where('user_id', $authenticatedUser->user_id)->with('kekayaanIntelektual')->paginate(10);
        $hakCiptas = HakCipta::with('kekayaanIntelektual')->paginate(10);

        return view('dashboard.hak_cipta.index', compact('hakCiptas'));
    }

    /**
     * Menampilkan formulir untuk membuat entri Hak Cipta baru.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        // Pastikan hanya pengguna terautentikasi yang bisa mengakses
        $token = request()->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }
        if (!$authenticatedUser) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        return view('dashboard.hak_cipta.create');
    }

    /**
     * Menyimpan entri Hak Cipta baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Menggunakan logika autentikasi manual berbasis cookie
        $token = $request->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }
        if (!$authenticatedUser) {
            Log::warning('Unauthorized attempt to store Hak Cipta data.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengunggah data.');
        }

        Log::info('Hak Cipta Store Request Data:', $request->all());

        $validatedData = $request->validate([
            'judul_karya' => 'required|string|max:255',
            'uraian_singkat_ciptaan' => 'required|string',
            'jenis_karya' => 'required|string|in:Karya Tulis,Karya Seni,Komposisi Musik,Karya Audio Visual,Karya Fotografi,Karya Drama & Koreografi,Karya Rekaman,Karya Lainnya',
            'pencipta_nik' => 'required|string|max:20',
            'pencipta_nama' => 'required|string|max:255',
            'pencipta_email' => 'required|email|max:255',
            'pencipta_hp' => 'required|string|max:20',
            'pencipta_alamat' => 'required|string|max:500',
            'pencipta_kecamatan' => 'required|string|max:255',
            'pencipta_kodepos' => 'required|string|max:10',
            'pencipta_jurusan' => 'required|string|max:255',
            'ada_anggota_mahasiswa' => 'required|string|in:Ya,Tidak',
            'anggota_mahasiswa' => 'nullable|array',
            'anggota_mahasiswa.*.nama' => 'required_if:ada_anggota_mahasiswa,Ya|string|max:255',
            'anggota_mahasiswa.*.nim' => 'required_if:ada_anggota_mahasiswa,Ya|string|max:20',
            'anggota_pencipta' => 'nullable|array',
            'anggota_pencipta.*.nik' => 'required|string|max:20',
            'anggota_pencipta.*.nama' => 'required|string|max:255',
            'anggota_pencipta.*.email' => 'required|email|max:255',
            'anggota_pencipta.*.hp' => 'required|string|max:20',
            'anggota_pencipta.*.alamat' => 'required|string|max:500',
            'anggota_pencipta.*.kecamatan' => 'required|string|max:255',
            'anggota_pencipta.*.kodepos' => 'required|string|max:10',
            'scan_ktp_pencipta' => 'required|file|mimes:pdf|max:2048', // Max 2MB
            'kota_pengumuman' => 'required|string|max:255',
            'tanggal_pengumuman' => 'required|date',
            'dokumen_ciptaan' => 'required|file|mimes:pdf,docx|max:10240', // Max 10MB
            'pernyataan_setuju' => 'accepted', // Must be checked
        ]);

        $filePathKtp = null;
        $filePathCiptaan = null;

        // Mengunggah file
        try {
            $filePathKtp = $request->file('scan_ktp_pencipta')->store('hak_cipta_ktp', 'public');
            $filePathCiptaan = $request->file('dokumen_ciptaan')->store('hak_cipta_dokumen', 'public');
        } catch (\Exception $e) {
            Log::error('File upload failed for Hak Cipta: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }

        // --- Buat entri KekayaanIntelektual terlebih dahulu ---
        try {
            $kekayaanIntelektual = KekayaanIntelektual::create([
                'type' => 'hak_cipta',
                'title' => $validatedData['judul_karya'],
                'description' => $validatedData['uraian_singkat_ciptaan'],
                'category' => $validatedData['jenis_karya'],
                'status' => 'Dalam Proses',
                'submission_date' => $validatedData['tanggal_pengumuman'],
                'publication_date' => null,
                'document' => $filePathCiptaan, // Dokumen utama KI bisa jadi dokumen ciptaan
                'user_id' => $authenticatedUser->user_id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create KekayaanIntelektual entry for Hak Cipta: ' . $e->getMessage());
            // Hapus file yang sudah terunggah jika pembuatan KI gagal
            if ($filePathKtp) Storage::disk('public')->delete($filePathKtp);
            if ($filePathCiptaan) Storage::disk('public')->delete($filePathCiptaan);
            return back()->with('error', 'Gagal membuat entri Kekayaan Intelektual untuk Hak Cipta. Silakan coba lagi.');
        }
        // --- Selesai pembuatan KekayaanIntelektual ---

        // Menyiapkan data untuk disimpan ke model HakCipta
        $hakCiptaData = [
            'ki_id' => $kekayaanIntelektual->ki_id,
            'user_id' => $authenticatedUser->user_id,
            'judul_karya' => $validatedData['judul_karya'],
            'uraian_singkat_ciptaan' => $validatedData['uraian_singkat_ciptaan'],
            'jenis_karya' => $validatedData['jenis_karya'],
            'pencipta_nik' => $validatedData['pencipta_nik'],
            'pencipta_nama' => $validatedData['pencipta_nama'],
            'pencipta_email' => $validatedData['pencipta_email'],
            'pencipta_hp' => $validatedData['pencipta_hp'],
            'pencipta_alamat' => $validatedData['pencipta_alamat'],
            'pencipta_kecamatan' => $validatedData['pencipta_kecamatan'],
            'pencipta_kodepos' => $validatedData['pencipta_kodepos'],
            'pencipta_jurusan' => $validatedData['pencipta_jurusan'],
            'anggota_mahasiswa' => $request->input('anggota_mahasiswa'), // Dibiarkan sebagai array, model akan meng-cast
            'anggota_pencipta' => $request->input('anggota_pencipta'), // Dibiarkan sebagai array, model akan meng-cast
            'file_path_ktp' => $filePathKtp,
            'kota_pengumuman' => $validatedData['kota_pengumuman'],
            'tanggal_pengumuman' => $validatedData['tanggal_pengumuman'],
            'file_path_ciptaan' => $filePathCiptaan,
            'pernyataan_setuju' => $validatedData['pernyataan_setuju'],
        ];

        try {
            HakCipta::create($hakCiptaData);
            Log::info('Hak Cipta data stored successfully for user ' . $authenticatedUser->user_id . ' with KI ID: ' . $kekayaanIntelektual->ki_id);
            return redirect()->route('dashboard.hak_cipta.index')->with('success', 'Data Hak Cipta berhasil diunggah!');
        } catch (\Exception $e) {
            Log::error('Failed to store Hak Cipta data: ' . $e->getMessage(), $hakCiptaData);
            // Hapus file dan entri KI jika penyimpanan Hak Cipta gagal
            if ($filePathKtp) Storage::disk('public')->delete($filePathKtp);
            if ($filePathCiptaan) Storage::disk('public')->delete($filePathCiptaan);
            $kekayaanIntelektual->delete(); // Hapus KI yang sudah dibuat
            return back()->with('error', 'Gagal menyimpan data Hak Cipta. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan detail Hak Cipta yang ditentukan di dashboard.
     *
     * @param  int  $id ID dari record Hak Cipta.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        // Menggunakan logika autentikasi manual berbasis cookie
        $token = request()->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }
        if (!$authenticatedUser) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // Eager load relasi yang diperlukan: kekayaanIntelektual
        $hakCipta = HakCipta::with('kekayaanIntelektual')->find($id);

        // Jika Hak Cipta tidak ditemukan, redirect atau tampilkan error
        if (!$hakCipta) {
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Detail Hak Cipta tidak ditemukan.');
        }

        // Mengirim objek HakCipta ke view
        return view('dashboard.hak_cipta.show', compact('hakCipta'));
    }
    /**
     * Menampilkan formulir untuk mengubah status Hak Cipta.
     * Hanya admin yang dapat mengakses halaman ini.
     *
     * @param  int  $id ID dari record Hak Cipta.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function editStatus($id)
    {
        // Menggunakan logika autentikasi manual berbasis cookie
        $token = request()->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }

        // Pastikan pengguna terautentikasi dan memiliki peran admin (role = 1)
        if (!$authenticatedUser || $authenticatedUser->role !== 1) {
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Anda tidak memiliki izin untuk mengubah status Hak Cipta.');
        }

        $hakCipta = HakCipta::with('kekayaanIntelektual')->find($id);

        if (!$hakCipta) {
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Hak Cipta tidak ditemukan.');
        }

        // Opsi status yang bisa dipilih oleh admin
        $statusOptions = [
            'Dalam Proses', 'Dibatalkan', 'Ditolak', 'Dihapus',
            'Didaftar', 'Ditarik kembali', 'Berakhir'
        ];

        return view('dashboard.hak_cipta.edit_status', compact('hakCipta', 'statusOptions'));
    }

    /**
     * Memperbarui status Hak Cipta di database.
     * Hanya admin yang dapat melakukan ini.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id ID dari record Hak Cipta.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        // Menggunakan logika autentikasi manual berbasis cookie
        $token = $request->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }

        // Pastikan pengguna terautentikasi dan memiliki peran admin (role = 1)
        if (!$authenticatedUser || $authenticatedUser->role !== 1) {
            Log::warning('Unauthorized attempt to update Hak Cipta status for ID: ' . $id);
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Anda tidak memiliki izin untuk mengubah status Hak Cipta.');
        }

        $validatedData = $request->validate([
            'status' => 'required|string|in:Dalam Proses,Dibatalkan,Ditolak,Dihapus,Didaftar,Ditarik kembali,Berakhir',
        ]);

        $hakCipta = HakCipta::with('kekayaanIntelektual')->find($id);

        if (!$hakCipta) {
            return back()->with('error', 'Hak Cipta tidak ditemukan.');
        }

        try {
            // Perbarui status di model KekayaanIntelektual yang terkait
            if ($hakCipta->kekayaanIntelektual) {
                $hakCipta->kekayaanIntelektual->status = $validatedData['status'];
                // Jika status diubah menjadi 'Didaftar', set publication_date ke tanggal sekarang
                if ($validatedData['status'] === 'Didaftar' && is_null($hakCipta->kekayaanIntelektual->publication_date)) {
                    $hakCipta->kekayaanIntelektual->publication_date = now();
                }
                $hakCipta->kekayaanIntelektual->save();
            } else {
                Log::error('KekayaanIntelektual record not found for Hak Cipta ID: ' . $id);
                return back()->with('error', 'Gagal memperbarui status: Data Kekayaan Intelektual tidak ditemukan.');
            }

            Log::info('Hak Cipta status updated successfully for ID: ' . $id . ' to ' . $validatedData['status']);
            return redirect()->route('dashboard.hak_cipta.show', $hakCipta->id)->with('success', 'Status Hak Cipta berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Failed to update Hak Cipta status for ID: ' . $id . ' Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui status Hak Cipta. Silakan coba lagi.');
        }
    }
}
