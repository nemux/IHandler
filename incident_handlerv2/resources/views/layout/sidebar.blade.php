<div class="sidebar-menu toggle-others fixed">
    <div class="sidebar-menu-inner">
        <header class="logo-env">
            <!-- logo -->
            <div class="logo">
                <a href="{{route('dashboard.index')}}" class="logo-expanded">
                    <img src="{{asset('custom/assets/img/logo-bg-oscuro.png')}}" width="150" alt="">
                </a>
                <a href="{{route('dashboard.index')}}" class="logo-collapsed">
                    <img src="{{asset('custom/assets/img/logo-gcscert-bg-oscuro.png')}}" width="40" alt=""/>
                </a>
            </div>
            <div class="mobile-menu-toggle visible-xs">
                <a href="#" data-toggle="user-info-menu">
                    <i
                            class="fa-bell-o">
                    </i>
                    <span class="badge badge-success">7</span>
                </a>
                <a href="#"
                   data-toggle="mobile-menu">
                    <i class="fa-bars">
                    </i>
                </a>
            </div>
        </header>
        <ul id="main-menu" class="main-menu">
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
    </div>
</div>
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