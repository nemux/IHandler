<script type="text/javascript">
    jQuery(document).ready(function ($) {
        if (!$.isFunction($.fn.dxChart))
            return;

        //Petición Ajax para la gráfica de estadísticas de incidentes por día, por cliente
        $.ajax({
            url: '{{route('incidents.customer',7)}}',
            dataType: 'json',
            async: true,
            success: function (response) {
                if (response.err_code)
                    alert(response.message); //TODO show it on a modal or some
                else {
                    $("#statistics-customer-incidents").dxChart('instance').option('dataSource', response);
                }
            },
            error: function (response) {
                alert(response); //TODO show it on a modal or some
            }
        });


        /**
         * Gráfica de estadísticas sobre
         * incidentes de seguridad por día, por cliente
         */
        $("#statistics-customer-incidents").dxChart({
            dataSource: {},
            series: [
                    @foreach(\App\Models\Customer\Customer::all('otrs_customer_id','id') as $customer)
                {
                    argumentField: "date",
                    valueField: 'customer_{{$customer->id}}',
                    name: "{{$customer->otrs_customer_id}}"
                },
                @endforeach
            ],
            palette: xenonPalette,
            argumentAxis: {
                grid: {
                    visible: false
                }
            },
            tooltip: {
                enabled: true
            },
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
<div id="statistics-customer-incidents" style="height: 200px; width: 100%;"></div>