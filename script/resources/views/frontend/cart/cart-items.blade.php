<div class="row">
    <div class="col-lg-8">
        <form action="{{ route('frontend.cart.create') }}" method="POST" class="update-cart">
            @csrf
            @method('put')

            <div class="shopping__cart__table">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Quantity') }}</th>
                                <th>{{ __('Sub Total') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::instance('shopping_'.request('store'))->content() as $product)
                            <tr>
                                <td class="product__cart__item">
                                    <input type="hidden" value="{{ $product->rowId }}" min="1" max="10" name="rowid[]" class="rowid">
                                    <div class="product__cart__item__pic">
                                        <img src="{{ asset($product->options['image'] ?? '') }}" class="cart-thumb" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <h5>{{ user_currency($product->options['user'] ?? null)->symbol . ($product->qty * $product->price) }}</h5>
                                    </div>
                                </td>
                                <input type="hidden" value="{{ request('store') }}" name="store">
                                <input type="hidden" value="1" name="update">
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <span class="fa fa-angle-left dec qtybtn"></span>
                                            <input type="text" value="{{ $product->qty }}" min="1" max="10" name="qty[]" class="qty">
                                            <span class="fa fa-angle-right inc qtybtn"></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart__price">{{ user_currency($product->options['user'] ?? null)->symbol . ($product->price) }}</td>
                                <td class="cart__price">{{ user_currency($product->options['user'] ?? null)->symbol . ($product->qty * $product->price) }}</td>
                                <td class="cart__close cursor-pointer submit-btn" data-id="{{ $product->rowId }}"><i class="far fa-window-close"></i></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="continue__btn">
                        <a type="button" href="{{ route('frontend.store-products', request('store')) }}">{{ __('Continue Shopping') }}</a>
                    </div>
                </div>
                @if (Cart::instance('shopping_'.request('store'))->count() > 0)
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="continue__btn update__btn">
                        <button type="submit">{{ __('Update Shopping cart') }}</button>
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>
    <div class="col-lg-4">
        <div class="cart__total cart__discount">
            <h6>{{ __('Cart total') }}</h6>
            <ul>
                <li>{{ __('Subtotal') }} <span>{{ user_currency($store->user)->symbol . Cart::instance('shopping_'.request('store'))->subtotal() }}</span></li>
                <li>{{ __('Total') }} <span>{{ user_currency($store->user)->symbol . Cart::instance('shopping_'.request('store'))->subtotal() }}</span></li>
            </ul>
            @if (Cart::instance('shopping_'.request('store'))->count() > 0)
            <div class="btn-area text-center">
                <a href="{{ route('frontend.checkout.index', ['store' => request('store')]) }}" class="primary-btn">{{ __('Proceed to checkout') }}</a>
            </div>
            @endif
        </div>
    </div>
</div>

<input type="hidden" id="cart-route" value="{{ route('frontend.cart.index') }}">
<input type="hidden" id="store" value="{{ request('store') }}">
