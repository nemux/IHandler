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
  <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/assets/plugins/bootstrap-wizard/css/bwizard.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->


<script>

$(document).ready(function() {

  TableManageDefault.init();


  $('#attack_id').change(function(){
    $('#attacks').empty();
     $.get('/attack/'+$('#attack_id').val(), function( data ){
       var i = 1;
       var panel = "<div class=\"panel panel-inverse\" id=\"panel-attacks\"> "+
                        "<div class=\"panel-heading\"> "+
                            "<h4 class=\"panel-title\">Ataques Registrados</h4> "+
                        "</div> "+
                        "<div class=\"panel-body\"> "+
                            "<div class=\"table-responsive\"> "+
                                "<table id=\"data-table\" class=\"table table-striped table-bordered table-hover\"> " +
                                    "<thead> "+
                                        "<tr> "+
                                            "<th>#</th> "+
                                            "<th>Nombre</th> "+
                                        "</tr> "+
                                    "</thead> "+
                                    "<tbody>                    ";
       for (a in data) {
         var url = '/attack/view/' + a;
         panel   += "<tr onclick=\"location.href=\'" + url+ "\'\" style=\"cursor:pointer\"> "+
           "                 <td> " +
                                       i     +
                    "                  </td>" +
                    "                  <td> " +
                                    data[a] +
                    "                  </td>" +
                    "               </tr> ";
          i++;
       }
      panel +=
                              "</tbody> "+
                              "</table> "+
                            "</div> "+
                        "</div> "+
                    "</div> "+
                    "<!-- end panel --> ";
           $('#attacks').append(panel);
       });
     });
  });

</script>
@stop

@section('content')

<div class="row">
 {{ Form::open(array('id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"attack-form")); }}
 {{
   Form::select('attack_id', $attacks, 1, [
    'class'=>'form-control parsley-validated','id'=>'attack_id']);
  }}

{{ Form::close(); }}
 <p></p>
</div>

<div class="col-md-12" style="min-width:800px;" id="attacks">
  <!-- begin panel -->
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
  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets/plugins/bootstrap-wizard/js/bwizard.js"></script>
	<script src="/assets/js/form-wizards.demo.min.js"></script>
	<script src="/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
@stop




