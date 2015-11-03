<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#customer_id").select2({
            placeholder: 'Cliente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#criticity_id").select2({
            placeholder: 'Criticidad del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#flow_id").select2({
            placeholder: 'Flujo del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#category_id").select2({
            placeholder: 'Categoría(s) del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#impact").select2({
            placeholder: 'Impacto del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#risk").select2({
            placeholder: 'Riesgo del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#attack_type_id").select2({
            placeholder: 'Tipo de Ataque...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#sensor_id").select2({
            placeholder: 'Sensor(es) donde se detectó el incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#signature").select2({
            placeholder: 'Firma(s) del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var descriptionField = CKEDITOR.replace('description');
        var recommendationField = CKEDITOR.replace('recommendation');
        var referenceField = CKEDITOR.replace('reference');
    });

    /**
     * Updates Sensor List when Customer selected
     */
    $(document).ready(function () {
        $('#customer_id').change(function () {
            var customer_id = $(this).find('option:selected').attr('value');
            $.ajax({
                url: '/dashboard/ws/sensors/' + customer_id,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (result) {
                    $("#sensor_id").select2("val", "");
                    $('#sensor_id').empty();

                    if (result.status === true) {
                        $('#sensor_id').append($('<option>', {}));
                        $.each(result.sensors, function (i, item) {
                            $('#sensor_id').append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                    }
                },
                failed: function (result) {
                    console.log(result);
                }
            });

        });

        var count_event = 0;
        $('#add-event-btn').on('click', function () {
            var src = $('<h1>').text('Evento ' + (count_event + 1)).appendTo('#events');

            var src = $('<div>').attr({id: 'src_' + count_event, class: 'row form-group'}).appendTo('#events');
            var src_label = $('<label>').text('Origen').attr({class: 'col-md-1 control-label'}).appendTo(src);
            var src_ip = makeTextInput('src_ip_', 'IPV4', src, 1, 'required');//1
            var src_location = makeSelectLocation('src_location_', 'Selecciona un País', src, 2);//3
            var src_type = makeSelectType('src_type_', 'Selecciona el tipo', src, 2, 'required');//2
            var src_blacklist = makeCheck('src_blacklist_', 'Blacklist', src, 1);//1
            var tar_show = makeCheck('src_show_', 'No mostrar', src, 1);//1
            var src_port = makeTextInput('src_port_', 'Puerto', src, 1, 'required');//1
            var src_protocol = makeTextInput('src_protocol_', 'Protocolo', src, 1, 'required');//1
            var src_os = makeTextInput('src_os_', 'Sistema Operativo', src, 1);//1
            var src_mac = makeTextInput('src_mac_', 'MAC', src, 1);//1

            var tar = $('<div>').attr({id: 'tar_' + count_event, class: 'row form-group'}).appendTo('#events');
            var tar_label = $('<label>').text('Destino').attr({class: 'col-md-1 control-label'}).appendTo(tar);
            var tar_ip = makeTextInput('tar_ip_', 'IPV4', tar, 1, 'required');
            var tar_location = makeSelectLocation('tar_location_', 'Selecciona un País', tar, 2);
            var tar_type = makeSelectType('tar_type_', 'Selecciona el tipo', tar, 2, 'required');
            var tar_blacklist = makeCheck('tar_blacklist_', 'Blacklist', tar, 1);
            var tar_show = makeCheck('src_show_', 'No mostrar', tar, 1);
            var tar_port = makeTextInput('tar_port_', 'Puerto', tar, 1, 'required');
            var tar_protocol = makeTextInput('tar_protocol_', 'Protocolo', tar, 1, 'required');
            var tar_os = makeTextInput('tar_os_', 'Sistema Operativo', tar, 1);
            var tar_mac = makeTextInput('tar_mac_', 'MAC', tar, 1);

            var tar = $('<hr>').appendTo('#events');

            count_event++;
        });

        function makeCheck(name, placeholder, appendTo, colWidth, data_validate) {
            var div = $('<div>').attr({class: 'col-md-' + colWidth}).appendTo(appendTo);

            var label = $('<label>').appendTo(div);

            label.text(placeholder);

            var checkbox = $('<input>').attr({
                type: 'checkbox',
                name: name + count_event,
                id: name + count_event
            }).appendTo(div);

            return div;

        }

        function makeTextInput(name, placeholder, appendTo, colWidth, data_validate) {
            var div = $('<div>').attr({class: 'col-md-' + colWidth}).appendTo(appendTo);

            var input = $('<input>').attr({
                id: name + count_event,
                name: name + count_event,
                placeholder: placeholder,
                class: 'form-control',
                'data-validate': data_validate,
                required: data_validate

            }).appendTo(div);
            return div;
        }

        function makeSelectType(name, placeHolder, appendTo, colWidth, data_validate) {
            var div = $('<div>').attr({class: 'col-md-' + colWidth}).appendTo(appendTo);

            var select = $('<select>').attr({
                id: name + count_event,
                name: name + count_event,
                class: 'form-control',
                'data-validate': data_validate,
                required: data_validate
            }).appendTo(div);

            $(select).append(new Option());

            @foreach(\App\Models\Incident\MachineType::all(['name','id']) as $type)
                $(select).append(new Option('{{$type->name}}', '{{$type->id}}'));
            @endforeach

            $(select).select2({
                        placeholder: placeHolder,
                        allowClear: true,
                        dropdownAutoWidth: true
                    }).on('select2-open', function () {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                    });


            return select;
        }

        function makeSelectLocation(name, placeHolder, appendTo, colWidth) {
            var div = $('<div>').attr({class: 'col-md-' + colWidth}).appendTo(appendTo);

            var select = $('<select>').attr({
                id: name + count_event,
                name: name + count_event,
                class: 'form-control'
            }).appendTo(div);

            $(select).append(new Option());

            @foreach(\App\Models\Catalog\Location::orderBy('name','asc')->get(['name','id']) as $type)
                $(select).append(new Option('{!! $type->name !!}', '{{$type->id}}'));
            @endforeach

            $(select).select2({
                        placeholder: placeHolder,
                        allowClear: true,
                        dropdownAutoWidth: true
                    }).on('select2-open', function () {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                    });

            return select;
        }
    })
    ;
</script>
<ul class="tabs">
    <li class="active"><a href="#incident-basic-tab" data-toggle="tab">Datos básicos</a></li>
    <li class=""><a href="#incident-events-tab" data-toggle="tab">Firmas y Eventos</a></li>
    <li class=""><a href="#incident-description-tab" data-toggle="tab">Descripción y Recomendaciones</a></li>
    <li><a href="#incident-evidences-tab" data-toggle="tab">Evidencias</a></li>
    <li><a href="#incident-resume-tab" data-toggle="tab">Resúmen del Caso</a></li>
</ul>
<div class="progress-indicator">
    <span></span>
</div>
<div class="tab-content">
    <div class="tab-pane active" id="incident-basic-tab">
        {{--Título--}}
        <div class="form-group">
            <label class="control-label">Título</label>
            {!! Form::text('title',null,['class'=>'form-control','id'=>'title','data-validate'=>'required,maxlength[255]']) !!}
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label">Categoría(s)</label>
                <select class="form-control" id="category_id" name="category_id[]" multiple data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackCategory::all(['name','id']) as $item)
                        <option {{(isset($case) && $case->attack_category->id==$item->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Fecha en que Ocurrió el Incidente</label>

                <div class="date-and-time">
                    <input data-validate="required" name="occurrence_date" id="occurrence_date" type="text"
                           class="form-control datepicker"
                           data-format="dd/mm/yyyy"
                           data-end-date="{{date('d/m/Y')}}" value="{{date('d/m/Y')}}">
                    <input data-validate="required" name="occurrence_time" id="occurrence_time" type="text"
                           class="form-control timepicker"
                           data-template="dropdown"
                           data-default-time="{{date('H:i')}}" data-show-meridian="false" data-minute-step="5"/>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Fecha en que se Detectó el Incidente</label>

                <div class="date-and-time">
                    <input data-validate="required" name="detection_date" id="detection_date" type="text"
                           class="form-control datepicker"
                           data-format="dd/mm/yyyy"
                           data-end-date="{{date('d/m/Y')}}" value="{{date('d/m/Y')}}">
                    <input data-validate="required" name="detection_time" id="detection_time" type="text"
                           class="form-control timepicker"
                           data-template="dropdown"
                           data-default-time="{{date('H:i')}}" data-show-meridian="false" data-minute-step="5"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 form-group">
                <label class="control-label">Flujo del Ataque</label>
                <select id="flow_id" class="form-control" name="flow_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackFlow::all(['name','id']) as $index=>$item)
                        <option {{(isset($case) && $item->id==$case->attack_flow->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label class="control-label">Tipo de Ataque</label>
                <select id="attack_type_id" class="form-control" name="attack_type_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackType::all(['name','id']) as $index=>$item)
                        <option {{(isset($case) && $case->attack_type->id==$item->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label class="control-label">Criticidad del Ataque</label>
                <select id="criticity_id" class="form-control" name="criticity_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\Criticity::all(['name','id']) as $index=>$criticity)
                        <option {{(isset($case) && $criticity->id==$case->criticity->id)?'selected':''}} value="{{$criticity->id}}">{{$criticity->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="control-label">Impacto del Ataque</label>
                <select id="impact" class="form-control" name="impact" data-validate="required">
                    <option></option>
                    @for($i=0;$i<=10;$i++)
                        <option {{(isset($case) && $i==$case->impact)?'selected':''}} value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="control-label">Riesgo del Ataque</label>
                <select id="risk" class="form-control" name="risk" data-validate="required">
                    <option></option>
                    @for($i=1;$i<=10;$i++)
                        <option {{(isset($case) && $i==$case->risk)?'selected':''}} value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row">
            {{--Cliente--}}
            <div class="form-group col-md-6">
                <label class="control-label">Cliente</label>
                <select class="form-control" id="customer_id" name="customer_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Customer\Customer::all(['name','id']) as $index=>$customer)
                        <option {{(isset($case) && $customer->id==$case->customer->id)?'selected':''}} value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
            {{--Sensores--}}
            <div class="form-group col-md-6">
                <label class="control-label">Sensor(es)</label>
                <select class="form-control" id="sensor_id" name="sensor_id[]" multiple="multiple"
                        data-validate="required">
                    <option></option>
                </select>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="incident-events-tab">
        {{--Firmas--}}
        <div class="form-group">
            <label class="control-label">Firma(s)</label>
            <select class="form-control" id="signature" name="signature[]" multiple="multiple" data-validate="required">
                <option></option>
                @foreach(\App\Models\Catalog\AttackSignature::all(['name','id']) as $index=>$item)
                    <option {{(isset($case) && $item->id==$case->attack_signature->id)?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-md-2">
                <span class="btn btn-blue" id="add-event-btn">Agregar Evento al Incidente</span>
            </div>
            <div class="col-md-10"><span class="h1">Eventos del Incidente</span></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="events">
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="incident-description-tab">
        <div class="form-group">
            <h3 class="control-label">Descripción del Incidente</h3>
           <textarea class="form-control ckeditor" name="description" id="description" data-validate="required">
               {{isset($case->description)?$case->description:''}}
           </textarea>
        </div>
        <div class="form-group">
            <h3 class="control-label">Recomendaciones</h3>
           <textarea class="form-control ckeditor" name="recommendation" id="recommendation" data-validate="required">
               {{isset($case->recommendation)?$case->recommendation:''}}
           </textarea>
        </div>
        <div class="form-group">
            <h3 class="control-label">Referencias</h3>
           <textarea class="form-control ckeditor" name="reference" id="reference" data-validate="required">
               {{isset($case->reference)?$case->reference:''}}
           </textarea>
        </div>
    </div>
    <div class="tab-pane" id="incident-evidences-tab">
        <h3 class="title">Evidencias</h3>
        @include('file._form',['file_list'=>'incident-form'])
    </div>
    <div class="tab-pane" id="incident-resume-tab">
        {!! Form::submit('Guardar Incidente',['class'=>'btn btn-lg btn-blue']) !!}
    </div>
    <ul class="pager wizard">
        <li class="previous first"><a href="#">Primero</a></li>
        <li class="previous"><a href="#"><i class="entypo-left-open"></i> Anterior</a></li>
        <li class="next last"><a href="#">Último</a></li>
        <li class="next"><a href="#">Siguiente <i class="entypo-right-open"></i></a></li>
    </ul>
</div>{{--Valida si los campos de evidencias fueron pasados como un valor de sesión cuando ha ocurrido un error--}}
@if (\Session::has('incident_evidences'))
    @foreach(session('incident_evidences') as $evidence)
        @include('file._evidence_hidden',['evidence'=>$evidence])
    @endforeach
@endif