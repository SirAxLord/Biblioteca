<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    protected $table = 'rentas';

    protected $fillable = [
        'usuario_id',
        'libro_id',
        'fecha_renta',
        'fecha_devolucion',
    ];
}
