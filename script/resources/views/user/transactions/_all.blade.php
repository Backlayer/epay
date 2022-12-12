<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Charge") }}</th>
        <th>{{ __("Type") }}</th>
        <th>{{ __("Reason") }}</th>
        <th>{{ __("Created") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>
                {{ $transaction->name }}<br>
                {{ $transaction->email }}
            </td>
            <td>{{ currency_format($transaction->amount, currency: $transaction->currency) }}</td>
            <td>{{ currency_format($transaction->charge, currency: $transaction->currency) }}</td>
            <td>
                @if($transaction->type == 'credit')
                    <span class="badge badge-success"><i class="fas fa-arrow-circle-down"></i> {{ __("Credit") }}</span>
                @else
                    <span class="badge badge-danger"><i class="fas fa-arrow-circle-up"></i> {{ __("Debit") }}</span>
                @endif
            </td>
            <td>{!! wordwrap($transaction->reason, 50, "<br />\n") !!}</td>
            <td>{{ formatted_date($transaction->created_at) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
