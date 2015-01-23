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


  <!-- begin #header -->
      @include('include.header')

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
