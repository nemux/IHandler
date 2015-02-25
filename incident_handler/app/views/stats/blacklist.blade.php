
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
  </script>
<div class="col-md-12" style="min-width:800px;">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <h4 class="panel-title">Direcciones en blacklist</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered table-hover  ">
                                    <thead>
                                        <tr>

                                            <th>
                                              IP
                                            </th>
                                            <th>Origen</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($blacklist as $b): ?>
                                        <?php if (preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', str_replace(" ","",$b->ip)) && strlen($b->location)>3): ?>
                                          <tr>
                                            <td>
                                              <?php echo $b->ip ?>
                                            </td>
                                            <td>
                                              <?php echo $b->location; ?>
                                            </td>
                                          </tr>
                                        <?php endif ?>
                                      <?php endforeach ?>
                                    </tbody>
                                </table>

                            </div><br>
                            <div class="col-lg-4">
                              <a class="btn btn-primary" href="/stats/blacklist/doc/" target="blank"><i class="fa fa-file-word-o"></i> Generar doc</a>
                            </div>
                        </div>
                    </div>

                    <!-- end panel -->
                </div>


  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="/assets/js/table-manage-default.demo.min.js"></script>
  <script src="/assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->


@stop
