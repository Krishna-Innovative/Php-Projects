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
    <strong>{{ $contact }}</strong> has declined the iCE Angel - ID Emergency Contact Person nomination
    for <strong>{{ $member }}</strong>.
</p>

@if( ! empty($reason))

    <p>
        <strong>{{ $contact }}</strong> submitted the following reason:
    </p>

    <blockquote style="max-width: 500px; font-family: serif;">
        "{{ $reason }}"
    </blockquote>

@endif

<p>
    Please login to your account and nominate an alternative Emergency Contact Person for <strong>{{ $member }}</strong>.
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
