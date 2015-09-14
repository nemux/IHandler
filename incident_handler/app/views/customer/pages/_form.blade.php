<link href="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet"/>
<script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>

<div class="form-group">
    {{Form::label('page_type_id','Tipo de Página')}}
    {{--<select id="page_type_id" class="form-control" name="page_type_id">--}}
    {{--<option value="0" selected>Selecciona una opción</option>--}}

    {{--@foreach($page_types as $key => $pt)--}}
    {{--<option value="{{$key}}">{{$pt}}</option>--}}
    {{--@endforeach--}}

    {{--</select>--}}

    {{Form::select('page_type_id',$page_types,null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('url','URL')}}
    {{Form::text('url',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('comments','Comentarios')}}
    {{Form::textarea('comments',null,['class'=>'form-control','id'=>'page-comments'])}}
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            <span class="btn btn-sm btn-success" onclick=" $('#p-images-evidence').click()">Agregar evidencia</span>
            <input class="btn btn-default" type="file" id="p-images-evidence" name="p-images-evidence[]" multiple=""
                   style="display:none">
        </div>
        <div class="col-md-10" id="files-container">
            <h3>Archivos seleccionados</h3>
            <ul id="p-files_list">
                @if(isset($page))
                    @foreach($page->evidences as $index=>$ev)
                        <li>Archivo #{{$index+1}}: {{$ev->name}}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>

<script>
    $("#p-images-evidence").change(function () {
        //get the input and UL list
        var input = document.getElementById('p-images-evidence');

        var list = $("#p-files_list");

        //empty list for now...
        list.empty();

        //for every file...
        for (var x = 0; x < input.files.length; x++) {
            //add to list
            var li = document.createElement('li');
            li.innerHTML = 'Archivo #' + (x + 1) + ':  ' + input.files[x].name;
            list.append(li);
        }
    });

    $(document).ready(function () {
        $("#page-comments").wysihtml5();
    });
</script>