<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $filter = $request->input('filter');
        $sort = $request->input('sort');

        // Base query with relationships
        $results = KekayaanIntelektual::with(['hakCipta', 'paten']);

        // Apply filter based on the "type" field
        if ($filter === 'hak_cipta') {
            $results->where('type', 'hak_cipta');
        } elseif ($filter === 'paten') {
            $results->where('type', 'paten');
        }

        // Apply search query
        if (!empty($query)) {
            $results->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('category', 'like', "%{$query}%");
            });
        }

        // Apply sorting
        if ($sort === 'date_asc') {
            $results->orderBy('created_at', 'asc'); // Sort by date (oldest first)
        } elseif ($sort === 'date_desc') {
            $results->orderBy('created_at', 'desc'); // Sort by date (newest first)
        } elseif ($sort === 'az') {
            $results->orderBy('title', 'asc'); // Sort alphabetically (A-Z)
        } elseif ($sort === 'za') {
            $results->orderBy('title', 'desc'); // Sort alphabetically (Z-A)
        }


        // Paginate the results
        $results = $results->paginate(10);

        return view('search_result', compact('query', 'filter', 'sort', 'results'));
    }
}
