<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApartamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return [
//            'numero' => $this->numero,
//            'telefone' => $this->telefone,
//            'bloco' => $this->bloco,
//            'enviado' => $this->enviado,
//            'cliente_id' => $this->cliente_id
//        ];
        return $this->resource->toArray();
    }
}
