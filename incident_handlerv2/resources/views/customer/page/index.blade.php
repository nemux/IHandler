<script type="text/javascript">
    var page_tableClassName = '{{$customer->otrs_customer_id}} - Páginas';
    var page_datatableOptions = {
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
                    title: page_tableClassName
                }, {
                    text: 'PDF',
                    extend: 'pdfHtml5',
                    title: page_tableClassName
                }]
            }, {
                text: 'Imprimir',
                extend: 'print',
                title: page_tableClassName
            }
        ],
        language: {
            buttons: {
                pageLength: {
                    _: 'Mostrar %d ' + page_tableClassName,
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
        $("#customer-pages-table").DataTable(page_datatableOptions);
    });

    function showFormPage() {
        $('#modal-form-page').modal('show', {backdrop: 'fade'});
    }

    function submitFormPage() {
        $('#form-customer-page').submit();
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Páginas</h3>

        <div class="panel-options"><a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span> </a>
        </div>
    </div>
    <div class="panel-body row">
        <div class="col-md-12">
            <div class="vertical-top">
                <a onclick="showFormPage()" class="btn btn-blue btn-icon btn-icon-standalone">
                    <i class="fa-plus"></i>
                    <span>Agregar página</span>
                </a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped" id="customer-pages-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Tipo</th>
                <th>Enlace</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="middle-align">
            @foreach($customer->pages as $index => $page)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$page->link->title}}</td>
                    <td>{{$page->link->type->name}}</td>
                    <td><a href="{{$page->link->link}}" target="_blank">{{$page->link->link}}</a></td>
                    <td>
                        {!! Form::open(array('id'=>'deleteForm-'.$page->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('customer.page.destroy', $page->id))) !!}
                        {!! Form::hidden('id',$page->id) !!}
                        <a href="{{route('customer.page.show',$page->id)}}"
                           class="btn btn-info btn-sm btn-icon icon-left">
                            Ver página</a>
                        <a href="{{route('customer.page.edit',$page->id)}}"
                           class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                        {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("página","'.$page->id.'")' ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--Modal Form Asset--}}
<div aria-hidden="false" class="modal fade in" id="modal-form-page">
    <div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar una página</h4>
            </div>
            <div class="modal-body">
                {!! Form::model(new \App\Models\Customer\CustomerPage(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-page','url'=>route('customer.page.store')]) !!}
                {!! Form::hidden('customer_id',$customer->id) !!}
                @include('link._form')
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-blue" onclick="javascript:submitFormPage()">Guardar</button>
            </div>
        </div>
    </div>
</div>