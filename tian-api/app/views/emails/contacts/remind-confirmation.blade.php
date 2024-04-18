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
    <strong>{{ $nominated }}</strong> has not responded to the Emergency Contact Person nomination for
    <strong>{{ $member }}</strong> dated <strong>{{ $date }}</strong>.
</p>

<p>
    You should contact <strong>{{ $nominated }}</strong> and request them to respond to the nomination - or login to
    your account and nominate a different emergency contact person.
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
