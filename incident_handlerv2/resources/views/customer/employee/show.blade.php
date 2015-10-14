@extends('layout.dashboard_topmenu')

@section('title',"Empleados")

@section('dashboard_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Empleado: <b>{{$employee->person->fullName()}}</b></h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Nombre Completo</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$employee->person->fullName()}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Sexo</b>
                </div>
                <div class="col-md-10">
                    {{$employee->person->sex=='M'?'Masculino':'Femenino'}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Datos Personales</b>
                </div>
                <div class="col-md-10 text-left">
                    <i class="fa-envelope"></i> {{$employee->person->contact->email}}<br/>
                    <i class="fa-phone"></i> {{$employee->person->contact->phone}}
                </div>
            </div>
        </div>
        <hr/>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Datos Corporativos</b>
                </div>
                <div class="col-md-10 text-left">
                    <i class="fa-envelope"></i> {{$employee->email}}<br/>
                    <i class="fa-phone"></i> {{$employee->phone}}
                </div>
            </div>
        </div>
    </div>

@endsection