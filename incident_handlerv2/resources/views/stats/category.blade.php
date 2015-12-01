@extends('layout.dashboard_topmenu')

@section('title', 'Estadísticas de Incidentes por Categoría')

@section('include_up')
@endsection

@section('include_down')
    <script type="text/javascript">
        var options = {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                renderTo: 'chart'
            },
            exporting: {sourceWidth: 1800, sourceHeight: 500},
            tooltip: {
                pointFormat: '{series.name}: {point.y} <b>({point.percentage:.2f}%)</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br/>{point.y} Incidentes <b>({point.percentage:.2f}%)</b>'
                    }
                }
            },
            series: [{
                name: 'Incidentes',
                colorByPoint: true,
                data: []
            }]
        };

        var Graph = {
            make: function () {
                $.ajax({
                    url: '{{route('stats.category.post')}}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        from_date: $('#from_date').val(),
                        to_date: $('#to_date').val(),
                        customer_id: $('#customer_id').val(),
                        sensor_id: $('#sensor_id').val()
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    success: function (response) {
                        console.log(response);

                        var div = $("#chart");
                        div.attr('hidden', false);

                        var sensors = '';

                        var optSensors = $('#sensor_id option:selected');

                        if (optSensors.text() != '') {
                            sensors = '<br/>Sensor: ' + optSensors.text();
                        }

                        options.subtitle = {text: $('#customer_id option:selected').text() + sensors};
                        options.title = {text: 'Incidentes por Categoría del ' + $('#from_date').val() + ' al ' + $('#to_date').val()};

                        var data = [];
                        $.each(response, function (index, item) {
                            console.log(item.name + ':' + item.count);
                            data.push([item.name, item.count]);
                        });

                        options.series[0].data = data;

                        var chart = new Highcharts.Chart(options);

                        $('#submit').attr('disabled', false);
                    }
                });
            }
        };
    </script>
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

    {{--HighCharts--}}
    <script src="/custom/assets/js/highcharts-4.1.9/highcharts.js"></script>
    <script src="/custom/assets/js/highcharts-4.1.9/modules/data.js"></script>
    <script src="/custom/assets/js/highcharts-4.1.9/modules/exporting.js"></script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Estadísticas de Incidentes por Categoría</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-md-2 col-xs-12">
                    @include('stats.controls._fromdate',['id'=>'from_date'])
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    @include('stats.controls._todate',['id'=>'to_date'])
                </div>
                <div class="form-group col-md-4 col-xs-12">
                    @include('stats.controls._customer',['id'=>'customer_id'])
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    @include('stats.controls._sensor',['id'=>'sensor_id','customer_id'=>'customer_id'])
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    @include('stats.controls._submit',['id'=>'submit'])
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('stats.controls._chart')
                </div>
            </div>
        </div>
    </div>
@endsection