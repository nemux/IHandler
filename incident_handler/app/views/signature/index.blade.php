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

@if(Auth::user()->type->name == 'admin')
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-body">
                <div class="row">
                    @if(Session::has('message_add_sifnature'))
                        <div class="col-md-10 alert alert-success">
                            <span> {{Session::get('message_add_sifnature')}}  </span>
                        </div>
                    @endif
                    <div class="col-md-2 pull-right">
                        <a id="modal-add-signature-link" style="width:100%" href="#modal-add-signature"
                           class="btn btn-sm btn-success" data-toggle="modal">
                            <i class="fa fa-plus"></i> Agregar firma
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="col-md-12" style="min-width:800px;">
    <!-- begin panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading">

            <h4 class="panel-title">Indicadores Registrados</h4>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover  ">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Regla</th>

                        <th>Descripción</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($signatures as $s): ?>
                    <tr>

                        <td>
                            {{ $s->id }}
                        </td>
                        <td>
                            {{ $s->signature }}
                        </td>
                        <td>{{ $s->description}}
                        </td>
                    </tr>
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


@if(Auth::user()->type->name == 'admin')
    <div class="modal fade" id="modal-add-signature">
        <div class="modal-dialog">
            <div class="modal-content modal-lg" width="">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar nueva firma</h4>
                </div>

                {{ Form::model(new Signature(),['id'=>'signature-form','action'=>'SignatureController@store','role'=>'form','class'=>'form-horizontal form-bordered','data-parsley-validate'=>'true', 'name'=>'demo-form', 'enctype'=>'multipart/form-data']) }}
                <div class="modal-body">
                    @if(count($errors)>0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('signature','Firma',[])}}
                                {{Form::text('signature',null,['class'=>'form-control'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                {{Form::label('description','Descripción')}}
                                {{Form::textarea('description',null,['class'=>'form-control','rows'=>'5'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                {{Form::label('recommendation','Recomendaciones')}}
                                {{Form::textarea('recommendation',null,['class'=>'form-control','rows'=>'5'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                {{Form::label('reference','Referencias')}}
                                {{Form::textarea('reference',null,['class'=>'form-control','rows'=>'5'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                {{Form::label('risk','Riesgo')}}
                                {{Form::textarea('risk',null,['class'=>'form-control','rows'=>'5'])}}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::reset('Limpiar campos',['class'=>'btn btn-sm btn-default'])}}
                    <a href="javascript:submitSignatureForm();" class="btn btn-sm btn-success">Guardar</a>
                    <a href="javascript:" class="btn btn-sm btn-white" data-dismiss="modal">Cancelar</a>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>


    <script>
        function submitSignatureForm() {
            $('#signature-form').submit();
        }

        @if(count($errors)>0)
        $(document).ready(function () {
                    $('#modal-add-signature-link').click();
                });
        @endif

    </script>
@endif


@stop
