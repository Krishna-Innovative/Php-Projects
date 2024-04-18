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
    The iCE Angel - ID system is reliant on up to date information in event of an emergency.
</p>

<p>
    It appears that you have not logged into your account for a few months. Are you sure that all your account and
    member information is up to date?
</p>

<p>
    - <a href="{{ Config::get('front.home') }}">Yes, it's still up to date.</a><br/>
    - <a href="{{ Config::get('front.login') }}">No, I wish to log in.</a>
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
