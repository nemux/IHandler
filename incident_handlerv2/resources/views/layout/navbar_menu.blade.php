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
        <ul class="navbar-nav">
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
            <li>
                <a class="l1" href="{{route('user.index')}}">
                    <i class="fa-user"></i>
                    <span class="title">Usuarios</span>
                </a>
                <ul>
                    <li>
                        <a class="l2" href="{{route('user.index')}}">
                            <span class="title">Lista de Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a class="l2" href="{{route('user.create')}}">
                            <span class="title">Agregar Usuario</span>
                        </a>
                    </li>
                </ul>
            </li>
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
//        console.log('ready2');

        $('#main-menu li a').each(function (index) {
//            console.log(index);
            var path = window.location.href;
//            console.log('Path: ' + path);
            var href = $(this).attr('href');
//            console.log('Url: ' + href);

//            console.log();

            if ($(this).attr("class") == 'l1') { //Validate if the menu item level is one
                if (path.indexOf(href) >= 0) {
//                    console.log('contains text');
                    $(this.parentNode).addClass('opened active expanded');
                }
            }
            if ($(this).attr("class") == 'l2') {//Validate if the menu item level is two
                if (href == path) {
//                    console.log('equals text');
                    $(this.parentNode).addClass('active');
                }
            }
        });

    });
</script>