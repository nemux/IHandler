@extends('layouts.master')
@section('content')



  <!-- begin #page-loader -->
  <!-- <div id="page-loader" class="fade in"><span class="spinner"></span></div> -->
  <!-- end #page-loader -->

  <!-- begin #page-container -->

      <h1 class="page-header">Reporte de incidente (<?php print_r( $incident->status->name) ?>)<small> 22/01/2014</small></h1>
      <!-- end page-header -->

      <div class="panel panel-inverse">
          <div class="panel-heading">
              <div class="panel-heading-btn">
                  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
              </div>
              <h4 class="panel-title">Título: {{ $incident->title }}  </h4>
          </div>
          <div class="panel-body">
              <div class="form-group">
                <table class="table table-bordered">
                  <tr>
                    <td style="text-align:center;background:#CCC" colspan="3">
                      <strong>Incidente: <?php echo $incident->title ?></strong>
                    </td>

                  </tr>
                  <tr style="padding:0;">
                    <td style="text-align:center;background:#CCC;width:250px">
                      <strong>Categoría:</strong>
                    </td>
                    <td colspan="2" style="text-align:center;padding:0">
                      <table class="table table-bordered" style="padding:0;margin-bottom:0">
                        <tr style="background:#CCC">
                          <td colspan="2">
                            Descripción
                          </td>
                        </tr>
                        <tr>
                          <td style="width:35%">
                            <?php echo $incident->category->id ?>
                          </td>
                          <td>
                            <?php echo $incident->category->description ?>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Sensor:</strong>
                    </td>
                    <td style="text-align:center;">
                      <?php echo $incident->sensor->name ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Indicador:</strong>
                    </td>
                    <td style="text-align:center;">
                      <?php foreach ($incident->incidentRule as $r ): ?>
                        "<?php echo $r->rule->message ?>"<br>
                        <?php //print_r($r) ?>
                      <?php endforeach ?>
                      <?php //print_r($incident->incidentRule); ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Flujo del ataque:</strong>
                    </td>
                    <td style="text-align:center;">
                      <?php
                          echo $incident->stream;

                      ?>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Fecha de detección:</strong>
                    </td>
                    <td style="text-align:center;">
                      <?php
                          echo $det_time->datetime;

                      ?>,<?php
                          echo $det_time->zone;

                      ?>
                    </td>
                  </tr>
                  <tr style="padding:0">

                    <td style="text-align:center;background:#CCC;">
                      <strong>Severidad:</strong>
                    </td>

                    <?php
                    $font="";
                    $color="";
                    if ($incident->criticity=="Bajo") {
                      $color="#01DF3A";
                      $font="#000";
                    }else if($incident->criticity=="Medio"){
                      $color="#F7FE2E";
                      $font="#000";
                    }else if($incident->criticity=="Alto"){
                      $color="#FE2E2E";
                      $font="#FFF";
                    }

                     ?>
                    <td style="text-align:center;background-color:<?php echo $color ?>;color:<?php echo $font ?>">
                      <div style="width:100%;height:100%;">
                        <?php
                            echo $incident->criticity;

                        ?>
                      </div>

                    </td>

                  </tr>
                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Dirección IP de Origen:</strong>
                    </td>
                    <td style="text-align:center;">
                      <table>
                        <?php foreach ($incident->srcDst as $ip): ?>
                          <?php echo $ip->src->ip ?><br>
                        <?php endforeach ?>
                      </table>
                    </td>
                  </tr>

                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Dirección IP Destino:</strong>
                    </td>
                    <td style="text-align:center;">
                      <table>
                        <?php foreach ($incident->srcDst as $ip): ?>
                          <?php echo $ip->dst->ip ?><br>
                        <?php endforeach ?>
                      </table>
                    </td>
                  </tr>

                  <?php if (count($listed)>0): ?>
                    <tr>
                      <td style="text-align:center;background:#CCC">
                        <strong>Blacklist:</strong>
                      </td>
                      <td colspan="2" style="padding:0">
                        <table style="border-collapse:collapse;width:100%">
                          <tr>
                            <th style="text-align:center;background:#CCC;">
                              Dirección Ip
                            </th>
                            <th style="text-align:center;background:#CCC">
                              País de Origen
                            </th>
                          </tr>
                          <tr>
                            <td style="text-align:center">
                              <?php $count=0 ?>
                              <?php foreach ($listed as $l): ?>
                                <?php $count++; ?>
                                <?php echo $l->ip ?>[<?php echo $count ?>]<br>
                              <?php endforeach ?>
                            </td>
                            <td style="text-align:center">
                              <?php $count=0 ?>
                              <?php foreach ($location as $l): ?>
                                <?php $count++; ?>
                                <?php print_r($l->location) ?><br>
                              <?php endforeach ?>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  <?php endif ?>


                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Descripción:</strong>
                    </td>
                    <td style="text-align:justify;text-justify: inter-word;">
                      <?php echo $incident->description ?><br>
                      <?php echo $incident->conclution ?>
                    </td>
                  </tr>

                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Recomendación:</strong>
                    </td>
                    <td style="text-align:justify;text-justify: inter-word;">
                      <?php echo $incident->recomendation ?><br>

                    </td>
                  </tr>

                  <tr>
                    <td style="text-align:center;background:#CCC;">
                      <strong>Referencia:</strong>
                    </td>
                    <td style="text-align:justify;text-justify: inter-word;">
                      <?php echo $incident->reference->link ?><br>

                    </td>
                  </tr>
                </table>
              </div>
          </div>
      </div>
      <div class="col-lg-12" style="margin-bottom:50px">


        {{Form::open(array('method'=>'POST','action' => 'IncidentController@updateStatus'))}}
        <a class="btn btn-danger" href="/incident/pdf/<?php echo $incident->id ?>" target="blank"><i class="fa fa-file-pdf-o"></i> Generar pdf</a>


          <?php if ($incident->incidents_status_id==1): ?>
            <input type="hidden" name="status" value="2">
            <a class="btn btn-primary" href="/incident/update/<?php echo $incident->id ?>"><i class="fa fa-edit"></i> editar</a>
              <input type="hidden" name="id" value="<?php echo $incident->id ?>">
            {{Form::submit('Mover a Investigación',['class'=>'btn btn-primary pull-right ']);}}
          <?php endif ?>


          <?php if ($incident->incidents_status_id==2): ?>
            <input type="hidden" name="status" value="3">

              <input type="hidden" name="id" value="<?php echo $incident->id ?>">
            {{Form::submit('Mover a Resuelto',['class'=>'btn btn-primary pull-right ']);}}
          <?php endif ?>


          <?php if ($incident->incidents_status_id==3): ?>
            <input type="hidden" name="status" value="4">

              <input type="hidden" name="id" value="<?php echo $incident->id ?>">
            {{Form::submit('Mover a Cerrado',['class'=>'btn btn-primary pull-right ']);}}
          <?php endif ?>
        {{ Form::close() }}
        </form>
      </div>




    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
  </div>
  <!-- end page container -->



@stop
