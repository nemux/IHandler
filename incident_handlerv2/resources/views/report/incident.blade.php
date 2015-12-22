@extends('layout.dashboard_topmenu')

@section('title', 'Reportes')

@section('include_up')
@endsection

@section('include_down')
    {{--Custom Select Form--}}
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2.css" id="style-resource-2">
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2-bootstrap.css" id="style-resource-3">
    <script src="/xenon/assets/js/select2/select2.min.js" id="script-resource-12"></script>

    {{--Date & Time Pickers--}}
    <link rel="stylesheet" href="/xenon/assets/js/daterangepicker/daterangepicker-bs3.css" id="style-resource-1">

    <script src="/xenon/assets/js/moment.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/daterangepicker/daterangepicker.js" id="script-resource-8"></script>
    <script src="/xenon/assets/js/datepicker/bootstrap-datepicker.js" id="script-resource-9"></script>
    <script src="/xenon/assets/js/timepicker/bootstrap-timepicker.min.js" id="script-resource-10"></script>

    <script type="text/javascript">
        var type = '{{$type}}';

        $(document).ready(function () {
            var panel = $('.panel-title');

            switch (type) {
                case 'date':
                    $(panel).text("Reporte de Incidentes por Fecha");
                    break;
                case 'handler':
                    $(panel).text("Reporte de Incidentes por Handler");
                    break;
                case 'category':
                    $(panel).text("Reporte de Incidentes por Categoría");
                    break;
                case 'criticity':
                    $(panel).text("Reporte de Incidentes por Severidad");
                    break;
                case 'status':
                    $(panel).text("Reporte de Incidentes por Estatus");
                    break;
                case 'ip':
                    $(panel).text("Reporte de Incidentes por IP");
                    break;
                case 'csv':
                    $(panel).text("Reporte de Incidentes en formato CSV");
                    break;
                case 'list':
                    $(panel).text("Lista de Incidentes por Cliente, Sensor y Severidad");
                    break;
            }
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Reporte de Incidentes</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <form action="{{route('report.incident.post',$type)}}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="col-md-1 col-sm-6 form-group">
                        @include('formcontrols._fromdate',['id'=>'from_date'])
                    </div>
                    <div class="col-md-1 col-sm-6 form-group">
                        @include('formcontrols._todate',['id'=>'to_date'])
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                        @include('formcontrols._customer',['id'=>'customer'])
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                        @include('formcontrols._sensor',['id'=>'sensor','customer_id'=>'customer'])
                    </div>

                    <div class="col-md-2 col-sm-12 form-group">
                        @if($type=='date')
                        @elseif($type=='handler')
                            @include('formcontrols._user',['id'=>'user'])
                        @elseif($type=='category')
                            @include('formcontrols._category',['id'=>'category'])
                        @elseif($type=='criticity')
                            @include('formcontrols._criticity',['id'=>'criticity'])
                        @elseif($type=='status')
                            @include('formcontrols._status',['id'=>'status'])
                        @elseif($type=='ip')
                            <input class="form-control" type="text" id="ip" name="ip" placeholder="IP1, IP2,..., IP-n">
                            @include('formcontrols._eventside',['id'=>'eventside'])
                        @elseif($type=='csv')
                        {{--@elseif($type=='list')--}}
                            {{--@include('formcontrols._criticity',['id'=>'criticity'])--}}
                        @endif
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <input checked type="checkbox" id="no-open" name="no-open">
                        <label for="no-open">Omitir tickets abiertos</label>
                        <br/>
                        <input type="checkbox" id="list-items" name="list-items">
                        <label for="list-items">Generar sólo lista</label>
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        <input type="submit" id="submit" class="btn btn-success form-control" value="Generar Reporte">
                    </div>
                </form>
            </div>
            <div id="messages"></div>
        </div>
    </div>
@endsection