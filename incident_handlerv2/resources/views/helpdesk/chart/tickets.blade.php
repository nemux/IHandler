<script type="text/javascript">
    var incidents_options = {
        chart: {type: 'spline', renderTo: 'statistics-customer-incidents'},
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {day: '%d/%m/%Y'},
            title: false
        },
        yAxis: {
            title: false,
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{point.x:%d/%m/%Y}</b><br/>',
            pointFormat: '{point.y} Tickets'
        },
        exporting: {sourceWidth: 1800, sourceHeight: 500},
        plotOptions: {spline: {marker: {enabled: true}}},
        series: []
    };

    var IncidentsGraph = {
        make: function () {
            $.ajax({
                url: '{{route('helpdesk.ticket.customer',7)}}',
                dataType: 'json',
                success: function (response) {
                    incidents_options.series = [];
                    incidents_options.title = {text: ''};
                    $.each(response, function (index, item) {
                        var data = [];
                        $.each(item.data, function (date, count) {
                            data.push([Date.parse(date), count]);
                        });

                        incidents_options.series.push({name: item.name.otrs_customer_id, data: data});
                    });

                    var chart = new Highcharts.Chart(incidents_options);
                },
                fail: function (response) {
                    alert(response); //TODO show it on a modal or some
                }
            });
        }
    };

    $(document).ready(function ($) {
        var graph = new IncidentsGraph.make();
    });
</script>
<div id="statistics-customer-incidents" style="height: 300px; width: 100%;"></div>