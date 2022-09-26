@component('mail::message')
# {{ config('app.name') }} | Registration
Hey admin,

You have registered {{ $name }} as a <b>{{ config('app.name') }}</b> occupant. 

@component('mail::panel')
To login, <a href="{{ route('login') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
