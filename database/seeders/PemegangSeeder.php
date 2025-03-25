<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pemegang;
use App\Models\HakCipta;
use App\Models\Paten;
use Faker\Factory as Faker;

class PemegangSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed Pemegang for Hak Cipta
        $hakCiptas = HakCipta::all();
        foreach ($hakCiptas as $hakCipta) {
            Pemegang::create([
                'hak_cipta_id' => $hakCipta->id,
                'paten_id' => null,
                'name' => $faker->name,
                'address' => $faker->address,
                'nationality' => $faker->country,
            ]);
        }

        // Seed Pemegang for Paten
        $patens = Paten::all();
        foreach ($patens as $paten) {
            Pemegang::create([
                'hak_cipta_id' => null,
                'paten_id' => $paten->id,
                'name' => $faker->name,
                'address' => $faker->address,
                'nationality' => $faker->country,
            ]);
        }
    }
}