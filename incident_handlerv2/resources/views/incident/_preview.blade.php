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
    }
</style>
<table class="incident" border="1">
    <tr class="title">
        <td colspan="2"><h3>Incidente: <span id="pv-title">{{$case->title}}</span></h3></td>
    </tr>
    <tr>
        <td class="title_column">Número de Ticket:</td>
        <td class="content_column" id="pv-ticket">#{{isset($case->ticket)?$case->ticket:'Por asignar...'}}</td>
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
                    <li><i>•</i> {{$category->category->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Sensor(es):</td>
        <td class="content_column">
            <ul class="nostyle" id="pv-sensors">
                @foreach($case->sensors as $sensor)
                    <li><i>•</i> {{$sensor->sensor->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Indicador(es) de Compromiso:</td>
        <td class="content_column">
            <ul class="nostyle" id="pv-signatures">
                @foreach($case->signatures as $signature)
                    <li><i>•</i> {{$signature->signature->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Flujo del Ataque:</td>
        <td class="content_column" id="pv-flow">{{isset($case->flow)?$case->flow->name:''}}</td>
    </tr>
    <tr>
        <td class="title_column">Fecha de Detección:</td>
        <td class="content_column"
            id="pv-detection-date">{{date('d/m/Y H:i',strtotime(isset($case->detection_time)?$case->detection_time:'now'))}}</td>
    </tr>
    <tr>
        <td class="title_column">Severidad:</td>
        <td class="content_column" id="pv-criticity">{{isset($case->criticity)?$case->criticity->name:''}}</td>
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
                @foreach($case->events as $event)
                    <tr>
                        <td>{{$event->source->ipv4}}</td>
                        <td>{{$event->target->ipv4}}</td>
                    </tr>
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