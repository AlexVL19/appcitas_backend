<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Config;

class ConfigController extends Controller
{
    //Selecciona todas las configuraciones existentes.
    public function showConfig() {
        $query = "SELECT * FROM configs";

        return DB::connection()->select(DB::raw($query));
    }
}
