@extends('layout.dashboard_topmenu')

@section('title',"Sensores")

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Sensor <b>{{$sensor->name}}</b></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>IP V4</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$sensor->ipv4}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>IP V6</b>
                </div>
                <div class="col-md-10">
                    {{$sensor->ipv6}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Punto de Montaje</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$sensor->mount_point}}
                </div>
            </div>
        </div>
    </div>
@endsection