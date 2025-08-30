<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $table = 'disciplina';
    protected $primaryKey = 'id_disciplina';
    protected $fillable = [
        'designacao',
        'abreviatura',
        'area_curricular_id',
        'ciclo_id',
        'ano_curricular_id',
        'nivel_ensino_id',
        'estado',
    ];
}
