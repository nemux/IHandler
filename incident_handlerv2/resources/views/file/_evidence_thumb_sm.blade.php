<div class="col-md-3 col-sm-4 col-xs-6" id="evidence-{{$incident_evidence->id}}">
    <div class="album-image">
        <a href="#" class="thumb" data-action="edit"
           data-src="{{route('incident.evidence.file',$incident_evidence->id)}}"
           data-note="{{$incident_evidence->note}}"
           data-id="{{$incident_evidence->id}}">
            <img src="{{route('incident.evidence.file',$incident_evidence->id)}}" class="img-responsive img-corona"/>
        </a>
        <a href="{{route('incident.evidence.file',$incident_evidence->id)}}" target="_blank" class="name">
            <span>{!! $incident_evidence->evidence->original_name !!}</span>
            <em>{{date('d/M/Y',strtotime($incident_evidence->created_at))}}</em>
        </a>

        <div class="image-options">
            <a href="#" data-action="trash" data-id="{{$incident_evidence->id}}">
                <i class="fa-trash">
                </i>
            </a>
        </div>
    </div>
</div>