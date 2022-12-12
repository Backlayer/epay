@if($childrens)
    <li class="sub-menu--item">
        <a href="{{ url($childrens->href) }}"
           @if(!empty($childrens->target)) target="{{ $childrens->target }}" @endif>{{ $childrens->text }}
        </a>

        @isset($childrens->children)
            <li class="nav-item">
                <a class="nav-link" href="{{ url($childrens->href) }}">{{ $childrens->text }}
                    <span class="sub-nav-toggler"></span>
                </a>
                <ul class="sub-menu">
                    @foreach($childrens->children ?? [] as $row)
                        @include('components.menu.header.child', ['childrens' => $row])
                    @endforeach
                </ul>
            </li>
        @endisset
    </li>
@endif
