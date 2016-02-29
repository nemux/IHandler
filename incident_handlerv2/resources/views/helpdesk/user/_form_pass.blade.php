{!! Form::hidden('id',$user->id) !!}
<div class="form-group row">
    {!! Form::label('password','Contraseña nueva',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('password_confirmation', 'Confirmar contraseña',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
    </div>
</div>