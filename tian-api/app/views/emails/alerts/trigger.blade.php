<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Emergency Alert</h2>

<div>

    <p>Dear {{ $to['first_name']  }},</p>

    <p>An iCE Angel - ID emergency alert has been triggered for {{ $member_first_name  }} {{ $member_last_name  }}.</p>
    @if($alert_type == 'normal')
    <p>The iCE Angel that triggered the alert can be contacted at {{ $angel_phone }}.</p>

    <p>Please enquire whether the iCE Angel has already contacted the police or ambulance as this is the first and most important step.</p>
    @endif

    @if(count($contacts))

        <h3>This alert was sent out to:</h3>
        @foreach($contacts as $contact)

            <p>
            {{ $contact['first_name'] }} {{ $contact['last_name'] }} <br/>
            {{ $contact['phone']['number']  }}
            </p>

        @endforeach

    @endif

    <p>To access {{ $member_first_name }}'s emergency records, <a href="{{ $shared_profile }}">click here</a> or log into your iCE Angel - ID account. You can only access {{ $member_first_name }}'s emergency records for the next 48 hours.</p>

    <p>Sincerely,<br/>

    iCE Angel - ID Automated Alert System</p>

</div>
</body>
</html>
