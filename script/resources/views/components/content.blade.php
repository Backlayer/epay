@if(config('system.unescaped'))
{!! $data !!}
@else
{{ $data }}
@endif
