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

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#surveillance-table").dataTable({
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
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="surveillance-table">
                <thead>
                <tr>
                    <th># Caso</th>
                    <th>Título</th>
                    <th>Cliente</th>
                    <th>Criticidad</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="middle-align">
                @foreach($cases as $index=>$case)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$case->title}}</td>
                        <td>{{$case->customer->name}}</td>
                        <td>{{$case->criticity->name}}</td>
                        <td>
                            <a href="{{route('surveillance.show',$case->id)}}"
                               class="btn btn-info btn-sm btn-icon icon-left">
                                Ver caso</a>
                            <a href="{{route('surveillance.edit',$case->id)}}"
                               class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection