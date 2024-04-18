<?php
$headers = array(
  'Content-Type: application/json',
  'Access-Control-Allow-Origin: *',
  'Authorization: Basic XXXXXXXXX'
  );
define('headParam', $headers);
function curl($cover_url)
{
  $url = "https://iframe.ly/api/oembed?url=$cover_url&api_key=f89673623cd4c5df1efbb0";
  $curl = curl_init($url);

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, headParam);
  //for debug only!
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);
  curl_close($curl);
  $new_value = json_decode($resp, true);
  // echo htmlspecialchars_decode($new_value['html']);
  echo $new_value['html'];
}
add_filter('previewRender', 'previewRender');
function previewRender($field)
{
  if (isset($field)) {
    // $cover_url = $author_meta[$url][0];
    // curl($cover_url);
    curl($field);
  } else {
    echo "<img src='". get_stylesheet_directory_uri() . "/assets/images/coverphoto1.png' /> ";
  }
}

function curl2($cover_url)
{
  $url = "https://iframe.ly/api/oembed?url=$cover_url&api_key=99c77cb2d915ef3fe4fcc3";
  $curl = curl_init($url);
  $headers = array(
    'Content-Type: application/json',
    'Access-Control-Allow-Origin: *',
    'Authorization: Basic XXXXXXXXX'
    );
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, headParam);
  //for debug only!
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);
  curl_close($curl);
  $new_value = json_decode($resp, true);
  // var_dump($new_value);
  echo htmlspecialchars_decode($new_value['thumbnail_url']);
  // return $new_value;
}



add_filter('previewRenderForPostCart', 'previewRenderForPostCart');
function previewRenderForPostCart($field)
{
  if (isset($field)) {
    // $cover_url = $author_meta[$url][0];
    // curl($cover_url);
    curl2($field);
  } else {
    echo "<img src='". get_stylesheet_directory_uri() . "/assets/images/coverphoto1.png' /> ";
  }
}

add_action('wp_ajax_render_preview', 'render_preview');
function render_preview()
{
  if ($_POST['link']) {
    // $cover_url = $author_meta[$url][0];
    // curl($cover_url);
    curl($_POST['link']);
    die;
  } else {
    echo "<img src='". get_stylesheet_directory_uri() . "/assets/images/coverphoto1.png' /> ";
    die;
  }
}




// 

function curlTest($cover_url, $type)
{

  $url = "https://iframe.ly/api/oembed?url=$cover_url&api_key=99c77cb2d915ef3fe4fcc3";
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, headParam);
  //for debug only!
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);
  curl_close($curl);
  $new_value = json_decode($resp, true);
  // echo htmlspecialchars_decode($new_value['html']);
  echo $new_value[$type];
}
add_action('previewRenderTest', 'previewRenderTest');
// 'thumbnail_url'
// 'html'


// 'thumbnail_url'
// 'html'
function previewRenderTest($args)
{
  if (isset($args['someField'])) {
    // $cover_url = $author_meta[$url][0];
    // curl($cover_url);
    curlTest($args['someField'], $args['type']);
  } else {
    echo "<img src='". get_stylesheet_directory_uri() . "/assets/images/coverphoto1.png' /> ";
  }
}
