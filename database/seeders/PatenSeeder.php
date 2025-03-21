<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paten;
use App\Models\KekayaanIntelektual;

class PatenSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID dari Kekayaan Intelektual yang memiliki type 'paten'
        $kekayaanIntelektual = KekayaanIntelektual::where('type', 'paten')->first();

        if ($kekayaanIntelektual) {
            Paten::create([
                'ki_id' => $kekayaanIntelektual->ki_id,
                'paten_number' => 'PT-2024-002',
                'validity' => '2034-02-15',
            ]);
        }
    }
}
