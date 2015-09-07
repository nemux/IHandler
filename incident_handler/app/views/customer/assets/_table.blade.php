<div class="btn-group btn-toolbar" style="margin-bottom: 10px;">
    <a href="#modal-asset-form" class="btn btn-sm btn-default" data-toggle="modal"><i class="fa fa-plus"></i>
        Agregar</a>
</div>
<div class="table-responsive">
    <table id="data-table-assets" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre de dominio</th>
            <th>IP</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->assets as $asset)
            <tr title="{{$asset->comments}}">
                <td>{{$asset->id}}</td>
                <td>{{$asset->domain_name}}</td>
                <td>{{$asset->ip}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<div class="modal fade" id="modal-asset-form">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Agregar nuevo activo</h4>
            </div>
            {{Form::model(new CustomerAsset(),['id'=>'asset-form','role'=>'form','class'=>'form-horizontal form-bordered','data-parsley-validate'=>'true','name'=>'asset-form','enctype'=>'multipart/form-data'])}}
            <div class="modal-body">
                @include('customer.assets._form')

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
    $(document).on('submit', '#asset-form', function (event) {
        event.preventDefault();

        var inserted = submitForm('/customer/store/asset', $(this).serialize(), '#asset-form', '#modal-asset-form');

        if (inserted != null) {
            var table = $('#data-table-assets').DataTable();
            var dataInsert = [inserted.id, inserted.domain_name, inserted.ip];
            table.row.add(dataInsert).draw();
        }

        return false;
    });
</script>