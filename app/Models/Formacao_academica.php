<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formacao_academica extends Model
{
    protected $table = 'formacao_academica';
    protected $primaryKey = 'id_formacao_academica';
    protected $fillable = [
        'instituicao',
        'grau_academico',
        'ano_conclusao',
        'docente_id',
    ];
}
