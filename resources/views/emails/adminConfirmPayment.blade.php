@component('mail::message')
# {{ config('app.name') }} | Confirm Transaction
Hey Admin,

User <b>{{ $name }}</b> with <b>{{ $title }}</b> transaction of <b>@money($amount)</b> has been approved by the admin. 

Attached is the user's receipt.

@component('mail::panel')
For more details, <a href="{{ route('user.history') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
