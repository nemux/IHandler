
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
      function graph(top,src_dst,customer,blacklist){
        $.ajax({
          type: "POST",
          url: "/stats/ip/graph",
          data: { top:top,src_dst:src_dst,customer:customer,blacklist:blacklist},
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
                       <div class="panel panel-inverse" data-sortable-id="form-validation-2">
                           <div class="panel-heading">
                               <div class="panel-heading-btn">

                               </div>
                               <h4 class="panel-title">Búsqueda por </h4>
                           </div>
                           <div class="panel-body panel-form">
                               <form class="form-horizontal form-bordered" data-parsley-validate="true">
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">AlphaNum* :</label>
   									<div class="col-md-6 col-sm-6">
   										<input class="form-control" type="text" id="alphanum" name="alphanum"  data-type="alphanum" placeholder="Alphanumeric String."  data-parsley-required="true" />
   									</div>
   								</div>
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Date ISO* :</label>
   									<div class="col-md-6 col-sm-6">
   										<input class="form-control" type="text" id="data-dateIso" placeholder="YYYY-MM-DD"  data-parsley-required="true" />
   									</div>
   								</div>
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Required Select Box :</label>
   									<div class="col-md-6 col-sm-6">
   										<select class="form-control" id="select-required" name="selectBox" data-parsley-required="true">
   											<option value="">Please choose</option>
   											<option value="foo">Foo</option>
   											<option value="bar">Bar</option>
   										</select>
   									</div>
   								</div>
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Required Radio Button :</label>
   									<div class="col-md-6 col-sm-6">
   										<div class="radio">
   											<label>
   												<input type="radio" name="radiorequired" value="foo" id="radio-required" data-parsley-required="true" /> Radio Button 1
   											</label>
   										</div>
   										<div class="radio">
   											<label>
   												<input type="radio" name="radiorequired" id="radio-required2" value="bar" /> Radio Button 2
   											</label>
   										</div>
   									</div>
   								</div>
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Check at least 2 checkboxes :</label>
   									<div class="col-md-6 col-sm-6">
   										<div class="checkbox"><label><input type="checkbox" id="mincheck" name="mincheck[]" data-parsley-mincheck="2" value="foo" required /> Checkbox 1</label></div>
   										<div class="checkbox"><label><input type="checkbox" name="mincheck[]" value="bar" /> Checkbox 2</label></div>
   										<div class="checkbox"><label><input type="checkbox" name="mincheck[]" value="baz" /> Checkbox 3</label></div>
   									</div>
   								</div>
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4">Regular Expression :</label>
   									<div class="col-md-6 col-sm-6">
   										<input class="form-control parsley-validated" type="text" id="data-regexp" data-parsley-pattern="#[A-Fa-f0-9]{6}" placeholder="hexa color code" data-required="true" />
   									</div>
   								</div>
   								<div class="form-group">
   									<label class="control-label col-md-4 col-sm-4"></label>
   									<div class="col-md-6 col-sm-6">
   										<button type="submit" class="btn btn-danger">Validate</button>
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
    $(document).ready(function() {

      FormPlugins.init();
    });
  </script>

@stop
