<div class="btn-group btn-toolbar" style="margin-bottom: 10px;">
    <a href="#modal-employee-form" class="btn btn-sm btn-default" data-toggle="modal"><i class="fa fa-plus"></i>
        Agregar</a>
</div>
<div class="table-responsive">
    <table id="data-table-employees" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Correo corporativo</th>
            <th>Correo personal</th>
            <th>Redes sociales</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->employees as $employee)
            <tr title="{{$employee->comments}}">
                <td>{{$employee->id}}</td>
                <td>{{$employee->name}} {{$employee->lastname}}</td>
                <td>{{$employee->corp_email}}</td>
                <td>{{$employee->personal_email}}</td>
                <td>{{$employee->socialmedia}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-employee-form">
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">Agregar nuevo personal</h4>
            </div>
            {{Form::model(new CustomerEmployee(),['id'=>'employee-form','role'=>'form','class'=>'form-horizontal form-bordered','data-parsley-validate'=>'true','name'=>'employee-form','enctype'=>'multipart/form-data'])}}
            <div class="modal-body">
                @include('customer.employees._form')

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
    $(document).on('submit', '#employee-form', function (event) {
        event.preventDefault();

        var postData = $(this).serialize();
        $.ajax({
            url: '/customer/store/employee',
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

                if (data.employee != null) {
                    $("#employee-form")[0].reset(); //Resetea el formulario
                    $('#modal-employee-form').modal('hide'); //Ocultamos el modal
                    // Agrega la fila recibida a la tabla

                    var row = '<tr title="' + data.employee.comments + '">' +
                            '<td>' + data.employee.id + '</td>' +
                            '<td>' + data.employee.name + ' ' + data.employee.lastname + '</td>' +
                            '<td>' + data.employee.corp_email + '</td>' +
                            '<td>' + data.employee.personal_email + '</td>' +
                            '<td>' + data.employee.socialmedia + '</td>' +
                            '</tr>';

                    console.log(data.employee);
                    console.log(row);

                    $('#data-table-employees tr:last').after(row);
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
    });
</script>