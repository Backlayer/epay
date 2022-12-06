@component('mail::message')

@component('mail::table')
|NAME|EMAIL|PHONE|
|:----|:-----|:-----|
|{{ $mail->first_name }} {{ $mail->last_name }}|{{ $mail->email }}|{{ $mail->phone }}|
@endcomponent
<h1>Message</h1>
<p>{{ $mail->message }}</p>

@endcomponent
