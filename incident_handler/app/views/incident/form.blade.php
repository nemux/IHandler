@extends('layouts.master')
@section('content')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="/assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->
<script>
    $(document).ready(function() {

      TableManageDefault.init();
    });
    var count_rule=0;
</script>
<script charset="utf-8">

  function addRule(){
    count_rule=count_rule+1;
    //'sid','rule','message','translate','rule_is','why'
    var str='<tr>'
      +'<td>'
        +'<input onkeyup="queryRule(this.value)" class="form-control" placeholder="sid" type="text" name="sid_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +'<input class="form-control" placeholder="rule" type="text" name="rule_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +'<input class="form-control" placeholder="message" type="text" name="message_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +'<input class="form-control" placeholder="translate" type="text" name="translate_'+count_rule+'">'
      +'</td>'
      +'<td>'
        +'<input class="form-control" placeholder="rule" type="text" name="rule_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +'<input class="form-control" placeholder="why" type="text" name="why_'+count_rule+'" >'
      +'</td>'
    +'</tr>';
    $("#rules").append(str);
  }


  function queryRule(sid){
    $.ajax({
        url: "/rule/query/",
        type:"post",
        data:"{sid:"+sid+"}",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        async: true,
        cache: false,
        success: function(ret){
             console.log(ret);
         },
        error: function(x,e){
             console.log("error occur");
        }
      });
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
                              <td style="width:15%">
                                <a style="width:100%" class="btn btn-sm btn-success" onclick="addRule()"><i class="fa fa-plus"></i> Añadir</a><br><br>
                                <a style="width:100%" href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-check"></i> Seleccionar</a>
                              </td>
                              <td colspan="3">
                                <table class="table">
                                  <tbody id="rules">


                                  </tbody>
                                </table>
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

<div class="modal fade" id="modal-dialog">
								<div class="modal-dialog">
									<div class="modal-content" width="">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Modal Dialog</h4>
										</div>
										<div class="modal-body">
											<div class="table-responsive">
                         <table id="data-table" class="table table-striped table-bordered table-hover  ">
                             <thead>
                                 <tr>
                                     <th>SID</th>
                                     <th>Regla</th>
                                     <th>Mensaje</th>
                                     <th>Traducción</th>
                                     <th>Qué es</th>
                                     <th>Por qué ocurre</th>
                                 </tr>
                             </thead>
                             <tbody>

                               <?php foreach ($rule as $r): ?>
                                 <tr style="cursor:pointer">

                                   <td>
                                     <?php echo $r->sid ?>
                                   </td>
                                   <td>
                                     <?php echo $r->rule ?>
                                   </td>
                                   <td>
                                     <?php echo $r->message ?>
                                   </td>
                                   <td>
                                     <?php echo $r->translate ?>
                                   </td>
                                   <td>
                                     <?php echo $r->rule_is ?>
                                   </td>
                                   <td>
                                     <?php echo $r->why ?>
                                   </td>
                                 </tr>
                               <?php endforeach ?>
                             </tbody>
                         </table>
                     </div>
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a href="javascript:;" class="btn btn-sm btn-success">Action</a>
										</div>
									</div>
								</div>
							</div>


  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="/assets/js/table-manage-default.demo.min.js"></script>
  <script src="/assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->

@stop
