@component('mail::message')
# {{ config('app.name') }} | Renew Rent
Hey admin,

User <b>{{ $name }}</b> rent has expired today. 

@component('mail::panel')
To login, <a href="{{ route('login') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
