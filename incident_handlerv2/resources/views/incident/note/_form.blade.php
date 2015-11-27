<script type="text/javascript">
    $(document).ready(function () {
        noteContent = CKEDITOR.replace('noteContent');
    });
</script>

<div class="row form-group">
    <label class="control-label">Contenido de la Observación</label>
    {!! Form::textarea('content',null,['class'=>'form-control','id'=>'noteContent']) !!}
</div>