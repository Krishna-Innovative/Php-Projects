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
    <strong>{{ $guardian }}</strong> has declined your iCE Angel - ID guardian nomination.
</p>

@if( ! empty($reason))

    <p>
        <strong>{{ $guardian }}</strong> submitted the following reason:
    </p>

    <blockquote style="max-width: 500px; font-family: serif;">
        "{{ $reason }}"
    </blockquote>

@endif

<p>
    Please login to your account and nominate an alternative iCE Angel - ID guardian.
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

</body>
</html>
