<select class="form-control" id="{{$id}}" name="{{isset($multiple) && $multiple?$id.'[]':$id}}" {{isset($multiple) && $multiple?'multiple':''}}>
    <option></option>
    @foreach(\App\Models\Catalog\Criticity::all('name','id') as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
    @endforeach
</select>
<script type="text/javascript">
    $(document).ready(function () {
        $('#' + '{{$id}}').select2({
            placeholder: 'Severidad...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
    });
</script>