<script type="text/javascript">
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

    $(document).ready(function ($) {
        $("#incidents-table").DataTable(datatableOptions);
    });
</script>
<table class="table table-bordered table-striped" id="incidents-table">
    <thead>
    <tr>
        <th>ID</th>
        <th># Ticket</th>
        <th>Título</th>
        <th>Indicadores</th>
        <th>Detección</th>
        <th>Sensores</th>
        <th>Status</th>
        <th>Handler</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($incidents as $index=>$incident)
        <tr style="cursor: pointer;" onclick="{window.open('{{route('incident.show',$incident->id)}}')}">
            <td class="col-sm-1">{{$incident->id}}</td>
            <td class="col-sm-1">{{isset($incident->ticket->internal_number)?$incident->ticket->internal_number:'Por asignar...'}}</td>
            <td class="col-sm-3">{{$incident->title}}</td>
            <td class="col-sm-3">{!! $incident->signatures_list() !!}</td>
            <td class="col-sm-1">{{date('d/m/Y H:i',strtotime($incident->detection_time))}}</td>
            <td class="col-sm-1">{!! $incident->sensors_list() !!}</td>
            <td class="col-sm-1">{{isset($incident->ticket)?$incident->ticket->status->name:'Por asignar...'}}</td>
            <td class="col-sm-1">{{$incident->user->username}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
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