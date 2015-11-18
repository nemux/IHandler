@extends('layout.dashboard_topmenu')

@section('title','OTRS Importar Datos')

@section('section_description','Permite importar información contenida en el OTRS, como los clientes recién creados')

@section('dashboard_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Importar Datos</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="btn btn-success" id="otrs-import-customer-btn">
                        Importar Datos de Clientes
                    </div>
                </div>
                <div class="col-md-8">

                </div>
            </div>
        </div>
    </div>

    @include('modal.alert')
@endsection

@section('include_down')
    <script>
        $(document).ready(function () {
            $('#otrs-import-customer-btn').click(function () {
                $.ajax({
                    url: '{{route('otrs.customer.synch')}}',
                    type: 'post',
                    dataType: 'json',
                    success: function (result) {
                        if (result.status) {
                            if (result.count > 0)
                                var child = '<p>Se importaron datos de <b>' + result.count + ' clientes</b> desde el OTRS</p>';
                            else
                                var child = '<p>No hubo datos qué importar</p>';

                            $('#modal-alert-message').empty();
                            $('#modal-alert-message').append(child);
                            $('#modal-alert').modal('show', {backdrop: 'static'});
                        }
                    },
                    fail: function (result) {
                        $('#modal-alert-message').empty();
                        $('#modal-alert-message').append('<p>Error en la petición Ajax</p><br>' + result);
                        $('#modal-alert').modal('show', {backdrop: 'static'});
                    }
                });
            });
        });
    </script>
@endsection