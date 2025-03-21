<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KekayaanIntelektual;

class KekayaanIntelektualSeeder extends Seeder
{
    public function run()
    {
        KekayaanIntelektual::insert([
            [
                'type' => 'hak_cipta',
                'title' => 'Inovasi Software A',
                'description' => 'Software untuk otomatisasi data',
                'category' => 'Software',
                'status' => 'approved',
                'submission_date' => '2024-01-01',
                'publication_date' => '2024-02-01',
                'document' => 'software-a.pdf',
                'user_id' => 1,
            ],
            [
                'type' => 'paten',
                'title' => 'Alat Medis XYZ',
                'description' => 'Alat untuk deteksi penyakit otomatis',
                'category' => 'Medis',
                'status' => 'pending',
                'submission_date' => '2024-02-15',
                'publication_date' => null,
                'document' => 'alat-medis.pdf',
                'user_id' => 2,
            ]
        ]);
    }
}
