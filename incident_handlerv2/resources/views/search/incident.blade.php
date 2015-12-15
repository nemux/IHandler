@extends('layout.dashboard_topmenu')

@section('title', 'Buscador de Incidentes')

@section('include_up')
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/DataTables-1.10.10/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Buttons-1.1.0/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Responsive-2.0.0/css/responsive.bootstrap.min.css"/>
    <style>
        #incidents-table > tbody > tr {
            cursor: pointer;
        }
    </style>
@endsection

@section('include_down')
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

    {{--DataTables--}}
    <script type="text/javascript" src="/custom/assets/js/DataTables/pdfmake-0.1.18/build/pdfmake.min.js"></script>
    <script type="text/javascript" src="/custom/assets/js/DataTables/pdfmake-0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/DataTables-1.10.10/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/DataTables-1.10.10/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Buttons-1.1.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Buttons-1.1.0/js/buttons.bootstrap.min.js"></script>
    <script type="text/javascript" src="/custom/assets/js/DataTables/Buttons-1.1.0/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="/custom/assets/js/DataTables/Buttons-1.1.0/js/buttons.print.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Responsive-2.0.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript"
            src="/custom/assets/js/DataTables/Responsive-2.0.0/js/responsive.bootstrap.min.js"></script>

    <script type="text/javascript">
        var incidents_table;
        var datatableOptions = {
            dom: "<'row'<'col-sm-5'B><'col-sm-7'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    text: 'Copiar Tabla',
                    extend: 'copyHtml5'
                }, {
                    extend: 'collection',
                    text: 'Exportar a...',
                    buttons: [{
                        text: 'CSV',
                        extend: 'csvHtml5',
                        title: 'Incidentes'
                    }]
                }, {
                    text: 'Imprimir',
                    extend: 'print',
                    title: 'Incidentes'
                }
            ],
            language: {
                buttons: {
                    pageLength: {
                        _: 'Mostrar %d Incidentes',
                        '-1': 'Todos'
                    }
                },
                paginate: {
                    next: "Siguiente", previous: "Anterior", first: "Primero", last: "Último"
                },
                infoEmpty: 'No hay registros para mostrar',
                zeroRecords: 'No hay registros para mostrar',
                info: 'Mostrando del _START_ al _END_ <b>(_TOTAL_ registros)</b>',
                search: 'Buscar: ',
                infoFiltered: ' - Filtrado de <b>_MAX_</b> registros en total'
            },
            sorting: [[0, 'desc']]
        };
        $(document).ready(function ($) {
            incidents_table = $("#incidents-table").DataTable(datatableOptions);
            $('#incidents-table tbody').on('click', 'tr', function () {
                var data = incidents_table.row(this).data();
                window.open('/dashboard/incident/show/' + data[0])
            });

            $("#simple-search").submit(function (event) {
                var submit = $('#submit-sim');
                submit.attr('disabled', true);
                var text_footer = $('#collapseOne').children('.panel-footer');
                text_footer.empty();
                $.ajax({
                    url: '{{route('incident.search')}}',
                    method: 'post',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (response) {
                        addItems(response, submit, text_footer);
                    },
                    error: function (response) {
                        $('<div class="alert alert-danger"><strong>¡Error!</strong> ' + response + '.</div>').appendTo(text_footer);
                        submit.attr('disabled', false);
                    }
                });


                event.preventDefault();
            });

            $("#advanced-search").submit(function (event) {
                var submit = $('#submit-adv');
                submit.attr('disabled', true);
                var text_footer = $('#collapseTwo').children('.panel-footer');
                text_footer.empty();
                $.ajax({
                    url: '{{route('incident.search')}}',
                    method: 'post',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (response) {
                        addItems(response, submit, text_footer);
                    },
                    error: function (response) {
                        console.log(response);
                        $('<div class="alert alert-danger"><strong>¡Error!</strong> ' + response + '.</div>').appendTo(text_footer);
                        submit.attr('disabled', false);
                    }
                });


                event.preventDefault();
            });
        });

        function addItems(response, submit, text_footer) {
            console.log(response);
            if (response.err_code) {
                $('<div class="alert alert-danger"><strong>¡Error!</strong> ' + response.err_message + '.</div>').appendTo(text_footer);
            } else {
                $('<div class="alert alert-success">Se encontraron <strong>' + response.items.length + '</strong> coincidencias.</div>').appendTo(text_footer);

                incidents_table.clear();
                $.each(response.items, function (index, item) {
                    if (index == 0) {
                        console.log(item);
                    }

                    var signatures = '<ul class="list-unstyled">';

                    $.each(item.signatures, function (index, item) {
                        signatures += '<li>' + item.signature.name + '</li>';
                    });

                    signatures += '</ul>';

                    var sensors = '<ul class="list-unstyled">';

                    $.each(item.sensors, function (index, item) {
                        sensors += '<li>' + item.sensor.name + '</li>';
                    });

                    sensors += '</ul>';

                    incidents_table.row.add([
                        item.id,
                        item.criticity,
                        item.internal_number,
                        item.title,
                        signatures,
                        item.det_time,
                        sensors,
                        item.status,
                        item.username
                    ])
                });
                incidents_table.draw();
            }
            submit.attr('disabled', false);
        }
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default" id="search-section">
        <div class="panel-heading">
            <h5>Buscador de Incidentes</h5>
        </div>
        <div class="panel-body row">
            <div class="col-sd-12">
                <div class="panel-group panel-group-joined" id="accordion-test">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne"
                                   class="collapsed">
                                    Búsqueda Simple
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <form id="simple-search">
                                    <input id="search_type" type="hidden" value="simple" name="search_type">

                                    <div class="row">
                                        <div class="col-md-10 col-sm-12 form-group">
                                            <input id="search_string" class="form-control"
                                                   placeholder="Buscar... (Título, Descripción, Recomendación ó Referencias)"
                                                   name="search_string">
                                        </div>
                                        <div class="col-md-2 col-sm-12 form-group">
                                            <input type="submit" value="Buscar" class="btn btn-primary form-control"
                                                   id="submit-sim">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseTwo">
                                    Búsqueda Avanzada
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form id="advanced-search">
                                    <input id="search_type" type="hidden" value="advanced" name="search_type">

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 form-group">
                                            <label for="search_string_advanced" class="control-label">Texto o ingresado
                                                en el Título,
                                                Descripción, Recomendación y Referencias del Incidente</label>
                                            <input id="search_string_advanced" class="form-control"
                                                   placeholder="Incidente... (Título, Descripción, Recomendación ó Referencias)"
                                                   name="search_string_advanced">
                                            {{--Notas del Incidente--}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-6 form-group">
                                            <label class="control-label" for="from_detection">Detección del
                                                Incidente</label>
                                            @include('formcontrols._fromdate',['id'=>'from_detection'])
                                        </div>
                                        <div class="col-md-2 col-sm-6 form-group">
                                            <label></label>
                                            @include('formcontrols._todate',['id'=>'to_detection'])
                                        </div>
                                        <div class="col-md-2 col-sm-6 form-group">
                                            <label class="control-label" for="from_occurrence">Ocurrencia del
                                                Incidente</label>
                                            @include('formcontrols._fromdate',['id'=>'from_occurrence'])
                                        </div>
                                        <div class="col-md-2 col-sm-6 form-group">
                                            <label></label>
                                            @include('formcontrols._todate',['id'=>'to_occurrence'])
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <label for="user" class="control-label">Usuario(s) que creó el
                                                incidente</label>
                                            @include('formcontrols._user',['id'=>'user','multiple'=>true])
                                        </div>
                                    </div>
                                    {{--Ticket del Incidente--}}

                                    {{--Datos de los anexos ?--}}
                                    {{--Datos de las Evidencias ?--}}
                                    {{--Eventos del Incidente ?--}}

                                    {{--Customer data--}}
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <label for="customer" class="control-label">Cliente(s) asociado(s) al
                                                Incidente</label>
                                            @include('formcontrols._customer',['id'=>'customer','multiple'=>true])
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <label for="sensor" class="control-label">Sensor(es) asociado(s) al
                                                Incidente</label>
                                            @include('formcontrols._sensor',['id'=>'sensor','multiple'=>true])
                                        </div>
                                        <div class="col-md-4 col-sm-12 form-group">
                                            <label for="criticity" class="control-label">Severidad(es) asociada(s) al
                                                Incidente</label>
                                            @include('formcontrols._criticity',['id'=>'criticity','multiple'=>true])
                                        </div>
                                    </div>
                                    {{--Incident catalogs data--}}
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 form-group">
                                            <label for="category" class="control-label">Categoría(s) asociada(s) al
                                                Incidente</label>
                                            @include('formcontrols._category',['id'=>'category','multiple'=>true])
                                        </div>
                                        <div class="col-md-6 col-sm-12 form-group">
                                            <label for="signature" class="control-label">Firma(s) asociada(s) al
                                                Incidente</label>
                                            @include('formcontrols._signature',['id'=>'signature','multiple'=>true])
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 form-group">
                                            <label for="flow" class="control-label">Flujo(s) del Incidente</label>
                                            @include('formcontrols._flow',['id'=>'flow','multiple'=>true])
                                        </div>
                                        <div class="col-md-6 col-sm-12 form-group">
                                            <label for="attacktype" class="control-label">Tipo(s) de Ataque asociado(s)
                                                al Incidente</label>
                                            @include('formcontrols._attacktype',['id'=>'attacktype','multiple'=>true])
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2 col-sm-12 form-group">
                                            <input type="submit" value="Buscar" class="btn btn-primary form-control"
                                                   id="submit-adv">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default" id="result-section">
        <div class="panel-heading">
            <h3 class="panel-title">Lista de Incidentes</h3><br/>
        </div>
        <div class="panel-body">
            @include('incident._table')
        </div>
    </div>
@endsection