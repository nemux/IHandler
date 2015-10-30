<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#users-table").dataTable({
            aoColumns: [
                null,
                null,
                null,
                null
            ],
        });
    });
</script>
<table class="table table-bordered table-striped" id="users-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre completo</th>
        <th>Tipo de Usuario</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($users as $index=>$user)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{$user->person->fullName()}}</td>
            <td>{{$user->type->description}}</td>
            <td>
                {!! Form::open(array('id'=>'deleteForm-'.$user->username,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('user.destroy', $user->username))) !!}
                {!! Form::hidden('id',$user->id) !!}
                <a href="{{route('user.show',$user->username)}}"
                   class="btn btn-info btn-sm btn-icon icon-left">
                    Ver perfil</a>
                <a href="{{route('user.edit',$user->username)}}"
                   class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("usuario","'.$user->username.'")' ]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>