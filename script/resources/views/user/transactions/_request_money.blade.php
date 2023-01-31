<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __('Charge') }}</th>
        <th>{{ __('Status') }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $transaction->sender->name }}&nbsp;[{{ $transaction->sender->email }}]</td>
            <td>{{ currency_format($transaction->amount, currency: $transaction->sender_currency) }}</td>
            <td>{{ currency_format($transaction->charge, currency: $transaction->sender_currency) }}</td>
            <td>{!! $transaction->PaymentStatus !!}</td>
            <td>{{ formatted_date($transaction->created_at, 'd M, Y h:i A') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
