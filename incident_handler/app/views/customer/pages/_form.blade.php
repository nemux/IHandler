{{Form::hidden('_token',csrf_token())}}
{{Form::hidden('customer_id',$customer->id)}}
<div class="form-group">
    {{Form::label('page_type_id','Tipo de Página')}}
    <select id="page_type_id" class="form-control" name="page_type_id">
        <option value="0" selected>Selecciona una opción</option>

        @foreach($page_types as $key => $pt)
            <option value="{{$key}}">{{$pt}}</option>
        @endforeach

    </select>
</div>
<div class="form-group">
    {{Form::label('url','URL')}}
    {{Form::text('url',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('comments','Comentarios')}}
    {{Form::textarea('comments',null,['class'=>'form-control'])}}
</div>