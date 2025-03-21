<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;

class KekayaanIntelektualController extends Controller
{
    public function searchPage()
    {
        return view('search');
    }

    public function searchResults(Request $request)
    {
        $keyword = $request->input('query');

        $results = KekayaanIntelektual::where('title', 'LIKE', "%$keyword%")
            ->orWhereHas('hakCipta', function ($query) use ($keyword) {
                $query->where('hak_cipta_number', 'LIKE', "%$keyword%");
            })
            ->orWhereHas('paten', function ($query) use ($keyword) {
                $query->where('paten_number', 'LIKE', "%$keyword%");
            })
            ->get();

        return view('search_results', compact('results'));
    }
}
