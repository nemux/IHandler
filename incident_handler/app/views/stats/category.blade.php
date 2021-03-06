@extends('layouts.master')
@section('content')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet"/>
    <link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet"/>
    <link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet"/>
    <link href="/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->


    <script src="/assets/highcharts/js/highcharts.js"></script>
    <script src="/assets/highcharts/js/highcharts-3d.js"></script>
    <script src="/assets/highcharts/js/modules/exporting.js"></script>
    <!DOCTYPE HTML>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>

        <style type="text/css">
            ${demo.css}
        </style>
        <script type="text/javascript">

        </script>

        <script charset="utf-8">
            function graph(start, end, customer, sensor, nombre_sensor) {
                $.ajax({
                    type: "POST",
                    url: "/stats/category/graph",
                    data: {start: start, end: end, customer: customer, sensor: sensor, nombre_sensor: nombre_sensor},
                    success: function (result) {
                        $("#target").html("");
                        $("#target").html(result);
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                })
            }

            function selectCustomer(customer) {
                $.ajax({})
            }
        </script>

    </head>
    <body>
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">

                </div>
                <h4 class="panel-title">Incidentes por Categoría</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered">

                    <div class="form-group">
                        <label class="col-md-2 control-label">Rango de fechas</label>

                        <div class="col-md-2">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" id="start" placeholder="Fecha de Inicio"/>
                                <span class="input-group-addon">a</span>
                                <input type="text" class="form-control" id="end" placeholder="Fecha Final"/>

                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <select id="customer" class="form-control">
                                    <?php $customers = Customer::all(); ?>
                                    <?php foreach ($customers as $c): ?>
                                    <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <select id="sensor" class="form-control">
                                    <?php $sensors = Sensor::all(); ?>
                                    <?php foreach ($sensors as $s): ?>
                                    <option value="<?php echo $s->id ?>"><?php echo $s->name ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="input-group">
                                <a class="btn btn-default" id="generate"
                                   onclick='graph($("#start").val()
                                        ,$("#end").val()
                                        ,$("#customer").val()
                                        ,$("#sensor").val()
                                        ,$("#sensor option:selected").text())'>Generar Gráfica</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>


    <div id="target">

    </div>


    </body>
    </html>


    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
    <script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/plugins/masked-input/masked-input.min.js"></script>
    <script src="/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/assets/plugins/password-indicator/js/password-indicator.js"></script>
    <script src="/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
    <script src="/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
    <script src="/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
    <script src="/assets/js/form-plugins.demo.min.js"></script>
    <script src="/assets/js/apps.min.js"></script>

    <script>
        $(document).ready(function () {

            FormPlugins.init();

            $('#customer').change(function () {
                $.get('/incident/sensor/get/' + $('#customer').val(),
                        function (data) {
                            $('#sensor').empty();
//                            $('#sensor').append("<option value=''> Sensor (Opcional)</option>");
                            $.each(data, function (key, element) {
                                if (key ==<?php if (isset($incident->sensor->id)) {echo $incident->sensor->id;}else{ echo "-1"; } ?>) {
                                    $('#sensor').append("<option selected value='" + key + "'>" + element + "</option>");
                                } else {
                                    $('#sensor').append("<option value='" + key + "'>" + element + "</option>");
                                }
                            });
                        });
            });

            $.get('/incident/sensor/get/' + $('#customer').val(),
                    function (data) {
                        $('#sensor').empty();
//                        $('#sensor').append("<option value=''> Sensor (Opcional)</option>");
                        $.each(data, function (key, element) {
                            if (key ==<?php if (isset($incident->sensor->id)) {echo $incident->sensor->id;}else{ echo "-1"; } ?>) {
                                $('#sensor').append("<option selected value='" + key + "'>" + element + "</option>");
                            } else {
                                $('#sensor').append("<option value='" + key + "'>" + element + "</option>");
                            }
                        });
                    });
        });
    </script>

@stop
