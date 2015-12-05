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
        {{--$(document).ready(function () {--}}
        {{--$('form').submit(function (event) {--}}
        {{--event.preventDefault();--}}
        {{--$.ajax({--}}
        {{--url: '{{route('report.incident.post',$type)}}',--}}
        {{--data: $(this).serialize(),--}}
        {{--method: 'post',--}}
        {{--headers: {--}}
        {{--'X-CSRF-TOKEN': '{{csrf_token()}}'--}}
        {{--},--}}
        {{--success: function (result) {--}}
        {{--if (result.err_code) {--}}
        {{--showMessage('warning', result.err_message);--}}
        {{--}--}}
        {{--//                        else {--}}
        {{--//                            showMessage('success', result.message);--}}
        {{--//                        }--}}
        {{--},--}}
        {{--error: function (result) {--}}
        {{--showMessage('danger', result);--}}
        {{--}--}}
        {{--});--}}
        {{--});--}}
        {{--});--}}

        function showMessage(type, message) {
            var messages = $('#messages');
            messages.empty();
            var div = $('<div class="alert alert-' + type + '"><ul><li>' + message + '</li></ul></div>');
            div.appendTo(messages);
        }
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

                    <div class="col-md-2 col-sm-6 form-group">
                        @include('formcontrols._fromdate',['id'=>'from_date'])
                    </div>
                    <div class="col-md-2 col-sm-6 form-group">
                        @include('formcontrols._todate',['id'=>'to_date'])
                    </div>
                    <div class="col-md-4 col-sm-12 form-group">
                        @include('formcontrols._customer',['id'=>'customer'])
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                        @include('formcontrols._sensor',['id'=>'sensor','customer_id'=>'customer','multiple'=>true])
                    </div>
                    <div class="col-md-2 col-sm-12 form-group">
                        <input type="submit" id="submit" class="btn btn-success form-control" value="Generar Reporte">
                    </div>

                    @if($type=='date')
                    @endif
                </form>
            </div>
            <div id="messages"></div>
        </div>
    </div>
@endsection