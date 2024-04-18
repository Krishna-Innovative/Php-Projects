<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<p>
    Dear {{ $firstName }},
</p>

<p>
    Thank you for your enquiry to iCE Angel - ID. We will respond as soon as possible
</p>

<p>
    Sincerely,<br/>

    iCE Angel - ID
</p>

<div style="max-width: 500px; font-size: 11px; font-family: serif;">

    <hr/>

    <p>
        <strong>Query Type:</strong> {{ $subject }}
    </p>

    <p>
        <strong>Name:</strong> {{ $firstName }} {{ $lastName }}
    </p>

    <p>
        <strong>Contact Email Address:</strong> {{ $email }}
    </p>

    <p>
        <strong>Message:</strong> <br/>
        {{ $body }}
    </p>

    <hr/>

</div>

</body>
</html>