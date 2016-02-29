@if($message->messagefile)

    <i><i class="fa fa-file"></i>
        <b>Adjunto: </b>
        <a target="_blank"
           href="{{route('helpdesk.file.filename',[$message->id,$message->messagefile->file->name])}}">
            {{$message->messagefile->file->original_name}}
        </a>
    </i>
    @if(sizeof(preg_grep('/^image\//i',explode('\n', $message->messagefile->file->mime_type)))>0)
        <br/>
        <img src="{{route('helpdesk.file.filename',[$message->id,$message->messagefile->file->name])}}"
             class="img-thumbnail" style="max-height: 216px;">
    @endif
@endif