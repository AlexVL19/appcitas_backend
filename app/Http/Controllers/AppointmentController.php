<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    /* Añade una citación a la tabla, con el formulario que se trae desde el frontend; se valida y posteriormente
     * se hace una consulta con ese objeto. Después de ello trae una conexión exitosa o un error. */
    public function addAppointment(Request $request) {

        $fields = $request->validate([
            'id_paciente' => 'required|integer',
            'historial' => 'required',
            'motivo' => 'required|string',
            'fecha_cita' => 'required|date',
            'hora_cita' => 'required',
            'tipo' => 'required|string',
            'especificacion' => 'string|nullable'
        ]);

        $query = "INSERT INTO appointments(id_paciente, historial, motivo, fecha_cita, hora_cita, tipo, especificacion)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        return DB::connection()->select(DB::raw($query), [$request->id_paciente, $request->historial,
        $request->motivo, $request->fecha_cita, $request->hora_cita, $request->tipo, $request->especificacion]);
    }

    //Borra una citación de la tabla, cambiando su estado de 1 a 0, indicando que ya se terminó esa citación
    public function deleteAppointment($id) {
        $query = "UPDATE appointments SET status = 0 WHERE id = ?";

        return DB::connection()->select(DB::raw($query), [$id]);
    }

    /* Permite traer todas las citaciones en función del ID del paciente y su estado actual, trayendo como resultado
     * Las citaciones que todavía están vigentes. */
    public function checkAppointments($id) {
        $query = "SELECT * FROM appointments WHERE id_paciente = ? AND status = 1";

        return DB::connection()->select(DB::raw($query), [$id]);
    }
}
