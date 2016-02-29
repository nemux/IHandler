//{{--Clase Javascript que sirve para modelar un objeto con un origen y múltiples destinos--}}
var EventMultiTarget = function EventMultiTarget() {
    //this.event_relation = '1n';
    this.source = new Machine();
    this.targets = [];
};

//{{--Clase Javascript que sirve para modelar un objeto con un destino y múltiples orígenes--}}
var EventMultiSource = function EventMultiSource() {
    //this.event_relation = 'n1';
    this.sources = [];
    this.target = new Machine();
};

//{{--Clase Javascript que permite modelar un objeto con un único origen y destino--}}
var EventMachine = function EventMachine() {
    //this.event_relation = '11';
    this.source = new Machine();
    this.target = new Machine();
    this.payload = null;
};

//{{--Modelo Javascript para definir un objeto con los parámetros del formulario de Eventos--}}
var Machine = function Machine() {
    this.id = null;
    this.asset_id = null;
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
 * De un objeto Json, hace un parsing a un objeto Machine
 * @param json
 * @returns {Machine}
 */
function parseMachine(json) {
    var machine = new Machine();

    machine.id = json.id;
    machine.asset_id = json.asset_id;
    machine.protocol = json.protocol;
    machine.ipv4 = json.ipv4;
    machine.port = json.port;
    machine.os = json.os;
    machine.mac = json.mac;
    machine.location = json.location_id;
    machine.location_name = json.location_name;
    machine.type = json.machine_type_id;
    machine.blacklist = json.blacklist;
    machine.hide = json.hide;

    return machine;
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
 * En este objeto tipo arreglo se almacenan los objetos tipo Event* (1n,n1,11)
 * @type {Array}
 */
var events = [];


/**
 * Agrega un nuevo evento al DOM
 * @param event_relation
 * @param src
 * @param tar
 */
function addEvent(event_relation, src, tar) {
    var source = parseMachine(src); //Máquina Origen
    var target = parseMachine(tar); //Máquina Destino
    var event; //Evento que relaciona ambos
    var found = false; //Bandera que almacena si se encontró en el arreglo de eventos uno similar

    if (event_relation === '11') { //Si es una relación 11
        event = new EventMachine();
        event.source = source;
        event.target = target;
        event.event_relation = event_relation;
        events.push(event);

        addPreviewRow(event);
    } else if (event_relation === '1n') {
        event = new EventMultiTarget();
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
            addMultitargetPreviewRow(event);
        }
        //Agregamos el target
        event.targets.push({target: target});
        addTargetToSourcePreview(event, target);
    } else if (event_relation === 'n1') {
        event = new EventMultiSource();
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
            addMultisourcePreviewRow(event);
        }
        //Agregamos el source
        event.sources.push({source: source});
        addSourceToTargetPreview(event, source);
    }
}