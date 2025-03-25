<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pencipta extends Model
{
    protected $fillable = ['hak_cipta_id', 'name', 'address', 'nationality'];

    public function hakCipta()
    {
        return $this->belongsTo(HakCipta::class, 'hak_cipta_id');
    }
}