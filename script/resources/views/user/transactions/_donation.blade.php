<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("Invoice No") }}</th>
        <th>{{ __("TRX") }}</th>
        <th>{{ __("Title") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Charge") }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $transaction->donation->title }}</td>
            <td>{{ $transaction->name }}&nbsp;[{{ $transaction->email }}]</td>
            <td>{{ convert_money_direct($transaction->amount, $transaction->currency, user_currency(), true) }}</td>
            <td>{{ convert_money_direct($transaction->charge, $transaction->currency, user_currency(), true) }}</td>
            <td>{{ formatted_date($transaction->created_at, 'd M, Y h:i A') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
