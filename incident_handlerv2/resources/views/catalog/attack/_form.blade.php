<div class="form-group row">
    {!! Form::label('name','Nombre',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('description','Descripcion',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('description',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('attack_type_parent_id','Ataque Padre',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('attack_type_parent_id',$parents,['class'=>'form-control']) !!}
    </div>
</div>