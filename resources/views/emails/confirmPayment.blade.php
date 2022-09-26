@component('mail::message')
# {{ config('app.name') }} | Confirm Transaction
Hey {{ $name }},

<b>{{ $title }}</b> transaction of @money($amount) has been approved by the admin. 

@component('mail::panel')
For more details, <a href="{{ route('user.transaction') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
