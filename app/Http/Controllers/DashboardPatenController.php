<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paten;
use App\Models\KekayaanIntelektual;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DashboardPatenController extends Controller
{
    /**
     * Menampilkan daftar entri Paten di dashboard dengan paginasi.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
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

        // Mengambil daftar Paten.
        // Jika Anda ingin hanya menampilkan Paten milik pengguna yang login,
        // ubah menjadi: $patens = Paten::where('user_id', $authenticatedUser->user_id)->with('kekayaanIntelektual')->paginate(10);
        $patens = Paten::with('kekayaanIntelektual')->paginate(10); // Mengambil 10 item per halaman

        return view('dashboard.paten.index', compact('patens'));
    }

    /**
     * Menampilkan formulir untuk membuat entri Paten baru.
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

        return view('dashboard.paten.create');
    }

    /**
     * Menyimpan entri Paten baru ke database.
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
            Log::warning('Unauthorized attempt to store Paten data.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengunggah data.');
        }

        Log::info('Paten Store Request Data:', $request->all());

        $validatedData = $request->validate([
            'judul_paten' => 'required|string|max:255',
            'abstrak' => 'required|string',
            'jumlah_klaim' => 'required|integer|min:1',
            'ketua_inventor_nama' => 'required|string|max:255',
            'ketua_inventor_alamat' => 'required|string|max:500',
            'ketua_inventor_email' => 'required|email|max:255',
            'ketua_inventor_hp' => 'required|string|max:20',
            'ketua_inventor_jurusan' => 'required|string|max:255',
            'anggota_inventor' => 'nullable|array',
            'anggota_inventor.*.nama' => 'required|string|max:255',
            'anggota_inventor.*.alamat' => 'required|string|max:500',
            'anggota_inventor.*.email' => 'required|email|max:255',
            'anggota_inventor.*.hp' => 'required|string|max:20',
            'jenis_paten' => 'required|string|in:Paten Biasa,Paten Sederhana',
            'file_path_ktp' => 'nullable|file|mimes:pdf|max:2048', // Diubah jadi nullable
            'ada_anggota_mahasiswa' => 'required|string|in:Ya,Tidak',
            'anggota_mahasiswa' => 'nullable|array',
            'anggota_mahasiswa.*.nama' => 'required_if:ada_anggota_mahasiswa,Ya|string|max:255',
            'anggota_mahasiswa.*.nim' => 'required_if:ada_anggota_mahasiswa,Ya|string|max:20',
            'tanggal_upload_draft' => 'required|date',
            'file_path_draft' => 'nullable|file|mimes:pdf,docx|max:10240', // Diubah jadi nullable
            'pernyataan_setuju' => 'accepted', // Pastikan ini true jika dicentang
        ]);

        $filePathKtp = null;
        $filePathDraft = null;

        // Mengunggah file hanya jika ada
        try {
            if ($request->hasFile('file_path_ktp')) {
                $filePathKtp = $request->file('file_path_ktp')->store('paten_ktp', 'public');
            }
            if ($request->hasFile('file_path_draft')) {
                $filePathDraft = $request->file('file_path_draft')->store('paten_dokumen', 'public');
            }
        } catch (\Exception $e) {
            Log::error('File upload failed for Paten: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }

        // --- Buat entri KekayaanIntelektual terlebih dahulu ---
        try {
            $kekayaanIntelektual = KekayaanIntelektual::create([
                'type' => 'paten',
                'title' => $validatedData['judul_paten'],
                'description' => $validatedData['abstrak'],
                'category' => $validatedData['jenis_paten'],
                'status' => 'Dalam Proses',
                'submission_date' => $validatedData['tanggal_upload_draft'],
                'publication_date' => null,
                'document' => $filePathDraft, // Dokumen utama KI bisa jadi dokumen draft
                'user_id' => $authenticatedUser->user_id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create KekayaanIntelektual entry for Paten: ' . $e->getMessage());
            // Hapus file yang sudah terunggah jika pembuatan KI gagal
            if ($filePathKtp) Storage::disk('public')->delete($filePathKtp);
            if ($filePathDraft) Storage::disk('public')->delete($filePathDraft);
            return back()->with('error', 'Gagal membuat entri Kekayaan Intelektual untuk Paten. Silakan coba lagi.');
        }
        // --- Selesai pembuatan KekayaanIntelektual ---

        // Menyiapkan data untuk disimpan ke model Paten
        $patenData = [
            'ki_id' => $kekayaanIntelektual->ki_id,
            'user_id' => $authenticatedUser->user_id,
            'judul_paten' => $validatedData['judul_paten'],
            'abstrak' => $validatedData['abstrak'],
            'jumlah_klaim' => $validatedData['jumlah_klaim'],
            'ketua_inventor_nama' => $validatedData['ketua_inventor_nama'],
            'ketua_inventor_alamat' => $validatedData['ketua_inventor_alamat'],
            'ketua_inventor_email' => $validatedData['ketua_inventor_email'],
            'ketua_inventor_hp' => $validatedData['ketua_inventor_hp'],
            'ketua_inventor_jurusan' => $validatedData['ketua_inventor_jurusan'],
            'anggota_inventor' => isset($validatedData['anggota_inventor']) ? json_encode($validatedData['anggota_inventor']) : null,
            'jenis_paten' => $validatedData['jenis_paten'],
            'file_path_ktp' => $filePathKtp, // Bisa null
            'ada_anggota_mahasiswa' => $validatedData['ada_anggota_mahasiswa'],
            'anggota_mahasiswa' => ($validatedData['ada_anggota_mahasiswa'] === 'Ya' && isset($validatedData['anggota_mahasiswa']))
                                   ? json_encode($validatedData['anggota_mahasiswa'])
                                   : null,
            'tanggal_upload_draft' => $validatedData['tanggal_upload_draft'],
            'file_path_draft' => $filePathDraft, // Bisa null
        ];

        try {
            Paten::create($patenData);
            Log::info('Paten data stored successfully for user ' . $authenticatedUser->user_id . ' with KI ID: ' . $kekayaanIntelektual->ki_id);
            return redirect()->route('dashboard.paten.index')->with('success', 'Data Paten berhasil diunggah!');
        } catch (\Exception $e) {
            Log::error('Failed to store Paten data: ' . $e->getMessage(), $patenData);
            // Hapus file dan entri KI jika penyimpanan Paten gagal
            if ($filePathKtp) Storage::disk('public')->delete($filePathKtp);
            if ($filePathDraft) Storage::disk('public')->delete($filePathDraft);
            $kekayaanIntelektual->delete(); // Hapus KI yang sudah dibuat
            return back()->with('error', 'Gagal menyimpan data Paten. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan detail Paten yang ditentukan di dashboard.
     *
     * @param  int  $id ID dari record Paten.
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
        $paten = Paten::with('kekayaanIntelektual')->find($id);

        // Jika Paten tidak ditemukan, redirect atau tampilkan error
        if (!$paten) {
            return redirect()->route('dashboard.paten.index')->with('error', 'Detail Paten tidak ditemukan.');
        }

        // Mengirim objek Paten ke view
        return view('dashboard.paten.show', compact('paten'));
    }

    /**
     * Menampilkan formulir untuk mengubah status Paten.
     * Hanya admin yang dapat mengakses halaman ini.
     *
     * @param  int  $id ID dari record Paten.
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
            return redirect()->route('dashboard.paten.index')->with('error', 'Anda tidak memiliki izin untuk mengubah status Paten.');
        }

        $paten = Paten::with('kekayaanIntelektual')->find($id);

        if (!$paten) {
            return redirect()->route('dashboard.paten.index')->with('error', 'Paten tidak ditemukan.');
        }

        $statusOptions = [
            'Dalam Proses', 'Dibatalkan', 'Ditolak', 'Dihapus',
            'Didaftar', 'Ditarik kembali', 'Berakhir'
        ];

        return view('dashboard.paten.edit_status', compact('paten', 'statusOptions'));
    }

    /**
     * Memperbarui status Paten di database.
     * Hanya admin yang dapat melakukan ini.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id ID dari record Paten.
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
            Log::warning('Unauthorized attempt to update Paten status for ID: ' . $id);
            return redirect()->route('dashboard.paten.index')->with('error', 'Anda tidak memiliki izin untuk mengubah status Paten.');
        }

        $validatedData = $request->validate([
            'status' => 'required|string|in:Dalam Proses,Dibatalkan,Ditolak,Dihapus,Didaftar,Ditarik kembali,Berakhir',
        ]);

        $paten = Paten::with('kekayaanIntelektual')->find($id);

        if (!$paten) {
            return back()->with('error', 'Paten tidak ditemukan.');
        }

        try {
            // Perbarui status di model KekayaanIntelektual yang terkait
            if ($paten->kekayaanIntelektual) {
                $paten->kekayaanIntelektual->status = $validatedData['status'];
                // Jika status diubah menjadi 'Didaftar', set publication_date ke tanggal sekarang
                if ($validatedData['status'] === 'Didaftar' && is_null($paten->kekayaanIntelektual->publication_date)) {
                    $paten->kekayaanIntelektual->publication_date = now();
                }
                $paten->kekayaanIntelektual->save();
            } else {
                Log::error('KekayaanIntelektual record not found for Paten ID: ' . $id);
                return back()->with('error', 'Gagal memperbarui status: Data Kekayaan Intelektual tidak ditemukan.');
            }

            Log::info('Paten status updated successfully for ID: ' . $id . ' to ' . $validatedData['status']);
            return redirect()->route('dashboard.paten.show', $paten->id)->with('success', 'Status Paten berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Failed to update Paten status for ID: ' . $id . ' Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui status Paten. Silakan coba lagi.');
        }
    }
}
