@extends('layouts.frontend.store')

@section('title', __('Order invoice page'))

@section('content')
<section class="shopping-cart spad py-5">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-12 mb-3 text-center">
                        <h2>{{ $order->storefront->name ?? '' }}</h2>
                        <small><i class="fas fa-map-marker-alt"></i> {{ Str::limit($order->storefront->description ?? '', 30, '...') }} </small>
                    </div>
                </div>
                <div class="shopping__cart__table order-list">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th>{{ __('S/N') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Product') }}</th>
                                    @if ($order->storefront->product_type == 1)
                                    <th>{{ __('Confirmation message') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderitems as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img width="70" src="{{ asset($item->product->image) }}" alt=""></td>
                                    <td>{{ $item->product->name }}</td>
                                    @if ($order->storefront->product_type == 1)
                                    <td>{{ $item->product->confirmation_message }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h6 class="text-center mt-4"><strong>{{ __('Thanks for purchasing from us. please check your mail for your invoice.') }}</strong></h6>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
