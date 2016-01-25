<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="shortcut icon" href="{{ asset('custom/favicon.ico') }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Xenon Boostrap Admin Panel"/>
    <meta name="author" content="Laborator.co"/>
    <title>[GCS][IM] - Iniciar sesión</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Arimo:400,700,400italic" id="style-resource-1">
    <link rel="stylesheet" href="xenon/assets/css/fonts/linecons/css/linecons.css" id="style-resource-2">
    <link rel="stylesheet" href="xenon/assets/css/fonts/fontawesome/css/font-awesome.min.css" id="style-resource-3">
    <link rel="stylesheet" href="xenon/assets/css/bootstrap.css" id="style-resource-4">
    <link rel="stylesheet" href="xenon/assets/css/xenon-core.css" id="style-resource-5">
    <link rel="stylesheet" href="xenon/assets/css/xenon-forms.css" id="style-resource-6">
    <link rel="stylesheet" href="xenon/assets/css/xenon-components.css" id="style-resource-7">
    <link rel="stylesheet" href="xenon/assets/css/xenon-skins.css" id="style-resource-8">
    <link rel="stylesheet" href="xenon/assets/css/custom.css" id="style-resource-9">
    <script src="xenon/assets/js/jquery-1.11.1.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --> <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]-->
    <!-- TS1444235288: Xenon - Boostrap Admin Template created by Laborator -->

    <script src="{{asset('custom/assets/js/login.js')}}"></script>
    <link rel="stylesheet" href="custom/assets/css/custom.css">
</head>
<body class="page-body login-page login-light">
<!-- TS14442352882435: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates -->
<div class="bg-image">

</div>
<div class="login-logo"></div>
<div class="login-container">
    <div class="row">
        <div class="col-sm-6">
            <div class="errors-container">

                <div class="row">
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
                                <button type="button" class="close" data-dismiss="alert"><span
                                            aria-hidden="true">×</span>
                                    <span class="sr-only">Close</span>
                                </button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            {!! Form::model(Auth::user(),['route'=>'login.post','role'=>"form", 'id'=>"login", 'class'=>"login-form fade-in-effect"])!!}
            <div class="login-header">
                <a href="xenon/dashboard/variant-1/" class="logo">
                    <img src="{{asset('custom/assets/img/logo-bgclaro.png')}}" alt="" width="150"/>
                    <span>log in</span>
                </a>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="username" id="username" autocomplete="off"
                       placeholder="Usuario"/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" autocomplete="off"
                       placeholder="Contraseña"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block text-left"><i class="fa-lock"></i>
                    Iniciar sesión
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script src="xenon/assets/js/bootstrap.min.js" id="script-resource-1"></script>
<script src="xenon/assets/js/TweenMax.min.js" id="script-resource-2"></script>
<script src="xenon/assets/js/resizeable.js" id="script-resource-3"></script>
<script src="xenon/assets/js/joinable.js" id="script-resource-4"></script>
<script src="xenon/assets/js/xenon-api.js" id="script-resource-5"></script>
<script src="xenon/assets/js/xenon-toggles.js" id="script-resource-6"></script>
<script src="xenon/assets/js/jquery-validate/jquery.validate.min.js" id="script-resource-7"></script>
<script src="xenon/assets/js/toastr/toastr.min.js" id="script-resource-8"></script>
<!-- JavaScripts initializations and stuff -->
<script src="xenon/assets/js/xenon-custom.js" id="script-resource-9"></script>
</body>
</html>
