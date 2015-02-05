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

<h1 class="page-header"></h1>
<!-- end page-header -->

  <div class="row">
    <!-- begin col-6 -->
    <div class="col-md-8">
    <!-- begin panel -->
      <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
          <h4 class="panel-title">Importación de otrs</h4>
        </div>


        <div class="panel-body panel-form">
            <div class="col-lg-12">
              <h4><?php echo $result ?> </h4>
            </div>
        </div>


      </div>
    </div>
  </div>
  <!-- end panel -->

</div>
@stop
