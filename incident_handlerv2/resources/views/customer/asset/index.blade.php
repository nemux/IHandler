<script type="text/javascript">
    var asset_tableClassName = '{{$customer->otrs_customer_id}} - Activos';
    var asset_datatableOptions = {
        dom: "<'row'<'col-sm-5'B><'col-sm-7'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                text: 'Copiar Tabla',
                extend: 'copyHtml5'
            }, {
                extend: 'collection',
                text: 'Exportar a...',
                buttons: [{
                    text: 'CSV',
                    extend: 'csvHtml5',
                    title: asset_tableClassName
                }, {
                    text: 'PDF',
                    extend: 'pdfHtml5',
                    title: asset_tableClassName
                }]
            }, {
                text: 'Imprimir',
                extend: 'print',
                title: asset_tableClassName
            }
        ],
        language: {
            buttons: {
                pageLength: {
                    _: 'Mostrar %d ' + asset_tableClassName,
                    '-1': 'Todos'
                }
            },
            infoEmpty: 'No hay registros para mostrar',
            zeroRecords: 'No hay registros para mostrar',
            info: 'Mostrando del _START_ al _END_ <b>(_TOTAL_ registros)</b>',
            search: 'Buscar: ',
            infoFiltered: ' - Filtrado de <b>_MAX_</b> registros en total'
        },
        sorting: [[0, 'asc']]
    };
    $(document).ready(function ($) {
        $("#customer-assets-table").DataTable(asset_datatableOptions);
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
            @foreach($customer->assets as $index=>$customerAsset)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$customerAsset->domain_name}}</td>
                    <td>{{$customerAsset->asset->ipv4}}</td>
                    <td>{{$customerAsset->asset->ipv6}}</td>
                    <td>
                        {!! Form::open(array('id'=>'deleteForm-'.$customerAsset->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('asset.destroy', $customerAsset->id))) !!}
                        {!! Form::hidden('id',$customerAsset->id) !!}
                        <a href="{{route('asset.show',$customerAsset->id)}}"
                           class="btn btn-info btn-sm btn-icon icon-left">
                            Ver activo</a>
                        <a href="{{route('asset.edit',$customerAsset->id)}}"
                           class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                        {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("activo","'.$customerAsset->id.'")' ]) !!}
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
                {!! Form::model(new \Models\IncidentManager\Customer\CustomerAsset(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-asset','url'=>route('asset.store')]) !!}
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