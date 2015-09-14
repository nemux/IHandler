<div class="btn-group btn-toolbar" style="margin-bottom: 10px;">
    <a href="#modal-page-form" class="btn btn-sm btn-default" data-toggle="modal"><i class="fa fa-plus"></i>
        Agregar</a>
</div>
<div class="table-responsive">
    <table id="data-table-pages" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Tipo</th>
            <th>URL</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->pages as $page)
            <tr>
                <td>{{$page->id}}</td>
                <td>{{$page->type->type}}</td>
                <td><a target="_blank" href="{{$page->url}}">{{$page->url}}</a></td>
                <td><a href="{{route('edit-page',['id'=>$page->id])}}" class="btn btn-sm btn-info">Editar</a></td>
            </tr>
        @endforeach()
        </tbody>
    </table>
</div>


<div class="modal fade" id="modal-page-form">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Agregar nuevo activo</h4>
            </div>
            {{Form::model(new CustomerPage(),['id'=>'page-form','role'=>'form','class'=>'form-horizontal form-bordered','data-parsley-validate'=>'true','name'=>'page-form','enctype'=>'multipart/form-data'])}}
            {{Form::hidden('customer_id',$customer->id)}}
            <div class="modal-body">

                @include('customer.pages._form')

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
    $(document).on('submit', '#page-form', function (event) {
        event.preventDefault();

        var inserted = submitForm('/customer/store/page', $(this).serialize(), '#page-form', '#modal-page-form');

        if (inserted != null) {
            var table = $('#data-table-pages').DataTable();

            console.log(inserted);

            var dataInsert = [inserted.id, inserted.type, '<a target="_blank" href="' + inserted.url + '">' + inserted.url + "</a>"];

            console.log(dataInsert);
            table.row.add(dataInsert).draw();
        }

        return false;
    });
</script>