<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DesainIndustri;
use App\Models\KekayaanIntelektual;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DesainIndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ensure at least one user exists
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

        $klaimOptions = [
            ['bentuk'],
            ['konfigurasi'],
            ['komposisi_garis_warna'],
            ['bentuk', 'konfigurasi'],
            ['bentuk', 'komposisi_garis_warna'],
            ['konfigurasi', 'komposisi_garis_warna'],
            ['bentuk', 'konfigurasi', 'komposisi_garis_warna']
        ];

        $kegunaanExamples = [
            'Sebagai kemasan minuman berkarbonasi',
            'Sebagai wadah penyimpanan makanan',
            'Sebagai perangkat elektronik portable',
            'Sebagai furnitur ruang tamu',
            'Sebagai alat transportasi personal',
            'Sebagai peralatan dapur',
            'Sebagai kemasan produk kosmetik'
        ];

        for ($i = 0; $i < 5; $i++) {
            // Create KekayaanIntelektual entry
            $ki = KekayaanIntelektual::create([
                'type' => 'desain_industri',
                'title' => 'Desain Industri: ' . $faker->word,
                'description' => $faker->paragraph,
                'category' => $faker->randomElement(['Produk', 'Kemasan', 'Furnitur', 'Elektronik']),
                'status' => $faker->randomElement(['Dalam Proses', 'Didaftar', 'Ditolak']),
                'submission_date' => $faker->date(),
                'publication_date' => $faker->optional()->date(),
                'document' => $faker->optional()->word . '.pdf',
                'user_id' => $user->user_id,
            ]);

            // Create additional designers (0-2)
            $anggotaPendesain = null;
            if ($faker->boolean(50)) {
                $anggotaPendesain = [];
                $numAnggota = $faker->numberBetween(1, 2);
                for ($j = 0; $j < $numAnggota; $j++) {
                    $anggotaPendesain[] = [
                        'nama' => $faker->name,
                        'kewarganegaraan' => 'Indonesia',
                        'alamat' => $faker->address,
                        'rt_rw' => $faker->numerify('##/##'),
                        'kelurahan' => $faker->citySuffix,
                        'kecamatan' => $faker->city,
                        'kota_kabupaten' => $faker->city,
                        'kodepos' => $faker->postcode,
                        'provinsi' => $faker->state,
                    ];
                }
            }

            // Create image descriptions
            $keteranganGambar = [
                'Gambar 1' => 'Tampak Depan',
                'Gambar 2' => 'Tampak Belakang',
                'Gambar 3' => 'Tampak Samping Kanan',
                'Gambar 4' => 'Tampak Samping Kiri',
                'Gambar 5' => 'Tampak Atas',
                'Gambar 6' => 'Perspektif'
            ];

            // Create the industrial design record
            DesainIndustri::create([
                'ki_id' => $ki->ki_id,
                'user_id' => $user->user_id,
                'judul_desain' => $faker->randomElement(['Botol', 'Meja', 'Kursi', 'Lampu', 'Kemasan', 'Perhiasan', 'Alat Musik']),
                'kegunaan' => $faker->randomElement($kegunaanExamples),
                'klaim_desain' => json_encode($faker->randomElement($klaimOptions)),
                'uraian_klaim' => $faker->paragraph,
                'pemohon_nama' => $faker->randomElement([$faker->name, 'Politeknik Negeri Malang']),
                'pemohon_jenis' => $faker->randomElement(['perorangan', 'badan_hukum']),
                'pemohon_kewarganegaraan' => 'Indonesia',
                'pemohon_badan_hukum' => $faker->optional()->company,
                'pemohon_alamat' => $faker->address,
                'pemohon_rt_rw' => $faker->numerify('##/##'),
                'pemohon_kelurahan' => $faker->citySuffix,
                'pemohon_kecamatan' => $faker->city,
                'pemohon_kota_kabupaten' => $faker->city,
                'pemohon_kodepos' => $faker->postcode,
                'pemohon_provinsi' => $faker->state,
                'pendesain_nama' => $faker->name,
                'pendesain_kewarganegaraan' => 'Indonesia',
                'pendesain_alamat' => $faker->address,
                'pendesain_rt_rw' => $faker->numerify('##/##'),
                'pendesain_kelurahan' => $faker->citySuffix,
                'pendesain_kecamatan' => $faker->city,
                'pendesain_kota_kabupaten' => $faker->city,
                'pendesain_kodepos' => $faker->postcode,
                'pendesain_provinsi' => $faker->state,
                'anggota_pendesain' => $anggotaPendesain ? json_encode($anggotaPendesain) : null,
                'file_path_gambar_desain' => 'dummy_files/desain_' . $faker->unique()->word . '.pdf',
                'keterangan_gambar' => json_encode($keteranganGambar),
                'file_path_surat_pernyataan_kepemilikan' => 'dummy_files/pernyataan_' . $faker->unique()->word . '.pdf',
                'file_path_surat_pengalihan_hak' => $faker->optional()->passthrough('dummy_files/pengalihan_' . $faker->unique()->word . '.pdf'),
                'file_path_ktp_pendesain' => 'dummy_files/ktp_' . $faker->unique()->word . '.pdf',
                'file_path_akta_badan_hukum' => $faker->optional()->passthrough('dummy_files/akta_' . $faker->unique()->word . '.pdf'),
                'pernyataan_kebaruan' => true,
                'pernyataan_tidak_sengketa' => true,
                'pernyataan_pengalihan_hak' => $faker->boolean(30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}