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
    Confirmation that the following iCE Angel – ID member profiles:
</p>

<ul>
@foreach($members as $member)

    <li><strong>{{ $member }}</strong></li>

@endforeach
</ul>

<p>
    have been edited or added. You may login to your account to view their profiles.
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
