<script type="text/javascript">
    @if(isset($incidents));
    var datatableOptions = {
        dom: "<'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>>",
        columns: [
            {
                visible: false {{--Columna oculta que sirve solo para ordenar fechas--}}
            },
            {'class': 'col-md-1'},
            {
                type: 'date',
                dataSort: 0, {{--Definido como 0, por si se agregan más columnas no tenga un efecto contraproducente--}}
                'class': 'col-md-2'
            },
            {'class': 'col-md-1'},
            {'class': 'col-md-1'},
            {'class': 'col-md-4'},
            {'class': 'col-md-1'},
            {'class': 'col-md-1'},
            {'class': 'col-md-1'}
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
<table class="table table-responsive table-bordered table-striped table-model-2" id="incidents-table">
    <thead>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Fecha de Detección</th>
        <th>Severidad</th>
        <th>Ticket</th>
        <th>Título</th>
        <th>Sensores</th>
        <th>Status</th>
        <th>Handler</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @if(isset($incidents))
        @foreach($incidents as $incident)
            <tr style="cursor: pointer;" onclick="{window.open('{{route('incident.show',$incident->id)}}')}">
                <td>{{$incident->detection_time}}</td>{{--Esta columna está oculta por el DataTable, sólo sirve para poder ordenar campos por fecha--}}
                <td>{{$incident->id}}</td>
                <td>{{$incident->detection_time->format('d/m/Y H:i T')}}</td>
                <td>{{ $incident->criticity }}</td>
                <td>{{isset($incident->internal_number)?$incident->internal_number:'Por asignar...'}}</td>
                <td>{{$incident->title}}</td>
                <td>
                    @foreach($incident->sensors as $index=>$sensor)
                        {{$sensor->sensor->name}},
                    @endforeach
                </td>
                <td>{{isset($incident->status)?$incident->status:'Abierto'}}</td>
                <td>{{$incident->username}}</td>
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