<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesainIndustri extends Model
{
    use HasFactory;

    protected $table = 'desain_industris';
    protected $primaryKey = 'id';

    protected $casts = [
        'klaim_desain' => 'array',
        'anggota_pendesain' => 'array',
        'keterangan_gambar' => 'array',
        'pernyataan_kebaruan' => 'boolean',
        'pernyataan_tidak_sengketa' => 'boolean',
        'pernyataan_pengalihan_hak' => 'boolean',
    ];

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

    /**
     * Relationship with KekayaanIntelektual
     */
    public function kekayaanIntelektual()
    {
        return $this->belongsTo(KekayaanIntelektual::class, 'ki_id', 'ki_id');
    }

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Accessor for klaim_desain
     */
    public function getKlaimDesainAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        return json_decode($value, true) ?? [];
    }

    /**
     * Accessor for anggota_pendesain
     */
    public function getAnggotaPendesainAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        return json_decode($value, true) ?? [];
    }

    /**
     * Accessor for keterangan_gambar
     */
    public function getKeteranganGambarAttribute($value)
    {
        if (is_array($value)) {
            return $value;
        }
        
        return json_decode($value, true) ?? [];
    }

    /**
     * Get status color for badge
     */
    public function getStatusColor()
    {
        $status = $this->kekayaanIntelektual->status ?? 'Dalam Proses';
        
        switch ($status) {
            case 'Didaftar':
                return 'bg-green-100 text-green-800 border-green-300';
            case 'Dalam Proses':
                return 'bg-blue-100 text-blue-800 border-blue-300';
            case 'Ditolak':
                return 'bg-red-100 text-red-800 border-red-300';
            case 'Dibatalkan':
                return 'bg-yellow-100 text-yellow-800 border-yellow-300';
            case 'Ditarik kembali':
                return 'bg-orange-100 text-orange-800 border-orange-300';
            case 'Berakhir':
                return 'bg-gray-100 text-gray-800 border-gray-300';
            default:
                return 'bg-gray-100 text-gray-800 border-gray-300';
        }
    }

    /**
     * Get file URL for storage
     */
    public function getFileUrl($filePath)
    {
        if (!$filePath) {
            return null;
        }
        
        return Storage::url($filePath);
    }
}