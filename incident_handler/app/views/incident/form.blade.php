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
    <div class="col-md-12">
        <!-- begin panel -->
              <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                  <div class="panel-heading">

                      <h4 class="panel-title">Registre los siguientes campos</h4>
                  </div>
                  <div class="panel-body panel-form">

                  {{ Form::model($incident,array('action' => $action,'role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form")) }}

                    <div class="form-group">
                        <table class="table table-bordered">
                          <tr>
                            <td>
                              <select class="form-control" id="select-required" name="risk" data-parsley-required="true">
                                <option value="">
                                    Riesgo
                                </option>
                                <option value="0">
                                    0
                                </option>
                                <option value="1">
                                    1
                                </option>
                                <option value="2">
                                    2
                                </option>
                                <option value="3">
                                    3
                                </option>
                                <option value="4">
                                    4
                                </option>
                                <option value="5">
                                    5
                                </option>
                                <option value="6">
                                    6
                                </option>
                                <option value="7">
                                    7
                                </option>
                                <option value="8">
                                    8
                                </option>
                                <option value="9">
                                    9
                                </option>
                                <option value="10">
                                    10
                                </option>
                              </select>
                            </td>


                            <td>
                              <select class="form-control" id="select-required" name="criticity" data-parsley-required="true">
                                <option value="">
                                    Severidad
                                </option>
                                <option value="Bajo">
                                    Bajo
                                </option>
                                <option value="Medio">
                                    Medio
                                </option>
                                <option value="Alto">
                                    Alto
                                </option>

                              </select>
                            </td>
                            <td>
                              <select class="form-control" id="select-required" name="impact" data-parsley-required="true">
                                <option value="">
                                    Impacto
                                </option>
                                <option value="1">
                                    1
                                </option>
                                <option value="2">
                                    2
                                </option>
                                <option value="3">
                                    3
                                </option>

                              </select>
                            </td>


                          </tr>



                          <tr>
                            <td>
                              <input name="update" placeholder="motivo del cambio" class="form-control parsley-validated" type="text" id="data-regexp" data-parsley-required='true' data-parsley-pattern="^[a-zA-ZñáéíóúÁÉÍÓÚ\d\s]+$" data-required="true" />
                            </td>
                            <td>
                              <input name="update" placeholder="motivo del cambio" class="form-control parsley-validated" type="text" id="data-regexp" data-parsley-required='true' data-parsley-pattern="^[a-zA-ZñáéíóúÁÉÍÓÚ\d\s]+$" data-required="true" />
                            </td>
                            <td>
                              <input name="update" placeholder="motivo del cambio" class="form-control parsley-validated" type="text" id="data-regexp" data-parsley-required='true' data-parsley-pattern="^[a-zA-ZñáéíóúÁÉÍÓÚ\d\s]+$" data-required="true" />
                            </td>
                          </tr>
                        </table>

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



      </div>
</div>
        <!-- end panel -->


@stop
