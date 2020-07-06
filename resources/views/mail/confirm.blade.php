@component('mail::message')
# Welcome
We just need you to confirm your Email address to get a full access to PGIN Tourism Registration System.
<br>
Please Click the button below to Verify your Account.

@component('mail::button', ['url' => url('/verifyemail/'.$email_token)])
    Confirm Email
@endcomponent

If this is not you, just ignore this message.
<br>
<br>
Thanks,<br>
PGIN Tourism

@endcomponent

