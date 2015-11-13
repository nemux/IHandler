@extends('layout.dashboard_topmenu')

@section('title', 'Caso '.$case->title)

@section('include_up')
    <script src="/custom/assets/js/gcs-im/event.js"></script>
@endsection

@section('dashboard_content')
    <div class="row">
        <div class="btn btn-primary" onclick="window.open('{{route('incident.edit',[$case])}}','_self');">
            <i class="fa fa-pencil fa-fw"></i> Editar Caso
        </div>
        <div class="btn btn-info" onclick="window.open('{{route('incident.pdf',[$case,1])}}','_self');">
            <i class="fa fa-file-pdf-o fa-fw"></i> Generar PDF
        </div>
        <div class="btn btn-success"
             onclick="window.open('{{route('incident.email',$case)}}','_self');">
            <i class="fa fa-envelope fa-fw"></i> Enviar Correo
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cliente: <b>{{$case->customer->name}}</b></h3><br/>

            <h3 class="panel-title">Actualizado: <b>{{date('d/m/Y H:i:s',strtotime($case->updated_at))}}</b></h3><br/>

            <h3 class="panel-title">Estatus: <b>{{($case->ticket)?$case->ticket->status->name:'Abierto'}}</b></h3>
        </div>
        <div class="panel-body">
            @include('incident._preview',['forpdf'=>false])
        </div>
    </div>
@endsection