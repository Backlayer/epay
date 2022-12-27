<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("Invoice No") }}</th>
        <th>{{ __("TRX") }}</th>
        <th>{{ __("Item Name") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Charge") }}</th>
        <th>{{ __("Due Date") }}</th>
        <th>{{ __("Paid") }}</th>
        <th>{{ __("Paid At") }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $transaction->invoice_no }}</td>
            <td>{{ $transaction->trx }}</td>
            <td>{{ $transaction->item_name }}</td>
            <td>{{ $transaction->name }}&nbsp;[{{ $transaction->email }}]</td>
            <td>{{ convert_money_direct(($transaction->amount * $transaction->quantity) - $transaction->charge, $transaction->currency, user_currency(), true) }}</td>
            <td>{{ convert_money_direct($transaction->charge, $transaction->currency, user_currency(), true) }}</td>
            <td>{{ formatted_date($transaction->due_date, 'd M, Y') }}</td>
            <td>
                @if($transaction->is_paid)
                    <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('Paid') }}</span>
                @else
                    <span class="badge badge-pill badge-danger"><i class="fas fa-spinner"></i> {{ __('Unpaid') }}</span>
                @endif
            </td>
            <td>{{ formatted_date($transaction->paid_at, 'd M, Y h:i A') }}</td>
            <td>{{ formatted_date($transaction->created_at, 'd M, Y h:i A') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
