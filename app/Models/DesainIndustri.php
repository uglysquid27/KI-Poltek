<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesainIndustri extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'desain_industris';

    protected $fillable = [
        'ki_id',
        'user_id',
        'judul_desain',
        'kegunaan',
        'klaim_desain',
        'uraian_klaim',
        'pemohon_nama',
        'pemohon_jenis',
        'pemohon_kewarganegaraan',
        'pemohon_badan_hukum',
        'pemohon_alamat',
        'pemohon_rt_rw',
        'pemohon_kelurahan',
        'pemohon_kecamatan',
        'pemohon_kota_kabupaten',
        'pemohon_kodepos',
        'pemohon_provinsi',
        'pendesain_nama',
        'pendesain_kewarganegaraan',
        'pendesain_alamat',
        'pendesain_rt_rw',
        'pendesain_kelurahan',
        'pendesain_kecamatan',
        'pendesain_kota_kabupaten',
        'pendesain_kodepos',
        'pendesain_provinsi',
        'anggota_pendesain',
        'file_path_gambar_desain',
        'keterangan_gambar',
        'file_path_surat_pernyataan_kepemilikan',
        'file_path_surat_pengalihan_hak',
        'file_path_ktp_pendesain',
        'file_path_akta_badan_hukum',
        'pernyataan_kebaruan',
        'pernyataan_tidak_sengketa',
        'pernyataan_pengalihan_hak',
    ];

    protected $casts = [
        'klaim_desain' => 'array',
        'anggota_pendesain' => 'array',
        'keterangan_gambar' => 'array',
        'pernyataan_kebaruan' => 'boolean',
        'pernyataan_tidak_sengketa' => 'boolean',
        'pernyataan_pengalihan_hak' => 'boolean',
    ];

    /**
     * Relationship to KekayaanIntelektual
     */
    public function kekayaanIntelektual()
    {
        return $this->belongsTo(KekayaanIntelektual::class, 'ki_id', 'ki_id');
    }

    /**
     * Relationship to User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}