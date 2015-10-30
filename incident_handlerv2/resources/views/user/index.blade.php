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
            @include('user._table')
        </div>
    </div>

    @include('modal.confirm_delete')
@endsection