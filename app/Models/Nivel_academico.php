<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel_academico extends Model
{
    protected $table = 'nivel_academico';
    protected $primaryKey = 'id_nivel_academico';
    protected $fillable = [
        'designacao',
        'abreviatura',
    ];
}
