@extends('layout.dashboard_topmenu')

@section('title', 'Usuarios')

@section('include_up')
@endsection

@section('include_down')
    <link rel="stylesheet" href="/xenon/assets/js/datatables/dataTables.bootstrap.css" id="style-resource-1">
    <script src="/xenon/assets/js/datatables/js/jquery.dataTables.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/datatables/dataTables.bootstrap.js" id="script-resource-8"></script>
    <script src="/xenon/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js" id="script-resource-9"></script>
    <script src="/xenon/assets/js/datatables/tabletools/dataTables.tableTools.min.js" id="script-resource-10"></script>

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
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Lista de Usuarios</h3><br/>

            <div class="btn-group">
                <a class="btn btn-success" href="{{route('user.create')}}">
                    <i class="fa fa-plus"></i>
                    <span class="title">Agregar Usuario</span>
                </a>
            </div>
        </div>
        <div class="panel-body">
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
        </div>
    </div>
@endsection

@include('modal.confirm_delete')