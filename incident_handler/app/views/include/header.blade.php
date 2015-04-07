		<div id="header" class="header navbar navbar-inverse navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid " >
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header " >
					<a href="/" class="navbar-brand bg-blue" style="color:#FFF">Global Cybersec</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<!--<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>-->
					<!--
					<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							<span class="label">5</span>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
														<li class="dropdown-header">Notifications (5)</li>
														<li class="media">
																<a href="javascript:;">
																		<div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
																		<div class="media-body">
																				<h6 class="media-heading">Server Error Reports</h6>
																				<div class="text-muted f-s-11">3 minutes ago</div>
																		</div>
																</a>
														</li>
														<li class="media">
																<a href="javascript:;">
																		<div class="media-left"><img src="/assets/img/user-1.jpg" class="media-object" alt="" /></div>
																		<div class="media-body">
																				<h6 class="media-heading">John Smith</h6>
																				<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
																				<div class="text-muted f-s-11">25 minutes ago</div>
																		</div>
																</a>
														</li>
														<li class="media">
																<a href="javascript:;">
																		<div class="media-left"><img src="/assets/img/user-2.jpg" class="media-object" alt="" /></div>
																		<div class="media-body">
																				<h6 class="media-heading">Olivia</h6>
																				<p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
																				<div class="text-muted f-s-11">35 minutes ago</div>
																		</div>
																</a>
														</li>
														<li class="media">
																<a href="javascript:;">
																		<div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
																		<div class="media-body">
																				<h6 class="media-heading"> New User Registered</h6>
																				<div class="text-muted f-s-11">1 hour ago</div>
																		</div>
																</a>
														</li>
														<li class="media">
																<a href="javascript:;">
																		<div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>
																		<div class="media-body">
																				<h6 class="media-heading"> New Email From John</h6>
																				<div class="text-muted f-s-11">2 hour ago</div>
																		</div>
																</a>
														</li>
														<li class="dropdown-footer text-center">
																<a href="javascript:;">View more</a>
														</li>
						</ul>
					</li>

					-->
            <li class="media" >
							<div style="padding-top:18px;color:#FFF">

            			<?php echo date("d-m-Y") ?>
            		<a id="new_clock" ></a>
            	</div>
						</li>
					  <li class="dropdown navbar-user">
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
								<span class="hidden-xs">Mi sesión</span> <b class="caret"></b>
							</a>
							<ul class="dropdown-menu animated fadeInLeft">
								<li class="arrow"></li>
								<li><a href="#modal-message" class="	" data-toggle="modal">Change pass</a></li>
	              <li class="divider"></li>

								<li><a href="/logout">Log Out</a></li>

							</ul>
					  </li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
					<div class="modal modal-message fade" id="modal-message">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Cambio de password</h4>
										</div>
										<div class="modal-body">
										{{ Form::model(null,array('action' => 'IncidentHandlerController@passwordUpdate','role'=>"form", 'id'=>"form","class"=>"form-horizontal form-bordered","data-parsley-validate"=>"true", "name"=>"demo-form")) }}

											<div class="col-lg-4">
												Password Anterior
											</div>
											<div class="col-lg-8">
													<div class="form-group">
														<input class="form-control" type="password" name="old_pass" value="">
													</div>
											</div><br>
											<div class="col-lg-4">
												Password Nuevo
											</div>
											<div class="col-lg-8">
												<div class="form-group">
													<input class="form-control" type="password" name="new_pass" value="">
												</div>
											</div><br>
											<div class="col-lg-4">
												Token
											</div>
											<div class="col-lg-8">
												<div class="form-group">
													<input class="form-control" type="text" name="token" value="">
												</div>
											</div><br>
										</div>
										<div class="modal-footer" >
											<br>
											<input type="submit" class="btn btn-primary btn-sm pull-right" value="Cambiar Password" style="margin-left:10px">
											<a class="btn btn-default btn-sm pull-right" onclick="getToken()">Solicitar Token</a>

										</div>
										{{ Form::close() }}
									</div>
								</div>
							</div>
							<script charset="utf-8">
								function getToken(){
									$.post( "/handler/send/token" );
								}

							</script>