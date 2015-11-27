@extends('layout.dashboard_topmenu')

@section('title',$base->title)

@section('include_up')
@section('include_down')
    <link rel="stylesheet" href="/xenon/assets/js/datatables/dataTables.bootstrap.css" id="style-resource-1">
    <script src="/xenon/assets/js/datatables/js/jquery.dataTables.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/datatables/dataTables.bootstrap.js" id="script-resource-8"></script>
    <script src="/xenon/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js" id="script-resource-9"></script>
    <script src="/xenon/assets/js/datatables/tabletools/dataTables.tableTools.min.js" id="script-resource-10"></script>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $({!!'"#'.$base->idTable.'"'!!}).dataTable({
                aoColumns: [
                    {{$base->columns}}
                ],
            });
        });
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Lista de {{$base->name}}</h3>
            <br/>

            <div class="btn-group">
                <a class="btn btn-success" href="{{route($base->createRoute)}}">
                    <i class="fa fa-plus"></i>
                    <span class="title">Agregar {{$base->name}}</span>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="{{$base->idTable}}">
                <thead>
                <tr>
                    {!! $base->tableHeader !!}
                </tr>
                </thead>
                <tbody class="middle-align">
                @foreach($items as $index=>$item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            {!! Form::open(array('id'=>'deleteForm-'.$item->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array($base->deleteRoute, $item->id))) !!}
                            {!! Form::hidden('id',$item->id) !!}
                            <a href="{{route($base->showRoute,$item->id)}}"
                               class="btn btn-info btn-sm btn-icon icon-left">
                                Detalles</a>
                            <a href="{{route($base->editRoute,$item->id)}}"
                               class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                            {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("'.$base->name.'","'.$item->id.'")' ]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('modal.confirm_delete')
@endsection