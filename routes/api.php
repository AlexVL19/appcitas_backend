<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/patients', [PatientController::class, 'showPatients']);

Route::post('/addPatient', [PatientController::class, 'addPatients']);

Route::put('/deletePatient/{id}', [PatientController::class, 'deletePatients']);

Route::put('/editPatient/{id}', [PatientController::class, 'editPatients']);

/* --------------------------------------------------------------------------- */

Route::post('/addAppoint', [AppointmentController::class, 'addAppointment']);

Route::put('/deleteAppoint/{id}', [AppointmentController::class, 'deleteAppointment']);

Route::get('/checkAppoints/{id}', [AppointmentController::class, 'checkAppointments']);
