@extends('layout.dashboard_topmenu')

@section('title', 'Caso '.$case->title)

@section('include_up')
    <script src="/custom/assets/js/gcs-im/event.js"></script>
    <script type="text/javascript">
        function edit(btn) {
            window.open('{{route('incident.edit',[$case])}}', '_self');
        }

        function pdf(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('incident.pdf',[$case,1])}}', '_self');
            $(btn).attr('disabled', false);
        }

        function mail(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('incident.email',$case)}}', '_self');
        }
    </script>


    {{--CKEditor--}}
    <script src="/custom/assets/js/ckeditor/ckeditor.js"></script>

    {{--Xenon Widget--}}
    <script src="/xenon/assets/js/xenon-widgets.js" id="script-resource-7"></script>
@endsection

@section('dashboard_content')
    <div class="row">
        <div class="btn btn-primary" onclick="edit(this)">
            <i class="fa fa-pencil fa-fw"></i> Editar Caso
        </div>
        <div class="btn btn-info" onclick="pdf(this)">
            <i class="fa fa-file-pdf-o fa-fw"></i> Generar PDF
        </div>
        <div class="btn btn-success"
             onclick="mail(this)">
            <i class="fa fa-envelope fa-fw"></i> Enviar Correo
        </div>
    </div>
    @if(count($case->notes)>0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Notas (Observaciones)</h3>

                <div class="panel-options">
                    <a href="#" data-toggle="panel">
                        <span class="collapse-icon">–</span>
                        <span class="expand-icon">+</span>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-12">
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
                                    <li @if($index===0)class="active"@endif>
                                        <span class="status-date">{{date('d M',strtotime($note->created_at))}}</span>

                                        <p>{!! $note->content !!}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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
            @include('incident._preview',['forpdf'=>false])
        </div>
    </div>
@endsection