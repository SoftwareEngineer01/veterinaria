<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
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
            'nombre_mascota'        => ['required', 'string'],
            'tipo_mascota'          => ['required', 'string'],
            'raza_mascota'          => ['required', 'string'],
            'nacimiento_mascota'    => ['required', 'date'],  
            'nombre_propietario'    => ['required', 'string'],
            'apellido_propietario'  => ['required', 'string'],
            'telefono'              => ['required', 'string'],          
            'direccion'             => ['required', 'string'],
            'email'                 => ['required', 'string', 'email'],
        ];
    }

    public function messages() {

        return [
            'nombre_mascota.required'       => 'El nombre de la mascota es obligatorio',
            'tipo_mascota.required'         => 'El tipo mascota es obligatorio',          
            'raza_mascota.required'         => 'La raza de la mascota es obligatoria',
            'nacimiento_mascota.required'   => 'El nacimiento de la mascota es obligatorio',
            'nombre_propietario.required'   => 'El nombre del propietario es obligatorio',
            'apellido_propietario.required' => 'El apellido del propietario es obligatorio',
            'telefono.required'             => 'El telefono del propietario es obligatorio',
            'direccion.required'            => 'La direccion del propietario es obligatorio',
            'email.required'                => 'El email del propietario es obligatorio',
            'email.email'                   => 'El email no es válido'
        ];

    }
}
