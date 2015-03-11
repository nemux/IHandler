<?php
function cutWords($word){

  $aux=explode(" ",$word);
  foreach($aux as $a){
  	if(strlen($a)>75){
  		$new_array=str_split($a,74);
  		$new_word="";
  		foreach($new_array as $na){
  			$new_word=$new_word.$na."\n";
  		}
  		$word=str_replace($a,$new_word,$word);
  	}
  }
  return $word;
}
function cleanWords($word){
  /*$word=str_replace("<br>","\n",$word);
  $word=str_replace("</br>","\n",$word);
  $word=str_replace("</li>","</li>\n",$word);
  $word=str_replace("</span>","</span>\n",$word);*/
  return $word;
}

function cleanContent($content){
  $content=cleanWords($content);
  $content=cutWords($content);
  return $content;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reporte generado por GCS-IM</title>
    <style media="screen">
        body{

            font-family:Arial, Helvetica, sans-serif;
            font-size:12px;
            width:100px;
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
        <br>
    @endif

    <div style="width:100px">
      @foreach($incidents as $incident_tmp)
          {{--*/
           $incident = Incident::find($incident_tmp->id);
          /*--}}
          <div  style="margin-bottom:20px" style="width:100px">
              <table  >
                  <tr>
                      <td colspan="3" style="text-align:center;background:#d9d9d9">
                          <strong>Incidente: {{ $incident->title }}</strong>
                      </td>
                  </tr>
                  <tr style="">
                        <td rowspan="<?php echo count($incident->extraCategory)+2; ?>" style="text-align:center;background:#d9d9d9">
                          <strong>Categoría:</strong>
                        </td>

                        <td  style="text-align:center;background:#d9d9d9" colspan="2">
                          <strong>Descripci&oacute;n</strong>
                        </td>
                  </tr>
                  <tr>
                    <td style="text-align:center;width:20%">
                      {{ ($incident->category->id)-1 }}
                    </td>
                    <td>
                      {{ $incident->category->name }}
                      {{ $incident->category->description }}
                    </td>@if (count($incident['listed']) > 0)

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
              @endif

                  </tr>
                  @foreach ($incident->extraCategory as $ec)
                  <tr >
                      <td >
                          {{ ($ec->category->id)-1 }}
                      </td>
                      <td >
                          {{ cleanContent($ec->category->name) }}
                          {{ cleanContent($ec->category->description) }}
                      </td>
                  </tr>
                  @endforeach

                  <tr>
                      <td rowspan="<?php echo count($incident->extraSensor)+1; ?>" style="text-align:center;background:#d9d9d9">
                          <strong>Sensor:</strong>
                      </td>
                      <td colspan="2" style="text-align:center;">
                            {{ cleanContent($incident->sensor->name) }}

                      </td>
                  </tr>
                  @foreach ($incident->extraSensor as $es)
                  <tr style="margin:0px;padding:0px;border:none">
                      <td colspan="2">
                          {{ cleanContent($es->sensor->name) }}
                      </td>
                  </tr>
                  @endforeach

                  <tr>
                      <td style="text-align:center;background:#d9d9d9;">
                          <strong>Ticket:</strong>
                      </td>
                      <td style="text-align:center;" colspan="2" width="100%">
                          @if(isset( $incident->ticket->internal_number))
                              {{ cleanContent($incident->ticket->internal_number) }}
                          @else
                              {{ "Por asignar.." }}
                          @endif
                      </td>
                  </tr>

                  <tr>
                      <td style="text-align:center;background:#d9d9d9;">
                          <strong>Estatus:</strong>
                      </td>
                      <td style="text-align:center;" colspan="2" width="100%">
                          {{ cleanContent($incident->status->name) }}
                      </td>
                  </tr>
                  <tr>
                      <td style="text-align:center;background:#d9d9d9">
                          <strong>Indicador de Compromiso Inicial:</strong>
                      </td>
                      <td colspan="2" style="text-align:center" width="100%">
                          @foreach ($incident->incidentRule as $r )
                              {{ cleanContent($r->rule->message) }}<br>
                          @endforeach
                      </td>
                  </tr>
                  <tr>
                      <td style="text-align:center;background:#d9d9d9">
                          <strong>Flujo del ataque:</strong>
                      </td>
                      <td colspan="2" style="text-align:center" width="100%">
                          {{ cleanContent($incident->stream) }}
                      </td>
                  </tr>
                  <tr>
                        <td style="text-align:center;background:#d9d9d9" >
                            <strong>Fecha de detecci&oacute;n:</strong>
                        </td>
                        <td colspan="2" style="text-align:center">
                            {{ cleanContent($report_info[$incident->id]['det_time']['datetime']) }}
                            {{ cleanContent($report_info[$incident->id]['det_time']['zone']) }}
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
                  <td style="background-color:{{ $color }};color:{{ $font }};text-align:center" colspan="2" >

                          {{ cleanContent($incident->criticity) }}

                  </td>
              </tr>
              <tr>
                  <td style="text-align:center;background:#d9d9d9">
                      <strong>Direcci&oacute;n IP de Origen:</strong>
                  </td>
                  <td colspan="2" style="text-align:center" >
                    <?php $ips="" ?>
                      @foreach ($incident->srcDst as $ip)
                          @if($ip->src->ip!="" && $ip->src->show != false)
                              {{--*/ $ips=$ips.cleanContent($ip->src->ip).'<br>' /*--}}
                          @endif
                      @endforeach
                      {{ $ips }}
                  </td>
              </tr>

              <tr>
                  <td style="text-align:center;background:#d9d9d9">
                      <strong>Direcci&oacute;n IP Destino:</strong>
                  </td>
                  <td colspan="2" style="text-align:center">
                    <?php $ips="" ?>
                      @foreach ($incident->srcDst as $ip)
                          @if($ip->dst->ip!="" && $ip->dst->show != false)
                              {{--*/ $ips=$ips.cleanContent($ip->dst->ip).'<br>' /*--}}
                          @endif
                      @endforeach
                      {{ $ips }}

                  </td>
              </tr>

              <!--
              @if (count($report_info[$incident->id]['listed']) > 0)
              <tr>
                  <td style="text-align:center;background:#d9d9d9" >
                      <strong>Blacklist:</strong>
                  </td>
                  <td style="text-align:center;background:#d9d9d9;" >
                    <strong>Direcci&oacute;n Ip</strong>
                  </td>
                  <td style="text-align:center;background:#d9d9d9" >
                    <strong>País de Origen </strong>
                  </td>
              </tr>
              <tr>
                    <td style="text-align:center">
                      {{-- */$count = 0;/* --}}
                          @foreach ($report_info[$incident->id]['listed'] as $l)
                              {{-- */ $count++; /*--}}
                              {{ $l->ip }}[{{ $count }}]<br>
                          @endforeach
                      </td>
                      <td style="text-align:center">
                          {{-- */ $count = 0; /*--}}
                          @foreach ($report_info[$incident->id]['location'] as $l)
                              {{-- */ $count++; /* --}}
                              @if (isset($l->location))
                                  {{$l->location }}
                              @endif
                              <br/>
                          @endforeach
                      </td>
                </tr>
              @endif
            -->
              <tr>
                  <td style="text-align:center;background:#d9d9d9" >
                      <strong>Descripci&oacute;n:</strong>
                  </td>
                  <td colspan="2" >
                      {{ cleanContent($incident->description) }}<br>
                      {{ cleanContent($incident->conclution) }}
                  </td>
              </tr>

              <tr>
                  <td style="text-align:center;background:#d9d9d9">
                      <strong>Recomendaci&oacute;n:</strong>
                  </td>
                  <td colspan="2"  >
                      {{ cleanContent($incident->recomendation) }} <br/>
                      @if (count($report_info[$incident->id]['recomendations']) > 0 )
                          @foreach($report_info[$incident->id]['recomendations'] as $r )
                              {{ cleanContent("[".$r->created_at."]") }} <br/>
                              {{ cleanContent($r->content) }} <br/>
                          @endforeach
                      @endif
                  </td>
              </tr>

              <tr>
                  <td style="text-align:center;background:#d9d9d9">
                      <strong>Referencia:</strong>
                  </td>
                  <td colspan="2"  >
                    <div >
                      @if (isset($incident->reference->link))
                          {{ (cleanContent($incident->reference->link)); }}<br>
                      @endif
                    </div>
                  </td>
              </tr>


            </table><br>
              @foreach ($incident->annexes as $a )
              <div class="col-lg-12" >
                  <div class="form-group" >
                      <table style="table-layout: fixed;">
                          <tr style="text-align:center;background:#CCC;">
                              <td colspan="2">
                                  <strong> {{ cleanContent($a->title) }} </strong>
                              </td>
                          </tr>
                          <tr>
                              <td style="text-align:center;background:#CCC;">
                                  {{ cleanContent($a->field) }}
                              </td>
                              <td>
                                  {{ cleanContent($a->content) }}
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
    </div>
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
