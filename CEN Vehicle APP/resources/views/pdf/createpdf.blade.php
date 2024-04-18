<!DOCTYPE html>
<html>

<head>
  <title>CEN Vehicle Check</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    @page {
      margin: 100px 25px;
    }

    header {
      position: fixed;
      top: -60px;
      left: 0px;
      right: 0px;
      height: 50px;
    }

    footer {
      position: fixed;
      bottom: -60px;
      left: 0px;
      right: 0px;
      height: 50px;
    }

    footer .pagenum:before {
      content: counter(page);
    }

    th {
      background-color: #107e86;
    }

    hr {
      display: block;
      width: 100%;
      height: 1px;
      background-color: #ddd;
      margin: 0;
      padding: 0;
    }

    table tr,
    table th,
    table td {
      border-spacing: 0px;
    }

    td,
    th {
      padding: 8px;
      border: 0;
      /* border-bottom: 0; */
    }

    td td,
    tr tr {
      padding: 0;
      outline: 0;
      /* border-bottom: 0; */
    }

    p {
      margin-bottom: 0;
    }

    /* p {
      page-break-after: always;
    }

    p:last-child {
      page-break-after: never;
    } */
  </style>
</head>
<header class="text-center"><img src="{{ base_path('public/images/cen-daily-check-app.png') }}" style="text-align:center;width:100px!important;height:100px;margin-right: 2px;"></header>
<footer>
  <div class="pagenum-container">Page <span class="pagenum"></span></div>
</footer>
<main>

  <body>
    <div class="container">
      <img src="{{ base_path('public/images/cen-daily-check-app.png') }}" style="text-align:center;width:100px!important;margin-right:2px;">
      <h4 style="font-size: 20px;margin-top:-10px;margin-bottom: 20px;">{{ $title }}</h4>
      <table class="w-full" align="center" style="margin:0 auto; width:100%">
        <tr>
          <th style="padding:8px;background-color: #cacad7;">Question</th>
          <th style="padding:8px;background-color: #cacad7;text-align:right;">Answers </th>
        </tr>

        @foreach($usersubmitted_result as $finalresult)
        <?php $photos = json_decode($finalresult['photos'], true);
        ?>
        <br>
        @if($finalresult['section_name']!="" && $finalresult['section_name']!="~")
        <tr style="background-color: #625FF3;padding-top:20px;">
          <td style="padding:8px;">{{$finalresult['section_name']}}</td>
          <td style="padding:8px;"></td>
        </tr>

        <tr>
          <td style="padding-top:12px;padding-bottom:12px;">
            <b style="display:block;padding-bottom:15px;">{{$finalresult['title']}}</b>
            <table>
              <tr>
                <?php
                foreach ($photos as $key => $photo) {
                  $photo = str_replace("http://103.164.67.227:8000/", '/public/', $photo);
                ?>
                  <td><img src="{{ base_path($photo) }}" style="width:100px;height:100px;margin-right: 2px;">
                    <span style="display:block;font-size:12px">Photo <?php echo $key + 1; ?></span>
                  </td>
                <?php
                } ?>
              </tr>
            </table>
            <p>@if($finalresult['video'] != '')
              <a href="{{$finalresult['video']}}" target="_blank">View Videos </a>
              @else
              @endif
            </p>
            <p>@if($finalresult['document'] != '')
              <a href="{{$finalresult['document']}}" target="_blank">View Document </a>
              @else
              @endif
            </p>
            <p>{{$finalresult['notes']}}</p>
          </td>
          <td style="text-align:right;font-size:14px;vertical-align:top;padding-top:12px;padding-bottom:12px;">{{$finalresult['field_value']}}</td>
        </tr>
        @else
        <tr>
          <td style="padding-top:12px;padding-bottom:12px;"> <b style="display:block;padding-bottom:15px;">{{$finalresult['title']}}</b>
            <table>
              <tr>
                <?php
                foreach ($photos as $key => $photo) {
                  $photo = str_replace("http://103.164.67.227:8000/", '/public/', $photo);
                ?>
                  <td><img src="{{ base_path($photo) }}" style="width:100px;height:100px;margin-right: 2px;">
                    <span style="display:block;font-size:14px">Photo <?php echo $key + 1; ?></span>
                  </td>
                <?php
                } ?>
              </tr>

            </table>

            <p>@if($finalresult['video'] != '')
              <?php
              $video = $finalresult['video'];
              $videos = str_replace("http://103.164.67.227:8002/videos/", '', $video); ?>
              <a href="{{$finalresult['video']}}" target="_blank"><?php echo $videos; ?></a>
              @else
              @endif
            </p>
            <p>@if($finalresult['document'] != '')
              <?php
              $document = $finalresult['document'];
              $document = str_replace("http://103.164.67.227:8000/documents/", '', $document); ?>
              <a href="{{$finalresult['document']}}" target="_blank"><?php echo $document; ?></a>
              @else
              @endif
            </p>
            <p>{{$finalresult['notes']}}</p>
          </td>
          <td style="text-align:right;font-size:12px;vertical-align:top;padding-top:12px;padding-bottom:12px;">{{$finalresult['field_value']}}</td>
          @endif
        </tr>
        <tr>
          <td colspan="2" style="padding: 0;">
            <hr />
            <p style="opacity:0;visibility:hidden;">1
            </p>
          </td>
        </tr>
        @endforeach
      </table>

    </div>
  </body>
</main>

</html>