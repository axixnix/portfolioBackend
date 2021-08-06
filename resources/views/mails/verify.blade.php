<!DOCTYPE html>
<html>
    <body>
        <p>Hello {{ $user->first_name }},</p>
        <p>Your registration to the admin section of the portfolio admin was successful.
{{--            Use the code below to verify your email.--}}
        </p>
{{--        <p style="font-size: 36px">{{ $verification->payload }}</p>--}}
        <p>Thanks!</p>
    </body>
</html>
