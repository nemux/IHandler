@extends('layout.dashboard_topmenu')

@section('title','Blacklist')

@section('include_up')
@section('include_down')
    <link rel="stylesheet" href="/xenon/assets/js/datatables/dataTables.bootstrap.css" id="style-resource-1">
    <script src="/xenon/assets/js/datatables/js/jquery.dataTables.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/datatables/dataTables.bootstrap.js" id="script-resource-8"></script>
    <script src="/xenon/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js" id="script-resource-9"></script>
    <script src="/xenon/assets/js/datatables/tabletools/dataTables.tableTools.min.js" id="script-resource-10"></script>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#blacklist").dataTable({
                {{--aoColumns: [--}}
                {{--{{$base->columns}}--}}
                {{--],--}}
            });
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Blacklist</h3>
            <br/>

            {{--<div class="btn-group">--}}
            {{--<a class="btn btn-success" href="{{route($base->createRoute)}}">--}}
            {{--<i class="fa fa-plus"></i>--}}
            {{--<span class="title">Agregar {{$base->name}}</span>--}}
            {{--</a>--}}
            {{--</div>--}}
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="blacklist">
                <thead>
                <tr>
                    <th>#</th>
                    <th>IPv4</th>
                    <th>Locación</th>
                </tr>
                </thead>
                <tbody class="middle-align">
                @foreach($machines as $index=>$item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->ipv4}}</td>
                        <td>{!! $item->location !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('modal.confirm_delete')
@endsection