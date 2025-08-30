<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel_ensino extends Model
{
    protected $table = 'nivel_ensino';
    protected $primaryKey = 'id_nivel_ensino';
    protected $fillable = [
        'designacao',
        'abreviatura',
    ];
}
