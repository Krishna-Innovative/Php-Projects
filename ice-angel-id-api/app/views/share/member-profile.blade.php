<!doctype html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <title>iCEAngel-ID | Member profile</title>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="{{ public_path('assets/images/logo.png') }}" alt=""/>
    </div>
</header>

<pre>
    Fields: {{ implode(', ', array_keys($profile)) }}
</pre>

</body>
</html>