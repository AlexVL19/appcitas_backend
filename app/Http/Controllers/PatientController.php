<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class PatientController extends Controller
{
    //Selecciona a todos los pacientes, mientras que su estado sea 1, es decir, que todavía está activo.
    public function showPatients() {
        $query = "SELECT * FROM patients WHERE status = 1";

        return DB::connection()->select(DB::raw($query));
    }

    /* Añade los siguientes campos a la tabla de pacientes, con una capa extra de validación. Toma todos los datos
     * del formulario del lado del frontend, valida y luego hace la consulta */
    public function addPatients(Request $request) {

        $fields = $request->validate([
            'tipo_documento' => 'required|string',
            'documento' => 'required|regex:/^[0-9\s]*$/|unique:patients,documento',
            'nombre1' => 'required|string',
            'nombre2' => 'string|nullable',
            'apellido1' => 'required|string',
            'apellido2' => 'string|nullable',
            'tel1' => 'required|regex:/^[0-9\s]*$/',
            'tel2' => 'nullable|regex:/^[0-9\s]*$/',
            'correo' => 'required|string',
            'direccion' => 'required|string',
            'tipo_sangre' => 'required|string',
            'fecha_nac' => 'required|date',
            'edad' => 'required|regex:/^[0-9\s]*$/',
            'eps' => 'required|string'
        ]);

        $query = "INSERT INTO patients
        (tipo_documento, documento, nombre1, nombre2, apellido1, apellido2, tel1, tel2, correo, direccion,
        tipo_sangre, fecha_nac, edad, eps)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        return DB::connection()->select(DB::raw($query), [$request->tipo_documento, $request->documento, $request->nombre1, $request->nombre2, $request->apellido1, $request->apellido2,
        $request->tel1, $request->tel2, $request->correo, $request->direccion, $request->tipo_sangre, $request->fecha_nac, $request->edad, $request->eps]);
    }

    /* Cambia el estado de los pacientes a 0, es decir, que está desactivado. Toma el ID del paciente y hace
     * una consulta, la cual permite elegir al paciente para poder desactivarlo. Devuelve la conexión exitosa.
     */
    public function deletePatients($id) {
        $query = "UPDATE patients SET status = 0 WHERE id = ?";

        return DB::connection()->select(DB::raw($query), [$id]);
    }

    /* Actualiza a un paciente modificando valores de campos ya existentes, toma el formulario desde el lado del
     * backend, y la ID del paciente que va a ser editado, y se actualiza campo a campo con los nuevos valores. */
    public function editPatients(Request $request, $id) {

        $fields = $request->validate([
            'tipo_documento' => 'required|string',
            'nombre1' => 'required|string',
            'nombre2' => 'string|nullable',
            'apellido1' => 'required|string',
            'apellido2' => 'string|nullable',
            'tel1' => 'required|regex:/^[0-9\s]*$/',
            'tel2' => 'nullable|regex:/^[0-9\s]*$/',
            'correo' => 'required|string',
            'direccion' => 'required|string',
            'tipo_sangre' => 'required|string',
            'fecha_nac' => 'required|date',
            'edad' => 'required|regex:/^[0-9\s]*$/',
            'eps' => 'required|string'
        ]);

        $query = "UPDATE patients SET tipo_documento = ?, nombre1 = ?, nombre2 = ?,
        apellido1 = ?, apellido2 = ?, tel1 = ?, tel2 = ?, correo = ?, direccion = ?, tipo_sangre = ?, fecha_nac = ?,
        edad = ?, eps = ? WHERE id = ?";

        return DB::connection()->select(DB::raw($query), [$request->tipo_documento, $request->nombre1, $request->nombre2, $request->apellido1, $request->apellido2,
        $request->tel1, $request->tel2, $request->correo, $request->direccion, $request->tipo_sangre, $request->fecha_nac, $request->edad, $request->eps, $id]);
    }
}
