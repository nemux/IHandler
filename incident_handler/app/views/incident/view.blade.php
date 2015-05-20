@extends('layouts.master')
@section('content')

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
    <script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
    <script src="/assets/js/form-wysiwyg.demo.min.js"></script>
    <Script src="/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet"/>
    <link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet"/>
    <link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-picker/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet"/>
    <link href="/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <script charset="utf-8">
        var count_files = 0;
        $(document).ready(function () {
            Form1.init();
            Form2.init();
            nobackbutton();
            $("#images").change(function () {
                //get the input and UL list
                var input = document.getElementById('images');
                count_files = input.files.length;
                if (count_files > 0) {
                    $("#solved").removeClass("disabled");

                }
                if (count_files == 0) {
                    $("#solved").removeClass("disabled");
                    $("#solved").addClass("disabled");
                }
                $("#file_message").text("(" + count_files + ") Archivos seleccionados");
            });

            $('#falso_positivo').click(function () {
                //alert()
                $('#next_status').val('5');
                $('#send').click();

            });

            $('#return_abierto').click(function () {
                $('#next_status').val("1");
                $('#send').click();

            });

        });
    </script>

    <script charset="utf-8">
        $("#send").click(function () {
            this.addClass("disabled");
        });

        function nobackbutton() {
            window.location.hash = "no-back-button";
            window.location.hash = "Again-No-back-button" //chrome
            window.onhashchange = function () {
                window.location.hash = "no-back-button";
            }
        }
    </script>
    <!-- begin #page-loader -->
    <!-- <div id="page-loader" class="fade in"><span class="spinner"></span></div> -->
    <!-- end #page-loader -->

    <!-- begin #page-container -->


    <h1 class="page-header" style="color:#FFF">Reporte de incidente (En {{$incident->status->name}} -
        Actualizado: {{$incident->updated_at}})
        <small></small>
    </h1>
    <!-- end page-header -->

    <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">

            </div>
            <h4 class="panel-title">Título: {{ $incident->title }}  </h4>
        </div>
        <div class="panel-body">
            @if($incident->incident_handler_id == Auth::user()->incident_handler_id || Auth::user()->type->name == 'admin' || Auth::user()->type->name == 'user_2')
                @foreach($incident->observations as $o)
                    <div class="form-group">

                        <div class="alert alert-info">
                            <span class="close" data-dismiss="alert">×</span>
                            <strong>{{$o->created_at}}</strong>
                            <br>{{$o->content}}

                        </div>
                    </div>
                @endforeach
            @endif
            <div class="form-group">
                <table class="table table-bordered">
                    <tr>
                        <td style="text-align:center;background:#CCC" colspan="3">
                            <strong>Incidente: {{$incident->title}}</strong>
                        </td>

                    </tr>
                    <tr style="padding:0px;margin:0px">
                        <td style="text-align:center;background:#CCC" colspan="1">
                            <strong>Categoría:</strong>
                        </td>
                        <td style="border-collapse: collapse;width:100%;padding:0px" colspan="2">
                            <table class="table" style="border-collapse: collapse;width:100%;margin:0px">
                                <tr>
                                    <td colspan="2" style="text-align:center;background:#CCC;">
                                        Descripción
                                    </td>
                                </tr>
                                <tr style="width:100%">
                                    <td style="text-align:center;width:25%">
                                        {{($incident->category->id-1)}}
                                    </td>
                                    <td style="text-align: justify;">
                                        {{$incident->category->name}}
                                        {{$incident->category->description}}
                                    </td>
                                </tr>
                                @foreach($incident->extraCategory as $ec)
                                    <tr style="width:100%">
                                        <td style="text-align:center;width:25%">
                                            {{$ec->category->id-1}}
                                        </td>
                                        <td style="text-align: justify;">
                                            {{$ec->category->name}}
                                            {{$ec->category->description}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Sensor:</strong>
                        </td>
                        <td style="text-align:center;padding:0px">
                            {{$incident->sensor->name}}
                            <table class="table" style="margin:0px;padding:0px;">
                                @foreach($incident->extraSensor as $es)
                                    <tr style="margin:0px;padding:0px;">
                                        <td style="margin:0px;padding:0px;">
                                            {{$es->sensor->name}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Ticket:</strong>
                        </td>
                        <td style="text-align:center;">
                            @if (isset($incident->ticket->internal_number))
                                {{$incident->ticket->internal_number}}
                            @else
                                {{"Por asignar..."}}
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Status:</strong>
                        </td>
                        <td style="text-align:center;">
                            {{$incident->status->name}}
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Indicador de Compromiso Inicial:</strong>
                        </td>
                        <td style="text-align:center;">
                            @foreach($incident->incidentRule as $r)
                                {{$r->rule->message}}
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Flujo del ataque:</strong>
                        </td>
                        <td style="text-align:center;">
                            {{$incident->stream}}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Fecha de detección:</strong>
                        </td>
                        <td style="text-align:center;">
                            {{$det_time->datetime}}, {{$det_time->zone}}
                        </td>
                    </tr>
                    <tr style="padding:0">

                        <td style="text-align:center;background:#CCC;">
                            <strong>Severidad:</strong>
                        </td>

                        <?php
                        $font = "";
                        $color = "";
                        if ($incident->criticity == "BAJA") {
                            $color = "#01DF3A";
                            $font = "#000";
                        } else if ($incident->criticity == "MEDIA") {
                            $color = "#F7FE2E";
                            $font = "#000";
                        } else if ($incident->criticity == "ALTA") {
                            $color = "#FE2E2E";
                            $font = "#FFF";
                        }
                        ?>

                        <td style="text-align:center;background-color:{{ $color }};color:{{ $font }}">
                            <div style="width:100%;height:100%;">
                                {{ $incident->criticity;}}
                            </div>

                        </td>

                    </tr>
                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Dirección IP de Origen:</strong>
                        </td>
                        <td style="text-align:center;">
                            <table>
                                @foreach($incident->srcDst as $ip)
                                    @if($ip->src->ip != "" && $ip->src->show != false)
                                        {{ $ip->src->ip}}<br/>
                                    @endif
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Dirección IP Destino:</strong>
                        </td>
                        <td style="text-align:center;">
                            <table>
                                @foreach($incident->srcDst as $ip)
                                    @if($ip->dst->ip != "" && $ip->dst->show != false)
                                        {{ $ip->dst->ip }}<br/>
                                    @endif
                                @endforeach
                            </table>
                        </td>
                    </tr>

                    @if(count($listed)>0)
                        <tr>
                            <td style="text-align:center;background:#CCC">
                                <strong>Blacklist:</strong>
                            </td>
                            <td colspan="2" style="padding:0">
                                <table style="border-collapse:collapse;width:100%">
                                    <tr>
                                        <th style="text-align:center;background:#CCC;">
                                            Dirección IP
                                        </th>
                                        <th style="text-align:center;background:#CCC">
                                            País de Origen
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:center">
                                            <?php $count = 0 ?>
                                            @foreach($listed as $l)
                                                {{ $l->ip }} [{{ ++$count }}]<br>
                                            @endforeach
                                            <br/>
                                        </td>
                                        <td style="text-align:center">
                                            @foreach($location as $l)
                                                @if(isset($l->location))
                                                    {{$l->location}}<br>
                                                @endif
                                            @endforeach
                                            <br>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif


                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Descripción:</strong>
                        </td>
                        <td style="text-align:justify;text-justify: inter-word;">
                            {{ $incident->description }}<br>
                            {{ $incident->conclution }}
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Recomendación:</strong>
                        </td>
                        <td style="text-align:justify;text-justify: inter-word;">
                            {{ $incident->recomendation }} <br/>
                            @if (count($recomendations) > 0 )
                                @foreach($recomendations as $r )
                                    [{{ $r->created_at }} ]<br/>
                                    {{ $r->content }} <br/>
                                @endforeach
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;background:#CCC;">
                            <strong>Referencia:</strong>
                        </td>
                        <td style="text-align:justify;text-justify: inter-word;">
                            {{ $incident->reference->link }}<br>
                        </td>
                    </tr>

                </table>
            </div>


            @foreach ($incident->annexes as $a )
                <div class="form-group">
                    <table class="table table-bordered" width="100%">
                        <tr style="text-align:center;background:#CCC;">
                            <td colspan="2">
                                <strong> {{ $a->title }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center;background:#CCC;width:15%">
                                {{ $a->field }}
                            </td>
                            <td>
                                {{ $a->content }}
                            </td>
                        </tr>
                    </table>
                    <div class="col-lg-12">
                        <a class="btn btn-default pull-right" href="/incident/del/Annex/{{ $a->id }}">Borrar anexo</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if(count($incident->images)>0)
        <div class="panel panel-inverse">
            <div class="panel-heading">Evidencias del caso</div>
            <div class="panel-body">
                <table>
                    <thead>
                    <tr>
                        <th width="30%">Evidencia del Incidente</th>
                        <th width="30%">Evidencia de Falso Positivo</th>
                        <th width="30%">Evidencia de Cierre</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="col-lg-3">
                                @foreach ($incident->images as $i)
                                    @if ($i->evidence_types_id == '1')
                                        <a href="/files/evidence/{{ $i->name }}" target="blank" style="color:black;">
                                            <i class="fa fa-cube fa-2x"></i>
                                            {{ $i->name }}
                                        </a><br/>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="col-lg-3">
                                @foreach ($incident->images as $i)
                                    @if ($i->evidence_types_id == '3')
                                        <a href="/files/evidence/{{ $i->name }}" target="blank" style="color:black;">
                                            <i class="fa fa-cube fa-2x"></i>
                                            {{ $i->name }}
                                        </a><br/>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="col-lg-3">
                                @foreach ($incident->images as $i)
                                    @if ($i->evidence_types_id == '2')
                                        <a href="/files/evidence/{{ $i->name }}" target="blank" style="color: black;">
                                            <i class="fa fa-cube fa-2x"></i>
                                            {{ $i->name }}
                                        </a><br/>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
        @endif

                <!-- botones de camnbio-->
        <div class="col-lg-12" style="margin-bottom:50px">
            {{Form::open(array('method'=>'POST','action' => 'IncidentController@updateStatus','enctype'=>'multipart/form-data'))}}
            <a class="btn btn-inverse" href="/incident/pdf/{{ $incident->id }}" target="blank"><i
                        class="fa fa-file-pdf-o"></i> Generar pdf</a>
            <a class="btn btn-inverse" href="/incident/doc/{{ $incident->id }}" target="blank"><i
                        class="fa fa-file-word-o"></i> Generar doc</a>

            @if (Auth::user()->type->name == 'admin' || Auth::user()->type->name == 'user_2')
                <a class="btn btn-inverse data-toogle" data-toggle="modal" href="#modal-dialog">Añadir observaciones</a>
            @endif

            @if ($incident->incidents_status_id < 3)
                <a class="btn btn-inverse data-toogle" data-toggle="modal" href="#modal-dialog2">Añadir anexo</a>
            @endif

            @if ($incident->incident_handler_id == Auth::user()->incident_handler_id || Auth::user()->type->name == 'admin' || Auth::user()->type->name == 'user_2')

                <input type="hidden" name="id" value="{{ $incident->id }}">
                @if ($incident->incidents_status_id == 1 && $message == "")
                    <a class="btn btn-primary" href="/incident/update/{{ $incident->id }}"><i
                                class="fa fa-edit"></i>
                        editar</a>
                    {{--<a class="btn btn-danger" id="falso_positivo">Marcar como falso positivo</a>--}}

                    <a class="btn btn-danger data-toogle" data-toggle="modal" href="#modal-dialog3">Marcar como falso
                        positivo</a>
                    <input type="hidden" name="status" value="2" id="next_status">
                    @if (Auth::user()->type->name == 'user_2' || Auth::user()->type->name == 'admin')
                        {{Form::submit('Mover a Investigación',['class'=>'btn btn-primary pull-right ','id'=>'send']);}}
                    @endif

                @endif
            @endif

            @if ($message != "")
                <a class="btn btn-primary" href="/incident/update/{{ $incident->id }}"><i
                            class="fa fa-edit"></i>
                    editar</a>

                <div class="col-lg-2 pull-right">
                    {{ $message }}
                </div>
            @endif

            @if ($incident->incidents_status_id == 2)
                <a class="btn btn-primary" href="/incident/update/{{ $incident->id }}"><i
                            class="fa fa-edit"></i>
                    editar</a>
                <input type="hidden" name="status" id="next_status" value="3">
                {{--<a class="btn btn-danger" id="falso_positivo">Marcar como falso positivo</a>--}}
                <a class="btn btn-danger data-toogle" data-toggle="modal" href="#modal-dialog3">Marcar como falso
                    positivo</a>
                <input type="hidden" name="id" value="{{ $incident->id }}">
                @if (Auth::user()->type->name == 'user_2' || Auth::user()->type->name == 'admin')
                    {{Form::submit('Mover a Resuelto',['class'=>'btn btn-primary pull-right ','id'=>'send', 'style'=>'margin-left:2px']);}}
                @endif
                {{Form::submit('Enviar nueva recomendación',['name'=>'send_recomendation', 'class'=>'btn btn-primary pull-right']);}}
                <!--<a style="margin-right:3px" class="btn btn-info pull-right" id="return_abierto">Regresar a Abierto</a>-->
            @endif


            @if ($incident->incidents_status_id == 5)

                <input type="hidden" name="status" id="next_status" value="1">
                <input type="hidden" name="id" value="{{ $incident->id }}">
                {{--Form::submit('Mover a Abierto',['class'=>'btn btn-primary pull-right ','id'=>'send']);--}}
                @endif

                        <!-- bloque de status 2 -->
                @if ($incident->incidents_status_id == 3)
                    <input type="hidden" name="status" value="4" id="next_status">
                    <input type="hidden" name="id" value="{{ $incident->id }}">

                    <div style="margin-left:2px" name="button" id="evidence" class="btn btn-primary pull-right"
                         onclick="$('#images').click()">Seleccionar evidencia
                    </div>
                    <input class="btn btn-default " type="file" id="images" name="images[]" multiple
                           style="display:none">
                    @if (Auth::user()->type->name == 'user_2' || Auth::user()->type->name == 'admin')
                        {{Form::submit('Mover a Cerrado',['class'=>'disabled btn btn-primary pull-right ','id'=>'solved', 'style'=>'margin-left:2px']);}}
                    @endif
                    {{Form::submit('Enviar nueva recomendación',['name'=>'send_recomendation', 'class'=>'btn btn-primary pull-right']);}}
                    <div class="col-lg-1 pull-right">
                        <p id="file_message">

                        </p>
                    </div>
                @endif
                {{ Form::close() }}
        </div>

        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
           data-click="scroll-top"><i
                    class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
        </div>
        <!-- end page container -->


        <div class="modal fade" id="modal-dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Añadir Observaciones</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            {{Form::open(array('method'=>'POST','action' => 'IncidentController@addObservation','enctype'=>'multipart/form-data'))}}
                            {{Form::textarea('observation',null,[
                                  'class'=>'form-control parsley-validated',
                                  "data-parsley-pattern"=>"",
                                  "data-parsley-required"=>"true",
                                  "placeholder"=>"Observaciones del incidente",
                                  "id"=>"description",
                                  ]);
                            }}
                            <input type="hidden" name="incident_id" value="{{ $incident->id }}">
                            <input type="hidden" name="handler_id" value="{{ $incident->handler->id }}">
                            {{Form::submit('Guardar comentario',['class'=>'btn btn-primary pull-right ', 'style'=>'margin-left:2px']);}}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-dialog3">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Añadir evidencia de Falso Positivo</h4></div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="form-group" style="padding:20px">
                                {{Form::open(array('method'=>'POST','action' => 'IncidentController@changeToFalsoPositivo','enctype'=>'multipart/form-data'))}}
                                <input type="hidden" name="incident_id" value="{{ $incident->id }}">
                                <input type="hidden" name="handler_id" value="{{ $incident->handler->id }}">
                                {{ Form::file('img_fp') }}
                                {{Form::submit('Cambiar a Falso Positivo',['class'=>'btn btn-primary pull-right ', 'style'=>'margin-left:2px']);}}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-dialog2">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Añadir anexo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="form-group" style="padding:20px">
                                {{Form::open(array('method'=>'POST','action' => 'IncidentController@addAnnex','enctype'=>'multipart/form-data'))}}
                                {{Form::text('title',null,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Título"]);
                                }}<br>
                                {{Form::text('field',null,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Nombre del campo"]);
                                }}<br>
                                {{Form::textarea('observation',null,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Observaciones del incidente",
                                      "id"=>"conclutions",
                                      ]);
                                }}
                                <input type="hidden" name="incident_id" value="{{ $incident->id }}">
                                <input type="hidden" name="handler_id" value="{{ $incident->handler->id }}">
                                {{Form::submit('Guardar comentario',['class'=>'btn btn-primary pull-right ', 'style'=>'margin-left:2px']);}}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
@stop
