<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("TRX") }}</th>
        <th>{{ __("Ref.") }}</th>
        <th>{{ __("Website") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Title") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Charge") }}</th>
        <th>{{ __("Is Paid") }}</th>
        <th>{{ __("Paid At") }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $transaction->trx }}</td>
            <td>{{ $transaction->reference_code }}</td>
            <td>{{ $transaction->website->merchant_name }}</td>
            <td>{{ $transaction->first_name }} {{ $transaction->last_name }}</td>
            <td>{{ $transaction->title }}</td>
            <td>{{ currency_format($transaction->amount, currency: $transaction->currency) }}</td>
            <td>{{ currency_format($transaction->charge, currency: $transaction->currency) }}</td>
            <td>
                @if($transaction->paid_at)
                    <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('Paid') }}</span>
                @else
                    <span class="badge badge-pill badge-danger"><i class="fas fa-spinner"></i> {{ __('Unpaid') }}</span>
                @endif
            </td>
            <td>{{ formatted_date($transaction->paid_at) }}</td>
            <td>{{ formatted_date($transaction->created_at) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
