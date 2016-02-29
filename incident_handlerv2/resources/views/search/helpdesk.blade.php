@extends('layout.dashboard_topmenu')

@section('title', 'Buscador de Tickets de Helpdesk')

@section('include_up')
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/DataTables-1.10.10/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Buttons-1.1.0/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Responsive-2.0.0/css/responsive.bootstrap.min.css"/>
    <style>
        #helpdesk-table > tbody > tr {
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
        var helpdesk_tickets_table;
        var datatableOptions = {
            dom: "<'row'<'col-sm-5'B><'col-sm-7'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
            columns: [
                {
                    visible: false {{--Columna oculta que sirve solo para ordenar fechas--}}
                },
                {'class': 'col-md-1'},
                {
                    type: 'date',
                    dataSort: 0,
                    'class': 'col-md-2'
                }, {'class': 'col-md-1'}, {'class': 'col-md-1'}, {'class': 'col-md-2'}, {'class': 'col-md-3'}, {'class': 'col-md-1'}, {'class': 'col-md-1'}
            ],
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
            sorting: []
        };
        $(document).ready(function ($) {
            helpdesk_tickets_table = $("#helpdesk-table").DataTable(datatableOptions);
            $('#helpdesk-table tbody').on('click', 'tr', function () {
                var data = helpdesk_tickets_table.row(this).data();
                window.open('/dashboard/helpdesk/ticket/' + data[4])
            });

            $("#simple-search").submit(function (event) {
                var submit = $('#submit-sim');
                submit.attr('disabled', true);
                var text_footer = $('#collapseOne').children('.panel-footer');
                text_footer.empty();
                $.ajax({
                    url: '{{route('helpdesk.ticket.search')}}',
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
            helpdesk_tickets_table.clear();

            if (response.err_code) {
                $('<div class="alert alert-danger"><strong>¡Error!</strong> ' + response.err_message + '.</div>').appendTo(text_footer);
            } else {
                $('<div class="alert alert-success">Se encontraron <strong>' + response.items.length + '</strong> coincidencias.</div>').appendTo(text_footer);
                $.each(response.items, function (index, item) {

                    var handler = '----';
                    $.each(item.messages, function (index, message) {
                        if (!message.is_customer) {
                            handler = message.handler.username;
                        }
                    });

                    helpdesk_tickets_table.row.add([
                        item.ca,
                        item.id,
                        item.cr_at,
                        item.criticity.toUpperCase(),
                        item.internal_number,
                        item.type,
                        item.customer.name,
                        handler,
                        item.status
                    ])
                });
                helpdesk_tickets_table.draw();
            }
            submit.attr('disabled', false);
        }
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default" id="search-section">
        <div class="panel-heading">
            <h5>Buscador de Tickets de Helpdesk</h5>
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
                                                   placeholder="Buscar..."
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
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default" id="result-section">
        <div class="panel-heading">
            <h3 class="panel-title">Lista de Tickets</h3>
        </div>
        <div class="panel-body">
            @include('helpdesk.ticket._table')
        </div>
    </div>
@endsection