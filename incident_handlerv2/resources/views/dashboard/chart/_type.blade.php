<script type="text/javascript">

    var type_options = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            renderTo: 'statistics-type'
        },
        tooltip: false,
        plotOptions: {
            pie: {
                allowPointSelect: false,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b><br/>{point.y} (<b>{point.percentage:.2f}%)</b>)'
                }
            }
        },
        series: [{
            name: 'Incidentes',
            colorByPoint: true,
            data: []
        }]
    };

    var TypeGraph = {
        make: function () {
            $.ajax({
                url: '{{route('incidents.type',7)}}',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function (response) {
                    type_options.title = {text: ''};

                    var data = [];
                    $.each(response, function (index, item) {
                        data.push([item.name, item.count]);
                    });

                    type_options.series[0].data = data;

                    var chart = new Highcharts.Chart(type_options);
                }
            });
        }
    };

    $(document).ready(function ($) {
        var chart = new TypeGraph.make();
    });
</script>
<div id="statistics-type" style="height: 300px; width: 100%;"></div>