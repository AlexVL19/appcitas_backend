<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;

class PatientController extends Controller
{
    public function showPatients() {
        $query = "SELECT * FROM patients WHERE status = 1";

        return DB::connection()->select(DB::raw($query));
    }


    public function addPatients(Request $request) {
        $query = "INSERT INTO patients
        (tipo_documento, documento, nombre1, nombre2, apellido1, apellido2, tel1, tel2, correo, direccion,
        tipo_sangre, fecha_nac, edad, eps)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        return DB::connection()->select(DB::raw($query), [$request->tipo_documento, $request->documento, $request->nombre1, $request->nombre2, $request->apellido1, $request->apellido2,
        $request->tel1, $request->tel2, $request->correo, $request->direccion, $request->tipo_sangre, $request->fecha_nac, $request->edad, $request->eps]);
    }


    public function deletePatients($id) {
        $query = "UPDATE patients SET status = 0 WHERE id = ?";

        return DB::connection()->select(DB::raw($query), [$id]);
    }


    public function editPatients(Request $request, $id) {
        $query = "UPDATE patients SET tipo_documento = ?, nombre1 = ?, nombre2 = ?,
        apellido1 = ?, apellido2 = ?, tel1 = ?, tel2 = ?, correo = ?, direccion = ?, tipo_sangre = ?, fecha_nac = ?,
        edad = ?, eps = ? WHERE id = ?";

        return DB::connection()->select(DB::raw($query), [$request->tipo_documento, $request->nombre1, $request->nombre2, $request->apellido1, $request->apellido2,
        $request->tel1, $request->tel2, $request->correo, $request->direccion, $request->tipo_sangre, $request->fecha_nac, $request->edad, $request->eps, $id]);
    }
}
