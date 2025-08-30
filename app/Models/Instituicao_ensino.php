<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicao_ensino extends Model
{
    protected $table = 'instituicao_ensino';
    protected $primaryKey = 'id_instituicao_ensino';
    protected $fillable = [
        'designacao',
        'endereco',
        'telefone',
        'email',
        'website',
        'estado',
    ];
}
