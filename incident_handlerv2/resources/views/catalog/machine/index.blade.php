@extends('layout.dashboard_topmenu')

@section('title','Blacklist')


@section('include_up')
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/DataTables-1.10.10/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Buttons-1.1.0/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/custom/assets/js/DataTables/Responsive-2.0.0/css/responsive.bootstrap.min.css"/>
@endsection

@section('include_down')
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
        var blacklist_tableClassName = 'Blacklist';
        var blacklist_datatableOptions = {
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
                        title: blacklist_tableClassName
                    }]
                }, {
                    text: 'Imprimir',
                    extend: 'print',
                    title: blacklist_tableClassName
                }
            ],
            language: {
                buttons: {
                    pageLength: {
                        _: 'Mostrar %d ' + blacklist_tableClassName,
                        '-1': 'Todos'
                    }
                },
                infoEmpty: 'No hay registros para mostrar',
                zeroRecords: 'No hay registros para mostrar',
                info: 'Mostrando del _START_ al _END_ <b>(_TOTAL_ registros)</b>',
                search: 'Buscar: ',
                infoFiltered: ' - Filtrado de <b>_MAX_</b> registros en total'
            },
            sorting: [[0, 'asc']]
        };

        $(document).ready(function ($) {
            $("#blacklist").DataTable(blacklist_datatableOptions);
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Blacklist</h3>
            <br/>

            {{--<div class="btn-group">--}}
            {{--<a class="btn btn-success" href="{{route($base->createRoute)}}">--}}
            {{--<i class="fa fa-plus"></i>--}}
            {{--<span class="title">Agregar {{$base->name}}</span>--}}
            {{--</a>--}}
            {{--</div>--}}
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="blacklist">
                <thead>
                <tr>
                    <th>#</th>
                    <th>IPv4</th>
                    <th>Locación</th>
                </tr>
                </thead>
                <tbody class="middle-align">
                @foreach($machines as $index=>$item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->ipv4}}</td>
                        <td>{!! $item->location !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('modal.confirm_delete')
@endsection