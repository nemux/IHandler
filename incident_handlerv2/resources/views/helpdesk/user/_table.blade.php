<script type="text/javascript">
    var user_tableClassName = 'Usuarios';
    var user_datatableOptions = {
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
                    title: user_tableClassName
                }, {
                    text: 'PDF',
                    extend: 'pdfHtml5',
                    title: user_tableClassName
                }]
            }, {
                text: 'Imprimir',
                extend: 'print',
                title: user_tableClassName
            }
        ],
        language: {
            buttons: {
                pageLength: {
                    _: 'Mostrar %d ' + user_tableClassName,
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
        $("#users-table").DataTable(user_datatableOptions);
    });
</script>
<table class="table table-bordered table-striped" id="users-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre completo</th>
        <th>Tipo de Usuario</th>
        <th>Cliente</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($users as $index=>$user)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{$user->person->fullName()}}</td>
            <td>{{$user->type->description}}</td>
            <td>{{$user->customer->name}}</td>
            <td>
                {!! Form::open(array('id'=>'deleteForm-'.$user->username,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('helpdesk.user.destroy', $user->username))) !!}
                {!! Form::hidden('id',$user->id) !!}
                <a href="{{route('helpdesk.user.show',$user->username)}}"
                   class="btn btn-info btn-sm btn-icon icon-left">
                    Ver perfil</a>
                <a href="{{route('helpdesk.user.edit',$user->username)}}"
                   class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("usuario","'.$user->username.'")' ]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>