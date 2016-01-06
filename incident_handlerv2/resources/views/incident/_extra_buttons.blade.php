<script type="text/javascript">
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

    /**
     * Muestra el diálogo del Modal para la Observación
     */
    function showObservationForm() {
        $('#modal-form-note').modal('show', {backdrop: 'fade'});
    }

    /**
     * Muestra el diálogo del Modal para la recomendación
     */
    function showRecommendationForm(){
        $('#modal-form-recommendation').modal('show', {backdrop: 'fade'});
    }

    $(document).ready(function () {
        console.log('ready');
        $("#fp-files").change(function () {
            console.log('changed fp-evidences');
            var input = document.getElementById('fp-files');
            var count_files = input.files.length;
            if (count_files > 0) {
                $("#fp-submit").attr('disabled', false);
                $("#fp-filechooser").text(count_files + ' archivos seleccionados');
            } else {
                $("#fp-submit").attr('disabled', true);
                $("#fp-filechooser").text('Seleccionar evidencia');
            }
        });

        $('form#fp-form').submit(function (e) {
            var countFiles = document.getElementById('fp-files').files.length;
            if (countFiles === 0) {
                alert('Se deben agregar archivos como evidencia para cambiar el caso a Falso Positivo');
                return false;
            }
        });
    });
</script>

<div id="status-buttons">
    @if($case->ticket->ticket_status_id==1){{--Sin ticket o Abierto--}}
    <div class="btn btn-success" onclick="changeStatus(this,'{{$case->id}}',2)">
        Mover a Investigación
    </div>

    {!! Form::open(array('id'=>'fp-form','class' => 'form-inline', 'method' => 'POST', 'route' => array('incident.change.status'),'enctype'=>'multipart/form-data' )) !!}
    <input type="file" id="fp-files" name="fp-files[]" multiple style="display:none">
    <input type="hidden" name="status" value="5">
    <input type="hidden" name="id" value="{{$case->id}}">

    <div id="fp-filechooser" class="btn btn-primary" onclick="$('#fp-files').click();">
        Seleccionar evidencia
    </div>
    <input id="fp-submit" disabled="true" type="submit" class="btn btn-info" value="Mover a Falso Positivo">
    {!! Form::close() !!}

    @elseif($case->ticket->ticket_status_id===2){{--De Investigación--}}
    <div class="btn btn-success" onclick="changeStatus(this,'{{$case->id}}',3)">
        Mover a Resuelto
    </div>
    {!! Form::open(array('id'=>'fp-form','class' => 'form-inline', 'method' => 'POST', 'route' => array('incident.change.status'),'enctype'=>'multipart/form-data' )) !!}
    <input type="file" id="fp-files" name="fp-files[]" multiple style="display:none">
    <input type="hidden" name="status" value="5">
    <input type="hidden" name="id" value="{{$case->id}}">

    <div id="fp-filechooser" class="btn btn-primary" onclick="$('#fp-files').click();">
        Seleccionar evidencia
    </div>
    <input id="fp-submit" disabled="true" type="submit" class="btn btn-info" value="Mover a Falso Positivo">
    {!! Form::close() !!}
    <input class="btn btn-default " type="file" id="evidences" name="evidences[]" multiple style="display:none">
    @elseif($case->ticket->ticket_status_id===3){{--De Resuelto--}}
    {!! Form::open(array('id'=>'fp-form','class' => 'form-inline', 'method' => 'POST', 'route' => array('incident.change.status'),'enctype'=>'multipart/form-data' )) !!}
    <input type="file" id="fp-files" name="fp-files[]" multiple style="display:none">
    <input type="hidden" name="status" value="4">
    <input type="hidden" name="id" value="{{$case->id}}">

    <div id="fp-filechooser" class="btn btn-primary" onclick="$('#fp-files').click();">
        Seleccionar evidencia
    </div>
    <input id="fp-submit" disabled="true" type="submit" class="btn btn-info" value="Cerrar el caso">
    {!! Form::close() !!}
    @endif
</div>
<div id="other-buttons">

    @if($case->ticket->ticket_status_id==1 || $case->ticket->ticket_status_id==2)
        {{--Abierto o Investigación--}}
        <div class="btn btn-info" onclick="showAnnexForm()">Agregar Anexo</div>
        <div class="btn btn-info" onclick="showObservationForm()">Agregar Observación</div>
        <div class="btn btn-info" onclick="showRecommendationForm()">Agregar Recommendación</div>

    @elseif($case->ticket->ticket_status_id==3)
        {{--Resuelto--}}
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
            {!! Form::model(new \Models\IncidentManager\Incident\Annex(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-asset','url'=>route('incident.annex.store')]) !!}
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
            {!! Form::model(new \Models\IncidentManager\Incident\Note(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-asset','url'=>route('incident.note.store')]) !!}
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

{{--Modal Form Recommendation--}}
<div aria-hidden="false" class="modal custom-width fade in" id="modal-form-recommendation">
    {{--<div class="modal-backdrop fade in"></div>--}}
    <div class="modal-dialog" style="width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Agregar una recomendación al caso</h4>
            </div>
            {!! Form::model(new \Models\IncidentManager\Incident\Recommendation(),['class'=>'form-horizontal','role'=>'form','id'=>'form-customer-asset','url'=>route('incident.recommendation.store')]) !!}
            {!! Form::hidden('incident_id',$case->id) !!}
            <div class="modal-body">
                @include('incident.recommendation._form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                {!! Form::submit('Guardar',['class'=>'btn btn-blue']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>