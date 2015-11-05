<script type="text/javascript">
    var countNewEvents = 0;
    var countGeneralEvents = 0;

    function addEvent(isNew, id, source, target) {
        //Obtenemos los valores de origen del formulario
        var srcValidation = {status: false};
        var tarValidation = {status: false};
        if (isNew) {
            var src = {
                id: null,
                protocol: $('#evt-src-protocol').val(),
                ipv4: $('#evt-src-ipv4').val(),
                port: $('#evt-src-port').val(),
                os: $('#evt-src-os').val(),
                mac: $('#evt-src-mac').val(),
                location: $('#evt-src-location option:selected').val(),
                type: $('#evt-src-type option:selected').val(),
                blacklist: $('#evt-src-blacklist').is(":checked"),
                hide: $('#evt-src-hide').is(":checked")
            };

            //Obtenemos los valores de destino del formulario
            var tar = {
                id: null,
                protocol: $('#evt-tar-protocol').val(),
                ipv4: $('#evt-tar-ipv4').val(),
                port: $('#evt-tar-port').val(),
                os: $('#evt-tar-os').val(),
                mac: $('#evt-tar-mac').val(),
                location: $('#evt-tar-location option:selected').val(),
                type: $('#evt-tar-type option:selected').val(),
                blacklist: $('#evt-tar-blacklist').is(":checked"),
                hide: $('#evt-tar-hide').is(":checked")
            };

            //Validamos las entradas de origen
            srcValidation = validateEvent(src);
            if (!srcValidation.status) {
                alert('El campo ' + srcValidation.field + ' es obligatorio.');
                return;
            }

            //Validamos las entradas de destino
            tarValidation = validateEvent(tar);
            if (!tarValidation.status) {
                alert('El campo ' + tarValidation.field + ' es obligatorio.');
                return;
            }
        } else {
            //Obtenemos los valores de origen del objeto json
            var json_source = source;
            var src = {
                id: json_source.id,
                protocol: json_source.protocol,
                ipv4: json_source.ipv4,
                port: json_source.port,
                os: json_source.os,
                mac: json_source.mac,
                location: json_source.location_id,
                type: json_source.machine_type_id,
                blacklist: json_source.blacklist,
                hide: json_source.hide

            };

            //Obtenemos los valores de destino del objeto json
            var json_target = target;
            var tar = {
                id: json_target.id,
                protocol: json_target.protocol,
                ipv4: json_target.ipv4,
                port: json_target.port,
                os: json_target.os,
                mac: json_target.mac,
                location: json_target.location_id,
                type: json_target.machine_type_id,
                blacklist: json_target.blacklist,
                hide: json_target.hide
            };
        }

        //Si ambas entradas son correctas o no es un nuevo evento
        if (srcValidation.status && tarValidation.status || !isNew) {
            //Reseteamos el formulario
            $('#evt-src-protocol').val('');
            $('#evt-src-ipv4').val('');
            $('#evt-src-port').val('');
            $('#evt-src-os').val('');
            $('#evt-src-mac').val('');
            $('#evt-src-type').select2('val', '');
            $('#evt-src-location').select2('val', '');
            $('#evt-tar-protocol').val('');
            $('#evt-tar-ipv4').val('');
            $('#evt-tar-port').val('');
            $('#evt-tar-os').val('');
            $('#evt-tar-mac').val('');
            $('#evt-tar-type').select2('val', '');
            $('#evt-tar-location').select2('val', '');


            //Ensambla un objeto IncidentEvent
            var inputEvent = {source: src, target: tar};

            //Ensamblamos las cadenas de texto que irán en los datos informativos
            var src_string = "<b>" + src.protocol + "://" + src.ipv4 + ":" + src.port + "</b> | <b>" + src.os + "</b> | <b>" + src.mac + "</b>";
            var tar_string = "<b>" + tar.protocol + "://" + tar.ipv4 + ":" + tar.port + "</b> | <b>" + tar.os + "</b> | <b>" + tar.mac + "</b>";

            var event = $("<div class='col-md-12 h3'>" +
                    "<input onclick='removeEvent(" + isNew + "," + id + "," + countGeneralEvents + ")' type='button' value='Eliminar Evento' class='btn btn-danger col-md-2'>" +
                    "<input type='hidden' name='event_" +
                    countGeneralEvents + "' value='" +
                    JSON.stringify(inputEvent) + "'/><div class='col-md-5'>Origen " +
                    src_string + "</div><div class='col-md-5'> Destino " +
                    tar_string +
                    "</div></div>");

            if (isNew) {
                event.attr({id: countGeneralEvents}).appendTo('#new-events');
                countNewEvents++;
            } else {
                event.attr({id: countGeneralEvents}).appendTo('#old-events');
            }

            if (isNew)
                addPreviewRow(countGeneralEvents, src, tar);

            countGeneralEvents++;
            return;
        }
    }

    function validateEvent(machine) {
        if (machine.protocol == '') {
            return {status: false, field: 'protocolo'};
        }
        if (machine.ipv4 == '') {
            return {status: false, field: 'ipv4'};
        }
        if (machine.port == '') {
            return {status: false, field: 'puerto'};
        }
        if (machine.type == '') {
            return {status: false, field: 'tipo de ip'};
        }

        return {status: true};
    }

    function removeEvent(isNew, id, rowNumber) {
        modalDeleteEvent(isNew, id, function (status) {
            if (status) {
                if (isNew) {
                    //Elimina los elementos en la sección con id new-events
                    $('#new-events #' + rowNumber).remove();
                } else {
                    //Elimina los elementos en la sección con id old-events
                    $('#old-events #' + rowNumber).remove();
                }
                $('#pv-event-row-' + rowNumber).remove();
            }
        });
    }

    $(document).ready(function ($) {
        var sel_customer = $("#customer_id").select2({
            placeholder: 'Cliente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_criticity = $("#criticity_id").select2({
            placeholder: 'Criticidad del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_flow = $("#flow_id").select2({
            placeholder: 'Flujo del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_categories = $("#category_id").select2({
            placeholder: 'Categoría(s) del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_impact = $("#impact").select2({
            placeholder: 'Impacto del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_risk = $("#risk").select2({
            placeholder: 'Riesgo del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_type = $("#attack_type_id").select2({
            placeholder: 'Tipo de Ataque...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_sensors = $("#sensor_id").select2({
            placeholder: 'Sensor(es) donde se detectó el incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_signatures = $("#signature").select2({
            placeholder: 'Firma(s) del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_src_location = $("#evt-src-location").select2({
            placeholder: 'Selecciona un país',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_tar_location = $("#evt-tar-location").select2({
            placeholder: 'Selecciona un país',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_src_type = $("#evt-src-type").select2({
            placeholder: 'Tipo de IP Origen',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_tar_type = $("#evt-tar-type").select2({
            placeholder: 'Tipo de IP Destino',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });


        var descriptionField = CKEDITOR.replace('description');
        var recommendationField = CKEDITOR.replace('recommendation');
        var referenceField = CKEDITOR.replace('reference');

        $("#title").on('change', function () {
            $('#pv-title').text($(this).val());
        });

        $("#category_id").change(function () {
            $('#pv-categories').empty();
            $('#category_id :selected').each(function (i, selected) {
                var text = $(selected).text();
                $('#pv-categories').append('<li><i>•</i> ' + text + '</li>');
            });
        });

        $("#sensor_id").change(function () {
            $('#pv-sensors').empty();
            $('#sensor_id :selected').each(function (i, selected) {
                var text = $(selected).text();
                $('#pv-sensors').append('<li><i>•</i> ' + text + '</li>');
            });
        });

        $("#flow_id").change(function () {
            var text = $('#flow_id option:selected').text();
            $('#pv-flow').text(text);
        });

        $("#detection_date").blur(function () {
            $('#pv-detection-date').text($("#detection_date").val() + " " + $("#detection_time").val());
        });
        $("#detection_time").blur(function () {
            $('#pv-detection-date').text($("#detection_date").val() + " " + $("#detection_time").val());
        });

        $("#criticity_id").change(function () {
            var text = $('#criticity_id option:selected').text();
            $('#pv-criticity').text(text);
        });

        $("#signature").change(function () {
            $('#pv-signatures').empty();
            $('#signature :selected').each(function (i, selected) {
                var text = $(selected).text();
                $('#pv-signatures').append('<li><i>•</i> ' + text + '</li>');
            });
        });

        descriptionField.on('change', function (evt) {
            $('#pv-description').html(evt.editor.getData());
        });
        recommendationField.on('change', function (evt) {
            $('#pv-recommendation').html(evt.editor.getData());
        });
        referenceField.on('change', function (evt) {
            $('#pv-reference').html(evt.editor.getData());
        });

        $('#add-event-btn').on('click', function () {
            addEvent(true);
        });


        @include('incident._init');
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
    });
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
            {!! Form::text('title',null,['class'=>'form-control','id'=>'title','data-validate'=>'required,maxlength[255]', isset($case) && 1>=2?'disabled':'' ]) !!}
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label">Categoría(s)</label>
                <select {{isset($case) && 1>=2?'disabled':''}} class="form-control" id="category_id"
                        name="category_id[]" multiple data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackCategory::all(['name','id']) as $item)
                        <option value="{{$item->id}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Fecha en que Ocurrió el Incidente</label>

                <div class="date-and-time">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="occurrence_date"
                           id="occurrence_date" type="text"
                           class="form-control datepicker" data-format="dd/mm/yyyy"
                           data-end-date="{{isset($case)?date('d/m/Y',strtotime($case->occurrence_time)):date('d/m/Y')}}"
                           value="{{isset($case)?date('d/m/Y',strtotime($case->occurrence_time)):date('d/m/Y')}}">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="occurrence_time"
                           id="occurrence_time" type="text"
                           class="form-control timepicker" data-template="dropdown"
                           data-default-time="{{isset($case)?date('H:i',strtotime($case->occurrence_time)):date('H:i')}}"
                           data-show-meridian="false" data-minute-step="5"/>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Fecha en que se Detectó el Incidente</label>

                <div class="date-and-time">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="detection_date"
                           id="detection_date" type="text"
                           class="form-control datepicker" data-format="dd/mm/yyyy"
                           data-end-date="{{isset($case)?date('d/m/Y',strtotime($case->detection_time)):date('d/m/Y')}}"
                           value="{{isset($case)?date('d/m/Y',strtotime($case->detection_time)):date('d/m/Y')}}">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="detection_time"
                           id="detection_time" type="text"
                           class="form-control timepicker" data-template="dropdown"
                           data-default-time="{{isset($case)?date('H:i',strtotime($case->detection_time)):date('H:i')}}"
                           data-show-meridian="false" data-minute-step="5"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 form-group">
                <label class="control-label">Flujo del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="flow_id" class="form-control" name="flow_id"
                        data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackFlow::all(['name','id']) as $index=>$item)
                        <option value="{{$item->id}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label class="control-label">Tipo de Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="attack_type_id" class="form-control"
                        name="attack_type_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackType::all(['name','id']) as $index=>$item)
                        <option value="{{$item->id}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label class="control-label">Criticidad del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="criticity_id" class="form-control"
                        name="criticity_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\Criticity::all(['name','id']) as $index=>$criticity)
                        <option value="{{$criticity->id}}">
                            {{$criticity->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="control-label">Impacto del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="impact" class="form-control" name="impact"
                        data-validate="required">
                    <option></option>
                    @for($i=0;$i<=10;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="control-label">Riesgo del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="risk" class="form-control" name="risk"
                        data-validate="required">
                    <option></option>
                    @for($i=1;$i<=10;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row">
            {{--Cliente--}}
            <div class="form-group col-md-6">
                <label class="control-label">Cliente</label>
                <select {{isset($case) && 1>=2?'disabled':''}} class="form-control" id="customer_id" name="customer_id"
                        data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Customer\Customer::all(['name','id']) as $index=>$customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
            {{--Sensores--}}
            <div class="form-group col-md-6">
                <label class="control-label">Sensor(es)</label>
                <select {{isset($case) && 1>=2?'disabled':''}} class="form-control" id="sensor_id" name="sensor_id[]"
                        multiple="multiple"
                        data-validate="required">
                    <option></option>
                    @if(isset($case))
                        @foreach($case->customer->sensors as $sensor)
                            <option value="{{$sensor->id}}">
                                {{$sensor->name}}
                            </option>
                        @endforeach
                    @endif
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
                    <option value="{{$item->id}}">
                        {{$item->name}}
                    </option>
                @endforeach
            </select>
        </div>
        {{--Eventos--}}
        {{-- Si está abierto el caso o es un caso nuevo --}}
        @if(1<2 || !isset($case))
            <div class="row">
                <div class="col-md-10"><span class="h1">Eventos del Incidente</span></div>
            </div>
            <div class="row">
                <div class="col-md-1 form-group">
                    <label class="control-label">ORIGEN</label>
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-src-protocol" type="text" class="form-control" placeholder="Protocolo">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-src-ipv4" type="text" class="form-control" placeholder="IPv4">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-src-port" type="text" class="form-control" placeholder="Puerto">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-src-os" type="text" class="form-control" placeholder="O.S.">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-src-mac" type="text" class="form-control" placeholder="MAC">
                </div>
                <div class="col-md-2 form-group">
                    <select id="evt-src-location">
                        <option></option>
                        @foreach(\App\Models\Catalog\Location::orderBy('name','asc')->get(['name','id']) as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <select id="evt-src-type">
                        <option></option>
                        @foreach(\App\Models\Incident\MachineType::all('name','id') as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 form-group">
                    <label class="control-label">Blacklist</label>
                    <input type="checkbox" id="evt-src-blacklist" name="evt-src-blacklist">
                </div>
                <div class="col-md-1 form-group">
                    <label class="control-label">No mostrar</label>
                    <input type="checkbox" id="evt-src-hide" name="evt-src-hide">
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 form-group">
                    <label class="control-label">DESTINO</label>
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-tar-protocol" type="text" class="form-control" placeholder="Protocolo">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-tar-ipv4" type="text" class="form-control" placeholder="IPv4">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-tar-port" type="text" class="form-control" placeholder="Puerto">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-tar-os" type="text" class="form-control" placeholder="O.S.">
                </div>
                <div class="col-md-1 form-group">
                    <input id="evt-tar-mac" type="text" class="form-control" placeholder="MAC">
                </div>
                <div class="col-md-2 form-group">
                    <select id="evt-tar-location">
                        <option></option>
                        @foreach(\App\Models\Catalog\Location::orderBy('name','asc')->get(['name','id']) as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <select id="evt-tar-type">
                        <option></option>
                        @foreach(\App\Models\Incident\MachineType::all('name','id') as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 form-group">
                    <label class="control-label">Blacklist</label>
                    <input type="checkbox" id="evt-tar-blacklist" name="evt-tar-blacklist">
                </div>
                <div class="col-md-1 form-group">
                    <label class="control-label">No mostrar</label>
                    <input type="checkbox" id="evt-tar-hide" name="evt-tar-hide">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <span class="btn btn-blue" id="add-event-btn">Agregar Evento al Incidente</span>
                </div>
            </div>
            <div class="row" id="new-events">

            </div>
            <div class="row" id="old-events">

            </div>
        @endif
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
        <h3 class="title">Previsualizar y Guardar</h3>

        <div class="row">
            <div id="surveillance-preview" class="col-sm-12">
                @include('incident._preview',['case'=>isset($case)?$case:new \App\Models\Incident\Incident()])
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-right">
                @if(isset($case))
                    @foreach($case->evidences as $evidence)
                        <input type="hidden" value="{{$evidence->evidence->id}}"
                               name="evidence_{{$evidence->evidence->id}}"
                               id="evidence_{{$evidence->evidence->id}}">
                    @endforeach
                @endif
                {!! Form::submit('Guardar Caso',['class'=>'btn btn-lg btn-blue']) !!}
            </div>
        </div>
    </div>
    <ul class="pager wizard">
        <li class="previous first"><a href="#">Primero</a></li>
        <li class="previous"><a href="#"><i class="entypo-left-open"></i> Anterior</a></li>
        <li class="next last"><a href="#">Último</a></li>
        <li class="next"><a href="#">Siguiente <i class="entypo-right-open"></i></a></li>
    </ul>
</div>
{{--Valida si los campos de evidencias fueron pasados como un valor de sesión cuando ha ocurrido un error--}}
@if (\Session::has('incident_evidences'))
    @foreach(session('incident_evidences') as $evidence)
        @include('file._evidence_hidden',['evidence'=>$evidence])
    @endforeach
@endif