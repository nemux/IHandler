<div class="col-md-3 col-sm-4 col-xs-6">
    <div class="album-image">
        <div class="thumb">
            @if(isset($evidence) && sizeof(preg_grep('/^image\//i',explode('\n', $evidence->mime_type)))>0)
                <img src="{{ route('evidence.file',$evidence->id)}}"
                     class="img-thumbnail img-responsive img-corona"/>
            @endif
        </div>
        <div class="name">
            <span>{{ isset($evidence)?$evidence->original_name:''}}</span>
            <em>{{ isset($evidence)?route('evidence.file',$evidence->id):'' }}</em>
        </div>
    </div>
</div>