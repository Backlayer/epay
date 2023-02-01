@if ($type && $id)
    <a href="#" class="view-invoice-file" data-typetx="{{ $type }}" data-idtx="{{ $id }}"
        data-linkfiletx="{{ $file ? url($file) : '' }}">
        {{ $invoiceNum }}
    </a>
@else
    {{ $invoiceNum }}
@endif
