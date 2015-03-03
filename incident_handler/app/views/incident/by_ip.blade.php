

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
                                              <th>
                                                Ticket
                                              </th>
                                              <th>Título</th>
                                              <th>
                                                Indicadores
                                              </th>
                                              <th>
                                                Fecha detección
                                              </th>
                                              <th>
                                                Sensor
                                              </th>
                                              <th>
                                                Status
                                              </th>

                                              <th>
                                                Handler
                                              </th>

                                              <th>
                                                Cliente
                                              </th>

                                              <th>
                                                Última actualización
                                              </th>
                                              <?php if (Auth::user()->type->name == 'user_2' || Auth::user()->type->name == 'admin'): ?>
                                              <th>
  						                                        Enviar correo
                                              </th>


                                              <?php endif ?>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php $i=1; ?>
                                        <?php foreach ($incident as $i): ?>
                                          <?php $in=Incident::find($i->id); ?>
                                          <tr >
                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php echo $i ?>
                                            </td>
                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              @if (isset($in->ticket->internal_number))
                                                {{ $in->ticket->internal_number }}
                                              @else
                                                {{ "Por asignar....."}}
                                              @endif
                                            </td>
                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"  style="cursor:pointer" width="15%">
                                              <?php echo $in->title ?>
                                            </td>
                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php foreach ($in->incidentRule as $ir): ?>
                                                <?php echo $ir->rule->message ?>
                                              <?php endforeach ?>
                                            </td>
                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php
                                                $det_time=Time::where('time_types_id','=','1')->where('incidents_id','=',$in->id)->first();

                                                echo $det_time['datetime'];
                                               ?>
                                            </td>
                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php echo $in->sensor->name ?>
                                            </td>
                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php echo $in->status->name ?>
                                            </td>

                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php if(isset($in->handler->access->username)){ echo $in->handler->access->username; }?>
                                            </td>

                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php echo $in->customer->company ?>
                                            </td>

                                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                              <?php echo $in->updated_at ?>
                                            </td>
                                            <?php if (Auth::user()->type->name == 'user_2' || Auth::user()->type->name == 'admin'): ?>
                                              <td>
                                                <a href='/incident/mail/{{$in->id}}' class="btn btn-default">Correo</a>
                                              </td>
                                            <?php endif ?>
                                          </tr>
                                          <?php $i++; ?>
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
