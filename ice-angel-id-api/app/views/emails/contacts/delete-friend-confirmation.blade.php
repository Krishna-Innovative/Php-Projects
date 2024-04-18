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
    <strong>{{ $contact }}</strong> has removed <strong>{{ $member }}</strong> as a Friend in Need.
</p>

@if( $countContacts == 0 )

    <p>
        <strong>Note:</strong> You now have zero iCE Angel - ID emergency contact persons for
        <strong>{{ $member }}</strong>.
    </p>

    <p>Please <i>URGENTLY</i> log into your account and nominate another emergency
        contact person for this member.
    </p>

@else

    <p>
        <strong>Note:</strong> You now have one iCE Angel - ID emergency contact person for
        <strong>{{ $member }}</strong>.
    </p>

    <p>
        You may log into your account to add another emergency contact person for this member
    </p>

@endif

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
