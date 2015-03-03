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
                <h4 class="panel-title">Reporte</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" action="/report/create/doc" method="POST">
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
                                <select class="form-control" id="time_type" name="time_type">
                                    {{--*/ $time_types = TimeType::all();  /*--}}
                                    @foreach( $time_types as $t)
                                        <option value="{{ $t->id }}">{{$t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <select id="customer" name="customer" class="form-control">
                                    {{--*/ $customers = Customer::all(); /*--}}
                                    @foreach ($customers as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (isset($type))
                            @if ($type == 'handler')
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <select id="type" name="type_value" class="form-control">
                                            {{--*/ $handler = IncidentHandler::all(); /*--}}
                                            @foreach ($handler as $h)
                                                <option value="{{ $h->id }}">{{ $h->name . ' ' . $h->lastname }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="type" value="handler">
                                    </div>
                                </div>
                            @endif
                            @if ($type == 'category')
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <select id="type" name="type_value" class="form-control">
                                            {{--*/ $category = Category::all(); /*--}}
                                            @foreach ($category as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="type" value="category">
                                    </div>
                                </div>
                            @endif
                            @if ($type == 'severity')
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <select id="type" name="type_value" class="form-control">
                                            <option value="ALTA">ALTA</option>
                                            <option value="MEDIA">MEDIA</option>
                                            <option value="BAJA">BAJA</option>
                                        </select>
                                        <input type="hidden" name="type" value="severity">
                                    </div>
                                </div>
                            @endif
                            @if ($type == 'status')
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <select id="type" name="type_value" class="form-control">
                                            {{--*/ $incidentStatus = IncidentStatus::all(); /*--}}
                                            @foreach ($incidentStatus as $i)
                                                <option value="{{ $i->id }}">{{ $i->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="type" value="status">
                                    </div>
                                </div>
                            @endif
                            @if ($type == 'ip')
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <input type="text" name="type_value" class="form-control">
                                        <input type="hidden" name="type" value="status">
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="col-lg-2">
                            <div class="input-group">
                                <input type="submit" class="btn btn-default" id="generate" name="generate" value="Generar Reporte"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>

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