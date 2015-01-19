@extends('layouts.master')
@section('content')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="/assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->
<script>

    var ip_added=new Array();
    var sid_added=new Array();
    var count_rule=0;
    var count_event=0;

    function validateSid(sid){
      for (var i = 0; i < sid_added.length; i++) {
        if(sid_added[i]==sid){
          return "1";
        }
      }
      return "0";
    }

    function addButton(){
      //sid,rule,message,translate,rule_is,why
      var sid=$("#search_sid").val();
      var rule=$("#search_rule").val();
      var message=$("#search_message").val();
      var translate=$("#search_translate").val();
      var rule_is=$("#search_rule_is").val();
      var why=$("#search_why").val();

      if (sid && rule && message && translate && rule_is && why) {
        addRule(sid,rule,message,translate,rule_is,why);
      }
    }
    $(document).ready(function() {

      TableManageDefault.init();



      $("#search_sid").keyup(function (e){

        if(e.which == 13 && validateSid($("#search_sid").val())) {

        }else{
            $.ajax({
                type:"GET",
                url: "/rule/query/"+$("#search_sid").val(),
                async: true,
                cache: false,
                success: function(ret){
                     //console.log(ret);
                     if (ret!="") {
                       response=ret.split("\`");
                       if (validateSid(response[0])=="0") {
                         addRule(response[0],response[1],response[2],response[3],response[4],response[5]);

                       }


                     }
                 },
                error: function(x,e){
                     console.log("error occur");
                }
              });
          }
      });


    });
    function removeRule(tr,sid){
      $(tr).remove();
      var index=sid_added.indexOf(sid);
      sid_added.splice(index,1);
    }

</script>
<script charset="utf-8">

  function addRule(sid,rule,message,translate,rule_is,why){
    count_rule=count_rule+1;
    //'sid','rule','message','translate','rule_is','why'
    var str='<tr onclick="removeRule(this,\''+sid+'\')" style="cursor:pointer">'
      +'<td>'
        +sid
        +'<input style="display:none" value="'+sid+'" onkeyup="queryRule(this.value)" class="form-control" placeholder="sid" type="text" name="sid_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +rule
        +'<input style="display:none" value="'+rule+'"  class="form-control" placeholder="regla" type="text" name="rule_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +message
        +'<input style="display:none" value="'+message+'"  class="form-control" placeholder="mensaje" type="text" name="message_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +translate
        +'<input style="display:none" value="'+translate+'"  class="form-control" placeholder="traducción" type="text" name="translate_'+count_rule+'">'
      +'</td>'
      +'<td>'
        +rule_is
        +'<input style="display:none" value="'+rule_is+'"  class="form-control" placeholder="qué es" type="text" name="rule_'+count_rule+'" >'
      +'</td>'
      +'<td>'
        +why
        +'<input style="display:none" value="'+why+'"  class="form-control" placeholder="por qué ocurre" type="text" name="why_'+count_rule+'" >'
      +'</td>'
    +'</tr>';

    if (validateSid(sid)=="0") {
      sid_added.push(sid);
      $("#rules").append(str);
    }
  }


  function addEvent(){
    count_event=count_event+1;
    var src_ip=$("#src_ip").val();
    var dst_ip=$("#dst_ip").val();
    var src_port=$("#src_port").val();
    var dst_port=$("#dst_port").val();
    var src_protocol=$("#src_protocol").val();
    var dst_protocol=$("#dst_protocol").val();
    var src_operative_system=$("#src_operative_system").val();
    var dst_operative_system=$("#dst_operative_system").val();
    var src_function=$("#src_function").val();
    var dst_function=$("#dst_function").val();
    var src_location=$("#src_location").val();
    var dst_location=$("#dst_location").val();


    var str='<tr onclick="removeEvent(this)" style="cursor:pointer"  >'
      +'<td>'
        +'<input type="text" class="form-control" name="src_ip_'+count_event+'" placeholder="origen" value="'+src_ip+'"><br>'
        +'<input type="text" class="form-control" name="dst_ip_'+count_event+'" placeholder="destino" value="'+dst_ip+'">'
      +'</td>'
      +'<td>'
        +'<input type="text" class="form-control" name="src_port_'+count_event+'" placeholder="origen" value="'+src_port+'"><br>'
        +'<input type="text" class="form-control" name="dst_port_'+count_event+'" placeholder="destino" value="'+dst_port+'">'
      +'</td>'
      +'<td>'
        +'<input type="text" class="form-control" name="src_protocol_'+count_event+'" placeholder="origen" value="'+src_protocol+'"><br>'
        +'<input type="text" class="form-control" name="dst_protocol_'+count_event+'" placeholder="destino" value="'+dst_protocol+'">'
      +'</td>'
      +'<td>'
        +'<input type="text" class="form-control" name="src_operative_system_'+count_event+'" placeholder="origen" value="'+src_operative_system+'"><br>'
        +'<input type="text" class="form-control" name="dst_operative_system_'+count_event+'" placeholder="destino" value="'+dst_operative_system+'">'
      +'</td>'
      +'<td>'
        +'<input type="text" class="form-control" name="src_function_'+count_event+'" placeholder="origen" value="'+src_function+'"><br>'
        +'<input type="text" class="form-control" name="dst_function_'+count_event+'" placeholder="destino" value="'+dst_function+'">'
      +'</td>'
      +'<td>'
        +'<input type="text" class="form-control" name="src_location_'+count_event+'" placeholder="origen" value="'+src_location+'"><br>'
        +'<input type="text" class="form-control" name="dst_location_'+count_event+'" placeholder="destino" value="'+dst_location+'">'
      +'</td>'
    +'</tr>';

      $("#events").append(str);

  }

  function validateIp(ip){
    for (var i = 0; i < ip_added.length; i++) {
      if(ip_added[i]==ip){
        return "1";
      }
    }
    return "0";
  }

  function removeEvent(tr){
    $(tr).remove();
    var index=ip_added.indexOf(ip);
    ip_added.splice(index,1);
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
                                {{ Form::select('category_id', $attack, $incident->attacks_id,[
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
                              <td colspan="4">
                                <h4>Añadir Eventos</h4>

                              </td>
                            </tr>
                            <tr>
                              <td style="width:10%"><br>
                                <a style="width:100%" href="#modal-dialog2" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-check"></i> Seleccionar</a> <br><br>
                                <a onclick="addEvent()" style="width:100%" class="btn btn-sm btn-success" onclick="addButton()"><i class="fa fa-plus"></i> Añadir</a>

                              </td>
                              <td colspan="3  ">
                                <table class="table table-bordered table-striped " >
                                  <thead>
                                    <th>
                                      IP
                                    </th>
                                    <th>
                                      Puerto
                                    </th>
                                    <th>
                                      Protocolo
                                    </th>
                                    <th>
                                      Sistema Operativo
                                    </th>
                                    <th>
                                      Función
                                    </th>
                                    <th>
                                      Localidad
                                    </th>

                                  </thead>
                                  <tbody>

                                      <tr>
                                        <td>
                                          <input id="src_ip"  type="text" class="form-control" name="search_src_ip" placeholder="origen"><br>
                                          <input id="dst_ip"  type="text" class="form-control" name="search_dst_ip" placeholder="destino">
                                        </td>
                                        <td>
                                          <input id="src_port"  id="search_src_ip"  type="text" class="form-control" name="search_src_port" placeholder="origen"><br>
                                          <input id="dst_port"  type="text" class="form-control" name="search_dst_port" placeholder="destino">
                                        </td>
                                        <td>
                                          <input id="src_protocol"  type="text" class="form-control" name="search_src_protocol" placeholder="origen"><br>
                                          <input id="dst_protocol"  type="text" class="form-control" name="search_dst_protocol" placeholder="destino">
                                        </td>
                                        <td>
                                          <input id="src_operative_system"  type="text" class="form-control" name="search_src_operative_system" placeholder="origen"><br>
                                          <input id="dst_operative_system"  type="text" class="form-control" name="search_dst_operative_system" placeholder="destino">
                                        </td>
                                        <td>
                                          <input id="src_function"  type="text" class="form-control" name="search_src_function" placeholder="origen"><br>
                                          <input id="dst_function"  type="text" class="form-control" name="search_dst_function" placeholder="destino">
                                        </td>
                                        <td>
                                          <input id="src_location"  type="text" class="form-control" name="search_src_location" placeholder="origen"><br>
                                          <input id="dst_location"  type="text" class="form-control" name="search_dst_location" placeholder="destino">
                                        </td>
                                      </tr>

                                  </tbody>
                                </table>
                              </td>


                            </tr>
                            <tr>
                              <td colspan="4">
                                <table class="table table-bordered table-striped" id="events">


                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4">
                                <h4>Añadir Reglas de Detección</h4>
                              </td>
                            </tr>

                            <tr>
                              <td style="width:10%"><br>
                                <a style="width:100%" href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-check"></i> Seleccionar</a> <br><br>
                                <a style="width:100%" class="btn btn-sm btn-success" onclick="addButton()"><i class="fa fa-plus"></i> Añadir</a>

                              </td>

                              <td colspan="3">
                                <table class="table">
                                  <tbody>

                                    <tr>
                                      <td>
                                        <input id="search_sid" class="form-control" placeholder="sid" type="text" >
                                      </td>
                                      <td>
                                        <input id="search_rule"  class="form-control" placeholder="rule" type="text" >
                                      </td>
                                      <td>
                                        <input id="search_message"  class="form-control" placeholder="message" type="text" >
                                      </td>
                                      <td>
                                        <input id="search_translate"  class="form-control" placeholder="translate" type="text" >
                                      </td>
                                      <td>
                                        <input id="search_rule_is"  class="form-control" placeholder="qué es" type="text" >
                                      </td>
                                      <td>
                                        <input id="search_why"  class="form-control" placeholder="why" type="text" >
                                      </td>
                                    </tr>

                                  </tbody>
                                </table>

                              </td>
                            </tr>

                            <tr>

                              <td colspan="4">
                                <table class="table table-bordered table-striped table-hover">
                                  <tbody id="rules">

                                  </tbody>
                                </table>
                              </td>

                            </tr>
                            <tr>
                              <td colspan="4" >
                               <div class="form-group">
                                 {{Form::textarea('conclution',$incident->conclution,[
                                       'class'=>'form-control parsley-validated',
                                       "data-parsley-pattern"=>"",
                                       "data-parsley-required"=>"true",
                                       "placeholder"=>"Conclusiones"]);
                                 }}
                               </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" >
                                <div class="form-group">
                                  {{Form::textarea('recomendation',$incident->recomendation,[
                                        'class'=>'form-control parsley-validated',
                                        "data-parsley-pattern"=>"",
                                        "data-parsley-required"=>"true",
                                        "placeholder"=>"Recomendaciones"]);
                                  }}
                                </div>
                              </td>
                            </tr>
                            <tr>

                              <td colspan="4">

                              </td>

                            </tr>

                          </table>
                        </div>


                    <!--</div>-->
                      <div class="form-group">
                        <table class="table">
                          <tr>
                            <td style="width:15%">
                              Imagenes relacionadas:
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
                                 <tr style="cursor:pointer" onclick="addRule('<?php echo $r->sid ?>','<?php echo $r->rule ?>','<?php echo $r->message ?>','<?php echo $r->translate ?>','<?php echo $r->rule_is ?>','<?php echo $r->why ?>')">

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

										</div>
									</div>
								</div>
							</div>

              <div class="modal fade" id="modal-dialog2">
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
