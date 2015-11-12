<script type="text/javascript">
    $(document).ready(function () {
        var sel_customer = $("#customer_id").select2({
            placeholder: 'Cliente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        /**
         * Obtiene de un WS los sensores relacionados al cliente seleccionado en el combo box
         */
        $('#customer_id').change(function () {
            var customer_id = $(this).find('option:selected').attr('value');
            $.ajax({
                url: '/dashboard/ws/sensors/' + customer_id,
                type: 'get',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (result) {
                    $("#sensor_id").select2("val", "");
                    $('#sensor_id').empty();

                    if (result.status === true) {
                        $('#sensor_id').append($('<option>', {}));
                        $.each(result.sensors, function (i, item) {
                            $('#sensor_id').append($('<option>', {
                                value: item.id,
                                text: item.name
                            }));
                        });
                    }
                },
                failed: function (result) {
                    console.log(result);
                }
            });

        });

        var sel_criticity = $("#criticity_id").select2({
            placeholder: 'Criticidad del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_flow = $("#flow_id").select2({
            placeholder: 'Flujo del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_categories = $("#category_id").select2({
            placeholder: 'Categoría(s) del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_impact = $("#impact").select2({
            placeholder: 'Impacto del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_risk = $("#risk").select2({
            placeholder: 'Riesgo del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_type = $("#attack_type_id").select2({
            placeholder: 'Tipo de Ataque...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_sensors = $("#sensor_id").select2({
            placeholder: 'Sensor(es) donde se detectó el incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        var sel_signatures = $("#signature").select2({
            placeholder: 'Firma(s) del incidente...',
            allowClear: true,
            dropdownAutoWidth: true
        }).on('select2-open', function () {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });


        var descriptionField = CKEDITOR.replace('description');
        var recommendationField = CKEDITOR.replace('recommendation');
        var referenceField = CKEDITOR.replace('reference');

        $("#title").on('change', function () {
            $('#pv-title').text($(this).val());
        });

        $("#category_id").change(function () {
            $('#pv-categories').empty();
            $('#category_id :selected').each(function (i, selected) {
                var text = $(selected).text();
                $('#pv-categories').append('<li><i>•</i> ' + text + '</li>');
            });
        });

        $("#sensor_id").change(function () {
            $('#pv-sensors').empty();
            $('#sensor_id :selected').each(function (i, selected) {
                var text = $(selected).text();
                $('#pv-sensors').append('<li><i>•</i> ' + text + '</li>');
            });
        });

        $("#flow_id").change(function () {
            var text = $('#flow_id option:selected').text();
            $('#pv-flow').text(text);
        });

        $("#detection_date").blur(function () {
            $('#pv-detection-date').text($("#detection_date").val() + " " + $("#detection_time").val());
        });
        $("#detection_time").blur(function () {
            $('#pv-detection-date').text($("#detection_date").val() + " " + $("#detection_time").val());
        });

        $("#criticity_id").change(function () {
            var text = $('#criticity_id option:selected').text();
            $('#pv-criticity').text(text);
        });

        $("#signature").change(function () {
            $('#pv-signatures').empty();
            $('#signature :selected').each(function (i, selected) {
                var text = $(selected).text();
                $('#pv-signatures').append('<li><i>•</i> ' + text + '</li>');
            });
        });

        descriptionField.on('change', function (evt) {
            $('#pv-description').html(evt.editor.getData());
        });
        recommendationField.on('change', function (evt) {
            $('#pv-recommendation').html(evt.editor.getData());
        });
        referenceField.on('change', function (evt) {
            $('#pv-reference').html(evt.editor.getData());
        });


        @include('incident._init');
    });
</script>
<ul class="tabs">
    <li class="active"><a href="#incident-basic-tab" data-toggle="tab">Datos básicos</a></li>
    <li class=""><a href="#incident-events-tab" data-toggle="tab">Firmas y Eventos</a></li>
    <li class=""><a href="#incident-description-tab" data-toggle="tab">Descripción y Recomendaciones</a></li>
    <li><a href="#incident-evidences-tab" data-toggle="tab">Evidencias</a></li>
    <li><a href="#incident-resume-tab" data-toggle="tab">Resúmen del Caso</a></li>
</ul>
<div class="progress-indicator">
    <span></span>
</div>
<div class="tab-content">
    <div class="tab-pane active" id="incident-basic-tab">
        {{--Título--}}
        <div class="form-group">
            <label class="control-label">Título</label>
            {!! Form::text('title',null,['class'=>'form-control','id'=>'title','data-validate'=>'required,maxlength[255]', isset($case) && 1>=2?'disabled':'' ]) !!}
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label class="control-label">Categoría(s)</label>
                <select {{isset($case) && 1>=2?'disabled':''}} class="form-control" id="category_id"
                        name="category_id[]" multiple data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackCategory::all(['name','id']) as $item)
                        <option value="{{$item->id}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Fecha en que Ocurrió el Incidente</label>

                <div class="date-and-time">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="occurrence_date"
                           id="occurrence_date" type="text"
                           class="form-control datepicker" data-format="dd/mm/yyyy"
                           data-end-date="{{isset($case)?date('d/m/Y',strtotime($case->occurrence_time)):date('d/m/Y')}}"
                           value="{{isset($case)?date('d/m/Y',strtotime($case->occurrence_time)):date('d/m/Y')}}">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="occurrence_time"
                           id="occurrence_time" type="text"
                           class="form-control timepicker" data-template="dropdown"
                           data-default-time="{{isset($case)?date('H:i',strtotime($case->occurrence_time)):date('H:i')}}"
                           data-show-meridian="false" data-minute-step="5"/>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="control-label">Fecha en que se Detectó el Incidente</label>

                <div class="date-and-time">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="detection_date"
                           id="detection_date" type="text"
                           class="form-control datepicker" data-format="dd/mm/yyyy"
                           data-end-date="{{isset($case)?date('d/m/Y',strtotime($case->detection_time)):date('d/m/Y')}}"
                           value="{{isset($case)?date('d/m/Y',strtotime($case->detection_time)):date('d/m/Y')}}">
                    <input {{isset($case) && 1>=2?'disabled':''}} data-validate="required" name="detection_time"
                           id="detection_time" type="text"
                           class="form-control timepicker" data-template="dropdown"
                           data-default-time="{{isset($case)?date('H:i',strtotime($case->detection_time)):date('H:i')}}"
                           data-show-meridian="false" data-minute-step="5"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 form-group">
                <label class="control-label">Flujo del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="flow_id" class="form-control" name="flow_id"
                        data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackFlow::all(['name','id']) as $index=>$item)
                        <option value="{{$item->id}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label class="control-label">Tipo de Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="attack_type_id" class="form-control"
                        name="attack_type_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\AttackType::all(['name','id']) as $index=>$item)
                        <option value="{{$item->id}}">
                            {{$item->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label class="control-label">Criticidad del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="criticity_id" class="form-control"
                        name="criticity_id" data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Catalog\Criticity::all(['name','id']) as $index=>$criticity)
                        <option value="{{$criticity->id}}">
                            {{$criticity->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="control-label">Impacto del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="impact" class="form-control" name="impact"
                        data-validate="required">
                    <option></option>
                    @for($i=0;$i<=10;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="control-label">Riesgo del Ataque</label>
                <select {{isset($case) && 1>=2?'disabled':''}} id="risk" class="form-control" name="risk"
                        data-validate="required">
                    <option></option>
                    @for($i=1;$i<=10;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="row">
            {{--Cliente--}}
            <div class="form-group col-md-6">
                <label class="control-label">Cliente</label>
                <select {{isset($case) && 1>=2?'disabled':''}} class="form-control" id="customer_id" name="customer_id"
                        data-validate="required">
                    <option></option>
                    @foreach(\App\Models\Customer\Customer::all(['name','id']) as $index=>$customer)
                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
            {{--Sensores--}}
            <div class="form-group col-md-6">
                <label class="control-label">Sensor(es)</label>
                <select {{isset($case) && 1>=2?'disabled':''}} class="form-control" id="sensor_id" name="sensor_id[]"
                        multiple="multiple"
                        data-validate="required">
                    <option></option>
                    @if(isset($case))
                        @foreach($case->customer->sensors as $sensor)
                            <option value="{{$sensor->id}}">
                                {{$sensor->name}}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="incident-events-tab">
        {{--Firmas--}}
        <div class="form-group">
            <label class="control-label">Firma(s)</label>
            <select class="form-control" id="signature" name="signature[]" multiple="multiple" data-validate="required">
                <option></option>
                @foreach(\App\Models\Catalog\AttackSignature::all(['name','id']) as $index=>$item)
                    <option value="{{$item->id}}">
                        {{$item->name}}
                    </option>
                @endforeach
            </select>
        </div>
        {{--Eventos--}}
        {{-- Si está abierto el caso o es un caso nuevo --}}
        @if(1<2 || !isset($case))
            <div class="row">
                <div class="col-md-10"><span class="h1">Eventos del Incidente</span></div>
            </div>
            @include('incident._event')

        @endif
    </div>
    <div class="tab-pane" id="incident-description-tab">
        <div class="form-group">
            <h3 class="control-label">Descripción del Incidente</h3>
           <textarea class="form-control ckeditor" name="description" id="description" data-validate="required">
               {{isset($case->description)?$case->description:''}}
           </textarea>
        </div>
        <div class="form-group">
            <h3 class="control-label">Recomendaciones</h3>
           <textarea class="form-control ckeditor" name="recommendation" id="recommendation" data-validate="required">
               {{isset($case->recommendation)?$case->recommendation:''}}
           </textarea>
        </div>
        <div class="form-group">
            <h3 class="control-label">Referencias</h3>
           <textarea class="form-control ckeditor" name="reference" id="reference" data-validate="required">
               {{isset($case->reference)?$case->reference:''}}
           </textarea>
        </div>
    </div>
    <div class="tab-pane" id="incident-evidences-tab">
        <h3 class="title">Evidencias</h3>
        @include('file._form',['file_list'=>'incident-form'])
    </div>
    <div class="tab-pane" id="incident-resume-tab">
        <h3 class="title">Previsualizar y Guardar</h3>

        <div class="row">
            <div id="surveillance-preview" class="col-sm-12">
                @include('incident._preview',['case'=>isset($case)?$case:new \App\Models\Incident\Incident()])
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-right">
                @if(isset($case))
                    @foreach($case->evidences as $evidence)
                        <input type="hidden" value="{{$evidence->evidence->id}}"
                               name="evidence_{{$evidence->evidence->id}}"
                               id="evidence_{{$evidence->evidence->id}}">
                    @endforeach
                @endif
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
@if (\Session::has('incident_evidences'))
    @foreach(session('incident_evidences') as $evidence)
        @include('file._evidence_hidden',['evidence'=>$evidence])
    @endforeach
@endif