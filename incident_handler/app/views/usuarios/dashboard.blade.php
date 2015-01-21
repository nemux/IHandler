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
							<p id="reloj"></p>
						</div>
						<div class="stats-link">
						</div>
					</div>
				</div>
				<!-- end col-3 -->
			</div>
			<!-- end row -->
@stop







