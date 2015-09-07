@extends('layouts.master')
@section('content')


        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="/assets/plugins/parsley/src/parsley.css" rel="stylesheet"/>
<!-- ================== END PAGE LEVEL STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/parsley/dist/parsley.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet"/>
<!-- ================== END PAGE LEVEL STYLE ================== -->

<script src="/assets/plugins/pace/pace.min.js"></script>

<script>
    $(document).ready(function () {
        TableManageDefault.init2('data-table-assets');
        TableManageDefault.init2('data-table-employees');
        TableManageDefault.init2('data-table-socialmedia');
        TableManageDefault.init2('data-table-pages');
    });

    function submitForm(url, formData, formId, modalId) {
        var postData = formData;
        var inserted = '';
        $.ajax({
            url: url,
            type: 'POST',
            data: postData,
            async: false,
            success: function (data) {
                mensaje = data.message;
                if (data.errores != null) {
                    mensaje += "<ul>";
                    $.each(data.errores, function (key, value) {
                        mensaje += '<li>' + value + '</li>';
                    });
                    mensaje += "</ul>";
                }


                $.gritter.add({
                    title: "Mensaje del servidor",
                    text: mensaje,
                    sticky: false,
                    time: ""
                });

                if (data.object != null) {
                    $(formId)[0].reset(); //Resetea el formulario
                    $(modalId).modal('hide'); //Ocultamos el modal

                    inserted = data.object;
                } else {
                    inserted = null;
                }
            },
            error: function (xhr) {
                var rText = $.parseJSON(xhr.responseText);
                $.gritter.add({
                    title: "Mensaje del servidor",
                    text: "Ocurrió un error con la petición: " + rText.error.message,
                    sticky: false,
                    time: ""
                });

                inserted = null;
            }
        });

        return inserted;
    }
</script>

<h1 class="page-header"></h1>
<!-- end page-header -->

<div class="row">
    <!--Begin col 12 customer details-->
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Detalles</h4>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-general">Datos generales</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-assets">Activos</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-employees">Personal</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-socialmedia">Social Media</a>
                    </li>
                    <li class="">
                        <a data-toggle="tab" href="#tab-pages">Portales</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-general" class="tab-pane fade active in">
                        <h1>Detalles del Cliente </h1>

                        <div class="widget widget-stats bg-blue">
                            <div class="stats-icon"><i class="fa fa-eye"></i></div>
                            <div class="stats-info">
                                <h4>{{ $customer->name }} </h4>

                                <p> {{ $customer->mail }} </p>
                                <small>({{ $customer->company }})</small>
                            </div>
                            <div class="stats-link">
                                <a href="/customer/update/{{ $customer->id }}">Editar <i
                                            class="fa fa-arrow-circle-o-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div id="tab-assets" class="tab-pane fade">
                        <h1>Activos</h1>

                        @include('customer/assets/_table')

                    </div>
                    <div id="tab-employees" class="tab-pane fade">
                        <h1>Personal</h1>

                        @include('customer/employees/_table')

                    </div>
                    <div id="tab-socialmedia" class="tab-pane fade">
                        <h1>Socialmedia</h1>

                        @include('customer/socialmedia/_table')


                    </div>
                    <div id="tab-pages" class="tab-pane fade">
                        <h1>Portales falsos</h1>

                        @include('customer/pages/_table')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End customer details-->
</div>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
<script src="/assets/js/table-manage-default.demo.min.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->


@stop
