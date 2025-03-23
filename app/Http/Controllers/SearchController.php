<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search query with pagination (10 results per page)
        $results = KekayaanIntelektual::where('title', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhereHas('hakCipta', function ($q) use ($query) {
                $q->where('hak_cipta_number', 'like', "%{$query}%");
            })
            ->orWhereHas('paten', function ($q) use ($query) {
                $q->where('paten_number', 'like', "%{$query}%");
            })
            ->paginate(10); // Pagination applied

        return view('search_result', compact('query', 'results'));
    }
    
    public function advancedSearch(Request $request)
    {
        // Implementasikan logika pencarian lanjutan di sini
        return view('search.results'); // Gantilah dengan view hasil pencarian yang sesuai
    }
}
