<script type="text/javascript">
    $(document).ready(function () {
        annexContent = CKEDITOR.replace('annexContent');
    });
</script>

<div class="row form-group">
    <label class="control-label">Título del Anexo</label>
    {!! Form::text('title',null,['class'=>'form-control']) !!}
</div>
<div class="row form-group">
    <label class="control-label">Campo</label>
    {!! Form::text('field',null,['class'=>'form-control']) !!}
</div>
<div class="row form-group">
    <label class="control-label">Contenido del Anexo</label>
    {!! Form::textarea('content',null,['class'=>'form-control','id'=>'annexContent']) !!}
</div>