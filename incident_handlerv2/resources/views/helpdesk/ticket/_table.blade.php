<script>
    var datatableOptions = {
        dom: "<'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>>",
        columns: [
            {
                visible: false {{--Columna oculta que sirve solo para ordenar fechas--}}
            },
            null,
            {
                type: 'date',
                {{--Definido como 0, por si se agregan más columnas no tenga un efecto contraproducente--}}
                dataSort: 0
//                , 'class': "criticity-1"
            }, null, null, null, null, null, null
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
                    title: 'Tickets'
                }, {
                    text: 'PDF',
                    extend: 'pdfHtml5',
                    title: 'Tickets'
                }]
            }, {
                text: 'Imprimir',
                extend: 'print',
                title: 'Tickets'
            }
        ],
        language: {
            buttons: {
                pageLength: {
                    _: 'Mostrar %d Tickets',
                    '-1': 'Todos'
                }
            },
            infoEmpty: 'No hay Tickets para mostrar',
            zeroRecords: 'No hay Tickets para mostrar'
        },
        searching: false,
        sorting: [] //Not sort by default
    };

    var incidents_table;
    $(document).ready(function ($) {
        incidents_table = $("#helpdesk-table").DataTable(datatableOptions);
    });
</script>
<style>
</style>
<table class="table table-bordered table-striped table-model-2" id="helpdesk-table">
    <thead>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Fecha de Reporte</th>
        <th>Severidad</th>
        <th>Ticket</th>
        <th>Tipo</th>
        <th>Cliente</th>
        <th>Handler</th>
        <th>Estatus</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($tickets as $ticket)
        <tr style="cursor: pointer;"
            onclick="{window.open('{{route('helpdesk.ticket.show',explode('/',$ticket->internal_number))}}')}">
            <td>{{ $ticket->created_at}}</td>
            <td class="col-sm-1">{{$ticket->id}}</td>
            <td class="col-sm-2">{{ $ticket->created_at->format('d/m/Y H:i T') }}</td>

            <td class="col-sm-1">{{strtoupper($ticket->criticity->name)}}</td>
            <td class="col-sm-1">{{$ticket->internal_number}}</td>
            <td class="col-sm-2">{{$ticket->type->name}}</td>
            <td class="col-sm-3">{{$ticket->customer->name}}</td>
            <td class="col-sm-1">{{$ticket->lastHandler()?$ticket->lastHandler()->username:'----'}}</td>
            <td class="col-sm-1">{{$ticket->status->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{--Valida si se está utilizando un paginado en el controlador--}}
@if(method_exists($tickets,'render'))
    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row">
            <div class="col-sm-5">
                <div aria-live="polite" role="status" id="incidents-table_info" class="dataTables_info">
                    {{($tickets->perPage()*$tickets->currentPage())-$tickets->perPage()+1}}
                    al {{$tickets->hasMorePages()?($tickets->perPage()*$tickets->currentPage()):$tickets->total()}}
                    de <b>{{$tickets->total()}} Reportes</b>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="dataTables_paginate paging_full_numbers">
                    {!! $tickets->render() !!}
                </div>
            </div>
        </div>
    </div>
@endif