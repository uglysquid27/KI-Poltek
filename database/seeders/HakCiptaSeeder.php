<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HakCipta;
use App\Models\KekayaanIntelektual;

class HakCiptaSeeder extends Seeder
{
    public function run()
    {
        // Ambil ID dari Kekayaan Intelektual yang memiliki type 'hak_cipta'
        $kekayaanIntelektual = KekayaanIntelektual::where('type', 'hak_cipta')->first();

        if ($kekayaanIntelektual) {
            HakCipta::create([
                'ki_id' => $kekayaanIntelektual->ki_id,
                'hak_cipta_number' => 'HC-2024-001',
                'type' => 'Software',
            ]);
        }
    }
}
