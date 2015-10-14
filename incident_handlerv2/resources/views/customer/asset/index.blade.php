<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#customer-assets-table").dataTable({
            aoColumns: [
                null,
                null,
                null,
                null,
                null
            ],
        });
    });


    function showFormAsset() {
        $('#modal-form-asset').modal('show', {backdrop: 'fade'});
    }

    function submitForm() {
        $('#form-customer-asset').submit();
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Activos</h3>

        <div class="panel-options"><a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span> </a>
        </div>
    </div>
    <div class="panel-body row">
        <div class="col-md-12">
            <div class="vertical-top">
                <a onclick="showFormAsset()" class="btn btn-blue btn-icon btn-icon-standalone">
                    <i class="fa-plus"></i>
                    <span>Agregar activo</span>
                </a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped" id="customer-assets-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre de Dominio</th>
                <th>IPV4</th>
                <th>IPV6</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="middle-align">
            @foreach($customer->assets as $index=>$asset)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$asset->domain_name}}</td>
                    <td>{{$asset->ipv4}}</td>
                    <td>{{$asset->ipv6}}</td>
                    <td>
                        {!! Form::open(array('id'=>'deleteForm-'.$asset->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('asset.destroy', $asset->id))) !!}
                        {!! Form::hidden('id',$asset->id) !!}
                        <a href="{{route('asset.show',$asset->id)}}"
                           class="btn btn-info btn-sm btn-icon icon-left">
                            Ver activo</a>
                        <a href="{{route('asset.edit',$asset->id)}}"
                           class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                        {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("activo","'.$asset->id.'")' ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--Modal Form Asset--}}
<div aria-hidden="false" class="modal fade in" id="modal-form-asset">
    <div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar un activo</h4>
            </div>
            <div class="modal-body">
                {!! Form::model(new \App\Models\CustomerAsset(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-asset','url'=>route('asset.store')]) !!}
                {!! Form::hidden('customer_id',$customer->id) !!}
                @include('customer.asset._form')
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-blue" onclick="javascript:submitForm()">Guardar</button>
            </div>
        </div>
    </div>
</div>