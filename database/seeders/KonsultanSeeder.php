<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Konsultan;
use App\Models\HakCipta;
use App\Models\Paten;
use Faker\Factory as Faker;

class KonsultanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed Konsultan for Hak Cipta
        $hakCiptas = HakCipta::all();
        foreach ($hakCiptas as $hakCipta) {
            Konsultan::create([
                'hak_cipta_id' => $hakCipta->id,
                'paten_id' => null,
                'name' => $faker->name,
                'address' => $faker->address,
                'nationality' => $faker->country,
            ]);
        }

        // Seed Konsultan for Paten
        $patens = Paten::all();
        foreach ($patens as $paten) {
            Konsultan::create([
                'hak_cipta_id' => null,
                'paten_id' => $paten->id,
                'name' => $faker->name,
                'address' => $faker->address,
                'nationality' => $faker->country,
            ]);
        }
    }
}