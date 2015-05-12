
                      <table class="table">
                                <thead>
                                    <tr>
                                        <th width="30%">Incidente</th>
                                        <th>Ticket</th>
                                        <th>Mensaje</th>
                                        <th>Status</th>
                                        <th>Severidad</th>
                                        <th>Detección</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                  <?php foreach ($closure as $n): ?>
                                 
                                  
                                  <?php if ($n->criticity=="ALTA"): ?>
                                    <tr class="danger">
                                  <?php endif ?>
                                  <?php if ($n->criticity=="MEDIA"): ?>
                                    <tr class="warning">
                                  <?php endif ?>
                                  <?php if ($n->criticity=="BAJA"): ?>
                                    <tr class="success">
                                  <?php endif ?>
                                      <?php 
                                          $det_time = Time::where('time_types_id', '=', '1')->where('incidents_id', '=', $n->id)->first();
                                          
                                          $now = time(); // or your date as well
                                          $your_date = strtotime(date("Y-m-d",strtotime($det_time->datetime)));
                                          $datediff = $now - $your_date;
                                          $diff= floor($datediff/(60*60*24));

                                        ?>
                                        <td><a href='/incident/view/<?php echo $n->id ?>'><?php echo $n->title ?></a></td>
                                        <td>
                                          <?php if (isset($n->ticket->internal_number)): ?>
                                            <?php echo $n->ticket->internal_number ?>
                                          <?php endif ?> 
                                        </td>
                                        <td>Este incidente lleva más de <?php echo $diff ?> días sin cerrar</td>
                                        <td><?php echo $n->status->name ?> </td>
                                        <td><?php echo $n->criticity ?> </td>

                                        
                                        <td><?php echo $det_time->datetime ?> </td>
                                        
                                    </tr>
                                  <?php endforeach ?>
                                    
                                    
                                </tbody>
                            </table>
<script type="text/javascript">
  $("#count_closure").text("<?php echo count($closure) ?>")
</script>
