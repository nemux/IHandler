<script type="text/javascript">
    {{--Variable global que sirve para saber si el evento ingresado en el formulario tiene múltiples destinos y un solo origen--}}
    var sameSource = false;
    {{--Variable global que sirve para saber si el evento ingresado en el formulario tiene múltiples orígenes y un solo destino--}}
    var sameTarget = false;
    {{--Arreglo de eventos, aquí se irán agregando los nuevos eventos cuando se presione el botón de "Agregar Evento"--}}
    var events = new Array();

    {{--Clase Javascript que sirve para modelar un objeto con un origen y múltiples destinos--}}
    var EventMultiTarget = function EventMultiTarget() {
        this.source = new Machine();
        this.targets = new Array();
    };
    {{--Clase Javascript que sirve para modelar un objeto con un destino y múltiples orígenes--}}
    var EventMultiSource = function EventMultiSource() {
        this.sources = new Array();
        this.target = new Machine();
    };

    {{--Clase Javascript que permite modelar un objeto con un único origen y destino--}}
    var EventMachine = function EventMachine() {
        this.source = new Machine();
        this.target = new Machine();
        this.payload = null;
    };

    {{--Modelo Javascript para definir un objeto con los parámetros del formulario de Eventos--}}
    var Machine = function Machine() {
        this.id = null;
        this.protocol = null;
        this.ipv4 = null;
        this.port = null;
        this.os = null;
        this.mac = null;
        this.location = null;
        this.location_name = null;
        this.type = null;
        this.blacklist = false;
        this.hide = false;
        this.toString = function () {
            return this.protocol + "://" + this.ipv4 + ":" + this.port + " | MAC: " + this.mac + " | Blacklist: " + this.blacklist + " | Hide: " + this.hide;
        };
    };

    /**
     * Evento Javascript que permite agregar un evento con un origen y un destino
     */
    function addEvent() {
        var source = getMachine('src');
        var target = getMachine('tar');

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
            event.payload = escape($('#evt-payload').val());
            events.push(event);

            addEventRow(true, null, event);
        }
    }

    /**
     * Método Javascript para poder agregar a la interfaz de usuario una nueva
     * fila con un campo escondido, el cual contiene la información del evento en cuestión
     *
     * @param isNew Permite definir si se está agregando un nuevo elemento desde el formulario o es uno desde la base de datos
     * @param id ID del elemento desde la base de datos
     * @param event Evento a agregar
     */
    function addEventRow(isNew, id, event) {
        /**
         * Se estructura el nuevo elementoq ue se agregará a la lista de eventos
         */
        var row = $("<div class='col-md-12 h4'>" +
                "<input onclick='removeEvent(" + isNew + "," + id + "," + events.indexOf(event) + ")' type='button' value='Eliminar Evento' class='btn btn-danger col-md-1' />" +
                "<input type='hidden' id='event_" + events.indexOf(event) + "' name='event_" + events.indexOf(event) + "' value='" + JSON.stringify(event) + "' />" +
                "<div class='col-md-6'>Origen " + event.source.toString() + "</div>" +
                "<div class='col-md-5'> Destino " + event.target.toString() +
                "</div></div>").attr({id: events.indexOf(event)});

        appendRow(isNew, row);


        if (isNew) {
            addPreviewRow(event);
        }
    }

    /**
     * Si es un nuevo evento, se agrega un elemento a la vista previa
     */
    function addPreviewRow(event) {
        var row = $('<tr id="pv-event-row-' + events.indexOf(event) + '"></tr>').appendTo('#pv-events');

        if (!event.source.hide) {
            $('<td>' + event.source.ipv4 + '</td>').appendTo(row);
        } else {
            $('<td></td>').appendTo(row);
        }

        if (!event.target.hide) {
            $('<td>' + event.target.ipv4 + '</td>').appendTo(row);
        } else {
            $('<td></td>').appendTo(row);
        }

        var pv_blacklist = $('#pv-blacklist');

        if (event.source.blacklist) {
            $('<tr><td>' + event.source.ipv4 + '</td><td>' + event.source.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }

        if (event.target.blacklist) {
            $('<tr><td>' + event.target.ipv4 + '</td><td>' + event.target.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }
    }

    /**
     * Método Javascript que permite agregar una nueva fila con la información de un origen con múltiples destinos
     *
     * @param isNew Permite definir si se agrega un nuevo elemento (true) desde la interfaz o (false) desde la base de datos
     * @param id ID del elemento encontrado en la base de datos
     * @param event Evento a agregar
     */
    function addMultitargetRow(isNew, id, event) {
        var row = $("<div class='col-md-12 h4'>" +
                "<input onclick='removeEvent(" + isNew + "," + id + "," + events.indexOf(event) + ")' type='button' value='Eliminar Evento' class='btn btn-danger col-md-1' />" +
                "<input type='hidden' id='event_" + events.indexOf(event) + "' name='event_" + events.indexOf(event) + "' value='" + JSON.stringify(event) + "' />" +
                "<div class='col-md-6'>Origen " + event.source.toString() + "</div>" +
                "<div class='col-md-5'> Destinos <ul id='targets-event-" + events.indexOf(event) + "'></ul>  </div></div>").attr({id: events.indexOf(event)});

        appendRow(isNew, row);


        if (isNew) {
            addMultitargetPreviewRow(event);
        }
    }


    /**
     * Si es un nuevo evento, agregado desde formulario, agrega una fila al preview de eventos
     */
    function addMultitargetPreviewRow(event) {
        var row = $('<tr id="pv-event-row-' + events.indexOf(event) + '"></tr>').appendTo('#pv-events');

        if (!event.source.hide) {
            $('<td>' + event.source.ipv4 + '</td>').appendTo(row);
        } else {
            $('<td></td>').appendTo(row);
        }

        $('<td><ul id="ul-targets-event-' + events.indexOf(event) + '"></ul></td>').appendTo(row);

        var pv_blacklist = $('#pv-blacklist');

        if (event.source.blacklist) {
            $('<tr><td>' + event.source.ipv4 + '</td><td>' + event.source.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }
    }

    /**
     * Método Javascript que permite agregar una nueva fila con la información de un destino con múltiples orígenes
     *
     * @param isNew Permite definir si se agrega un nuevo elemento (true) desde la interfaz o (false) desde la base de datos
     * @param id ID del elemento encontrado en la base de datos
     * @param event Evento a agregar
     */
    function addMultisourceRow(isNew, id, event) {
        var row = $("<div class='col-md-12 h4'>" +
                "<input onclick='removeEvent(" + isNew + "," + id + "," + events.indexOf(event) + ")' type='button' value='Eliminar Evento' class='btn btn-danger col-md-1' />" +
                "<input type='hidden' id='event_" + events.indexOf(event) + "' name='event_" + events.indexOf(event) + "' value='" + JSON.stringify(event) + "' />" +
                "<div class='col-md-6'>Origenes <ul id='sources-event-" + events.indexOf(event) + "'></ul></div>" +
                "<div class='col-md-5'> Destino " + event.target.toString() + "  </div></div>").attr({id: events.indexOf(event)});

        appendRow(isNew, row);


        if (isNew) {
            addMultisourcePreviewRow(event);
        }
    }

    /**
     * Si es un nuevo evento, agregado desde formulario, agrega una fila al preview de eventos
     */
    function addMultisourcePreviewRow(event) {
        var row = $('<tr id="pv-event-row-' + events.indexOf(event) + '"></tr>').appendTo('#pv-events');

        $('<td><ul id="ul-sources-event-' + events.indexOf(event) + '"></ul></td>').appendTo(row);

        if (!event.target.hide) {
            $('<td>' + event.target.ipv4 + '</td>').appendTo(row);
        } else {
            $('<td></td>').appendTo(row);
        }

        var pv_blacklist = $('#pv-blacklist');

        if (event.target.blacklist) {
            $('<tr><td>' + event.target.ipv4 + '</td><td>' + event.target.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }
    }

    /**
     * Agrega el Target <b>target</b> a la lista que corresponde al origen con muchos destinos. Además agrega también el elemento al preview del incidente
     * @param event Evento que tiene muchos targets
     * @param target Target a agregar
     */
    function addTargetToSourceRow(event, target) {
        $('<li>' + target.toString() + '</li>').appendTo('#targets-event-' + events.indexOf(event));

        if (!target.hide)
            $('<li>' + target.ipv4 + '</li>').appendTo('#ul-targets-event-' + events.indexOf(event));

        if (target.blacklist) {
            var pv_blacklist = $('#pv-blacklist');
            $('<tr><td>' + target.ipv4 + '</td><td>' + target.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }

        $('#event_' + events.indexOf(event)).attr('value', JSON.stringify(event));
    }

    /**
     * Agrega el Source <b>source</b> a la lista que corresponde al destino con muchos orígenes. Además agrega también el elemento al preview del incidente
     * @param event Evento que tiene muchos sources
     * @param spurce Source a agregar
     */
    function addSourceToTargetRow(event, source) {
        $('<li>' + source.toString() + '</li>').appendTo('#sources-event-' + events.indexOf(event));

        if (!source.hide)
            $('<li>' + source.ipv4 + '</li>').appendTo('#ul-sources-event-' + events.indexOf(event));

        $('#event_' + events.indexOf(event)).attr('value', JSON.stringify(event));

        if (source.blacklist) {
            var pv_blacklist = $('#pv-blacklist');
            $('<tr><td>' + source.ipv4 + '</td><td>' + source.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }
    }

    /**
     * Agrega el <b>row</b> a la lista de elementos debajo del formulario de Eventos
     *
     * @param isNew Útil para saber a qué subsección se va a agregar la fila
     * @param row Fila que se va a agregar a al sección correspondiente
     */
    function appendRow(isNew, row) {
        if (isNew) {
            row.appendTo($('#new-events'));
        } else {
            row.appendTo($('#old-events'));
        }
    }

    /**
     * Elimina un elemento tanto del preview, como de la lista inferior alk formulario.
     * También, de ser necesario, lanza la petición al servidor para eliminar el elemento de la base de datos
     *
     * @param isNew Permite saber si se enviará la petición al servidor para eliminar el elemento de la BD
     * @param id ID del elemento que se va a eliminar de la base de datos
     * @param rowNumber Número de fila que se va a borrar
     */
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
                events.splice(rowNumber);
                $('#pv-event-row-' + rowNumber).remove();
            }
        });
    }

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

                //Agrtegamos el evento a la lista
                events.push(event);

                addMultitargetRow(true, null, event);
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

                addMultisourceRow(true, null, event);
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
    function getMachine(type, id) {
        var location = $('#evt-' + type + '-location option:selected');
        var machine = new Machine();

        machine.id = id;
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
     * Valida los campos definidos en el objeto tipo Machine
     *
     * @param machine Objeto al que se le validarán los datos
     * @returns {*} Regresa un objeto con los campos 'status' y 'field'
     */
    function validateMachine(machine) {
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

        return {status: true, field: ''};
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
                    //Establecemos la variable global según el valor del checkbox
                    sameSource = value;
                    if (sameSource) {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Destino al Origen').unbind('click').bind('click', function () {
                            addTarget();
                        });
                    } else {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Evento al Incidente').unbind('click').bind('click', function () {
                            addEvent();
                        });
                    }

                } else {
                    alert("ORIGEN: El campo " + validation.field + " es obligatorio");
                    $(this).prop('checked', false);
                }
            } else {
                406
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
                    //Establecemos la variable global según el valor del checkbox
                    sameTarget = value;

                    if (sameTarget) {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Origen al Destino').unbind('click').bind('click', function () {
                            addSource();
                        });
                    } else {
                        //Cambiar el nombre del botón de "Agregar Evento al Incidente" a "Agregar Destino al Incidente"
                        $('#add-event-btn').text('Agregar Evento al Incidente').unbind('click').bind('click', function () {
                            addEvent();
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
            addEvent(true);
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

</div>