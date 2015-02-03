@extends('layouts.master')
@section('head')
<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="/assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->
  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="/assets/js/form-wysiwyg.demo.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
	<link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-picker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
<script>

    var ip_added=new Array();
    var sid_added=new Array();
    var count_rule=0;
    var count_event=0;
    var count_todel=0;

    function validateSid(sid){
      for (var i = 0; i < sid_added.length; i++) {
        if(sid_added[i]==sid){
          return "1";
        }
      }
      return "0";
    }
    function delFile(name,div){
      count_todel=count_todel+1;
      $("#todel").append('<input type="hidden" name="del_'+count_todel+'" value="files/evidence/'+name+'">');
      div.parent().parent().css('display','none');
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
      FormPlugins.init();
      TableManageDefault.init();

      Form1.init();
      Form2.init();
      Form3.init();
      Form4.init();
      $("#attack").val("<?php echo $incident->attacks_id ?>");
      $("#images").change(function(){
        //get the input and UL list
        var input = document.getElementById('images');;
        var list = $("#files_list");

        //empty list for now...
        list.empty();

        //for every file...
        for (var x = 0; x < input.files.length; x++) {
        	//add to list
        	var li = document.createElement('li');
        	li.innerHTML = 'File ' + (x + 1) + ':  ' + input.files[x].name;
        	list.append(li);
        }
      });

      $("#search_sid").keyup(function (e){

        if(e.which == 13 && validateSid($("#search_sid").val())) {

        }else{
            $.ajax({
                type:"GET",
                url: "/rule/query/"+$("#search_sid").val(),
                async: true,
                cache: false,
                success: function(ret){
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

    $('#customers_id').change(function(){
      $.get('/incident/sensor/get/'+$('#customers_id').val(),
        function( data ){
          $('#sensor_id').empty();
				  $.each(data, function(key, element) {
					    $('#sensor_id').append("<option value='" + key + "'>" + element + "</option>");
				    });
      });
    });


    function removeRule(tr,sid){
      $(tr).remove();
      var index=sid_added.indexOf(sid);
      sid_added.splice(index,1);
    }
    });


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
        +'<input style="display:none" value="'+rule_is+'"  class="form-control" placeholder="qué es" type="text" name="ruleis_'+count_rule+'" >'
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
    var src_occurences=$("#src_occurences").val();
    var dst_occurences=$("#dst_occurences").val();
    var src_blacklist=0;
    var dst_blacklist=0;
    if ($("#src_blacklist").attr('checked')) {
        src_blacklist=1;
    }
    if ($("#dst_blacklist").attr('checked')) {
        dst_blacklist=1;
    }



    var str='<tr onclick="removeEvent(this)" style="cursor:pointer"  >'

      +'<td style="display:none">'
        +'<input type="text" class="form-control" name="srcip_'+count_event+'" placeholder="origen" value="'+src_ip+'"><br>'
        +'<input type="text" class="form-control" name="dstip_'+count_event+'" placeholder="destino" value="'+dst_ip+'">'
        +'<input type="text" class="form-control" name="srcport_'+count_event+'" placeholder="origen" value="'+src_port+'"><br>'
        +'<input type="text" class="form-control" name="dstport_'+count_event+'" placeholder="destino" value="'+dst_port+'">'
        +'<input type="text" class="form-control" name="srcprotocol_'+count_event+'" placeholder="origen" value="'+src_protocol+'"><br>'
        +'<input type="text" class="form-control" name="dstprotocol_'+count_event+'" placeholder="destino" value="'+dst_protocol+'">'
        +'<input type="text" class="form-control" name="srcoperativesystem_'+count_event+'" placeholder="origen" value="'+src_operative_system+'"><br>'
        +'<input type="text" class="form-control" name="dstoperativesystem_'+count_event+'" placeholder="destino" value="'+dst_operative_system+'">'
        +'<input type="text" class="form-control" name="srcfunction_'+count_event+'" placeholder="origen" value="'+src_function+'"><br>'
        +'<input type="text" class="form-control" name="dstfunction_'+count_event+'" placeholder="destino" value="'+dst_function+'">'
        +'<input type="text" class="form-control" name="srclocation_'+count_event+'" placeholder="origen" value="'+src_location+'"><br>'
        +'<input type="text" class="form-control" name="dstlocation_'+count_event+'" placeholder="destino" value="'+dst_location+'">'
        +'<input type="text" class="form-control" name="srcoccurencestype_'+count_event+'" placeholder="destino" value="'+src_occurences+'">'
        +'<input type="text" class="form-control" name="dstoccurencestype_'+count_event+'" placeholder="destino" value="'+dst_occurences+'">'
        +'<input type="text" class="form-control" name="srcblacklist_'+count_event+'" placeholder="destino" value="'+src_blacklist+'">'
        +'<input type="text" class="form-control" name="dstblacklist_'+count_event+'" placeholder="destino" value="'+dst_blacklist+'">'
      +'</td>'

      +'<td colspan="2">'

        +src_ip
        +','
        +src_port
        +','
        +src_protocol
        +','
        +src_operative_system
        +','
        +src_function
        +','
        +src_location
        +','
        +src_occurences
        +','
        +src_blacklist

      +'</td>'
      +'<td colspan="2">'
        +dst_ip
        +','
        +dst_port
        +','
        +dst_protocol
        +','
        +dst_operative_system
        +','
        +dst_function
        +','
        +dst_location
        +','
        +dst_occurences
        +','
        +dst_blacklist

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

@stop
@section('content')
<?php $display_form=""; ?>
<?php if (isset($incident->status->id) && $incident->status->id>1): ?>
  <?php $display_form="style='display:none'"; ?>
<?php endif ?>

<div class="row">
<div class="panel panel-inverse">
			    <div class="panel-heading">

			        <h4 class="panel-title"><?php echo $title ?> </h4>
			    </div>
			    <div class="panel-body">
                    {{ Form::model($incident,array('action' => $action,'role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form", "enctype"=>"multipart/form-data")) }}

                    <!--<form id="fileupload" action="<?php echo $action ?>" method="POST" enctype="multipart/form-data">-->
                        <div class="form-group">
                          <table class="table table-bordered" <?php echo $display_form ?>>
                            <tr>
                              <td>
                                Fecha y Hora de detección
                              </td>
                              <td>
                                <div class="input-group bootstrap-timepicker">
                                  <?php if (!isset($update)) {
                                    ?>
                                      <input data-date-format="dd-mm-yyyy" name="det_date" type="text" class="form-control datepicker-default" id="" placeholder="Select Date" value="<?php echo date('d-m-Y') ?>" />

                                    <?php
                                  }else{ ?>
                                      <input data-date-format="dd-mm-yyyy" name="det_date" type="text" class="form-control datepicker-default" id="" placeholder="Select Date" value="<?php echo date('d-m-Y',strtotime($det_time->datetime)) ?>" />
                                    <?php } ?>
                                  <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                </div><br>
                                <div class="input-group bootstrap-timepicker">

                                  <?php if (!isset($update)) {
                                    ?>
                                      <input name="det_time" id="" type="text" class="form-control timepicker" />
                                    <?php
                                  }else{ ?>
                                      <input name="det_time" id="" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($det_time->datetime)) ?>"/>
                                    <?php } ?>


                                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                              </td>
                              <td>
                                Fecha y hora de Ocurrencia
                              </td>
                              <td>
                                <div class="input-group bootstrap-timepicker">
                                  <?php if (!isset($update)) {
                                    ?>
                                      <input data-date-format="dd-mm-yyyy" name="occ_date" type="text" class="form-control datepicker-default" id="" placeholder="Select Date" value="<?php echo date('d-m-Y') ?>" />

                                    <?php
                                  }else{ ?>
                                      <input data-date-format="dd-mm-yyyy" name="occ_date" type="text" class="form-control datepicker-default" id="" placeholder="Select Date" value="<?php echo date('d-m-Y',strtotime($occ_time->datetime)) ?>" />
                                    <?php } ?>
                                  <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                </div><br>
                                <div class="input-group bootstrap-timepicker">
                                  <?php if (!isset($update)) {
                                    ?>
                                      <input name="occ_time" id="" type="text" class="form-control timepicker" />
                                    <?php
                                  }else{ ?>
                                      <input name="occ_time" id="" type="text" class="form-control timepicker" value="<?php echo date('h:i A',strtotime($occ_time->datetime)) ?>"/>
                                    <?php } ?>
                                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                </div>
                              </td>
                            </tr>
                          </table>
                          <table class="table table-bordered">
                            <tr <?php echo $display_form ?>>
                              <td>
                                <select name="risk" class="form-control">
                                  <option value="">Riesgo</option>
                                  <?php $option=""; ?>
                                  <?php for($i=1;$i<11;$i++){ ?>


                                    <?php if (isset($update)): ?>
                                      <?php if ($incident->risk==$i): ?>
                                        <?php $option="selected"; ?>
                                      <?php endif ?>
                                      <?php if ($incident->risk!=$i): ?>
                                        <?php $option=""; ?>
                                      <?php endif ?>

                                    <?php endif ?>
                                    <?php if (!isset($update)): ?>
                                      <?php $option=""; ?>
                                    <?php endif ?>

                                    <option <?php echo $option ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                  <?php }?>

                                </select>

                              </td>
                              <td>
                                <select name="criticity" class="form-control">
                                  <option value="">Severidad</option>
                                  <option <?php if(isset($update) && $incident->criticity=='BAJA'){ echo "selected"; } ?> value="BAJA">BAJA</option>
                                  <option <?php if(isset($update) && $incident->criticity=='MEDIA'){ echo "selected"; } ?> value="MEDIA">MEDIA</option>
                                  <option <?php if(isset($update) && $incident->criticity=='ALTA'){ echo "selected"; } ?> value="ALTA">ALTA</option>
                                </select>
                              </td>
                              <td>
                                <select name="impact" class="form-control">
                                  <option value="">Impacto</option>
                                  <?php $option=""; ?>
                                  <?php for($i=0;$i<11;$i++){ ?>


                                    <?php if (isset($update)): ?>
                                      <?php if ($incident->impact==$i): ?>
                                        <?php $option="selected"; ?>
                                      <?php endif ?>
                                      <?php if ($incident->impact!=$i): ?>
                                        <?php $option=""; ?>
                                      <?php endif ?>

                                    <?php endif ?>
                                    <?php if (!isset($update)): ?>
                                      <?php $option=""; ?>
                                    <?php endif ?>

                                    <option <?php echo $option ?> value="<?php echo $i ?>"><?php echo $i ?></option>
                                  <?php }?>
                                </select>
                              </td>
                              <td width="20%">
                                <select name="attack_id" class="form-control" id="attack">

                                        <optgroup label="Otros">
                                          <option value="1">Otros</option>
                                        </optgroup>
                                        <optgroup label="Contenido Abusivo">
                                          <option value="2">Spam</option>
                                          <option value="3">Defacement</option>
                                          <option value="4">Acoso / Coacción</option>
                                        </optgroup>
                                        <optgroup label="Código Dañino">
                                          <option value="5">Virus</option>
                                          <option value="6">Gusano</option>
                                          <option value="7">Troyano</option>
                                          <option value="8">Spyware</option>
                                        </optgroup>
                                        <optgroup label="Recolección de información">
                                          <option value="9">Escaneo de vulnerabilidades</option>
                                          <option value="10">Sniffing</option>
                                          <option value="11">Ingeniería Social</option>
                                        </optgroup>
                                          <optgroup label="Intrusiones">
                                          <option value="12">Inyección SQL</option>
                                          <option value="13">Pharming</option>
                                          <option value="14">Inyección remota de archivos</option>
                                          <option value="15">Ataques de fuerza bruta</option>

                                          <option value="16">Explotación de vulnerabilidades</option>
                                          <option value="17">Cross-Site Scripting</option>
                                          <option value="18">Inyección otros tipos</option>
                                        </optgroup>
                                        <optgroup label="Disponibilidad">
                                          <option value="19">DoS / DDoS</option>
                                          <option value="20">Fallo (hw/sw)</option>
                                          <option value="21">Error humano</option>
                                        </optgroup>
                                        <optgroup label="Fraude">
                                          <option value="22">Copyright</option>
                                          <option value="23">Suplantación / Spoofing</option>
                                          <option value="24">Phishing</option>
                                        </optgroup>

                                        </select>

                              </td>
                              <td width="30%">
                                {{ Form::select('category_id', $categories, $incident->categories_id,[
                                          'class'=>'form-control parsley-validated',]);
                                }}
                              </td>

                            </tr>
                            <tr <?php echo $display_form ?>>
                              <td colspan="5">
                                {{ Form::select('customers_id', $customer,$incident->customers_id,[
                                          'class'=>'form-control parsley-validated', 'id'=>'customers_id']);
                                }}

                              </td>
                            </tr>
                            <tr <?php echo $display_form ?>>

                              <td colspan="5">
                                {{
                                   Form::select('sensor_id', array('0' => 'Seleccione un cliente'),'0',[
                                          'class'=>'form-control parsley-validated','id'=>'sensor_id']);
                                }}

                              </td>

                            </tr>

                            <tr <?php echo $display_form ?>>

                              <td colspan="5" >
                                {{Form::text('title',$incident->title,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Título"]);
                                }}
                              </td>
                            </tr>
                            <tr <?php echo $display_form ?>>

                              <td colspan="5" >
                                <select id="" name="stream" class="form-control">
                                  <option>INTRUSIÓN</option>
                                  <option>EXTRUSIÓN</option>
                                  <option>LOCAL</option>
                                </select>
                              </td>
                            </tr>

                            <tr <?php echo $display_form ?>>
                              <td colspan="5" >
                                {{Form::textarea('description',$incident->description,[
                                      'class'=>'form-control parsley-validated',
                                      "data-parsley-pattern"=>"",
                                      "data-parsley-required"=>"true",
                                      "placeholder"=>"Descripción del incidente",
                                      "id"=>"description",
                                      ]);
                                }}
                              </td>
                            </tr>

                            <tr <?php echo $display_form ?>>
                              <td colspan="5">
                                <h4>Añadir Reglas de Detección</h4>
                              </td>
                            </tr>

                            <tr <?php echo $display_form ?>>
                              <td style="width:10%"><br>
                                <a style="width:100%" href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-check"></i> Seleccionar</a> <br><br>
                                <a style="width:100%" class="btn btn-sm btn-success" onclick="addButton()"><i class="fa fa-plus"></i> Añadir</a>

                              </td>

                              <td colspan="4">
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

                            <tr <?php echo $display_form ?>>

                              <td colspan="5">

                                <table class="table table-bordered table-striped table-hover">
                                  <tbody id="rules">

                                     <?php if (isset($update)): ?>
                                       <?php $i=0; ?>
                                       <?php foreach ($incident_rule as $ir): ?>
                                         <?php $i++; ?>
                                          <tr onclick="removeRule(this,'<?php echo $ir->rule->sid ?>')" style="cursor:pointer">
                                            <td>
                                              <?php echo $ir->rule->sid ?>
                                              <input style="display:none" value="<?php echo $ir->rule->sid ?>" class="form-control"  type="text" name="sid_<?php echo $i ?>" >
                                            </td>
                                            <td>
                                              <?php echo $ir->rule->rule ?>
                                              <input style="display:none" value="<?php echo $ir->rule->rule ?>" class="form-control"  type="text" name="rule_<?php echo $i ?>" >
                                            </td>
                                            <td>
                                              <?php echo $ir->rule->message ?>
                                              <input style="display:none" value="<?php echo $ir->rule->message ?>" class="form-control"  type="text" name="message_<?php echo $i ?>" >
                                            </td>
                                            <td>
                                              <?php echo $ir->rule->translate ?>
                                              <input style="display:none" value="<?php echo $ir->rule->translate ?>" class="form-control"  type="text" name="translate_<?php echo $i ?>" >
                                            </td>
                                            <td>
                                              <?php echo $ir->rule->rule_is ?>
                                              <input style="display:none" value="<?php echo $ir->rule->rule_is ?>" class="form-control"  type="text" name="ruleis_<?php echo $i ?>" >
                                            </td>
                                            <td>
                                              <?php echo $ir->rule->why ?>
                                              <input style="display:none" value="<?php echo $ir->rule->why ?>" class="form-control"  type="text" name="why_<?php echo $i ?>" >
                                            </td>
                                          </tr>
                                          <script>
                                          if (validateSid(<?php echo $ir->rule->sid ?>)=="0") {
                                            sid_added.push(<?php echo $ir->rule->sid ?>);

                                          }
                                          count_rule=<?php echo $i ?>;
                                          </script>
                                       <?php endforeach ?>

                                     <?php endif ?>
                                  </tbody>
                                </table>
                              </td>

                            </tr>

                            <tr>
                              <td colspan="5" >
                               <div class="form-group">
                                 {{Form::textarea('conclution',$incident->conclution,[
                                       'class'=>'form-control parsley-validated',
                                       "data-parsley-pattern"=>"",
                                       "data-parsley-required"=>"true",
                                       "placeholder"=>"Conclusiones",
                                       "id"=>"conclutions"]);
                                 }}
                               </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="5" >
                                <div class="form-group">
                                  {{Form::textarea('recomendation',$incident->recomendation,[
                                        'class'=>'form-control parsley-validated',
                                        "data-parsley-pattern"=>"",
                                        "data-parsley-required"=>"true",
                                        "placeholder"=>"Recomendaciones",
                                        "id"=>"recomendations"]);
                                  }}
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="5">
                                <div class="form-group">

                                      {{Form::textarea('references',$references->link,[
                                            'class'=>'form-control parsley-validated',
                                            "data-parsley-pattern"=>"",
                                            "data-parsley-required"=>"true",
                                            "placeholder"=>"Referencias",
                                            "id"=>"references",
                                            ]);
                                      }}

                                </div>
                              </td>
                            </tr>
                            <tr <?php echo $display_form ?>>
                              <td colspan="5">
                                <h4>Añadir Eventos</h4>

                              </td>
                            </tr>
                            <tr <?php echo $display_form ?>>
                              <td style="width:10%"><br>
                                <!--<a style="width:100%" href="#modal-dialog2" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-check"></i> Seleccionar</a> <br><br>-->
                                <a onclick="addEvent()" style="width:100%" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Añadir</a>

                              </td>
                              <td colspan="4">
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
                                    <th>
                                      Tipo
                                    </th>
                                    <th>
                                      Blacklist
                                    </th>
                                  </thead>
                                  <tbody>

                                      <tr>
                                        <td >
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

                                        <td width="150px">
                                          {{ Form::select('src_occurences_types_id', $occurences_types, $incident->categories_id,[
                                                    'class'=>'form-control parsley-validated',
                                                    'id'=>'src_occurences',
                                                    ]);
                                          }}
                                          <br>
                                          {{ Form::select('dst_occurences_types_id', $occurences_types, $incident->categories_id,[
                                                      'class'=>'form-control parsley-validated',
                                                      'id'=>'dst_occurences',
                                                      ]);
                                          }}
                                        </td>
                                        <td>
                                          <input id="src_blacklist" class="checkbox" type="checkbox" name="search_src_blacklist" value="1"><br><br>
                                          <input id="dst_blacklist" class="checkbox"  type="checkbox"  name="search_dst_blacklist" value="1">
                                        </td>
                                      </tr>

                                  </tbody>
                                </table>
                              </td>


                            </tr>
                            <tr <?php echo $display_form ?>>
                              <td colspan="5">
                                <table class="table table-bordered table-striped" id="events">

                                    <?php if (isset($update)): ?>
                                      <?php $i=0; ?>
                                      <?php foreach ($incident_occurence as $io): ?>



                                        <?php $i++; ?>
                                        <tr onclick="removeEvent(this)" style="cursor:pointer">

                                          <td style="display:none">
                                            <input style="display:none" type="text" class="form-control" name="srcip_<?php echo $i ?>" placeholder="origen" value="<?php echo $io->src->ip ?>"><br>
                                            <input style="display:none" type="text" class="form-control" name="dstip_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->dst->ip ?>">
                                            <input style="display:none" type="text" class="form-control" name="srcport_<?php echo $i ?>" placeholder="origen" value="<?php echo $io->src->port ?>"><br>
                                            <input style="display:none" type="text" class="form-control" name="dstport_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->dst->port ?>">
                                            <input style="display:none" type="text" class="form-control" name="srcprotocol_<?php echo $i ?>" placeholder="origen" value="<?php echo $io->src->protocol ?>"><br>
                                            <input style="display:none" type="text" class="form-control" name="dstprotocol_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->dst->protocol ?>">
                                            <input style="display:none" type="text" class="form-control" name="srcoperativesystem_<?php echo $i ?>" placeholder="origen" value="<?php echo $io->src->operative_system ?>"><br>
                                            <input style="display:none" type="text" class="form-control" name="dstoperativesystem_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->dst->operative_system ?>">
                                            <input style="display:none" type="text" class="form-control" name="srcfunction_<?php echo $i ?>" placeholder="origen" value="<?php echo $io->src->function ?>"><br>
                                            <input style="display:none" type="text" class="form-control" name="dstfunction_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->dst->function ?>">
                                            <input style="display:none" type="text" class="form-control" name="srclocation_<?php echo $i ?>" placeholder="origen" value="<?php echo $io->src->location ?>"><br>
                                            <input style="display:none" type="text" class="form-control" name="dstlocation_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->dst->location ?>">
                                            <input style="display:none" type="text" class="form-control" name="srcoccurencestype_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->src->type->id ?>">
                                            <input style="display:none" type="text" class="form-control" name="dstoccurencestype_<?php echo $i ?>" placeholder="destino" value="<?php echo $io->dst->type->id ?>">
                                            <input style="display:none" type="text" class="form-control" name="srcblacklist_<?php echo $i ?>" placeholder="destino" value="<?php if($io->src->blacklist){ echo "1"; }else{ echo "0";} ?>">
                                            <input style="display:none" type="text" class="form-control" name="dstblacklist_<?php echo $i ?>" placeholder="destino" value="<?php if($io->dst->blacklist){ echo "1"; }else{ echo "0";} ?>">
                                          </td>
                                          <td colspan="2">
                                            <?php echo $io->src->ip ?>
                                            ,
                                            <?php echo $io->src->port ?>
                                            ,
                                            <?php echo $io->src->protocol ?>
                                            ,
                                            <?php echo $io->src->operative_system ?>
                                            ,
                                            <?php echo $io->src->function ?>
                                            ,
                                            <?php $hist= DB::table('occurences_history')->select(DB::raw('*'))->whereRaw('occurences_id='.$io->src->id." and datetime=(select max(updated_at) from occurences_history)")->first(); ?>
                                            <?php if ($hist){
                                                echo $hist->location;
                                              }?>
                                            ,
                                            <?php echo $io->src->type->name ?>
                                            ,
                                            <?php if ($io->src->blacklist) {
                                              echo "1";
                                            }else{
                                              echo "0";
                                            } ?>


                                          </td>
                                          <td colspan="2">

                                            <?php echo $io->dst->ip ?>
                                            ,
                                            <?php echo $io->dst->port ?>
                                            ,
                                            <?php echo $io->dst->protocol ?>
                                            ,
                                            <?php echo $io->dst->operative_system ?>
                                            ,
                                            <?php echo $io->dst->function ?>
                                            ,
                                            <?php $hist= DB::table('occurences_history')->select(DB::raw('*'))->whereRaw('occurences_id='.$io->dst->id." and datetime=(select max(updated_at) from occurences_history)")->first(); ?>
                                            <?php if ($hist){
                                                echo $hist->location;
                                              }?>
                                            ,
                                            <?php echo $io->dst->type->name ?>
                                            ,
                                            <?php if ($io->dst->blacklist) {
                                              echo "1";
                                            }else{
                                              echo "0";
                                            } ?>

                                          </td>
                                        </tr>
                                        <script charset="utf-8">
                                          count_event=<?php echo $i ?>;
                                        </script>
                                      <?php endforeach ?>

                                    <?php endif ?>

                                </table>
                              </td>
                            </tr>
                            <tr>

                              <td colspan="5">

                              </td>

                            </tr>

                          </table>
                        </div>


                    <!--</div>-->
                      <div class="form-group" style="">
                        <table class="table" >
                          <tr>
                            <td style="width:15%">
                              Añadir archivos de evidencia:
                            </td>
                            <td colspan="4">
                                <a name="button" class="btn btn-primary" onclick="$('#images').click()">Seleccionar archivos</a>
                                <input class="btn btn-default" type="file" id="images" name="images[]" multiple="" style="display:none">
                            </td>
                          </tr>
                          <tr>
                            <td>

                            </td>
                            <td>
                              <ul id="files_list">

                              </ul>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              Archivos de evidencia almacenados
                            </td>
                            <td>
                              <?php if (isset($update)): ?>
                                <?php if (count($incident->images)>0): ?>
                                  <div class="col-lg-12" style="padding-bottom:50px">.

                                    <?php foreach ($incident->images as $i): ?>
                                      <?php if ($i->evidence_types_id==1): ?>
                                          <div class="col-lg-4">
                                            <div class="col-lg-10">
                                              <a href="/files/evidence/<?php echo $i->name ?>" target="blank"><i class="fa fa-cube fa-2x"></i>
                                                <?php echo $i->name ?>
                                              </a>
                                            </div>
                                            <div class="col-lg-2">
                                              <i class="fa fa-minus-circle" onclick="delFile('<?php echo $i->name ?>',$(this))"></i>
                                            </div>
                                          </div>
                                      <?php endif ?>
                                    <?php endforeach ?>
                                  </div>
                                <?php endif ?>
                              <?php endif ?>
                            </td>
                          </tr>

                        </table>
                        <div id="todel">

                        </div>
                      </div>


                    <?php if (isset($update)): ?>
                      <input type="text" name="id" value="<?php echo $incident->id ?>" style="display:none">
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

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="/assets/js/table-manage-default.demo.min.js"></script>
  <script src="/assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->
@stop
