<select class="form-control" id="{{$id}}" name="{{$id}}">
    <option></option>
    <option value="source">Origen</option>
    <option value="target">Destino</option>
</select>
<script type="text/javascript">
    $(document).ready(function () {
        $('#' + '{{$id}}').select2({
            placeholder: 'Punto del ataque...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
    });
</script>