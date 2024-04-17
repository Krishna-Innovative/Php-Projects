@component('mail::message')
# Hi Admin,
You have Received new Mail from contact us form<br>

UserName: {{$mailData['name']}}<br>
UserEmail:{{$mailData['email']}}<br>
UserMessage:{{$mailData['text']}}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
