<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>{{$incident->title}}</title>
  <style media="screen">
  body{

    font-family:Arial, Helvetica, sans-serif;
    font-size:12px;
  }
  .wrapper{
    width:600px;
  }
  .max-width{
    width=700px;
  }

  table, th, td {
     border: 1px solid black;
  }
  img{
    width:700px;
    border-radius:6px;
    box-shadow: 10px 10px 5px #888888;
    margin-top:5px;
    margin-bottom:5px;
  }
</style>
</head>
<body>
<!--
<div  style="text-align:left">
  <img src="assets/img/gcs-header.jpg"/>
</div>
-->

<br/>
<br/>

@if ( isset($body))
  <div>
    <p>{{ $body }} </p>
  </div>
<br/>
@endif

<div  style="margin-bottom:20px">
  <table class="max-width">
    <tr>
      <td colspan="3" style="text-align:center;background:#d9d9d9">
        <strong>Incidente: <?php echo $incident->title ?></strong>
      </td>

    </tr>
    <tr style="">
      <td style="text-align:center;background:#d9d9d9" colspan="1">
        <strong>Categoría:</strong>
      </td>
      <td style="border-collapse: collapse;width:100%" colspan="2">
        <table style="border-collapse: collapse;width:100%">
          <tr>
            <td colspan="2" style="text-align:center;background:#d9d9d9;" width="100%">
              Descripción
            </td>
          </tr>
          <tr style="width:100%">
            <td style="text-align:center;width:25%">
              <?php echo ($incident->category->id)-1; ?>
            </td>
            <td style="text-align: justify;">
              <?php echo $incident->category->name ?>.
              <?php echo $incident->category->description ?>
            </td>
          </tr>
          <?php foreach ($incident->extraCategory as $ec): ?>
              <tr style="width:100%">
                <td style="text-align:center;width:25%">
                  <?php echo ($ec->category->id)-1; ?>
                </td>
                <td style="text-align: justify;">
                  <?php echo $ec->category->name ?>.
                  <?php echo $ec->category->description ?>
                </td>
              </tr>
          <?php endforeach ?>
        </table>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;background:#d9d9d9">
        <strong>Sensor:</strong>
      </td>
      <td colspan="2" style="text-align:center;padding:0px">

        <table style="margin:0px;padding:0px;width:100%;border-collapse: collapse;border:none"  >
          <tr style="border:none">
            <td style="padding:4px;text-align:center;">
              <?php echo $incident->sensor->name ?>
            </td>
          </tr>
          <?php foreach ($incident->extraSensor as $es): ?>
            <tr style="margin:0px;padding:0px;border:none">
              <td style="margin:0px;padding:4px;text-align:center;">
                <?php echo $es->sensor->name ?>
              </td>
            </tr>
          <?php endforeach ?>
        </table>
      </td>
    </tr>

    <tr>
      <td style="text-align:center;background:#d9d9d9;">
        <strong>Ticket:</strong>
      </td>
      <td style="text-align:center;" colspan="2" width="100%">
        @if (isset($incident->ticket->internal_number))
          {{ $incident->ticket->internal_number }}
        @else
          {{ "Por asignar....."}}
        @endif
      </td>
    </tr>

    <tr>
      <td style="text-align:center;background:#d9d9d9;">
        <strong>Estatus:</strong>
      </td>
      <td style="text-align:center;" colspan="2" width="100%">
        <?php echo $incident->status->name ?>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;background:#d9d9d9">
        <strong>Indicador de Compromiso:</strong>
      </td>
      <td colspan="2" style="text-align:center" width="100%">
        <?php foreach ($incident->incidentRule as $r ): ?>
          <?php echo $r->rule->message ?><br>
          <?php //print_r($r) ?>
        <?php endforeach ?>
        <?php //print_r($incident->incidentRule); ?>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;background:#d9d9d9">
        <strong>Flujo del ataque:</strong>
      </td>
      <td colspan="2" style="text-align:center" width="100%">
        <?php
            echo $incident->stream;
        ?>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;background:#d9d9d9" >
        <strong>Fecha de detección:</strong>
      </td>
      <td colspan="2" style="text-align:center" width="100%">
        <?php
            echo $det_time->datetime;

        ?>,<?php
            echo $det_time->zone;

        ?>
      </td>
    </tr>
    <tr>

      <td style="text-align:center;background:#d9d9d9">
        <strong>Severidad:</strong>
      </td>

      <?php
      $font="";
      $color="";
      if ($incident->criticity=="BAJA") {
        $color="#01DF3A";
        $font="#000";
      }else if($incident->criticity=="MEDIA"){
        $color="#F7FE2E";
        $font="#000";
      }else if($incident->criticity=="ALTA"){
        $color="#FE2E2E";
        $font="#FFF";
      }

       ?>
      <td style="background-color:<?php echo $color ?>;color:<?php echo $font ?>;text-align:center" colspan="2" width="100%">
        <div >
          <?php
              echo $incident->criticity;
          ?>
        </div>
      </td>
    </tr>
    <tr>
      <td style="text-align:center;background:#d9d9d9">
        <strong>Dirección IP de Origen:</strong>
      </td>
      <td colspan="2" style="text-align:center" width="100%">

          <?php foreach ($incident->srcDst as $ip): ?>
            <?php
            if($ip->src->ip!="" && $ip->src->show != false){
              echo $ip->src->ip.'<br>';}
            ?>
          <?php endforeach ?>

      </td>
    </tr>

    <tr>
      <td style="text-align:center;background:#d9d9d9">
        <strong>Dirección IP Destino:</strong>
      </td>
      <td colspan="2" style="text-align:center" width="100%">

          <?php foreach ($incident->srcDst as $ip): ?>
            <?php
            if($ip->dst->ip!="" && $ip->dst->show != false){
              echo $ip->dst->ip.'<br>';}
            ?>
          <?php endforeach ?>

      </td>
    </tr>
    <?php if (count($listed)>0): ?>
      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Blacklist:</strong>
        </td>
        <td colspan="2" width="100%">
          <table style="border-collapse:collapse;width:100%">
            <tr>
              <th style="text-align:center;background:#d9d9d9">
                Dirección Ip
              </th>
              <th style="text-align:center;background:#d9d9d9">
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
                  <?php
                  if (isset($l->location)) {
                    print_r($l->location);
                  }
                  ?><br>
                <?php endforeach ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    <?php endif ?>

    <tr>
      <td style="text-align:center;background:#d9d9d9" colspan="1">
        <strong>Descripción:</strong>
      </td>
      <td colspan="2" style="text-align: justify; padding:10px;" width="100%">
        <?php echo $incident->description ?><br>
        <?php echo $incident->conclution ?>
      </td>
    </tr>

    <tr>
      <td style="text-align:center;background:#d9d9d9">
        <strong>Recomendación:</strong>
      </td>
      <td colspan="2" style="text-align: justify; padding:10px;" width="100%">
          {{ $incident->recomendation }} <br/>
         @if (count($recomendations) > 0 )
          @foreach($recomendations as $r )
            {{ "[".$r->created_at."]" }} <br/>
            {{ $r->content }} <br/>
          @endforeach
         @endif
      </td>
    </tr>
    <tr>
      <td style="text-align:center;background:#d9d9d9">
        <strong>Referencia:</strong>
      </td>
      <td colspan="2" style="text-align: justify; padding:10px;" width="100%">
        <?php echo $incident->reference->link ?><br>

      </td>
    </tr>
  </table>


  <?php foreach ($incident->annexes as $a ): ?>

          <div class="col-lg-12" style="margin-bottom:20px;padding-top:20px">
            <div class="form-group" >

              <table class="table table-bordered" class="max-width">
                <tr style="text-align:center;background:#CCC;">
                  <td colspan="2">
                      <strong> <?php echo $a->title ?></strong>
                  </td>
                </tr>
                <tr>
                  <td style="text-align:center;background:#CCC;width:15%">
                    <?php echo $a->field ?>
                  </td>
                  <td>
                    <?php echo $a->content ?>
                  </td>
                </tr>
              </table>
            </div>
          </div>
  <?php endforeach ?>
</div>
<div style="margin: 0px 20px; font-size: 80%; text-align: center; font-family: Helvetica,Arial,sans-serif;
            color: rgb(200, 0, 0);"><small style="font-family: Helvetica,Arial,sans-serif;">
          <big><strong>Informaci&oacute;n Confidencial</strong></big></small>
</div>

<div style="margin: 0px 20px; font-size: 80%; text-align: center; font-family: Helvetica,Arial,sans-serif;
            color: rgb(30, 144, 255);"><small style="font-family: Helvetica,Arial,sans-serif;">
            <strong>&copy; {{ date("Y") }} Global Cybersec</strong></small>
</div>
</body>
</html>
