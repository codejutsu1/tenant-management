@component('mail::message')
# {{ config('app.name') }} | Registration
Hey {{ $name }},

You have been registered as a <b>{{ config('app.name') }}</b> occupant. Kindly make payment and proceed to choose a room.

@component('mail::panel')
To login, <a href="{{ route('login') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
