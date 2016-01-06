<script type="text/javascript">
    var sensor_tableClassName = '{{$customer->otrs_customer_id}} - Sensores';
    var sensor_datatableOptions = {
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
                    title: sensor_tableClassName
                }, {
                    text: 'PDF',
                    extend: 'pdfHtml5',
                    title: sensor_tableClassName
                }]
            }, {
                text: 'Imprimir',
                extend: 'print',
                title: sensor_tableClassName
            }
        ],
        language: {
            buttons: {
                pageLength: {
                    _: 'Mostrar %d ' + sensor_tableClassName,
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
        $("#customer-sensors-table").DataTable(sensor_datatableOptions);
    });


    function showFormSensor() {
        $('#modal-form-sensor').modal('show', {backdrop: 'fade'});
    }

    function submitSensorForm() {
        $('#form-customer-sensor').submit();
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Lista de Sensores</h3>

        <div class="panel-options"><a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span> </a>
        </div>
    </div>
    @if(Auth::user()->isAdmin())
        <div class="panel-body row">
            <div class="col-md-12">
                <div class="vertical-top">
                    <a onclick="showFormSensor()" class="btn btn-blue btn-icon btn-icon-standalone">
                        <i class="fa-plus"></i>
                        <span>Agregar sensor</span>
                    </a>
                </div>
            </div>
        </div>
    @endif
    <div class="panel-body">
        <table class="table table-bordered table-striped" id="customer-sensors-table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre de Sensor</th>
                <th>IPV4</th>
                <th>Punto de Montaje</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="middle-align">
            @foreach($customer->sensors as $index=>$sensor)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$sensor->name}}</td>
                    <td>{{$sensor->ipv4}}</td>
                    <td>{{$sensor->mount_point}}</td>
                    <td>
                        @if(Auth::user()->isAdmin())
                            {!! Form::open(array('id'=>'deleteForm-'.$sensor->id,'class' => 'form-inline', 'method' => 'DELETE', 'route' => array('sensor.destroy', $sensor->id))) !!}
                            {!! Form::hidden('id',$sensor->id) !!}
                            <a href="{{route('sensor.show',$sensor->id)}}"
                               class="btn btn-info btn-sm btn-icon icon-left">
                                Ver sensor</a>
                            <a href="{{route('sensor.edit',$sensor->id)}}"
                               class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                            {!! Form::button('Eliminar',['class'=>'btn btn-danger btn-sm btn-icon icon-left','onClick'=> 'onClickDelete("sensor","'.$sensor->id.'")' ]) !!}
                            {!! Form::close() !!}
                        @else
                            <a href="{{route('sensor.show',$sensor->id)}}"
                               class="btn btn-info btn-sm btn-icon icon-left">
                                Ver sensor</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--Modal Form Sensor--}}
<div aria-hidden="false" class="modal fade in" id="modal-form-sensor">
    <div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar un sensor</h4>
            </div>
            <div class="modal-body">
                {!! Form::model(new \Models\IncidentManager\Customer\CustomerSensor(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-sensor','url'=>route('sensor.store')]) !!}
                {!! Form::hidden('customer_id',$customer->id) !!}
                @include('customer.sensor._form')
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-blue" onclick="javascript:submitSensorForm()">Guardar</button>
            </div>
        </div>
    </div>
</div>