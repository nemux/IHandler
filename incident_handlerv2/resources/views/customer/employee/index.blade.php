<script type="text/javascript">
    var empl_tableClassName = '{{$customer->name}} - Empleados';
    var empl_datatableOptions = {
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
                    title: empl_tableClassName
                }, {
                    text: 'PDF',
                    extend: 'pdfHtml5',
                    title: empl_tableClassName
                }]
            }, {
                text: 'Imprimir',
                extend: 'print',
                title: empl_tableClassName
            }
        ],
        language: {
            buttons: {
                pageLength: {
                    _: 'Mostrar %d ' + empl_tableClassName,
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
        $("#customer-employees-table").DataTable(empl_datatableOptions);
    });
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Empleados</h3>

        <div class="panel-options"><a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span> </a>
        </div>
    </div>
    <div class="panel-body row">
        <div class="col-md-12">
            <div class="vertical-top">
                <a href="{{route('employee.create',$customer->id)}}" class="btn btn-blue btn-icon btn-icon-standalone">
                    <i class="fa-plus"></i>
                    <span>Agregar empleado</span>
                </a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped" id="customer-employees-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre Completo</th>
                <th>Correo Corporativo</th>
                <th>Teléfono Corporativo</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="middle-align">
            @foreach($customer->employees as $index=>$employee)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$employee->person->fullName()}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>
                        {!! Form::open(array('id'=>'deleteForm-'.$employee->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('employee.destroy', $employee->id))) !!}
                        {!! Form::hidden('id',$employee->id) !!}
                        <a href="{{route('employee.show',$employee->id)}}"
                           class="btn btn-info btn-sm btn-icon icon-left">
                            Ver empleado</a>
                        <a href="{{route('employee.edit',$employee->id)}}"
                           class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                        {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("empleado","'.$employee->id.'")' ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>