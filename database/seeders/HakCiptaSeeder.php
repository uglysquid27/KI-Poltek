<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HakCipta;
use App\Models\KekayaanIntelektual;
use Faker\Factory as Faker;

class HakCiptaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all Kekayaan Intelektual entries with type 'hak_cipta'
        $kekayaanIntelektuals = KekayaanIntelektual::where('type', 'hak_cipta')->get();

        foreach ($kekayaanIntelektuals as $ki) {
            HakCipta::create([
                'ki_id' => $ki->ki_id,
                'hak_cipta_number' => 'HC-' . $faker->unique()->numberBetween(100000, 999999),
                'type' => $faker->randomElement(['Software', 'Literature', 'Art']),
            ]);
        }
    }
}