<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
    protected $table = 'ciclo';
    protected $primaryKey = 'id_ciclo';
    protected $fillable = [
        'designacao',
        'abreviatura',
        'ano_curricular_id',
    ];
}
