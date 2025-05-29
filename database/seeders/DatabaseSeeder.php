<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            
          
            KonsultanSeeder::class,
            PemegangSeeder::class,
            PenciptaSeeder::class,
            InventorSeeder::class,
            KekayaanIntelektualSeeder::class, 
             HakCiptaSeeder::class,
            PatenSeeder::class,
        ]);
    }
}
