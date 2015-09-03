{{Form::hidden('_token',csrf_token())}}
{{Form::hidden('customer_id',$customer->id)}}
<div class="form-group">
    {{Form::label('domain_name')}}
    {{Form::text('domain_name',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('ip')}}
    {{Form::text('ip',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('comments')}}
    {{Form::textarea('comments',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::reset('Limpiar campos',['class'=>'btn btn-sm btn-default'])}}
    {{Form::submit('Guardar',['class'=>'btn btn-sm btn-success'])}}
</div> 