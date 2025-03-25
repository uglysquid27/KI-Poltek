<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventor extends Model
{
    protected $fillable = ['paten_id', 'name', 'address', 'nationality'];

    public function paten()
    {
        return $this->belongsTo(Paten::class, 'paten_id');
    }
}