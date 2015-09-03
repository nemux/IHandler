<div class="table-responsive">
    <table id="data-table-socialmedia" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Link</th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->socialmedia as $sm)
            <tr title="{{$sm->description}}">
                <td>{{$sm->id}}</td>
                <td><a target="_blank" href="{{$sm->reference}}">{{$sm->reference}}</a></td>
                <td>{{$sm->description}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>