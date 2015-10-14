<div class="form-group row">
    {!! Form::label('title','Título',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('title','Tipo de Página',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        <select name="link_type_id" id="link_type_id" class="form-control">
            <option value="4">Página Corporativa</option>
            <option value="5">Página Falsa</option>
        </select>
    </div>
</div>
<div class="form-group row">
    {!! Form::label('link','Enlace',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('link',null,['class'=>'form-control']) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('link_comments','Comentarios',['class'=>'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {{--TODO Ver de que forma se puede evitar hacer esta validación,
        la propuesta es cambiar en el modelo de base de datos las columnas que tengan nombres similares
        concatenando al inicio el nombre de la tabla --}}
        {!! Form::textarea('link_comments',isset($link)?$link->comments:null,['class'=>'form-control']) !!}
    </div>
</div>