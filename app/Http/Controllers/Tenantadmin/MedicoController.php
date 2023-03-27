<?php

namespace App\Http\Controllers\Tenantadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\tenant;
use App\Models\userstenant;
use App\Models\Tenantadmin;
use App\Models\User;
use Auth;

class MedicoController extends Controller
{
    public function index(){
        $medicos = Auth::guard('tenantadmin')->user()->tenant->userstenants->paginate('15');
        session(['menunav' => "medicos"]);
        return view('tenantadmin.medicos.index', ['medicos' => $medicos, 'search' => false]);
    }

    public function check(){
        if(Auth::guard('tenantadmin')->user()){
            $medicos = Auth::guard('tenantadmin')->user()->tenant->userstenants;
            return $medicos->count();
        }
        return -1;
    }

    public function register(){
        return view('tenantadmin.medicos.register');
    }

    public function store(Request $request){
        $validated = $request->validate([  
            'medtype' => 'required',

            'usercurp1' => 'required_if:medtype,1',

            'usercurp' => 'required_if:medtype,2|max:18',
            'usercedula' => 'required_if:medtype,2|max:8|unique:App\Models\User,cedula',
            'userphone' => 'required_if:medtype,2|max:10',
            'usernombre' => 'required_if:medtype,2|max:255',
            'userprimerApellido' => 'required_if:medtype,2|max:255',
            'usersegundoApellido' => 'required_if:medtype,2|max:255',
            'useremail' => 'required_if:medtype,2|max:255|unique:App\Models\User,email',
            'userpassword' => 'required_if:medtype,2|:min:4|max:255',
        ],[
            'medtype.required' => 'Introduce la curp y realiza la consulta para continuar.',
            'usercurp1.required_if' => 'La Curp del Médico es obligatoria.',

            'usercurp.required_if' => 'El campo Curp Médico es obligatorio',
            'usercedula.required_if' => 'El campo Cédula es obligatorio',
            'userphone.required_if' => 'El campo Número de Teléfono es obligatorio',
            'usernombre.required_if' => 'El campo Nombre es obligatorio',
            'userprimerApellido.required_if' => 'El campo Primer Apellido es obligatorio',
            'usersegundoApellido.required_if' => 'El campo Segundo Apellido es obligatorio',
            'useremail.required_if' => 'El campo Correo es obligatorio',
            'userpassword.required_if' => 'El campo Contraseña es obligatorio',
            'useremail.unique' => 'El valor del campo Correo ya esta en uso.',
            'usercedula.unique' => 'El valor del campo Cédula ya esta en uso.',
        ]);
        //dd($request->all());

        $result = false;

        if($request->medtype == 1){// ya existe solo se liga.
            $dbuser = User::where('curp', $request->usercurp1)->first();
            if($dbuser !== null){
                $usertenant = userstenant::where('user_id', $dbuser->id)->where('tenant_id', Auth::guard('tenantadmin')->user()->tenant_id)->first();
                if($usertenant == null){
                    $result = DB::table("usersTenants")->insert([
                        "user_id" => $dbuser->id,
                        "tenant_id" => Auth::guard('tenantadmin')->user()->tenant_id
                    ]);
                    
                    return redirect(route('tenantadmin.medicos'))->with('successMsg', 'Médico ligado con éxito');
                }
            }else{
                return redirect(route('eceadmin.tenants'))->with('errorMsg', 'Ocurrio un error al ligar el Médico.');
            }
        }else if($request->medtype == 2){
            $dbuser = User::where('curp', $request->usercurp)->first();
            if($dbuser == null){ //no existe, registramos
                $user = new User;
                $user->tenantCreator_id = Auth::guard('tenantadmin')->user()->tenant_id;
                $user->curp = $request->usercurp;
                $user->cedula = $request->usercedula;
                $user->phone = $request->userphone;
                $user->name = $request->usernombre;
                $user->primerApellido = $request->userprimerApellido;
                $user->segundoApellido = $request->usersegundoApellido;
                $user->email = $request->useremail;
                $user->password = Hash::make($request->userpassword);
                $user->save();
    
                $result = DB::table("usersTenants")->insert([
                    "user_id" => $user->id,
                    "tenant_id" => Auth::guard('tenantadmin')->user()->tenant_id
                ]);
            }
        }

        if($result){
            return redirect(route('tenantadmin.medicos'))->with('successMsg', 'Médico Creado con éxito');
        }else{
            return redirect(route('tenantadmin.medicos'))->with('errorMsg', 'Ocurrio un error al guardar el médico.');
        } 

    }

    public function edit($id){
        $medico = User::findOrFail($id);
        return view('tenantadmin.medicos.edit', ['medico' => $medico]);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'usercurp' => [
                'required',
                'max:18',
                Rule::unique('users', 'curp')->ignore($id),
            ],
            'usercedula' => [
                'required',
                'max:8',
                Rule::unique('users', 'cedula')->ignore($id),
            ],
            'userphone' => 'required|max:10',
            'usernombre' => 'required|max:255',
            'userprimerApellido' => 'required|max:255',
            'usersegundoApellido' => 'required|max:255',
            'useremail' => [
                'required',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'userpassword' => 'nullable|:min:4|max:255',
        ],[
            'usercurp.required' => 'El campo Curp Médico es obligatorio',
            'usercedula.required' => 'El campo Cédula es obligatorio',
            'userphone.required' => 'El campo Número de Teléfono es obligatorio',
            'usernombre.required' => 'El campo Nombre es obligatorio',
            'userprimerApellido.required' => 'El campo Primer Apellido es obligatorio',
            'usersegundoApellido.required' => 'El campo Segundo Apellido es obligatorio',
            'useremail.required' => 'El campo Correo es obligatorio',
            'useremail.unique' => 'El valor del campo Correo ya esta en uso.',
            'usercedula.unique' => 'El valor del campo Cédula ya esta en uso.',
        ]);
        //dd($request->all());
        
        $user = User::findOrFail($id);
        $user->curp = $request->usercurp;
        $user->cedula = $request->usercedula;
        $user->phone = $request->userphone;
        $user->name = $request->usernombre;
        $user->primerApellido = $request->userprimerApellido;
        $user->segundoApellido = $request->usersegundoApellido;
        $user->email = $request->useremail;
        $user->password = $request->userpassword !== null? Hash::make($request->userpassword): $user->password;
        $result = $user->save();

        if($result){
            return redirect(route('tenantadmin.medicos'))->with('successMsg', 'Médico Actualizado con éxito');
        }else{
            return redirect(route('tenantadmin.medicos'))->with('errorMsg', 'Ocurrio un error al actualizar al médico.');
        } 

    }

    public function search(Request $request){

    }

    public function disable($id){
        $result = DB::table("usersTenants")->where('user_id', $id)
        ->where('tenant_id', Auth::guard('tenantadmin')->user()->tenant_id)
        ->update(["active" => false]);
        if($result){
            return redirect(route('tenantadmin.medicos'))->with('successMsg', 'Médico Inhabilitado con éxito');
        }else{
            return redirect(route('tenantadmin.medicos'))->with('errorMsg', 'Ocurrio un error al Inhabilitar el Médico.');
        }
    }

    public function enable($id){
        $result = DB::table("usersTenants")->where('user_id', $id)
        ->where('tenant_id', Auth::guard('tenantadmin')->user()->tenant_id)
        ->update(["active" => true]);
        if($result){
            return redirect(route('tenantadmin.medicos'))->with('successMsg', 'Médico Habilitado con éxito');
        }else{
            return redirect(route('tenantadmin.medicos'))->with('errorMsg', 'Ocurrio un error al Habilitar al Médico.');
        }
    }

    public function checkmedico(Request $request){
        if(Auth::guard('tenantadmin')->user()){
            $medico = User::where('curp', $request->curp)->first();
            if($medico !== null){
                $tenmedico = userstenant::where('user_id', $medico->id)->where('tenant_id', Auth::guard('tenantadmin')->user()->tenant_id)->first();
                if($tenmedico !== null){
                    return 2; //Ya existe ligado
                }
                return 1; //Existe
            }
            return 0; // No existe
        }
        return -1; //Error
    }

    public function checkmedicos(Request $request){
        if(Auth::guard('tenantadmin')->user()){
            $usertenant = userstenant::where('tenant_id', Auth::guard('tenantadmin')->user()->tenant_id)->get();
            return $usertenant->count();
        }
        return -1;
    }
}
