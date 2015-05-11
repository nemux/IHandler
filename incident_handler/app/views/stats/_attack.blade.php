<?php
$total = 0;
foreach ($incidents as $i) {
    $total = $total + $i->total;
}
?>
<script charset="utf-8">
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
                text: '<?php echo $sensor_name ?>:: incidentes por tipo de ataque'
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
                    ['<?php echo $i->attack ?> : <?php echo $i->total ?>', <?php echo $i->total ?>],
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
                text: '<?php echo $sensor_name ?>:: porcentaje de incidentes por tipo de ataque'
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
                    ['<?php echo $i->attack ?> : <?php echo number_format($i->total*100/$total,2)."%" ?>', <?php echo number_format($i->total*100/$total,2) ?>],
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
            <h4 class="panel-title">Gráfica de ataques</h4>
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
