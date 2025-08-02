<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;
use App\Models\DesainIndustri;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DashboardDesainIndustriController extends Controller
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

        $desainIndustris = DesainIndustri::with('kekayaanIntelektual')->paginate(10);
        return view('dashboard.desain_industri.index', compact('desainIndustris'));
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

        return view('dashboard.desain_industri.create');
    }

    public function store(Request $request)
    {
        $token = $request->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }
        if (!$authenticatedUser) {
            Log::warning('Unauthorized attempt to store Desain Industri data.');
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengunggah data.');
        }

        $validatedData = $request->validate([
            'judul_desain' => 'required|string|max:255',
            'kegunaan' => 'required|string',
            'klaim_desain' => 'required|array',
            'klaim_desain.*' => 'required|string',
            'uraian_klaim' => 'required|string',
            'pemohon_nama' => 'required|string|max:255',
            'pemohon_jenis' => 'required|string|in:Perorangan,Badan Hukum',
            'pemohon_kewarganegaraan' => 'required|string|max:255',
            'pemohon_badan_hukum' => 'nullable|string|max:255',
            'pemohon_alamat' => 'required|string|max:500',
            'pemohon_rt_rw' => 'required|string|max:20',
            'pemohon_kelurahan' => 'required|string|max:255',
            'pemohon_kecamatan' => 'required|string|max:255',
            'pemohon_kota_kabupaten' => 'required|string|max:255',
            'pemohon_kodepos' => 'required|string|max:10',
            'pemohon_provinsi' => 'required|string|max:255',
            'pendesain_nama' => 'required|string|max:255',
            'pendesain_kewarganegaraan' => 'required|string|max:255',
            'pendesain_alamat' => 'required|string|max:500',
            'pendesain_rt_rw' => 'required|string|max:20',
            'pendesain_kelurahan' => 'required|string|max:255',
            'pendesain_kecamatan' => 'required|string|max:255',
            'pendesain_kota_kabupaten' => 'required|string|max:255',
            'pendesain_kodepos' => 'required|string|max:10',
            'pendesain_provinsi' => 'required|string|max:255',
            'anggota_pendesain' => 'nullable|array',
            'anggota_pendesain.*.nama' => 'required|string|max:255',
            'anggota_pendesain.*.kewarganegaraan' => 'required|string|max:255',
            'anggota_pendesain.*.alamat' => 'required|string|max:500',
            'file_path_gambar_desain' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'keterangan_gambar' => 'nullable|array',
            'keterangan_gambar.*' => 'string|max:255',
            'file_path_surat_pernyataan_kepemilikan' => 'required|file|mimes:pdf|max:2048',
            'file_path_surat_pengalihan_hak' => 'nullable|file|mimes:pdf|max:2048',
            'file_path_ktp_pendesain' => 'required|file|mimes:pdf|max:2048',
            'file_path_akta_badan_hukum' => 'nullable|file|mimes:pdf|max:2048',
            'pernyataan_kebaruan' => 'accepted',
            'pernyataan_tidak_sengketa' => 'accepted',
            'pernyataan_pengalihan_hak' => 'nullable|accepted',
        ]);

        // Convert checkboxes to boolean
        $validatedData['pernyataan_kebaruan'] = $request->has('pernyataan_kebaruan') ? 1 : 0;
        $validatedData['pernyataan_tidak_sengketa'] = $request->has('pernyataan_tidak_sengketa') ? 1 : 0;
        $validatedData['pernyataan_pengalihan_hak'] = $request->has('pernyataan_pengalihan_hak') ? 1 : 0;

        $filePaths = [];
        try {
            $filePaths['gambar_desain'] = $request->file('file_path_gambar_desain')->store('desain_industri_gambar', 'public');
            $filePaths['surat_pernyataan_kepemilikan'] = $request->file('file_path_surat_pernyataan_kepemilikan')->store('desain_industri_surat', 'public');
            $filePaths['ktp_pendesain'] = $request->file('file_path_ktp_pendesain')->store('desain_industri_ktp', 'public');
            
            if ($request->hasFile('file_path_surat_pengalihan_hak')) {
                $filePaths['surat_pengalihan_hak'] = $request->file('file_path_surat_pengalihan_hak')->store('desain_industri_surat', 'public');
            }
            
            if ($request->hasFile('file_path_akta_badan_hukum')) {
                $filePaths['akta_badan_hukum'] = $request->file('file_path_akta_badan_hukum')->store('desain_industri_akta', 'public');
            }
        } catch (\Exception $e) {
            Log::error('File upload failed for Desain Industri: ' . $e->getMessage());
            // Clean up any uploaded files
            foreach ($filePaths as $path) {
                Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'Gagal mengunggah file. Silakan coba lagi.');
        }

        try {
            $kekayaanIntelektual = KekayaanIntelektual::create([
                'type' => 'desain_industri',
                'title' => $validatedData['judul_desain'],
                'description' => $validatedData['kegunaan'],
                'category' => 'Desain Industri',
                'status' => 'Dalam Proses',
                'submission_date' => now(),
                'publication_date' => null,
                'document' => $filePaths['gambar_desain'],
                'user_id' => $authenticatedUser->user_id,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create KekayaanIntelektual entry: ' . $e->getMessage());
            // Clean up files
            foreach ($filePaths as $path) {
                Storage::disk('public')->delete($path);
            }
            return back()->with('error', 'Gagal membuat entri Kekayaan Intelektual.');
        }

        $desainIndustriData = [
            'ki_id' => $kekayaanIntelektual->ki_id,
            'user_id' => $authenticatedUser->user_id,
            'judul_desain' => $validatedData['judul_desain'],
            'kegunaan' => $validatedData['kegunaan'],
            'klaim_desain' => $validatedData['klaim_desain'],
            'uraian_klaim' => $validatedData['uraian_klaim'],
            'pemohon_nama' => $validatedData['pemohon_nama'],
            'pemohon_jenis' => $validatedData['pemohon_jenis'],
            'pemohon_kewarganegaraan' => $validatedData['pemohon_kewarganegaraan'],
            'pemohon_badan_hukum' => $validatedData['pemohon_badan_hukum'] ?? null,
            'pemohon_alamat' => $validatedData['pemohon_alamat'],
            'pemohon_rt_rw' => $validatedData['pemohon_rt_rw'],
            'pemohon_kelurahan' => $validatedData['pemohon_kelurahan'],
            'pemohon_kecamatan' => $validatedData['pemohon_kecamatan'],
            'pemohon_kota_kabupaten' => $validatedData['pemohon_kota_kabupaten'],
            'pemohon_kodepos' => $validatedData['pemohon_kodepos'],
            'pemohon_provinsi' => $validatedData['pemohon_provinsi'],
            'pendesain_nama' => $validatedData['pendesain_nama'],
            'pendesain_kewarganegaraan' => $validatedData['pendesain_kewarganegaraan'],
            'pendesain_alamat' => $validatedData['pendesain_alamat'],
            'pendesain_rt_rw' => $validatedData['pendesain_rt_rw'],
            'pendesain_kelurahan' => $validatedData['pendesain_kelurahan'],
            'pendesain_kecamatan' => $validatedData['pendesain_kecamatan'],
            'pendesain_kota_kabupaten' => $validatedData['pendesain_kota_kabupaten'],
            'pendesain_kodepos' => $validatedData['pendesain_kodepos'],
            'pendesain_provinsi' => $validatedData['pendesain_provinsi'],
            'anggota_pendesain' => $request->input('anggota_pendesain'),
            'file_path_gambar_desain' => $filePaths['gambar_desain'],
            'keterangan_gambar' => $request->input('keterangan_gambar'),
            'file_path_surat_pernyataan_kepemilikan' => $filePaths['surat_pernyataan_kepemilikan'],
            'file_path_surat_pengalihan_hak' => $filePaths['surat_pengalihan_hak'] ?? null,
            'file_path_ktp_pendesain' => $filePaths['ktp_pendesain'],
            'file_path_akta_badan_hukum' => $filePaths['akta_badan_hukum'] ?? null,
            'pernyataan_kebaruan' => $validatedData['pernyataan_kebaruan'],
            'pernyataan_tidak_sengketa' => $validatedData['pernyataan_tidak_sengketa'],
            'pernyataan_pengalihan_hak' => $validatedData['pernyataan_pengalihan_hak'],
        ];

        try {
            DesainIndustri::create($desainIndustriData);
            Log::info('Desain Industri stored successfully for user: ' . $authenticatedUser->user_id);
            return redirect()->route('dashboard.desain_industri.index')->with('success', 'Data berhasil diunggah!');
        } catch (\Exception $e) {
            Log::error('Failed to store Desain Industri: ' . $e->getMessage());
            // Clean up files
            foreach ($filePaths as $path) {
                Storage::disk('public')->delete($path);
            }
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

        $desainIndustri = DesainIndustri::with('kekayaanIntelektual')->find($id);

        if (!$desainIndustri) {
            return redirect()->route('dashboard.desain_industri.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('dashboard.desain_industri.show', compact('desainIndustri'));
    }

    public function editStatus($id)
    {
        $token = request()->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }

        if (!$authenticatedUser || $authenticatedUser->role !== 1) {
            return redirect()->route('dashboard.desain_industri.index')->with('error', 'Akses ditolak.');
        }

        $desainIndustri = DesainIndustri::with('kekayaanIntelektual')->find($id);

        if (!$desainIndustri) {
            return redirect()->route('dashboard.desain_industri.index')->with('error', 'Data tidak ditemukan.');
        }

        $statusOptions = [
            'Dalam Proses', 'Dibatalkan', 'Ditolak', 'Dihapus',
            'Didaftar', 'Ditarik kembali', 'Berakhir'
        ];

        return view('dashboard.desain_industri.edit_status', compact('desainIndustri', 'statusOptions'));
    }

    public function updateStatus(Request $request, $id)
    {
        $token = $request->cookie('auth_token');
        $authenticatedUser = null;
        if ($token) {
            $authenticatedUser = User::where('remember_token', $token)->first();
        }

        if (!$authenticatedUser || $authenticatedUser->role !== 1) {
            Log::warning('Unauthorized status update attempt for Desain Industri ID: ' . $id);
            return redirect()->route('dashboard.desain_industri.index')->with('error', 'Akses ditolak.');
        }

        $validatedData = $request->validate([
            'status' => 'required|string|in:Dalam Proses,Dibatalkan,Ditolak,Dihapus,Didaftar,Ditarik kembali,Berakhir',
        ]);

        $desainIndustri = DesainIndustri::with('kekayaanIntelektual')->find($id);

        if (!$desainIndustri) {
            return back()->with('error', 'Data tidak ditemukan.');
        }

        try {
            if ($desainIndustri->kekayaanIntelektual) {
                $desainIndustri->kekayaanIntelektual->status = $validatedData['status'];
                if ($validatedData['status'] === 'Didaftar' && is_null($desainIndustri->kekayaanIntelektual->publication_date)) {
                    $desainIndustri->kekayaanIntelektual->publication_date = now();
                }
                $desainIndustri->kekayaanIntelektual->save();
            } else {
                Log::error('Missing KekayaanIntelektual for Desain Industri ID: ' . $id);
                return back()->with('error', 'Data terkait tidak ditemukan.');
            }

            Log::info('Status updated for Desain Industri ID: ' . $id);
            return redirect()->route('dashboard.desain_industri.show', $desainIndustri->id)->with('success', 'Status berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Status update failed for Desain Industri ID: ' . $id . ' Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui status. Silakan coba lagi.');
        }
    }
}