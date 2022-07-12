<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\AuthenticatesUsers as Auth;

use App\Http\Controllers\PDFController;
use App\Models\Egi;

use App\Models\Snomeddescripcion;

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

Route::post('/getdiags', function(Request $request){
    $diags = Snomeddescripcion::where('active', 1)->where('category_id', 4)->where('term', 'LIKE', '%'.$request->term.'%')->get(['id', 'term']);
    return $diags;
});


//Peticion del MISECE al ECE
//Consulta de expediente por parte del misece
Route::post('/expediente/{curp}', [App\Http\Controllers\MISECEController::class, 'sendexpediente'])->name('expediente');
//Consulta de expediente (resumido) por parte del misece
Route::post('/expediente/basico/{curp}', [App\Http\Controllers\MISECEController::class, 'sendexpedientebasico'])->name('expediente/basico');
//Consulta de expediente (resumido) por parte del misece
Route::get('/indice', [App\Http\Controllers\MISECEController::class, 'sendindice'])->name('indice');

//Peticion del ECE al MISECE
//Peticion de codigo para consulta (paciente msg?)
Route::post('/pacienteconsulta/{curp}', [App\Http\Controllers\MISECEController::class, 'consultaece'])->name('pacienteconsulta')->middleware('auth');


//Consulta de ece al misece sin codigo, pide codigo
Route::post('/expedienteece', [App\Http\Controllers\MISECEController::class, 'expece'])->name('expedienteece')->middleware('auth');
//Consulta basico de ece al misece
Route::post('/expedienteecebasico', [App\Http\Controllers\MISECEController::class, 'expecebasico'])->name('expedienteecebasico')->middleware('auth');


//Pagina para Consulta MISECE ece-misece (con curp)
Route::get('/misece', [App\Http\Controllers\MISECEController::class, 'consultarmisece'])->name('misece')->middleware('auth');


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
//Registro de paciente desde seleccion de paciente en creacion de nueva consulta
Route::get('/createpacfromcons', [App\Http\Controllers\ConsultaController::class, 'createpacienteConsulta'])->name('createpacfromcons')->middleware('auth');
//Store de paciente -> continua consulta
Route::post('/storepacienteconsulta', [App\Http\Controllers\ConsultaController::class, 'storepaciente'])->name('storepacienteconsulta')->middleware('auth');

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
//Se transcribe de voz a texto
Route::post('/transcriptspeech', [App\Http\Controllers\ConsultaController::class, 'transcript'])->name('transcriptspeech')->middleware('auth');
//Get files from archivos
Route::get('/resultfile/{filename}', [App\Http\Controllers\ConsultaController::class, 'downloadfiles'])->name('resultfile')->middleware('auth');


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

//Tamizaje
Route::resource('tamizajes', App\Http\Controllers\TamizajeController::class)->middleware('auth');

//Modulo 1 EGI
Route::get('/indexPaciente', [App\Http\Controllers\EgiController::class, 'indexPaciente'])->name('indexPaciente')->middleware('auth');
Route::get('/create/{id}', [App\Http\Controllers\EgiController::class, 'create'])->name('create')->middleware('auth');
Route::resource('egis', App\Http\Controllers\EgiController::class)->middleware('auth');
Route::resource('datossociodemograficos', App\Http\Controllers\DatossociodemograficoController::class)->middleware('auth');
Route::resource('antecedentesmedicos', App\Http\Controllers\AntecedentesmedicoController::class)->middleware('auth');
Route::resource('percepcionsaluds', App\Http\Controllers\PercepcionsaludController::class)->middleware('auth');
Route::resource('frailsarcfs', App\Http\Controllers\FrailsarcfController::class)->middleware('auth');

//Vacunas
Route::resource('vacunas', App\Http\Controllers\VacunaController::class)->middleware('auth');
//Route::resource('pacientevacunas', App\Http\Controllers\PacientevacunaController::class)->middleware('auth');

//Medicamentos
Route::resource('laboratoriofarmaceuticos', App\Http\Controllers\LaboratoriofarmaceuticoController::class)->middleware('auth');
Route::resource('grupomedicamentos', App\Http\Controllers\GrupomedicamentoController::class)->middleware('auth');
Route::resource('medicamentos', App\Http\Controllers\MedicamentoController::class)->middleware('auth');
Route::resource('sustanciaactivas', App\Http\Controllers\SustanciaactivaController::class)->middleware('auth');
Route::resource('sustanciaformas', App\Http\Controllers\SustanciaformaController::class)->middleware('auth');
Route::resource('formafarmaceuticas', App\Http\Controllers\FormafarmaceuticaController::class)->middleware('auth');
Route::resource('etapadesarrollos', App\Http\Controllers\EtapadesarrolloController::class)->middleware('auth');
Route::resource('dosis', App\Http\Controllers\DosiController::class)->middleware('auth');
Route::resource('viaadministracions', App\Http\Controllers\ViaadministracionController::class)->middleware('auth');
Route::resource('pacientemedicamentos', App\Http\Controllers\PacientemedicamentoController::class)->middleware('auth');

//Modulo 2 EGI
Route::resource('testyesavages', App\Http\Controllers\TestyesavageController::class)->middleware('auth');
Route::resource('indicebarthels', App\Http\Controllers\IndicebarthelController::class)->middleware('auth');
Route::resource('indicelawtons', App\Http\Controllers\IndicelawtonController::class)->middleware('auth');
Route::resource('agudezavisualauditivas', App\Http\Controllers\AgudezavisualauditivaController::class)->middleware('auth');
//Route::resource('s', App\Http\Controllers\Controller::class)->middleware('auth');

//Rutas para acceder a los catálogos
Route::resource('sexos', App\Http\Controllers\SexoController::class)->middleware('auth');
Route::resource('geriatriaproyectos', App\Http\Controllers\GeriatriaproyectoController::class)->middleware('auth');

//Ruta para generar PDF
Route::get('/egi/pdf/{id}', [App\Http\Controllers\EgiController::class, 'createPDF'])->name('createPDF')->middleware('auth');
Route::get('/egi/xls', [App\Http\Controllers\EgiController::class, 'createXlsx'])->name('createXlsx')->middleware('auth');