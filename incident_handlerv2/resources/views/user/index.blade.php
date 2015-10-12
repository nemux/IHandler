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
                dom: "t" + "<'row'<'col-xs-6'i><'col-xs-6'p>>",
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
        <div class="panel-heading"><h3 class="panel-title">Lista de Usuarios</h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
                {{--<a href="#" data-toggle="remove">&times;</a>--}}
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
                            {!! Form::open() !!}
                            {!! Form::hidden('id',$user->id) !!}
                            <a href="{{route('user.show',$user->username)}}"
                               class="btn btn-info btn-sm btn-icon icon-left">
                                Ver perfil</a>
                            <a href="{{route('user.edit',$user->username)}}"
                               class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                            {!! Form::submit('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection