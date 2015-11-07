@extends('layout.dashboard_topmenu')

@section('title', 'Caso '.$case->title)

@section('include_up')
    <script>
        $(document).ready(function () {
            @foreach($case->events as $index=>$event)
            addPreviewRow(0, JSON.parse('{!! $event->source->json() !!}'), JSON.parse('{!! $event->target->json() !!}'));
            @endforeach



        });
    </script>
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
        </div>
        <div class="panel-body">
            @include('incident._preview')
        </div>
    </div>
@endsection