<script type="text/javascript">
    var datatableOptions = {
        dom: "<'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>>",
        columns: [
            null, null, null, null,
            {
                type: 'date',
                dataSort: 6
            }, null,
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
                    _: 'Mostrar %d Casos',
                    '-1': 'Todos'
                }
            },
            infoEmpty: 'No hay Casos para mostrar',
            zeroRecords: 'No hay Casos para mostrar',
        },
        searching: false,
        sorting: [[0, 'desc']]
    };

    $(document).ready(function () {
        $("#surveillance-table").DataTable(datatableOptions);
    });
</script>
<table class="table table-bordered table-striped" id="surveillance-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Cliente</th>
        <th>Criticidad</th>
        <th>Fecha de Creación</th>
        <th>Handler</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($cases as $case)
        <tr style="cursor: pointer;" onclick="{window.open('{{route('surveillance.show',$case->id)}}')}">
            <td class="col-sm-1">{{$case->id}}</td>
            <td class="col-sm-5">{{$case->title}}</td>
            <td class="col-sm-3">{{$case->customer->name}}</td>
            <td class="col-sm-1">{{$case->criticity->name}}</td>
            <td class="col-sm-1">{{$case->created_at->format('d/M/Y H:i T')}}</td>
            <td class="col-sm-1">{{$case->user->username}}</td>
            <td>{{$case->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    <div class="row">
        <div class="col-sm-5">
            <div aria-live="polite" role="status" id="incidents-table_info" class="dataTables_info">
                {{($cases->perPage()*$cases->currentPage())-$cases->perPage()+1}}
                al {{$cases->hasMorePages()?($cases->perPage()*$cases->currentPage()):$cases->total()}}
                de <b>{{$cases->total()}} Casos</b>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="dataTables_paginate paging_full_numbers">
                {!! $cases->render() !!}
            </div>
        </div>
    </div>
</div>