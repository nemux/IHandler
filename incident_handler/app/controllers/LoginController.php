<?php

class LoginController extends Controller{


    public function login()
    {
        return View::make('usuarios.login');
    }

      public function doLogin()
  {
        $user = Input::get('username');
        $password = Input::get('password');

        $validator = Acces::validate(array(
        'username' => Input::get('real_name'),
        'password' => Input::get('password'),
                  ));




    
        $credentials = array(
        'username' => $user,
        'password' => $password
        );

        if(Auth::attempt($credentials,true))
        {
          return View::make('layouts.master');
        }
        else{
          echo 'FAlse';
        }

       /* $a = Auth::attempt(array ("username"=>"salma76", 'password'=>"leonel"));      
      
        7if($a) {
          return View::make ('layouts.master');
        }
        else {          
          echo 'FALSE';
        }   */    
  //{
  //  if(Auth::check()){
  //    Auth::logout();
 // }
  //    return Redirect::route('login');

 }
}
