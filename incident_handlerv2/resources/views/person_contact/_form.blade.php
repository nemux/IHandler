<div class="form-group row">
    {!! Form::label('email','Email',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('email',isset($user->person->contact->email)?$user->person->contact->email:'',['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('phone','Teléfono',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('phone',isset($user->person->contact->phone)?$user->person->contact->phone:'',['class'=>'form-control']) !!}
    </div>
</div>