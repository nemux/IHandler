<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('custom/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Xenon Boostrap Admin Panel"/>
    <meta name="author" content="Laborator.co"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic" id="style-resource-1">
    <link rel="stylesheet" href="xenon/assets/css/fonts/linecons/css/linecons.css"
          id="style-resource-2">
    <link rel="stylesheet" href="xenon/assets/css/fonts/fontawesome/css/font-awesome.min.css"
          id="style-resource-3">
    <link rel="stylesheet" href="xenon/assets/css/bootstrap.css" id="style-resource-4">
    <link rel="stylesheet" href="xenon/assets/css/xenon-core.css" id="style-resource-5">
    <link rel="stylesheet" href="xenon/assets/css/xenon-forms.css" id="style-resource-6">
    <link rel="stylesheet" href="xenon/assets/css/xenon-components.css"
          id="style-resource-7">
    <link rel="stylesheet" href="xenon/assets/css/xenon-skins.css" id="style-resource-8">
    <link rel="stylesheet" href="xenon/assets/css/custom.css" id="style-resource-9">
    <script src="xenon/assets/js/jquery-1.11.1.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --> <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]-->
    <!-- TS1444235273: Xenon - Boostrap Admin Template created by Laborator --> </head>
<body class="page-body">
<!-- TS14442352735272: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates -->
<!-- TS144423527315330: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates -->

<div class="page-container">
    <!-- TS14442352734973: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates -->
    @include('layout.sidebar')

    <div class="main-content">

        @include('layout.navbar')

        {{--        @include('layout.dummy_content')--}}

        @yield('dashboard_content')

                <!-- Main Footer -->
        <footer class="main-footer sticky footer-type-1">
            <div class="footer-inner">
                <div class="footer-text">
                    &copy; 2015 <strong>Global Cybersec</strong>
                </div>
                <div class="go-up"><a href="#" rel="go-top"> <i class="fa-angle-up"></i> </a></div>
            </div>
        </footer>
    </div>
</div>
<!-- TS14442352738285: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates -->

<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>
<script src="xenon/assets/js/bootstrap.min.js" id="script-resource-1"></script>
<script src="xenon/assets/js/TweenMax.min.js" id="script-resource-2"></script>
<script src="xenon/assets/js/resizeable.js" id="script-resource-3"></script>
<script src="xenon/assets/js/joinable.js" id="script-resource-4"></script>
<script src="xenon/assets/js/xenon-api.js" id="script-resource-5"></script>
<script src="xenon/assets/js/xenon-toggles.js" id="script-resource-6"></script>
<script src="xenon/assets/js/xenon-widgets.js" id="script-resource-7"></script>
<script src="xenon/assets/js/devexpress-web-14.1x/js/globalize.min.js"
        id="script-resource-8"></script>
<script src="xenon/assets/js/devexpress-web-14.1x/js/dx.chartjs.js"
        id="script-resource-9"></script>
<script src="xenon/assets/js/toastr/toastr.min.js" id="script-resource-10"></script>
<!-- JavaScripts initializations and stuff -->
<script src="xenon/assets/js/xenon-custom.js" id="script-resource-11"></script>
</body>
</html>