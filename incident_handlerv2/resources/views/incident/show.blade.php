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