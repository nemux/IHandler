{{Form::hidden('_token',csrf_token())}}
{{Form::hidden('customer_id',$customer->id)}}
<div class="form-group">
    {{Form::label('name','Nombre')}}
    {{Form::text('name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('lastname','Apellidos')}}
    {{Form::text('lastname',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('corp_email','Correo Corporativo')}}
    {{Form::email('corp_email',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('personal_email','Correo Personal')}}
    {{Form::email('personal_email',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('socialmedia','Redes Sociales')}}
    {{Form::textarea('socialmedia',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('comments','Comentarios')}}
    {{Form::textarea('comments',null,['class'=>'form-control'])}}
</div>