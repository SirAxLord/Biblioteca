<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libros extends Model
{
    protected $table = 'libros';

    protected $fillable = [
        'nombre',
        'ISBN',
        'autor',
    ];

    public function rentas()
    {
        return $this->hasMany(Renta::class, 'libro_id');
    }
}
