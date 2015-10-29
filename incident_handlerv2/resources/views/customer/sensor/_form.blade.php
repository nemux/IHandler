<div class="form-group row">
    {!! Form::label('name','Nombre del Sensor',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('ipv4','IP v4',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('ipv4',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('ipv6','IP v6',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('ipv6',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('mount_point','Punto de Montaje',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('mount_point',null,['class'=>'form-control']) !!}
    </div>
</div>