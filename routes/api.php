<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Peticion del MISECE al ECE
//Consulta de expediente por parte del misece
///api/expediente/{curp}
Route::post('/patient', [App\Http\Controllers\MISECEController::class, 'sendexpediente'])->name('api/patient')->middleware('jwtverify');
//Consulta de expediente (resumido) por parte del misece
Route::post('/patient/basic', [App\Http\Controllers\MISECEController::class, 'sendexpedientebasico'])->name('api/patient/basico')->middleware('jwtverify');
//Consulta de expediente (resumido) por parte del misece
Route::post('/update', [App\Http\Controllers\MISECEController::class, 'sendindice'])->name('api/update')->middleware('jwtverify');

