<script type="text/javascript">

    var category_options = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            renderTo: 'statistics-category'
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

    var CategoryGraph = {
        make: function () {
            $.ajax({
                url: '{{route('incidents.category',7)}}',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                success: function (response) {
                    category_options.title = {text: ''};

                    var data = [];
                    $.each(response, function (index, item) {
                        data.push([item.name, item.count]);
                    });

                    category_options.series[0].data = data;

                    var chart = new Highcharts.Chart(category_options);
                }
            });
        }
    };

    $(document).ready(function ($) {
        var chart = new CategoryGraph.make();
    });
</script>
<div id="statistics-category" style="height: 300px; width: 100%;"></div>