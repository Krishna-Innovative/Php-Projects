<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>
    Dear {{ $guardian }},
</p>

<p>
    You have been nominated by <strong>{{ $account }}</strong> to be their iCE Angel - ID account guardian in event that they are incapacitated.
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
