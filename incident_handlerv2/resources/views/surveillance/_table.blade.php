<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $("#surveillance-table").dataTable({
            aoColumns: [
                null,
                null,
                null,
                null,
                null
            ],
        });
    });
</script>
<div class="panel-body">
    <table class="table table-bordered table-striped" id="surveillance-table">
        <thead>
        <tr>
            <th># Caso</th>
            <th>Título</th>
            <th>Cliente</th>
            <th>Criticidad</th>
            <th></th>
        </tr>
        </thead>
        <tbody class="middle-align">
        @foreach($cases as $index=>$case)
            <tr>
                <td>{{$index+1}}</td>
                <td>{{$case->title}}</td>
                <td>{{$case->customer->name}}</td>
                <td>{{$case->criticity->name}}</td>
                <td>
                    <a href="{{route('surveillance.show',$case->id)}}"
                       class="btn btn-info btn-sm btn-icon icon-left">
                        Ver caso</a>
                    <a href="{{route('surveillance.edit',$case->id)}}"
                       class="btn btn-secondary btn-sm btn-icon icon-left"> Editar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>