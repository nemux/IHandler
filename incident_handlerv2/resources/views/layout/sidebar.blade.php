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
            <li class="opened active expanded">
                <a href="#">
                    <i class="fa-exclamation-triangle"></i>
                    <span class="title">Incidentes</span>
                </a>
                <ul>
                    <li class="active">
                        <a href="{{route('incident.index')}}">
                            <span class="title">Lista de Incidentes</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa-user"></i>
                    <span class="title">Usuarios</span>
                </a>
                <ul>
                    <li class="">
                        <a href="{{route('user.index')}}">
                            <span class="title">Lista de Usuarios</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>