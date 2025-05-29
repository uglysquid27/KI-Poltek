<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KekayaanIntelektual;
use App\Models\HakCipta; // Pastikan model HakCipta yang baru diimport
use App\Models\Paten; // Jika Anda masih menggunakan model Paten
use App\Models\User; // Untuk mendapatkan user_id
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KekayaanIntelektualSeeder extends Seeder
{
    public function run()
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

        // Jenis karya yang mungkin untuk Hak Cipta
        $jenisKaryaOptions = [
            'Karya Tulis', 'Karya Seni', 'Komposisi Musik', 'Karya Audio Visual',
            'Karya Fotografi', 'Karya Drama & Koreografi', 'Karya Rekaman', 'Karya Lainnya'
        ];

        // Status yang mungkin untuk Kekayaan Intelektual
        $statusOptions = [
            'Dalam Proses', 'Dibatalkan', 'Ditolak', 'Dihapus',
            'Didaftar', 'Ditarik kembali', 'Berakhir'
        ];

        for ($i = 1; $i <= 50; $i++) {
            // Create a random type
            $type = $faker->randomElement(['hak_cipta', 'paten']);

            // Create a Kekayaan Intelektual record
            $ki = KekayaanIntelektual::create([
                'type' => $type,
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph,
                'category' => $faker->randomElement(['Teknologi', 'Lingkungan', 'Pendidikan', 'Kesehatan']),
                'status' => $faker->randomElement($statusOptions),
                'submission_date' => $faker->date(),
                'publication_date' => $faker->optional()->date(),
                'document' => $faker->optional()->word . '.pdf',
                'user_id' => $user->user_id, // Menggunakan user_id dari user yang ada
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Create related HakCipta or Paten record with the NEW, DETAILED SCHEMA
            if ($type === 'hak_cipta') {
                // Data Anggota Mahasiswa (bisa kosong atau diisi)
                $anggotaMahasiswa = null;
                if ($faker->boolean(50)) { // 50% kemungkinan ada anggota mahasiswa
                    $anggotaMahasiswa = [];
                    $numMahasiswa = $faker->numberBetween(1, 3);
                    for ($j = 0; $j < $numMahasiswa; $j++) {
                        $anggotaMahasiswa[] = [
                            'nama' => $faker->name,
                            'nim' => $faker->unique()->numerify('##########'),
                        ];
                    }
                }

                // Data Anggota Pencipta Lain (bisa kosong atau diisi)
                $anggotaPencipta = null;
                if ($faker->boolean(50)) { // 50% kemungkinan ada anggota pencipta lain
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

                $hakCiptaData = [
                    'ki_id' => $ki->ki_id, // Link ke KekayaanIntelektual
                    'user_id' => $user->user_id, // Link ke User
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
                ];

                // Uncomment the line below to debug the data being passed to HakCipta::create()
                // dd([
                //     'ki_id_from_ki' => $ki->ki_id,
                //     'HakCipta_model_fillable' => (new HakCipta())->getFillable(),
                //     'data_to_create' => $hakCiptaData
                // ]);

                HakCipta::create($hakCiptaData);
            } else {
                // Jika Anda memiliki model Paten yang sesuai dengan KekayaanIntelektual
                Paten::create([
                    'ki_id' => $ki->ki_id,
                    'paten_number' => 'P' . $faker->unique()->numberBetween(100000, 999999),
                    'validity' => $faker->dateTimeBetween('now', '+10 years'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
