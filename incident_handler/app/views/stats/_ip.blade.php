
<style type="text/css">
#container, #sliders {
	min-width: 310px;
	max-width: 800px;
	margin: 0 auto;
}
#container {
	height: 400px;
}
		</style>
		<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column',
                margin: 75,
                options3d: {
                    enabled: true,
                    alpha: 10,
                    beta: 25,
                    depth: 70
                }
            },
            title: {
                text: '3D chart with null values'
            },
            subtitle: {
                text: 'Notice the difference between a 0 value and a null point'
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            xAxis: {
                categories: [<?php foreach ($ips as $ip ): ?>
                  "<?php echo $ip->ip ?>",
                <?php endforeach ?>]
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            series: [{
                name: 'Cantidad',
                data: [<?php foreach ($ips as $ip ): ?>
                  <?php echo $ip->count ?>,
                <?php endforeach ?>]
            }]
        });
    });


		</script>

<div class="col-md-12">
              <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            </div>
                            <h4 class="panel-title">Frecuencia de direcciones IP reportadas</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            <div id="sliders">
                                	
                                </div>
                        </div>
                    </div>
                    <!-- end panel -->
                  </div>
