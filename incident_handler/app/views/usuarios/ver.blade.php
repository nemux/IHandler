@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de usuario
@stop
 
@section('content')
        
		<br>
        <br>
  Detalle del usuario
  <br>
  ID del usuario {{$Usuarios->id}}
      

        	Detalles del usuario:
        	<br>
        {{ $Usuarios->name .' '.$Usuarios->mail }}
   
<br />
Fecha de creacion:
<br>
        {{ $Usuarios->created_at}}
Ultima Modificacion
	<br>
		{{$Usuarios->updated_at}}        



<h4 align="left">{{ HTML::link('usuarios', 'Volver'); }}</h4>		
@stop