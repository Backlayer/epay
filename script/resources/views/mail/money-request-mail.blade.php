@component('mail::message')
# Hi {{ $options['receiver_name'] }}
<b>{{ $options['sender_name'] }}</b> Send you a money request.

Dear <b>{{ $options['receiver_name'] }}</b>, You have a money request from <b>{{ $options['sender_name'] }}</b>, E-mail : <b>{{ $options['sender_email'] }}</b>, Amount is : <b>{{ $options['amount'] }}</b>, Request time : <b>{{ formatted_date($options['request_at']) }}</b>, Please check and confirm.

@component('mail::button', ['url' => $options['link'] ?? null])
Make Payment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
