<div class="row">
    <div class="col-md-12">
        <p><b class="h4 semi-bold">{{$index+1}}.- {{$p_tmp->type->type}}</b></p>
    </div>
    <div class="col-md-11 col-md-offset-1">
        <p class="h4"><b>Enlace: </b><a href="{{$p_tmp->url}}">{{$p_tmp->url}}</a></p>
    </div>
    <div class="col-md-11 col-md-offset-1">
        <p class="h4"><b>Comentarios:</b></p>

        <p>{{ $p_tmp->comments }}</p>
    </div>

    @if(sizeof($p_tmp->evidences) >0)
        <div class="col-md-10 col-md-offset-2">
            <p class="h4"><b>Evidencias:</b></p>
            @foreach($p_tmp->evidences as $index=>$evidence)
                <p style="text-align: center;">
                    @if($mail)
                        <img src="data:image/{{pathinfo($evidence->file, PATHINFO_EXTENSION)}};base64,{{base64_encode(file_get_contents($evidence->file))}}"
                             style="max-height: 400px; max-width: 600px;"><br>
                    @else
                        <img src="/{{ $evidence->file }}" style="max-height: 400px; max-width: 600px;">
                        <br>
                    @endif
                    <span><b>Figura {{$index+1}}.-</b> <i>{{$evidence->footnote}}</i></span>
                </p>
            @endforeach
        </div>
    @endif
</div>