<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>
    Dear {{ $account }},
</p>

<p>
    You have requested to change your email address, please <a href="{{ $confirmationLink }}">click here</a> to confirm
    this email address before the update to take effect.
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>