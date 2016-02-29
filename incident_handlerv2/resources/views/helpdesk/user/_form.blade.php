<div class="form-group row">
    {!! Form::label('user_type','Cliente',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        @if(!empty($user->id))
            {!! Form::text('customer',$user->customer->name,['class'=>'form-control','disabled']) !!}
        @else
            {!! Form::select('customer',\Models\IncidentManager\Customer\Customer::all()->lists('name', 'id'),isset($user->customer_id)?$user->customer_id:1,['class'=>'form-control']) !!}
        @endif
    </div>
</div>

<div class="form-group row">
    {!! Form::label('username','Nombre de usuario',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('username',null,['class'=>'form-control',isset($user->username)?'disabled':'']) !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('customer','Tipo de Usuario',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('user_type',\Models\Helpdesk\User\UserType::types(),isset($user->type->id)?$user->type->id:1,['class'=>'form-control']) !!}
    </div>
</div>

<div class="form-group row">
    {!! Form::label('active','Usuario Activo',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-1">
        {!! Form::checkbox('active',1,null,['class'=>'form-control']) !!}
    </div>
</div>

