<div class="btn-group btn-toolbar" style="margin-bottom: 10px;">
    <a href="#asset-form" class="btn btn-sm btn-default" data-toggle="modal"><i class="fa fa-plus"></i> Agregar</a>
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

@include('customer.assets._form')