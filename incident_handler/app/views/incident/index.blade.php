@extends('layouts.master')
@section('content')

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet"/>
    <!-- ================== END PAGE LEVEL STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
    <script>
        $(document).ready(function () {

            TableManageDefault.init();
        });
    </script>
    <div class="col-md-12" style="min-width:800px;">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Incidentes</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered table-hover  ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>
                                Ticket
                            </th>
                            <th>Título</th>
                            <th>
                                Indicadores
                            </th>
                            <th>
                                Fecha detección
                            </th>
                            <th>
                                Sensor
                            </th>
                            <th>
                                Status
                            </th>

                            <th>
                                Handler
                            </th>

                            <?php if (Auth::user()->type->name == 'user_2' || Auth::user()->type->name == 'admin'): ?>
                            <th>
                                Enviar correo
                            </th>
                            <?php endif ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($incident as $in): ?>
                        <tr>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer">
                                <?php echo $i ?>
                            </td>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer">
                                @if (isset($in->internal_number))
                                    {{ $in->internal_number }}
                                @else
                                    {{ "Por asignar....."}}
                                @endif
                            </td>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer" width="15%">
                                {{ $in->title }}
                            </td>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer">
                                {{ $in->rules }}
                            </td>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer">
                                {{ $in->datetime  }}
                            </td>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer">
                                {{ $in->sensor_name }}
                            </td>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer">
                                {{ $in->is_name }}
                            </td>
                            <td onclick="window.open('/incident/view/<?php echo $in->id ?>','_blank');"
                                style="cursor:pointer">
                                {{ $in->handler_name }}
                            </td>
                            <?php if (Auth::user()->type->name == 'user_2' || Auth::user()->type->name == 'admin'): ?>
                            <td>
                                <a href='/incident/mail/{{$in->id}}' class="btn btn-default">Correo</a>
                            </td>
                            <?php endif ?>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>

    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
    <script src="/assets/js/table-manage-default.demo.min.js"></script>
    <script src="/assets/js/apps.min.js"></script>
    <!-- ================== END PAGE LEVEL JS ================== -->


@stop
