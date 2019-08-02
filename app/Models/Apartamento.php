<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    protected $fillable = [
        'numero',
        'telefone',
        'bloco',
        'enviado',
        'cliente_id'
    ];

    public function morador()
    {
        return $this->belongsTo(Morador::class);
    }
}
