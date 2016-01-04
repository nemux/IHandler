<script type="text/javascript">
    @if(isset($incidents));
    var datatableOptions = {
        dom: "<'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>>",
        columns: [
            null, null, null, null, null,
            {
                type: 'date',
                dataSort: 9
            }, null, null, null,
            {
                visible: false
            }
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
        <th class="col-sm-1">Severidad</th>
        <th class="col-sm-1">#Ticket</th>
        <th class="col-sm-3">Título</th>
        <th class="col-sm-2">Indicadores de Compromiso</th>
        <th class="col-sm-1">Detección</th>
        <th class="col-sm-1">Sensores</th>
        <th class="col-sm-1">Status</th>
        <th class="col-sm-1">Handler</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @if(isset($incidents))
        @foreach($incidents as $incident)
            <tr style="cursor: pointer;" onclick="{window.open('{{route('incident.show',$incident->id)}}')}">
                <td>{{$incident->id}}</td>
                <td>{{ $incident->criticity }}</td>
                <td>{{isset($incident->internal_number)?$incident->internal_number:'Por asignar...'}}</td>
                <td>{{$incident->title}}</td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($incident->signatures as $signature)
                            <li>{{$signature->signature->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{$incident->detection_time->format('d/m/Y H:i T')}}</td>
                <td>
                    <ul class="list-unstyled">
                        @foreach($incident->sensors as $sensor)
                            <li>{{$sensor->sensor->name}}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{isset($incident->status)?$incident->status:'Por asignar...'}}</td>
                <td>{{$incident->username}}</td>
                <td>{{$incident->detection_time}}</td>
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