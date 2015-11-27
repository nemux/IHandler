@extends('layout.dashboard_topmenu')

@section('title',"Activos")

@section('dashboard_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Activo <b>{{$asset->domain_name}}</b></h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Nombre de Dominio</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$asset->domain_name}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>IP V4</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$asset->asset->ipv4}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>IP V6</b>
                </div>
                <div class="col-md-10">
                    {{$asset->asset->ipv6}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Comentarios</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$asset->comments}}
                </div>
            </div>
        </div>
    </div>

@endsection