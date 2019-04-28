<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePagoRequest extends FormRequest
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
            'tipo_abono_id'         => 'required|in:1,2,3,4,5,6,7',
            'total_deuda'           => 'required|numeric|between:0,999999999999',
            'abono'                 => 'required|numeric|between:0,999999999999',
            'restante'              => 'required|numeric|between:0,999999999999',
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
}
