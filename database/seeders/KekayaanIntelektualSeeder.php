<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KekayaanIntelektual extends Model
{
    use HasFactory;

    protected $table = 'kekayaan_intelektuals';
    protected $primaryKey = 'ki_id';

    protected $fillable = [
        'type',
        'title',
        'description',
        'category',
        'status',
        'submission_date',
        'publication_date',
        'document',
        'user_id',
    ];

    protected $casts = [
        'submission_date' => 'date',
        'publication_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship with HakCipta
     */
    public function hakCipta()
    {
        return $this->hasOne(HakCipta::class, 'ki_id', 'ki_id');
    }

    /**
     * Relationship with Paten
     */
    public function paten()
    {
        return $this->hasOne(Paten::class, 'ki_id', 'ki_id');
    }

    /**
     * Relationship with DesainIndustri
     */
    public function desainIndustri()
    {
        return $this->hasOne(DesainIndustri::class, 'ki_id', 'ki_id');
    }

    /**
     * Get status color for badge
     */
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
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
     * Get type label
     */
    public function getTypeLabelAttribute()
    {
        switch ($this->type) {
            case 'hak_cipta':
                return 'Hak Cipta';
            case 'paten':
                return 'Paten';
            case 'desain_industri':
                return 'Desain Industri';
            default:
                return ucfirst($this->type);
        }
    }

    /**
     * Scope for Hak Cipta
     */
    public function scopeHakCipta($query)
    {
        return $query->where('type', 'hak_cipta');
    }

    /**
     * Scope for Paten
     */
    public function scopePaten($query)
    {
        return $query->where('type', 'paten');
    }

    /**
     * Scope for Desain Industri
     */
    public function scopeDesainIndustri($query)
    {
        return $query->where('type', 'desain_industri');
    }
}