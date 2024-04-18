<?php


add_action('is_author_verified', function () {
    global $post;
    $author_id = $post->post_author;
    $author_meta = get_user_meta($author_id);
    $author_is_approved = $author_meta['account_status'][0]; // approved
    if ($author_is_approved == 'approved') {
        echo '<img class="is-verified" src="'.site_url().'/wp-content/uploads/2022/01/Verified.png">';
    } else {
        echo '<img class="is-verified" style="width:50px;height:50px;" src="'.site_url().'/wp-content/uploads/2022/05/not-verfied.jpg">';
    }
});

add_action('author_type', function () {
    global $post;
    $author_id = $post->post_author;
    $author_meta = get_user_meta($author_id);
    $author_type = $author_meta['account_type'][0];
    if ($author_type == 'Business') {
        echo  "<img src='".site_url()."/wp-content/uploads/2021/11/Business-1.svg'>";
    } else if ($author_type == 'Career') {
        echo  "<img src='".site_url()."/wp-content/uploads/2021/11/Career.svg'>";
    } else if ($author_type == 'Personal') {
        echo  "<img src='".site_url()."/wp-content/uploads/2021/11/Personal.svg'>";
    } else if ($author_type == 'Hobby') {
        echo  "<img src='".site_url()."/wp-content/uploads/2021/11/Hobby.svg'>";
    } else if ($author_type == 'Location') {
        echo  "<img src='".site_url()."/wp-content/uploads/2021/11/Location.svg'>";
    } else if ($author_type == 'Community') {
        echo  "<img src='".site_url()."/wp-content/uploads/2021/11/Community.svg'>";
    } else {
        echo  "<img src='".site_url()."/wp-content/uploads/2022/02/dont.png'>";
    }
});


add_action('author_nickname', 'author_nickname');
function author_nickname()
{
    if (is_user_logged_in()) {
        global $post;
        $author_id = $post->post_author;
        $author_meta = get_user_meta($author_id);
        // if( ! is_object( $current_user ) ) {
        //     $current_user = wp_get_current_user();
        // }
        echo $author_meta['nickname'][0];
    }
}
?>
