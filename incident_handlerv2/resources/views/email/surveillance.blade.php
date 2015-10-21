<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('custom/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>GCS IH | Cibervigilancia</title>

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
</head>
<body class="page-body">

<div class="page-container">
    <div class="main-content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Cliente: <b>{{$case->customer->name}}</b></h3>

                <div class="panel-options"><a href="#" data-toggle="panel">
                        <span class="collapse-icon">&ndash;</span>
                        <span class="expand-icon">+</span> </a>
                </div>
            </div>
            <div class="panel-body">
                @include('surveillance._preview')
            </div>
        </div>
    </div>
</div>

<script src="{{asset('/xenon/assets/js/bootstrap.min.js')}}" id="script-resource-1"></script>
<script src="{{asset('/xenon/assets/js/TweenMax.min.js')}}" id="script-resource-2"></script>
<script src="{{asset('/xenon/assets/js/resizeable.js')}}" id="script-resource-3"></script>
<script src="{{asset('/xenon/assets/js/joinable.js')}}" id="script-resource-4"></script>
<script src="{{asset('/xenon/assets/js/xenon-api.js')}}" id="script-resource-5"></script>
<script src="{{asset('/xenon/assets/js/xenon-toggles.js')}}" id="script-resource-6"></script>
<script src="{{asset('/xenon/assets/js/xenon-custom.js')}}" id="script-resource-7"></script>
</body>
</html>


