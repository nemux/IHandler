<div class="form-group row">
    {!! Form::label('ipv4','IP v4',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('ipv4',$asset->ipv4,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('ipv6','IP v6',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('ipv6',$asset->ipv6,['class'=>'form-control']) !!}
    </div>
</div>