<?php


// $some_user_nick = $actual_link['path'] ? wp_basename($actual_link['path']) : false;
// $some_user = get_user_by('ID', um_profile_id());

// $user_meta = get_user_meta(um_profile_id());
// Displays the name and surname
add_action('user_nickname', 'user_nickname');
function user_nickname()
{
    if (is_user_logged_in()) {
        $user_meta = get_user_meta(get_the_author_ID());
        echo $user_meta['nickname'][0];
    }
}

add_action('wp_ajax_bees_avatar_by_id', 'bees_avatar_by_id');
function bees_avatar_by_id()
{
    $userId = $_POST['user_id'];
    $user_meta = get_user_meta($userId);
    $user_avatar_url = $user_meta['user_avatar_url'][0];
    if ($user_avatar_url) {
        $response['success'] = 'true';
        $response['message'] = "True";
    } else {
        $response['success'] = 'false';
        $response['message'] = "False";
    }
    echo $user_avatar_url;
    die;
}


// add_action('is_user_verified', function () {
//     um_reset_user();
//     $user_meta = get_user_meta(get_the_author_ID());
//     $user_is_approved = $user_meta['account_status'][0]; // approved
//     if ($user_is_approved == 'approved') {
//         echo '<img src="' . site_url() . '/wp-content/uploads/2022/01/Verified.png">';
//     } else {
//         // echo '<img style="width:50px;height:50px;" src="/wp-content/uploads/2022/01/cover_photo-4.jpg">';
//     }
// });
add_action('user_type', 'user_type');
function user_type()
{
    um_reset_user();
    $user_meta = get_user_meta(get_the_author_ID());
    $type = $user_meta['account_type'][0];
    if ($type == 'business') {
        echo  "<img src='".imgPATH."types-Business.png'>";
    } else if ($type == 'Career') {
        echo  "<img src='".imgPATH."Type-Professional.png'>";
    } else if ($type == 'Personal') {
        echo  "<img src='".imgPATH."Types-Personal.png'>";
    } else if ($type == 'Hobby') {
        echo  "<img src='".imgPATH."Type-Hobby.png'>";
    } else if ($type == 'Location') {
        echo  "<img src='".imgPATH."Type-Location.png'>";
    } else if ($type == 'Community') {
        echo  "<img src='".imgPATH."Types-Community.png'>";
    } else {
        echo "<img src='".imgPATH."014-search.png'>";
    }
}

add_action('the_user_type', function ($user_id) {
    $types = array('business' => 'types-Business', 'Career' => 'Type-Professional', 'Personal' => 'Types-Personal', 'Hobby' => 'Type-Hobby', 'Location' => 'Type-Location', 'Community' => 'Types-Community',);
    $userType = get_user_meta($user_id, 'account_type', true);
    foreach ($types as $type => $key) {
        if ($userType == $type) {
            echo  "<img src='" . imgPATH . $key . ".png'>";
        } 
        // else {
        //     echo "<img src='" . imgPATH . "014-search.png'>";
        // }
    }
});
function json_response($response){
    if ($response) {
        $response['success'] = 'true';
        $response['message'] = "You have updated data";
    } else {
        $response['success'] = 'False';
        $response['message'] = "Somethink goes wrong";
    }
    echo json_encode($response);
}


function bees_update_meta_data(){
    $fieldName = $_POST['fieldName'];

    // $fieldName =  'user_avatar_url';
    $parameters = array(
        'link' => $_POST['link'],
        'position' => $_POST['position'],
    );
    // try to find some `meta field` user meta 
    // $previous_data = get_user_meta( idCurrentUser, $fieldName, false );
    print_r($parameters);
    print_r(get_current_user_id());
    print_r($fieldName);
    debug($parameters);
    update_user_meta( get_current_user_id(), $fieldName, $parameters);
}
add_action('wp_ajax_bees_update_meta_data', 'bees_update_meta_data');


function upload_update()
{
    if (isset($_POST["link"])) {
        $main_url = $_POST['link'];
        $fieldName = $_POST['fieldName'];
        $position = $_POST['position'];
        $update_data = update_user_meta(get_current_user_id(), $fieldName, $main_url);
        json_response($update_data, $position);
    } else {
        $fieldName = $_POST['fieldName'];
        update_user_meta(get_current_user_id(), $fieldName, 'true');
    }
    die;
}
add_action('wp_ajax_upload_update', 'upload_update');


// add_action('bees_guide_finished', 'bees_guide_finished');
// function bees_guide_finished()
// {
//     $user_id = get_current_user_id();
//     update_user_meta($user_id, 'account_type', 'Career');
//     // die;
// }
// do_action('bees_guide_finished');
