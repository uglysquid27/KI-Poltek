<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KekayaanIntelektual extends Model
{
    use HasFactory;
    
    protected $table = 'kekayaan_intelektuals';
    protected $primaryKey = 'ki_id';
    public $timestamps = false; // jika tidak ada kolom created_at & updated_at

    protected $fillable = [
        'ki_id', 'type', 'title', 'description', 'category', 
        'status', 'submission_date', 'publication_date', 'document', 'user_id'
    ];

    public function hakCipta()
    {
        return $this->hasOne(HakCipta::class, 'ki_id');
    }

    public function paten()
    {
        return $this->hasOne(Paten::class, 'ki_id');
    }
}
