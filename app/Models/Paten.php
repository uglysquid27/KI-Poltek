<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paten extends Model
{
    use HasFactory;

    protected $fillable = ['ki_id', 'paten_number', 'validity'];

    public function kekayaanIntelektual()
    {
        return $this->belongsTo(KekayaanIntelektual::class, 'ki_id');
    }
}
