

<script src="/assets/highcharts/js/highcharts.js"></script>
<script src="/assets/highcharts/js/modules/exporting.js"></script>
<script charset="utf-8">
  $(function () {
      $('#container').highcharts({
          title: {
              text: 'Incidentes Mensuales',
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
                "<?php echo $i->day." ".date('F', mktime(0, 0, 0, $i->month, 10)); ?>",
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
              name: 'Incidentes por mes',
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
