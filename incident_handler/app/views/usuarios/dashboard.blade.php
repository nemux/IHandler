@extends('layouts.master')

@section('content')

       <!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="/">Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
      <h1 class="page-header">Dashboard <small>Bienvenido {{ Auth::user()->incidentHandler->name." " }}
                                              {{Auth::user()->incidentHandler->lastname}}</small></h1>
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
              <h4>Incidentes en Resueltos</h4>
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

			</div>
			<!-- end row -->
			<script charset="utf-8">
				$(document).ready(function (){
					<?php foreach ($notification as $n): ?>
						$.gritter.add({
							title:"<?php echo $n->created_at ?>",
							text:"<a href='/incident/view/<?php echo $n->incidents_id ?>'>Comentario sobre incidente<br><?php echo $n->incident->title ?></a>",
							image:"/assets/img/handler.png",
							sticky:true,
							time:"",
							class_name:"my-sticky-class"
						});
					<?php endforeach ?>

					<?php foreach ($closure as $n): ?>
						$.gritter.add({
							title:"<?php echo $n->title ?>",
							text:"<a href='/incident/view/<?php echo $n->id ?>'>Este incidente lleva más de 5 días sin cerrar</a>",
							image:"/assets/img/handler.png",
							sticky:true,
							time:"",
							class_name:"my-sticky-class"
						});
					<?php endforeach ?>

				});
			</script>


@stop
