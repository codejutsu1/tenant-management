@component('mail::message')
# {{ config('app.name') }} | New User
Hey Admin,

User <b>{{ $name }}</b> has registered as an occupant of {{ config('app.name') }}.

To see more details, <a href="{{ route('all.users') }}">visit here.</a>

@component('mail::panel')
For more details, <a href="{{ route('user.history')}}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
