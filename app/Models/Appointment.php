<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        id_paciente,
        historial,
        motivo,
        fecha_cita,
        hora_cita,
        tipo
    ];
}
