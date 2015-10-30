@extends('layout.dashboard_topmenu')

@section('title',"Páginas")

@section('dashboard_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Página: <b>{{$link->title}}</b></h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Título</b>
                </div>
                <div class="col-md-10 text-left">
                    {{$link->title}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Enlace</b>
                </div>
                <div class="col-md-10">
                    <a href=" {{$link->link}}"> {{$link->link}}</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Comentarios</b>
                </div>
                <div class="col-md-10 text-left">
                    <p>{{$link->comments}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection