@extends('layout.dashboard_topmenu')

@section('title', 'Dashboard Helpdesk')

@section('include_down')
    {{--Widgets--}}
    <script src="/xenon/assets/js/xenon-widgets.js" id="script-resource-7"></script>

    {{--HighCharts--}}
    <script src="/custom/assets/js/highcharts-4.1.9/highcharts.js"></script>
    <script src="/custom/assets/js/highcharts-4.1.9/modules/data.js"></script>

    <script>
        $(document).ready(function () {

        });
    </script>
@endsection

@section('dashboard_content')
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="xe-widget xe-counter xe-counter-warning" data-status="1" data-count=".num" data-from="0"
                 data-to="{{$in_count}}"
                 data-suffix=" Tickets"
                 data-duration="1">
                <div class="xe-icon">
                    <i class="fa fa-warning"></i>
                </div>
                <div class="xe-label">
                    <strong class="num">0 Tickets</strong>
                    <span>Incidentes</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="xe-widget xe-counter xe-counter-info" data-status="2" data-count=".num" data-from="0"
                 data-to="{{$cc_count}}"
                 data-suffix=" Tickets"
                 data-duration="1">
                <div class="xe-icon">
                    <i class="fa fa-code-fork"></i>
                </div>
                <div class="xe-label">
                    <strong class="num">0 Tickets</strong>
                    <span>Control de Cambios</span>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3>Tickets</h3>
            </div>
        </div>
        <div class="panel-body">
            @include('helpdesk.chart.tickets')
        </div>
    </div>
@endsection