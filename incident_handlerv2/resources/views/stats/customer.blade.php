@extends('layout.dashboard_topmenu')

@section('title', 'Estadísticas de Incidentes por Cliente')

@section('include_up')
@endsection

@section('include_down')
    <script type="text/javascript">
        var options = {
            chart: {type: 'spline', renderTo: 'chart'},
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {day: '%d/%b',},
                title: {text: 'Fecha'},
                labels: {
//                    rotation: -45
//                    style: {
//                        fontSize: '13px',
//                        fontFamily: 'Verdana, sans-serif'
//                    }
                }
            },
            yAxis: {title: {text: 'Incidentes por día'}, min: 0},
            tooltip: {
                headerFormat: '<b>{point.x:%d/%b}</b><br/>',
                pointFormat: '{point.y} Incidentes'
            },
            exporting: {sourceWidth: 1800, sourceHeight: 500},
            plotOptions: {spline: {marker: {enabled: true}}},
            series: []
        };

        $(document).ready(function () {
            $("#customer_id").select2({
                placeholder: 'Cliente...',
                allowClear: true,
                dropdownAutoWidth: true
            }).on('select2-open', function () {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
            }).change(function () {
                /**
                 * Obtiene de un WS los sensores relacionados al cliente seleccionado en el combo box
                 */
                var customer_id = $(this).find('option:selected').attr('value');

                if (!customer_id) {
                    $("#sensors").select2("val", "").empty();
                    $('#customer_separated').attr('disabled', false);
                    return;
                } else {
                    $('#customer_separated').attr('disabled', true).prop('checked', false);
                    $('#sensor_separated').attr('disabled', false).prop('checked', true);
                }

                $.ajax({
                    url: '/dashboard/ws/sensors/' + customer_id,
                    type: 'get',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (result) {
                        $("#sensors").select2("val", "").empty().attr('disabled', false);

                        if (result.status === true) {
                            $('#sensors').append($('<option>', {}));
                            $.each(result.sensors, function (i, item) {
                                $('#sensors').append($('<option>', {
                                    value: item.id,
                                    text: item.name
                                }));
                            });
                        }
                    },
                    fail: function (result) {
                        console.log(result);
                    }
                });

            });

            $("#sensors").select2({
                placeholder: 'Sensor(es)...',
                allowClear: true,
                dropdownAutoWidth: true
            }).on('select2-open', function () {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
            }).change(function () {
                var sensors = $(this).val();

                if (sensors == null) {
                    $('#sensor_separated').attr('disabled', false);
                } else if (sensors.length == 1) {
                    $('#sensor_separated').attr('disabled', true).prop('checked', false);
                } else {
                    $('#sensor_separated').attr('disabled', false).prop('checked', true);
                }
            });

            $('#submit').click(function (e) {
                $('#submit').attr('disabled', true);
                $.ajax({
                    url: '{{route('stats.customer.post')}}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        from_date: $('#from_date').val(),
                        to_date: $('#to_date').val(),
                        customer_id: $('#customer_id').val(),
                        sensors: $('#sensors').val(),
                        customer_separated: $('#customer_separated').is(':checked'),
                        sensor_separated: $('#sensor_separated').is(':checked')
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    success: function (response) {
                        var div = $("#chart");
                        div.attr('hidden', false);
                        var data = [];
                        options.series = [];

                        var sensors = '';

                        var optSensors = $('#sensors option:selected');
                        if (optSensors.length > 0) {
                            $.each(optSensors, function (index, item) {
                                if (index != 0) {
                                    sensors += ', ' + item.text;
                                } else {
                                    sensors += '<br/>Sensor(es): ' + item.text;
                                }
                            });
                        }

                        options.subtitle = {text: $('#customer_id option:selected').text() + sensors};
                        options.title = {text: 'Incidentes registrados del ' + $('#from_date').val() + ' al ' + $('#to_date').val()};

                        if ($('#customer_separated').is(':checked') || $('#sensor_separated').is(':checked')) {
                            $.each(response, function (index, item) {
                                data = [];
                                $.each(item.data, function (index, item) {
                                    data.push([Date.parse(item.date), item.count]);
                                });
                                options.series.push({name: item.name, data: data});
                            });
                        } else {
                            data = [];
                            $.each(response, function (index, item) {
                                data.push([Date.parse(item.date), item.count]);
                            });

                            options.series.push({name: 'Incidentes', data: data});
                        }

                        var chart = new Highcharts.Chart(options);

                        $('#submit').attr('disabled', false);
                    }
                });
            });
        });
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
            <h3 class="panel-title">Estadísticas de Incidentes por Cliente</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-md-2 col-xs-12">
                    <div class="date-and-time">
                        <input name="from_date" id="from_date" type="text"
                               class="form-control datepicker" data-format="dd/mm/yyyy"
                               data-end-date="{{date('d/m/Y')}}" placeholder="Fecha de Inicio">
                    </div>
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    <div class="date-and-time">
                        <input name="to_date" id="to_date" type="text"
                               class="form-control datepicker" data-format="dd/mm/yyyy"
                               data-end-date="{{date('d/m/Y')}}" placeholder="Fecha Final">
                    </div>
                </div>
                <div class="form-group col-md-4 col-xs-12">
                    <select class="form-control" id="customer_id" name="customer_id">
                        <option></option>
                        @foreach(\App\Models\Customer\Customer::all(['name','id']) as $index=>$customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                    <label>Separar Clientes <input type="checkbox" checked="true" id="customer_separated"
                                                   name="customer_separated">
                    </label>
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    <select class="form-control" id="sensors" name="sensors[]" multiple="multiple">
                        <option></option>
                    </select>
                    <label>Separar Sensores <input type="checkbox" disabled="true" id="sensor_separated"
                                                   name="sensor_separated">
                    </label>
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    <input type="button" class="form-control btn btn-success" value="Generar gráfica" id="submit">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div hidden id="chart" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection