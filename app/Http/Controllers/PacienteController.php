<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseApiController;
use App\Models\Paciente;
use App\Http\Requests\PacienteRequest;

class PacienteController extends ResponseApiController
{

    public function index()
    {
        $message = null;

        $pacientes = Paciente::all();

        if ($pacientes->isEmpty()) {
            $message = $this->sendError('No hay pacientes registrados', 404);
        }else {
            $message = $this->sendResponse($pacientes, 'Listado de Pacientes');
        }
        
        return $message;
    }


    public function store(PacienteRequest $request)
    {
        $message = null;

        try {
            $paciente = new Paciente;
            $paciente->nombre_mascota = $request->get('nombre_mascota');
            $paciente->tipo_mascota = $request->get('tipo_mascota');
            $paciente->raza_mascota = $request->get('raza_mascota');
            $paciente->nacimiento_mascota = $request->get('nacimiento_mascota');
            $paciente->nombre_propietario = $request->get('nombre_propietario');
            $paciente->apellido_propietario = $request->get('apellido_propietario');
            $paciente->telefono = $request->get('telefono');
            $paciente->direccion = $request->get('direccion');
            $paciente->email = $request->get('email');
            $paciente->save();

            $message = $this->sendResponse($paciente, 'Se ha registrado correctamente el paciente');

        }catch (\Exception $e) {
            $message = $this->sendError($e->getMessage(), ['Error al registrar el paciente']);
        }

        return $message;        
    }


    public function show($id)
    {
        $message = null;

        $paciente = Paciente::find($id);

        if ($paciente === null) {
            $message = $this->sendError('El paciente no existe');
        }else {
            $message = $this->sendResponse($paciente, 'Paciente encontrado correctamente');
        }

        return $message;
    }

    
    public function update(PacienteRequest $request, $id)
    {
        $message = null;

        $paciente = Paciente::find($id);

        if ($paciente === null) {
            $message = $this->sendError('El paciente no existe');
        }else {

            $paciente->nombre_mascota = $request->get('nombre_mascota');
            $paciente->tipo_mascota = $request->get('tipo_mascota');
            $paciente->raza_mascota = $request->get('raza_mascota');
            $paciente->nacimiento_mascota = $request->get('nacimiento_mascota');
            $paciente->nombre_propietario = $request->get('nombre_propietario');
            $paciente->apellido_propietario = $request->get('apellido_propietario');
            $paciente->telefono = $request->get('telefono');
            $paciente->direccion = $request->get('direccion');
            $paciente->email = $request->get('email');
            $paciente->save();

            $message = $this->sendResponse($paciente, 'Paciente actualizado correctamente');
        }

        return $message;
    }

   
    public function destroy($id)
    {
        $message = null;

        $paciente = Paciente::find($id);

        if ($paciente === null) {
            $message = $this->sendError('El paciente no existe');
        }else {
            $paciente->delete();

            $message = $this->sendResponse($paciente, 'Paciente eliminado correctamente');
        }

        return $message;    
    }
}
