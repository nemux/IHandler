<select class="form-control" id="{{$id}}" name="{{$id}}">
    <option></option>
</select>
<script type="text/javascript">
    $(document).ready(function () {
        $('#' + '{{$id}}').select2({
            placeholder: 'Sensor...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });


        $('#' + '{{$customer_id}}').change(function () {
            /**
             * Obtiene de un WS los sensores relacionados al cliente seleccionado en el combo box
             */
            var customer_id = $(this).find('option:selected').attr('value');

            if (!customer_id) {
                $('#' + '{{$id}}').select2("val", "").empty();
                return;
            }

            $.ajax({
                url: '/dashboard/ws/sensors/' + customer_id,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (result) {
                    var sensorSelect=$('#' + '{{$id}}');
                    sensorSelect.select2("val", "").empty();

                    if (result.status === true) {
                        sensorSelect.append($('<option>'));
                        $.each(result.sensors, function (i, item) {
                           sensorSelect.append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                    }
                },
                fail: function (result) {
                    console.log(result);
                }
            });

        })
    });
</script>