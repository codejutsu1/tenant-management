@component('mail::message')
# {{ config('app.name') }} | Renew Rent
Hey {{ $name }}

Your rent has expired today, kindly renew your rent. 

@component('mail::panel')
To login, <a href="{{ route('login') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
