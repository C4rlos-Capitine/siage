<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ano_academico extends Model
{
    protected $table = 'ano_academico';
    protected $primaryKey = 'id_ano_academico';
    protected $fillable = [
        'designacao',
        'data_inicio',
        'data_fim',
        'estado',
    ];
}
