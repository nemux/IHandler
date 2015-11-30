@extends('layout.dashboard_topmenu')

@section('title', 'Lista de IPs por Clientes')

@section('include_up')
@endsection

@section('include_down')
    <script type="text/javascript">
        var options = {
            chart: {type: 'bar', renderTo: 'chart'},
            xAxis: {
                type: 'category',
                title: {
                    text: 'IPs'
                },
                categories: []
            },
            yAxis: {
                title: {
                    text: 'Incidentes por IP'
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{point.key}</b><br/>',
                pointFormat: '{point.y} Incidentes'
            },
            exporting: {
                sourceWidth: 1800,
                sourceHeight: 500
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: []
        };

        $(document).ready(function () {
            $("#customer_id").select2({
                placeholder: 'Cliente...',
                allowClear: true,
                dropdownAutoWidth: true
            }).on('select2-open', function () {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
            });

            $("#side").select2({
                placeholder: 'Lado...',
                allowClear: true,
                dropdownAutoWidth: true
            }).on('select2-open', function () {
                $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
            });

            $('#submit').click(function (e) {
                $('#submit').attr('disabled', true);
                $.ajax({
                    url: '{{route('stats.customer.list.ip.post')}}',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        from_date: $('#from_date').val(),
                        to_date: $('#to_date').val(),
                        customer_id: $('#customer_id').val(),
                        top: $('#top').val(),
                        side: $('#side').val(),
                        blacklist: $('#blacklist').prop('checked')
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                    ,
                    success: function (response) {
                        var div = $("#chart");
                        var top = response.length;

                        var data = [];
                        options.series = [];
                        data = [];
                        $.each(response, function (index, item) {
                            data.push([item.ip, item.count]);
                        });
                        options.series.push({name: 'Top ' + top + ' de IPs', data: data});

                        div.height(30 * top);
                        div.attr('hidden', false);

                        var blLabel = '';
                        if ($('#blacklist').prop('checked')) {
                            blLabel = ' en Blacklist';
                        }

                        options.title = {text: 'Top ' + top + ' de IPs registrados' + blLabel + ' del ' + $('#from_date').val() + ' al ' + $('#to_date').val()};
                        options.subtitle = {text: $('#customer_id option:selected').text()};

                        var chart = new Highcharts.Chart(options);

                        $('#submit').attr('disabled', false);
                    }
                });
            })
            ;
        })
        ;
    </script>
    {{--Custom Select Form--}}
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2.css" id="style-resource-2">
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2-bootstrap.css" id="style-resource-3">
    <script src="/xenon/assets/js/select2/select2.min.js" id="script-resource-12"></script>

    {{--Date & Time Pickers--}}
    <link rel="stylesheet" href="/xenon/assets/js/daterangepicker/daterangepicker-bs3.css" id="style-resource-1">

    <script src="/xenon/assets/js/moment.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/daterangepicker/daterangepicker.js" id="script-resource-8"></script>
    <script src="/xenon/assets/js/datepicker/bootstrap-datepicker.js" id="script-resource-9"></script>
    <script src="/xenon/assets/js/timepicker/bootstrap-timepicker.min.js" id="script-resource-10"></script>

    {{--HighCharts--}}
    <script src="/custom/assets/js/highcharts-4.1.9/highcharts.js"></script>
    <script src="/custom/assets/js/highcharts-4.1.9/modules/data.js"></script>
    <script src="/custom/assets/js/highcharts-4.1.9/modules/exporting.js"></script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Estadísticas de Incidentes por Cliente</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-md-1 col-xs-12">
                    <div class="date-and-time">
                        <input name="from_date" id="from_date" type="text"
                               class="form-control datepicker" data-format="dd/mm/yyyy"
                               data-end-date="{{date('d/m/Y')}}" placeholder="Fecha de Inicio">
                    </div>
                </div>
                <div class="form-group col-md-1 col-xs-12">
                    <div class="date-and-time">
                        <input name="to_date" id="to_date" type="text"
                               class="form-control datepicker" data-format="dd/mm/yyyy"
                               data-end-date="{{date('d/m/Y')}}" placeholder="Fecha Final">
                    </div>
                </div>
                <div class="form-group col-md-1 col-xs-12">
                    <input type="text" class="form-control" id="top" name="top" placeholder="Top..." value="10"/>
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    <select class="form-control" id="side" name="side">
                        <option></option>
                        <option value="source">Origen</option>
                        <option value="target">Destino</option>
                    </select>
                </div>
                <div class="form-group col-md-4 col-xs-12">
                    <select class="form-control" id="customer_id" name="customer_id">
                        <option></option>
                        @foreach(\App\Models\Customer\Customer::all(['name','id']) as $index=>$customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-1 col-xs-12">
                    <label class="control-label">Blacklist
                        <input type="checkbox" id="blacklist" name="blacklist">
                    </label>
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    <input type="button" class="form-control btn btn-success" value="Generar gráfica" id="submit">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div hidden id="chart" style="width: 100%; min-height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection