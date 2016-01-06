<div class="form-group row">
    {!! Form::label('username','Nombre de usuario',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('username',null,['class'=>'form-control',isset($user->username)?'disabled':'']) !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('user_type','Tipo de Usuario',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('user_type',\Models\IncidentManager\User\UserType::types(),isset($user->type->id)?$user->type->id:3,['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('active','Usuario Activo',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-1">
        {!! Form::checkbox('active',1,null,['class'=>'form-control']) !!}
    </div>
</div>

