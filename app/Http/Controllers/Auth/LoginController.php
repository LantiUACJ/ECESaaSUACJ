<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use App\Models\tenant;
use App\Models\User;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public static function setMultiTenant(Request &$request)
    {
        $tenants = DB::table("usersTenants")
        ->where("usersTenants.active", true)
        ->where("user_id", auth()->guard()->user()->id)
        ->join("tenants", "usersTenants.tenant_id", "=", "tenants.id")
        ->where("tenants.active", true)
        ->select([
            DB::raw("tenants.tenant_nombre as name"),
            DB::raw("tenants.id as id")
        ])
        ->get();
        
        if ($tenants->count() == 1) {
            $request->session()->put("tenant", tenant::find($tenants->first()->id));
        } else if ($tenants->count() > 1) {
            $request->session()->put("tenants", $tenants);
        }else{
            Auth::logout();
            $request->session()->put("errorMsg", "¡El Usuario no esta registrado en Tenants activos!");
            return redirect(route('login'));
        }
    }

    public static function setMultiTenantReset(User $user)
    {
        $tenants = DB::table("usersTenants")
        ->where("user_id", auth()->guard()->user()->id)
        ->join("tenants", "usersTenants.tenant_id", "=", "tenants.id")
        ->select([
            DB::raw("tenants.tenant_nombre as name"),
            DB::raw("tenants.id as id")
        ])
        ->get();
        
        if ($tenants->count() == 1) {
            session()->put("tenant", tenant::find($tenants->first()->id));
        } else if ($tenants->count() > 1) {
            session()->put("tenants", $tenants);
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        $this->setMultiTenant($request);
       
        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }
        
        if($request->session()->has("tenants")){
            return redirect("/setTenant");
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                $this->username() => 'required|string',
                'password' => 'required|string',
            ],
            [
                $this->username().'.required' => 'El Correo Electrónico es obligatiorio.',
                'password.required' => 'La Contraseña es obligatoria.',
            ]
        );
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->boolean('remember')
        );
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function logout(){
        Auth::logout();
        session()->forget('tenant');
        return redirect('/')->with('status','User has been logged out!');
    }
}
