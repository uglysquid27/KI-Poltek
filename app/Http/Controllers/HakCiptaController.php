<?php

namespace App\Http\Controllers;

use App\Models\HakCipta; // Pastikan Anda memiliki model HakCipta yang benar
use App\Models\KekayaanIntelektual; // Import model KekayaanIntelektual
use App\Models\User; // Import model User untuk mendapatkan user_id
use Illuminate\Support\Facades\Log; // Untuk logging
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk link file

class HakCiptaController extends Controller
{
    /**
     * Menampilkan detail Hak Cipta yang ditentukan.
     *
     * @param  int  $id ID dari record HakCipta (primary key dari tabel hak_ciptas).
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        // Eager load relasi yang diperlukan: kekayaanIntelektual, pemegangs, penciptas, konsultans
        // Ini penting agar Anda bisa mengakses data dari tabel terkait
        $hakCipta = HakCipta::with([
            'kekayaanIntelektual',
            'pemegangs',
            'penciptas',
            'konsultans'
        ])->find($id);

        // Jika Hak Cipta tidak ditemukan, redirect atau tampilkan error
        if (!$hakCipta) {
            return redirect()->route('search')->with('error', 'Detail Hak Cipta tidak ditemukan.');
        }

        // Mengirim objek HakCipta ke view
        return view('hak_cipta_detail', compact('hakCipta'));
    }

   

}
