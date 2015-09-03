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
        @foreach($customer->clerks as $clerk)
            <tr title="{{$clerk->comments}}">
                <td>{{$clerk->id}}</td>
                <td>{{$clerk->name}} {{$clerk->lastname}}</td>
                <td>{{$clerk->corp_email}}</td>
                <td>{{$clerk->personal_email}}</td>
                <td>{{$clerk->socialmedia}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>