<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("TRX") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Charge") }}</th>
        <th>{{ __("Status") }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $transaction->trx }}</td>
            <td>{{ currency_format($transaction->amount, currency: $transaction->currency) }}</td>
            <td>{{ currency_format($transaction->charge, currency: $transaction->currency) }}</td>
            <td>
                @if($transaction->status)
                    <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('Paid') }}</span>
                @else
                    <span class="badge badge-pill badge-danger"><i class="fas fa-spinner"></i> {{ __('Unpaid') }}</span>
                @endif
            </td>
            <td>{{ formatted_date($transaction->created_at, 'd M, Y h:i A') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
