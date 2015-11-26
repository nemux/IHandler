@extends('layout.dashboard_topmenu')

@section('title', 'Dashboard Incident Manager')

{{--@section('include_up')--}}
{{--<link type="text/css" href="/xenon/assets/js/devexpress-web-14.1.x/css/dx.common.css">--}}
{{--<link type="text/css" href="/xenon/assets/js/devexpress-web-14.1x/css/dx.ligth.css">--}}
{{--@endsection--}}

@section('include_down')
    <script src="/xenon/assets/js/devexpress-web-14.1x/js/globalize.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/devexpress-web-14.1x/js/dx.chartjs.js" id="script-resource-8"></script>

    <style>
        .criticity-1 {
            color: #CC3F44;
        }

        .criticity-2 {
            color: #ff7900;
        }

        .criticity-3 {
            color: #f7cc31;

        }

        .text-crop {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>

    <script>
        var xenonPalette = ['#68b828', '#7c38bc', '#0e62c7', '#fcd036', '#4fcdfc', '#00b19d', '#ff6264', '#f7aa47'];
        $(document).ready(function () {
            //Cargar la lista de incidentes en el tag <ol> correspondiente
            $.ajax({
                url: '{{route('incidents.take',10)}}',
                success: function (response) {
                    if (response.err_code)
                        alert(response.message)
                    else {
                        $.each(response, function (index, item) {
                            var ul = '<li class="text-crop"><a class="" href="/dashboard/incident/show/' + item.id + '" target="_blank"><i class="fa fa-bookmark criticity-' + item.criticity_id + '"></i> ' + item.title + '</a></li>';
                            $(ul).appendTo($('#incidents-list'));
                        });
                    }
                },
                error: function (response) {
                    alert(response);
                }
            });


            //Cargar la lista de cibervigilancia en el tag <ol> correspondiente
            $.ajax({
                url: '{{route('surveillances.take',10)}}',
                success: function (response) {
                    if (response.err_code)
                        alert(response.message)
                    else {
                        $.each(response, function (index, item) {
                            var ul = '<li class="text-crop"><a href="/dashboard/surveillance/show/' + item.id + '" target="_blank"><i class="fa fa-bookmark criticity-' + item.criticity_id + '"></i> ' + item.title + '</a></li>';
                            $(ul).appendTo($('#surveillance-list'));
                        });
                    }
                },
                error: function (response) {
                    alert(response);
                }
            });
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-options">
                        <a href="#">
                            <i class="linecons-cog"></i>
                        </a> <a href="#" data-toggle="panel">
                            <span class="collapse-icon">–</span>
                            <span class="expand-icon">+</span>
                        </a>
                        <a href="#" data-toggle="reload">
                            <i class="fa-rotate-right"></i>
                        </a>
                        <a href="#" data-toggle="remove">
                            ×
                        </a>
                    </div>
                    <h1 class="panel-title">Incidentes de Seguridad</h1>
                </div>
                <div class="panel-body">
                    <ol id="incidents-list">
                        {{--Populated with Ajax Request--}}
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-options">
                        <a href="#">
                            <i class="linecons-cog"></i>
                        </a>
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">–</span>
                            <span class="expand-icon">+</span>
                        </a>
                        <a href="#" data-toggle="reload">
                            <i class="fa-rotate-right"></i>
                        </a>
                        <a href="#" data-toggle="remove">
                            ×
                        </a>
                    </div>
                    <h1 class="panel-title">Incidentes por Cliente en los últimos 7 días</h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('chart._incidents')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-options"><a href="#"> <i class="linecons-cog"></i> </a> <a href="#"
                                                                                                 data-toggle="panel">
                            <span class="collapse-icon">–</span> <span class="expand-icon">+</span> </a> <a href="#"
                                                                                                            data-toggle="reload">
                            <i class="fa-rotate-right"></i> </a> <a href="#" data-toggle="remove">
                            ×
                        </a></div>
                    <h1 class="panel-title">Cibervigilancia</h1>
                </div>
                <div class="panel-body">
                    <ol id="surveillance-list">
                        {{--Populated with Ajax Request--}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-options"><a href="#"> <i class="linecons-cog"></i> </a> <a href="#"
                                                                                                 data-toggle="panel">
                            <span class="collapse-icon">–</span> <span class="expand-icon">+</span> </a> <a href="#"
                                                                                                            data-toggle="reload">
                            <i class="fa-rotate-right"></i> </a> <a href="#" data-toggle="remove">
                            ×
                        </a></div>
                    <h1 class="panel-title">Incidentes por Criticidad (7 dias)</h1>
                </div>
                <div class="panel-body">
                    @include('chart._criticity')
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-options"><a href="#"> <i class="linecons-cog"></i> </a> <a href="#"
                                                                                                 data-toggle="panel">
                            <span class="collapse-icon">–</span> <span class="expand-icon">+</span> </a> <a href="#"
                                                                                                            data-toggle="reload">
                            <i class="fa-rotate-right"></i> </a> <a href="#" data-toggle="remove">
                            ×
                        </a></div>
                    <h1 class="panel-title">Incidentes por Flujo de Ataque (7 dias)</h1>
                </div>
                <div class="panel-body">
                    @include('chart._flow')
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-options"><a href="#"> <i class="linecons-cog"></i> </a> <a href="#"
                                                                                                 data-toggle="panel">
                            <span class="collapse-icon">–</span> <span class="expand-icon">+</span> </a> <a href="#"
                                                                                                            data-toggle="reload">
                            <i class="fa-rotate-right"></i> </a> <a href="#" data-toggle="remove">
                            ×
                        </a></div>
                    <h1 class="panel-title">Incidentes por Categoría (7 dias)</h1>
                </div>
                <div class="panel-body">
                    @include('chart._category')
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-options"><a href="#"> <i class="linecons-cog"></i> </a> <a href="#"
                                                                                                 data-toggle="panel">
                            <span class="collapse-icon">–</span> <span class="expand-icon">+</span> </a> <a href="#"
                                                                                                            data-toggle="reload">
                            <i class="fa-rotate-right"></i> </a> <a href="#" data-toggle="remove">
                            ×
                        </a></div>
                    <h1 class="panel-title">Incidentes por Tipo de Ataque (7 dias)</h1>
                </div>
                <div class="panel-body">
                    @include('chart._type')
                </div>
            </div>
        </div>
    </div>
@endsection