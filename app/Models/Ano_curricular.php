<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ano_curricular extends Model
{
    protected $table = 'ano_curricular';
    protected $primaryKey = 'id_ano_curricular';
    protected $fillable = [
        'designacao',
        'nivel_ensino_id',
    ];
}
