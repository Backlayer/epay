<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>{{ __('Payment-invoice') }}</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/gateway/invoice.css') }}">

</head>

<body>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                {{config('app.name')}}
                            </td>

                            <td>
                                {{__('Today Date :')}} {{\Carbon\Carbon::now()->format('M d Y')}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>{{ __('User Info') }}<br></td>

                            <td>
                                {{$data->user->name}}<br>
                                {{$data->user->email}}<br>
                                {{$data->user->phone}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>{{ __('Title') }}</td>
                <td>{{ __('Details') }}</td>
            </tr>

            <tr class="item">
                <td>{{ __('payment Date') }}:</td>
                <td>{{$data->created_at->format('M d Y')}}</td>
            </tr>
            <tr class="item">
                <td>{{ __('payment Amount') }}:</td>
                <td>{{$data->price}}</td>
            </tr>

            <tr class="item">
                <td>{{ __('Gateway Method Name') }}:</td>
                <td>{{$data->gateway->name ?? 'null'}}</td>
            </tr>
            <tr class="item">
                <td>{{__('Trx Id')}}</td>
                <td>{{$data->trx ?? 'null'}}</td>
            </tr>

            <tr class="item">
                <td>{{__('Status')}}</td>
                <td>
                    @if($data->request->status == 1)
                    <span>{{ __('Active') }}</span>
                    @elseif($data->request->status == 2)
                    <span>{{ __('Pending') }}</span>
                    @else
                    <span>{{ __('Deactive') }}</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

</body>
</html>
