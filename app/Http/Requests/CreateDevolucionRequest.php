<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDevolucionRequest extends FormRequest
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
            'venta_id'              => 'required',
            'motivo'                => '',
            'n_serie'               => 'required',
            'n_nota'                => 'required',
            'venta_modelo_id'       => 'required',
            'venta_montura_modelo'  => 'required',
            'modelo_id'             => 'required',
            'montura'               => 'required',
            'estuche'               => 'required',
            'num_factura'           => 'required|unique:facturas',
            'venta_id'              => 'required',
            'ref_item_id_factura'   => 'required|in:1,2,3,4',
            'ref_estadic_id'        => 'required|in:1,2,3',
            'subtotal'              => 'required',
            'impuesto'              => 'required',
            'total_neto'            => 'required',
            'serial'                => 'required_if:checkbox_guia, 1',
            'guia'                  => 'required_if:checkbox_guia, 1',
            'dir_salida'            => 'required_if:checkbox_guia, 1',
            'dir_llegada'           => 'required_if:checkbox_guia, 1',
            'ref_item_id'           => 'required_if:checkbox_guia, 1',
            'cantidad'              => 'required_if:checkbox_guia, 1',
            'peso'                  => 'required_if:checkbox_guia, 1',
            'descripcion'           => '',
        ];
    }
}
