
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


<script src="/assets/highcharts/js/highcharts.js"></script>
<script src="/assets/highcharts/js/highcharts-3d.js"></script>
<script src="/assets/highcharts/js/modules/exporting.js"></script>


  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="/assets/js/table-manage-default.demo.min.js"></script>
  <script src="/assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->




<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="/assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->

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
      function graph(start,end,customer,criticity,sensor){
        $.ajax({
          type: "POST",
          url: "/incident/view/sensor",
          ascync:false,
          data: { start: start, end: end, customer: customer, criticity: criticity, sensor: sensor},
          beforeSend: function () {
            $("#target").html("");
            $("#target").html('<div class="col-lg-12"><div class="panel panel-inverse"><div class="panel-body panel-form"><h3 >Cargando...</h3></div></div></div>');
          },
          success: function(result){
            $("#target").html("");
            $("#target").html(result);
						//console.log(result);
          }
        })
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
                            <h4 class="panel-title">Datepicker</h4>
                        </div>
                        <div class="panel-body panel-form">
                          {{ Form::model(null,array('action' => 'IncidentController@viewSensor','role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form")) }}

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Rango de fechas</label>
                                    <div class="col-md-2">
                                        <div class="input-group input-daterange">
                                            <input type="text" class="form-control" id="start" placeholder="Fecha de Inicio" name="start"/>
                                              <span class="input-group-addon">a</span>
                                            <input type="text" class="form-control" id="end" placeholder="Fecha Final" name="end"/>

                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                      <div class="form-group">
                                        <select id="customer" class="form-control" name="customer">
                                          <?php $customers=Customer::all(); ?>
                                          <?php foreach ($customers as $c): ?>
                                            <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                          <select id="sensor" name="sensor" class="form-control">
                                            <?php $sensor=Sensor::all(); ?>
                                            <?php foreach ($sensor as $c): ?>
                                              <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                                            <?php endforeach ?>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                          <select id="criticity" name="criticity" class="form-control">
                                            <option>ALTA</option>
                                            <option>MEDIA</option>
                                            <option>BAJA</option>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                      <div class="input-group">
                                        {{Form::submit('Generar',['class'=>'btn btn-primary pull-right ']);}}
                                        <!--<a class="btn btn-default" id="generate" onclick='graph($("#start").val(),$("#end").val(),$("#customer").val(),$("#criticity").val(),$("#sensor").val())'>Realizar filtro</a>-->
                                      </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
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
		$(document).ready(function() {

			FormPlugins.init();
		});
	</script>

@stop
