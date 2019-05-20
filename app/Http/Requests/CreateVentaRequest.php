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
            'checkbox_pago'         => '',
            'n_pedido'              => 'required|unique:nota_pedidos',
            'cliente_id'            => 'required',
            'direccion_id'          => 'required',
            'status_estuche'        => '',
            'total'                 => 'required|numeric|between:1,999999999999.99',
            'modelo_id'             => 'required',
            'montura'               => '',
            'estuche'               => '',
            'precio_montura'        => 'required|between:0,999999999999.99',
            'precio_modelo'         => 'required|between:0,999999999999.99',
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
            'tipo_abono_id'         => 'required_if:checkbox_pago,1|in:1,2,3,4,5,6,7',
            'abono'                 => 'required_if:checkbox_pago,1',
            'restante'              => 'required_if:checkbox_pago,1',
            'estatus_id'            => 'required_if:tipo_abono_id,1',
            'protesto_id'           => 'required_if:tipo_abono_id,1',
            'numero_unico'          => 'required_if:tipo_abono_id,1',
            'monto_inicial'         => 'required_if:tipo_abono_id,1',
            'monto_final'           => 'required_if:tipo_abono_id,1',
            'fecha_inicial'         => 'required_if:tipo_abono_id,1',
            'fecha_final'           => 'required_if:tipo_abono_id,1',
            'fecha_pago'            => 'required_if:tipo_abono_id,1',
            'no_adeudado'           => 'required_if:tipo_abono_id,1|string',
        ];
    }

    public function messages()
    {
        return [
            'restante.numeric'  => "el campo restante debe ser un numero positivo",
        ];
    }
}
