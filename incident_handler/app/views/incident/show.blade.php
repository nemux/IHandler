
<head>
  <meta charset="utf-8" />
</head>
<style media="screen">
  body{

    font-family:Arial, Helvetica, sans-serif;
    font-size:12px;
  }
  .wrapper{
    width:600px;
  }
  table, th, td {
     border: 1px solid black;
  }
  img{
    width:50%;
    margin-left:18%;
    border-radius:6px;
    box-shadow: 10px 10px 5px #888888;
    margin-top:5px;
    margin-bottom:5px;
  }
</style>

<body>
  <div  >
    <table>
      <tr>
        <td colspan="3" style="text-align:center;background:#d9d9d9">
          <strong>Incidente: <?php echo $incident->title ?></strong>
        </td>

      </tr>
      <tr style="">
        <td style="text-align:center;background:#d9d9d9">
          <strong>Categoría:</strong>
        </td>
        <td colspan="2" style="border-collapse: collapse;">
          <table style="border-collapse: collapse;">
            <tr>
              <td colspan="2" style="text-align:center;background:#d9d9d9">
                Descripción
              </td>
            </tr>
            <tr>
              <td style="text-align:center">
                <?php echo $incident->category->id ?>
              </td>
              <td style="">
                <?php echo $incident->category->description ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Sensor:</strong>
        </td>
        <td colspan="2" style="text-align:center">
          <?php echo $incident->sensor->name ?>
        </td>
      </tr>

      <tr>
        <td style="text-align:center;background:#CCC;">
          <strong>Ticket:</strong>
        </td>
        <td style="text-align:center;" colspan="5">
          <?php //echo $incident->ticket->internal_number ?>
        </td>
      </tr>

      <tr>
        <td style="text-align:center;background:#CCC;">
          <strong>Status:</strong>
        </td>
        <td style="text-align:center;" colspan="5">
          <?php echo $incident->status->name ?>
        </td>
      </tr>
      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Indicador:</strong>
        </td>
        <td colspan="2" style="text-align:center">
          <?php foreach ($incident->incidentRule as $r ): ?>
            "<?php echo $r->rule->message ?>"<br>
            <?php //print_r($r) ?>
          <?php endforeach ?>
          <?php //print_r($incident->incidentRule); ?>
        </td>
      </tr>
      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Flujo del ataque:</strong>
        </td>
        <td colspan="2" style="text-align:center">
          <?php
              echo $incident->stream;

          ?>
        </td>
      </tr>
      <tr>
        <td style="text-align:center;background:#d9d9d9" >
          <strong>Fecha de detección:</strong>
        </td>
        <td colspan="2" style="text-align:center">
          <?php
              echo $det_time->datetime;

          ?>,<?php
              echo $det_time->zone;

          ?>
        </td>
      </tr>
      <tr >

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
        <td style="background-color:<?php echo $color ?>;color:<?php echo $font ?>;text-align:center" colspan="2">
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
        <td colspan="2" style="text-align:center">

            <?php foreach ($incident->srcDst as $ip): ?>
              <?php echo $ip->src->ip ?><br>
            <?php endforeach ?>

        </td>
      </tr>

      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Dirección IP Destino:</strong>
        </td>
        <td colspan="2" style="text-align:center">

            <?php foreach ($incident->srcDst as $ip): ?>
              <?php echo $ip->dst->ip ?><br>
            <?php endforeach ?>

        </td>
      </tr>
      <?php if (count($listed)>0): ?>
        <tr>
          <td style="text-align:center;background:#d9d9d9">
            <strong>Blacklist:</strong>
          </td>
          <td colspan="2">
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
                    <?php print_r($l->location) ?><br>
                  <?php endforeach ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      <?php endif ?>

      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Descripción:</strong>
        </td>
        <td colspan="2" style="text-align: justify; padding:10px;">
          <?php echo $incident->description ?><br>
          <?php echo $incident->conclution ?>
        </td>
      </tr>

      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Recomendación:</strong>
        </td>
        <td colspan="2" style="text-align: justify; padding:10px;">
          <?php echo $incident->recomendation ?><br>

        </td>
      </tr>

      <tr>
        <td style="text-align:center;background:#d9d9d9">
          <strong>Referencia:</strong>
        </td>
        <td colspan="2" style="text-align: justify; padding:10px;">
          <?php echo $incident->reference->link ?><br>

        </td>
      </tr>
    </table>
  </div>
</body>



  </div>
  <!-- end page container -->
