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

    function showAnnexForm() {
        $('#modal-form-annex').modal('show', {backdrop: 'fade'});
    }

    function showObservationForm() {
        $('#modal-form-note').modal('show', {backdrop: 'fade'});
    }
</script>

<div id="status-buttons">
    @if(!isset($case->ticket) || $case->ticket->ticket_status_id===1){{--Sin ticket o Abierto--}}
    <div class="btn btn-success" onclick="changeStatus(this,'{{$case->id}}',2)">
        Mover a Investigación
    </div>
    <div class="btn btn-info" onclick="changeStatus(this,'{{$case->id}}',5)">
        Mover a Falso Positivo
    </div>
    @elseif($case->ticket->ticket_status_id===2){{--De Investigación--}}
    <div class="btn btn-success" onclick="changeStatus(this,'{{$case->id}}',3)">
        Mover a Resuelto
    </div>
    <div class="btn btn-info" onclick="changeStatus(this,'{{$case->id}}',5)">
        Mover a Falso Positivo
    </div>
    @elseif($case->ticket->ticket_status_id===3){{--De Resuelto--}}
    <div class="btn btn-primary" onclick="changeStatus(this,'{{$case->id}}',4)">
        Mover a Cerrado
    </div>
    @endif
</div>
<div id="other-buttons">
    @if($case->ticket->ticket_status_id===1)
        <div class="btn btn-info" onclick="showAnnexForm()">Agregar Anexo</div>
        <div class="btn btn-info" onclick="showObservationForm()">Agregar Observación</div>
    @elseif($case->ticket->ticket_status_id===2)
        <div class="btn btn-info" onclick="showAnnexForm()">Agregar Anexo</div>
        <div class="btn btn-info" onclick="showObservationForm()">Agregar Observación</div>
    @elseif($case->ticket->ticket_status_id===3)
        <div class="btn btn-info" onclick="showObservationForm()">Agregar Observación</div>
    @endif
</div>
{{--Modal Form Annex--}}
<div aria-hidden="false" class="modal custom-width fade in" id="modal-form-annex">
    {{--<div class="modal-backdrop fade in"></div>--}}
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar un anexo al caso</h4>
            </div>
            {!! Form::model(new \App\Models\Incident\Annex(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-asset','url'=>route('incident.annex.store')]) !!}
            {!! Form::hidden('incident_id',$case->id) !!}
            <div class="modal-body">
                @include('incident.annex._form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                {!! Form::submit('Guardar',['class'=>'btn btn-blue']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
{{--Modal Form Note--}}
<div aria-hidden="false" class="modal custom-width fade in" id="modal-form-note">
    {{--<div class="modal-backdrop fade in"></div>--}}
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar una observación al caso</h4>
            </div>
            {!! Form::model(new \App\Models\Incident\Note(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-asset','url'=>route('incident.note.store')]) !!}
            {!! Form::hidden('incident_id',$case->id) !!}
            <div class="modal-body">
                @include('incident.note._form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                {!! Form::submit('Guardar',['class'=>'btn btn-blue']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>