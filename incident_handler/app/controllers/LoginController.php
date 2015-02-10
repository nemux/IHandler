<?php

class LoginController extends Controller{


    public function login()
    {

      if(Auth::check())
        return Redirect::to('/dashboard');
      else
        return View::make('usuarios.login');
    }

    public function doLogin()
    {
      $log = new Log\Logger();

      $userData = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
        );

      $rules = array(
        'username'=>'required|alpha|min:5',
        'password'=>'required|between:5,15'
      );

      $validator = Validator::make($userData, $rules);

      if ($validator->passes()) {
        if(Auth::attempt($userData)) {
          $log->info(Auth::user()->id,Auth::user()->username,'Inicio sesión');
          return Redirect::to('/');
        }
        else{
          return Redirect::to('/login')->with('message', 'Your username/password combination was incorrect');
        }
      } else {
        return Redirect::to('/login')->withErrors($validator);
      }
    }

  public function logout()
  {
    Auth::logout();
    return Redirect::to('/');
  }
}
