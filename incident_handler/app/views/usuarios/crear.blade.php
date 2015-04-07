@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de  creacion de usuario
@stop
 
@section('content')
        {{ HTML::link('usuarios', 'volver'); }}
        <h1>
  Crear Usuario
      
    valores name lastname mail phone type other
  
</h1>
        {{ Form::open(array('url' => 'usuarios/crear')) }}
            {{Form::label('name', 'Nombre')}}
            {{Form::text('name', '')}}
            <br>
            {{Form::label('lastname', 'Apellido')}}
            {{Form::text('lastname', '')}}
            <br>
            {{Form::label('mail', 'correo')}}
            {{Form::text('mail', '')}}
            <br>
            {{Form::label('phone', 'telefono')}}
            {{Form::text('phone', '')}}
            <br>
            {{Form::label('type', 'Tipo')}}
            {{Form::text('type', '')}}
            <br>
            {{Form::label('other', 'otros')}}
            {{Form::text('other', '')}}
            <br>
            {{Form::submit('Guardar')}}
        {{ Form::close() }}
@stop