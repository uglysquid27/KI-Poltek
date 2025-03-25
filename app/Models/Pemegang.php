<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemegang extends Model
{
    protected $fillable = ['hak_cipta_id', 'paten_id', 'name', 'address', 'nationality'];

    public function hakCipta()
    {
        return $this->belongsTo(HakCipta::class, 'hak_cipta_id');
    }

    public function paten()
    {
        return $this->belongsTo(Paten::class, 'paten_id');
    }
}