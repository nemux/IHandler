<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	//return View::make('hello');
	  return Redirect::to('usuarios');
});

Route::get('usuarios', array('uses' => 'UsuariosController@mostrarUsuarios'));
 
Route::get('usuarios/nuevo', array('uses' => 'UsuariosController@nuevoUsuario'));
 
Route::post('usuarios/crear', array('uses' => 'UsuariosController@crearUsuario'));
// esta ruta es a la cual apunta el formulario donde se introduce la información del usuario 
// como podemos observar es para recibir peticiones POST 
 
Route::get('usuarios/{id}', array('uses'=>'UsuariosController@verUsuario'));
// esta ruta contiene un parámetro llamado {id}, que sirve para indicar el id del usuario que deseamos buscar 
// este parámetro es pasado al controlador, podemos colocar todos los parámetros que necesitemos 
// solo hay que tomar en cuenta que los parámetros van entre llaves {}
// si el parámetro es opcional se colocar un signo de interrogación {parámetro?}

//Route::resource('users', 'UsuariosController');
