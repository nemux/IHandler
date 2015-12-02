@extends('layout.dashboard_topmenu')

@section('title','Clientes')

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
        var customer_tableClassName = 'Clientes';
        var customer_datatableOptions = {
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
                        title: customer_tableClassName
                    }, {
                        text: 'PDF',
                        extend: 'pdfHtml5',
                        title: customer_tableClassName
                    }]
                }, {
                    text: 'Imprimir',
                    extend: 'print',
                    title: customer_tableClassName
                }
            ],
            language: {
                buttons: {
                    pageLength: {
                        _: 'Mostrar %d ' + customer_tableClassName,
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
            $("#customers-table").DataTable(customer_datatableOptions);
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Lista de Clientes</h3>
            <br/>

            <div class="btn-group">
                <a class="btn btn-success" href="{{route('customer.create')}}">
                    <i class="fa fa-plus"></i>
                    <span class="title">Agregar Cliente</span>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="customers-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de la empresa</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="middle-align">
                @foreach($customers as $index=>$customer)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$customer->name}}</td>
                        <td>
                            {!! Form::open(array('id'=>'deleteForm-'.$customer->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('customer.destroy', $customer->id))) !!}
                            {!! Form::hidden('id',$customer->id) !!}
                            <a href="{{route('customer.show',$customer->id)}}"
                               class="btn btn-info btn-sm btn-icon icon-left">
                                Ver perfil</a>
                            <a href="{{route('customer.edit',$customer->id)}}"
                               class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                            {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("cliente","'.$customer->id.'")' ]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('modal.confirm_delete')
@endsection