@extends('layouts.master')
@section('content')



  <!-- begin #page-loader -->
  <!-- <div id="page-loader" class="fade in"><span class="spinner"></span></div> -->
  <!-- end #page-loader -->

  <!-- begin #page-container -->

      <h1 class="page-header">Reporte de incidente<small> 22/01/2014</small></h1>
      <!-- end page-header -->

      <div class="panel panel-inverse">
          <div class="panel-heading">
              <div class="panel-heading-btn">
                  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                  <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                  <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
              </div>
              <h4 class="panel-title">{{ $incident_title }}</h4>
          </div>
          <div class="panel-body">
              <div class="form-group">
                <table class="table table-bordered">

                <tr>
                    <th rowspan="2" >Categoria</th>
                    <th colspan="2" >Descripcion</th>
                </tr>

                <tr>
                  <td> Aqui va la categoria</td>
                  <td>Aqui va la Descripcion</td>
                </tr>
                @for($i = 1; $i < 10; $i++)
                  <tr>
                    <th>Ticket</th>
                    <td colspan="2" >Aqui va el ticket.</td>
                </tr>
                @endfor
                <tr>
                    <td rowspan="2" >BlackList</td>
                    <th>IP</th>
                    <th>Pais de Origen</th>
                </tr>

                <tr>
                  <td> Aqui va la categoria</td>
                  <td>Aqui va la Descripcion</td>
                </tr>
                @for($i = 1; $i < 10; $i++)
                  <tr>
                    <th>Ticket</th>
                    <td colspan="2" >Aqui va el ticket.</td>
                </tr>
                @endfor
              </table>
              </div>
          </div>
      </div>
            <p>
                <a href="javascript:history.back(-1);" class="btn btn-success">
                    <i class="fa fa-arrow-circle-left"></i> Back to previous page
                </a>
            </p>



    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
  </div>
  <!-- end page container -->

  

@stop
