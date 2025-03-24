<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $filter = $request->input('filter'); // Get the filter value from the dropdown
        $sort = $request->input('sort'); // Get the sort value (date or A-Z)
    
        // Base query
        $results = KekayaanIntelektual::query();
    
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
        if ($sort === 'date') {
            $results->orderBy('created_at', 'desc'); // Sort by date (newest first)
        } elseif ($sort === 'az') {
            $results->orderBy('title', 'asc'); // Sort alphabetically (A-Z)
        }
    
        // Paginate the results
        $results = $results->paginate(10);
    
        // Return the view with results
        return view('search_result', compact('query', 'filter', 'sort', 'results'));
    }
}