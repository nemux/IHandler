<div class="btn-group btn-toolbar" style="margin-bottom: 10px;">
    <a href="#modal-socialmedia-form" class="btn btn-sm btn-default" data-toggle="modal"><i class="fa fa-plus"></i>
        Agregar</a>
</div>
<div class="table-responsive">
    <table id="data-table-socialmedia" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Descripción</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->socialmedia as $sm)
            <tr>
                <td>{{$sm->id}}</td>
                <td>{{$sm->title}}</td>
                <td>{{substr($sm->description,0,150)}}@if(strlen($sm->description)>150)[...]@endif</td>
                <td><a href="{{route('edit-socialmedia',['id'=>$sm->id])}}" class="btn btn-sm btn-info">Editar</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-socialmedia-form">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Agregar un hallazgo en redes sociales</h4>
            </div>

            {{Form::model(new CustomerSocialmedia(),array('id'=>'socialmedia-form','role'=>'form','class'=>'form-horizontal form-bordered','name'=>'socialmedia-form', 'enctype'=>'multipart/form-data'))}}
            {{Form::hidden('customer_id',$customer->id)}}

            <div class="modal-body">

                @include('customer.socialmedia._form')

                <div class="form-group">
                    {{Form::submit('Guardar',['class'=>'btn btn-sm btn-success'])}}
                    {{Form::reset('Limpiar campos',['class'=>'btn btn-sm btn-default'])}}
                </div>
            </div>
            <div class="modal-footer">

            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

<script>
    $(document).on('submit', '#socialmedia-form', function (event) {
        event.preventDefault();

        var inserted = submitForm('/customer/store/socialmedia', $(this).serialize(), '#socialmedia-form', '#modal-socialmedia-form');

        if (inserted != null) {
            var table = $('#data-table-socialmedia').DataTable();

            var description = inserted.description.substring(0, 150);

            if (inserted.description.length > 150)
                description += "[...]";

            var dataInsert = [inserted.id, inserted.title, description];
            table.row.add(dataInsert).draw();

            var list = $("#files_list");
            list.empty();
        }

        return false;
    });
</script>