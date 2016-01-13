<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('custom/favicon.ico') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="author" content="Diego Miguel Angel López Muñoz;"/>
    <title>GCS IM | @yield('title')</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic" id="style-resource-1">
    <link rel="stylesheet" href="/xenon/assets/css/fonts/linecons/css/linecons.css" id="style-resource-2">
    <link rel="stylesheet" href="/xenon/assets/css/fonts/fontawesome/css/font-awesome.min.css" id="style-resource-3">
    <link rel="stylesheet" href="/xenon/assets/css/bootstrap.css" id="style-resource-4">
    <link rel="stylesheet" href="/xenon/assets/css/xenon-core.css" id="style-resource-5">
    <link rel="stylesheet" href="/xenon/assets/css/xenon-forms.css" id="style-resource-6">
    <link rel="stylesheet" href="/xenon/assets/css/xenon-components.css" id="style-resource-7">
    <link rel="stylesheet" href="/xenon/assets/css/xenon-skins.css" id="style-resource-8">
    <link rel="stylesheet" href="/xenon/assets/css/custom.css" id="style-resource-9">
    <link rel="stylesheet" href="/custom/assets/css/custom.css">
    {{--<script src="/xenon/assets/js/jquery-1.11.1.min.js"></script>--}}
    <script type="text/javascript" src="/custom/assets/js/DataTables/jQuery-2.1.4/jquery-2.1.4.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- TS1444235278: Xenon - Boostrap Admin Template created by Laborator -->
    <style>
        .toast::before {
            /*opacity: 1 !important;*/
            background-color: white;
        }
    </style>

    @yield('include_up')
</head>
<body class="page-body">
<nav class="navbar horizontal-menu navbar-fixed-top">
    <div class="navbar-inner">
        <div class="navbar-brand">
            <a href="{{route('dashboard.index')}}" class="logo">
                <img src="{{asset('custom/assets/img/logo-bgclaro.png')}}" width="80" alt="" class="hidden-xs"/>
                <img src="{{asset('custom/assets/img/logo-gcscert-bg-oscuro.png')}}" width="80" alt=""
                     class="visible-xs"/>
            </a>
        </div>
        <div class="nav navbar-mobile">
            <div class="mobile-menu-toggle">
                <a href="#" data-toggle="settings-pane" data-animate="true">
                    <i class="linecons-cog"></i>
                </a>
                <a href="#" data-toggle="user-info-menu-horizontal">
                    <i class="fa-bell-o"></i>
                    <span class="badge badge-success">7</span>
                </a>
                <a href="#" data-toggle="mobile-menu-horizontal">
                    <i class="fa-bars"></i>
                </a>
            </div>
        </div>
        <div class="navbar-mobile-clear">
        </div>
        <!-- main menu -->
        <ul class="navbar-nav">
            <li>
                <a class="l1" href="{{route('incident.index')}}">
                    <i class="fa-exclamation-triangle"></i>
                    <span class="title">Incidentes</span>
                </a>
                <ul>
                    <li>
                        <a class="l2" href="{{route('incident.search')}}">
                            <i class="fa fa-search"></i>
                            <span class="title">Buscador</span>
                        </a>
                    </li>
                    <li>
                        <a class="l2" href="{{route('incident.create')}}">
                            <i class="fa fa-plus"></i>
                            <span class="title">Agregar Incidente</span>
                        </a>
                    </li>
                    <li>
                        <a class="l2">
                            <i class="fa fa-file-pdf-o"></i>
                            <span class="title">Reportes</span>
                        </a>
                        <ul>
                            <li>
                                <a class="l3" href="{{route('report.incident','date')}}">
                                    <i class="fa"></i>
                                    <span class="title">...por Fecha</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('report.incident','handler')}}">
                                    <i class="fa"></i>
                                    <span class="title">...por Handler</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('report.incident','category')}}">
                                    <i class="fa"></i>
                                    <span class="title">...por Categoría</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('report.incident','criticity')}}">
                                    <i class="fa"></i>
                                    <span class="title">...por Severidad</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('report.incident','status')}}">
                                    <i class="fa"></i>
                                    <span class="title">...por Status</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('report.incident','ip')}}">
                                    <i class="fa"></i>
                                    <span class="title">... por IP</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('report.incident','csv')}}">
                                    <i class="fa"></i>
                                    <span class="title">CSV de Tickets</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="l2">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Estadísticas</span>
                        </a>
                        <ul>
                            <li>
                                <a class="l3" href="{{route('stats.customer')}}">
                                    <i class="fa fa-area-chart"></i>
                                    <span class="title">Incidentes por Cliente</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.eventside')}}">
                                    <i class="fa fa-list-ol"></i>
                                    <span class="title">Direcciones IP (Origen/Destino)</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.machinetype')}}">
                                    <i class="fa fa-list-ol"></i>
                                    <span class="title">Direcciones IP (Interna/Externa)</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.handler')}}">
                                    <i class="fa fa-area-chart"></i>
                                    <span class="title">Incidentes reportados por Handler</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.category')}}">
                                    <i class="fa fa-pie-chart"></i>
                                    <span class="title">Incidentes por Categoría</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.criticity')}}">
                                    <i class="fa fa-pie-chart"></i>
                                    <span class="title">Incidentes por Criticidad</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.attacktype')}}">
                                    <i class="fa fa-pie-chart"></i>
                                    <span class="title">Incidentes por Tipo de Ataque</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.sensor')}}">
                                    <i class="fa fa-pie-chart"></i>
                                    <span class="title">Incidentes por Sensor</span>
                                </a>
                            </li>
                            <li>
                                <a class="l3" href="{{route('stats.attackflow')}}">
                                    <i class="fa fa-pie-chart"></i>
                                    <span class="title">Incidentes por Flujo de Ataque</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            {{--Cibervigilancia--}}
            <li class="">
                <a class="l1" href="{{route('surveillance.index')}}">
                    <i class="fa fa-eye"></i>
                    <span class="title">Cibervigilancia</span>
                </a>
                <ul>
                    <li>
                        <a class="l2" href="{{route('surveillance.create')}}">
                            <i class="fa fa-plus"></i>
                            <span class="title">Agregar Caso de Cibervigilancia</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{--Helpdesk--}}
            <li class="">
                <a class="l1" href="{{route('helpdesk.index')}}">
                    <i class="fa fa-ticket"></i>
                    <span class="title">Helpdesk</span>
                </a>
                <ul>
                    <li>
                        <a class="l2" href="{{route('helpdesk.ticket.index')}}">
                            <i class="fa fa-table"></i>
                            <span class="title">Tickets</span>
                        </a>
                    </li>
                    <li>
                        <a class="l2" href="{{route('helpdesk.ticket.search')}}">
                            <i class="fa fa-search"></i>
                            <span class="title">Buscar</span>
                        </a>
                    </li>
                    <li>
                        <a class="l2">
                            <i class="fa fa-file-pdf-o"></i>
                            <span class="title">Reportes</span>
                        </a>
                        <ul>
                            <li><a><i></i><span>Lorem Ipsum</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="l2">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Estadísticas</span>
                        </a>
                        <ul>
                            <li><a><i></i><span>Lorem Ipsum</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            {{--Clientes--}}
            <li>
                <a class="l2" href="{{route('customer.index')}}">
                    <i class="fa fa-suitcase"></i>
                    <span class="title">Clientes</span>
                </a>
            </li>
            {{--Catálogos--}}
            <li>
                <a class="l2">
                    <i class="fa fa-book"></i>
                    <span class="title">Catálogos</span>
                </a>
                <ul>
                    <li>
                        <a class="l3" href="{{route('attack.index')}}">
                            <i class="fa fa-crosshairs"></i>
                            <span class="title">Tipos de ataque</span>
                        </a>
                    </li>
                    <li>
                        <a class="l3" href="{{route('category.index')}}">
                            <i class="fa fa-cubes"></i>
                            <span class="title">Categorías de un Incidente</span>
                        </a>
                    </li>
                    <li>
                        <a class="l3" href="{{route('criticity.index')}}">
                            <i class="fa fa-exclamation"></i>
                            <span class="title">Severidad (Criticidad)</span>
                        </a>
                    </li>
                    <li>
                        <a class="l3" href="{{route('flow.index')}}">
                            <i class="fa fa-arrows-h"></i>
                            <span class="title">Flujo del Ataque</span>
                        </a>
                    </li>
                    <li>
                        <a class="l3" href="{{route('signature.index')}}">
                            <i class="fa fa-signal"></i>
                            <span class="title">Firmas de Detección</span>
                        </a>
                    </li>
                    <li>
                        <a class="l3" href="{{route('machine.blacklist')}}">
                            <i class="fa fa-list"></i>
                            <span class="title">Blacklist</span>
                        </a>
                    </li>
                </ul>
            </li>
            @if(Auth::user()->isAdmin())
                {{--Administrar el sistema--}}
                <li>
                    <a class="l1">
                        <i class="fa fa-gears"></i>
                        <span class="title">Administrar Sistema</span>
                    </a>
                    <ul>
                        {{--OTRS--}}
                        <li>
                            <a class="l2" href="{{route('otrs.index')}}">
                                <i class="fa fa-ticket"></i>
                                <span class="title">OTRS</span>
                            </a>
                        </li>
                        {{--Usuarios--}}
                        <li>
                            <a class="l2" href="{{route('user.index')}}">
                                <i class="fa fa-user"></i>
                                <span class="title">Usuarios</span>
                            </a>
                        </li>
                        {{--Usuarios Helpdesk--}}
                        <li>
                            <a class="l2" href="{{route('helpdesk.user.index')}}">
                                <i class="fa fa-user"></i>
                                <span class="title">Usuarios Helpdesk</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
        <ul class="nav nav-userinfo navbar-right">
            <li class="dropdown user-profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('xenon/assets/images/user-4.png')}}" alt="user-image"
                         class="img-circle img-inline userpic-32"
                         width="28"/>
                <span>{{ Auth::user()->person->fullName() }}
                    <i class="fa-angle-down"></i>
                </span>
                </a>
                <ul class="dropdown-menu user-profile-menu list-unstyled">
                    <li>
                        <a href="#profile">
                            <i class="fa-user"></i> Profile
                        </a>
                    </li>
                    <li>
                        <a href="#help">
                            <i class="fa-info"></i> Help
                        </a>
                    </li>
                    <li class="last">
                        <a href="{{route('logout')}}">
                            <i class="fa-lock"></i> Cerrar sesion
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="page-container">
    <div class="main-content">
        <div class="jumbotron">
            <h2>@yield('title')</h2>

            <p>
                @yield('description')
            </p>
        </div>

        <div class="row">
            <div class="col-md-12">
                {{--@if (count($errors) > 0)--}}
                {{--<div class="alert alert-danger">--}}
                {{--<ul>--}}
                {{--@foreach ($errors->all() as $error)--}}
                {{--<li>{{ $error }}</li>--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--@endif--}}

                @if (Session::has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>{{ Session::get('message') }}</strong>
                    </div>
                @endif
            </div>
        </div>

        @yield('dashboard_content')
    </div>
</div>

<!-- TS144423527817774: Xenon - Boostrap Admin Template created by Laborator / Please buy this theme and support the updates -->
<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>

<script src="/xenon/assets/js/bootstrap.min.js" id="script-resource-1">
</script>
<script src="/xenon/assets/js/TweenMax.min.js" id="script-resource-2">
</script>
<script src="/xenon/assets/js/resizeable.js" id="script-resource-3">
</script>
<script src="/xenon/assets/js/joinable.js" id="script-resource-4">
</script>
<script src="/xenon/assets/js/xenon-api.js" id="script-resource-5">
</script>
<script src="/xenon/assets/js/xenon-toggles.js" id="script-resource-6">
</script>
@yield('include_down')
        <!-- JavaScripts initializations and stuff -->
<script src="/xenon/assets/js/xenon-custom.js" id="script-resource-7">
</script>
<script src="/xenon/assets/js/toastr/toastr.min.js"></script>
<script src="/custom/assets/js/socket.io/socket.io.js"></script>
<script src="/custom/assets/js/gcs-im/SocketIO.js"></script>
<script>
    $(document).ready(function () {

        @if (count($errors) > 0);
        var validation_errors = {
            "closeButton": false,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "300",
            "showEasing": "swing",
            "showMethod": "fadeIn",
            "timeOut": "0",
            "extendedTimeOut": "0",
            "hideEasing": "linear",
            "hideDuration": "300",
            "hideMethod": "fadeOut"
        };

        var errors = '<ul>';
        @foreach ($errors->all() as $error)
        errors += '<li>{{ $error }}</li>';
        @endforeach
        errors += '</ul>';
        toastr.error(errors, "Los datos intriducidos en el formulario son incorrectos", validation_errors);

        @endif;

        SocketIO.init('{{env('NODEJS_HOST')}}', {{env('NODEJS_PORT_SSL')}});
        SocketIO.start();
    });
</script>
</body>
</html>