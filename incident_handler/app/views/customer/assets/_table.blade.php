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

        var postData = $(this).serialize();
        $.ajax({
            url: '/customer/store/asset',
            type: 'POST',
            data: postData,
            success: function (data) {
                mensaje = data.message;
                if (data.errores != null) {
                    mensaje += "<ul>";
                    $.each(data.errores, function (key, value) {
                        mensaje += '<li>' + value + '</li>';
                    });
                    mensaje += "</ul>";
                }


                $.gritter.add({
                    title: "Mensaje del servidor",
                    text: mensaje,
                    sticky: false,
                    time: ""
                });

                if (data.asset != null) {
                    $("#asset-form")[0].reset(); //Resetea el formulario
                    $('#modal-asset-form').modal('hide'); //Ocultamos el modal
                    // Agrega la fila recibida a la tabla
                    $('#data-table-assets tr:last').after('<tr><td>' + data.asset.id + '</td><td>' + data.asset.domain_name + '</td><td>' + data.asset.ip + '</td></tr>');
                }
            },
            error: function (xhr) {
                var rText = $.parseJSON(xhr.responseText);
                $.gritter.add({
                    title: "Mensaje del servidor",
                    text: "Ocurrió un error con la petición: " + rText.error.message,
                    sticky: false,
                    time: ""
                });
            }
        });
        return false;
    })
</script>