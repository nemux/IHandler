@extends('layout.dashboard_topmenu')

@section('title',$link->title)
@section('section_description','Editar los datos de la página')

@section('include_up')
@endsection

@section('include_down')
@endsection

@section('dashboard_content')
    <section class="">
        {!! Form::model($link,['class'=>'form-horizontal','role'=>'form']) !!}
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h3>Datos de la Página</h3>
                    </div>
                    <div class="panel-body">
                        @include('link._form')
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
    </section>
@endsection