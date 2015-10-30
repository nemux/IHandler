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
            <th></th>
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
                <td><a href="{{route('edit-employee',['id'=>$employee->id])}}" class="btn btn-sm btn-info">Editar</a>
                </td>
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
            {{Form::hidden('customer_id',$customer->id)}}
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

        var inserted = submitForm('/customer/store/employee', $(this).serialize(), '#employee-form', '#modal-employee-form');

        if (inserted != null) {
            var table = $('#data-table-employees').DataTable();
            var dataInsert = [inserted.id, inserted.name + ' ' + inserted.lastname, inserted.corp_email, inserted.personal_email, inserted.socialmedia];
            table.row.add(dataInsert).draw();
        }

        return false;
    });
</script>