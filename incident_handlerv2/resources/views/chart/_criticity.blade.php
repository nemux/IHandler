<script type="text/javascript">
    $(document).ready(function ($) {
        if (!$.isFunction($.fn.dxChart))
            return;

        var dataSource = [], timer;

        $.ajax({
            url: '{{route('incidents.criticity',7)}}',
            dataType: 'json',
            async: true,
            success: function (response) {
                if (response.err_code)
                    alert(response.message);
                else {
//                    console.log(response);
                    $("#statistics-criticity").dxPieChart('instance').option('dataSource', response, timer);
                }
            },
            error: function (response) {
                alert(response);
            }
        });

        /**
         * Gráfica de Incidentes agrupados por Criticidad
         */
        $("#statistics-criticity").dxPieChart({
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
            palette: ['#D5080F', '#F7AA47', '#FCD036']
        });
    });
</script>
<div id="statistics-criticity" style="height: 300px; width: 100%;"></div>