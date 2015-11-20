<script type="text/javascript">
    jQuery(document).ready(function ($) {
        if (!$.isFunction($.fn.dxChart))
            return;
        var dataSource = [
                //TODO rellenar con los datos de los incidentes agrupados por día, por cliente
            {year: 1950, europe: 546, americas: 332, africa: 227},
            {year: 1960, europe: 705, americas: 417, africa: 283},
            {year: 1970, europe: 856, americas: 513, africa: 361},
            {year: 1980, europe: 1294, americas: 614, africa: 471},
            {year: 1990, europe: 321, americas: 721, africa: 623},
            {year: 2000, europe: 730, americas: 1836, africa: 1297},
            {year: 2010, europe: 728, americas: 935, africa: 982},
            {year: 2020, europe: 721, americas: 1027, africa: 1189},
            {year: 2030, europe: 704, americas: 1110, africa: 1416},
            {year: 2040, europe: 680, americas: 1178, africa: 1665},
            {year: 2050, europe: 650, americas: 1231, africa: 1937}
        ];
        $("#bar-3").dxChart({
            dataSource: dataSource,
            commonSeriesSettings: {
                //TODO validar que este campo corresponda con alguno importante del dataSource
                argumentField: "year"
            },
            series: [
                    //TODO rellenar con los datos de los clientes
                {valueField: "europe", name: "Europe", color: "#40bbea"},
                {valueField: "americas", name: "Americas", color: "#cc3f44"},
                {valueField: "africa", name: "Africa", color: "#8dc63f"}
            ],
            argumentAxis: {
                grid: {
                    visible: false
                }
            },
            tooltip: {
                enabled: true
            },
//            title: "Historic, Current and Future Population Trends",
            legend: {
                verticalAlignment: "bottom",
                horizontalAlignment: "center"
            },
            commonPaneSettings: {
                border: {
                    visible: true,
                    right: false
                }
            }
        });
    });
</script>
<div id="bar-3" style="height: 200px; width: 100%;"></div>