<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    protected $table = 'moradores';
    protected $fillable = [
        'nome', 'telefone', 'apartamento_id', 'enviado', 'status'
    ];
}
