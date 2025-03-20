<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KekayaanIntelektual extends Model
{
    use HasFactory;

    protected $primaryKey = 'ki_id';

    protected $fillable = [
        'type', 'title', 'description', 'category', 'status', 'submission_date', 'publication_date', 'document', 'user_id'
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
