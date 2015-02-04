@extends('layouts.master')

@section('head')
<script>

$(document).ready(function() {
  $('#attack_id').change(function(){
      $.get('/attack/'+$('#attack_id').val(), function( data ){
        alert(data);
      });
    });
 });
</script>
@stop

@section('content')


 {{ Form::open(array('id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"attack-form")); }}
 {{
   Form::select('attack_id', $attacks, [
    'class'=>'form-control parsley-validated','id'=>'attack_id']);
  }}

 {{ Form::close(); }}


<div class="col-md-12" style="min-width:800px;">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">

                            <h4 class="panel-title">Ataques Registrados</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered table-hover  ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php $i=0; ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
@stop




