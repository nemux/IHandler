<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#customer-employees-table").dataTable({
            aoColumns: [
                null,
                null,
                null,
                null,
                null
            ],
        });
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
                            Ver activo</a>
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