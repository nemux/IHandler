
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
  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  	<link href="/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
  	<!-- ================== END PAGE LEVEL STYLE ================== -->
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
      function buscar(){
        $.ajax({
          type: "POST",
          async:false,
          url: "/incident/search/render/ip/",
          data: { ip:$("#ip").val(),start:$("#start").val(),end:$("#end").val(),occurence:$("#occurence").val(),customer:$("#customer").val(),sensor:$("#sensor").val()},
          success: function(result){
            $("#target").html("");
            $("#target").html(result);
            TableManageDefault.init();
            //console.log(result);

          }
        })
      }

    </script>

  </head>
  <body>
    <div class="col-md-12">
   			        <!-- begin panel -->
                       <div class="panel panel-inverse" data-sortable-id="form-validation-2">
                           <div class="panel-heading">
                               <div class="panel-heading-btn">
                                 <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                               </div>
                               <h4 class="panel-title">Búsqueda por IP</h4>
                           </div>
                           <div class="panel-body panel-form">
                               <form class="form-horizontal form-bordered" data-parsley-validate="true">

   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Dirección IP :</label>
   									<div class="col-md-6 col-sm-6">
   										<input class="form-control parsley-validated" id="ip" type="text" id="data-regexp" data-parsley-pattern="#[A-Fa-f0-9]{6}" placeholder="" data-required="true" />
   									</div>
   								</div>

     <div class="form-group">
       <label class="control-label col-md-4 col-sm-4">Rango de fechas</label>
       <div class="col-md-6 col-sm-6">
         <div class="input-group input-daterange">
             <input type="text" class="form-control" id="start" name="start" placeholder="Fecha de Inicio" />
             <span class="input-group-addon">a</span>
             <input type="text" class="form-control" id="end" name="end" placeholder="Fecha Final" />
         </div>
       </div>
     </div>


                   <div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Origen o Destino</label>
   									<div class="col-md-6 col-sm-6">
   										<select class="form-control" id="occurence" name="">
                         <option value="0">Cualquiera</option>
                         <option value="source_id">Origen</option>
                         <option value="destiny_id">Destino</option>
   										</select>
   									</div>

                     <?php $sensors=Sensor::all(); ?>
   								</div>

                   <div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Sensor</label>
   									<div class="col-md-6 col-sm-6">
   										<select class="form-control" id="sensor">
                         <option value="0">Cualquier Sensor</option>
                         <?php foreach ($sensors as $s): ?>
                           <option value="<?php echo $s->id ?>"><?php echo $s->name ?></option>
                         <?php endforeach ?>

   										</select>
   									</div>


   								</div>
                   <?php $customers=Customer::all(); ?>
                   <div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Cliente</label>
   									<div class="col-md-6 col-sm-6">
   										<select class="form-control" id="customer">
                         <?php foreach ($customers as $s): ?>
                           <option value="<?php echo $s->id ?>"><?php echo $s->name ?></option>
                         <?php endforeach ?>

   										</select>
   									</div>


   								</div>
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4"></label>
   									<div class="col-md-6 col-sm-6">
   										<a class="btn btn-primary" onclick="buscar()">buscar</a>
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

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/plugins/parsley/dist/parsley.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->


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
