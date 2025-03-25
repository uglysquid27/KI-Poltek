<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inventor;
use App\Models\Paten;
use Faker\Factory as Faker;

class InventorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed Inventor for Paten
        $patens = Paten::all();
        foreach ($patens as $paten) {
            Inventor::create([
                'paten_id' => $paten->id,
                'name' => $faker->name,
                'address' => $faker->address,
                'nationality' => $faker->country,
            ]);
        }
    }
}