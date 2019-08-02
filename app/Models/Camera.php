<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    protected $fillable = [
        'nome', 'endereco', 'qualidade', 'enviado', 'status', 'porta', 'cliente_id'
    ];
}
