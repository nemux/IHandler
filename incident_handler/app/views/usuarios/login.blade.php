@extends('layouts.master')


@section('sidebar')

@stop

@section('content')
  {{Form::open(array('action' => 'LoginController@doLogin')) }} 
  {{Form::label('username', 'User Name') }} 
  {{Form::text('username', '', array('class' => 'form-control'))}} 
  {{Form::label('password', 'Password') }} 
  {{Form::password('password', array('class' => 'form-control'))}} 
  <br>    
  {{Form::submit('Login', array('class' => 'btn btn-primary')) }} 
  {{ Form::close() }} 
@stop

@section('footer')

@stop
