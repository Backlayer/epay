<table class="table table-flush" id="subscriber-table">
    <thead class="thead-light">
    <tr>
        <th>{{ __("S/N") }}</th>
        <th>{{ __("Plan") }}</th>
        <th>{{ __("From") }}</th>
        <th>{{ __("Amount") }}</th>
        <th>{{ __("Charge") }}</th>
        <th>{{ __("Expire At") }}</th>
        <th>{{ __("Auto Renew") }}</th>
        <th>{{ __("Times") }}</th>
        <th>{{ __("Created") }}</th>
        <th>{{ __("Action") }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $transaction->plan->name }}</td>
            <td>{{ $transaction->owner->name }}</td>
            <td>{{ currency_format($transaction->amount, currency: $transaction->currency) }}</td>
            <td>{{ currency_format($transaction->charge, currency: $transaction->currency) }}</td>
            <td>{{ formatted_date($transaction->expire_at) }}</td>
            <td>
                @if($transaction->is_auto_renew)
                    <span class="badge badge-pill badge-success"><i class="fas fa-check"></i> {{ __('Yes') }}</span>
                @else
                    <span class="badge badge-pill badge-danger"><i class="fas fa-spinner"></i> {{ __('No') }}</span>
                @endif
            </td>
            <td>{{ $transaction->times ?? 0 }}</td>
            <td>{{ formatted_date($transaction->created_at) }}</td>
            <td>
                <a href="{{ route('user.subscription.show', $transaction->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
