{{--Validates if isJavascript parameter is setted throw @include method,
in this case, the string showed is a one line representation
to avoid javscript errors setting multiline string variable--}}
@if(isset($isJavascript) && $isJavascript)
    <?php $return = "<div class='col-md-3 col-sm-4 col-xs-6'>" .
            "<div class='album-image'>" .
            "<div class='thumb'>" .
            "<img src='\"+pathFile+\"' class='img-responsive'/>" .
            "</div><div class='name'>" .
            "<span>\"+file.name+\"" .
            "</span><em>\"+pathFile+\"</em>" .
            "</div></div></div>";
    echo $return;
    ?>
@else
    <div class="col-md-3 col-sm-4 col-xs-6">
        <div class="album-image">
            <div class="thumb">
                <img src="{!! isset($evidence)?$evidence->fullPath():''!!}" class="img-thumbnail img-responsive"/>
            </div>
            <div class="name">
                <span>{!! isset($evidence)?$evidence->original_name:''!!}</span>
                <em>{!! isset($evidence)?$evidence->fullPath():'' !!}</em>
            </div>
        </div>
    </div>
@endif