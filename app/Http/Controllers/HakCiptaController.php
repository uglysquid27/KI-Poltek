<?php
namespace App\Http\Controllers;

use App\Models\HakCipta;
use Illuminate\Http\Request;

class HakCiptaController extends Controller
{
    public function show($ki_id)
    {
        // Fetch the HakCipta record using ki_id
        $hakCipta = HakCipta::with('kekayaanIntelektual', 'pemegangs', 'penciptas', 'konsultans')
            ->where('ki_id', $ki_id)
            ->firstOrFail();

        return view('hak_cipta_detail', compact('hakCipta'));
    }

   
}