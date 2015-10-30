<div class="form-group">
    {{Form::label('domain_name','Nombre de dominio')}}
    {{Form::text('domain_name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('ip','IP')}}
    {{Form::text('ip',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('comments','Comentarios')}}
    {{Form::textarea('comments',null,['class'=>'form-control'])}}
</div>