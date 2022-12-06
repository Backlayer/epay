<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("Invoice No") }}</th>
        <th>{{ __("TRX") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $transaction->invoice_no }}</td>
            <td>{{ $transaction->trx }}</td>
            <td>{{ $transaction->name }}&nbsp;[{{ $transaction->email }}]</td>
            <td>{{ currency_format($transaction->amount, currency: Auth::user()->currency) }}</td>
            <td>{{ formatted_date($transaction->created_at, 'd M, Y h:i A') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
