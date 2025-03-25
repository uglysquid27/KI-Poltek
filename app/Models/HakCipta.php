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
        return $this->belongsTo(KekayaanIntelektual::class, 'ki_id', 'ki_id');
    }

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
