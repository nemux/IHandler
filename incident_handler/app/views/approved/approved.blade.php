
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


      <!-- end page-header -->

      <!-- begin row -->


<div class="row">
          <!-- begin col-6 -->
    <div class="col-md-8">
        <!-- begin panel -->
              <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                  <div class="panel-heading">

                      <h4 class="panel-title">Aprobacion de Incidente</h4>
                  </div>
                  <div class="panel-body panel-form">
{{ Form::open( ) }}
                        <div class="form-group">
                          <label class="control-label col-md-2 col-sm-2">
                            {{ Form::label('title', 'Titulo del incidente:') }}
                          </label>
                          <div class="col-md-10 col-sm-10">
                            {{Form::label('title',$incident->title,[
                                  'class'=>'form-control parsley-validated',
                                  "data-parsley-pattern"=>"^[A-Za-z\á\é\í\ó\ú\Á\É\Í\Ó\Ú\ñ\s]+$",
                                  "data-parsley-required"=>"true"]);
                            }}
                          </div>

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('risk', 'Riesgo Asociado: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::label('risk', $incident->risk,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>

                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('criticity', 'Criticidad: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::label('criticity', $incident->criticity,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                            {{ Form::label('impact', 'Impacto:') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                           {{Form::label('impact', $incident->impact,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                                    }}
                        </div>
                      </div>
                   <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('description', 'Descripcion: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::label('criticity', $incident->description,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>
                      </div>
                          <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('file', 'Archivo: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::label('file', $incident->file,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>
                      </div>
                          <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('conclution', 'Conclusion: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::text('conclution', $incident->conclution,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>
                      </div>
                          <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                          {{ Form::label('recomendation', 'Recomendation: ') }}
                        </label>
                        <div class="col-md-10 col-sm-10">
                          {{Form::text('recomendation', $incident->recomendation,[
                                    'class'=>'form-control parsley-validated',
                                    "data-parsley-pattern"=>"^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$",
                                    "data-parsley-required"=>"true"]);
                          }}
                        </div>

                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2">
                        </label>
                        <br>
                        <br>
                        <div class="col-md-10 col-sm-10">
                        <br>
                {{Form::submit('Guardar',['class'=>'btn btn-primary pull-right'],'method'=> 'post'  )}}
                        </div>
                      </div>


                    {{ Form::close() }}
                  </div>
              </div>
              <!-- end panel -->
          </div>


</div>

@stop
