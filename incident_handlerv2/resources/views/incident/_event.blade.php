<script type="text/javascript">
    {{--Arreglo de eventos, aquí se irán agregando los nuevos eventos cuando se presione el botón de "Agregar Evento"--}}
    var events = [];

    /**
     * Evento Javascript que permite agregar un evento con un origen y un destino
     */
    function addNewEvent(id, src, tar, pl) {
        var source;
        if (source) {
            source = parseMachine(src)
        } else {
            source = getMachine('src');
        }
        var target;
        if (target) {
            target = parseMachine(tar)
        } else {
            target = getMachine('tar');
        }

        var validateSource = validateMachine(source);
        var validateTarget = validateMachine(target);

        if (!validateSource.status) {
            alert('ORIGEN: El campo ' + validateSource.field + ' es obligatorio');
            return;
        }
        if (!validateTarget.status) {
            alert('DESTINO: El campo ' + validateTarget.field + ' es obligatorio');
            return;
        }

        if (validateSource.status && validateTarget.status) {
            var event = new EventMachine();
            event.source = source;
            event.target = target;
            event.payload = (pl) ? pl : escape($('#evt-payload').val());
            events.push(event);

            addEventRow(id, event);
        }
    }

    /**
     * Método Javascript para poder agregar a la interfaz de usuario una nueva
     * fila con un campo escondido, el cual contiene la información del evento en cuestión
     *
     * @param id ID del elemento desde la base de datos
     * @param event Evento a agregar
     */
    function addEventRow(id, event) {
        /**
         * Se estructura el nuevo elementoq ue se agregará a la lista de eventos
         */
        var row = $("<div class='col-md-12 h4'>" +
                "<input onclick='removeEvent(" + id + "," + events.indexOf(event) + ")' type='button' value='Eliminar Evento' class='btn btn-danger col-md-1' />" +
                "<input type='hidden' id='event_" + events.indexOf(event) + "' name='event_" + events.indexOf(event) + "' value='" + JSON.stringify(event) + "' />" +
                "<div class='col-md-6'>Origen " + event.source.toString() + "</div>" +
                "<div class='col-md-5'> Destino " + event.target.toString() +
                "</div></div>").attr({id: events.indexOf(event)});

        appendRow(row);

        addPreviewRow(event);
    }

    /**
     * Método Javascript que permite agregar una nueva fila con la información de un origen con múltiples destinos
     *
     * @param id ID del elemento encontrado en la base de datos
     * @param event Evento a agregar
     */
    //TODO TypeError: event is null
    function addMultitargetRow(id, event) {
//        console.log(event);
        var row = $("<div class='col-md-12 h4'>" +
                "<input onclick='removeEvent(" + id + "," + events.indexOf(event) + ")' type='button' value='Eliminar Evento' class='btn btn-danger col-md-1' />" +
                "<input type='hidden' id='event_" + events.indexOf(event) + "' name='event_" + events.indexOf(event) + "' value='" + JSON.stringify(event) + "' />" +
                "<div class='col-md-6'>Origen " + event.source.toString() + "</div>" +
                "<div class='col-md-5'> Destinos <ul id='targets-event-" + events.indexOf(event) + "'></ul>  </div></div>").attr({id: events.indexOf(event)});

        appendRow(row);

        addMultitargetPreviewRow(event);
    }

    /**
     * Método Javascript que permite agregar una nueva fila con la información de un destino con múltiples orígenes
     *
     * @param id ID del elemento encontrado en la base de datos
     * @param event Evento a agregar
     */
    //TODO TypeError: event is null
    function addMultisourceRow(id, event) {
        var row = $("<div class='col-md-12 h4'>" +
                "<input onclick='removeEvent(" + id + "," + events.indexOf(event) + ")' type='button' value='Eliminar Evento' class='btn btn-danger col-md-1' />" +
                "<input type='hidden' id='event_" + events.indexOf(event) + "' name='event_" + events.indexOf(event) + "' value='" + JSON.stringify(event) + "' />" +
                "<div class='col-md-6'>Origenes <ul id='sources-event-" + events.indexOf(event) + "'></ul></div>" +
                "<div class='col-md-5'> Destino " + event.target.toString() + "  </div></div>").attr({id: events.indexOf(event)});

        appendRow(row);

        addMultisourcePreviewRow(event);
    }

    /**
     * Agrega el Target <b>target</b> a la lista que corresponde al origen con muchos destinos. Además agrega también el elemento al preview del incidente
     * @param event Evento que tiene muchos targets
     * @param target Target a agregar
     */
    function addTargetToSourceRow(event, target) {
        $('<li>' + target.toString() + '</li>').appendTo('#targets-event-' + events.indexOf(event));

        addTargetToSourcePreview(event, target);

        $('#event_' + events.indexOf(event)).attr('value', JSON.stringify(event));
    }

    /**
     * Agrega el Source <b>source</b> a la lista que corresponde al destino con muchos orígenes. Además agrega también el elemento al preview del incidente
     * @param event Evento que tiene muchos sources
     * @param spurce Source a agregar
     */
    function addSourceToTargetRow(event, source) {
        $('<li>' + source.toString() + '</li>').appendTo('#sources-event-' + events.indexOf(event));

        addSourceToTargetPreview(event, source);

        $('#event_' + events.indexOf(event)).attr('value', JSON.stringify(event));
    }

    /**
     * Agrega el <b>row</b> a la lista de elementos debajo del formulario de Eventos
     *
     * @param row Fila que se va a agregar a al sección correspondiente
     */
    function appendRow(row) {
        row.appendTo($('#new-events'));
    }

    /**
     * Elimina un elemento tanto del preview, como de la lista inferior alk formulario.
     * También, de ser necesario, lanza la petición al servidor para eliminar el elemento de la base de datos
     *
     * @param id ID del elemento que se va a eliminar de la base de datos
     * @param rowNumber Número de fila que se va a borrar
     */
    function removeEvent(id, rowNumber) {
        modalDeleteEvent(id, function (status) {
            if (status) {
                //Elimina los elementos en la sección con id new-events
                $('#new-events #' + rowNumber).remove();
                events.splice(rowNumber);
                $('#pv-event-row-' + rowNumber).remove();
                $('#pv-blacklist .new-bl-' + rowNumber).remove();
            }
        });
    }


    @if(isset($case->id))
    /**
     * Elimina elementos específicos de la sección donde se muestran eventos cargados de la base de datos
     */
    function removeOldEvent(eventNumber, sourceId, targetId) {
        modalDeleteOldEvent({{$case->id}}, sourceId, targetId, function (status) {
            if (status) {
                //Elimina los elementos en la sección con id new-events
                $('#old-events #old-e-' + eventNumber).remove();
                $('#pv-events #old-pv-' + eventNumber).remove();
                $('#pv-blacklist .old-bl-' + eventNumber).remove();
            }
        });
    }
    @endif

    /**
     * Agrega un Target a la lista que tiene un Src en común
     */
    function addTarget() {
        var target = getMachine('tar');
        var valid = validateMachine(target);

        if (valid.status) {
            var source = getMachine('src');
            var payload = escape($('#evt-payload').val());
            var event = new EventMultiTarget();
            var found = false;
            $.each(events, function (index, value) {
                if (value.targets && source.ipv4 === value.source.ipv4) {
                    event = value;
                    found = true;
                }
            });
            //Si no se encontró, seteamos el source al event
            if (!found) {
                event.source = source;
//                console.log(source);

                //Agrtegamos el evento a la lista
                events.push(event);

//                console.log(event);

                addMultitargetRow(null, event);
            }
            //Agregamos el target
            event.targets.push({target: target, payload: payload});

            addTargetToSourceRow(event, target);

        } else {
            alert('DESTINO: El campo ' + valid.field + ' es obligatorio');
        }
    }

    /**
     * Agrega un Source a la lista que tiene un Target en común
     */
    function addSource() {
        var source = getMachine('src');
        var valid = validateMachine(source);

        if (valid.status) {
            var target = getMachine('tar');
            var payload = escape($('#evt-payload').val());
            var event = new EventMultiSource();
            var found = false;
            $.each(events, function (index, value) {
                if (value.sources && target.ipv4 === value.target.ipv4) {
                    event = value;
                    found = true;
                }
            });
            //Si no se encontró, seteamos el target al event
            if (!found) {
                event.target = target;
                //Agregamos el evento a la lista
                events.push(event);

//                console.log(event);

                addMultisourceRow(null, event);
            }
            //Agregamos el source
            event.sources.push({source: source, payload: payload});

            addSourceToTargetRow(event, source);
        } else {
            alert('DESTINO: El campo ' + valid.field + ' es obligatorio');
        }
    }

    /**
     * Obtiene los datos de un formulario tipo <b>type</b>
     *
     * @param type Tipo 'src' para Origen y 'tar' para Destino
     * @param id ID del elemento en BD
     * @returns {Machine} Devuelve el objeto tipo Machine con los datos del formulario
     */
    function getMachine(type) {
        var location = $('#evt-' + type + '-location option:selected');
        var machine = new Machine();

        machine.protocol = $('#evt-' + type + '-protocol').val();
        machine.ipv4 = $('#evt-' + type + '-ipv4').val();
        machine.port = $('#evt-' + type + '-port').val();
        machine.os = $('#evt-' + type + '-os').val();
        machine.mac = $('#evt-' + type + '-mac').val();
        machine.location = location.val();
        machine.location_name = location.text();
        machine.type = $('#evt-' + type + '-type option:selected').val();
        machine.blacklist = $('#evt-' + type + '-blacklist').is(":checked");
        machine.hide = $('#evt-' + type + '-hide').is(":checked");

        return machine;
    }

    /**
     * Limpia los campos del formulario de tipo <b>type</b>
     *
     * @param type Tipo de formulario: 'src' para Origen y 'tar' para Destino
     */
    function clearMachineForm(type) {
        $('#evt-' + type + '-protocol').val('');
        $('#evt-' + type + '-ipv4').val('');
        $('#evt-' + type + '-port').val('');
        $('#evt-' + type + '-os').val('');
        $('#evt-' + type + '-mac').val('');
        $('#evt-' + type + '-type').select2('val', '');
        $('#evt-' + type + '-location').select2('val', '');
        $('#evt-' + type + '-blacklist').prop('checked', false);
        $('#evt-' + type + '-hide').prop('checked', false);
    }

    /**
     * Limpia el campo de Payload
     */
    function clearPayloadEventForm() {
        $('#evt-payload').val('');
    }

    /**
     * Activa o Desactiva los campos del formulario <b>type</b>
     * @param type Tipo 'src' para Origen y 'tar' para Destino
     * @param status true para activado y false para desactivado
     */
    function setEnableFields(type, status) {
        $('#evt-' + type + '-protocol').prop('disabled', status);
        $('#evt-' + type + '-ipv4').prop('disabled', status);
        $('#evt-' + type + '-port').prop('disabled', status);
        $('#evt-' + type + '-os').prop('disabled', status);
        $('#evt-' + type + '-mac').prop('disabled', status);
        $('#evt-' + type + '-type').prop('disabled', status);
        $('#evt-' + type + '-location').prop('disabled', status);
        $('#evt-' + type + '-blacklist').prop('disabled', status);
        $('#evt-' + type + '-hide').prop('disabled', status);
        $('#evt-' + type + '-clearform').prop('disabled', status);
    }

    /**
     * Inicialización de la interfaz de usuario
     */
    $(document).ready(function ($) {
        $('#evt-src-clearform').on('click', function () {
            clearMachineForm('src');
        });
        $('#evt-tar-clearform').on('click', function () {
            clearMachineForm('tar');
        });

        $('#evt-same-source').change(function (evt) {
            //Validar que el checkbox de source no esté seleccionado
            if (!$('#evt-same-target').is(':checked')) {
                var validation = validateMachine(getMachine('src'));
                if (validation.status) {
                    //Obtenemos el valor (true|false) del checkbox
                    var value = $(this).is(":checked");
                    //Habilitamos/Deshabilitamos los campos de origen
                    setEnableFields('src', value);
                    if (value) {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Destino al Origen').unbind('click').bind('click', function () {
                            addTarget();
                        });
                    } else {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Evento al Incidente').unbind('click').bind('click', function () {
                            addNewEvent();
                        });
                    }

                } else {
                    alert("ORIGEN: El campo " + validation.field + " es obligatorio");
                    $(this).prop('checked', false);
                }
            } else {
//                406
                alert('Los checkbox "Mismo origen para todos los destinos" y "Mismo destino para varios orígenes" no pueden estar seleccionados a la vez.');
                $(this).prop('checked', false);
            }
        });

        $('#evt-same-target').change(function () {
            //Validar que el checkbox de source no esté seleccionado
            if (!$('#evt-same-source').is(':checked')) {
                var validation = validateMachine(getMachine('tar'));
                if (validation.status) {
                    //Obtenemos el valor (true|false) del checkbox
                    var value = $(this).is(":checked");
                    //Habilitamos/Deshabilitamos los campos de origen
                    setEnableFields('tar', value);

                    if (value) {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Origen al Destino').unbind('click').bind('click', function () {
                            addSource();
                        });
                    } else {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Evento al Incidente').unbind('click').bind('click', function () {
                            addNewEvent();
                        });
                    }
                } else {
                    alert('Los checkbox "Mismo origen para todos los destinos" y "Mismo destino para varios orígenes" no pueden estar seleccionados a la vez.');
                    $(this).prop('checked', false);
                }
            } else {
                alert('Sólo una de las opciones puede ser seleccionada a la vez. Revise los campos referidos a "Mismo origen para todos los destinos" y "Mismo destino para varios orígenes"');
                $(this).prop('checked', false);
            }
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

        $('#add-event-btn').on('click', function () {
            addNewEvent();
        });
    });
</script>

<div class="row">
    <div class="col-md-1 form-group">
        <label class="control-label h4 text-bold">ORIGEN</label>
    </div>
    <div class=" col-md-11 form-group">
        <label class="control-label">Mismo origen para todos los destinos</label>
        <input type="checkbox" id="evt-same-source" name="evt-same-source">
    </div>
</div>
<div class="row">
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
    <div class="col-md-1 form-group">
        <input type="button" id="evt-src-clearform" name="evt-src-clearform" class="btn btn-info"
               value="Reiniciar Origen">
    </div>
</div>
<div class="row">
    <div class="col-md-1 form-group">
        <label class="control-label h4 text-bold">DESTINO</label>
    </div>
    <div class="col-md-11 form-group">
        <label class="control-label">Mismo destino para varios los origenes</label>
        <input type="checkbox" id="evt-same-target" name="evt-same-target">
    </div>
</div>
<div class="row">
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
    <div class="col-md-1 form-group">
        <input type="button" id="evt-tar-clearform" name="evt-tar-clearform" class="btn btn-info"
               value="Reiniciar Destino">
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        <label class="control-label">Payload (Pegar el payload del paquete entre equipos)</label>
        <textarea class="form-control" id="evt-payload"></textarea>
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
    @if(isset($case->id))
        @foreach($case->getGroupedEvents() as $index=>&$e)
            @if($e['type']==='11')
                <div class='col-md-12 h4' id="old-e-{{$index}}">
                    <input onclick='removeOldEvent({{$index}},{{$e['source']->id}},{{$e['target']->id}})' type='button'
                           value='Eliminar Evento'
                           class='btn btn-danger col-md-1'/>

                    <div class='col-md-6'>Origen {{$e['source']}}</div>
                    <div class='col-md-5'>Destino {{$e['target']}}</div>
                </div>
            @elseif($e['type']==='1n')
                <div class='col-md-12 h4' id="old-e-{{$index}}">
                    <input onclick='removeOldEvent({{ $index }},{{ $e['source']->id }},null)' type='button'
                           value='Eliminar Evento' class='btn btn-danger col-md-1'/>

                    <div class='col-md-6'>Origen {{$e['source']}}</div>
                    <div class='col-md-5'> Destinos
                        <ul>
                            @foreach($e['targets'] as &$t)
                                <li>{{$t}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @elseif($e['type']==='n1')
                <div class='col-md-12 h4' id="old-e-{{$index}}">
                    <input onclick='removeOldEvent({{$index}},null,{{$e['target']->id}});' type='button'
                           value='Eliminar Evento' class='btn btn-danger col-md-1'/>

                    <div class='col-md-6'>Origenes
                        <ul>
                            @foreach($e['sources'] as &$s)
                                <li>{{$s}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class='col-md-5'> Destino {{$e['target']}}</div>
                </div>
            @endif
        @endforeach
    @endif
</div>