<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\AuthenticatesUsers as Auth;

use App\Http\Controllers\PDFController;
use App\Models\Egi;

use App\Models\Diagnostico;
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
})->name('welcome');

Route::get('/welcome', function () {
    return view('welcome');
})->name('a');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('tenant');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
//Route::get('/configuracion', [App\Http\Controllers\HomeController::class, 'index'])->name('homeconfiguracion');

Route::match(["POST", "GET"], "/setTenant", [App\Http\Controllers\HomeController::class, "setTenant"])->name("setTenant")->middleware('auth');

Route::get('/page404', [App\Http\Controllers\ConsultaController::class, 'page404'])->name('page404')->middleware('tenant');

Route::post('/getdiags', function(Request $request){
    //$diags = Diagnostico::where('active', 1)->where('term', 'LIKE', '%'.$request->term.'%')->get(['id', 'term']);
    $diags = Snomeddescripcion::where('active', 1)->where('category_id', 4)->where('term', 'LIKE', '%'.$request->term.'%')->take(100)->get(['id', 'term']);
    return $diags;
});




/* ECE ADMIN ROUTES */
    //https://medium.com/@sagarmaheshwary31/laravel-multiple-guards-authentication-setup-and-login-2761564da986
    //https://medium.com/@sagarmaheshwary31/laravel-multiple-guards-authentication-middleware-login-throttle-and-password-reset-a822e26f15ac
    //https://magecomp.com/blog/make-admin-auth-in-laravel-8/

    Route::prefix('/eceadmin')->name('eceadmin.')->namespace('App\Http\Controllers\Eceadmin')->group(function(){
        Route::namespace('Auth')->group(function(){
            Route::get('/', function () {
                return redirect()->route('eceadmin.login');
            })->name('eceadmin');

            //login routes
            Route::get('/login', 'LoginController@showLoginForm')->name('login');
            Route::post('/login', 'LoginController@login');
            Route::post('/logout', 'LoginController@logout')->name('logout');
            //Forgot Password Routes
            Route::get('/password/request', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

            //Reset Password Routes
            Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::get('/password/reset', 'ResetPasswordController@reset')->name('password.update');
        });

        Route::get('/inicio', 'HomeController@index')->name('home')->middleware('eceadmin');
        Route::get('/tenants', 'TenantController@index')->name('tenants')->middleware('eceadmin');
        Route::post('/tenantsCheck', 'TenantController@check')->name('tenantsCheck')->middleware('eceadmin');

        Route::get('/tenant/registro', 'TenantController@register')->name('registertenant')->middleware('eceadmin');
        Route::post('/tenant/guardar', 'TenantController@store')->name('storetenant')->middleware('eceadmin');

        Route::post('/medicoCheck', 'TenantController@checkmedico')->name('medicoCheck')->middleware('eceadmin');

        Route::get('/tenant/editar/{id}', 'TenantController@edit')->name('edittenant')->middleware('eceadmin');
        Route::post('/tenant/actualizar/{id}', 'TenantController@update')->name('updatetenant')->middleware('eceadmin');

        Route::get('/tenant/busqueda', 'TenantController@search')->name('searchtenant')->middleware('eceadmin');
        Route::get('/tenant/disable/{id}', 'TenantController@disable')->name('disabletenant')->middleware('eceadmin');
        Route::get('/tenant/enable/{id}', 'TenantController@enable')->name('enabletenant')->middleware('eceadmin');
    });
/* ECE ADMIN ROUTES */

/* TENANT ADMIN ROUTES */
    Route::prefix('/tenantadmin')->name('tenantadmin.')->namespace('App\Http\Controllers\Tenantadmin')->group(function(){
        Route::namespace('Auth')->group(function(){
            Route::get('/', function () {
                return redirect()->route('tenantadmin.login');
            })->name('tenantadmin');

            //login routes
            Route::get('/login', 'LoginController@showLoginForm')->name('login');
            Route::post('/login', 'LoginController@login');
            Route::post('/logout', 'LoginController@logout')->name('logout');
            //Forgot Password Routes
            Route::get('/password/request', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

            //Reset Password Routes
            Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
            Route::get('/password/reset', 'ResetPasswordController@reset')->name('password.update');
        });

        Route::get('/inicio', 'HomeController@index')->name('home')->middleware('tenantadmin');
        Route::get('/medicos', 'MedicoController@index')->name('medicos')->middleware('tenantadmin');

        Route::post('/medicoCheck', 'MedicoController@checkmedico')->name('medicoCheck')->middleware('tenantadmin');
        Route::post('/medicosCheck', 'MedicoController@checkmedicos')->name('medicosCheck')->middleware('tenantadmin');

        Route::get('/medico/registro', 'MedicoController@register')->name('registermedico')->middleware('tenantadmin');
        Route::post('/medico/guardar', 'MedicoController@store')->name('storemedico')->middleware('tenantadmin');

        Route::get('/medico/editar/{id}', 'MedicoController@edit')->name('editmedico')->middleware('tenantadmin');
        Route::post('/medico/actualizar/{id}', 'MedicoController@update')->name('updatemedico')->middleware('tenantadmin');

        Route::get('/medico/busqueda', 'MedicoController@search')->name('searchmedico')->middleware('tenantadmin');
        Route::get('/medico/disable/{id}', 'MedicoController@disable')->name('disablemedico')->middleware('tenantadmin');
        Route::get('/medico/enable/{id}', 'MedicoController@enable')->name('enablemedico')->middleware('tenantadmin');
    });
/* TENANT ADMIN ROUTES */

/* Rutas para el MISECE*/
    //Peticion del MISECE al ECE
    //Consulta de expediente por parte del misece
    ///api/expediente/{curp}
    Route::get('/api/patient', [App\Http\Controllers\MISECEController::class, 'sendexpediente'])->name('api/patient');
    //Consulta de expediente (resumido) por parte del misece
    Route::get('/api/patient/basic', [App\Http\Controllers\MISECEController::class, 'sendexpedientebasico'])->name('api/patient/basico');
    //Consulta de expediente (resumido) por parte del misece
    Route::get('/api/update', [App\Http\Controllers\MISECEController::class, 'sendindice'])->name('api/update');

    //Peticion del ECE al MISECE
    //Peticion de codigo para consulta (paciente msg?)
    Route::post('/pacienteconsulta/{curp}', [App\Http\Controllers\MISECEController::class, 'consultaece'])->name('pacienteconsulta')->middleware('tenant');
    //Consulta de ece al misece sin codigo, pide codigo
    Route::post('/expedienteece', [App\Http\Controllers\MISECEController::class, 'expece'])->name('expedienteece')->middleware('tenant');
    //Consulta basico de ece al misece
    Route::post('/expedienteecebasico', [App\Http\Controllers\MISECEController::class, 'expecebasico'])->name('expedienteecebasico')->middleware('tenant');

    //Pagina para Consulta (vista) MISECE ece-misece (con curp)
    Route::get('/misece', [App\Http\Controllers\MISECEController::class, 'consultarmisece'])->name('misece')->middleware('tenant');
/**/


//Consultas del paciente
//Route::get('/consultas/{id}', [App\Http\Controllers\ConsultaController::class, 'index'])->name('consultas')->middleware('tenant');
//Consultad del medico
Route::get('/consultamedico', [App\Http\Controllers\ConsultaController::class, 'medico'])->name('consultamedico')->middleware('tenant');
//Seleccionar paciente al cual realizar la consulta
Route::get('/seleccionarpaciente', [App\Http\Controllers\ConsultaController::class, 'pacientes'])->name('seleccionarpaciente')->middleware('tenant');
//Busqueda de consulta (medico)
Route::get('/searchconsultamedico', [App\Http\Controllers\ConsultaController::class, 'searchconsulta'])->name('searchconsultamedico')->middleware('tenant');
//Busqueda de paciente
Route::get('/searchpacienteseleccion', [App\Http\Controllers\ConsultaController::class, 'searchpaciente'])->name('searchpacienteseleccion')->middleware('tenant');
//Registro de paciente desde seleccion de paciente en creacion de nueva consulta
Route::get('/registrarpaciente', [App\Http\Controllers\ConsultaController::class, 'createpacienteConsulta'])->name('createpacfromcons')->middleware('tenant');
//Store de paciente -> continua consulta
Route::post('/storepacienteconsulta', [App\Http\Controllers\ConsultaController::class, 'storepaciente'])->name('storepacienteconsulta')->middleware('tenant');

//Registro de consultas (nuevas consultas)
Route::get('/registrarconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'registrar'])->name('registrarconsulta')->middleware('tenant');
//Se guarda la consulta
Route::post('/storeconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'store'])->name('storeconsulta')->middleware('tenant');
//Consulta por embarazo
Route::post('/storepregnantconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'storepregnant'])->name('storepregnantconsulta')->middleware('tenant');
//Se actualiza la consulta
Route::post('/updateconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'update'])->name('updateconsulta')->middleware('tenant');
//Actualizar consulta embarazo
Route::post('/updatepregnantconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'updatepregnant'])->name('updatepregnantconsulta')->middleware('tenant');
//Vista de la consulta
Route::get('/viewconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'view'])->name('viewconsulta')->middleware('tenant');
//Firmar
Route::post('/finishconsulta', [App\Http\Controllers\ConsultaController::class, 'terminarConsulta'])->name('finishconsulta')->middleware('tenant');
//Continuar la consulta
Route::get('/continuarconsulta/{id}', [App\Http\Controllers\ConsultaController::class, 'continuar'])->name('continuarconsulta')->middleware('tenant');
//Terminar la consulta
Route::get('/terminarConsulta', [App\Http\Controllers\ConsultaController::class, 'finishsuccess'])->name('terminarConsulta')->middleware('tenant');
//Revisar si el usuario tiene notificaciones 
Route::post('/notificationsCheck', [App\Http\Controllers\ConsultaController::class, 'notifications'])->name('notificationsCheck')->middleware('tenant');
//Se transcribe de voz a texto
Route::post('/transcriptspeech', [App\Http\Controllers\ConsultaController::class, 'transcript'])->name('transcriptspeech')->middleware('tenant');
//Get files from archivos
Route::get('/resultfile/{filename}', [App\Http\Controllers\ConsultaController::class, 'downloadfiles'])->name('resultfile')->middleware('tenant');


//For test purposes
Route::get('/getconsulta', [App\Http\Controllers\ConsultaController::class, 'getconsulta'])->name('getconsulta');
Route::get('/testfunc', [App\Http\Controllers\ConsultaController::class, 'test'])->name('testfunc');
Route::get('/deletesession', [App\Http\Controllers\ConsultaController::class, 'deletesession'])->name('deletesession');
Route::get('/sessionone', [App\Http\Controllers\ConsultaController::class, 'sessionone'])->name('sessionone');


//Interrogatorio
Route::post('/storeinterrogatorio', [App\Http\Controllers\InterrogatorioController::class, 'store'])->name('storeinterrogatorio')->middleware('tenant');
Route::post('/updateinterrogatorio', [App\Http\Controllers\InterrogatorioController::class, 'update'])->name('updateinterrogatorio')->middleware('tenant');
//AntecedentesHF
Route::post('/storeantecedenteshf', [App\Http\Controllers\InterrogatorioController::class, 'storeantehf'])->name('storeantecedenteshf')->middleware('tenant');
Route::post('/updateantecedenteshf', [App\Http\Controllers\InterrogatorioController::class, 'updateantehf'])->name('updateantecedenteshf')->middleware('tenant');
//AntecedentesPP
Route::post('/storeantecedentespp', [App\Http\Controllers\InterrogatorioController::class, 'storeantepp'])->name('storeantecedentespp')->middleware('tenant');
Route::post('/updateantecedentespp', [App\Http\Controllers\InterrogatorioController::class, 'updateantepp'])->name('updateantecedentespp')->middleware('tenant');
//AntecedentesPNP
Route::post('/storeantecedentespnp', [App\Http\Controllers\InterrogatorioController::class, 'storeantepnp'])->name('storeantecedentespnp')->middleware('tenant');
Route::post('/updateantecedentespnp', [App\Http\Controllers\InterrogatorioController::class, 'updateantepnp'])->name('updateantecedentespnp')->middleware('tenant');
//AntecedentesPNP
Route::post('/storeaparatos', [App\Http\Controllers\InterrogatorioController::class, 'storeaparatos'])->name('storeaparatos')->middleware('tenant');
Route::post('/updateaparatos', [App\Http\Controllers\InterrogatorioController::class, 'updateaparatos'])->name('updateaparatos')->middleware('tenant');


//Exploracion Fisica
Route::post('/storeexploracion', [App\Http\Controllers\ExploracionController::class, 'store'])->name('storeexploracion')->middleware('tenant');
Route::post('/updateexploracion', [App\Http\Controllers\ExploracionController::class, 'update'])->name('updateexploracion')->middleware('tenant');
//Exploracion Fisica - signos vitales
Route::post('/storesignos', [App\Http\Controllers\ExploracionController::class, 'storesignos'])->name('storesignos')->middleware('tenant');
Route::post('/updatesignos', [App\Http\Controllers\ExploracionController::class, 'updatesignos'])->name('updatesignos')->middleware('tenant');


//Pacientes
Route::resource('pacientes', App\Http\Controllers\PacienteController::class)->middleware('tenant');
//Select o droplist en pacientes
Route::get('/select_municipio/{entidad_id}', [App\Http\Controllers\PacienteController::class,'buscaMunicipio'])->name('buscaMunicipio');

//Tamizaje
Route::resource('tamizajes', App\Http\Controllers\TamizajeController::class)->middleware('tenant');

//Modulo 1 EGI
Route::get('/indexPaciente', [App\Http\Controllers\EgiController::class, 'indexPaciente'])->name('indexPaciente')->middleware('tenant');
Route::get('/create/{id}', [App\Http\Controllers\EgiController::class, 'create'])->name('create')->middleware('tenant');
Route::resource('egis', App\Http\Controllers\EgiController::class)->middleware('tenant');
Route::resource('datossociodemograficos', App\Http\Controllers\DatossociodemograficoController::class)->middleware('tenant');
Route::resource('antecedentesmedicos', App\Http\Controllers\AntecedentesmedicoController::class)->middleware('tenant');
Route::resource('percepcionsaluds', App\Http\Controllers\PercepcionsaludController::class)->middleware('tenant');
Route::resource('frailsarcfs', App\Http\Controllers\FrailsarcfController::class)->middleware('tenant');

//Vacunas
Route::resource('vacunas', App\Http\Controllers\VacunaController::class)->middleware('tenant');
//Route::resource('pacientevacunas', App\Http\Controllers\PacientevacunaController::class)->middleware('tenant');

//Medicamentos
Route::resource('laboratoriofarmaceuticos', App\Http\Controllers\LaboratoriofarmaceuticoController::class)->middleware('tenant');
Route::resource('grupomedicamentos', App\Http\Controllers\GrupomedicamentoController::class)->middleware('tenant');
Route::resource('medicamentos', App\Http\Controllers\MedicamentoController::class)->middleware('tenant');
Route::resource('sustanciaactivas', App\Http\Controllers\SustanciaactivaController::class)->middleware('tenant');
Route::resource('sustanciaformas', App\Http\Controllers\SustanciaformaController::class)->middleware('tenant');
Route::resource('formafarmaceuticas', App\Http\Controllers\FormafarmaceuticaController::class)->middleware('tenant');
Route::resource('etapadesarrollos', App\Http\Controllers\EtapadesarrolloController::class)->middleware('tenant');
Route::resource('dosis', App\Http\Controllers\DosiController::class)->middleware('tenant');
Route::resource('viaadministracions', App\Http\Controllers\ViaadministracionController::class)->middleware('tenant');
Route::resource('pacientemedicamentos', App\Http\Controllers\PacientemedicamentoController::class)->middleware('tenant');

//Modulo 2 EGI
Route::resource('testyesavages', App\Http\Controllers\TestyesavageController::class)->middleware('tenant');
Route::resource('indicebarthels', App\Http\Controllers\IndicebarthelController::class)->middleware('tenant');
Route::resource('indicelawtons', App\Http\Controllers\IndicelawtonController::class)->middleware('tenant');
Route::resource('agudezavisualauditivas', App\Http\Controllers\AgudezavisualauditivaController::class)->middleware('tenant');
//Route::resource('s', App\Http\Controllers\Controller::class)->middleware('tenant');

//Rutas para acceder a los catálogos
Route::resource('sexos', App\Http\Controllers\SexoController::class)->middleware('tenant');
Route::resource('indigenas', App\Http\Controllers\IndigenaController::class)->middleware('tenant');
Route::resource('afromexicanos', App\Http\Controllers\AfromexicanoController::class)->middleware('tenant');
Route::resource('generos', App\Http\Controllers\GeneroController::class)->middleware('tenant');
Route::resource('gruposanguineos', App\Http\Controllers\GruposanguineoController::class)->middleware('tenant');
Route::resource('derechohabiencias', App\Http\Controllers\DerechohabienciaController::class)->middleware('tenant');
Route::resource('programasmymgs', App\Http\Controllers\ProgramasmymgController::class)->middleware('tenant');
Route::resource('geriatriaproyectos', App\Http\Controllers\GeriatriaproyectoController::class)->middleware('tenant');
Route::resource('entidadesfederativas', App\Http\Controllers\EntidadesfederativaController::class)->middleware('tenant');
Route::resource('municipios', App\Http\Controllers\MunicipioController::class)->middleware('tenant');

//Ruta para generar PDF
Route::get('/egi/pdf/{id}', [App\Http\Controllers\EgiController::class, 'createPDF'])->name('createPDF')->middleware('tenant');
Route::get('/egi/xls', [App\Http\Controllers\EgiController::class, 'createXlsx'])->name('createXlsx')->middleware('tenant');

Route::any('{url}', function(){
    return redirect('/page404');
})->where('url', '.*');