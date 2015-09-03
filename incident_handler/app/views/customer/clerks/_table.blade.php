<div class="table-responsive">
    <table id="data-table-clerks" class="table table-striped table-bordered table-hover">
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