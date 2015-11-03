<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#incidents-table").dataTable({
            aoColumns: [
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
        <th>Cliente</th>
        <th>Titulo</th>
        <th>Detección</th>
        <th>Usuario</th>
    </tr>
    </thead>
    <tbody class="middle-align">
    @foreach($incidents as $index=>$incident)
        <tr style="cursor: pointer;" onclick="{window.open('{{route('incident.show',$incident->id)}}')}">
            <td>{{$incident->id}}</td>
            <td>{{isset($incident->ticket)?$incident->ticket:'Por asignar...'}}</td>
            <td>{{$incident->customer->name}}</td>
            <td>{{$incident->title}}</td>
            <td>{{$incident->detection_time}}</td>
            <td>{{$incident->user->username}}</td>
        </tr>
    @endforeach
    </tbody>
</table>