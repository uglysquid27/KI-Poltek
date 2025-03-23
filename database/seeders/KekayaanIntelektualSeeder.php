<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KekayaanIntelektual;
use App\Models\HakCipta;
use App\Models\Paten;
use Faker\Factory as Faker;

class KekayaanIntelektualSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {
            // Create a random type
            $type = $faker->randomElement(['hak_cipta', 'paten']);

            // Create a Kekayaan Intelektual record
            $ki = KekayaanIntelektual::create([
                'type' => $type,
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph,
                'category' => $faker->randomElement(['Teknologi', 'Lingkungan', 'Pendidikan', 'Kesehatan']),
                'status' => $faker->randomElement([
                    'Dalam Proses', 
                    'Dibatalkan', 
                    'Ditolak', 
                    'Dihapus', 
                    'Didaftar', 
                    'Ditarik kembali', 
                    'Berakhir'
                ]),
                'submission_date' => $faker->date(),
                'publication_date' => $faker->optional()->date(),
                'document' => $faker->optional()->word . '.pdf',
                'user_id' => $faker->numberBetween(1, 10),
            ]);

            // Create related HakCipta or Paten record
            if ($type === 'hak_cipta') {
                HakCipta::create([
                    'ki_id' => $ki->ki_id,
                    'hak_cipta_number' => 'HC' . $faker->unique()->numberBetween(100000, 999999),
                    'type' => $faker->randomElement(['Software', 'Literature', 'Art']),
                ]);
            } else {
                Paten::create([
                    'ki_id' => $ki->ki_id,
                    'paten_number' => 'P' . $faker->unique()->numberBetween(100000, 999999),
                    'validity' => $faker->dateTimeBetween('now', '+10 years'),
                ]);
            }
        }
    }
}