<?php
add_action('init', function () {
    register_rest_route('pricode/v1', '/test/(?P<pricode_param>\d+)', array(
        'methods' => 'GET',
        'callback' => 'pricode_api_test_callback'

    ));
});

//GET routes
add_action('init', function () {
    register_rest_route('pricode/v1', '/beearts/', array(
        'methods' => 'GET',
        'callback' => 'pricode_api_get_callback'

    ));
});
add_action('init', function () {
    register_rest_route('pricode/v1', '/beearts/(?P<beeart_id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'pricode_api_get_callback'

    ));
});

//POST
add_action('init', function () {
    register_rest_route('pricode/v1', '/beearts/create/', array(
        'methods' => 'POST',
        'callback' => 'pricode_api_post_callback'

    ));
});

//PUT
add_action('init', function () {
    register_rest_route('pricode/v1', '/beearts/update/(?P<beeart_id>\d+)', array(
        'methods' => 'PUT',
        'callback' => 'pricode_api_put_callback'

    ));
});

//DELETE
add_action('init', function () {
    register_rest_route('pricode/v1', '/beearts/(?P<beeart_id>\d+)', array(
        'methods' => 'DELETE',
        'callback' => 'pricode_api_delete_callback'

    ));
});
//Bio code
add_action('init', function () {
    register_rest_route('pricode/v1', '/info/create/', array(
        'methods' => 'POST',
        'callback' => 'pricode_api_post_info_callback'

    ));
});
add_action('init', function () {
    register_rest_route('pricode/v1', '/info/edit/', array(
        'methods' => 'POST',
        'callback' => 'pricode_api_post_info_edit_callback'

    ));
});
function pricode_api_post_info_callback($request){
	global $wpdb;
	$category_name=sanitize_text_field($request->get_param('category_name_of_bio'));
	$current_user_login=sanitize_text_field($request->get_param('current_user_login'));
	$table = $wpdb->prefix.'save_bio_info';
	$count = $wpdb->get_results ( "SELECT COUNT(bio_userid) as count_of_bio FROM  $table WHERE bio_userid = $current_user_login");
	$counted_bio=$count[0]->count_of_bio;
	 if($counted_bio<4){
		//$current_id=get_current_user_id();
		$table = $wpdb->prefix.'save_bio_info';
		$data = array('bio_userid' => $current_user_login, 'bio_userinfo' => $category_name);
		$format = array('%d','%s');
		$wpdb->insert($table,$data,$format);
		$response['status'] =  200;
		$response['success'] = true;
		$response['data'] = 'Your Info Category Created Successfully';
	}else{
		 $response['status'] =  422;
		 $response['success'] = true;
		 $response['data'] = 'You can not create more';
	 }
	return new WP_REST_Response($response);
	die;
}
function pricode_api_post_info_edit_callback(){
	global $wpdb;
	$table = $wpdb->prefix.'save_bio_info';
	$current_user_id=$_POST['current_user'];
	$html='';
	foreach ($_POST['resulted_data'] as $category_updated_value) {
		$updated_id=$category_updated_value['data-id'];
		$updated_value=$category_updated_value['value'];
		$updated_info=$wpdb->query($wpdb->prepare("UPDATE $table SET bio_userinfo='$updated_value' WHERE id=$updated_id"));
		
	}
	$list_of_category = $wpdb->get_results ("SELECT * FROM  $table WHERE bio_userid = $current_user_id");
	//echo "SELECT * FROM  $table WHERE bio_userid = $current_user_id";
	//echo '<pre>';print_r($list_of_category);
	foreach($list_of_category as $category_listing){
		$bio_userinfo=$category_listing->bio_userinfo;
		$bio_userid=$category_listing->bio_userid;
	 	$html.='<a href="#'.$bio_userinfo.'" class="active" data-user-id="'.$bio_userid.'">'.$bio_userinfo.'</a>';
	}
	$response['status'] =  200;
	$response['success'] = 'true';
	$response['data'] = 'Your Catgories is updated'; 
	$response['html'] = $html; 
	echo json_encode($response);
	die;
}
function pricode_api_test_callback($request)
{
    $response['status'] =  200;
    $response['success'] = true;
    $response['data'] = $request->get_param('pricode_param');
    return new WP_REST_Response($response);
}

/**
 * Get all beearts from our WordPress Installation
 * @param  object $request WP_Request with data
 * @return obeject         WP_REST_Response
 */
function pricode_api_get_callback($request)
{


    $beeart_id = $request->get_param('beeart_id');
    if (empty($beeart_id)) {
        $posts = get_posts(['post_type' => 'beeart', 'post_status' => 'publish']);

        if (count($posts) > 0) {
            $response['status'] =  200;
            $response['success'] = true;
            $response['data'] = $posts;
        } else {
            $response['status'] =  200;
            $response['success'] = false;
            $response['message'] = 'NO posts!';
        }
    } else {
        if ($beeart_id > 0) {
            $post = get_post($beeart_id);
            if (!empty($post)) {
                $response['status'] =  200;
                $response['success'] = true;
                $response['data'] = $post;
            } else {
                $response['status'] =  200;
                $response['success'] = false;
                $response['message'] = 'No post found!';
            }
        }
    }

    wp_reset_postdata();
    return new WP_REST_Response($response);
}

/**
 * Create a beeart post by rest api
 * @param  object $request WP_Request with data
 * @return obeject         WP_REST_Response
 */
function pricode_api_post_callback($request)
{
	global $wpdb;
    $post['post_title'] = sanitize_text_field($request->get_param('title'));
    $post['post_content'] = sanitize_text_field($request->get_param('content'));
    $post['meta_input'] = [
        'f_url' => sanitize_text_field($request->get_param('meta_f_url')),
        'f_type_of_post_by_user_type' => sanitize_text_field($request->get_param('meta_f_type_of_post_by_user_type')),
        // 'f_custom_post_format' => 'text',
        'f_custom_post_format' => sanitize_text_field($request->get_param('meta_f_custom_post_format')),
        // 'f_premium_post_format' => sanitize_text_field($request->get_param('meta_f_premium_custom_post_format')),
        'f_additional_text' => sanitize_text_field($request->get_param('meta_f_additional_text')),
        'f_audience' => sanitize_text_field($request->get_param('meta_f_audience')),
        'f_ticket_cost' => sanitize_text_field($request->get_param('meta_f_ticket_cost')),
        'f_about_me' => sanitize_text_field($request->get_param('meta_f_about_me')),
        'f_im_looking_for' => sanitize_text_field($request->get_param('meta_f_im_looking_for')),
        'f_embed' => sanitize_text_field($request->get_param('meta_f_embed'))
    ];
    $post['post_tags'] = $request->get_param('f_tags');
    $post['post_author'] =  $request->get_param('f_user_id');
    $post['post_status'] = 'publish';
    $post['post_type'] = 'beeart';
	$author_id=$request->get_param('f_user_id');
    // PRERIUM FIELDS DISABLED TEMPORARILY
    // checkboxes
    // $post['post_value_f_by_found'] = $request->get_param('f_be_found');
    // $post['post_value_f_find_someone'] = $request->get_param('f_find_someone');
    // $post['post_value_f_sell_and_buy'] = $request->get_param('f_sell_and_buy');
    // $post['post_value_f_events'] = $request->get_param('f_events');
    // $post['post_value_f_news'] = $request->get_param('f_news');
    // $post['post_value_f_hire_someone'] = $request->get_param('f_hire_someone');

    $post['post_country'] = $request->get_param('f_country');
    $post['post_language'] = $request->get_param('f_language');
    // $post['post_price_type'] = $request->get_param('f_price_type');
    // $post['post_booking'] = $request->get_param('f_booking');
    // $post['post_theme'] = $request->get_param('f_theme');
    // $post['post_paywall'] = $request->get_param('f_paywall');
    // $post['post_skill_level'] = $request->get_param('f_skill_level');
    // $post['post_suitible'] = $request->get_param('f_suitible');
    // $post['post_is_special_offer'] = $request->get_param('f_is_special_offer');
    // $post['post_pay_visibility'] = $request->get_param('f_pay_visibility');
    // $post['post_date_selecter'] = $request->get_param('f_date_selecter');
   	// $post['post_is_explisit'] = $request->get_param( 'f_is_explisit' );
    // map data
    // $address = $request->get_param('address');
    // $city = $request->get_param('city');
    // $country = $request->get_param('country');
    // $country_short = $request->get_param('country_short');
    // $lat =     $request->get_param('lat');
    // $lng =     $request->get_param('lng');
    // $name =    $request->get_param('name');
    // $place_id =    $request->get_param('place_id');
    // $post_code = $request->get_param('post_code');
    // $state = $request->get_param('state');
    // $state_short =    $request->get_param('state_short');
    // $zoom = $request->get_param('zoom');

    // $locationValue = array(
    //     "address" => $address,
    //     "city" => $city,
    //     "country" => $country,
    //     "country_short" => $country_short,
    //     "lat" => $lat,
    //     "lng" => $lng,
    //     "name" => $name,
    //     "place_id" => $place_id,
    //     "post_code" => $post_code,
    //     "state" => $state,
    //     "state_short" => $state_short,
    //     "zoom" => $zoom
    // );

    // $post['post_map'] = $request->get_param( 'f_map' );


    $new_post_id = wp_insert_post($post);
	$guid=get_the_guid($new_post_id);
	//echo $guid.'guid';
	$post_table = $wpdb->prefix.'posts';
	$date=date("siHjmyB");
	$random_number=rand(1000,9999)*rand(1000,9999);
	$new_post_slug=$author_id.$date.'-'.$random_number.$new_post_id;
	$new_post_url=site_url().'/shared/'.$new_post_slug;
	$updated_info=$wpdb->query($wpdb->prepare("UPDATE $post_table SET post_name='$new_post_slug' WHERE ID=$new_post_id"));
	$wpdb->query($wpdb->prepare("UPDATE `wp_posts` SET guid = REPLACE(guid, '$guid', '$new_post_url') WHERE ID=$new_post_id"));
	$wpdb->query($wpdb->prepare("UPDATE `wp_yoast_indexable` SET permalink = '$new_post_url' WHERE object_id=$new_post_id"));

    // update checkboxes
    // update_field('f_be_found', $post['post_value_f_by_found'], $new_post_id);
    // update_field('f_find_someone', $post['post_value_f_find_someone'], $new_post_id);
    // update_field('f_sell_and_buy', $post['post_value_f_sell_and_buy'], $new_post_id);
    // update_field('f_events', $post['post_value_f_events'], $new_post_id);
    // update_field('f_news', $post['post_value_f_news'], $new_post_id);
    // update_field('f_hire_someone', $post['post_value_f_hire_someone'], $new_post_id);

    update_field('f_country',  $post['post_country'], $new_post_id);
    update_field('f_language', $post['post_language'], $new_post_id);
    // PRERIUM FIELDS DISABLED TEMPORARILY
    // update_field('f_price_type', $post['post_price_type'], $new_post_id);
    // update_field('f_booking', $post['post_booking'], $new_post_id);
    // update_field('f_theme', $post['post_theme'], $new_post_id);
    // update_field('f_paywall', $post['post_paywall'], $new_post_id);
    // update_field('f_skill_level', $post['post_skill_level'], $new_post_id);
    // update_field('f_suitible', $post['post_suitible'], $new_post_id);
    // update_field('f_is_special_offer', $post['post_is_special_offer'], $new_post_id);
    // update_field('f_pay_visibility', $post['post_pay_visibility'], $new_post_id);

    // update_field('f_date_selecter', $post['post_date_selecter'], $new_post_id);

    // update_field( 'f_date_selecter', $post['post_is_explisit'], $new_post_id );
   update_field('is_explisit', $post['post_is_explisit'], $new_post_id);

    // update_field('f_map', $locationValue, $new_post_id);
    // update_field($field_name, $value, $this_ID);
    update_field('f_tags', $post['post_tags'], $new_post_id);
    wp_set_object_terms($new_post_id, $post['post_tags'], 'post_tag');
	//echo $new_post_url.'new_post_url';
	//header("Location: $new_post_url", true, 302);
    //wp_redirect($new_post_url);

    if (!is_wp_error($new_post_id)) {
        $response['status'] =  200;
        $response['success'] = true;
        $response['data'] = get_post($new_post_id);
		$response['url']=$new_post_url;
    } else {
        $response['status'] =  200;
        $response['success'] = false;
        $response['message'] = 'No post found!';
    }

    return new WP_REST_Response($response);
}


/**
 * Update a beeart post
 * @param  object $request WP_Request with data
 * @return obeject         WP_REST_Response
 */
function pricode_api_put_callback($request)
{
    $beeart_id = $request->get_param('beeart_id');
    if ($beeart_id > 0) {
        $post['ID'] = $beeart_id;
        $post['post_title'] = sanitize_text_field($request->get_param('title'));
        $post['post_content'] = sanitize_text_field($request->get_param('content'));
        $post['meta_input'] = [
            'genre' => sanitize_text_field($request->get_param('meta_genre'))
        ];
        $post['post_status'] = 'publish';
        $post['post_type'] = 'beeart';
        $new_post_id = wp_update_post($post, true);

        if (!is_wp_error($new_post_id)) {
            $response['status'] =  200;
            $response['success'] = true;
            $response['data'] = $new_post_id;
        } else {
            $response['status'] =  200;
            $response['success'] = false;
            $response['message'] = 'No post found!';
        }
    } else {
        $response['status'] =  200;
        $response['success'] = false;
        $response['message'] = 'beeart id is no set!';
    }
    return new WP_REST_Response($response);
}

function pricode_api_delete_callback($request)
{
    $beeart_id = $request->get_param('beeart_id');
    if ($beeart_id > 0) {
        $deleted_post = wp_delete_post($beeart_id);
        if (!empty($deleted_post)) {
            $response['status'] =  200;
            $response['success'] = true;
            $response['data'] = $deleted_post;
        } else {
            $response['status'] =  200;
            $response['success'] = false;
            $response['message'] = 'No post found!';
        }
    } else {
        $response['status'] =  200;
        $response['success'] = false;
        $response['message'] = 'beeart id is no set!';
    }
    return new WP_REST_Response($response);
}
