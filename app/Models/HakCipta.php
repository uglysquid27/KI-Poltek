<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HakCipta extends Model
{
    use HasFactory;

    protected $fillable = ['ki_id', 'hak_cipta_number', 'type'];

    public function kekayaanIntelektual()
    {
        return $this->belongsTo(KekayaanIntelektual::class, 'ki_id');
    }
}
