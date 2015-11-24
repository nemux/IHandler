<script type="text/javascript">
    jQuery(document).ready(function ($) {
        if (!$.isFunction($.fn.dxChart))
            return;

        var dataSource = [], timer;

        $.ajax({
            url: '{{route('incidents.type',7)}}',
            dataType: 'json',
            async: true,
            success: function (response) {
                if (response.err_code)
                    alert(response.message);
                else {
//                    console.log(response);
                    $("#statistics-type").dxPieChart('instance').option('dataSource', response, timer);
                }
            },
            error: function (response) {
                alert(response);
            }
        });

        /**
         * Gráfica de Incidentes agrupados por Categoria
         */
        $("#statistics-type").dxPieChart({
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
                    return this.argumentText + "<br/>" + this.valueText + " Incidente(s)";
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
                enabled: false
            },
            palette: [
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}',
                '{{sprintf('#%06X', mt_rand(0, 0xFFFFFF))}}'
            ]
        });
    });
</script>
<div id="statistics-type" style="height: 300px; width: 100%;"></div>