<link href="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet"/>
<script src="/assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
<script src="/assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>


<div class="form-group">
    {{Form::label('criticity_id','Criticidad')}}
    {{Form::select('criticity_id',$criticities,null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('title','Título')}}
    {{Form::text('title',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('description','Descripción')}}
    {{Form::textarea('description',null,['class'=>'form-control','id'=>'description'])}}
</div>
<div class="form-group">
    {{Form::label('recommendation','Recomendaciones')}}
    {{Form::textarea('recommendation',null,['class'=>'form-control','id'=>'recommendation'])}}
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            <span class="btn btn-sm btn-success" onclick=" $('#sm-images-evidence').click()">Agregar evidencia</span>
            <input class="btn btn-default" type="file" id="sm-images-evidence" name="sm-images-evidence[]" multiple=""
                   style="display:none">
        </div>
        <div class="col-md-10" id="files-container">
            <h3>Archivos seleccionados</h3>
            <ul id="sm-files_list">
                @if(isset($socialmedia))
                    @foreach($socialmedia->evidences as $index=>$ev)
                        <li>Archivo #{{$index+1}}: {{$ev->name}}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
<script>
    $("#sm-images-evidence").change(function () {
        //get the input and UL list
        var input = document.getElementById('sm-images-evidence');

        var list = $("#sm-files_list");

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
        $("#description").wysihtml5();
        $("#recommendation").wysihtml5();
    });
</script>