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
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-clock-o"></i></div>
						<div class="stats-info">
							<h4>Hora</h4>
						</div>
						<div class="stats-number">
                <p id="dash-clock"></p>
						</div>
					</div>
				</div>
				<!-- end col-3 -->

        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-green">
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
          </div>
        </div>
        <!-- end col-3 -->

        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
          <div class="widget widget-stats bg-green">
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
          </div>
        </div>
        <!-- end col-3 -->
			</div>
			<!-- end row -->
@stop









