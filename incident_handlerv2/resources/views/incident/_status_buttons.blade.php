<script type="text/javascript">
    var opts = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-full-width",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    function changeStatus(button, id, status) {
        $('#status-buttons').remove();
        if (id && status) {
            console.log(id + " " + status);
            $.ajax({
                url: '{{route('incident.change.status')}}',
                type: 'post',
                dataType: 'json',
                data: {
                    id: id,
                    status: status
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (result) {
                    if (result.status) {
                        toastr.success(result.message, null, opts);

                        //Esperamos 5 segundos para recargar la página
                        setTimeout(function () {
                            location.reload();
                        }, 5000);
                    } else {
                        toastr.warning(result.message, 'No se puede realizar la petición.', opts);
                    }

                },
                failed: function (result) {
                    toastr.error(result.message, "Algo salió mal", opts);
                }
            });
        } else {
            toastr.warning("Faltan parámetros en la petición.", 'No se puede realizar la petición.', opts);
        }
    }
</script>

<div id="status-buttons" class="row">
    @if(!isset($case->ticket) || $case->ticket->ticket_status_id===1){{--Sin ticket o Abierto--}}
    <div class="btn btn-success" onclick="changeStatus(this,'{{$case->id}}',2)">Mover a
        Investigación
    </div>
    <div class="btn btn-info" onclick="changeStatus(this,'{{$case->id}}',5)">Mover a Falso Positivo</div>
    @elseif($case->ticket->ticket_status_id===2){{--De Investigación--}}
    <div class="btn btn-success" onclick="changeStatus(this,'{{$case->id}}',3)">Mover a Resuelto
    </div>
    <div class="btn btn-info" onclick="changeStatus(this,'{{$case->id}}',5)">Mover a Falso Positivo</div>
    @elseif($case->ticket->ticket_status_id===3){{--De Resuelto--}}
    <div class="btn btn-primary" onclick="changeStatus(this,'{{$case->id}}',4)">Mover a Cerrado</div>
    @endif
</div>