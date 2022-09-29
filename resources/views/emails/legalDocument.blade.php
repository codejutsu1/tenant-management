@component('mail::message')
# {{ config('app.name') }} | Legal Document
Hey {{ $name }}

Attached is the legal document agreement. Endeavour to download and fill out the necessary information.

For more info, <a href="{{ route('user.receipt') }}">visit here.</a>

@component('mail::panel')
To login, <a href="{{ route('login') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
