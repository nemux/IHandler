<!-- Modal 3 (Custom Width)-->
<div class="modal fade custom-width" id="modal-files-uploaded">
    <div class="modal-dialog" style="width: 85%; padding: 0;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Evidencias recién subidas</h4></div>
            <div class="modal-body"
                 style="max-height: 500px; height: 500px; overflow: auto; background-color: #EEE; padding: 15px !important;">
                <div class="gallery-env">
                    <div class="row album-images" id="evidences-thumbs">
                        @if (\Session::has('surv_evidences'))
                            @foreach(session('surv_evidences') as $evidence)
                                @include('file._evidence_thumb',['evidence'=>$evidence])
                            @endforeach
                        @endif

                        @if(isset($case))
                            @foreach($case->evidences as $evidence)
                                @include('file._evidence_thumb',['evidence'=>$evidence->evidence])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>