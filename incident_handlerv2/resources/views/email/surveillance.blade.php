@if($extra_info!='')
    <h3>El Equipo de Cibervigilancia de <strong>Global Cybersec</strong> agregó información adicional al caso:
        <strong>{{$surv->title}}</strong>
    </h3>

    <p>{{$extra_info}}</p>
@else

    <h3>El Equipo de Cibervigilancia de Global Cybersec realiza el siguiente reporte referente al siguiente
        caso: <strong>{{$surv->title}}</strong>
    </h3>
@endif

<p>
    Se adjunta el reporte del caso y las evidencias.
</p>