<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>
    Dear {{ $nominated }},
</p>

<p>
    Reminder: You have not responded to the iCE Angel – ID emergency contact person nomination from <strong>{{ $member }}</strong>
    dated <strong>{{ $date }}</strong>.
</p>

<p>
    You may <a href="{{ $link }}">click here</a> to find out more about this important role. Please accept or decline
    the request.
</p>

<p>
    For further information about iCE Angel – ID, go to <a
        href="{{ Config::get('front.about') }}">{{ Config::get('front.about') }}</a>
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
