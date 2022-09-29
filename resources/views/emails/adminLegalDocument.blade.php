@component('mail::message')
# {{ config('app.name') }} | Legal Document
Hey admin,

Attached is the legal document of user <b>{{ $name }}</b>.

@component('mail::panel')
To login, <a href="{{ route('login') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
