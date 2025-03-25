<?php
namespace App\Http\Controllers;

use App\Models\Paten;
use Illuminate\Http\Request;

class PatenController extends Controller
{
    public function show($ki_id)
    {
        // Fetch the Paten record with related Kekayaan Intelektual data
        $paten = Paten::with('kekayaanIntelektual', 'pemegangs', 'inventors', 'konsultans')
            ->where('ki_id', $ki_id)
            ->firstOrFail();

        return view('paten_detail', compact('paten'));
    }
}