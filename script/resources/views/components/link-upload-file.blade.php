@if ($type && $id)
    <a href="#" class="view-invoice-file" data-typetx="{{ $type }}" data-idtx="{{ $id }}"
        data-linkfiletx="{{ $file ? url($file) : '' }}"
        data-numtx="{{ $invoiceNum }}">
        {{ $invoiceNum ?? __('N/A') }}
    </a>
@else
    {{ $invoiceNum ?? __('N/A') }}
@endif
