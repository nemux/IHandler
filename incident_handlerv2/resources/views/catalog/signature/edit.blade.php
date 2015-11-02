@extends('layout.dashboard_topmenu')

@section('title','Crear nueva Firma')

@section('include_up')
@endsection

@section('include_down')
@endsection

@section('dashboard_content')
    <section class="">
        {!! Form::model($item,['class'=>'form-horizontal','role'=>'form']) !!}
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h3>Datos de la Firma <b>{{$item->signature}}</b></h3>
                    </div>
                    <div class="panel-body">
                        @include('catalog.signature._form')
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