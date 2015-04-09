<?php
$total = 0;
foreach ($incidents as $i) {
    $total = $total + $i->total;
}
?>
<script charset="utf-8">
    var titulo = 'de incidentes por Severidad<br>Sensor: ' + '<?php echo $nombre_sensor?>';
    $(function () {
        $('#container1').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Cantidad ' + titulo
            },
            subtitle: {
                text: ''
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Delivered amount',
                data: [
                    <?php foreach ($incidents as $i): ?>
                    ['<?php echo explode("-",$i->criticity)[0] ?> : <?php echo $i->total ?>', <?php echo $i->total ?>],
                    <?php endforeach ?>

                ]
            }]
        });
    });
</script>

<script charset="utf-8">
    $(function () {
        $('#container2').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                }
            },
            title: {
                text: 'Porcentaje ' + titulo
            },
            subtitle: {
                text: ''
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45
                }
            },
            series: [{
                name: 'Delivered amount',
                data: [
                    <?php foreach ($incidents as $i): ?>
                    ['<?php echo explode("-",$i->criticity)[0] ?> : <?php echo number_format($i->total*100/$total,2)."%" ?>', <?php echo number_format($i->total*100/$total,2) ?>],
                    <?php endforeach ?>

                ]
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
            <h4 class="panel-title">Gráfica de Incidentes</h4>
        </div>
        <div class="panel-body panel-form">
            <div class="col-lg-6">
                <div id="container1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
            <div class="col-lg-6">
                <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
    <!-- end panel -->
</div>
