<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head id='head'>
  @include('include.head')
  @yield('head')
</head>

<body onload="startTime()">

	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
<<<<<<< HEAD

  <!-- begin #header -->
      @include('include.header')
=======
		<!-- begin #header -->
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

					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
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

						<li class="media" style="padding-top:3px;"><span id="nav-clock" class=" " style="color:#FFF"/></span></li>
					  <li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

							<span class="hidden-xs">Mi sesión</span> <b class="caret"></b>
						</a>

						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
              <li><a href="javascript:;"><span class="badge badge-anger pull-right">2</span> Inbox</a></li>
              <li class="divider"></li>
							<li><a href="/logout">Log Out</a></li>
						</ul>
					  </li>


				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
>>>>>>> b90e83fffb3a7fbb7b929a661d9ff8eeb09fe4e1
		<!-- end #header -->

		<!-- begin #sidebar -->
	    @include('include.sidebar')
		<!-- end #sidebar -->

		<!-- begin #content -->
		<div id="content" class="content">
			@yield('content')
		</div>
		<!-- end #content -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->



	<script>
		$(document).ready(function() {
			App.init();
			//Dashboard.init();
		});
	</script>

  <script>
    function startTime() {
      var today = new Date();
      var month = new Array();
      month[0] = "Ene";
      month[1] = "Feb";
      month[2] = "Mar";
      month[3] = "Abr";
      month[4] = "May";
      month[5] = "Jun";
      month[6] = "Jul";
      month[7] = "Ago";
      month[8] = "Sep";
      month[9] = "Oct";
      month[10] = "Nov";
      month[11] = "Dic";

      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      var d = today.getDate();
      var mo = month[today.getMonth()];
      var y = today.getFullYear();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('nav-clock').innerHTML = d+"/"+mo+"/"+y+" "+h+":"+m+":"+s;
      document.getElementById('dash-clock').innerHTML = d+"/"+mo+"/"+y+" "+h+":"+m+":"+s;
      var t = setTimeout(function(){startTime()},500);
    }

    function checkTime(i) {
      if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    }
  </script>
</body>
</html>
