@extends('layout.dashboard_topmenu')

@section('title', 'Casos de Cibervigilancia')

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
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Casos de Cibervigilancia</h3>
        </div>
        <div class="panel-body">
            @include('surveillance._table',['cases'=>$cases])
        </div>
    </div>
@endsection