@extends('layouts.master')

  Lista de Usuarios y su correo electronico

  @section('sidebar')
     @parent
     Lista de usuarios
@stop

@section('content')
        <h1>
  Usuarios


</h1>
        {{ HTML::link('usuarios/nuevo', 'Crear Usuario'); }}

<ul>
  @foreach($Usuarios as $user)
           <li>
    {{ HTML::link( 'Usuarios/'.$user->id , $user->name.' '.$user->mail); }}

  </li>
  @endforeach
  </ul>
@stop


