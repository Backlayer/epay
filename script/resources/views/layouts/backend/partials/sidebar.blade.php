<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">{{ Config::get('app.name') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('login') }}">{{ Str::limit(env('APP_NAME'), $limit = 1) }}</a>
        </div>
        <ul class="sidebar-menu">
            @include('admin.adminmenu')
        </ul>

        <div class="mt-5 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-external-link-alt"></i> {{ __('You Website') }}
            </a>
        </div>
    </aside>
</div>
