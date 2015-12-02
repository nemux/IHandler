@extends('layout.dashboard_topmenu')

@section('title',$user->person->fullName())
@section('section_description','Editar los datos del usuario')

@section('include_up')
@endsection

@section('include_down')
@endsection

@section('dashboard_content')
    <section class="">
        {!! Form::model($user,['class'=>'form-horizontal','role'=>'form']) !!}
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h3>Datos de Usuario</h3>
                    </div>
                    <div class="panel-body">
                        @include('user._form')
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="javascript:"
                                   onclick="$('#modal-change-password').modal('show', {backdrop: 'fade'});"
                                   class="btn btn-blue btn-single">Cambiar contraseña</a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-title">
                        <h3>Datos Personales</h3>
                    </div>
                    <div class="panel-body">
                        @include('person._form')
                    </div>

                    <div class="panel-title">
                        <h3>Datos de Contacto</h3>
                    </div>
                    <div class="panel-body">
                        @include('person.contact._form')
                    </div>
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Guardar',['class'=>'btn btn-blue btn-single']) !!}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        {!! Form::close() !!}


                <!-- Modal 1 (Basic)-->
        <div class="modal fade" id="modal-change-password">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Cambiar contraseña a {{$user->person->fullName()}}</h4>
                    </div>
                    {!! Form::open(['url'=>route('user.change_pass')]) !!}
                    <div class="modal-body">
                        @include('user._form_pass')
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>
@endsection