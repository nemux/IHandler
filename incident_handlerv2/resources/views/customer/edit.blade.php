@extends('layout.dashboard_topmenu')

@section('title','Editar la información del cliente: '.$customer->name)

@section('include_up')
@endsection

@section('include_down')
@endsection

@section('dashboard_content')
    <section class="">
        {!! Form::model($customer,['class'=>'form-horizontal','role'=>'form','files' => true]) !!}
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h3>Datos del Cliente</h3>
                    </div>
                    <div class="panel-body">
                        @include('customer._form')
                    </div>
                    <div class="panel-title">
                        <h3>Contacto del Cliente</h3>
                    </div>
                    <div class="panel-body">
                        @include('person._form')
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
    </section>
@endsection