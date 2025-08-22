<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KekayaanIntelektual;
use App\Models\DesainIndustri;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DesainIndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, make sure the enum type includes 'desain_industri'
        $this->checkEnumType();

        // Create or get a test user - using user_id as primary key
        $user = User::where('email', 'desain@example.com')->first();
        
        if (!$user) {
            $user = User::create([
                // 'user_id' => User::max('user_id') + 1, // Assuming user_id is auto-increment
                'name' => 'Pendesain User',
                'email' => 'desain@example.com',
                'password' => Hash::make('password123'),
                'role' => 0,
                'remember_token' => null,
            ]);
        }

        // Create Kekayaan Intelektual record
        $ki = KekayaanIntelektual::create([
            'type' => 'desain_industri',
            'title' => 'Botol Minuman Ergonomis',
            'description' => 'Botol minuman dengan desain ergonomis untuk genggaman yang nyaman',
            'category' => 'Desain Industri',
            'status' => 'Dalam Proses',
            'submission_date' => now(),
            'publication_date' => null,
            'document' => 'desain_industri/gambar/sample_botol.jpg',
            // 'user_id' => $user->user_id, // Use user_id instead of id
        ]);

        // Create Desain Industri record
        DesainIndustri::create([
            'ki_id' => $ki->ki_id,
            // 'user_id' => $user->user_id, // Use user_id instead of id
            
            // Data Desain Industri
            'judul_desain' => 'Botol Minuman Ergonomis',
            'kegunaan' => 'Sebagai kemasan minuman dengan desain ergonomis untuk kenyamanan pengguna',
            'klaim_desain' => json_encode(['bentuk', 'konfigurasi']),
            'uraian_klaim' => 'Desain kontur botol yang ergonomis dan konfigurasi grip yang nyaman',
            
            // Data Pemohon
            'pemohon_nama' => 'PT. Inovasi Desain Indonesia',
            'pemohon_jenis' => 'badan_hukum',
            'pemohon_kewarganegaraan' => 'Indonesia',
            'pemohon_badan_hukum' => 'PT. Inovasi Desain Indonesia',
            'pemohon_alamat' => 'Jl. Raya Teknologi No. 123',
            'pemohon_rt_rw' => '001/002',
            'pemohon_kelurahan' => 'Teknopolis',
            'pemohon_kecamatan' => 'Digital District',
            'pemohon_kota_kabupaten' => 'Jakarta Selatan',
            'pemohon_kodepos' => '12345',
            'pemohon_provinsi' => 'DKI Jakarta',
            
            // Data Pendesain
            'pendesain_nama' => 'Budi Santoso',
            'pendesain_kewarganegaraan' => 'Indonesia',
            'pendesain_alamat' => 'Jl. Desain Kreatif No. 45',
            'pendesain_rt_rw' => '003/004',
            'pendesain_kelurahan' => 'Kreativitas',
            'pendesain_kecamatan' => 'Innovation Area',
            'pendesain_kota_kabupaten' => 'Bandung',
            'pendesain_kodepos' => '40123',
            'pendesain_provinsi' => 'Jawa Barat',
            
            // Additional designers
            'anggota_pendesain' => json_encode([
                [
                    'nama' => 'Siti Rahayu',
                    'kewarganegaraan' => 'Indonesia',
                    'alamat' => 'Jl. Inovasi No. 67',
                    'rt_rw' => '005/006',
                    'kelurahan' => 'Kreatif',
                    'kecamatan' => 'Design Center',
                    'kota_kabupaten' => 'Bandung',
                    'kodepos' => '40124',
                    'provinsi' => 'Jawa Barat'
                ]
            ]),
            
            // File paths
            'file_path_gambar_desain' => 'desain_industri/gambar/botol_ergonomis.jpg',
            'keterangan_gambar' => json_encode(['Gambar tampak depan', 'Gambar tampak samping', 'Gambar 3D']),
            'file_path_surat_pernyataan_kepemilikan' => 'desain_industri/surat/pernyataan_kepemilikan.pdf',
            'file_path_surat_pengalihan_hak' => 'desain_industri/surat/pengalihan_hak.pdf',
            'file_path_ktp_pendesain' => 'desain_industri/ktp/ktp_budi.pdf',
            'file_path_akta_badan_hukum' => 'desain_industri/akta/akta_pt.pdf',
            
            // Pernyataan
            'pernyataan_kebaruan' => true,
            'pernyataan_tidak_sengketa' => true,
            'pernyataan_pengalihan_hak' => true,
        ]);

        $this->command->info('Desain Industri data seeded successfully!');
        $this->command->info('Sample user: desain@example.com / password123');
    }

    /**
     * Check and update the enum type if needed
     */
    private function checkEnumType(): void
    {
        $enumValues = DB::select("SHOW COLUMNS FROM kekayaan_intelektuals WHERE Field = 'type'");
        
        if (!empty($enumValues)) {
            $enumDefinition = $enumValues[0]->Type;
            if (strpos($enumDefinition, 'desain_industri') === false) {
                DB::statement("ALTER TABLE kekayaan_intelektuals MODIFY COLUMN type ENUM('hak_cipta', 'paten', 'desain_industri') NOT NULL");
                $this->command->info('Updated enum type to include desain_industri');
            }
        }
    }
    // In your DesainIndustri model
protected $casts = [
    'klaim_desain' => 'array',
];
}