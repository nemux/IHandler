
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

                            <h4 class="panel-title">Handlers Registrados</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered table-hover  ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
																						<th>Usuario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i=0; ?>
                                      <?php foreach ($handler as $h): ?>
                                        <tr onclick="location.href = '/handler/view/<?php echo $h->id ?>'"  style="cursor:pointer">
                                          <?php $i++; ?>
                                          <td>
                                            <?php echo $i ?>
                                          </td>
                                          <td>
                                            <?php echo $h->name ?> <?php echo $h->lastname ?>
                                          </td>
																					<td>
																						<?php echo $h->access->username ?>
																					</td>
                                        </tr>
                                      <?php endforeach ?>
                                    </tbody>
                                </table>
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
