<table class="table">
                                <thead>
                                    <tr>
                                        <th width="25%">Incidente</th>
                                        <th width="12%">Contenido</th>
                                        <th>Status</th>
                                        <th>Severidad</th>
                                        <th width="100px">Detección</th>
                                        <th >Comentario de...</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($history_notification as $n): ?>
                                  <?php 
                                          $det_time = Time::where('time_types_id', '=', '1')->where('incidents_id', '=', $n->incidents_id)->first();
                                  ?>
                                    <?php if ($n->incident->criticity=="ALTA"): ?>
                                      <tr class="danger">
                                    <?php endif ?>
                                    <?php if ($n->incident->criticity=="MEDIA"): ?>
                                      <tr class="warning">
                                    <?php endif ?>
                                    <?php if ($n->incident->criticity=="BAJA"): ?>
                                      <tr class="success">
                                    <?php endif ?>
                                      <td><a href='/incident/view/<?php echo $n->incidents_id ?>'><?php echo $n->incident->title ?></a></td>
                                      <td><?php echo substr($n->content, 0, 50) ?> ... </td>
                                      <td><?php echo $n->incident->status->name ?></td>
                                      <td><?php echo $n->incident->criticity ?></td>
                                      <td><?php echo $det_time->datetime ?></td>
                                      <td>
                                          <?php if ($n->owner): ?>
                                            <?php echo $n->owner->name ?> <?php echo $n->owner->lastname ?>
                                          <?php endif ?> 
                                      </td>
                                      <td>
                                        <?php if ($n->attend!="1"){ ?>

                                          <a onclick="attend($(this),<?php echo $n->id ?>)" class="btn btn-primary btn-xs m-r-5">Marcar como atendido</a>
                                        <?php } else{ ?>
                                          <?php  echo "Esta notificación ya fue atendida";?>
                                        <?php } ?>
                                        
                                      

                                      </td>
                                    </tr>
                                  <?php endforeach ?>
                                  
                                </tbody>
                            </table>

<script type="text/javascript">
  $("#count_observation").text("<?php echo count($notification) ?>")
</script>