@extends('layout.dashboard_topmenu')

@section('title', 'Dashboard Incident Manager')

@section('include_down')
    <script src="/xenon/assets/js/devexpress-web-14.1x/js/globalize.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/devexpress-web-14.1x/js/dx.chartjs.js" id="script-resource-8"></script>

    {{--HighCharts--}}
    <script src="/custom/assets/js/highcharts-4.1.9/highcharts.js"></script>
    <script src="/custom/assets/js/highcharts-4.1.9/modules/data.js"></script>

    <script>
//        var xenonPalette = ['#68b828', '#7c38bc', '#0e62c7', '#fcd036', '#4fcdfc', '#00b19d', '#ff6264', '#f7aa47'];
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
                    console.log(response);
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
                    console.log(response);
                }
            });
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ol id="incidents-list">
                        {{--Populated with Ajax Request--}}
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('dashboard.chart._incidents')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ol id="surveillance-list">
                        {{--Populated with Ajax Request--}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.chart._criticity')
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.chart._flow')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.chart._category')
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    @include('dashboard.chart._type')
                </div>
            </div>
        </div>
    </div>
@endsection