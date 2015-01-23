
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Global Cybersec - Incident Handler</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/assets/css/style.min.css" rel="stylesheet" />
	<link href="/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="/assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->



<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
	<script src="/assets/crossbrowserjs/html5shiv.js"></script>
	<script src="/assets/crossbrowserjs/respond.min.js"></script>
	<script src="/assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="/assets/plugins/gritter/js/jquery.gritter.js"></script>
<script src="/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="/assets/plugins/flot/jquery.flot.pie.min.js"></script>
<script src="/assets/plugins/sparkline/jquery.sparkline.js"></script>
<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/js/dashboard.min.js"></script>
<script src="/assets/js/apps.min.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
</head>
<body onload="startTime()">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
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
		<!-- end #header -->

		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;"><img src="/assets/img/handler.png" alt="" /></a>
						</div>
						<div class="info">
							Incident Handler
						</div>
            {{ Auth::user()->username." "}}
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Menú</li>

          @if (Auth::user()->type->name == 'admin')
					<li class="has-sub ">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-user"></i>
						    <span>Incident Handler</span>
					    </a>
						<ul class="sub-menu">
						    <li><a href="/handler/create">Crear</a></li>
						    <li><a href="/handler/">Ver</a></li>
						</ul>
					</li>
          @endif
					@if (Auth::user()->type->name == 'admin')
					<li class="has-sub ">
						<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-eye"></i>
								<span>Sensores</span>
							</a>
						<ul class="sub-menu">
								<li><a href="/sensor/create">Crear</a></li>
								<li><a href="/sensor/">Ver</a></li>
						</ul>
					</li>
					@endif

					<li class="has-sub ">
						<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-bookmark"></i>
								<span>Incidentes</span>

						</a>
						<ul class="sub-menu">
								<li class=""><a href="/incident/create">Crear</a></li>
								<li><a href="#">Ver</a></li>
						</ul>
					</li>

			        <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
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
	<script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', '', 'auto');
      ga('send', 'pageview');
    </script>
</body>
</html>
