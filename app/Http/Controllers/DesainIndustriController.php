<?php

namespace App\Http\Controllers;

use App\Models\DesainIndustri;
use App\Models\KekayaanIntelektual;
use Illuminate\Http\Request;

class DesainIndustriController extends Controller
{
    public function show($id)
    {
        // Cari berdasarkan ki_id (ID dari KekayaanIntelektual)
        $desain = DesainIndustri::with('kekayaanIntelektual')
            ->where('ki_id', $id)
            ->first();

        if (!$desain) {
            // Fallback: cari berdasarkan ID DesainIndustri
            $desain = DesainIndustri::with('kekayaanIntelektual')->find($id);
        }

        if (!$desain) {
            abort(404, 'Desain Industri tidak ditemukan');
        }

        return view('desain_industri_detail', compact('desain'));
    }
}