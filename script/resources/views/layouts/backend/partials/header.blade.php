<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link collapse_btn nav-link-lg">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
        <div class="search-element"></div>
    </form>
    <ul class="navbar-nav navbar-right">
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.clear-cache') }}" class="btn btn-danger mr-3">
                <i class="fas fa-redo"></i> {{ __('Clear Cache') }}
            </a>
        @endif

        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                <i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">{{ __('Notifications') }}
                    <div class="float-right">
                        <a href="javascript:void(0)" class="mark-all-as-read">{{ __('Mark All As Read') }}</a>
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons notification-content overflow-auto">

                </div>
                <div class="dropdown-footer text-center">
                    <a href="javascript:void(0)" class="notification-load-more">{{ __('Load More') }} <i class="fas fa-chevron-down"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : get_gravatar(Auth::user()->email) }}"
                     class="rounded-circle profile-widget-picture">

                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('admin.settings') }}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> {{ __('Profile') }}
                    </a>

                <div class="dropdown-divider"></div>
                <a
                    href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item has-icon text-danger"
                >
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
