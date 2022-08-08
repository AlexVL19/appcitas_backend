<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function addAppointment(Request $request) {

        $fields = $request->validate([
            id_paciente => 'required|integer',
            historial => 'required',
            motivo => 'required|string',
            fecha_cita => 'required|date',
            hora_cita => 'required',
            tipo => 'required|string',
            especificacion => 'string|nullable'
        ]);

        $query = "INSERT INTO appointments(id_paciente, historial, motivo, fecha_cita, hora_cita, tipo, especificacion)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        return DB::connection()->select(DB::raw($query), [$request->id_paciente, $request->historial,
        $request->motivo, $request->fecha_cita, $request->hora_cita, $request->tipo, $request->especificacion]);
    }

    public function deleteAppointment($id) {
        $query = "UPDATE appointments SET status = 0 WHERE id = ?";

        return DB::connection()->select(DB::raw($query), [$id]);
    }

    public function checkAppointments($id) {
        $query = "SELECT * FROM appointments WHERE id_paciente = ? AND status = 1";

        return DB::connection()->select(DB::raw($query), [$id]);
    }
}
