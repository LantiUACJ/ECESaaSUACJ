<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PDFController;
use App\Models\Egi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/configuracion', [App\Http\Controllers\HomeController::class, 'index'])->name('homeconfiguracion');

Route::get('/page404', [App\Http\Controllers\ConsultaController::class, 'page404'])->name('page404')->middleware('auth');

//Consulta Test
//Consultas del paciente
Route::get('/consultas/{id}', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consultas')->middleware('auth');
//Consultad del medico
Route::get('/consultamedico', [App\Http\Controllers\ConsultaController::class, 'medico'])->name('consultamedico')->middleware('auth');
//Seleccionar paciente al cual realizar la consulta
Route::get('/seleccionarpaciente', [App\Http\Controllers\ConsultaController::class, 'pacientes'])->name('seleccionarpaciente')->middleware('auth');
//Busqueda de consulta (medico)
Route::get('/searchconsultamedico', [App\Http\Controllers\ConsultaController::class, 'searchmedico'])->name('searchconsultamedico')->middleware('auth');
//Busqueda de paciente
Route::get('/searchpacientemedico', [App\Http\Controllers\ConsultaController::class, 'searchpacientemedico'])->name('searchpacientemedico')->middleware('auth');

//Registro de consultas (nuevas consultas)
Route::get('/registrarconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'registrar'])->name('registrarconsulta')->middleware('auth');
//Se guarda la consulta
Route::post('/storeconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'store'])->name('storeconsulta')->middleware('auth');
//Se actualiza la consulta
Route::post('/updateconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'update'])->name('updateconsulta')->middleware('auth');
//Vista de la consulta
Route::get('/viewconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'view'])->name('viewconsulta')->middleware('auth');
//Continuar la consulta
Route::get('/continuarconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'continuar'])->name('continuarconsulta')->middleware('auth');
//Terminar la consulta
Route::get('/terminarConsulta', [App\Http\Controllers\ConsultaController::class, 'terminarConsulta'])->name('terminarConsulta')->middleware('auth');
//Revisar si el usuario tiene notificaciones 
Route::post('/notificationsCheck', [App\Http\Controllers\ConsultaController::class, 'notifications'])->name('notificationsCheck')->middleware('auth');

//For test purposes
Route::get('/getconsulta', [App\Http\Controllers\ConsultaController::class, 'getconsulta'])->name('getconsulta');
Route::get('/testfunc', [App\Http\Controllers\ConsultaController::class, 'test'])->name('testfunc');
Route::get('/deletesession', [App\Http\Controllers\ConsultaController::class, 'deletesession'])->name('deletesession');
Route::get('/sessionone', [App\Http\Controllers\ConsultaController::class, 'sessionone'])->name('sessionone');

//Interrogatorio
Route::post('/storeinterrogatorio', [App\Http\Controllers\InterrogatorioController::class, 'store'])->name('storeinterrogatorio')->middleware('auth');
Route::post('/updateinterrogatorio', [App\Http\Controllers\InterrogatorioController::class, 'update'])->name('updateinterrogatorio')->middleware('auth');
//AntecedentesHF
Route::post('/storeantecedenteshf', [App\Http\Controllers\InterrogatorioController::class, 'storeantehf'])->name('storeantecedenteshf')->middleware('auth');
Route::post('/updateantecedenteshf', [App\Http\Controllers\InterrogatorioController::class, 'updateantehf'])->name('updateantecedenteshf')->middleware('auth');
//AntecedentesPP
Route::post('/storeantecedentespp', [App\Http\Controllers\InterrogatorioController::class, 'storeantepp'])->name('storeantecedentespp')->middleware('auth');
Route::post('/updateantecedentespp', [App\Http\Controllers\InterrogatorioController::class, 'updateantepp'])->name('updateantecedentespp')->middleware('auth');
//AntecedentesPNP
Route::post('/storeantecedentespnp', [App\Http\Controllers\InterrogatorioController::class, 'storeantepnp'])->name('storeantecedentespnp')->middleware('auth');
Route::post('/updateantecedentespnp', [App\Http\Controllers\InterrogatorioController::class, 'updateantepnp'])->name('updateantecedentespnp')->middleware('auth');
//AntecedentesPNP
Route::post('/storeaparatos', [App\Http\Controllers\InterrogatorioController::class, 'storeaparatos'])->name('storeaparatos')->middleware('auth');
Route::post('/updateaparatos', [App\Http\Controllers\InterrogatorioController::class, 'updateaparatos'])->name('updateaparatos')->middleware('auth');


//Exploracion Fisica
Route::post('/storeexploracion', [App\Http\Controllers\ExploracionController::class, 'store'])->name('storeexploracion')->middleware('auth');
Route::post('/updateexploracion', [App\Http\Controllers\ExploracionController::class, 'update'])->name('updateexploracion')->middleware('auth');
//Exploracion Fisica - signos vitales
Route::post('/storesignos', [App\Http\Controllers\ExploracionController::class, 'storesignos'])->name('storesignos')->middleware('auth');
Route::post('/updatesignos', [App\Http\Controllers\ExploracionController::class, 'updatesignos'])->name('updatesignos')->middleware('auth');


//Pacientes
Route::resource('pacientes', App\Http\Controllers\PacienteController::class)->middleware('auth');
//Select o droplist en pacientes
Route::get('/select_municipio/{entidad_id}', [App\Http\Controllers\PacienteController::class,'buscaMunicipio'])->name('buscaMunicipio');

//Rutas para acceder a los catálogos
Route::resource('sexos', App\Http\Controllers\SexoController::class)->middleware('auth');