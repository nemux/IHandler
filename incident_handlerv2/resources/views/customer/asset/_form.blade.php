<div class="form-group row">
    {!! Form::label('domain_name','Nombre de Dominio',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('domain_name',null,['class'=>'form-control']) !!}
    </div>
</div>
@include('asset._form',['asset'=>(isset($asset->asset))?$asset->asset:new \Models\IncidentManager\Asset\Asset()])
<div class="form-group row">
    {!! Form::label('comments','Comentarios',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::textarea('comments',null,['class'=>'form-control']) !!}
    </div>
</div>