<div class="row">
    <div class="col-md-12">
        <p><b class="h4 semi-bold">{{$index+1}}.- {{$sm_tmp->title}}</b></p>
    </div>
    <div class="col-md-11 col-md-offset-1">
        <p><span class="h4"><b>({{date_format($sm_tmp->created_at,'d/M/Y')}})
                    Criticidad {{$sm_tmp->criticity->name}}</b> </span></p>
    </div>
    <div class="col-md-10 col-md-offset-2 text-justify">
        <p class="h4"><b>Descripción:</b></p>

        <p>{{ $sm_tmp->description }}</p>
    </div>

    @if(sizeof($sm_tmp->evidences) >0)
        <div class="col-md-10 col-md-offset-2">
            <p class="h4"><b>Evidencias:</b></p>
            @foreach($sm_tmp->evidences as $index=>$evidence)
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

    <div class="col-md-10 col-md-offset-2 text-justify">
        <p class="h4"><b>Recomendaciones:</b></p>

        <p>{{ $sm_tmp->recommendation }}</p>
    </div>
</div>