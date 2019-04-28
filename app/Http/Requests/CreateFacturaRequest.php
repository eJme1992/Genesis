<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFacturaRequest extends FormRequest
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
            'cliente_id'            => 'required',
            'num_factura'           => 'required|unique:facturas',
            'venta_id'              => 'required',
            'ref_item_id_factura'   => 'required|in:1,2,3,4',
            'ref_estadic_id'        => 'required|in:1,2,3',
            'subtotal'              => 'required',
            'impuesto'              => 'required',
            'total_neto'            => 'required',
        ];
    }
}
