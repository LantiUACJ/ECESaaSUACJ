<?php

namespace App\Http\Controllers\Tenantadmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginController extends Controller
{
        /**
     * This trait has all the login throttling functionality.
     */
    use ThrottlesLogins;

    /**
     * Max login attempts allowed.
     */
    public $maxAttempts = 4;

    /**
     * Number of minutes to lock the login.
     */
    public $decayMinutes = 2;

    /**
    * Only guests for "admin" guard are allowed except
    * for logout.
    * 
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest:tenantadmin')->except('logout');
    }
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(){
        return view('tenantadmin.auth.login');
    }

    public function login(Request $request){
        $this->validator($request);

        //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);

            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }
        
        if(Auth::guard('tenantadmin')->attempt($request->only('email','password'))){
            //Authentication passed...
            if(!Auth::guard('tenantadmin')->user()->tenant->active){
                Auth::guard('tenantadmin')->logout();
                $request->session()->put("errorMsg", "¡Tenant Inactivo!");
                return redirect(route('tenantadmin.login'));
            }
            if(!Auth::guard('tenantadmin')->user()->active) {
                Auth::guard('tenantadmin')->logout();
                $request->session()->put("errorMsg", "¡Tu cuenta esta inhabilitada!");
                return redirect(route('tenantadmin.login'));
            }
            return redirect()
                ->intended(route('tenantadmin.home'))
                ->with('status','¡Te has autenticado como Administrador!');
        }

        //keep track of login attempts from the user.
        $this->incrementLoginAttempts($request);

        //Authentication failed...
        return $this->loginFailed();
    }

    private function validator(Request $request){
        //validation rules.
        $rules = [
            'email'    => 'required|email|exists:tenantadmins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'Las credenciales no coinciden nuestros registros.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }

    private function loginFailed(){
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Estas credenciales no coinciden con nuestros registros.');
    }

    public function logout(){
        Auth::guard('tenantadmin')->logout();
        return redirect()
            ->route('tenantadmin.login')
            ->with('status','¡El administrador a finalizado su sessión!');
    }

    /**
     * Username used in ThrottlesLogins trait
     * 
     * @return string
     */
    public function username(){
        return 'email';
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];
    }
}
