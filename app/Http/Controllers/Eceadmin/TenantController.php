<?php

namespace App\Http\Controllers\Eceadmin;

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

class TenantController extends Controller
{
    public function index(){
        $tenants = tenant::orderBy('created_at', 'desc')->paginate(15);
        session(['menunav' => "tenants"]);
        return view('eceadmin.tenants.index', ['tenants' => $tenants, 'search' => false]);
    }

    public function check(){
        if(Auth::guard('eceadmin')->user()){
            $tenants = tenant::where('active', true)->get();
            return $tenants->count();
        }
        return -1;
    }

    public function register(){
        return view('eceadmin.tenants.register');
    }

    public function store(Request $request){
        //dd($request->all());
        $validated = $request->validate([
            'nombre' => 'required|max:255|unique:App\Models\tenant,tenant_nombre',
            'alias' => 'nullable|max:255|unique:App\Models\tenant,tenant_alias',
            'clues' => 'required|max:11|unique:App\Models\tenant,registroSanitario',
            'address' => 'required|max:255',
            'phone' => 'required|max:10',
            'tenanttype' => 'required',
            
            //email de administradores no debe ser el mismo
            'adminname1' => 'required_if:includeadmin1,1',
            'adminemail1' => 'required_if:includeadmin1,1|unique:App\Models\Tenantadmin,email',
            'adminphone1' => 'required_if:includeadmin1,1',
            'adminpassword1' => 'required_if:includeadmin1,1',

            'adminname2' => 'required_if:includeadmin2,1',
            'adminemail2' => 'required_if:includeadmin2,1|different:adminemail1|unique:App\Models\Tenantadmin,email',
            'adminphone2' => 'required_if:includeadmin2,1',
            'adminpassword2' => 'required_if:includeadmin2,1',
            
            'usercurp1' => 'required_if:meds1,1',

            'usercurp' => 'required_if:meds2,1',
            'usercedula' => 'required_if:meds2,1|unique:App\Models\User,cedula',
            'userphone' => 'required_if:meds2,1',
            'usernombre' => 'required_if:meds2,1',
            'userprimerApellido' => 'required_if:meds2,1',
            'usersegundoApellido' => 'required_if:meds2,1',
            'useremail' => 'required_if:meds2,1|unique:App\Models\User,email',
            'userpassword' => 'required_if:meds2,1',
        ],[
            'adminname1.required_if' => 'El campo Nombre del Administrador 01 es obligatorio.',
            'adminemail1.required_if' => 'El campo Correo del Administrador 01 es obligatorio.',
            'adminphone1.required_if' => 'El campo Teléfono del Administrador 01 es obligatorio.',
            'adminpassword1.required_if' => 'El campo Contraseña del Administrador 01 es obligatorio.',
            
            'adminname2.required_if' => 'El campo Nombre del Administrador 02 es obligatorio.',
            'adminemail2.required_if' => 'El campo Correo del Administrador 02 es obligatorio.',
            'adminphone2.required_if' => 'El campo Teléfono del Administrador 02 es obligatorio.',
            'adminpassword2.required_if' => 'El campo Contraseña del Administrador 02 es obligatorio.',

            'adminemail1.unique' => 'El valor del campo Correo ya esta en uso.',
            'adminemail2.unique' => 'El valor del campo Correo ya esta en uso.',
            'adminemail2.different' => 'El valor del campo Correo debe ser diferente al del Administrador 01.',

            'usercurp1.required_if' => 'El campo Curp Médico es obligatorio',

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
        //registrar tenant
        $tenant = new tenant;
        $tenant->createdEceAdmin_id = Auth::guard('eceadmin')->user()->id;
        $tenant->tenant_nombre = $request->nombre;
        $tenant->tenant_alias = isset($request->alias)? $request->alias: $request->nombre;
        $tenant->tenant_subdomain = $request->nombre.".";
        $tenant->tenant_cliente = $request->nombre;
        $tenant->registroSanitario = $request->clues;
        $tenant->address = $request->address;
        $tenant->phone = $request->phone;
        $tenant->type = $request->tenanttype;
        $result = $tenant->save();

        if($request->tenanttype == 1){ //instituto
            if($request->includeadmin1){
                $tenantadmin1 = new Tenantadmin;
                $tenantadmin1->tenant_id = $tenant->id;
                $tenantadmin1->createdEceAdmin_id = Auth::guard('eceadmin')->user()->id;
                $tenantadmin1->name = $request->adminname1;
                $tenantadmin1->email = $request->adminemail1;
                $tenantadmin1->phone = $request->adminphone1;
                $tenantadmin1->password = Hash::make($request->adminpassword1);
                $tenantadmin1->save();
            }
            if($request->includeadmin2){
                $tenantadmin1 = new Tenantadmin;
                $tenantadmin1->tenant_id = $tenant->id;
                $tenantadmin1->createdEceAdmin_id = Auth::guard('eceadmin')->user()->id;
                $tenantadmin1->name = $request->adminname2;
                $tenantadmin1->email = $request->adminemail2;
                $tenantadmin1->phone = $request->adminphone2;
                $tenantadmin1->password = Hash::make($request->adminpassword2);
                $tenantadmin1->save();
            }
        }elseif($request->tenanttype == 2){ //particular
            if($request->meds1){
                $dbuser = User::where('curp', $request->usercurp1)->first();
                if($dbuser != null){
                    DB::table("usersTenants")->insert([
                        "user_id" => $dbuser->id,
                        "tenant_id" => $tenant->id
                    ]);
                }
            }elseif($request->meds2){ //comprobar si se digito usuario
                //comprobar si el usuario ya esta registrado
                $dbuser = User::where('email', $request->useremail)->first();
                if($dbuser == null){ //no existe, registramos
                    $user = new User;
                    $user->curp = $request->usercurp;
                    $user->cedula  = $request->usercedula;
                    $user->phone  = $request->userphone;
                    $user->name = $request->usernombre;
                    $user->primerApellido = $request->userprimerApellido;
                    $user->segundoApellido = $request->usersegundoApellido;
                    $user->email = $request->useremail;
                    $user->password = Hash::make($request->userpassword);
                    $user->save();

                    DB::table("usersTenants")->insert([
                        "user_id" => $user->id,
                        "tenant_id" => $tenant->id
                    ]);

                }else{//Por algunaa razon no fue detectado con curp?
                    
                    DB::table("usersTenants")->insert([
                        "user_id" => $dbuser->id,
                        "tenant_id" => $tenant->id
                    ]);
                }
            }
        }

        if($result){
            return redirect(route('eceadmin.tenants'))->with('successMsg', 'Tenant Creado con éxito');
        }else{
            return redirect(route('eceadmin.tenants'))->with('errorMsg', 'Ocurrio un error al guardar el Tenant.');
        } 

    }

    public function edit($id){
        $tenant = tenant::findOrFail($id);
        return view('eceadmin.tenants.edit', ['tenant' => $tenant]);
    }

    public function update(Request $request, $id){
        //dd($request->all());
        //Validacion de administradores depensiendo si ya hay registros anteriores o no
        $count = 0;
        $tadmin1 = null;
        $tadmin2 = null;
        $tuser = null;
        $tenant = tenant::findOrFail($id);
        foreach ($tenant->tenantadmins as $tadmin) {
            if($count == 0)
                $tadmin1 = $tadmin;
            else
                $tadmin2 = $tadmin;
            $count++;
        }

        $rule1 = 'unique:App\Models\Tenantadmin,email';
        $pass1 = 'required_if:includeadmin1,1';
        $rule2 = 'unique:App\Models\Tenantadmin,email';
        $pass2 = 'required_if:includeadmin2,1';
        $rule3 = 'unique:App\Models\Tenantadmin,email';
        $pass3 =  'required_if:meds,1';
        $rule4 = 'unique:App\Models\User,email';
        
        if($tadmin1 !== null){
            $rule1 = Rule::unique("tenantadmins", "email")->ignore($tadmin1->id);
            $pass1 = 'nullable';
        }
        if($tadmin2 !== null){
            $rule2 = Rule::unique("tenantadmins", "email")->ignore($tadmin2->id);
            $pass2 = 'nullable';
        }
        if($tenant->usertenant !== null){
            $tuser = $tenant->usertenant->user;
            $rule3 = Rule::unique("users", "cedula")->ignore($tuser->id);
            $rule4 = Rule::unique("users", "email")->ignore($tuser->id);
            $pass3 = 'nullable';
        }
        //Validacion del diablo
        $validated = $request->validate([
            'nombre' => [
                'required',
                'max:255',
                Rule::unique('tenants', 'tenant_nombre')->ignore($id),
            ],
            'alias' => [
                'nullable',
                'max:255',
                Rule::unique('tenants', 'tenant_alias')->ignore($id),
            ],
            'clues' => [
                'required',
                'max:11',
                Rule::unique('tenants', 'registroSanitario')->ignore($id),
            ],
            'address' => 'required|max:255',
            'phone' => 'required|max:10',
            
            //email de administradores no debe ser el mismo
            'adminname1' => 'required_if:includeadmin1,1',
            'adminemail1' => [
                'required_if:includeadmin1,1',
                'max:255',
                $rule1,
            ],
            'adminphone1' => 'required_if:includeadmin1,1',
            'adminpassword1' => $pass1,

            'adminname2' => 'required_if:includeadmin2,1',
            'adminemail2' => [
                'required_if:includeadmin2,1',
                'different:adminemail1',
                'max:255',
                $rule2,
            ],
            'adminphone2' => 'required_if:includeadmin2,1',
            'adminpassword2' => $pass2,
            
            'usercurp' => 'required_if:meds2,1',
            'usercedula' => [
                'required_if:meds2,1',
                'max:8',
                $rule3,
            ],
            'useremail' => [
                'required_if:meds2,1',
                'max:255',
                $rule4,
            ],
            'userphone' => 'required_if:meds2,1',
            'usernombre' => 'required_if:meds2,1',
            'userprimerApellido' => 'required_if:meds2,1',
            'usersegundoApellido' => 'required_if:meds2,1',
            'userpassword' => $pass3,

            'usercurp1' => 'required_if:meds1,1',
        ],[
            'nombre.unique' => 'El valor del campo Nombre del Tenant ya esta en uso',
            'alias.unique' => 'El valor del campo Alias del Tenant ya esta en uso',
            'alias.unique' => 'El valor del campo Clave clues del Tenant ya esta en uso',

            'adminname1.required_if' => 'El campo Nombre del Administrador 01 es obligatorio.',
            'adminemail1.required_if' => 'El campo Correo del Administrador 01 es obligatorio.',
            'adminphone1.required_if' => 'El campo Teléfono del Administrador 01 es obligatorio.',
            'adminpassword1.required_if' => 'El campo Contraseña del Administrador 01 es obligatorio.',
            
            'adminname2.required_if' => 'El campo Nombre del Administrador 02 es obligatorio.',
            'adminemail2.required_if' => 'El campo Correo del Administrador 02 es obligatorio.',
            'adminphone2.required_if' => 'El campo Teléfono del Administrador 02 es obligatorio.',
            'adminpassword2.required_if' => 'El campo Contraseña del Administrador 02 es obligatorio.',

            'adminemail1.unique' => 'El valor del campo Correo ya esta en uso.',
            'adminemail2.unique' => 'El valor del campo Correo ya esta en uso.',
            'adminemail2.different' => 'El valor del campo Correo debe ser diferente al del Administrador 01.',
            
            'usercurp1.required_if' => 'El campo Curp Médico es obligatorio',

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
        //actualizar tenant
        $tenant->tenant_nombre = $request->nombre;
        $tenant->tenant_alias = isset($request->alias)? $request->alias: $request->nombre;
        $tenant->tenant_subdomain = $request->nombre.".";
        $tenant->tenant_cliente = $request->nombre;
        $tenant->registroSanitario = $request->clues;
        $tenant->address = $request->address;
        $tenant->phone = $request->phone;
        $result = $tenant->save();

        if($tenant->type == 1){ //instituto
            if($request->includeadmin1){//registra o actualiza
                $tenadmin1 = $tadmin1 !== null? Tenantadmin::find($tadmin1->id): $tadmin1;
                if($tenadmin1){
                    $tenadmin1->name = $request->adminname1;
                    $tenadmin1->email = $request->adminemail1;
                    $tenadmin1->phone = $request->adminphone1;
                    $tenadmin1->active = $request->enabledadmin1 !== null? true: false;
                    $tenadmin1->password = $request->adminpassword1 !== null? Hash::make($request->adminpassword1): $tenadmin1->password;
                    $tenadmin1->save();
                }else{
                    $tenantadmin1 = new Tenantadmin;
                    $tenantadmin1->tenant_id = $tenant->id;
                    $tenantadmin1->createdEceAdmin_id = Auth::guard('eceadmin')->user()->id;
                    $tenantadmin1->name = $request->adminname1;
                    $tenantadmin1->email = $request->adminemail1;
                    $tenantadmin1->phone = $request->adminphone1;
                    $tenantadmin1->password = Hash::make($request->adminpassword1);
                    $tenantadmin1->save();
                }
            }
            if($request->includeadmin2){
                $tenadmin2 = $tadmin2 !== null? Tenantadmin::find($tadmin2->id): $tadmin2;
                if($tenadmin2){
                    $tenadmin2->name = $request->adminname2;
                    $tenadmin2->email = $request->adminemail2;
                    $tenadmin2->phone = $request->adminphone2;
                    $tenadmin1->active = $request->enabledadmin2 !== null? true: false;
                    $tenadmin2->password = $request->adminpassword2 !== null? Hash::make($request->adminpassword2): $tenadmin2->password;
                    $tenadmin2->save();
                }else{
                    $tenantadmin2 = new Tenantadmin;
                    $tenantadmin2->tenant_id = $tenant->id;
                    $tenantadmin2->createdEceAdmin_id = Auth::guard('eceadmin')->user()->id;
                    $tenantadmin2->name = $request->adminname2;
                    $tenantadmin2->email = $request->adminemail2;
                    $tenantadmin2->phone = $request->adminphone2;
                    $tenantadmin2->password = Hash::make($request->adminpassword2);
                    $tenantadmin2->save();
                }
            }
        }elseif($tenant->type == 2){ //particular
            if($request->meds1){
                if($tenant->usertenant == null){ //no existe el vinculo 
                    $dbuser = User::where('curp', $request->usercurp1)->first();
                    if($dbuser != null){
                        DB::table("usersTenants")->insert([
                            "user_id" => $dbuser->id,
                            "tenant_id" => $tenant->id
                        ]);
                    }
                }
            }elseif($request->meds2){ //comprobar si se digito usuario
                //comprobar si el usuario ya esta registrado
                $dbuser = User::where('email', $request->useremail)->first();
                if($dbuser == null){ //no existe, registramos
                    $user = new User;
                    $user->curp = $request->usercurp;
                    $user->cedula  = $request->usercedula;
                    $user->phone  = $request->userphone;
                    $user->name = $request->usernombre;
                    $user->primerApellido = $request->userprimerApellido;
                    $user->segundoApellido = $request->usersegundoApellido;
                    $user->email = $request->useremail;
                    $user->password = Hash::make($request->userpassword);
                    $user->save();

                    DB::table("usersTenants")->insert([
                        "user_id" => $user->id,
                        "tenant_id" => $tenant->id
                    ]);

                }else{//Por algunaa razon no fue detectado con curp?
                    
                    DB::table("usersTenants")->insert([
                        "user_id" => $dbuser->id,
                        "tenant_id" => $tenant->id
                    ]);
                }
            }
        }

        if($result){
            return redirect(route('eceadmin.tenants'))->with('successMsg', 'Tenant Actualizado con éxito');
        }else{
            return redirect(route('eceadmin.tenants'))->with('errorMsg', 'Ocurrio un error al actualizar el Tenant.');
        } 
    }

    public function search(Request $request){

    }

    public function disable($id){
        $tenant = tenant::findOrFail($id);
        $tenant->active = false;
        $result = $tenant->save();
        if($result){
            return redirect(route('eceadmin.tenants'))->with('successMsg', 'Tenant Inhabilitado con éxito');
        }else{
            return redirect(route('eceadmin.tenants'))->with('errorMsg', 'Ocurrio un error al Inhabilitar el Tenant.');
        }
    }

    public function enable($id){
        $tenant = tenant::findOrFail($id);
        $tenant->active = true;
        $result = $tenant->save();
        if($result){
            return redirect(route('eceadmin.tenants'))->with('successMsg', 'Tenant Habilitado con éxito');
        }else{
            return redirect(route('eceadmin.tenants'))->with('errorMsg', 'Ocurrio un error al Habilitar el Tenant.');
        }
    }

    public function checkmedico(Request $request){
        if(Auth::guard('eceadmin')->user()){
            $medico = User::where('curp', $request->curp)->first();
            if($medico !== null){
                return 1; //Existe
            }
            return 0; // No existe
        }
        return -1; //Error
    }
}
