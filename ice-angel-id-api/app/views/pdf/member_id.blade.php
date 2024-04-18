<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>iCEAngel-ID | Member Card</title>
</head>
<body>
<style type="text/css">
   @font-face {
            font-family: arialuni;
            src: url("{{ public_path('assets/fonts/ARIALUNI.TTF') }}") format('truetype'), local('Times New Roman');
        }

    table{
        font-family: 'arialuni';
        page-break-inside:auto;
        font-size: 12px;
        background-color: #ffffff;
        color: #545454;

    }

    .instructions {
        font-family: 'arialuni';
        font-size: 12px;
        position: fixed;
        top: 67mm;
        left: 10mm;
        width: 80mm;
    }

    .instructions div{
        padding: 1px;
    }

    .instructions-2, .instructions-4{
        left: 103mm;
    }

    .instructions-3, .instructions-4{
        top: 180mm;
    }

    .reflect {
        font-family: 'arialuni';
        font-size: 12px;
        position: fixed;
        -webkit-transform: rotate(180deg);
        -webkit-transform-origin: center bottom auto;
        top: 92mm;
        right: 109mm;
        width: 80mm;
    }

    .reflect div{
        padding: 1px;
    }

    .reflect-2, .reflect-4{
        right: 14mm;
    }

    .reflect-3, .reflect-4{
        top: 204mm;
    }

    .name{
        font-family: 'arialuni';
        font-size: 12px;
        text-align: left;
        margin-top: 3mm;
    }

    .qr{
        position: relative;
        float: left;
		top: -8mm;
		left: -2mm;
    }


    .url{
        font-family: 'arialuni';
        font-weight: 600;
        font-size: 12px;
        color: #00C;
    }

    .member-id{
		font-family: 'arialuni';
		font-size: 14px;
		font-weight: 600;
    }

   .logo{
		margin: -20px 0px 0px 0px;
   }

   .note {
		margin: -30px 0px 10px 0px;
   }

   .logo-header{
		height: 48px;
   }

   .note-header{
		height: 46px;
   }

</style>

<div class="reflect">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>
    <div> {{ $text['one_back'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two_back'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
    <div class="name" >{{$fullName}}</div>
</div>

<div class="instructions">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>
    <div> {{ $text['one'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
   <div class="name" >{{$fullName}}</div>
</div>

<div class="reflect reflect-2">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>

    <div> {{ $text['one_back'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two_back'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
    <div class="name" >{{$fullName}}</div>
</div>

<div class="instructions instructions-2">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>
    <div> {{ $text['one'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
   <div class="name" >{{$fullName}}</div>
</div>

<div class="reflect reflect-3">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>

    <div> {{ $text['one_back'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two_back'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
    <div class="name" >{{$fullName}}</div>
</div>

<div class="instructions instructions-3">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>
    <div> {{ $text['one'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
   <div class="name" >{{$fullName}}</div>
</div>

<div class="reflect reflect-4">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>

    <div> {{ $text['one_back'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two_back'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
    <div class="name" >{{$fullName}}</div>
</div>

<div class="instructions instructions-4">
    <div class="qr" >
        <img height="100px" width="100px" src="{{$qrCode}}">
    </div>
    <div> {{ $text['one'] }} <span class="url">{{ $url }}</span> </div>
    <div> {{ $text['two'] }} </div>
    <div class="member-id"> {{ $memberId }} </div>
   <div class="name" >{{$fullName}}</div>
</div>

<table width="100%" cellpadding="3" cellspacing="0">
    <tr class="logo-header" align="center">
        <td colspan="4">
            @if ($language == 'zh')
            <img width="200" class="logo"  src="{{ public_path('assets/images/logo_zh.png') }}" alt=""/>
            @else
            <img width="200" class="logo"  src="{{ public_path('assets/images/logo.png') }}" alt=""/>
            @endif
        </td>
    </tr>
    <tr class="note-header">
        <td colspan="4" ><div class="note">{{ $note['one'] }}</div></td>
    </tr>
    <tr align="left">
        <td colspan="2">
            @if ($language == 'zh')
            <img width="330" alt="" src="{{ public_path('assets/images/card_zh.jpg') }}"/>
            @else
            <img width="330" alt="" src="{{ public_path('assets/images/card.jpg') }}"/>
            @endif
        </td>
        <td colspan="2">
            @if ($language == 'zh')
            <img width="330" alt="" src="{{ public_path('assets/images/card_zh.jpg') }}"/>
            @else
            <img width="330" alt="" src="{{ public_path('assets/images/card.jpg') }}"/>
            @endif
        </td>
    </tr>
        <tr align="left">
        <td colspan="2">
            @if ($language == 'zh')
            <img width="330" alt="" src="{{ public_path('assets/images/card_zh.jpg') }}"/>
            @else
            <img width="330" alt="" src="{{ public_path('assets/images/card.jpg') }}"/>
            @endif
        </td>
    <td colspan="2">
            @if ($language == 'zh')
            <img width="330" alt="" src="{{ public_path('assets/images/card_zh.jpg') }}"/>
            @else
            <img width="330" alt="" src="{{ public_path('assets/images/card.jpg') }}"/>
            @endif
        </td>
    </tr>

</table>

</body>
</html>
