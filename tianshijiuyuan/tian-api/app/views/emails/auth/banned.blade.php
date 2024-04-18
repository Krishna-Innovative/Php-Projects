<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>
    Dear {{ $account }}
</p>

<p>
    Due to suspicious activity on your account and to protect your security, we have temporarily locked your account.
    Please contact us directly at {{ Config::get('mail.emails.support') }} to help you safety recover your account.
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>
</body>
</html>
