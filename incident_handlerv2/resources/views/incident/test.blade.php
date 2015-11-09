@extends('layout.dashboard_topmenu')

@section('title','Agregar Incidente')

@section('include_down')
    {{--Form wizard--}}
    <script src="/xenon/assets/js/formwizard/jquery.bootstrap.wizard.min.js" id="script-resource-9"></script>

    {{--Custom Select Form--}}
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2.css" id="style-resource-2">
    <link rel="stylesheet" href="/xenon/assets/js/select2/select2-bootstrap.css" id="style-resource-3">
    <script src="/xenon/assets/js/select2/select2.min.js" id="script-resource-12"></script>

    {{--CKEditor--}}
    <script src="/custom/assets/js/ckeditor/ckeditor.js"></script>

    {{--DropZone Files Uploader--}}
    <link rel="stylesheet" href="/custom/assets/js/dropzone/dropzone.css" id="style-resource-1">
    <link rel="stylesheet" href="/custom/assets/js/dropzone/basic.css" id="style-resource-1">
    <script src="/custom/assets/js/dropzone/dropzone.js" id="script-resource-7"></script>

    {{--Validate Fields--}}
    <script src="/custom/assets/js/jquery-validate/jquery.validate.js" id="script-resource-7"></script>
    <script src="/custom/assets/js/jquery-validate/localization/messages_es.js" id="script-resource-7"></script>

    {{--Date & Time Pickers--}}
    <link rel="stylesheet" href="/xenon/assets/js/daterangepicker/daterangepicker-bs3.css" id="style-resource-1">

    <script src="/xenon/assets/js/moment.min.js" id="script-resource-7"></script>
    <script src="/xenon/assets/js/daterangepicker/daterangepicker.js" id="script-resource-8"></script>
    <script src="/xenon/assets/js/datepicker/bootstrap-datepicker.js" id="script-resource-9"></script>
    <script src="/xenon/assets/js/timepicker/bootstrap-timepicker.min.js" id="script-resource-10"></script>
@endsection

@section('dashboard_content')
    <section class="">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-title">
                        <h3>Datos del Caso</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('incident._event')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('modal.delete_event_evidence')
@endsection