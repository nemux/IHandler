
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
                                              Categoría
                                            </th>
                                            <th>
                                              Severidad
                                            </th>

                                            <th>
                                              Flujo
                                            </th>

                                            <th>
                                              Handler
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
                                      <?php foreach ($incident as $in): ?>
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
                                            CAT:<?php echo ($in->category->id)-1; ?>
                                          </td>

                                          <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                            SEV:<?php
                                                echo $in->criticity;
                                            ?>
                                          </td>

                                          <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                            <?php
                                                echo $in->stream;
                                            ?>
                                          </td>


                                          <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');" style="cursor:pointer">
                                            <?php if(isset($in->handler->access->username)){ echo $in->handler->access->username; }?>
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
                <script>
                    $(document).ready(function() {

                      TableManageDefault.init();
                    });
                  </script>
