@extends('layout.dashboard_topmenu')

@section('title', 'Dashboard Incident Manager')

@section('include_down')
    <script src="/xenon/assets/js/devexpress-web-14.1x/js/globalize.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/devexpress-web-14.1x/js/dx.chartjs.js" id="script-resource-8"></script>
@endsection

@section('dashboard_content')
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Incidentes de Seguridad</h1>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Gráficas</h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('chart.incidents')
                        </div>
                    </div>
                    {{--<div class="row">--}}
                    {{--<div class="col-md-12">--}}
                    {{--@include('chart.surveillance')--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Cibervigilancia</h1>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                        <li>Lorem ipsum</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Criticidad</h1>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Flujo del Ataque</h1>
                </div>
                <div class="panel-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Firmas</h1>
                </div>
                <div class="panel-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Tipo de Ataque</h1>
                </div>
                <div class="panel-body"></div>
            </div>
        </div>
    </div>
@endsection