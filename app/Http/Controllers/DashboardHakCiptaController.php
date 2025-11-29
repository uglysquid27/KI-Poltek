<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;
use App\Models\HakCipta;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardHakCiptaController extends Controller
{
   public function index()
{
    $token = request()->cookie('auth_token');
    $authenticatedUser = null;
    if ($token) {
        $authenticatedUser = User::where('remember_token', $token)->first();
    }
    if (!$authenticatedUser) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }

    $hakCiptas = HakCipta::with('kekayaanIntelektual')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
    return view('dashboard.hak_cipta.index', compact('hakCiptas'));
}

    public function create()
    {
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

    public function store(Request $request)
    {
        $token = $request->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }
        if (!$authenticatedUser) {
            Log::warning('Unauthorized attempt to store Hak Cipta data.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengunggah data.');
        }

        // Use Validator instead of validate to get more control
        $validator = Validator::make($request->all(), [
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
            'scan_ktp_pencipta' => 'required|file|mimes:pdf|max:2048',
            'kota_pengumuman' => 'required|string|max:255',
            'tanggal_pengumuman' => 'required|date',
            'dokumen_ciptaan' => 'required|file|mimes:pdf,docx|max:10240',
            'pernyataan_setuju' => 'accepted',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        // Check for duplicate - same title and creator
        $existingHakCipta = HakCipta::where('judul_karya', $validatedData['judul_karya'])
            ->where('pencipta_nama', $validatedData['pencipta_nama'])
            ->first();

        if ($existingHakCipta) {
            return back()
                ->withErrors(['judul_karya' => 'Hak Cipta dengan judul "'.$validatedData['judul_karya'].'" dan pencipta "'.$validatedData['pencipta_nama'].'" sudah terdaftar.'])
                ->withInput();
        }

        // Convert checkbox to boolean
        $validatedData['pernyataan_setuju'] = $request->has('pernyataan_setuju') ? 1 : 0;

        $filePathKtp = null;
        $filePathCiptaan = null;

        try {
            $filePathKtp = $request->file('scan_ktp_pencipta')->store('hak_cipta_ktp', 'public');
            $filePathCiptaan = $request->file('dokumen_ciptaan')->store('hak_cipta_dokumen', 'public');
        } catch (\Exception $e) {
            Log::error('File upload failed for Hak Cipta: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }

        try {
            $kekayaanIntelektual = KekayaanIntelektual::create([
                'type' => 'hak_cipta',
                'title' => $validatedData['judul_karya'],
                'description' => $validatedData['uraian_singkat_ciptaan'],
                'category' => $validatedData['jenis_karya'],
                'status' => 'Dalam Proses',
                'submission_date' => $validatedData['tanggal_pengumuman'],
                'publication_date' => null,
                'document' => $filePathCiptaan,
                'user_id' => $authenticatedUser->user_id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create KekayaanIntelektual entry: ' . $e->getMessage());
            if ($filePathKtp) Storage::disk('public')->delete($filePathKtp);
            if ($filePathCiptaan) Storage::disk('public')->delete($filePathCiptaan);
            return back()->with('error', 'Gagal membuat entri Kekayaan Intelektual.');
        }

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
            'anggota_mahasiswa' => $request->input('anggota_mahasiswa'),
            'anggota_pencipta' => $request->input('anggota_pencipta'),
            'file_path_ktp' => $filePathKtp,
            'kota_pengumuman' => $validatedData['kota_pengumuman'],
            'tanggal_pengumuman' => $validatedData['tanggal_pengumuman'],
            'file_path_ciptaan' => $filePathCiptaan,
            'pernyataan_setuju' => $validatedData['pernyataan_setuju'],
        ];

        try {
            HakCipta::create($hakCiptaData);
            Log::info('Hak Cipta stored successfully for user: ' . $authenticatedUser->user_id);
            return redirect()->route('dashboard.hak_cipta.index')->with('success', 'Data berhasil diunggah!');
        } catch (\Exception $e) {
            Log::error('Failed to store Hak Cipta: ' . $e->getMessage());
            if ($filePathKtp) Storage::disk('public')->delete($filePathKtp);
            if ($filePathCiptaan) Storage::disk('public')->delete($filePathCiptaan);
            $kekayaanIntelektual->delete();
            return back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }

    public function show($id)
    {
        $token = request()->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }
        if (!$authenticatedUser) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $hakCipta = HakCipta::with('kekayaanIntelektual')->find($id);

        if (!$hakCipta) {
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('dashboard.hak_cipta.show', compact('hakCipta'));
    }

    public function editStatus($id)
    {
        $token = request()->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }

        if (!$authenticatedUser || $authenticatedUser->role !== 1) {
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Akses ditolak.');
        }

        $hakCipta = HakCipta::with('kekayaanIntelektual')->find($id);

        if (!$hakCipta) {
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Data tidak ditemukan.');
        }

        $statusOptions = [
            'Dalam Proses', 'Dibatalkan', 'Ditolak', 'Dihapus',
            'Ditarik kembali', 'Berakhir', 'Diterima'
        ];

        return view('dashboard.hak_cipta.edit_status', compact('hakCipta', 'statusOptions'));
    }

    public function updateStatus(Request $request, $id)
    {
        $token = $request->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }

        if (!$authenticatedUser || $authenticatedUser->role !== 1) {
            Log::warning('Unauthorized status update attempt for Hak Cipta ID: ' . $id);
            return redirect()->route('dashboard.hak_cipta.index')->with('error', 'Akses ditolak.');
        }

        $validatedData = $request->validate([
            'status' => 'required|string|in:Dalam Proses,Dibatalkan,Ditolak,Dihapus,Didaftar,Ditarik kembali,Berakhir,Diterima',
        ]);

        $hakCipta = HakCipta::with('kekayaanIntelektual')->find($id);

        if (!$hakCipta) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        try {
            if ($hakCipta->kekayaanIntelektual) {
                $hakCipta->kekayaanIntelektual->status = $validatedData['status'];
                if ($validatedData['status'] === 'Didaftar' && is_null($hakCipta->kekayaanIntelektual->publication_date)) {
                    $hakCipta->kekayaanIntelektual->publication_date = now();
                }
                $hakCipta->kekayaanIntelektual->save();
            } else {
                Log::error('Missing KekayaanIntelektual for Hak Cipta ID: ' . $id);
                return back()->with('error', 'Data terkait tidak ditemukan.');
            }

            Log::info('Status updated for Hak Cipta ID: ' . $id);
            return redirect()->route('dashboard.hak_cipta.show', $hakCipta->id)->with('success', 'Status berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Status update failed for Hak Cipta ID: ' . $id . ' Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui status. Silakan coba lagi.');
        }
    }
}