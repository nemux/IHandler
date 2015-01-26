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

  <div class="row">
    <!-- begin col-6 -->
    <div class="col-md-8">
    <!-- begin panel -->
      <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
          <h4 class="panel-title">Importe clientes desde OTRS</h4>
        </div>
        <div class="panel-body panel-form">
           {{ Form::open( array('action' => $action,'role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"import-form")) }}
            <div class="form-group width-full">
              <div class="col-md-12 col-sm-12">
             {{ Form::submit('Importar',['class'=>'btn btn-primary width-200 height-50']);}}
            </div>
            </div>
           {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  <!-- end panel -->
@stop
