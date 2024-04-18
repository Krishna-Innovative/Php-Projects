<?php
/*Template name:post creation*/
get_header();
//declare(strict_types=1);

/*use Your\PSR7Implementation\Uri;
use RicardoFiorani\OEmbed\OEmbed;*/

require __DIR__ . '/vendor/autoload.php';

/*$service = new OEmbed();

$uri = new Uri('https://www.dailymotion.com/video/x804zfb?playlist=x6ymns');

$result = $service->get(
    $uri,
    480,
    300,
    ['omitscript' => true]
);*/

?>
<div style="height:100vh;" class="container">
<?php //echo $result; ?>
</div>
<?php
get_footer();
?>