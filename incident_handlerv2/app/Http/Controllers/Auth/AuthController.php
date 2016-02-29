<?php

namespace App\Http\Controllers\Auth;

use App\Events\EventName;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Models\IncidentManager\Log\Log;
use Models\IncidentManager\User\User;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'username';

    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                $this->loginUsername() => 'required|exists:user,username,active,1',
                'password' => 'required',
            ],
            [
                $this->loginUsername() . '.exists' => 'Las credenciales son incorrectas.'
            ],
            [
                $this->loginUsername() => 'Nombre de Usuario', 'password' => 'Contraseña'
            ]
        );

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials)) {
            \Event::fire(new EventName("El usuario <b>" . \Auth::user()->username . "</b> inició sesión"));
            Log::debug(\Auth::user()->username, "El usuario '" . \Auth::user()->username . "' inició sesión a las '" . date('d/m/Y H:i:s T'));
            return redirect()->intended($this->redirectPath());
        } else {
            return redirect()->route('login.get')->withErrors('Las credenciales son incorrectas.');
        }
    }
}