<script type="text/javascript">
    $(document).ready(function () {
        recommendationContent = CKEDITOR.replace('recommendationContent');
    });
</script>

<div class="row form-group">
    <label class="control-label">Contenido de la Recomendación</label>
    {!! Form::textarea('content',null,['class'=>'form-control','id'=>'recommendationContent']) !!}
</div>