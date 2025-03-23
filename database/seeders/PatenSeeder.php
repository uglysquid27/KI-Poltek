<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paten;
use App\Models\KekayaanIntelektual;
use Faker\Factory as Faker;

class PatenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all Kekayaan Intelektual entries with type 'paten'
        $kekayaanIntelektuals = KekayaanIntelektual::where('type', 'paten')->get();

        foreach ($kekayaanIntelektuals as $ki) {
            Paten::create([
                'ki_id' => $ki->ki_id,
                'paten_number' => 'PT-' . $faker->unique()->numberBetween(100000, 999999),
                'validity' => $faker->dateTimeBetween('now', '+10 years'),
            ]);
        }
    }
}