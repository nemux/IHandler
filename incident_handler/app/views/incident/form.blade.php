@extends('layouts.master')
@section('content')

<script charset="utf-8">
var count=0;
function addImage(){
  count=count+1;
  $("#images").append('<input type="file" name="image_'+count+'">');
}
</script>
<div class="row">
<div class="panel panel-inverse">
			    <div class="panel-heading">

			        <h4 class="panel-title"><?php echo $title ?></h4>
			    </div>
			    <div class="panel-body">
                    {{ Form::model($incident,array('action' => $action,'role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form", "enctype"=>"multipart/form-data")) }}

                    <!--<form id="fileupload" action="<?php echo $action ?>" method="POST" enctype="multipart/form-data">-->
                        <div class="form-group">
                          <table class="table table-bordered">
                            <tr>
                              <td>
                                <select name="risk" class="form-control">
                                  <option value="">Riesgo</option>
                                  <?php for($i=0;$i<11;$i++){ ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                  <?php }?>
                                </select>

                              </td>
                              <td>
                                <select name="criticity" class="form-control">
                                  <option value="">Severidad</option>
                                  <option value="Bajo">Bajo</option>
                                  <option value="Medio">Medio</option>
                                  <option value="Alto">Alto</option>

                                </select>
                              </td>
                              <td>
                                <select name="impact" class="form-control">
                                  <option value="">Impacto</option>
                                  <?php for($i=0;$i<4;$i++){ ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                  <?php }?>
                                </select>
                              </td>
                              <td>
                                {{ Form::select('category_id', $attack,$incident->attacks_id,[
                                          'class'=>'form-control parsley-validated',]);
                                }}
                              </td>

                            </tr>
                            <tr>
                              <td colspan="4">
                                {{ Form::select('customers_id', $customer,$incident->customers_id,[
                                          'class'=>'form-control parsley-validated',]);
                                }}

                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" >
                                {{Form::text('title',$incident->title,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Título"]);
                                }}
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" >
                                {{Form::textarea('description',$incident->description,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Descripción del incidente"]);
                                }}
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" >
                                {{Form::textarea('conclution',$incident->conclution,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Conclusiones"]);
                                }}
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" >
                                {{Form::textarea('recomendation',$incident->recomendation,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Recomendaciones"]);
                                }}
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4">

                              </td>

                            </tr>
                            <tr>
                              <td>
                                Imagenes relacionadas: <br>
                              </td>
                              <td colspan="3">

                                  <input class="" type="file" name="images[]" multiple="">
                              </td>
                            </tr>
                            <tr>
                              <td>
                                Archivo Opcional de Evidencia: <br>
                              </td>
                              <td colspan="3">

                                  <input class="" type="file" name="file">
                              </td>
                            </tr>
                          </table>
                        </div>


                    <!--</div>-->
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
		<!-- end #content -->




@stop
