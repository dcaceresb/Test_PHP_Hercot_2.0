<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'date' => 'required|date',
            'price' => 'required',
            'dentist_id' => 'required|min:1',
            'patient_id' => 'required|min:1',
            'service_id' => 'required|min:1',
        ];
    }
    public function messages()
    {
        return [
            'date' => 'Debe seleccionar una fecha',
            'price' => 'Ingrese el valor de la cta',
            'dentist_id' => 'Debe seleccionar un Dentista',
            'patient_id' => 'Debe seleccionar un Paciente',
            'service_id' => 'Debe seleccionar un Servicio',
        ];
    }
}
