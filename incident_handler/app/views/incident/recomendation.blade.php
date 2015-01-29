
@extends('layouts.master')
@section('content')

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="/assets/js/form-wysiwyg.demo.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

  <script>
    $(document).ready(function() {
      FormPlugins.init();
      Form3.init();
    });
</script>

<h1 class="page-header"><?php echo $title ?></h1>
      <!-- end page-header -->

<!-- begin row -->

<div class="row">
          <!-- begin col-6 -->
    <div class="col-md-8">
        <!-- begin panel -->
              <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                  <div class="panel-heading">

                      <h4 class="panel-title">Agregar recomendacion</h4>
                  </div>
                  <div class="panel-body panel-form">

                      {{ Form::open(array('action' => $action,'role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form")) }}
                      <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2">
                            {{ Form::label('name', 'Nombre del Cliente:') }}
                          </label>
                          <div class="col-md-10 col-sm-10">
                             {{Form::text('name',$incident->customer->name,[
                                  'class'=>'form-control parsley-validated',
                                  "data-parsley-pattern"=>"^[^\s].+$",
                                  "data-parsley-required"=>"true",
                                  "disabled" => "disabled"])
                            }}
                          </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('title', 'Titulo del incidente: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                           {{Form::text('title', $incident->title,[
                                    'class'=>'form-control parsley-validated disabled',
                                    "data-parsley-pattern"=>"^[A-Za-z\á\é\í\ó\ú\Á\É\Í\Ó\Ú\ñ\s].+$",
                                    "data-parsley-required"=>"true",
                                    "disabled" => "disabled"])
                          }}
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('recomendations', 'Recomendaci&oacute;n: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                           {{Form::textarea('recomendations',"",[
                                        'class'=>'form-control parsley-validated',
                                        "data-parsley-pattern"=>"",
                                        "data-parsley-required"=>"true",
                                        "placeholder"=>"Recomendaciones",
                                        "id"=>"recomendations"]);
                                  }}
                        </div>
                      </div>
                      <div class="form-group">
                          <input type="hidden" value="{{ $incident->id }}" name="id" />
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::submit('Guardar',['class'=>'btn btn-primary pull-right ']);}}
                        </div>
                      </div>
                    {{ Form::close() }}
                  </div>
              </div>
              <!-- end panel -->
          </div>
</div>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
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
	<!-- ================== END PAGE LEVEL JS ================== -->
@stop
