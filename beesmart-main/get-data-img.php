<?php
if(isset($_POST["link"]))
{  
   $main_url=$_POST["link"];
   @$str = file_get_contents($main_url);


   // This Code Block is used to extract title
   // if(strlen($str)>0)
   // {
   //   $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
   //   preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title);
   // }


   // This Code block is used to extract description 
   $b =$main_url;
   @$url = parse_url( $b ) ;


   $youtubeUrl = parse_url($b, PHP_URL_QUERY);
   parse_str($youtubeUrl);


   @$tags = get_meta_tags( $main_url );

   // This Code Block is used to extract og:image which facebook extracts from webpage it is also considered 
   // the default image of the webpage
   $d = new DomDocument();
   @$d->loadHTML($str);
   $xp = new domxpath($d);
   foreach ($xp->query("//meta[@property='og:image']") as $el){
     $l2=parse_url($el->getAttribute("content"));
     if($l2['scheme']){
      $img[]=$el->getAttribute("content");
   // print_r($img2);
      }
     else{

     }
   }
   $imggs = $d->getElementsByTagName('img');
   $imgg = $imggs->item(0); 
   // $img = @$url . $imgg->getAttribute('src');
   // $img = @$url . $imgg->getAttribute('src');
}   
?>

   <?php
        echo "<img src='".$main_url."'>" ;
      //  echo "<H2 class='title' >".$title[1]."</H2>";

      // echo var_dump($_SERVER);
      // echo $_SERVER['HTTP_REFERER'];
      // echo $_SERVER['HTTP_ORIGIN'];
      // echo $_SERVER['REQUEST_URI'];
      // echo $_SERVER['QUERY_STRING'];
   ?>