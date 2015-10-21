@extends('layout.dashboard_topmenu')

@section('title', 'Casos de Cibervigilancia')

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
            <h3 class="panel-title">Casos de Cibervigilancia</h3>

            <div class="panel-options"><a href="#" data-toggle="panel">
                    <span class="collapse-icon">&ndash;</span>
                    <span class="expand-icon">+</span> </a>
            </div>
        </div>
        @include('surveillance._table',['cases'=>$cases])
    </div>
@endsection