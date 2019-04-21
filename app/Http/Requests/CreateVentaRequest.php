<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVentaRequest extends FormRequest
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
            'checkbox_factura'      => '',
            'checkbox_guia'         => '',
            'cliente_id'            => 'required',
            'direccion_id'          => 'required',
            'status_estuche'        => '',
            'total'                 => 'required',
            'modelo_id'             => 'required',
            'montura'               => 'required',
            'estuche'               => '',
            'precio_montura'        => 'required',
            'precio_modelo'         => 'required',
            'num_factura'           => 'required_if:checkbox_factura, 1|unique:facturas',
            'ref_item_id_factura'   => 'required_if:checkbox_factura, 1|in:1,2,3,4',
            'ref_estadic_id'        => 'required_if:checkbox_factura, 1|in:1,2,3',
            'subtotal'              => 'required_if:checkbox_factura, 1',
            'impuesto'              => 'required_if:checkbox_factura, 1',
            'total_neto'            => 'required_if:checkbox_factura, 1',
            'serial'                => 'required_if:checkbox_guia, 1',
            'guia'                  => 'required_if:checkbox_guia, 1',
            'dir_salida'            => 'required_if:checkbox_guia, 1',
            'dir_llegada'           => 'required_if:checkbox_guia, 1',
            'ref_item_id'           => 'required_if:checkbox_guia, 1|in:1,2,3,4',
            'cantidad'              => 'required_if:checkbox_guia, 1',
            'peso'                  => 'required_if:checkbox_guia, 1',
            'descripcion'           => '',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
