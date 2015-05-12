@extends('layouts.master')

@section('content')

       <!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="/" style="color:#FFF">Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
      <h1 class="page-header" style="color:#FFF">
        Bienvenido {{ Auth::user()->incidentHandler->name." ". Auth::user()->incidentHandler->lastname }}
      </h1>
			<!-- end page-header -->

			<!-- begin row -->

        <div class="row">
        <!-- begin col-4 -->
        <div class="col-md-4 col-sm-6">
          <div class="widget widget-stats bg-blue">
            <div class="stats-icon stats-icon-lg">
              <i class="fa fa-globe fa-fw"></i>
            </div>
            <div class="stats-info">
              <h4>Incidentes Abiertos</h4>
            </div>
            <div class="stats-number">
               {{ Incident::where('incident_handler_id', '=',Auth::user()->incident_handler_id )->
                            where('incidents_status_id','=',1)->count() }}
            </div>
            <div class="stats-link">
              <a href="/incident/open">
                Ir <i class="fa fa-arrow-circle-o-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- end col-4 -->

        <!-- begin col-4 -->
        <div class="col-md-4 col-sm-6">
          <div class="widget widget-stats bg-black">
            <div class="stats-icon stats-icon-lg">
              <i class="fa fa-search  fa-fw"></i>
            </div>
            <div class="stats-info">
              <h4>Incidentes en Investigaci&oacute;n</h4>
            </div>
            <div class="stats-number">
               {{ Incident::where('incident_handler_id', '=',Auth::user()->incident_handler_id )->
                            where('incidents_status_id','=',2)->count() }}
            </div>
            <div class="stats-link">
              <a href="/incident/investigation">
                Ir <i class="fa fa-arrow-circle-o-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- end col-4 -->

        <!-- begin col-4 -->
        <div class="col-md-4 col-sm-6">
          <div class="widget widget-stats bg-blue">
            <div class="stats-icon stats-icon-lg">
              <i class="fa fa-thumbs-o-up  fa-fw"></i>
            </div>
            <div class="stats-info">
              <h4>Incidentes Resueltos</h4>
            </div>
            <div class="stats-number">
               {{ Incident::where('incident_handler_id', '=',Auth::user()->incident_handler_id )->
                            where('incidents_status_id','=',3)->count() }}
            </div>
            <div class="stats-link">
              <a href="/incident/solved">
                Ver Detalles <i class="fa fa-arrow-circle-o-right"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- end col-4 -->


        <!-- begin col-6 -->
          <div class="col-md-12 ">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#default-tab-1" data-toggle="tab" onclick="update()">Eventos Recientes</a> </li>
            <li class=""><a href="#default-tab-2" data-toggle="tab" onclick="update()">Incidentes pendientes de Cierre <span class="badge badge-danger" id="count_closure"><?php //echo count($closure) ?></span></a></li>
            <li class=""><a href="#default-tab-3" data-toggle="tab" onclick="update()">Observaciones de incidentes <span class="badge badge-danger" id="count_observation"><?php //echo count($notification) ?></span></a></li>
          </ul>
          <div class="tab-content ">
            <div class="tab-pane fade active in" id="default-tab-1">
              <div data-scrollbar="true" data-height="300px" class="table-responsive">
                    <div class="table-responsive" id="notifications">
                    </div>
              </div>
            </div>
            <div class="tab-pane fade" id="default-tab-2">
              <div data-scrollbar="true" data-height="300px" class="table-responsive">
                    <div class="table-responsive" id="closures">
                    </div>
              </div>
            </div>
            <div class="tab-pane fade" id="default-tab-3">
               <div data-scrollbar="true" data-height="300px" class="table-responsive">
                    <div class="table-responsive" id="observations">
                    </div>
              </div>
            </div>
          </div>
          
          
        </div>
        <div class="col-xs-12">
            <div class="panel panel-inverse " data-sortable-id="ui-widget-1">
                        <div class="panel-body">
                            <a class="btn btn-primary btn-xs m-r-5" onclick="update()">
                              <i class="fa fa-refresh"></i> 
                              Actualizar Tablas
                            </a>
                        </div>
                    </div>
            
        </div>
          <!-- end col-6 -->

          <!-- begin panel -->
              
              <!-- end panel -->
     

			</div>
			<!-- end row -->
			<script charset="utf-8">
				$(document).ready(function (){
          update()
					
				});
        

        function attend(button,id) {
          button.addClass("disabled");
          button.parent().text("Esta notificación ya fue atendida")
          $.ajax({
                    type: "POST",
                    url: "/incident/observation/attend",
                    async: false,
                    data: {id: id},
                    success: function (result) {

                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                })
          update();
        }

        

        function update() {
          $("#observations").fadeOut()
          $("#observations").text("")
          $("#closures").fadeOut()
          $("#closures").text("")
          $("#notifications").fadeOut()
          $("#notifications").text("")
          $.ajax({
                    type: "POST",
                    url: "/dashboard/update/observations",
                    async: false,
                    success: function (result) {
                        
                        $("#observations").append(result)
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                })

          $.ajax({
                    type: "POST",
                    url: "/dashboard/update/closures",
                    async: false,
                    success: function (result) {
                        
                        $("#closures").append(result)
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                })
          $.ajax({
                    type: "POST",
                    url: "/dashboard/update/notifications",
                    async: false,
                    success: function (result) {
                        
                        $("#notifications").append(result)
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                })
          $("#observations").fadeIn()
          $("#closures").fadeIn()
          $("#notifications").fadeIn()
        }
        
        //setTimeout(update,200);

			</script>


@stop
