<div class="col-md-3 col-sm-4 col-xs-6">
    <div class="album-image">
        <div class="thumb">
            <img src="{{ isset($evidence)?route('evidence.file',$evidence->id):''}}"
                 class="img-thumbnail img-responsive"/>
        </div>
        <div class="name">
            <span>{{ isset($evidence)?$evidence->original_name:''}}</span>
            <em>{{ isset($evidence)?route('evidence.file',$evidence->id):'' }}</em>
        </div>
    </div>
</div>