

<script charset="utf-8">
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Incidentes',
            x: -20 //center
        },
        subtitle: {
            text: 'Reportados por Día',
            x: -20
        },
        xAxis: {
            categories: [<?php for($i=1;$i<32;$i++) echo "'".$i."',"; ?>]
        },
        yAxis: {
            title: {
                text: 'Cantidad de Incidentes'
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
        
        series: [<?php foreach ($months as $m): ?>
        {
        name: '<?php echo date('F', mktime(0, 0, 0, $m->month, 10)); ?> <?php echo $m->year ?>',
        // Define the data points. All series have a dummy year
        // of 1970/71 in order to be compared on the same x axis. Note
        // that in JavaScript, months start at 0 for January, 1 for February etc.
        data: [
          <?php $anterior="00"; ?>
          <?php foreach ($incidents as $i): ?>

            <?php if (date("Y-m",strtotime($i->date))== $m->year.'-'.str_pad($m->month, 2, '0', STR_PAD_LEFT) ): ?>
              <?php if ($anterior!=date("d",strtotime($i->date))) {
                for($o=0;$o< (date("d",strtotime($i->date))-$anterior-1) ;$o++){ echo "0,";}
              } ?>
              <?php echo $i->count ?>   ,
              <?php $anterior=date("d",strtotime($i->date)); ?>

            <?php endif ?>

          <?php endforeach ?>
          <?php if($anterior!="31"){
            for ($i=$anterior; $i < 32; $i++) {
              echo "0,";
            }
          }?>

          ]},
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
