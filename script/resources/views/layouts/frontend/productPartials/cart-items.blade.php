@foreach (Cart::instance('shopping_'.request('store'))->content() as $cart)
    <li>
        <div class="cart-item-desc">
            <a href="{{ route('frontend.products.show', [request('store'), $cart->id]) }}" class="image">
                <img src="{{ asset($cart->options['image']) }}" class="cart-thumb" alt="">
            </a>
            <div>
                <a href="{{ route('frontend.products.show', [request('store'), $cart->id]) }}">{{ Str::limit($cart->name, 20, '...') }}</a>
                <p>{{ $cart->qty }} x - <span class="price">{{ user_currency($cart->options['user'] ?? null)->symbol . ($cart->qty * $cart->price) }}</span></p>
            </div>
        </div>
        <span class="dropdown-product-remove cart__close"  data-id="{{ $cart->rowId }}"><i class="fas fa-times"></i></span>
    </li>
@endforeach
