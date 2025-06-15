<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KekayaanIntelektual;
use App\Models\HakCipta; // Still needed if you search specific 'hak_cipta_number'
use App\Models\Paten;    // Still needed if you search specific 'paten_number'

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

        // Apply search query (for main search bar)
        if (!empty($query)) {
            $results->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%")
                  // You might also want to search description here for the main search
                  ->orWhere('description', 'like', "%{$query}%");
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

    /**
     * Advanced search method for Kekayaan Intelektual.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function advancedSearch(Request $request)
    {
        $title = $request->input('title');
        $category = $request->input('category');
        $patentNumber = $request->input('patent_number'); // Renamed for consistency
        $type = $request->input('type_filter'); // New: for type in advanced search
        $status = $request->input('status'); // New: for status
        $submissionDateFrom = $request->input('submission_date_from'); // New: submission date range
        $submissionDateTo = $request->input('submission_date_to');
        $publicationDateFrom = $request->input('publication_date_from'); // New: publication date range
        $publicationDateTo = $request->input('publication_date_to');

        // Base query with eager loading for relationships
        $results = KekayaanIntelektual::with(['hakCipta', 'paten']);

        // Apply filters for title, description, category
        if (!empty($title)) {
            $results->where('title', 'like', "%{$title}%");
        }

        if (!empty($category)) {
            $results->where('category', 'like', "%{$category}%");
        }

        // Filter by Type (from kekayaan_intelektuals table)
        if (!empty($type) && ($type === 'hak_cipta' || $type === 'paten')) {
            $results->where('type', $type);
        }

        // Filter by Status (from kekayaan_intelektuals table)
        if (!empty($status)) {
            $results->where('status', $status);
        }

        // Filter by Submission Date Range
        if (!empty($submissionDateFrom)) {
            $results->where('submission_date', '>=', $submissionDateFrom);
        }
        if (!empty($submissionDateTo)) {
            $results->where('submission_date', '<=', $submissionDateTo);
        }

        // Filter by Publication Date Range
        if (!empty($publicationDateFrom)) {
            $results->where('publication_date', '>=', $publicationDateFrom);
        }
        if (!empty($publicationDateTo)) {
            $results->where('publication_date', '<=', $publicationDateTo);
        }

        // For specific Hak Cipta/Paten numbers (from related tables)
        if (!empty($patentNumber)) {
            $results->where(function ($q) use ($patentNumber) {
                $q->orWhereHas('hakCipta', function ($query) use ($patentNumber) {
                    $query->where('hak_cipta_number', 'like', "%{$patentNumber}%");
                })
                ->orWhereHas('paten', function ($query) use ($patentNumber) {
                    $query->where('paten_number', 'like', "%{$patentNumber}%");
                });
            });
        }

        // Default sorting for advanced search
        $results->orderBy('created_at', 'desc');

        // Paginate the results, appending all request parameters to pagination links
        $results = $results->paginate(10)->appends($request->except('page'));

        // Return to the search results view
        return view('search_result', compact('results', 'title', 'category', 'patentNumber', 'type', 'status', 'submissionDateFrom', 'submissionDateTo', 'publicationDateFrom', 'publicationDateTo'));
    }
}