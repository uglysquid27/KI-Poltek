<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KekayaanIntelektual;
use App\Models\HakCipta;
use App\Models\Paten;

class KekayaanIntelektualSeeder extends Seeder
{
    public function run()
    {
        $ki1 = KekayaanIntelektual::create([
            'type' => 'hak_cipta',
            'title' => 'Sistem AI untuk Prediksi Cuaca',
            'description' => 'Hak cipta untuk AI yang memprediksi cuaca.',
            'category' => 'Teknologi',
            'status' => 'approved',
            'submission_date' => now(),
            'user_id' => 1
        ]);

        HakCipta::create([
            'ki_id' => $ki1->ki_id,
            'hak_cipta_number' => 'HC123456',
            'type' => 'Software'
        ]);

        $ki2 = KekayaanIntelektual::create([
            'type' => 'paten',
            'title' => 'Metode Baru dalam Pengolahan Air',
            'description' => 'Paten tentang pengolahan air dengan teknologi baru.',
            'category' => 'Lingkungan',
            'status' => 'pending',
            'submission_date' => now(),
            'user_id' => 2
        ]);

        Paten::create([
            'ki_id' => $ki2->ki_id,
            'paten_number' => 'P123456',
            'validity' => now()->addYears(10)
        ]);
    }
}

