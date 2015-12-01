<?php

$days_between = floor((strtotime($end)-strtotime($start))/(60*60*24));;

?>

<script charset="utf-8">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Incidentes por Handler',
            x: -20 //center
        },
        subtitle: {
            text: 'Cantidad de incidentes reportados por Incident Handler',
            x: -20
        },
        xAxis: {
            categories: ["",<?php
            for ($i=1; $i <$days_between+ 1 ; $i++) {
              echo "'".date("Y-m-d",strtotime(date("Y-m-d ",strtotime($start))." +".$i." days"))."',";
            }
            ?>,""]
        },
        yAxis: {
            title: {
                text: ' Incidentes'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' Incidentes'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [<?php foreach ($handlers as $h): ?>
          <?php if ($h->id!=20 && $h->id!=1): ?>
            {
                name: '<?php echo $h->name ?> <?php echo $h->lastname ?>',
                data: [0,
                  <?php $anterior=date("Y-m-d",strtotime($start)); ?>
                  <?php foreach ($incidents_by_handler[$h->id]['incidents'] as $i): ?>
                    <?php $between_days=floor((strtotime($i->date)-strtotime($anterior))/(60*60*24)) ?>
                    <?php
                      for ($o=1;$o<$between_days;$o++) {
                      echo "0,";
                      }
                    ?>
                    <?php echo $i->count."," ?>
                    <?php $anterior=date("Y-m-d",strtotime($i->date)); ?>
                  <?php endforeach ?>


                  0]
            },
          <?php endif ?>
        <?php endforeach ?>]
    });
});

</script>

<div class="col-md-12">
              <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            </div>
                            <h4 class="panel-title">Gráfica de incidente</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        </div>
                    </div>
                    <!-- end panel -->
                  </div>
                  <?php /*if ($anterior!=date("Y-m-d",$i->date)) {
                    $diff=floor((strtotime(date("Y-m-d",$i->date))-strtotime(date("Y-m-d",$anterior)))/(60*60*24));
                    for ($o=0; $o <intval($diff) ; $o++) {
                      echo "0,";
                    }
                  } */?>
<?php echo $start ?>
