<div class="form-group row">
    {!! Form::label('name','Nombre(s)',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name',$person->name,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('lname','Apellidos',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-5">
        {!! Form::text('lname',$person->lname,['class'=>'form-control','placeholder'=>'Paterno']) !!}
    </div>
    <div class="col-sm-5">
        {!! Form::text('mname',$person->mname,['class'=>'form-control','placeholder'=>'Materno']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('sex','Sexo',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <div class="row">
            {!! Form::label('sex','Masculino',['class'=>'control-label col-sm-2']) !!}
            {!! Form::radio('sex','M',($person->sex=='M')?true:false,['class'=>'col-sm-1']) !!}
            {!! Form::label('sex','Femenino',['class'=>'control-label col-sm-2']) !!}
            {!! Form::radio('sex','F',($person->sex=='F')?true:false,['class'=>'col-sm-1']) !!}
        </div>
    </div>
</div>