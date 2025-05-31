<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paten;
use App\Models\KekayaanIntelektual;
use App\Models\User; // Make sure to import the User model

class PatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure there's at least one user to associate with
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'role' => 0,
            ]);
        }

        // Create a KekayaanIntelektual entry first
        $kekayaanIntelektual = KekayaanIntelektual::create([
            'type' => 'paten',
            'title' => 'GENERATOR MENGGUNAKAN TURBIN SIKLON VENTILASI',
            'description' => 'Generator menggunakan turbin siklon ventilasi yang terdiri dari dua bagian utama: siklon ventilasi bagian atas dan siklon ventilasi bagian bawah. Bagian atas melibatkan komponen puncak atau topi (1) sebagai pengarah aliran udara masuk ke sistem, serta plat pemegang bilah (3) dan bilah (3) berbentuk sayap yang menangkap dan memutar aliran udara. Poros besi (2) berfungsi sebagai sumbu rotasi utama yang menghubungkan komponen berputar, didukung oleh plat pemegang poros (4), Lima kipas (5) terpasang pada poros besi untuk mempercepat aliran udara, dihubungkan oleh selendang kipas (6) yang membantu menstabilkan pergerakan dan rotasi bilah. Selendang cerobong (7) mengarahkan udara dari bagian atas ke bagian bawah; Siklon ventilasi bagian bawah meliputi cerobong (8) yang menghubungkan kedua bagian. Di tengah bagian bawah terdapat generator (9) yang didukung oleh dudukan generator bawah (10) untuk menjaga stabilitasnya. Dudukan generator atas (11) juga dipasang untuk menjaga posisi generator. Bantalan atas (13) dan bantalan bawah (14) mendukung poros besi (2) dan poros generator (9), dengan bantuan plat pemegang bantalan (12) untuk menjaga pergerakan rotasi generator.',
            'category' => 'Paten Sederhana',
            'status' => 'Dalam Proses', // Initial status
            'submission_date' => '2023-11-10',
            'publication_date' => null,
            'document' => 'paten_dokumen/draft_turbin_siklon_ventilasi.docx', // Example path
            'user_id' => $user->user_id,
        ]);

        // Create the Paten entry
        Paten::create([
            'ki_id' => $kekayaanIntelektual->ki_id,
            'user_id' => $user->user_id,
            'judul_paten' => 'GENERATOR MENGGUNAKAN TURBIN SIKLON VENTILASI',
            'abstrak' => 'Generator menggunakan turbin siklon ventilasi yang terdiri dari dua bagian utama: siklon ventilasi bagian atas dan siklon ventilasi bagian bawah. Bagian atas melibatkan komponen puncak atau topi (1) sebagai pengarah aliran udara masuk ke sistem, serta plat pemegang bilah (3) dan bilah (3) berbentuk sayap yang menangkap dan memutar aliran udara. Poros besi (2) berfungsi sebagai sumbu rotasi utama yang menghubungkan komponen berputar, didukung oleh plat pemegang poros (4), Lima kipas (5) terpasang pada poros besi untuk mempercepat aliran udara, dihubungkan oleh selendang kipas (6) yang membantu menstabilkan pergerakan dan rotasi bilah. Selendang cerobong (7) mengarahkan udara dari bagian atas ke bagian bawah; Siklon ventilasi bagian bawah meliputi cerobong (8) yang menghubungkan kedua bagian. Di tengah bagian bawah terdapat generator (9) yang didukung oleh dudukan generator bawah (10) untuk menjaga stabilitasnya. Dudukan generator atas (11) juga dipasang untuk menjaga posisi generator. Bantalan atas (13) dan bantalan bawah (14) mendukung poros besi (2) dan poros generator (9), dengan bantuan plat pemegang bantalan (12) untuk menjaga pergerakan rotasi generator.',
            'jumlah_klaim' => 1, // Based on sample data
            'ketua_inventor_nama' => 'Sugeng Hadi Susilo',
            'ketua_inventor_alamat' => 'Jl. Soekarno-Hatta No 9 Malang / Jl. Margobasuki VII / 19 Dau, Malang',
            'ketua_inventor_email' => 'sugeng.hadi@polinema.ac.id',
            'ketua_inventor_hp' => '081334519340',
            'ketua_inventor_jurusan' => 'Teknik Mesin',
            'anggota_inventor' => null, // Based on sample data '------------'
            'jenis_paten' => 'Paten Sederhana',
            'file_path_ktp' => 'paten_ktp/ktp_turbin_siklon_ventilasi.pdf', // Example path
            'ada_anggota_mahasiswa' => 'Tidak',
            'anggota_mahasiswa' => null,
            'tanggal_upload_draft' => '2023-11-10',
            'file_path_draft' => 'paten_dokumen/draft_turbin_siklon_ventilasi.docx', // Example path
        ]);

        // You can add more dummy data here if needed
    }
}
