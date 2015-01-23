
@extends('layouts.master')
@section('content')

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
  <link href="/assets/plugins/DataTables/css/data-table.css" rel="stylesheet" />
  <!-- ================== END PAGE LEVEL STYLE ================== -->

  <!-- ================== BEGIN BASE JS ================== -->
  <script src="/assets/plugins/pace/pace.min.js"></script>
  <!-- ================== END BASE JS ================== -->
<script>
    $(document).ready(function() {

      TableManageDefault.init();
    });
  </script>
         {{ Form::open(array('url' => 'IncidentController@edit' . $incident->id)) }}
                {{ Form::open(array('files' => true)) }}
                <div class="col-md-12" style="min-width:800px;">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">

                            <h4 class="panel-title">Vista de Incidente</h4>
                        </div>
                        <div class="panel-body">

                                       <thead>
                                    <table>
                                        <tr>




                                        <table>
                                          @foreach($incident as $larala)
                            <tr><td>{{$incident->title}} - {{$incident->risk}}</td></tr>
                           <tr><td>{{$incident->criticity}} - {{$incident->impact}}</td></tr>
                           <tr><td>{{$incident->conclution}} - {{$incident->description}}</td></tr>
                                            @endforeach
                                                          </table>

                                              <td>   
                                            {{ Form::label ('title', 'title') }}
                                                      </td>
                                            {{ Form::label ('title', $incident->title) }}
                                                    <br>
                                            {{ Form::label ('risk', 'Risk:            ') }}
                                            {{ Form::label ('risk', $incident->risk) }} 

                                                         <br /> 
                                            {{ Form::label('criticity', 'Criticity') }}                                         
                                            {{ Form::label('criticity' ,$incident->criticity) }}        
                                                        <br/>
                                           {{ Form::label('impact', 'Impact') }}
                                           {{ Form::label('impact' ,$incident->impact) }}       
                                            <br/>                 
                                           {{ Form::label('description', 'Description') }}    
                                           {{ Form::label('description' ,$incident->description) }}
                                                  <br>
                                          {{ Form::label('file', 'File') }}
                                          {{ Form::label('file' ,$incident->file) }}  
                                                  <br/>    
                                        {{ Form::label('conclution','Conclution') }} 
                                    {{ Form::label('conclution', $incident->conclution) }}    
                                                  <br/>
                                          {{ Form::label('recomendation', 'Recomendation') }}
                                            {{ Form::label('recomendation', $incident->recomendation) }}
                                                                <br>
                                            <br> 
 


                   
                        </div>
       
                  
                                    <thead>

                                    </thead>
                                    <tbody>
                                                        <br>
                                                        <br>
                                                        <br>

                                              {{ link_to('users', 'Cancelar') }}
                                              {{ Form::close() }}
                                        </tr>
                                    </thead>
                                    <tbody>
                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                  {{Form::submit('Aprobar',['class'=>'btn btn-primary pull-right ']);}}
                  {{Form::submit('Cancelar',['class'=>'btn btn-primary pull-left ']);}}
                </div>

  <!-- ================== BEGIN PAGE LEVEL JS ================== -->
  <script src="/assets/plugins/DataTables/js/jquery.dataTables.js"></script>
  <script src="/assets/js/table-manage-default.demo.min.js"></script>
  <script src="/assets/js/apps.min.js"></script>
  <!-- ================== END PAGE LEVEL JS ================== -->


@stop
