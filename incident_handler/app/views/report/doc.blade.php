<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reporte generado por GCS-IM</title>
    <style media="screen">
        body{

            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
        }
        .wrapper{
            width:600px;
        }

        table, th, td {
            border: 1px solid black;
        }
        .max-width {
            width:700px;
        }
        img{
            width:700px;
            border-radius:6px;
            box-shadow: 10px 10px 5px #888888;
            margin-top:5px;
            margin-bottom:5px;
        }
        td {
            /* CSS 3 */
            white-space: -o-pre-wrap;
            word-wrap: break-word;
            white-space: pre-wrap;
            white-space: -moz-pre-wrap;
        }
    </style>
</head>
<body>
@if ( isset($body))
    <div>
        <p>{{ $body }} </p>
    </div>
    <br/>
@endif

@foreach($incidents as $incident)
    <div  style="margin-bottom:20px">
        <table class="max-width">
            <tr>
                <td colspan="3" style="text-align:center;background:#d9d9d9">
                    <strong>Incidente: {{ $incident->title }}</strong>
                </td>
            </tr>
            <tr style="">
                <td style="text-align:center;background:#d9d9d9" colspan="1">
                    <strong>Categoría:</strong>
                </td>
                <td style="border-collapse: collapse;width:100%" colspan="2">
                    <table style="border-collapse: collapse;width:100%">
                        <tr>
                            <td colspan="2" style="text-align:center;background:#d9d9d9;" width="100%">
                                Descripci&oacute;n
                            </td>
                        </tr>
                        <tr style="width:100%">
                            <td style="text-align:center;width:25%">
                                {{ ($incident->category->id)-1 }}
                            </td>
                            <td style="text-align: justify;">
                                {{ $incident->category->name }}
                                {{ $incident->category->description }}
                            </td>
                        </tr>
                        @foreach ($incident->extraCategory as $ec)
                        <tr style="width:100%">
                            <td style="text-align:center;width:25%">
                                {{ ($ec->category->id)-1 }}
                            </td>
                            <td style="text-align: justify;">
                                {{ $ec->category->name }}
                                {{ $ec->category->description }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;background:#d9d9d9">
                    <strong>Sensor:</strong>
                </td>
                <td colspan="2" style="text-align:center;padding:0px">

                    <table style="margin:0px;padding:0px;width:100%;border-collapse: collapse;border:none"  >
                        <tr style="border:none">
                            <td style="padding:4px;text-align:center;">
                                {{ $incident->sensor->name }}
                            </td>
                        </tr>
                        @foreach ($incident->extraSensor as $es)
                        <tr style="margin:0px;padding:0px;border:none">
                            <td style="margin:0px;padding:4px;text-align:center;">
                                {{ $es->sensor->name }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

            <tr>
                <td style="text-align:center;background:#d9d9d9;">
                    <strong>Ticket:</strong>
                </td>
                <td style="text-align:center;" colspan="2" width="100%">
                    @if (isset($incident->ticket->internal_number))
                        {{ $incident->ticket->internal_number }}
                    @else
                        {{ "Por asignar....."}}
                    @endif
                </td>
            </tr>

            <tr>
                <td style="text-align:center;background:#d9d9d9;">
                    <strong>Estatus:</strong>
                </td>
                <td style="text-align:center;" colspan="2" width="100%">
                    {{ $incident->status->name }}
                </td>
            </tr>
            <tr>
                <td style="text-align:center;background:#d9d9d9">
                    <strong>Indicador de Compromiso Inicial:</strong>
                </td>
                <td colspan="2" style="text-align:center" width="100%">
                    @foreach ($incident->incidentRule as $r )
                        {{ $r->rule->message }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td style="text-align:center;background:#d9d9d9">
                    <strong>Flujo del ataque:</strong>
                </td>
                <td colspan="2" style="text-align:center" width="100%">
                    {{ $incident->stream }}
                </td>
            </tr>
            <tr>
            <td style="text-align:center;background:#d9d9d9" >
                    <strong>Fecha de detecci&oacute;n:</strong>
                </td>
                <td colspan="2" style="text-align:center" width="100%">
                    {{ $report_info[$incident->id]['det_time']['datetime'] }}
                    {{ $report_info[$incident->id]['det_time']['zone'] }}
                </td>
            </tr>
            <tr>
                <td style="text-align:center;background:#d9d9d9">
                    <strong>Severidad:</strong>
                </td>
                {{-- */
                    $font="";
                    $color="";
                 /* --}}
                @if ($incident->criticity=="BAJA")
                     {{-- */
                     $color="#01DF3A";
                     $font="#000";
                     /* --}}
                @elseif($incident->criticity=="MEDIA")
                     {{-- */
                     $color="#F7FE2E";
                     $font="#000";
                     /* --}}
                @elseif($incident->criticity=="ALTA")
                     {{-- */
                     $color="#FE2E2E";
                     $font="#FFF";
                     /* --}}
                @endif
            <td style="background-color:{{ $color }};color:{{ $font }};text-align:center" colspan="2" width="100%">
                <div >
                    {{ $incident->criticity }}
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;background:#d9d9d9">
                <strong>Direcci&oacute;n IP de Origen:</strong>
            </td>
            <td colspan="2" style="text-align:center" width="100%">
                @foreach ($incident->srcDst as $ip)
                    @if($ip->src->ip!="" && $ip->src->show != false)
                        {{$ip->src->ip.'<br>' }}
                    @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td style="text-align:center;background:#d9d9d9">
                <strong>Direcci&oacute;n IP Destino:</strong>
            </td>
            <td colspan="2" style="text-align:center" width="100%">
                @foreach ($incident->srcDst as $ip)
                    @if($ip->dst->ip!="" && $ip->dst->show != false)
                        {{ $ip->dst->ip.'<br>'}}
                    @endif
                @endforeach

            </td>
        </tr>
        @if (count($incident['listed']) > 0)
        <tr>
            <td style="text-align:center;background:#d9d9d9">
                <strong>Blacklist:</strong>
            </td>
            <td colspan="2" width="100%">
                <table style="border-collapse:collapse;width:100%">
                    <tr>
                        <th style="text-align:center;background:#d9d9d9">
                            Direcci&oacute;n Ip
                        </th>
                        <th style="text-align:center;background:#d9d9d9">
                            País de Origen
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align:center">
                            {{-- */$count = 0;/* --}}
                                @foreach ($incident['listed'] as $l)
                                    {{-- */ $count++; /*--}}
                                    {{ $l->ip }}[{{ $count }}]<br>
                                @endforeach
                            </td>
                            <td style="text-align:center">
                                {{-- */ $count = 0; /*--}}
                                @foreach ($incident['location'] as $l)
                                    {{-- */ $count++; /* --}}
                                    @if (isset($l->location))
                                        {{$l->location }}
                                    @endif
                                    <br/>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @endif
            <tr>
                <td style="text-align:center;background:#d9d9d9" colspan="1">
                    <strong>Descripci&oacute;n:</strong>
                </td>
                <td colspan="2" style="text-align: justify; padding:10px;" width="100%">
                    {{ $incident->description }}<br>
                    {{ $incident->conclution }}
                </td>
            </tr>
            <tr>
                <td style="text-align:center;background:#d9d9d9">
                    <strong>Recomendaci&oacute;n:</strong>
                </td>
                <td colspan="2" style="text-align: justify; padding:10px;" width="100%">
                    {{ $incident->recomendation }} <br/>
                    @if (count($incident['recomendations']) > 0 )
                        @foreach($incident['recomendations'] as $r )
                            {{ "[".$r->created_at."]" }} <br/>
                            {{ $r->content }} <br/>
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr>
                <td style="text-align:center;background:#d9d9d9">
                    <strong>Referencia:</strong>
                </td>
                <td colspan="2" style="text-align: justify; padding:10px;" width="100%">
                    @if (isset($incident->reference->link))
                        {{ $incident->reference->link }}<br>
                    @endif
                </td>
            </tr>
        </table>
        @foreach ($incident->annexes as $a )
        <div class="col-lg-12" style="margin-bottom:20px;padding-top:20px">
            <div class="form-group" >
                <table class="max-width" style="table-layout: fixed;">
                    <tr style="text-align:center;background:#CCC;">
                        <td colspan="2">
                            <strong> {{ $a->title }} </strong>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;background:#CCC;width:15%">
                            {{ $a->field }}
                        </td>
                        <td>
                            {{ $a->content }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
    </div>
    <br/>
    <br/>
@endforeach


<div style="margin: 0px 20px; font-size: 80%; text-align: center; font-family: Helvetica,Arial,sans-serif;
            color: rgb(200, 0, 0);"><small style="font-family: Helvetica,Arial,sans-serif;">
        <big><strong>Informaci&oacute;n Confidencial</strong></big></small>
</div>

<div style="margin: 0px 20px; font-size: 80%; text-align: center; font-family: Helvetica,Arial,sans-serif;
            color: rgb(30, 144, 255);"><small style="font-family: Helvetica,Arial,sans-serif;">
        <strong>&copy; {{ date("Y") }} Global Cybersec</strong></small>
</div>
</body>
</html>
