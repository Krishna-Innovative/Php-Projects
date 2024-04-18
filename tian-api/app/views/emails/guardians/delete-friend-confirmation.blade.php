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
    <strong>{{ $guardian }}</strong> has removed themselves as your iCE Angel - ID account guardian.
</p>

@if( $countGuardians == 0 )

    <p>
        <strong>Note:</strong> You now have zero iCE Angel - ID account guardian.
    </p>

    <p>
        Please <i>URGENTLY</i> log into your account and nominate another guardian.
    </p>

@else

    <p>
        <strong>Note:</strong> You now have one iCE Angel - ID account guardian.
    </p>

    <p>
        You may log into your account to add another guardian.
    </p>

@endif

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
