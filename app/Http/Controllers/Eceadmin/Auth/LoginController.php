<?php

namespace App\Http\Controllers\Eceadmin\Auth;

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
        $this->middleware('guest:eceadmin')->except('logout');
    }
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(){
        return view('eceadmin.auth.login');
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
        
        if(Auth::guard('eceadmin')->attempt($request->only('email','password'))){
            //Authentication passed...
            return redirect()
                ->intended(route('eceadmin.home'))
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
            'email'    => 'required|email|exists:eceadmins|min:5|max:191',
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
            ->with('error','La autentificación fallo, porfavor intentalo otra vez.');
    }

    public function logout(){
        Auth::guard('eceadmin')->logout();
        return redirect()
            ->route('eceadmin.login')
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
}
