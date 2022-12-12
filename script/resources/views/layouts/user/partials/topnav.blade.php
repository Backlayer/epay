<nav class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="{{ auth()->user()->name }}" src="{{ avatar() }}">
                            </span>
                            <div class="media-body ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm font-weight-bold">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ __("Welcome!") }}</h6>
                        </div>
                        <a href="{{ route('user.profiles.index') }}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>{{ __('My profile') }}</span>
                        </a>
                        <a href="{{ route('user.kyc-verifications.index') }}" class="dropdown-item">
                            <i class="ni ni-lock-circle-open"></i>
                            <span>{{ __('Kyc Verification') }}</span>
                        </a>
                        <a href="{{ route('user.api-keys.index') }}" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>{{ __("API Keys") }}</span>
                        </a>
                        <a href="{{ route('user.supports.index') }}" class="dropdown-item">
                            <i class="fas fa-cog"></i>
                            <span>{{ __('Support') }}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
