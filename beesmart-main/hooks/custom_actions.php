<?php
    $actual_link = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

    $current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
    $user_meta = get_user_meta($current_user_id);



//  user avatar only for current users
add_action('current_user_url_avatar', 'current_user_url_avatar');
function current_user_url_avatar(){
    global $user_meta;
    $current_user_avatar_url = $user_meta['user_avatar_url'][0];
    if($current_user_avatar_url) {
        echo "<img src='".$current_user_avatar_url."'>";
    } else {
        echo "<img src='https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png'>";
    }
}

//  user avatar only for current users
add_action('current_user_cover_image', 'current_user_cover_image');
function current_user_cover_image(){
    global $user_meta;
    $current_user_cover_img_url = $user_meta['user_cover_image_url'][0];
    if($current_user_cover_img_url) {
        echo "<img src='".$current_user_cover_img_url."'>";
    } else {
        echo "<img class='user-coverImage' src='https://media.istockphoto.com/photos/dark-blue-minimal-texture-banner-with-space-for-text-word-or-product-picture-id1224392306?b=1&k=20&m=1224392306&s=170667a&w=0&h=lpDpUrttCoFDMhGQ1GJyyxIHE78s3xoMUzkawP5n4Y4='>";
    }
}
add_action('current_user_type', 'current_user_type');
function current_user_type(){
    global $user_meta;
    $type = $user_meta['account_type'][0];
    echo $type;
}

add_action('current_user_type_icon', function(){
    global $user_meta;
    $type = $user_meta['account_type'][0];
    if ($type == 'Business'){
        echo  "<img src='" . site_url() . "/wp-content/uploads/2021/11/Business-1.svg'>";
    }
    else if ($type == 'Career'){
        echo  "<img src='" . site_url() . "/wp-content/uploads/2021/11/Career.svg'>";
    }
    else if ($type == 'Personal'){
        echo  "<img src='" . site_url() . "/wp-content/uploads/2021/11/Personal.svg'>";
    }
    else if ($type == 'Hobby'){
        echo  "<img src='" . site_url() . "/wp-content/uploads/2021/11/Hobby.svg'>";
    }
    else if ($type == 'Location'){
        echo  "<img src='" . site_url() . "/wp-content/uploads/2021/11/Location.svg'>";
    }
    else if ($type == 'Community'){
        echo  "<img src='" . site_url() . "/wp-content/uploads/2021/11/Community.svg'>";
    }
    else {
        echo  "<img src='" . site_url() . "/wp-content/uploads/2022/02/dont.png'>";
    }
});


// Displays the name and surname
add_action('current_user_full_name', 'current_user_full_name');
function current_user_full_name(){
    if ( is_user_logged_in() ){
        global $current_user;
        if( ! is_object( $current_user ) ) {
            $current_user = wp_get_current_user();
        }
        echo $current_user->first_name;
        ?>&nbsp<?php
        echo $current_user->last_name;
    }
}

add_action('is_current_user_verified', 'is_current_user_verified');
function is_current_user_verified(){
    global $user_meta;
      $some_user_is_approved = $user_meta['account_status'][0]; // approved
    if ($some_user_is_approved == 'approved') {
        echo "<img src='".site_url()."/wp-content/uploads/2022/01/Verified.png'>";
    } else {
        echo '<img style="width:50px;height:50px;" src="https://mpng.subpng.com/20190303/aqu/kisspng-logo-brand-font-product-line-your-home-for-health-achhadoctor-in-5c7c8f19d4cff5.0460816115516669698717.jpg">';
    }
}


// friend avatar
add_action('friend_url_avatar', function(){
    $friend_meta = get_user_meta(um_user('ID'));
    $friend_avatar_url = $friend_meta['user_avatar_url'][0];
    if($friend_avatar_url) {
        echo "<img  src='".$friend_avatar_url."'>";
    } else {
        echo "<img  src='https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png'>";
    }
});

add_action('post_format', function(){
    global $post;
    $post_id = get_the_ID();
    $meta = get_post_meta($post_id);
    $format = $meta['f_custom_post_format'][0]; 
    // var_dump($meta);
    if ($format == 'audio-format'){
        echo site_url().'/wp-content/uploads/2022/01/Audio1.png';
    } else if ($format == 'text-format') {
        echo  site_url().'/wp-content/uploads/2022/01/write1.png';
    } else if ($format == 'image-format') {
        echo  site_url().'/wp-content/uploads/2022/01/Image1.png';
    } else if ($format == 'video-format') {
        echo  site_url().'/wp-content/uploads/2022/01/VideoA.png';
    } else if ($format == 'streamint-format') {
        echo  site_url().'/wp-content/uploads/2022/01/Gaming.png';
    } else if ($format == 'other-format') {
        echo  site_url().'/wp-content/uploads/2022/01/other.png';
    } else if ($format == 'be-found') {
        echo  site_url().'/wp-content/uploads/2022/01/Be-found1.png';
    } else if ($format == 'find-someone') {
        echo  site_url().'/wp-content/uploads/2022/01/Find1.png';
    } else if ($format == 'buy-and-sell') {
        echo  site_url().'/wp-content/uploads/2022/01/Buy-and-sell1.png';
    } else if ($format == 'host-event') {
        echo  site_url().'/wp-content/uploads/2022/01/Event1.png';
    } else if ($format == 'post-news') {
        echo  site_url().'/wp-content/uploads/2022/01/News1.png';
    } else if ($format == 'hire-someone') {
        echo  site_url().'/wp-content/uploads/2022/01/Hire1.png';
    } else {
        echo '';
    }
});