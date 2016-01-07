<script>
    var datatableOptions = {
        dom: "<'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>>",
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
//        sorting: false
        sorting: [[0, 'desc']]
    };

    var incidents_table;
    $(document).ready(function ($) {
        incidents_table = $("#tickets-table").DataTable(datatableOptions);
    });
</script>
<table class="table table-bordered table-striped table-model-2" id="tickets-table">
    <thead>
    <tr>
        <th class="col-sm-1">#Ticket</th>
        <th class="col-sm-1">Severidad</th>
        <th class="col-sm-1">Estatus</th>
        <th class="col-sm-3">Tipo</th>
        <th class="col-sm-1">Detección</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($tickets as $ticket)
        <tr style="cursor: pointer;"
            onclick="{window.open('{{route('helpdesk.ticket.show',explode('/',$ticket->internal_number))}}')}">
            <td>{{$ticket->internal_number}}</td>
            <td class="criticity-{{$ticket->ticket_criticity_id}}">{{$ticket->criticity->name}}</td>
            <td>{{$ticket->status->name}}</td>
            <td>{{$ticket->type->name}}</td>
            <td>{{ $ticket->created_at->format('d/m/Y H:i T') }}</td>
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
                    de <b>{{$tickets->total()}} Incidentes</b>
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