@if(!empty($menus))
    @foreach ($menus['data'] ?? [] as $key => $row)
        @if (isset($row->children))
            <li class="nav-item nav-item-has-children">
                <a href="{{ $row->href }}" class="nav-link-item drop-trigger">
                    {{ $row->text }}
                    <i class="fas fa-angle-down"></i>
                </a>
                <ul class="sub-menu" id="submenu-{{ $key }}">
                    @foreach($row->children as $childrens)
                        @include('components.menu.header.child', ['childrens' => $childrens])
                    @endforeach
                </ul>
            </li>
        @else
            <li>
                <a class="nav-link-item @if(url()->current() == url($row->href)) active @endif"  href="{{ url($row->href) }}" @if(!empty($row->target)) target="{{ $row->target }}" @endif>{{ $row->text }}</a>
            </li>
        @endif
    @endforeach
@endif
