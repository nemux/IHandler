@if($extra_info!='')
    <h3>El Equipo de Respuesta a Incidentes de <strong>Global Cybersec</strong> agregó información adicional al ticket
        <strong>{{$incident->ticket->internal_number}}</strong>
    </h3>

    <p>{{$extra_info}}</p>
@else

    <h3>El Equipo de Respuesta a Incidentes de Global Cybersec realiza el siguiente reporte referente al siguiente
        incidente: {{$incident->title}}</h3>
@endif

<p>
    Se adjunta el reporte del caso y las evidencias.
</p>