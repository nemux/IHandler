<script type="text/javascript">

    var criticity_options = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            renderTo: 'statistics-criticity'
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

    var CriticityGraph = {
        make: function () {
            $.ajax({
                url: '{{route('incidents.criticity',7)}}',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function (response) {
                    criticity_options.title = {text: ''};

                    var data = [];
                    $.each(response, function (index, item) {
                        data.push([item.name, item.count]);
                    });

                    criticity_options.series[0].data = data;

                    var chart = new Highcharts.Chart(criticity_options);
                }
            });
        }
    };

    $(document).ready(function ($) {
        var chart = new CriticityGraph.make();
    });
</script>
<div id="statistics-criticity" style="height: 300px; width: 100%;"></div>