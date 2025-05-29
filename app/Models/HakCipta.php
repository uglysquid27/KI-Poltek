<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HakCipta extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai dengan konvensi Laravel (plural dari nama model)
    protected $table = 'hak_ciptas';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'ki_id', // Pastikan ki_id ada di sini
        'user_id', // Foreign key to users table
        'judul_karya',
        'uraian_singkat_ciptaan',
        'jenis_karya',
        'pencipta_nik',
        'pencipta_nama',
        'pencipta_email',
        'pencipta_hp',
        'pencipta_alamat',
        'pencipta_kecamatan',
        'pencipta_kodepos',
        'pencipta_jurusan',
        'anggota_mahasiswa', // Disimpan sebagai JSON
        'anggota_pencipta',  // Disimpan sebagai JSON
        'file_path_ktp',
        'kota_pengumuman',
        'tanggal_pengumuman',
        'file_path_ciptaan',
        'pernyataan_setuju',
    ];

    // Casting atribut ke tipe data tertentu
    protected $casts = [
        'anggota_mahasiswa' => 'array', // Cast JSON ke array PHP
        'anggota_pencipta' => 'array',  // Cast JSON ke array PHP
        'tanggal_pengumuman' => 'date', // Cast ke objek tanggal
        'pernyataan_setuju' => 'boolean', // Cast ke boolean
    ];

    /**
     * Relasi ke model KekayaanIntelektual.
     * Menggunakan 'ki_id' sebagai foreign key di tabel hak_ciptas
     * dan 'ki_id' sebagai primary key di tabel kekayaan_intelektuals.
     */
    public function kekayaanIntelektual()
    {
        return $this->belongsTo(KekayaanIntelektual::class, 'ki_id', 'ki_id');
    }

    /**
     * Relasi ke model User (pengguna yang mengunggah).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id'); // Sesuaikan 'user_id' jika primary key user bukan 'id'
    }

    // Relasi lainnya yang Anda definisikan sebelumnya
    public function pemegangs()
    {
        return $this->hasMany(Pemegang::class, 'hak_cipta_id');
    }

    public function penciptas()
    {
        return $this->hasMany(Pencipta::class, 'hak_cipta_id');
    }

    public function konsultans()
    {
        return $this->hasMany(Konsultan::class, 'hak_cipta_id');
    }
}
