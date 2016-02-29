<script type="text/javascript">
    var datatableOptions = {
        dom: "<'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>>",
        columns: [
            {
                visible: false
            },
            {
                'class': 'col-sm-1'
            },
            {
                type: 'datetime',
                dataSort: 0,
                'class': 'col-sm-2'
            },
            {
                'class': 'col-sm-1'
            },
            {
                'class': 'col-sm-4'
            },
            {
                'class': 'col-sm-3'
            },
            {
                'class': 'col-sm-1'
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
<table class="table table-bordered table-striped table-model-2" id="surveillance-table">
    <thead>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Fecha de Reporte</th>
        <th>Severidad</th>
        <th>Título</th>
        <th>Cliente</th>
        <th>Handler</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($cases as $case)
        <tr style="cursor: pointer;" onclick="{window.open('{{route('surveillance.show',$case->id)}}')}">
            <td>{{$case->created_at}}</td>
            <td>{{$case->id}}</td>
            <td>{{$case->created_at->format('d/m/Y H:i T')}}</td>
            <td>{{$case->criticity->name}}</td>
            <td>{{$case->title}}</td>
            <td>{{$case->customer->name}}</td>
            <td>{{$case->user->username}}</td>
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