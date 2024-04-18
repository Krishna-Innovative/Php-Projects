<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>
    Dear {{ $contact }},
</p>

<p>
    You have been nominated by <strong>{{ $member }}</strong> as their iCE Angel – ID emergency contact person.
</p>

<p>
    You may <a href="{{ $link }}">click here</a> to find out more about this important role. Please accept or decline
    the request.
</p>

<p>
    For further information about iCE Angel – ID, go to <a href="{{ Config::get('front.about') }}">{{ Config::get('front.about') }}</a>
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
