<?php

class LoginController extends Controller{


    public function login()
    {
        return View::make('usuarios.login');
    }

    public function doLogin()
    {
      $userData = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
        );

      $rules = array(
        'username'=>'required|alpha_num|min:5',
        'password'=>'required|alpha_num|between:5,15'
      );


      $validator = Validator::make($userData, $rules);

      if ($validator->passes()) {
        if(Auth::attempt($userData)) {
          return View::make('layouts.master');
        }
        else{
          return Redirect::to('/login')->with('message', 'Your username/password combination was incorrect');
        }
      } else {
        return Redirect::to('/login')->withErrors($validator);
      }
    }
}


