@component('mail::message')
# Introduction
{{ $customer }}

<hr>
{{ $bill }}

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
