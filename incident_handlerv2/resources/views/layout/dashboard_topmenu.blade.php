<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('custom/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <title>GCS IH | @yield('title')</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic" id="style-resource-1">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/fonts/linecons/css/linecons.css')}}" id="style-resource-2">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/fonts/fontawesome/css/font-awesome.min.css')}}"
          id="style-resource-3">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/bootstrap.css')}}" id="style-resource-4">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/xenon-core.css')}}" id="style-resource-5">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/xenon-forms.css')}}" id="style-resource-6">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/xenon-components.css')}}" id="style-resource-7">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/xenon-skins.css')}}" id="style-resource-8">
    <link rel="stylesheet" href="{{asset('/xenon/assets/css/custom.css')}}" id="style-resource-9">
    <script src="{{asset('/xenon/assets/js/jquery-1.11.1.min.js')}}"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --> <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]-->
    <!-- TS1444235278: Xenon - Boostrap Admin Template created by Laborator -->

    <link rel="stylesheet" href="{{asset('/custom/assets/css/custom.css')}}">

    @yield('include_up')
</head>
<body class="page-body">
@include('layout.navbar_menu')

<div class="page-container">
    <div class="main-content">
        <div class="page-title">
            <div class="title-env"><h1 class="title">@yield('title')</h1>

                <p class="description">@yield('section_description')</p>
            </div>
            <div class="breadcrumb-env">
                <ol class="breadcrumb bc-1">
                    <?php $href = '/'; ?>
                    @foreach(explode('/', \Route::getCurrentRequest()->decodedPath()) as $index=>$crumb)
                        <?php $href .= $crumb . '/'; ?>
                        <li>
                            @if($index==0)
                                <i class="fa-home"></i>
                            @endif

                            @if($index==sizeof(explode('/', \Route::getCurrentRequest()->decodedPath()))-1)
                                <strong>{{ucfirst($crumb)}}</strong>
                            @else
                                <a href='{{$href}}'>{{ucfirst($crumb)}}</a>
                            @endif

                        </li>
                    @endforeach
                </ol>
            </div>
            <div class="col-md-12">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (Session::has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span> <span
                                    class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('message') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        {{--        @include('layout.dummy_content')--}}

        @yield('dashboard_content')

                <!-- Main Footer -->
        {{--<footer class="main-footer sticky footer-type-1">--}}
        {{--<div class="footer-inner">--}}
        {{--<div class="footer-text">--}}
        {{--&copy; 2015 <strong>Global Cybersec</strong>--}}
        {{--</div>--}}
        {{--<div class="go-up"><a href="#" rel="go-top"> <i class="fa-angle-up"></i> </a></div>--}}
        {{--</div>--}}
        {{--</footer>--}}
    </div>
</div>
{{--<div class="page-loading-overlay">--}}
{{--<div class="loader-2"></div>--}}
{{--</div>--}}

<script src="{{asset('/xenon/assets/js/bootstrap.min.js')}}" id="script-resource-1"></script>
<script src="{{asset('/xenon/assets/js/TweenMax.min.js')}}" id="script-resource-2"></script>
<script src="{{asset('/xenon/assets/js/resizeable.js')}}" id="script-resource-3"></script>
<script src="{{asset('/xenon/assets/js/joinable.js')}}" id="script-resource-4"></script>
<script src="{{asset('/xenon/assets/js/xenon-api.js')}}" id="script-resource-5"></script>
<script src="{{asset('/xenon/assets/js/xenon-toggles.js')}}" id="script-resource-6"></script>

@yield('include_down')
        <!-- JavaScripts initializations and stuff -->
<script src="{{asset('/xenon/assets/js/xenon-custom.js')}}" id="script-resource-7"></script>
</body>
</html>