<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNotaPedidoRequest extends FormRequest
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
            'n_pedido'          => 'required|unique:nota_pedidos',
            'cliente_id'        => 'required',
            'direccion_id'      => 'required',
            'status_estuche'    => '',
            'total'             => 'required|numeric|between:1,999999999999.99',
            'modelo_id'         => 'required',
            'montura'           => '',
            'estuche'           => '',
            'check_model'       => '',
        ];
    }
}
