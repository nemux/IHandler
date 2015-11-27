<script type="text/javascript">
    jQuery(document).ready(function ($) {
        if (!$.isFunction($.fn.dxChart))
            return;

        var dataSource = [], timer;

        $.ajax({
            url: '{{route('incidents.flow',7)}}',
            dataType: 'json',
            async: true,
            success: function (response) {
                if (response.err_code)
                    alert(response.message);
                else {
//                    console.log(response);
                    $("#statistics-flow").dxPieChart('instance').option('dataSource', response, timer);
                }
            },
            error: function (response) {
                alert(response);
            }
        });

        /**
         * Gráfica de Incidentes agrupados por Flujo de Ataque
         */
        $("#statistics-flow").dxPieChart({
            dataSource: {},
            series: [
                {
                    argumentField: "name",
                    valueField: "incidents"
                }
            ],
            tooltip: {
                enabled: true,
                customizeText: function () {
                    return this.valueText + " Incidente(s)";
                }
            },
            pointClick: function (point) {
                point.showTooltip();

                clearTimeout(timer);

                timer = setTimeout(function () {
                    point.hideTooltip();
                }, 2000);

                $("select option:contains(" + point.argument + ")").prop("selected", true);
            },
            legend: {
                verticalAlignment: "bottom",
                horizontalAlignment: "center"
            },
            palette: ['#4fcdfc', '#2a6e87', '#1e4d5e']
        });
    })
    ;
</script>
<div id="statistics-flow" style="height: 300px; width: 100%;"></div>