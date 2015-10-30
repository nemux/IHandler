<div class="form-group row">
    {!! Form::label('domain_name','Nombre de Dominio',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('domain_name',null,['class'=>'form-control']) !!}
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
    {!! Form::label('comments','Comentarios',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('comments',null,['class'=>'form-control']) !!}
    </div>
</div>