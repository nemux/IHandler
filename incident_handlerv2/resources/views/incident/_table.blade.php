<script type="text/javascript">
    @if(isset($incidents));
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
                    title: 'Incidentes'
                }, {
                    text: 'PDF',
                    extend: 'pdfHtml5',
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
            infoEmpty: 'No hay Incidentes para mostrar',
            zeroRecords: 'No hay Incidentes para mostrar',
        },
        searching: false,
        sorting: [[0, 'desc']]
    };

    var incidents_table;
    $(document).ready(function ($) {
        incidents_table = $("#incidents-table").DataTable(datatableOptions);
    });
    @endif;
</script>
<table class="table table-bordered table-striped" id="incidents-table">
    <thead>
    <tr>
        <th class="col-sm-1">ID</th>
        <th class="col-sm-1"># Ticket</th>
        <th class="col-sm-3">Título</th>
        <th class="col-sm-3">Indicadores</th>
        <th class="col-sm-1">Detección</th>
        <th class="col-sm-1">Sensores</th>
        <th class="col-sm-1">Status</th>
        <th class="col-sm-1">Handler</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @if(isset($incidents))
        @foreach($incidents as $index=>$incident)
            <tr style="cursor: pointer;" onclick="{window.open('{{route('incident.show',$incident->id)}}')}">
                <td>{{$incident->id}}</td>
                <td>{{isset($incident->ticket->internal_number)?$incident->ticket->internal_number:'Por asignar...'}}</td>
                <td>{{$incident->title}}</td>
                <td>{!! $incident->signatures_list() !!}</td>
                <td>{{date('d/m/Y H:i',strtotime($incident->detection_time))}}</td>
                <td>{!! $incident->sensors_list() !!}</td>
                <td>{{isset($incident->ticket)?$incident->ticket->status->name:'Por asignar...'}}</td>
                <td>{{$incident->user->username}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@if(isset($incidents))
    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row">
            <div class="col-sm-5">
                <div aria-live="polite" role="status" id="incidents-table_info" class="dataTables_info">
                    {{($incidents->perPage()*$incidents->currentPage())-$incidents->perPage()+1}}
                    al {{$incidents->hasMorePages()?($incidents->perPage()*$incidents->currentPage()):$incidents->total()}}
                    de <b>{{$incidents->total()}} Incidentes</b>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="dataTables_paginate paging_full_numbers">
                    {!! $incidents->render() !!}
                </div>
            </div>
        </div>
    </div>
@endif