<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __('Invoice No') }}</th>
        <th>{{ __("TRX") }}</th>
        <th>{{ __("Title") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Charge") }}</th>
        <th>{{ __('Payment Status') }}</th>
        <th>{{ __("Paid At") }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>
                <x-link-upload-file
                    type="SingleChargeOrder"
                    :id="$transaction->id"
                    :file="$transaction->invoice_file"
                    :invoice-num="$transaction->invoice_no"
                />
            </td>
            <td>{{ $transaction->trx }}</td>
            <td>{{ $transaction->singleCharge->title }}</td>
            <td>{{ $transaction->name }}&nbsp;[{{ $transaction->email }}]</td>
            <td>{{ convert_money_direct($transaction->amount, $transaction->currency, user_currency(), true) }}</td>
            <td>{{ convert_money_direct($transaction->charge, $transaction->currency, user_currency(), true) }}</td>
            <td>{!! $transaction->PaymentStatus !!}</td>
            <td>{{ formatted_date($transaction->paid_at, 'd M, Y h:i A') }}</td>
            <td>{{ formatted_date($transaction->created_at, 'd M, Y h:i A') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
