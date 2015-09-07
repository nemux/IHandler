{{Form::hidden('_token',csrf_token())}}
{{Form::hidden('customer_id',$customer->id)}}
<div class="form-group">
    {{Form::label('reference','Enlace a la red social')}}
    {{Form::text('reference',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('description','Descripción')}}
    {{Form::textarea('description',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('recommendation','Recomendaciones')}}
    {{Form::textarea('recommendation',null,['class'=>'form-control'])}}
</div>