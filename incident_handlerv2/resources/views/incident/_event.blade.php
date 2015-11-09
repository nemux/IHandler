<script type="text/javascript">
    var countNewEvents = 0;
    var countGeneralEvents = 0;

    function addEvent(isNew, id, source, target, oldPayload) {
        //Obtenemos los valores de origen del formulario
        var srcValidation = {status: false};
        var tarValidation = {status: false};
        if (isNew) {
            var src = getValues('src');

            //Obtenemos los valores de destino del formulario
            var tar = getValues('tar');

            //Escapamos para evitar un XSS autoincrustado
            var payload = escape($('#evt-payload').val());

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
            var src = getJsonValues(json_source);

            //Obtenemos los valores de destino del objeto json
            var json_target = target;
            var tar = getJsonValues(json_target);

            var payload = oldPayload;
        }

        //Si ambas entradas son correctas o no es un nuevo evento
        if (srcValidation.status && tarValidation.status || !isNew) {
            //Ensambla un objeto IncidentEvent
            var inputEvent = {source: src, target: tar, payload: payload};

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


            clearPayloadEventForm();

            if (!$('#evt-same-source').is(":checked")) {
                clearEventForm('src');
            }

            if (!$('#evt-same-target').is(":checked")) {
                clearEventForam('tar');
            }

            countGeneralEvents++;

            try {
                if (isNew)
                    addPreviewRow(countGeneralEvents, src, tar);
            } catch (err) {
                console.log(err);
            }

            return;
        }
    }

    function getJsonValues(json) {
        var data = {
            id: json.id,
            protocol: json.protocol,
            ipv4: json.ipv4,
            port: json.port,
            os: json.os,
            mac: json.mac,
            location: json.location_id,
            type: json.machine_type_id,
            blacklist: json.blacklist,
            hide: json.hide
        };

        return data;
    }

    function getValues(type, id) {
        var data = {
            id: null,
            protocol: $('#evt-' + type + '-protocol').val(),
            ipv4: $('#evt-' + type + '-ipv4').val(),
            port: $('#evt-' + type + '-port').val(),
            os: $('#evt-' + type + '-os').val(),
            mac: $('#evt-' + type + '-mac').val(),
            location: $('#evt-' + type + '-location option:selected').val(),
            type: $('#evt-' + type + '-type option:selected').val(),
            blacklist: $('#evt-' + type + '-blacklist').is(":checked"),
            hide: $('#evt-' + type + '-hide').is(":checked")
        };

        return data;
    }

    function clearEventForm(type) {
        //Reseteamos el formulario de origen del evento
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

    function clearPayloadEventForm() {
        $('#evt-payload').val('');
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
                countGeneralEvents--;
            }
        });
    }

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

    $(document).ready(function ($) {
        $('#evt-src-clearform').on('click', function () {
            clearEventForm('src');
        });
        $('#evt-tar-clearform').on('click', function () {
            clearEventForm('tar');
        });

        $('#evt-same-source').change(function () {
            var value = $('#evt-same-source').is(":checked");
            setEnableFields('src', value);
            sameSource = value;
        });

        $('#evt-same-target').change(function () {
            var value = $('#evt-same-target').is(":checked");
            setEnableFields('tar', value);
            sameTarget = value;
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