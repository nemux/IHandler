@extends('layout.dashboard_topmenu')

@section('title', 'Caso '.$case->title)

@section('include_up')
    <script src="/custom/assets/js/gcs-im/event.js"></script>
    <script type="text/javascript">

        var opts = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-full-width",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        function edit(btn) {
            window.open('{{route('incident.edit',[$case])}}', '_self');
        }

        function pdf(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('incident.pdf',[$case,1])}}', '_self');
            $(btn).attr('disabled', false);
        }

        function doc(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('incident.doc',$case)}}', '_self');
            $(btn).attr('disabled', false);
        }

        function mail(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('incident.email',$case)}}', '_self');
        }
        $(document).ready(function () {
            // Edit Modal
            $('.gallery-env a[data-action="edit"]').on('click', function (ev) {
                ev.preventDefault();

                var id = $(this).data('id');
                var note = $(this).data('note');

                var element = this;

                $("#gallery-image-modal").modal('show');
                $('#gallery-image-modal .img-responsive').attr('src', $(this).data('src'));
                $('#gallery-image-modal #incident_evidence_note').val($(this).data('note'));

                $('#gallery-image-modal .btn-secondary').unbind('click').on('click', function () {
                    var newNote = $('#gallery-image-modal #incident_evidence_note').val();
                    $.ajax({
                        url: '/dashboard/incident/edit/evidence',
                        type: 'post',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            _method: 'patch',
                            id: id,
                            note: newNote
                        },
                        success: function (result) {
                            if (result.status === 0) {
                                toastr.success(result.message, null, opts);
                                $(element).data('note', newNote);
                            } else {
                                toastr.warning(result.message, 'No se puede realizar la petición.', opts);
                            }
                        },
                        fail: function (result) {
                            toastr.error(result, 'No se puede realizar la petición.', opts);
                        }
                    });
                    $("#gallery-image-modal").modal('hide');
                });
            });

            // Delete Evidence
            $('.gallery-env a[data-action="trash"]').on('click', function (ev) {
                ev.preventDefault();
                $("#gallery-delete-modal").modal('show');
                var id = $(this).data('id');

                $('#gallery-delete-modal .btn-danger').unbind('click').on('click', function (ev) {
                    $.ajax({
                        url: '/dashboard/incident/delete/evidence/' + id,
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            _method: 'delete'
                        },
                        success: function (result) {
                            if (result.status === 0) {
                                toastr.success(result.message, null, opts);

                                $('#evidence-' + id).remove();
                            } else {
                                toastr.warning(result.message, 'No se puede realizar la petición.', opts);
                            }
                        },
                        fail: function (result) {
                            toastr.error(result, 'No se puede realizar la petición.', opts);
                        }
                    });

                    $("#gallery-delete-modal").modal('hide');
                });
            });

            //Delete note
            $('.xe-body div[data-action="delete"]').on('click', function (ev) {
                ev.preventDefault();
                $("#gallery-delete-modal").modal('show');
                var id = $(this).data('id');

                $('#gallery-delete-modal .btn-danger').unbind('click').on('click', function (ev) {
                    $.ajax({
                        url: '/dashboard/incident/note/delete',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            _method: 'delete',
                            id: id
                        },
                        success: function (result) {
                            if (result.status === 0) {
                                toastr.success(result.message, null, opts);

                                $('#note-' + id).remove();
                            } else {
                                toastr.warning(result.message, 'No se puede realizar la petición.', opts);
                            }
                        },
                        fail: function (result) {
                            toastr.error(result, 'No se puede realizar la petición.', opts);
                        }
                    });

                    $("#gallery-delete-modal").modal('hide');
                });

            });
        });
    </script>


    {{--CKEditor--}}
    <script src="/custom/assets/js/ckeditor/ckeditor.js"></script>

    {{--Xenon Widget--}}
    <script src="/xenon/assets/js/xenon-widgets.js" id="script-resource-7"></script>
@endsection

@section('dashboard_content')
    <div class="row">
        @if($case->ticket->ticket_status_id==1 || $case->ticket->ticket_status_id==2)
            <div class="btn btn-primary" onclick="edit(this)">
                <i class="fa fa-pencil fa-fw"></i> Editar Caso
            </div>
        @endif
        <div class="btn btn-danger" onclick="pdf(this)">
            <i class="fa fa-file-pdf-o fa-fw"></i> Generar PDF
        </div>
        <div class="btn btn-blue" onclick="doc(this)">
            <i class="fa fa-file-word-o fa-fw"></i> Generar DOC
        </div>
        <div class="btn btn-success"
             onclick="mail(this)">
            <i class="fa fa-envelope fa-fw"></i> Enviar Correo
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="panel-title">Cliente: <b>{{$case->customer->name}}</b></h3><br/>

                    <h3 class="panel-title">Actualizado: <b>{{date('d/m/Y H:i:s',strtotime($case->updated_at))}}</b>
                    </h3>
                    <br/>

                    <h3 class="panel-title">Estatus: <b>{{($case->ticket)?$case->ticket->status->name:'Abierto'}}</b>
                    </h3>
                </div>
                <div class="col-md-8">
                    @include('incident._extra_buttons')
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical">
                    <li class="active"><a href="#v-incident" data-toggle="tab">Incidente</a></li>
                    <li><a href="#v-notes" data-toggle="tab">Observaciones</a></li>
                    <li><a href="#v-evidences" data-toggle="tab">Evidencias</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="v-incident">
                        <h3>Incidente</h3>

                        @include('incident._preview',['forpdf'=>false])
                    </div>
                    <div class="tab-pane" id="v-notes">
                        <h3>Observaciones</h3>

                        <div class="xe-widget xe-status-update" data-auto-switch="5">
                            <div class="xe-header">
                                <div class="xe-icon">
                                    <i class="fa-book"></i>
                                </div>
                                <div class="xe-nav">
                                    <a href="#" class="xe-prev">
                                        <i class="fa-angle-left"></i>
                                    </a>
                                    <a href="#" class="xe-next">
                                        <i class="fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="xe-body">
                                <ul class="list-unstyled">
                                    @foreach($case->notes as $index=>$note)
                                        <li @if($index===0) class="active" @endif id="note-{{$note->id}}">
                                            <span class="status-date">{{date('d M',strtotime($note->created_at))}}</span>

                                            <p>{!! $note->content !!}</p>

                                            <div data-id="{{$note->id}}" data-action="delete" class="btn btn-blue">
                                                Eliminar
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="v-evidences">
                        <h3>Evidencias</h3>

                        <section class="gallery-env">
                            <div class="row">
                                <div class="album-images row">
                                    @foreach($case->evidences as &$incident_evidence)
                                        @include('file._evidence_thumb_sm',['incident_evidence'=>$incident_evidence])
                                    @endforeach
                                </div>
                            </div>
                        </section>

                        @if($case->ticket->ticket_status_id==4)
                            <h3>Caso Cerrado</h3>
                            <section class="gallery-env">
                                <div class="row">
                                    <div class="album-images row">
                                        @foreach($case->evidencesForClosed as &$incident_evidence)
                                            @include('file._evidence_thumb_sm',['incident_evidence'=>$incident_evidence])
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        @endif

                        @if($case->ticket->ticket_status_id==5)
                            <h3>Falso Positivo</h3>
                            <section class="gallery-env">
                                <div class="row">
                                    <div class="album-images row">
                                        @foreach($case->evidencesForFalsePositive as &$incident_evidence)
                                            @include('file._evidence_thumb_sm',['incident_evidence'=>$incident_evidence])
                                        @endforeach
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Modal Image -->
    <div class="modal fade" id="gallery-image-modal">
        <div class="modal-dialog" style="width: 70%;">
            <div class="modal-content">
                <div class="modal-gallery-image">
                    <img class="img-responsive"/>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="incident_evidence_note" class="control-label">Description</label>
                                <textarea class="form-control autogrow" id="incident_evidence_note"
                                          placeholder="Agrega alguna información adicional a la evidencia"
                                          style="min-height: 100px; max-height: 100px; overflow: auto;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-secondary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Element (Confirm)-->
    <div class="modal fade" id="gallery-delete-modal" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar imagen</h4>
                </div>
                <div class="modal-body">
                    Al eliminar esta imagen no se podrán deshacer los cambios.<br/>
                    ¿Estás seguro que deseas eliminar la imagen?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
@endsection