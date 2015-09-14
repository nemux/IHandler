@extends('layouts.master')
@section('content')


        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="/assets/plugins/parsley/src/parsley.css" rel="stylesheet"/>
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/parsley/dist/parsley.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet"/>
<!-- ================== END PAGE LEVEL STYLE ================== -->

<script src="/assets/plugins/pace/pace.min.js"></script>

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet"/>
<link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet"/>
<link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet"/>
<link href="/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet"/>
<link href="/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<link href="/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"/>
<link href="/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet"/>
<link href="/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet"/>
<link href="/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
<link href="/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet"/>
<link href="/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet"/>
<!-- ================== END PAGE LEVEL STYLE ================== -->

<div class="row">
    <!--Begin col 12 customer details-->
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Editar {{$page->url}}</h4>
            </div>
            <div class="panel-body">
                {{Form::model($page,['action'=>'update-page','id'=>'asset-form','role'=>'form','class'=>'form-horizontal form-bordered','data-parsley-validate'=>'true','name'=>'asset-form','enctype'=>'multipart/form-data'])}}
                {{Form::hidden('id')}}
                @include('customer.pages._form')

                <div class="form-group">
                    {{Form::submit('Guardar',['class'=>'btn btn-sm btn-success'])}}
                    {{Form::reset('Limpiar campos',['class'=>'btn btn-sm btn-default'])}}
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
    <!--End customer details-->
</div>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="/assets/js/table-manage-default.demo.min.js"></script>
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

<script>
    $(document).ready(function () {
        FormPlugins.init();
    });
</script>

@stop
