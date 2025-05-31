<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paten extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ki_id',
        'user_id',
        'judul_paten',
        'abstrak',
        'jumlah_klaim',
        'ketua_inventor_nama',
        'ketua_inventor_alamat',
        'ketua_inventor_email',
        'ketua_inventor_hp',
        'ketua_inventor_jurusan',
        'anggota_inventor',
        'jenis_paten',
        'file_path_ktp',
        'ada_anggota_mahasiswa',
        'anggota_mahasiswa',
        'tanggal_upload_draft',
        'file_path_draft',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'anggota_inventor' => 'array',
        'anggota_mahasiswa' => 'array',
        'tanggal_upload_draft' => 'date',
    ];

    /**
     * Get the KekayaanIntelektual that owns the Paten.
     */
    public function kekayaanIntelektual(): BelongsTo
    {
        return $this->belongsTo(KekayaanIntelektual::class, 'ki_id', 'ki_id');
    }

    /**
     * Get the User that owns the Paten.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
