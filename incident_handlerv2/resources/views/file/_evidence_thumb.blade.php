<div class="col-md-3 col-sm-4 col-xs-6">
    <div class="album-image">
        <div class="thumb"><img src="{!! isset($evidence)?$evidence->fullPath():'\' + pathFile + \''!!}"
                                class="img-responsive"/></div>
        <div class="name">
            <span>{!! isset($evidence)?$evidence->original_name:'\' + file.name + \''!!}</span><em>{!! isset($evidence)?$evidence->fullPath():'\' + pathFile + \'' !!}</em>
        </div>
    </div>
</div>