
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
                margin: 120,
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: 20,
                    depth: 50
                }
            },
            title: {
                text: 'Direcciones IP'
            },
            subtitle: {
                text: 'Top <?php echo $top ?> de direcciones <?php if($src_dst==1){ echo "de origen "; }else{ echo "destino ";} ?> <?php if($blacklist==1){ echo "que aparecen en blacklist"; } ?>'
            },
            plotOptions: {
                column: {
                    depth: 25
                }
            },
            xAxis: {
                categories: [<?php foreach ($ips as $ip ): ?>
                  "<h1><?php echo $ip->ip ?></h1>",
                <?php endforeach ?>]
            },
            yAxis: {
                title: {
                    text: null
                }
            },
            series: [{
                name: 'Cantidad de ocurrencias',
                data: [<?php foreach ($ips as $ip ): ?>
                  <?php echo $ip->count ?>,
                <?php endforeach ?>]
            }]
        });
    });


		</script>

<div class="col-md-12" >
              <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-plugins-1" style="height:500px">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                            </div>
                            <h4 class="panel-title">Frecuencia de direcciones IP reportadas</h4>
                        </div>
                        <div class="panel-body panel-form">
                            <div id="container" style="min-width: 310px; height: 450px; margin: 0 auto;width:1800px"></div>
                            <div id="sliders">

                                </div>
                        </div>
                    </div>
                    <!-- end panel -->
                  </div>
