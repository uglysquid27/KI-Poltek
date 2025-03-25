<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pencipta;
use App\Models\HakCipta;
use Faker\Factory as Faker;

class PenciptaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed Pencipta for Hak Cipta
        $hakCiptas = HakCipta::all();
        foreach ($hakCiptas as $hakCipta) {
            Pencipta::create([
                'hak_cipta_id' => $hakCipta->id,
                'name' => $faker->name,
                'address' => $faker->address,
                'nationality' => $faker->country,
            ]);
        }
    }
}