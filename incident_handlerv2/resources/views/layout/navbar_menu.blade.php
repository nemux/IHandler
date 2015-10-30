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
                    <i class="linecons-cog">
                    </i>
                </a>
                <a href="#" data-toggle="user-info-menu-horizontal">
                    <i class="fa-bell-o">
                    </i>
                    <span class="badge badge-success">7</span>
                </a>
                <a href="#" data-toggle="mobile-menu-horizontal">
                    <i class="fa-bars">
                    </i>
                </a>
            </div>
        </div>
        <div class="navbar-mobile-clear">
        </div>
        <!-- main menu -->
        <ul class="navbar-nav" id="main-menu">
            {{--Incidentes--}}
            <li>
                <a class="l1" href="{{route('incident.index')}}">
                    <i class="fa-exclamation-triangle"></i>
                    <span class="title">Incidentes</span>
                </a>
                <ul>
                    <li>
                        <a class="l2" href="{{route('incident.index')}}">
                            <span class="title">Lista de Incidentes</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{--Cibervigilancia--}}
            <li>
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
            <li>
                <a class="l1">
                    <i class="fa fa-file-pdf-o"></i>
                    <span class="title">Reportes</span>
                </a>
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
                        {{--Clientes--}}
                        <li>
                            <a class="l2" href="{{route('customer.index')}}">
                                <i class="fa fa-suitcase"></i>
                                <span class="title">Clientes</span>
                            </a>
                        </li>
                        {{--Usuarios--}}
                        <li>
                            <a class="l2" href="{{route('user.index')}}">
                                <i class="fa fa-user"></i>
                                <span class="title">Usuarios</span>
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
                                    <a class="l3">
                                        <i class="fa fa-signal"></i>
                                        <span class="title">Firmas de Detección</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="l3">
                                        <i class="fa fa-list"></i>
                                        <span class="title">Blacklist</span>
                                    </a>
                                </li>
                            </ul>
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
<script>
    $(document).ready(function () {
        $('#main-menu li a').each(function (index) {
            var path = window.location.href;
            var href = $(this).attr('href');

            if ($(this).attr("class") == 'l1') { //Validate if the menu item level is one
                if (path.indexOf(href) >= 0) {
                    $(this.parentNode).addClass('opened active expanded');
                }
            }
            if ($(this).attr("class") == 'l2') {//Validate if the menu item level is two
                if (href == path) {
                    $(this.parentNode).addClass('active');
                }
            }
        });
    });
</script>