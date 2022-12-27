@if(!empty($menus))
    <h4>{{ $menus['name'] ?? null }}</h4>
    <ul>
        @foreach ($menus['data'] ?? [] as $key => $row)
            @if (isset($row->children))
                <li>
                    <a href="{{ $row->href }}">
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
                    <a href="{{ url($row->href) }}" @if(!empty($row->target)) target="{{ $row->target }}" @endif>{{ $row->text }}</a>
                </li>
            @endif
        @endforeach
    </ul>
@endif
