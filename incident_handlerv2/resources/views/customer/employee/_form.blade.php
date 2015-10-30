<div class="form-group row">
    {!! Form::label('corp_email','Correo Corporativo',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('corp_email',$employee->email,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('corp_phone','Teléfono Corporativo',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('corp_phone',$employee->phone,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('corp_comments','Comentarios',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('corp_comments',$employee->comments,['class'=>'form-control']) !!}
    </div>
</div>