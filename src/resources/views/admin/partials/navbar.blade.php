<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route("admin.dashboard") }}">
            <img src="{{ asset("admin-assets/images/logo.png") }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route("admin.dashboard") }}">
            <img src="{{ asset("admin-assets/images/logo-mini.png") }}" alt="logo" />
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ "https://www.gravatar.com/avatar/".md5(auth()->user()->email) }}" alt="{{ auth()->user()->name }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ "https://www.gravatar.com/avatar/".md5(auth()->user()->email) }}" alt="{{ auth()->user()->name }}">
                        <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route("admin.profile") }}" class="dropdown-item">
                        My Profile
                        <i class="dropdown-item-icon ti-dashboard"></i>
                    </a>
                    <a href="{{ route("admin.update-password") }}" class="dropdown-item">
                        Update Password
                        <i class="dropdown-item-icon ti-key"></i>
                    </a>
                    <a href="{{ route("admin.logout") }}" class="dropdown-item">
                        Sign Out
                        <i class="dropdown-item-icon ti-power-off"></i>
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
