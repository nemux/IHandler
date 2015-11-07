<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#incidents-table").dataTable({
            aoColumns: [
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ],
        });
    });
</script>
<table class="table table-bordered table-striped" id="incidents-table">
    <thead>
    <tr>
        <th>ID</th>
        <th># Ticket</th>
        <th>Título</th>
        <th>Indicadores</th>
        <th>Detección</th>
        <th>Sensores</th>
        <th>Status</th>
        <th>Handler</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($incidents as $index=>$incident)
        <tr style="cursor: pointer;" onclick="{window.open('{{route('incident.show',$incident->id)}}')}">
            <td>{{$incident->id}}</td>
            <td>{{isset($incident->ticket)?$incident->ticket:'Por asignar...'}}</td>
            <td>{{$incident->title}}</td>
            <td>{!! $incident->signatures_list() !!}</td>
            <td>{{date('d/m/Y H:i',strtotime($incident->detection_time))}}</td>
            <td>{!! $incident->sensors_list() !!}</td>
            <td>{{isset($incident->status)?$incident->status:'Abierto'}}</td>
            <td>{{$incident->user->username}}</td>
        </tr>
    @endforeach
    </tbody>
</table>