<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head id='head'>
  @include('include.head')
  @yield('head')
</head>

<body onload="startTime()" style="background-image: url('/assets/img/login-bg/bg-1.jpg');background-size: cover;">

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
      		startTime();
			//Dashboard.init();
      		//Notification.init();
      		update_alerts();

		});
	</script>
<div id="script_from_alerts"></div>
  <script>
  	function update_alerts() {
         
          $.ajax({
                    type: "POST",
                    url: "/dashboard/get/alerts",
                    async: false,
                    success: function (result) {
                        
                        $("#script_from_alerts").append(result)
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
</body>
</html>
