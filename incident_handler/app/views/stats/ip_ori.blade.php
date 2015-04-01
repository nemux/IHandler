@extends('layouts.master')
@section('content')
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
    <link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                </div>
                <h4 class="panel-title">Reporte por IP's</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" action="/stats/ip/origin" method="POST">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Rango de fechas</label>
                        <div class="col-md-2">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Fecha de Inicio" />
                                <span class="input-group-addon">a</span>
                                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Fecha Final" />
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="input-group">
                                <select class="form-control" id="ip_type" name="ip_type">
                                    <option value="source_id">Origen</option>
                                    <option value="destiny_id">Destino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <select id="customer" name="customer" class="form-control">
                                    <option value="0">Todos los Clientes</option>
                                    {{--*/ $customers = Customer::all(); /*--}}
                                    @foreach ($customers as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select><br/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <input type="submit" class="btn btn-default" id="generate" name="generate" value="Generar Reporte"/>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

@if(isset($update))
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script>
        $(document).ready(function() {

            TableManageDefault.init();
        });
    </script>
    <div class="col-md-12" style="min-width:800px;">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Direcciones IP {{ $fuente }}</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover  ">
                        <thead>
                        <tr>
                            <th>
                                IP
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($iplist as $ip)
                        <tr>
                            <td> {{ $ip->ip  }} </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div><br>
                <div class="col-lg-4">
                    <a class="btn btn-primary" href="/report/ip/doc?t={{ $type }}&s={{$start_date}}&e={{$end_date}}" target="blank"><i class="fa fa-file-word-o"></i> Generar doc</a>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="/assets/js/table-manage-default.demo.min.js"></script>
    <script src="/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@endif
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
        $(document).ready(function() {
            FormPlugins.init();
        });
    </script>
@stop