<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Mencari di tabel Kekayaan Intelektual berdasarkan judul, kategori, atau nomor hak cipta/paten
        $results = KekayaanIntelektual::where('title', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhereHas('hakCipta', function ($q) use ($query) {
                $q->where('hak_cipta_number', 'like', "%{$query}%");
            })
            ->orWhereHas('paten', function ($q) use ($query) {
                $q->where('paten_number', 'like', "%{$query}%");
            })
            ->get();

        // Redirect ke halaman 'search_result' dengan data hasil pencarian
        return view('search_result', compact('query', 'results'));
    }
}
