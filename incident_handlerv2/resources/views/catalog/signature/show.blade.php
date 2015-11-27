@extends('layout.dashboard_topmenu')

@section('title','Firma '.$item->name)

@section('dashboard_content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Firma: <b>{{$item->name}}</b></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Descripción</b>
                </div>
                <div class="col-md-10">
                    <p>{!! nl2br($item->description) !!}</p>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Riesgo(s)</b>
                </div>
                <div class="col-md-10">
                    <p>{!! nl2br($item->risk) !!}</p>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Recomendacion(es)</b>
                </div>
                <div class="col-md-10">
                    <p>{!! nl2br($item->recommendation) !!}</p>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-2 text-right">
                    <b>Referencia(s)</b>
                </div>
                <div class="col-md-10">
                    <p>{!! nl2br($item->reference) !!}</p>
                </div>
            </div>
        </div>
    </div>

@endsection