<script type="text/javascript">
    function enableBlacklist() {
        var count = document.getElementById('pv-blacklist').getElementsByTagName("tr").length;
        if (count > 0)
            document.getElementById('blacklist-section').style.visibility = 'visible';
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
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + event.source.ipv4 + '</td><td>' + event.source.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }

        if (event.target.blacklist) {
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + event.target.ipv4 + '</td><td>' + event.target.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
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
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + event.source.ipv4 + '</td><td>' + event.source.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
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
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + event.target.ipv4 + '</td><td>' + event.target.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }
    }

    function addTargetToSourcePreview(event, target) {
        if (!target.hide)
            $('<li>' + target.ipv4 + '</li>').appendTo('#ul-targets-event-' + events.indexOf(event));

        if (target.blacklist) {
            var pv_blacklist = $('#pv-blacklist');
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + target.ipv4 + '</td><td>' + target.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }
    }

    function addSourceToTargetPreview(event, source) {
        if (!source.hide)
            $('<li>' + source.ipv4 + '</li>').appendTo('#ul-sources-event-' + events.indexOf(event));

        if (source.blacklist) {
            var pv_blacklist = $('#pv-blacklist');
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + source.ipv4 + '</td><td>' + source.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }
    }
</script>
<style>
    table.incident {
        color: black;
        text-align: center;
        width: 100%;
        /*font-size: 12pt;*/
        border-color: #AAA;
        border-width: 1px;
    }

    table.events {
        width: 100%;
        text-align: center;
    }

    td, th {
        padding: 5px;
        border-color: #AAA;
        border-width: 1px;
        text-align: center;
    }

    tr.title {
        background-color: #CCC;
    }

    td:first-child.title_column {
        width: 20%;
        background-color: #CCC;
        font-weight: bolder;
    }

    td:last-child.content_column {
        width: 80%;
    }

    p {
        color: black;
    }

    ul.nostyle, ol.nostyle {
        list-style-position: inside;
        list-style: none;
        padding: 0;
    }

    td:first-child.logo > img {
        max-height: 80px;
    }

    .criticity-1 {
        background-color: #CC3F44;
    }

    .criticity-2 {
        background-color: #ff7900;
    }

    .criticity-3 {
        background-color: #f7cc31;

    }
</style>
<table class="incident" border="1" onload="enableBlacklist()">
    <tr class="title">
        <td colspan="2"><h3>Incidente: <span id="pv-title">{{($case->id!=null)?$case->title:''}}</span></h3></td>
    </tr>
    <tr>
        <td class="title_column">Número de Ticket:</td>
        <td class="content_column"
            id="pv-ticket">{{isset($case->ticket->internal_number)?$case->ticket->internal_number:'Por asignar...'}}</td>
    </tr>
    <tr>
        <td class="title_column">Estatus</td>
        <td class="content_column" id="pv-status">{{isset($case->status)?$case->status:'Abierto'}}</td>
    </tr>
    <tr>
        <td class="title_column">Categoría(s):</td>
        <td class="content_column">
            <ul class="nostyle" id="pv-categories">
                @foreach($case->categories as $category)
                    <li>{{$category->category->noCat() }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Sensor(es):</td>
        <td class="content_column">
            <ul class="nostyle" id="pv-sensors">
                @foreach($case->sensors as $sensor)
                    <li>{{$sensor->sensor->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Indicador(es) de Compromiso:</td>
        <td class="content_column">
            <ul class="nostyle" id="pv-signatures">
                @foreach($case->signatures as $signature)
                    <li>{{$signature->signature->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Flujo del Ataque:</td>
        <td class="content_column" id="pv-flow">{{($case->id!=null)?$case->flow->name:''}}</td>
    </tr>
    <tr>
        <td class="title_column">Fecha de Detección:</td>
        <td class="content_column"
            id="pv-detection-date">{{date('d/m/Y H:i',strtotime(($case->id!=null)?$case->detection_time:'now'))}}</td>
    </tr>
    <tr>
        <td class="title_column">Severidad:</td>
        <td class="content_column criticity-{{($case->id!=null)?strtolower($case->criticity->id):''}}"
            id="pv-criticity">{{($case->id!=null)?$case->criticity->name:''}}</td>
    </tr>
    <tr>
        <td class="title_column">Eventos:</td>
        <td class="content_column" style="padding:0px;">
            <table class="events">
                <thead style="background-color: #CCC;">
                <tr>
                    <th>Origen</th>
                    <th>Destino</th>
                </tr>
                </thead>
                <tbody id="pv-events">
                @foreach($case->getGroupedEvents() as $index=>&$e)
                    @if($e['type']==='11')
                        <tr id="old-pv-{{$index}}">
                            <td>@if(!$e['source']->hide) {{$e['source']->asset->ipv4}} @endif</td>
                            <td>@if(!$e['target']->hide) {{$e['target']->asset->ipv4}} @endif</td>
                        </tr>
                    @elseif($e['type']==='1n')
                        <tr id="old-pv-{{$index}}">
                            <td>@if(!$e['source']->hide) {{$e['source']->asset->ipv4}} @endif</td>
                            <td>
                                <ul class="nostyle">
                                    @foreach($e['targets'] as &$t)
                                        <li>@if(!$t->hide) {{$t->asset->ipv4}} @endif</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @elseif($e['type']==='n1')
                        <tr id="old-pv-{{$index}}">
                            <td>
                                <ul class="nostyle">
                                    @foreach($e['sources'] as &$s)
                                        <li>@if(!$s->hide) {{$s->asset->ipv4}} @endif</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>@if(!$e['target']->hide) {{$e['target']->asset->ipv4}} @endif</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    <tr id="blacklist-section" style="visibility: {{$case->hasOneBlacklist()?'visible':'collapse'}};">
        <td class="title_column">Blacklist:</td>
        <td class="content_column" style="padding: 0px;">
            <table class="events">
                <thead style="background-color: #CCC;">
                <tr>
                    <th>Dirección IP</th>
                    <th>País de Origen</th>
                </tr>
                </thead>
                <tbody id="pv-blacklist">
                @foreach($case->getGroupedEvents() as $index=>&$e)
                    @if($e['type']==='11')
                        @if($e['source']->blacklist)
                            <tr class="old-bl-{{$index}}">
                                <td>{{$e['source']->asset->ipv4}}</td>
                                <td>{{isset($e['source']->location->name)?$e['source']->location->name:'S/D'}}</td>
                            </tr>
                        @endif
                        @if($e['target']->blacklist)
                            <tr class="old-bl-{{$index}}">
                                <td>{{$e['target']->asset->ipv4}}</td>
                                <td>{{isset($e['target']->location->name)?$e['target']->location->name:'S/D'}}</td>
                            </tr>
                        @endif
                    @elseif($e['type']==='1n')
                        @if($e['source']->blacklist)
                            <tr class="old-bl-{{$index}}">
                                <td>{{$e['source']->asset->ipv4}}</td>
                                <td>{{isset($e['source']->location->name)?$e['source']->location->name:'S/D'}}</td>
                            </tr>
                        @endif
                        @foreach($e['targets'] as &$t)
                            @if($t->blacklist)
                                <tr class="old-bl-{{$index}}">
                                    <td>{{$t->asset->ipv4}}</td>
                                    <td>{{isset($t->location->name)?$t->location->name:'S/D'}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @elseif($e['type']==='n1')
                        @if($e['target']->blacklist)
                            <tr class="old-bl-{{$index}}">
                                <td>{{$e['target']->asset->ipv4}}</td>
                                <td>{{isset($e['target']->location->name)?$e['target']->location->name:'S/D'}}</td>
                            </tr>
                        @endif
                        @foreach($e['sources'] as &$s)
                            @if($s->blacklist)
                                <tr class="old-bl-{{$index}}">
                                    <td>{{$s->asset->ipv4}}</td>
                                    <td>{{isset($s->location->name)?$s->location->name:'S/D'}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td class="title_column">Descripción:</td>
        <td class="content_column" style="text-align: justify; padding:20px;"
            id="pv-description">{!! $case->description !!}</td>
    </tr>
    <tr>
        <td class="title_column">Recomendación(es):</td>
        <td class="content_column" style="text-align: justify; padding:20px;"
            id="pv-recommendation">{!! $case->recommendation !!}</td>
    </tr>
    <tr>
        <td class="title_column">Referencia(s):</td>
        <td class="content_column" style="text-align: justify; padding:20px;"
            id="pv-reference">{!! $case->reference !!}</td>
    </tr>
</table>