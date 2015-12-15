@extends('layout.dashboard_topmenu')

@section('title','Firmas de Detección')


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
        var signature_tableClassName = 'Firmas';
        var signature_datatableOptions = {
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
                        title: signature_tableClassName
                    }, {
                        text: 'PDF',
                        extend: 'pdfHtml5',
                        title: signature_tableClassName
                    }]
                }, {
                    text: 'Imprimir',
                    extend: 'print',
                    title: signature_tableClassName
                }
            ],
            language: {
                buttons: {
                    pageLength: {
                        _: 'Mostrar %d ' + signature_tableClassName,
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
            $('#signatures-table').DataTable(signature_datatableOptions);
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Lista de Firmas</h3>
            <br/>
            @if(Auth::user()->isAdmin() || Auth::user()->hasRole('user_1'))
                <div class="btn-group">
                    <a class="btn btn-success" href="{{route('signature.create')}}">
                        <i class="fa fa-plus"></i>
                        <span class="title">Agregar Firma</span>
                    </a>
                </div>
            @endif
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="signatures-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Firma</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="middle-align">
                @foreach($signatures as $index=>$item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @if(Auth::user()->isAdmin())
                                {!! Form::open(array('id'=>'deleteForm-'.$item->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('signature.destroy', $item->id))) !!}
                                {!! Form::hidden('id',$item->id) !!}
                                <a href="{{route('signature.show',$item->id)}}"
                                   class="btn btn-info btn-sm btn-icon icon-left">
                                    Detalles</a>
                                <a href="{{route('signature.edit',$item->id)}}"
                                   class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                                {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("firma","'.$item->id.'")' ]) !!}
                                {!! Form::close() !!}
                            @elseif(Auth::user()->hasRole('user_1'))
                                <a href="{{route('signature.show',$item->id)}}"
                                   class="btn btn-info btn-sm btn-icon icon-left">
                                    Detalles</a>
                                <a href="{{route('signature.edit',$item->id)}}"
                                   class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                            @else
                                <a href="{{route('signature.show',$item->id)}}"
                                   class="btn btn-info btn-sm btn-icon icon-left">
                                    Detalles</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('modal.confirm_delete')
@endsection