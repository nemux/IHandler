
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
          data: { start: start, end: end, option:option},
          success: function(result){
            $("#target").html("");
            $("#target").html(result);

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
                            <h4 class="panel-title">Top de direcciones IP</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <form class="form-horizontal form-bordered">

                                <div class="form-group">
                                    <div class="col-lg-2">

                                        <div class="col-lg-3">
                                          <div class="form-contol" style="margin-top:6px;">
                                            <label >Top:</label>
                                          </div>
                                        </div>
                                        <div class="col-lg-9">
                                          <select id="top" class="form-control">
                                            <?php for ($i=0; $i <11 ; $i++) { ?>
                                              <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php } ?>
                                          </select>
                                        </div>

                                    </div>
                                    <div class="col-lg-2">
                                      <div class="form-group">
                                        <select id="src_dst" class="form-control">
                                          <option value="1">Origen</option>
                                          <option value="2">Destino</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-2">
                                      <div class="form-group">
                                        <select id="customer" class="form-control">
                                          <?php $customers=Customer::all(); ?>
                                          <?php foreach ($customers as $c): ?>
                                            <option value="<?php echo $c->id ?>"><?php echo $c->name ?></option>
                                          <?php endforeach ?>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="col-lg-2">

                                        <div class="col-lg-4">
                                          <div class="form-contol" style="margin-top:6px;">
                                            <label >Blacklist:</label>
                                          </div>
                                        </div>
                                        <div class="col-lg-8">
                                          <select id="blacklist" class="form-control">

                                              <option value="0">No</option>
                                              <option value="1">Si</option>

                                          </select>
                                        </div>

                                    </div>


                                    <div class="col-lg-2">
                                      <div class="input-group">
                                        <a class="btn btn-default" id="generate" onclick='graph($("#top").val(),$("#src_dst").val(),$("#customer").val(),$("#blacklist").val())'>Generar Gráfica</a>
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
    $(document).ready(function() {

      FormPlugins.init();
    });
  </script>

@stop
