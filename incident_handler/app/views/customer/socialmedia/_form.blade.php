{{Form::hidden('customer_id',$customer->id)}}
<div class="form-group">
    {{Form::label('reference','Enlace a la red social')}}
    {{Form::text('reference',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('description','Descripción')}}
    {{Form::textarea('description',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    {{Form::label('recommendation','Recomendaciones')}}
    {{Form::textarea('recommendation',null,['class'=>'form-control'])}}
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-2">
            <span class="btn btn-sm btn-success" onclick=" $('#images-evidence').click()">Agregar evidencia</span>
            <input class="btn btn-default" type="file" id="images-evidence" name="images-evidence[]" multiple=""
                   style="display:none">
        </div>
        <div class="col-md-10" id="files-container">
            <h3>Archivos seleccionados</h3>
            <ul id="files_list"></ul>
        </div>
    </div>
</div>
<script>
    $("#images-evidence").change(function () {
        //get the input and UL list
        var input = document.getElementById('images-evidence');

        var list = $("#files_list");

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
</script>