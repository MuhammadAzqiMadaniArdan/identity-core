@component('mail::message')
# OTP Verification

Hello,

You are receiving this email because we received a login request for your account.

Your **OTP code** is:

@component('mail::panel')
{{ $code }}
@endcomponent

This code is valid for **10 minutes**. Please do not share this code with anyone.

@component('mail::button', ['url' => config('app.url')])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
    