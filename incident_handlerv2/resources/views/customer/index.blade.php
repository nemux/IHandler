@extends('layout.dashboard_topmenu')

@section('title','Clientes')

@section('include_up')
@section('include_down')
    <link rel="stylesheet" href="/xenon/assets/js/datatables/dataTables.bootstrap.css" id="style-resource-1">
    <script src="/xenon/assets/js/datatables/js/jquery.dataTables.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/datatables/dataTables.bootstrap.js" id="script-resource-8"></script>
    <script src="/xenon/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js" id="script-resource-9"></script>
    <script src="/xenon/assets/js/datatables/tabletools/dataTables.tableTools.min.js" id="script-resource-10"></script>

    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $("#customers-table").dataTable({
                aoColumns: [
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
            <h3 class="panel-title">Lista de Clientes</h3>
            <br/>

            <div class="btn-group">
                <a class="btn btn-success" href="{{route('customer.create')}}">
                    <i class="fa fa-plus"></i>
                    <span class="title">Agregar Cliente</span>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="customers-table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de la empresa</th>
                    <th></th>
                </tr>
                </thead>
                <tbody class="middle-align">
                @foreach($customers as $index=>$customer)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$customer->name}}</td>
                        <td>
                            {!! Form::open(array('id'=>'deleteForm-'.$customer->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('customer.destroy', $customer->id))) !!}
                            {!! Form::hidden('id',$customer->id) !!}
                            <a href="{{route('customer.show',$customer->id)}}"
                               class="btn btn-info btn-sm btn-icon icon-left">
                                Ver perfil</a>
                            <a href="{{route('customer.edit',$customer->id)}}"
                               class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                            {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("cliente","'.$customer->id.'")' ]) !!}
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