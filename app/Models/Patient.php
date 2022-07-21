<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        tipo_documento,
        documento,
        nombre1,
        nombre2,
        apellido1,
        apellido2,
        tel1,
        tel2,
        direccion,
        tipo_sangre,
        fecha_nac,
        edad,
        eps
    ];
}
