<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConfigController;

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

Route::controller(PatientController::class)->group(function () {

    Route::get('/patients','showPatients');

    Route::post('/addPatient', 'addPatients');

    Route::put('/deletePatient/{id}', 'deletePatients');

    Route::put('/editPatient/{id}', 'editPatients');
});

/* --------------------------------------------------------------------------- */

Route::controller(AppointmentController::class)->group(function () {
    
    Route::post('/addAppoint', 'addAppointment');

    Route::put('/deleteAppoint/{id}', 'deleteAppointment');

    Route::get('/checkAppoints/{id}', 'checkAppointments');
});

/* --------------------------------------------------------------------------- */

Route::get('/getHours', [ConfigController::class, 'showConfig']);
