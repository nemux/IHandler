

<script charset="utf-8">
$(function () {
    $('#container').highcharts({
        title: {
            <?php if ($option==1): ?>
              text: "Incidentes Mensuales",
            <?php endif ?>
            <?php if ($option==2): ?>
             text: "Incidentes por Día",
            <?php endif ?>
            x: -20 //center
        },
        subtitle: {
            text: 'Global Cybersec',
            x: -20
        },
        xAxis: {
            categories: ["",<?php foreach ($incidents as $i): ?>

            <?php if ($option==1): ?>
              "<?php echo date('F', mktime(0, 0, 0, $i->month, 10)); ?>",
            <?php endif ?>
            <?php if ($option==2): ?>
              "<?php echo date("d-m-Y",strtotime($i->date)); ?>",
            <?php endif ?>

            <?php endforeach ?>""]
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
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
          <?php if ($option==1): ?>
            name: "Incidentes Mensuales",
          <?php endif ?>
          <?php if ($option==2): ?>
           name: "Incidentes por Día",
          <?php endif ?>
            data: [0,<?php foreach ($incidents as $i ): ?>
              <?php echo $i->count ?>,
            <?php endforeach ?>,0]
        }, ]
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
