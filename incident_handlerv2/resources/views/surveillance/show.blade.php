@extends('layout.dashboard_topmenu')

@section('title', 'Caso '.$case->title)

@section('include_up')
    <script type="text/javascript">
        function edit(btn) {
            window.open('{{route('surveillance.edit',[$case])}}', '_self');
        }

        function pdf(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('surveillance.pdf',[$case,true])}}', '_self');
            $(btn).attr('disabled', false);
        }

        function doc(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('surveillance.doc',$case)}}', '_self');
            $(btn).attr('disabled', false);
        }

        function mail(btn) {
            $(btn).attr('disabled', true);
            window.open('{{route('surveillance.email',$case)}}', '_self');
        }
    </script>
@endsection

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Cliente: <b>{{$case->customer->name}}</b></h3><br/>

            <div class="row">
                <div class="btn btn-primary" onclick="edit(this)">
                    <i class="fa fa-pencil fa-fw"></i> Editar Caso
                </div>
                {{--<div class="btn btn-danger" onclick="pdf(this)">--}}
                    {{--<i class="fa fa-file-pdf-o fa-fw"></i> Generar PDF--}}
                {{--</div>--}}
                {{--<div class="btn btn-blue" onclick="doc(this)">--}}
                    {{--<i class="fa fa-file-pdf-o fa-fw"></i> Generar DOC--}}
                {{--</div>--}}
                <div class="btn btn-success"
                     onclick="mail(this)">
                    <i class="fa fa-envelope fa-fw"></i> Enviar Correo
                </div>
            </div>
        </div>
        <div class="panel-body">
            @include('surveillance._preview')
        </div>
    </div>
@endsection