<script type="text/javascript">

    var flow_options = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            renderTo: 'statistics-flow'
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

    var FlowGraph = {
        make: function () {
            $.ajax({
                url: '{{route('incidents.flow',7)}}',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function (response) {
                    flow_options.title = {text: ''};

                    var data = [];
                    $.each(response, function (index, item) {
                        data.push([item.name, item.count]);
                    });

                    flow_options.series[0].data = data;

                    var chart = new Highcharts.Chart(flow_options);
                }
            });
        }
    };

    $(document).ready(function ($) {
        var chart = new FlowGraph.make();
    });
</script>
<div id="statistics-flow" style="height: 300px; width: 100%;"></div>