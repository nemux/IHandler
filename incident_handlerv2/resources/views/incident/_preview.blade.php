<style>
    table.incident {
        color: black;
        text-align: center;
        width: 100%;
        font-size: 12pt;
        border-color: #AAA;
        border-width: 2px;
    }

    table.events {
        width: 100%;
        text-align: center;
    }

    td, th {
        padding: 10px;
        border-color: #AAA;
        border-width: 2px;
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
</style>
<table class="incident" border="">
    <tr class="title">
        <td colspan="2"><h1>Incidente: {{$case->title}}</h1></td>
    </tr>
    <tr>
        <td class="title_column">Número de Ticket:</td>
        <td class="content_column">#{{isset($case->ticket)?$case->ticket:'Por asignar...'}}</td>
    </tr>
    <tr>
        <td class="title_column">Estatus</td>
        <td class="content_column">{{isset($case->status)?$case->status:'Abierto'}}</td>
    </tr>
    <tr>
        <td class="title_column">Categoría(s):</td>
        <td class="content_column">
            <ul>
                @foreach($case->categories as $category)
                    <li>{{$category->category->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Sensor(es):</td>
        <td class="content_column">
            <ul>@foreach($case->sensors as $sensor)
                    <li>{{$sensor->sensor->name }}</li> @endforeach</ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Indicador(es) de Compromiso:</td>
        <td class="content_column">
            <ul>
                @foreach($case->signatures as $signature)
                    <li>{{$signature->signature->name }}</li>
                @endforeach
            </ul>
        </td>
    </tr>
    <tr>
        <td class="title_column">Flujo del Ataque:</td>
        <td class="content_column">{{$case->flow->name}}</td>
    </tr>
    <tr>
        <td class="title_column">Fecha de Detección:</td>
        <td class="content_column">{{date('d/m/Y H:i',strtotime($case->detection_time))}}</td>
    </tr>
    <tr>
        <td class="title_column">Severidad:</td>
        <td class="content_column">{{$case->criticity->name}}</td>
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
                <tbody>
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
        <td class="content_column" style="text-align: justify; padding:20px;">{!! $case->description !!}</td>
    </tr>
    <tr>
        <td class="title_column">Recomendación(es):</td>
        <td class="content_column" style="text-align: justify; padding:20px;">{!! $case->recommendation !!}</td>
    </tr>
    <tr>
        <td class="title_column">Referencia(s):</td>
        <td class="content_column" style="text-align: justify; padding:20px;">{!! $case->reference !!}</td>
    </tr>
</table>