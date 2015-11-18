<script type="text/javascript">
    var opts = {
        "closeButton": true,
        "debug": true,
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

    function changeStatus(id, status) {

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

@if(!isset($case->ticket) || $case->ticket->ticket_status_id===1){{--Sin ticket o Abierto--}}
<button class="btn-sm btn-success" onclick="changeStatus('{{$case->id}}',2)">Mover a Investigación</button>
<button class="btn-sm btn-info" onclick="changeStatus('{{$case->id}}',5)">Mover a Falso Positivo</button>
@elseif($case->ticket->ticket_status_id===2){{--De Investigación--}}
<button class="btn-sm btn-success" onclick="changeStatus('{{$case->id}}',3)">Mover a Resuelto</button>
<button class="btn-sm btn-info" onclick="changeStatus('{{$case->id}}',5)">Mover a Falso Positivo</button>
@elseif($case->ticket->ticket_status_id===3){{--De Resuelto--}}
<button class="btn-sm btn-primary" onclick="changeStatus('{{$case->id}}',4)">Mover a Cerrado</button>
@endif