<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area_curricular extends Model
{
    protected $table = 'area_curricular';
    protected $primaryKey = 'id_area_curricular';
    protected $fillable = [
        'designacao',
        'abreviatura',
    ];
}
