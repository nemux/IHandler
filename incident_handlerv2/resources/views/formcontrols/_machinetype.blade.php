<select class="form-control" id="{{$id}}" name="{{$id}}">
    <option></option>
    @foreach(\Models\IncidentManager\Incident\MachineType::all('name','id') as $machinetype)
        <option value="{{$machinetype->id}}">{{ucfirst($machinetype->name)}}</option>
    @endforeach
</select>
<script type="text/javascript">
    $(document).ready(function () {
        $('#' + '{{$id}}').select2({
            placeholder: 'Ubicación...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
    });
</script>