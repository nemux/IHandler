<script type="text/javascript">
    $(document).ready(function ($) {
        $("#customer_id").select2({
            placeholder: 'Selecciona un cliente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#criticity_id").select2({
            placeholder: 'Selecciona la criticidad...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var descriptionField = CKEDITOR.replace('description');
        var recommendationField = CKEDITOR.replace('recommendation');

        $("#title").blur(function () {
            var value = $(this).val();
            $('#preview-title').text(value);
        });
        $("#customer_id").change(function () {
            var value = $("#customer_id option:selected").text();
            $('#preview-customer_id').text(value);
        });
        $("#criticity_id").change(function () {
            var value = $("#criticity_id option:selected").text();
            $('#preview-criticity_id').text(value);
        });

        descriptionField.on('blur', function (evt) {
            $('#preview-description').html(evt.editor.getData());
        });
        recommendationField.on('blur', function (evt) {
            $('#preview-recommendation').html(evt.editor.getData());
        });
    });

    /**
     * Validate form fields
     */
    $(document).ready(function () {
        $('#surveillance-form').validate({
            rules: {
                title: 'required',
                customer_id: 'required',
                criticity_id: 'required',
                description: 'required'
            },
            messages: {
                title: 'El campo de título es obligatorio',
                customer_id: 'Selecciona un Cliente',
                criticity_id: 'Selecciona una Criticidad',
                description: 'El campo de descripción es obligatorio'
            }
        });
    });
</script>
<ul class="tabs">
    <li class="active"><a href="#surveillance-basic-tab" data-toggle="tab">Datos básicos</a></li>
    <li><a href="#surveillance-evidences-tab" data-toggle="tab">Evidencias</a></li>
    <li><a href="#surveillance-description-tab" data-toggle="tab">Descripción</a></li>
    <li><a href="#surveillance-recommendation-tab" data-toggle="tab">Recomendaciones</a></li>
    <li><a href="#surveillance-save-tab" data-toggle="tab">Previsualizar y Guardar</a></li>
</ul>
<div class="progress-indicator">
    <span></span>
</div>
<div class="tab-content">
    <div class="tab-pane active" id="surveillance-basic-tab">
        <h3 class="title">Datos básicos</h3>

        <div class="form-group">
            <label class="control-label">Título del caso</label>
            {!! Form::text('title',null,['class'=>'form-control','id'=>'title']) !!}
        </div>
        <div class="form-group">
            <label class="control-label">Cliente</label>
            <select class="form-control" id="customer_id" name="customer_id">
                <option></option>
                @foreach($customers as $index=>$customer)
                    <option {{(isset($case) && $customer->id==$case->customer->id)?'selected':''}} value="{{$customer->id}}">{{$customer->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Criticidad</label>
            <select class="form-control" id="criticity_id" name="criticity_id">
                <option></option>
                @foreach($criticities as $index=>$criticity)
                    <option {{(isset($case) && $criticity->id==$case->criticity->id)?'selected':''}} value="{{$criticity->id}}">{{$criticity->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="tab-pane" id="surveillance-evidences-tab">
        <h3 class="title">Evidencias</h3>
        @include('file._form',['file_list'=>'surveillance-form'])
    </div>
    <div class="tab-pane" id="surveillance-description-tab">
        <h3 class="title">Descripción</h3>

        <div class="form-group">
            <input class="btn btn-lg btn-info" type="button" onclick="$('#modal-files-uploaded').modal('show');"
                   value="Mostrar evidencias">
        </div>
        <div class="form-group">
           <textarea class="form-control ckeditor" name="description" id="description">
               {{isset($case->description)?$case->description:''}}
           </textarea>
        </div>
    </div>
    <div class="tab-pane" id="surveillance-recommendation-tab">
        <h3 class="title">Recomendaciones</h3>

        <div class="form-group">
           <textarea class="form-control ckeditor" name="recommendation" id="recommendation">
               {{isset($case->recommendation)?$case->recommendation:''}}
           </textarea>
        </div>
    </div>
    <div class="tab-pane" id="surveillance-save-tab">
        <h3 class="title">Previsualizar y Guardar</h3>

        <div class="row">
            <div id="surveillance-preview" class="col-sm-12">
                @include('surveillance._preview',['case'=>isset($case)?$case:new \Models\IncidentManager\Surveillance\SurveillanceCase()])
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-right">
                {!! Form::submit('Guardar Caso',['class'=>'btn btn-lg btn-blue']) !!}
            </div>
        </div>
    </div>
    <ul class="pager wizard">
        <li class="previous first"><a href="#">Primero</a></li>
        <li class="previous"><a href="#"><i class="entypo-left-open"></i> Anterior</a></li>
        <li class="next last"><a href="#">Último</a></li>
        <li class="next"><a href="#">Siguiente <i class="entypo-right-open"></i></a></li>
    </ul>
</div>

{{--Valida si los campos de evidencias fueron pasados como un valor de sesión cuando ha ocurrido un error--}}
@if (\Session::has('surv_evidences'))
    @foreach(session('surv_evidences') as $evidence)
        @include('file._evidence_hidden',['evidence'=>$evidence])
    @endforeach
@endif