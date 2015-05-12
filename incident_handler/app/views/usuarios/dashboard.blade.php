@extends('layouts.master')

@section('content')

       <!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="/" style="color:#FFF">Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
      <h1 class="page-header" style="color:#FFF">Bienvenido {{ Auth::user()->incidentHandler->name." ". Auth::user()->incidentHandler->lastname }}
                                              </h1>
			<!-- end page-header -->

			<!-- begin row -->

				<!-- end col-3 -->


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
          <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#default-tab-1" data-toggle="tab">Eventos Recientes</a> </li>
            <li class=""><a href="#default-tab-2" data-toggle="tab">Incidentes pendientes de Cierre <span class="badge badge-danger"><?php echo count($closure) ?></span></a></li>
            <li class=""><a href="#default-tab-3" data-toggle="tab">Notificaciones de incidentes <span class="badge badge-danger"><?php echo count($notification) ?></span></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade active in" id="default-tab-1">
              
              
             



            </div>
            <div class="tab-pane fade" id="default-tab-2">
              <div data-scrollbar="true" data-height="250px">
                    <table class="table">
                                <thead>
                                    <tr>
                                        <th width="10%">Incidente</th>
                                        <th>Alerta</th>
                                        <th>Status</th>
                                        <th>Severidad</th>
                                        <th>Detección</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                  <?php foreach ($closure as $n): ?>
                                 
                                  
                                  <?php if ($n->criticity=="ALTA"): ?>
                                    <tr class="danger">
                                  <?php endif ?>
                                  <?php if ($n->criticity=="MEDIA"): ?>
                                    <tr class="warning">
                                  <?php endif ?>
                                  <?php if ($n->criticity=="BAJA"): ?>
                                    <tr class="success">
                                  <?php endif ?>
                                      <?php 
                                          $det_time = Time::where('time_types_id', '=', '1')->where('incidents_id', '=', $n->id)->first();
                                          
                                          $now = time(); // or your date as well
                                          $your_date = strtotime(date("Y-m-d",strtotime($det_time->datetime)));
                                          $datediff = $now - $your_date;
                                          $diff= floor($datediff/(60*60*24));

                                        ?>
                                        <td><a href='/incident/view/<?php echo $n->id ?>'><?php echo $n->title ?></a></td>
                                        <td>Este incidente lleva más de <?php echo $diff ?> días sin cerrar</td>
                                        <td><?php echo $n->status->name ?> </td>
                                        <td><?php echo $n->criticity ?> </td>

                                        
                                        <td><?php echo $det_time->datetime ?> </td>
                                    </tr>
                                  <?php endforeach ?>
                                    
                                    
                                </tbody>
                            </table>
              </div>
            </div>
            <div class="tab-pane fade" id="default-tab-3">
               <div data-scrollbar="true" data-height="250px">
                    <table class="table">
                                <thead>
                                    <tr>
                                        <th width="25%">Incidente</th>
                                        <th width="15%">Contenido</th>
                                        <th>Status</th>
                                        <th>Severidad</th>
                                        <th width="100px">Detección</th>
                                        <th>Comentario de...</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($history_notification as $n): ?>
                                  <?php 
                                          $det_time = Time::where('time_types_id', '=', '1')->where('incidents_id', '=', $n->incidents_id)->first();
                                  ?>
                                    <?php if ($n->incident->criticity=="ALTA"): ?>
                                      <tr class="danger">
                                    <?php endif ?>
                                    <?php if ($n->incident->criticity=="MEDIA"): ?>
                                      <tr class="warning">
                                    <?php endif ?>
                                    <?php if ($n->incident->criticity=="BAJA"): ?>
                                      <tr class="success">
                                    <?php endif ?>
                                      <td><a href='/incident/view/<?php echo $n->incidents_id ?>'><?php echo $n->incident->title ?></a></td>
                                      <td><?php echo substr($n->content, 0, 50) ?> ... </td>
                                      <td><?php echo $n->incident->status->name ?></td>
                                      <td><?php echo $n->incident->criticity ?></td>
                                      <td><?php echo $det_time->datetime ?></td>
                                      <td>
                                          <?php if ($n->owner): ?>
                                            <?php echo $n->owner->name ?> <?php echo $n->owner->lastname ?>
                                          <?php endif ?> 
                                      </td>
                                      <td>
                                        <?php if ($n->attend!="1"){ ?>

                                          <a onclick="attend($(this),<?php echo $n->id ?>)" class="btn btn-primary btn-xs m-r-5">Marcar como atendido</a>
                                        <?php } else{ ?>
                                          <?php  echo "Esta notificación ya fue atendida";?>
                                        <?php } ?>
                                        
                                      

                                      </td>
                                    </tr>
                                  <?php endforeach ?>
                                  
                                </tbody>
                            </table>
              </div>
            </div>
          </div>
          
          
        </div>
          <!-- end col-6 -->


     

			</div>
			<!-- end row -->
			<script charset="utf-8">
				$(document).ready(function (){
					<?php foreach ($notification as $n): ?>
						$.gritter.add({
							title:"<?php echo $n->created_at ?>",
							text:"<a onmouseover='readed(<?php echo $n->id ?>)' href='/incident/view/<?php echo $n->incidents_id ?>'>Comentario sobre incidente<br><?php echo $n->incident->title ?></a>",
							image:"/assets/img/handler.png",
							sticky:true,
							time:"",
							class_name:"my-sticky-class"
						});
					<?php endforeach ?>

					

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
        }

        function readed(id) {
          
          $.ajax({
                    type: "POST",
                    url: "/incident/observation/read",
                    async: false,
                    data: {id: id},
                    success: function (result) {
                        
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    }
                })
        }

			</script>


@stop
