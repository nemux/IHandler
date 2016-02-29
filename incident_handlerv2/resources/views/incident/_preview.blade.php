<script type="text/javascript">
    function enableBlacklist() {
        var count = document.getElementById('pv-blacklist').getElementsByTagName("tr").length;
        if (count > 0)
            document.getElementById('blacklist-section').style.visibility = 'visible';
    }

    //    /**
    //     * Agrega una vista previa de un payload
    //     */
    //    function addPayloadPreview(event) {
    //        var payload_row = $('<tr  id="pv-payload-row-' + events.indexOf(event) + '">><td class="content_column align-justify" colspan="2">' +
    //                '<h4>Origen: <strong>' + event.source + '</strong> Destino: <strong>' + event.target + '</strong></h4>' +
    //                '<pre>' + event.payload + '</pre>' +
    //                '</td></tr>');
    //
    //        var payload_cont = $('#payload_cont');
    //
    //        console.log(payload_cont);
    //    }

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

//        addPayloadPreview(event);
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

        //TODO add payloa dpreview
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

        //TODO add payloa dpreview
    }

    function addTargetToSourcePreview(event, target) {
        if (!target.hide)
            $('<li>' + target.ipv4 + '</li>').appendTo('#ul-targets-event-' + events.indexOf(event));

        if (target.blacklist) {
            var pv_blacklist = $('#pv-blacklist');
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + target.ipv4 + '</td><td>' + target.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }

        //TODO add payloa dpreview
    }

    function addSourceToTargetPreview(event, source) {
        if (!source.hide)
            $('<li>' + source.ipv4 + '</li>').appendTo('#ul-sources-event-' + events.indexOf(event));

        if (source.blacklist) {
            var pv_blacklist = $('#pv-blacklist');
            $('<tr class="new-bl-' + events.indexOf(event) + '"><td>' + source.ipv4 + '</td><td>' + source.location_name + '</td></tr>').appendTo(pv_blacklist);
            $('#blacklist-section').attr('style', 'visibility:visible;');
        }

        //TODO add payloa dpreview
    }
</script>
<style>
    table.incident, div.incident {
        color: black;
        text-align: center;
        width: 100%;
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

    div.title_column {
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
        color: white;
    }

    .criticity-2 {
        background-color: #ff7900;
        color: white;
    }

    .criticity-3 {
        background-color: #f7cc31;
        color: white;

    }

    .align-justify {
        text-align: justify;
    }

    .align-left {
        text-align: left;
    }

    .page-break {
        page-break-before: always;
    }

    pre{
        white-space: pre-wrap;
        font-size: 12px;

        display: block;
        padding: 8px;
        margin: 0 0 9px;
        line-height: 1.42857;
        word-break: break-all;
        word-wrap: break-word;
        color: #333;
        background-color: #F5F5F5;
        border: 1px solid #E4E4E4;
        border-radius: 0;
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
        <td class="content_column" id="pv-status">{{isset($case->ticket)?$case->ticket->status->name:'Abierto'}}</td>
    </tr>
    <tr>
        <td class="title_column">Categoría(s):</td>
        <td class="content_column">
            <ul class="nostyle" id="pv-categories">
                @foreach($case->categories as $category)
                    <li><b>{{$category->category->id-1}}</b>: {{$category->category->noCat() }}
                        ; {{$category->category->description}}</li>
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
            id="pv-detection-date">{{date('d/m/Y H:i T',strtotime(($case->id!=null)?$case->detection_time:'now'))}}</td>
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
{{--Anexos--}}
@if(count($case->annexes)>0)
    <div class="page-break"></div>
    <table class="incident" border="1">
        <tr>
            <td colspan="2" class="title_column"><h3><b>Anexos</b></h3></td>
        </tr>
        @foreach($case->annexes as $annex)
            <tr>
                <td class="title_column">{{$annex->title}}</td>
                <td class="content_column align-justify"><p><b>{{$annex->field}}</b></p>

                    <p>{!! $annex->content !!}</p>
                </td>
            </tr>
        @endforeach
    </table>
@endif
{{--Recomendaciones--}}
@if(count($case->recommendations)>0)
    <div class="page-break"></div>
    <table class="incident" border="1">
        <tr>
            <td colspan="2" class="title_column"><h3><b>Recomendaciones</b></h3></td>
        </tr>
        @foreach($case->recommendations as $recomm)
            <tr>
                <td class="title_column">
                    {{$recomm->created_at->format('d/m/Y')}}<br/>
                    {{$recomm->created_at->format('H:i:s T')}}
                </td>
                <td class="content_column align-justify">
                    <p>{!! $recomm->content !!}</p>
                </td>
            </tr>
        @endforeach
    </table>
@endif

@if(count($case->payloads)>0)
    <div class="page-break"></div>
    <div class="incident" border="1">
        <div>
            <div class="title_column"><h3><b>Payloads</b></h3></div>
        </div>
        @foreach($case->events as $event)
            @if($event->payload!= null && $event->payload!='')
                <div>
                    <div class="content_column align-justify" colspan="2">
                        <h4>Origen: <strong>{{$event->source}}</strong> Destino: <strong>{{$event->target}}</strong>
                        </h4>

                        <hr/>
                        @if(isset($isPdf) && $isPdf)
                            <pre class="align-left"
                                 style="font-size: 8pt;">{!! htmlspecialchars($event->payload) !!}</pre>
                        @else
                            <pre class="align-left">{!! htmlspecialchars($event->payload) !!}</pre>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif