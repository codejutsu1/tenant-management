@component('mail::message')
# {{ config('app.name') }} | Welcome
Hey {{ $name }}

You have successfully registered as a tenant of {{ config('app.name') }} Lodge, Kindly make payment for your rent and proceed to choose any available room of your choice.

For any complaint, contact the caretakers <a href="{{ route('user.details') }}" target="_blank">here</a>.

@component('mail::panel')
To login, <a href="{{ route('login') }}" target="_blank">visit here.</a>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
