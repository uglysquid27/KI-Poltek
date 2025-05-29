<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HakCipta;
use App\Models\KekayaanIntelektual; // Import KekayaanIntelektual model
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HakCiptaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan ada setidaknya satu user
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Dummy User',
                'email' => 'dummy@example.com',
                'password' => Hash::make('password'),
                'role' => 0,
                'remember_token' => Str::random(10),
            ]);
        }

        $jenisKaryaOptions = [
            'Karya Tulis', 'Karya Seni', 'Komposisi Musik', 'Karya Audio Visual',
            'Karya Fotografi', 'Karya Drama & Koreografi', 'Karya Rekaman', 'Karya Lainnya'
        ];

        for ($i = 0; $i < 5; $i++) {
            // --- START: Create a KekayaanIntelektual entry for each HakCipta ---
            $ki = KekayaanIntelektual::create([
                'type' => 'hak_cipta', // Always 'hak_cipta' for this seeder
                'title' => 'Judul KI: ' . $faker->sentence(3),
                'description' => $faker->paragraph,
                'category' => $faker->randomElement(['Teknologi', 'Pendidikan', 'Seni']),
                'status' => $faker->randomElement(['Dalam Proses', 'Didaftar']),
                'submission_date' => $faker->date(),
                'publication_date' => $faker->optional()->date(),
                'document' => $faker->optional()->word . '.pdf',
                'user_id' => $user->user_id,
            ]);
            // --- END: Create a KekayaanIntelektual entry ---

            $anggotaMahasiswa = null;
            if ($faker->boolean(50)) {
                $anggotaMahasiswa = [];
                $numMahasiswa = $faker->numberBetween(1, 3);
                for ($j = 0; $j < $numMahasiswa; $j++) {
                    $anggotaMahasiswa[] = [
                        'nama' => $faker->name,
                        'nim' => $faker->unique()->numerify('##########'),
                    ];
                }
            }

            $anggotaPencipta = null;
            if ($faker->boolean(50)) {
                $anggotaPencipta = [];
                $numAnggota = $faker->numberBetween(1, 2);
                for ($j = 0; $j < $numAnggota; $j++) {
                    $anggotaPencipta[] = [
                        'nik' => $faker->unique()->numerify('################'),
                        'nama' => $faker->name,
                        'email' => $faker->unique()->safeEmail,
                        'hp' => $faker->phoneNumber,
                        'alamat' => $faker->address,
                        'kecamatan' => $faker->city,
                        'kodepos' => $faker->postcode,
                    ];
                }
            }

            HakCipta::create([
                'ki_id' => $ki->ki_id, // Now using the ki_id from the newly created KekayaanIntelektual
                'user_id' => $user->user_id,
                'judul_karya' => $faker->sentence(rand(3, 7)),
                'uraian_singkat_ciptaan' => $faker->paragraph(rand(3, 5)),
                'jenis_karya' => $faker->randomElement($jenisKaryaOptions),
                'pencipta_nik' => $faker->unique()->numerify('################'),
                'pencipta_nama' => $faker->name,
                'pencipta_email' => $faker->unique()->safeEmail,
                'pencipta_hp' => $faker->phoneNumber,
                'pencipta_alamat' => $faker->address,
                'pencipta_kecamatan' => $faker->city,
                'pencipta_kodepos' => $faker->postcode,
                'pencipta_jurusan' => $faker->randomElement(['Teknik Informatika', 'Manajemen Bisnis', 'Akuntansi', 'Teknik Elektro']),
                'anggota_mahasiswa' => $anggotaMahasiswa ? json_encode($anggotaMahasiswa) : null,
                'anggota_pencipta' => $anggotaPencipta ? json_encode($anggotaPencipta) : null,
                'file_path_ktp' => 'dummy_files/ktp_' . $faker->unique()->word() . '.pdf',
                'kota_pengumuman' => $faker->city,
                'tanggal_pengumuman' => $faker->date(),
                'file_path_ciptaan' => 'dummy_files/ciptaan_' . $faker->unique()->word() . '.pdf',
                'pernyataan_setuju' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
