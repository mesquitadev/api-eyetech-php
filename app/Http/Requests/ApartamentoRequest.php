<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ApartamentoRequest
 * @package App\Http\Requests
 * Cria Validações personalizadas para a classe de Apartamento
 */
class ApartamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'numero' => 'required|min:1',
            'telefone' => 'required|max:12',
            'bloco' => 'required',
            'enviado' => 'required',
            'cliente_id' => 'required'
        ];
    }
}
