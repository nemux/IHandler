
@extends('layouts.master')
@section('content')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="/assets/plugins/parsley/src/parsley.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="/assets/plugins/parsley/dist/parsley.js"></script>
  <script src="/assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
  <script src="/assets/plugins/pace/pace.min.js"></script>

<h1 class="page-header"><?php echo $title ?></h1>
      <!-- end page-header -->

      <!-- begin row -->

<div class="row">
          <!-- begin col-6 -->
    <div class="col-md-8">
        <!-- begin panel -->
              <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                  <div class="panel-heading">

                      <h4 class="panel-title">Vista de Incidentes</h4>
                  </div>
                  <div class="panel-body panel-form">

                  {{ Form::model($incident,array('action' => $action,'role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form")) }}
                      <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2">
                            {{ Form::label('name', 'Nombre del Sensor:') }}
                          </label>
                          <div class="col-md-10 col-sm-10">
                            {{Form::text('name',$sensor->name,[
                                  'class'=>'form-control parsley-validated',
                                  "data-parsley-pattern"=>"^[A-Za-z\á\é\í\ó\ú\Á\É\Í\Ó\Ú\ñ\s]+$",
                                  "data-parsley-required"=>"true"]);
                            }}
                          </div>

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('ip', 'Dirección IP: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::text('title', $incident->title,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>

                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('montage', 'Punto de Montaje: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::text('montage', $sensor->montage,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                            {{ Form::label('customers_id', 'Tipo de acceso:') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                            {{ Form::select('customers_id', $customer,$sensor->customers_id,[
                                      'class'=>'form-control parsley-validated',]);
                            }}
                        </div>
                      </div>

                      <?php if (isset($update)): ?>

                                      <input value="<?php echo $sensor->id ?>" name="id"  style="display:none"/>
                      <?php endif ?>

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

@stop