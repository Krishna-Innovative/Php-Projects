<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>iCEAngel-ID | Member Card</title>
    <style>
        /*****************
        * Layouts
        ****************/
        html, body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            text-align: left;
            font-family: 'arial', sans-serif;
            font-size: 37px;
            color: #000;
        }

        table {
            width: 100%;
            margin: 0;
            padding: 0;
        }

        img {
            width: 100%;
            height: 100%;
            display: block;
        }

        i {
            color: #999999;
            display: inline-block;
            font-style: normal;
            margin-right: 8px;
            vertical-align: middle;
            width: 40px;
            height: 40px;
        }

        /*****************
         * Helpers
         ****************/
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .capitalize {
            text-transform: capitalize;
        }

        /*****************
         * Header
         ****************/
        div.logo {
            width: 900px;
            height: 480px;
            padding: 20px 0;
            margin: 0 auto;
            display: block;
        }

        div.logo img {
            width: 900px;
            height: 480px;
            display: block;
        }

        /*****************
         * Footer
         *****************/
        div.footer {
            color: #55c7f3;
            text-align: center;
        }

        body {
            font-size: 48px;
        }

        table.iceid-container {
            width: 2000px;
            margin: 0 auto 200px 320px;
        }

        table.iceid-container h2 {
            font-size: 60px;
            font-weight: normal;
        }

        table.iceid-container ul.steps {
            list-style: none;
            padding: 0;
            margin: 0 0 200px 0;
        }

        table.iceid-container ul.steps li {
            line-height: 114px;
            height: 114px;
            font-size: 48px;
        }

        table.iceid-container .card {
            overflow: hidden;
            width: 2000px;
            height: 1270px;
        }

        table.iceid-container .card .background,
        table.iceid-container .card .background img {
            width: 2000px;
            height: 1270px;
        }

        table.iceid-container .card h4 {
            font-size: 50px;
        }

        table.iceid-container .card h5 {
            font-size: 38px;
        }

        table.iceid-container .card div.front-card {
            margin-left: 420px;
            padding-left: 40px;
            height: 622px;
            position: absolute;
            width: 575px;
        }

        table.iceid-container .card div.front-card .member-name {
            margin-top: 375px;
        }

        table.iceid-container .card div.front-card h4 {
            display: inline-block;
            float: left;
        }

        table.iceid-container .card div.front-card img {
            display: inline-block;
            vertical-align: top;
            margin-top: 250px;
            float: left;
            width: 328px;
            height: 328px;
        }

        table.iceid-container .card div.back-card {
            position: absolute;
            margin-left: 1300px;
            width: 900px;
            height: 622px;
            padding-left: 40px;
            top: 600px;
            margin-top: 480px;
            transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            -moz-transform: rotate(180deg);
            -o-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
        }

        table.iceid-container .card div.back-card span {
            font-size: 28px;
        }

        table.iceid-container div.note {
            width: 1840px;
            margin-top: 200px;
        }

    </style>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="{{ public_path('assets/images/logo.png') }}" alt=""/>
    </div>
</header>

<table class="iceid-container">
    <tr>
        <td>
            <h2>CREATE YOUR MEMBERSHIP CARD IN THREE EASY STEPS</h2>

            <ul class="steps">
                <li>Step 1: Cut out your card along the solid line.</li>
                <li>Step 2: Fold your card along the dotted line.</li>
                <li>Step 3: Laminate your card.</li>
            </ul>
        </td>
    </tr>
    <tr>
        <td>
            <div class="card">
                <div class="front-card">
                    <h4 class="capitalize member-name">{{ $fullName }}</h4>
                    <img src="{{ $qrCode }}" alt=""/>
                </div>
                <div class="back-card">
                    <h5>Scan the QR Code <span>( on the other side of the card)</span></h5>

                    <p>
                        <span>If QR scan doesn't work, then go to <bold>{{ $url }}</bold></span><br/>
                        <span>and input my iCE Angel - ID number:</span>
                    </p>
                    <h4>{{ $memberId }}</h4>
                </div>

                <div class="background">
                    <img src="{{ public_path('assets/images/card.jpg') }}" alt=""/>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="note">
                Create as many membership cards as you want. Store them in your wallet, your
                handbag, your car, your sports bag, your motorcycle, your cell phone case, and your
                pocket. Attach them to your school bag, your bicycle, your keys, and your outdoor gear.
                Take your iCE Angel - ID wherever you go!
            </div>
            <div class="note">
                NOTE : We are currently exploring a range of fashionable and functional wearable iCE Angel - IDs. We
                will
                notify you as soon as these are available.
            </div>
        </td>
    </tr>
</table>

</body>
</html>