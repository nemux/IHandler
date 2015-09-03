<div class="table-responsive">
    <table id="data-table-pages" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Tipo</th>
            <th>URL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customer->pages as $page)
            <tr title="{{$page->comments}}">
                <td>{{$page->id}}</td>
                <td>{{$page->type->type}}</td>
                <td><a href="{{$page->url}}">{{$page->url}}</a></td>
            </tr>
        @endforeach()
        </tbody>
    </table>
</div>