
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

      <!-- begin row -->
      <div class="row">
                <!-- begin col-6 -->
          <div class="col-md-6 ">
              <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
                        <div class="panel-heading">
                            <h4 class="panel-title">Detalles del Sensor </h4>
                        </div>
                        <div class="panel-body">
                          <div class="widget widget-stats bg-blue">
                            <div class="stats-icon"><i class="fa fa-eye"></i></div>
                            <div class="stats-info">
                              <h4><?php echo $sensor->ip ?> </h4>
                              <p><?php echo $sensor->name ?></p>
                              <p><?php echo $sensor->montage ?></p>
                              <small>(<?php echo $sensor->customers->company ?>)</small>
                            </div>
                            <div class="stats-link">
                              <a href="/sensor/update/<?php echo $sensor->id ?>">Editar <i class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                          </div>

                        </div>
                    </div>
                    <!-- end panel -->
                </div>
              </div>
        </center>



@stop
