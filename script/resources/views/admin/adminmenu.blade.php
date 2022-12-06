@foreach(config('adminmenu') as $menu)
    @if(isset($menu['header']))
        @if(isset($menu['can']))
            @canany($menu['can'])
                <li class="menu-header">{{ __($menu['header']) }}</li>
            @endcanany
        @else
            <li class="menu-header">{{ __($menu['header']) }}</li>
        @endif
    @elseif(isset($menu['submenu']))
        @php
            $isActive = false;
            foreach ($menu['patterns'] ?? [] as $pattern){
                $isActive = Request::is($pattern);
            }
        @endphp
        @canany($menu['can'])
            <li @class(['dropdown', 'active' => $isActive])>
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i @class([$menu['icon'] ?? null])></i>
                    <span>{{ __($menu['title']) }}</span>
                </a>
                <ul class="dropdown-menu">
                    @foreach($menu['submenu'] as $submenu)
                        @php
                            $isActive = false;
                            foreach ($submenu['patterns'] ?? [] as $pattern){
                                $isActive = Request::is(str($pattern)->replace('.', '/'));
                            }
                        @endphp
                        @canany($submenu['can'])
                            <li @class(['active' => $isActive])">
                                <a class="nav-link"
                                   href="{{ Route::has($submenu['route']) ? route($submenu['route']) : url($submenu['route']) }}">
                                    {{ __($submenu['title']) }}
                                </a>
                            </li>
                        @endcanany
                    @endforeach
                </ul>
            </li>
        @endcanany
    @else
    <li
        @php
        $isActive = false;
        foreach ($menu['patterns'] ?? [] as $pattern){
            $isActive = Request::is($pattern);
        }
        @endphp
        @class(['active' => $isActive])>
        @canany($menu['can'])
        <a
            class="nav-link"
            href="{{ Route::has($menu['route']) ? route($menu['route']) : url($menu['route']) }}"
        >
            <i @class([$menu['icon'] ?? null])></i>
            <span>{{ __($menu['title']) }}</span>
        </a>
        @endcanany
    </li>
    @endif
@endforeach
