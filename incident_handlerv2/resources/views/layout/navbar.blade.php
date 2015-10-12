<nav class="navbar user-info-navbar" role="navigation">
    <ul class="user-info-menu left-links list-inline list-unstyled">
        <li class="hidden-sm hidden-xs">
            <a href="#" data-toggle="sidebar">
                <i class="fa-bars"></i>
            </a>
        </li>
    </ul>
    <ul class="user-info-menu right-links list-inline list-unstyled">
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
</nav>