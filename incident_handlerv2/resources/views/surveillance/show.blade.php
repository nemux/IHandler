@extends('layout.dashboard_topmenu')

@section('title', 'Caso '.$case->title)

@section('include_up')
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cliente: <b>{{$case->customer->name}}</b></h3><br/>

            <div class="row">
                <div class="btn btn-primary" onclick="window.open('{{route('surveillance.edit',[$case])}}','_self');">
                    <i class="fa fa-pencil fa-fw"></i> Editar Caso
                </div>
                <div class="btn btn-info" onclick="window.open('{{route('surveillance.pdf',[$case,true])}}','_self');">
                    <i class="fa fa-file-pdf-o fa-fw"></i> Generar PDF
                </div>
                <div class="btn btn-success"
                     onclick="window.open('{{route('surveillance.email',$case)}}','_self');">
                    <i class="fa fa-envelope fa-fw"></i> Enviar Correo
                </div>
            </div>
        </div>
        <div class="panel-body">
            @include('surveillance._preview')
        </div>
    </div>
@endsection