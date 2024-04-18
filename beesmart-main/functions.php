<?php

/**

 * @author Beesmart Space

 * @copyright 2017

 */

if (!defined('ABSPATH')) die();

/**
 * Debugger function which shall be removed in production.
 */
if (!function_exists('debug')) {
	/**
	 * Debug function definition.
	 *
	 * @param string $params Holds the variable name.
	 */
	function debug($params)
	{
		/*echo '<pre>';
		print_r($params);
		echo '</pre>';*/
	}
}

function ds_ct_loadjs()
{

	wp_enqueue_script(
		'ds-theme-script',
		get_stylesheet_directory_uri() . '/ds-script.js',

		array('jquery')

	);
}

wp_enqueue_script("webpack-defer", get_stylesheet_directory_uri() . '/assets/dist/main.bundle.js', array('jquery'), false, true);

function add_defer_attribute($tag, $handle)
{
	// add script handles to the array below
	if ('webpack-defer' === $handle) {
		return str_replace(' src', ' defer src', $tag);
	}
	return $tag;
}
add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);




function custom_js()
{

	wp_enqueue_script('custom_fields', get_stylesheet_directory_uri() . '/js/custom_fields.js', array('jquery'), 1.1, false);
	wp_enqueue_script('hive', get_stylesheet_directory_uri() . '/js/hive.js', array('jquery'), 1.2, false);
	wp_localize_script('custom_fields', 'magicalData', array(
		'nonce' => wp_create_nonce('wp_rest'),
		'siteURL' => get_site_url()
	));

	wp_enqueue_script(
		'beesmart-custom-public-js',
		get_stylesheet_directory_uri() . '/js/beesmart-custom-public.js',
		array('jquery'),
		filemtime(get_stylesheet_directory() . '/js/beesmart-custom-public.js'),
		true
	);

	wp_localize_script(
		'beesmart-custom-public-js',
		'Beesmart_Public_JS_Params',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'homeurl' => home_url(),
		)
	);
}

//add_action( 'wp_enqueue_scripts', 'ds_ct_enqueue_parent' );

add_action('wp_enqueue_scripts', 'ds_ct_loadjs');
add_action('wp_enqueue_scripts', 'custom_js');
include('login-editor.php');
include_once('hooks/custom_actions.php');
include_once('hooks/authors.php');
include_once('hooks/user.php');
include_once('hooks/info.php');
include_once('hooks/save_post.php');
include_once('hooks/post.php');
include_once('hooks/hive.php');

include_once('hooks/get_preview.php');
include_once('rest-routes/index.php');
add_filter('gettext', 'replace_hr', 10, 3);
add_filter('ngettext', 'replace_hr', 10, 3);
function replace_hr($translated, $text)
{
	if ($text === '&lt;hr&gt;') {
		$translated = esc_html__('', $domain);
	}
	return $translated;
}
//remove default category (uncategorized) when another category has been set
function remove_default_category($ID, $post)
{

	//get all categories for the post
	$categories = wp_get_object_terms($ID, 'category');

	//if there is more than one category set, check to see if one of them is the default
	if (count($categories) > 1) {
		foreach ($categories as $key => $category) {
			//if category is the default, then remove it
			if ($category->name == "Uncategorized") {
				wp_remove_object_terms($ID, 'uncategorized', 'category');
			}
		}
	}
}
//hook in to the publsh_post action to run when a post is published
add_action('publish_post', 'remove_default_category', 10, 2);

function wpb_widgets_init()
{

	register_sidebar(array(
		'name' => __('Frontend Main Sidebar', 'wpb'),
		'id' => 'sidebar-frontend',
		'description' => __('The main sidebar appears on the right on each page except the front page template', 'wpb'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}

add_action('widgets_init', 'wpb_widgets_init');

function post_form_data($atts, $content = null)
{
	//return urldecode( $_COOKIE['gmw_ul_lng'] );
	global $post;
	$args = array(
		'post_type' => 'post',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'DESC'
	);
	$result = new WP_Query($args);
	if ($result->have_posts()) :
		while ($result->have_posts()) : $result->the_post();
			if ($post->ID = $post->ID) {
				echo get_the_time('G:i:s');
			}
		endwhile;
	endif;
	wp_reset_postdata();
}

add_shortcode('post_form_data', 'post_form_data');

$args = array(
	'posts_per_page' => -1,
	'post_type' => 'post',
);
$result = new WP_Query($args);
if ($result->have_posts()) :
	while ($result->have_posts()) : $result->the_post();
		$test = get_the_date('F j, Y G:i:s');

		$converter = strtotime($test);
		$deletedate = date(strtotime("+28 day 
	 ", $converter));
		if (time() > $deletedate) {
			//echo $test;
			wp_delete_post(get_the_ID());
		}
	endwhile;
endif;
wp_reset_postdata();


function latest_posts()
{

	$args = array('numberposts' => '1');
	$recent_posts = wp_get_recent_posts($args);
	foreach ($recent_posts as $recent) {
		echo '<a href="' . get_permalink($recent["ID"]) . '">View Post</a>';
	}
}
add_shortcode('lastest-post', 'latest_posts');

function my_custom_hook_post()
{
	do_action('my_custom_hook_post');
}

add_action('my_custom_hook_post', 'latest_posts');




function disable_plugin_updates($values)
{

	foreach ($values as $value) {
		unset($value->response['plugin/plugin.php']);
	}
	return;
}
add_filter('site_transient_update_plugins', 'disable_plugin_updates');


function currency_icons()
{ ?>

	<?php
	$post_id = get_current_user_id();

	$all_meta_for_users = get_user_meta($post_id);
	$country = $all_meta_for_users['country'][0];
	$diname = esc_attr(um_user('display_name'));
	global $wpdb;
	$country_new = $wpdb->get_results("SELECT * FROM country WHERE countryname = '$country'");
	?>
	<input type="hidden" id="code_cn" value="<?php print_r($country_new[0]->code); ?>">
	<div class='cont-flg'><?php //echo $country 
							?>
		<span class="countryy"><i></i></span>
		<?php echo $country ?>
	</div>
	<style>
		.countryy i {
			background: url(https://dl.dropboxusercontent.com/s/izcyieh1iatr4n5/flags.png) no-repeat;
			display: inline-block;
			width: 16px;
			height: 11px;
		}
	</style>



<?php }
add_shortcode('currency-icons', 'currency_icons');
function my_custom_currency()
{
	do_action('my_custom_currency');
}

add_action('my_custom_currency', 'currency_icons');

if (!function_exists('wpcfu_output_file_upload_form')) {

	/**
	 * Output the form.
	 *
	 * @param      array  $atts   User defined attributes in shortcode tag
	 */
	function wpcfu_output_file_upload_form($atts)
	{
		$atts = shortcode_atts(array(), $atts);

		$html = '';

		$html .= '<form class="wpcfu-form" method="POST" enctype="multipart/form-data" >';

		$html .= '<p class="form-field">';
		$html .= '<input type="file" name="wpcfu_file">';
		$html .= '</p>';

		$html .= '<p class="form-field">';

		// Output the nonce field
		$html .= wp_nonce_field('upload_wpcfu_file', 'wpcfu_nonce', true, false);

		$html .= '<input type="submit" name="submit_wpcfu_form" value="' . esc_html__('Upload', 'theme-text-domain') . '">';
		$html .= '</p>';

		$html .= '</form>';

		echo $html;
	}
}

/**
 * Add the shortcode '[wpcfu_form]'.
 */
add_shortcode('wpcfu_form', 'wpcfu_output_file_upload_form');

if (!function_exists('wpcfu_handle_file_upload')) {

	/**
	 * Handles the file upload request.
	 */
	function wpcfu_handle_file_upload()
	{
		// Stop immidiately if form is not submitted
		if (!isset($_POST['submit_wpcfu_form'])) {
			return;
		}

		// Verify nonce
		if (!wp_verify_nonce($_POST['wpcfu_nonce'], 'upload_wpcfu_file')) {
			wp_die(esc_html__('Nonce mismatched', 'theme-text-domain'));
		}

		// Throws a message if no file is selected
		if (!$_FILES['wpcfu_file']['name']) {
			wp_die(esc_html__('Please choose a file', 'theme-text-domain'));
		}

		$allowed_extensions = array('jpg', 'jpeg', 'png', 'pdf', 'xls', 'txt', 'doc');
		$file_type = wp_check_filetype($_FILES['wpcfu_file']['name']);
		$file_extension = $file_type['ext'];

		// Check for valid file extension
		if (!in_array($file_extension, $allowed_extensions)) {
			wp_die(sprintf(esc_html__('Invalid file extension, only allowed: %s', 'theme-text-domain'), implode(', ', $allowed_extensions)));
		}

		$file_size = $_FILES['wpcfu_file']['size'];
		$allowed_file_size = 512000; // Here we are setting the file size limit to 500 KB = 500 × 1024

		// Check for file size limit
		if ($file_size >= $allowed_file_size) {
			wp_die(sprintf(esc_html__('File size limit exceeded, file size should be smaller than %d KB', 'theme-text-domain'), $allowed_file_size / 1000));
		}

		// These files need to be included as dependencies when on the front end.
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		require_once(ABSPATH . 'wp-admin/includes/media.php');


		$attachment_id = media_handle_upload('wpcfu_file', 0);

		if (is_wp_error($attachment_id)) {
			// There was an error uploading the image.
			wp_die($attachment_id->get_error_message());
		} else {
			// We will redirect the user to the attachment page after uploading the file successfully.
			wp_redirect('https://beesm.art/user-profile/');

			exit;
		}
	}
}

/**
 * Hook the function that handles the file upload request.
 */
add_action('init', 'wpcfu_handle_file_upload');
add_filter('doing_it_wrong_trigger_error', function () {
	return false;
}, 10, 0);
function excerpt($num)
{
	$limit = $num + 1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ", $excerpt) . "... (<a href='" . get_permalink($post->ID) . " '>Read more</a>)";
	echo $excerpt;
}
add_filter('woocommerce_checkout_fields', 'quadlayers_remove_checkout_fields');
function quadlayers_remove_checkout_fields($fields)
{
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_city']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_phone']);
	unset($fields['order']['order_comments']);
	unset($fields['billing']['billing_email']);
	unset($fields['account']['account_username']);
	unset($fields['account']['account_password']);
	unset($fields['account']['account_password-2']);
	unset($fields['billing']['billing_address_1']);
	unset($fields['billing']['billing_address_2']);
	return $fields;
}
add_filter('woocommerce_add_to_cart_validation', 'bbloomer_only_one_in_cart', 9999, 2);

function bbloomer_only_one_in_cart($passed, $added_product_id)
{
	wc_empty_cart();
	return $passed;
}



function after_search_data()
{
	global $wpdb;
	$selected_id = $_POST['selected_id'];
	//$userId = um_profile_id();
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$new_listing = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower where follower_id =$selected_id and user_id=$current_user_id");

	$follower_cat_id = $new_listing[0]->follower_cat_id;
	$author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
	$selected_category = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $new_listing[0]->follower_cat_id . "'");
	$category_icons = $selected_category[0]->category_icons;
	if ($category_icons == "") {
		$url = site_url() . '/images/010-creativity.png';
	} else {
		$url = site_url() . '/images/' . $category_icons;
	}
	if (!empty($author_category_listing)) {
		$category = array();
		foreach ($author_category_listing as $category_listing) {
			$category[] = $category_listing->category_value;
		}
		$category_data = '<option value="0" data-u-id="' . $selected_id . '">--Add to Unlock--</option>';
		foreach ($category as $category) {
			if ($follower_cat_id == $category) {
				$category_detail = get_cat_name($category);
				$category_data .= '<option value="' . $category . '" data-u-id="' . um_profile_id() . '" selected>' . $category_detail . '</option>';
			} else {
				$category_detail = get_cat_name($category);
				$category_data .= '<option value="' . $category . '" data-u-id="' . um_profile_id() . '">' . $category_detail . '</option>';
			}
		}
	}
	$user = get_user_by('ID', $selected_id);
	$display_name = $user->display_name;
	$user_url = esc_url(home_url('')) . '/user/' . $display_name;
	$html = '<div class="single_following user_follow_' . $selected_id . '"><div class="prof"><img src="' . get_avatar_url($selected_id) . '" /><span> ' . get_the_author_meta("display_name", $selected_id) . '</span></div>
<div class="select_group_manager"> <div class="group_manager_img"><img src="' . $url . '""></div><input type="hidden" name="user_profile_id" value="' . $selected_id . '" class="profile_id"><select name="post_name" class="postname">' . $category_data . '</select>	</div><div class="p_drop"><div class="dropdown"> <a class="" href="#" role="button" id="ab" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path></svg></a><div class="dropdown-menu" aria-labelledby="ab"><a class="dropdown-item user-remove" href="#"  data-target="#removeconfirmation' . $selected_id . '" data-toggle="modal" data-userid="' . $selected_id . '">Remove</a> <a class="dropdown-item user-hide" href="#" data-target="#confirmation' . $selected_id . '" data-toggle="modal" data-userid="' . $selected_id . '">Hide</a> </div> </div></div></div><div class="modal following_modal custom_trsparent_modal" id="confirmation' . $selected_id . '"><div class="modal-dialog"><div class="modal-content"><div class="modal-header border-0"><!--<button type="button" class="close close_2nd" data-dismiss="modal">×</button>--></div><div class="modal-body text-center mb-5 bg-white rounded"><img src="' . site_url() . '/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px"><h3>Are You Sure?</h3><p>Do you really want to hide this user in your listing ?</p> <button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button><a class="btn btn-danger ml-2 cancel_successfully" href="#" data-userid="' . $selected_id . '"">Yes</a></div></div></div></div><div class="modal following_modal custom_trsparent_modal" id="removeconfirmation' . $selected_id . '"><div class="modal-dialog"><div class="modal-content"><div class="modal-header border-0"><!--<button type="button" class="close close_2nd" data-dismiss="modal">×</button>--></div><div class="modal-body text-center mb-5 bg-white rounded"><img src="' . site_url() . '/wp-content/uploads/2022/02/right.png" class="img-fluid mb-2" width="50px"><h3>Are You Sure?</h3><p>Do you really want to remove this user in your listing ?</p><button type="button" class="btn btn-secondary" data-dismiss="modal" class="closebuttonpopup">No</button><a class="btn btn-danger ml-2 remove_successfully" href="#" data-userid="' . $selected_id . '">Yes</a></div></div></div> </div>';
	echo json_encode(array("success" => "true", "data" => $html));
	die;
}
add_action('wp_ajax_after_search_data', 'after_search_data');
add_action('wp_ajax_nopriv_after_search_data', 'after_search_data');

function webroom_woocommerce_coupon_links()
{

	// Bail if WooCommerce or sessions aren't available.

	if (!function_exists('WC') || !WC()->session) {
		return;
	}

	/**
	 * Filter the coupon code query variable name.
	 *
	 * @since 1.0.0
	 *
	 * @param string $query_var Query variable name.
	 */
	$query_var = apply_filters('woocommerce_coupon_links_query_var', 'coupon_code');

	// Bail if a coupon code isn't in the query string.

	if (empty($_GET[$query_var])) {
		return;
	}

	WC()->session->set_customer_session_cookie(true);

	if (!WC()->cart->has_discount($_GET[$query_var])) {

		WC()->cart->add_discount($_GET[$query_var]);
	}
}
add_action('wp_loaded', 'webroom_woocommerce_coupon_links', 30);
add_action('woocommerce_add_to_cart', 'webroom_woocommerce_coupon_links');


function category_created_by_logged_in_user()
{
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$response = array();
	$category_exist = category_exists($_POST['category_value'], 0);
	if ($category_exist) {
		$response['success'] = 'false';
		$response['message'] = "This category already Existed. Please try with other name";
	} else {
		$category_slug = str_replace(' ', '-', $_POST['category_value']);
		$wp_category = array('cat_name' => $_POST['category_value'], 'category_description' => '', 'category_nicename' => $category_slug, 'category_parent' => '');
		$wpdocs_cat_id = wp_insert_category($wp_category);
		if ($wpdocs_cat_id) {
			$category_created_by_author = $wpdb->prefix . 'category_created_by_author';
			//$insert_follower_data = $wpdb->insert($category_created_by_author, array('id' => NULL, 'category_value' => $wpdocs_cat_id, 'author_id' => $current_user_id));
			$wpdb->insert($category_created_by_author, array('id' => NULL, 'category_value' => $wpdocs_cat_id, 'author_id' => $current_user_id, 'category_icons' => $_POST['category_image']));
			$response['success'] = 'true';
			$response['message'] = "Thanks for connecting with us.Your categories has been created";
		}
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_category_created_by_logged_in_user', 'category_created_by_logged_in_user');
add_action('wp_ajax_nopriv_category_created_by_logged_in_user', 'category_created_by_logged_in_user');











function decode_id_to_save_feed()
{
	//print_r($_POST);
	global $wpdb;
	$new_profile_id = $_POST['new_profile_id'];
	$feed_id = $_POST['feed_id'];
	$current_user = wp_get_current_user();
	$global = array();
	$current_user_id = $current_user->ID;
	$save_feed_id = base64_decode($feed_id);
	$resulted_feed = $wpdb->get_results("SELECT * FROM wp_save_feed where save_feed_id ='$save_feed_id'");
	$updated_save_feed = array();
	if ($resulted_feed[0]->other_id == "") {
		foreach ($resulted_feed as $feed_list) {

			$updated_save_feed['user_id'] = $new_profile_id;
		}
		array_push($global, $updated_save_feed);
		$updated_field = serialize($global);
		$other_comment = $wpdb->query($wpdb->prepare("UPDATE wp_save_feed SET other_id='$updated_field' WHERE save_feed_id='$save_feed_id'"));
		if ($other_comment) {
			$response['success'] = 'true';
			$response['message'] = "You have saved this Feed";
		}
	} else {
		$resulted_feed = $wpdb->get_results("SELECT * FROM wp_save_feed where save_feed_id ='$save_feed_id'");
		$var1 = unserialize($resulted_feed[0]->other_id);
		$count = count($var1);
		unset($resulted_feed[0]->other_id);
		unset($resulted_feed[0]->save_feed_id);
		unset($resulted_feed[0]->tool_id);
		unset($resulted_feed[0]->sort_id);
		unset($resulted_feed[0]->store_feed);
		unset($resulted_feed[0]->id);
		$updated_save_feed = array();
		foreach ($resulted_feed[0] as $key => $feed_list) {

			$var1[$count][$key] = $current_user_id;
		}
		$updated_field = serialize($var1);

		$other_comment = $wpdb->query($wpdb->prepare("UPDATE wp_save_feed SET other_id='$updated_field' WHERE save_feed_id='$save_feed_id'"));
		if ($other_comment) {
			$response['success'] = 'true';
			$response['message'] = "You have saved this Feed";
		}
	}
	echo json_encode($response);
	die;
}
 add_action('wp_ajax_decode_id_to_save_feed', 'decode_id_to_save_feed');
 add_action('wp_ajax_nopriv_decode_id_to_save_feed', 'decode_id_to_save_feed');
function unsubscribe_user()
{
	global $wpdb;
	$logged_in_user = $_POST['logged_in_user'];
	$new_profile_id = $_POST['new_profile_id'];
	$unsubscribed = $wpdb->query("delete from wp_um_followers where user_id1=$logged_in_user and user_id2=$new_profile_id");
	$delete = $wpdb->query("delete from wp_um_set_priority_by_follower where user_id=$logged_in_user and follower_id=$new_profile_id");
	if ($unsubscribed) {
		$response['success'] = 'true';
		$response['message'] = "You have Succesfully unsubscribed the user";
	} else {
		$response['success'] = 'false';
		$response['message'] = "Oops something went wrong. Please try again later";
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_unsubscribe_user', 'unsubscribe_user');
add_action('wp_ajax_nopriv_unsubscribe_user', 'unsubscribe_user');
function random_category_change()
{
	$working_dir = getcwd();
	$img_dir = $working_dir;
	$new_path = explode("wp-admin", $working_dir);
	chdir($new_path[0] . "/images/");
	$files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE);
	chdir($new_path[0]);
	shuffle($files);
	for ($i = 0; $i < 16; $i++) {
		if ($files[$i] != "") {
			$new_updated_link = '/images/' . rawurlencode($files[$i]);
			$html .= "<div class='item icon_item active'><img src='$new_updated_link'>  </div>";
		} else {
			$new_updated_link = $image_link . '' . '1.png';
			$html .= "<div class='item icon_item active'><img src='$new_updated_link'>  </div>";
		}
	}

	echo $html;
	die;
}
add_action('wp_ajax_random_category_change', 'random_category_change');
add_action('wp_ajax_nopriv_random_category_change', 'random_category_change');

// Our custom post type function
function create_posttype()
{

	register_post_type(
		'beeart',
		// CPT Options
		array(
			'labels' => array(
				'name' => __('beeart'),
				'singular_name' => __('beeart')
			),
			'public' => true,
			'hierarchical' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'shared'),
			'show_in_rest' => true,
			'supports' => array('title', 'editor', 'author', 'excerpt', 'comments', 'revisions','post-templates'),
			'comments' => true,
			'register_meta_box_cb' => 'add_comment_metaboxes'
		)
	);
}



// Hooking up our function to theme setup
add_action('init', 'create_posttype');



function default_comments_on($data)
{
	if ($data['post_type'] == 'beeart') {
		$data['comment_status'] = 'open';
	}

	return $data;
}
add_filter('wp_insert_post_data', 'default_comments_on');
apply_filters('woocommerce_get_terms_and_conditions_checkbox_text', get_option('woocommerce_checkout_terms_and_conditions_checkbox_text', sprintf(__('I have read and agree to the website %s', 'woocommerce'), '[terms]')));

// Add the custom columns to the beeart post type:
/*add_filter('manage_beeart_posts_columns', 'set_custom_edit_beeart_columns');
function set_custom_edit_beeart_columns($columns)
{
	unset($columns['author']);
	$columns['Location'] = __('Location', 'your_text_domain');
	$columns['latitude'] = __('latitude', 'your_text_domain');
	$columns['longitude'] = __('longitude', 'your_text_domain');

	return $columns;
}
add_filter('manage_peacekeeper_posts_columns', 'set_custom_edit_peacekeeper_columns');*/
function set_custom_edit_peacekeeper_columns($columns)
{
	unset($columns['author']);
	$columns['Location'] = __('Location', 'your_text_domain');
	$columns['latitude'] = __('latitude', 'your_text_domain');
	$columns['longitude'] = __('longitude', 'your_text_domain');

	return $columns;
}
// Add the data to the custom columns for the beeart post type:
add_action('manage_peacekeeper_posts_custom_column', 'custom_peacekeeper_column', 10, 2);
function custom_peacekeeper_column($column, $post_id)
{

	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM `peacekeeper`  WHERE 	post_id =$post_id");
	$location = $result[0]->Location;
	$longitude = $result[0]->longitude;
	$latitude = $result[0]->latitude;


	if ($column == 'Location') {
		echo $location = $location;
	}

	if ($column == 'longitude') {
		echo $longitude = $longitude;
	}

	if ($column == 'latitude') {
		echo $latitude = $latitude;
	}
}


/**
 * Add theme settings page.
 */
function beesmart_init_callback()
{
	acf_add_options_page(
		array(
			'page_title' => 'Theme General Settings',
			'menu_title' => 'Theme Settings',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => true,
		)
	);
}

add_action('init', 'beesmart_init_callback');

/**
 * Modify the posts arguments.
 *
 * @param array $args Posts arguments.
 */
function beesmart_alm_modify_query_args_callback($args, $slug)
{

	$focus  = (!empty($_COOKIE['beesmart_user_selected_focus'])) ? $_COOKIE['beesmart_user_selected_focus'] : '';
	//exit;
	$type1  = (!empty($_COOKIE['beesmart_user_selected_type1'])) ? $_COOKIE['beesmart_user_selected_type1'] : '';
	$type2  = (!empty($_COOKIE['beesmart_user_selected_type2'])) ? $_COOKIE['beesmart_user_selected_type2'] : '';
	$sortby = (!empty($_COOKIE['beesmart_user_selected_sort_option'])) ? $_COOKIE['beesmart_user_selected_sort_option'] : '';
	$discover = (!empty($_COOKIE['beesmart_user_selected_discover'])) ? $_COOKIE['beesmart_user_selected_discover'] : '';
	$language = (!empty($_COOKIE['beesmart_user_selected_language'])) ? $_COOKIE['beesmart_user_selected_language'] : '';
	$country = (!empty($_COOKIE['beesmart_user_selected_country'])) ? $_COOKIE['beesmart_user_selected_country'] : '';
	// Check if focus value is provided.
	if (!empty($focus)) {
		$args['meta_query'][] = array(
			'key'     => 'f_type_of_post_by_user_type',
			'value'   => $focus,
			'compare' => '=',
		);
	}

	// Check if type1 value (post type) is provided.
	if (!empty($type1)) {
		$args['meta_query'][] = array(
			'key'     => 'f_custom_post_format',
			'value'   => $type1,
			'compare' => '=',
		);
	}

	if (!empty($language)) {
		$args['meta_query'][] = array(
			'key'     => 'f_language',
			'value'   => sprintf('"%s"', $language),
			'compare' => 'Like',
		);
	}

	if (!empty($country)) {
		$args['meta_query'][] = array(
			'key'     => 'f_country',
			'value'   => sprintf('"%s"', $country),
			'compare' => 'Like',
		);
	}

	if (!empty($type2)) {
		if ($type2 == 'Be Found') {
			$args['meta_query'][] = array(
				'key'     => 'f_be_found',
				'value'   => sprintf('"%s"', $discover),
				'compare' => 'Like',
			);
		} elseif ($type2 == 'Find Someone') {
			$args['meta_query'][] = array(
				'key'     => 'f_find_someone',
				'value'   => sprintf('"%s"', $discover),
				'compare' => 'Like',
			);
		} elseif ($type2 == 'News') {
			$args['meta_query'][] = array(
				'key'     => 'f_news',
				'value'   => sprintf('"%s"', $discover),
				'compare' => 'Like',
			);
		} elseif ($type2 == 'Hire') {
			$args['meta_query'][] = array(
				'key'     => 'f_hire_someone',
				'value'   => sprintf('"%s"', $discover),
				'compare' => 'Like',
			);
		} elseif ($type2 == 'Event') {
			$args['meta_query'][] = array(
				'key'     => 'f_events',
				'value'   => sprintf('"%s"', $discover),
				'compare' => 'Like',
			);
		} elseif ($type2 == 'Sell') {
			$args['meta_query'][] = array(
				'key'     => 'f_sell_and_buy',
				'value'   => sprintf('"%s"', $discover),
				'compare' => 'Like',
			);
		}
	}
	// Define the meta query relation operator if there are more than 1 meta queries.
	if (1 < count($args['meta_query'])) {
		$args['meta_query']['relation'] = 'OR';
	}

	// Check for available sorting options.
	if (!empty($sortby)) {
		if ('most-buzz' === $sortby) { // Sort by "most-buzz".
			$args['order']   = 'DESC';
			$args['orderby'] = 'comment_count';
		} elseif ('oldest' === $sortby) { // Sort by "oldest".
			$args['order']   = 'ASC';
			$args['orderby'] = 'date';
		} elseif ('most-views' === $sortby) { // Sort by "most-views".
			$args['order']    = 'DESC';
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = 'views_counter';
		} elseif ('most-honey' === $sortby) { // Sort by "most-honey".
			$args['order']    = 'DESC';
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = 'love_me_like';
		} elseif ('biggest-garden' === $sortby) { // Sort by "biggest-garden".
		} elseif ('freshest' === $sortby) { // Sort by "freshest".
			$args['order']   = 'DESC';
			$args['orderby'] = 'date';
		}
	}

	// debug( $args ); die("pool");

	return $args;
}

add_filter('alm_modify_query_args', 'beesmart_alm_modify_query_args_callback', 20, 2);

/**
 * Update filter options in cookie which will be used to create filter options.
 *
 * @since 1.0.0
 */
function beesmart_save_filter_options_callback()
{
	define('imgPATH', get_stylesheet_directory_uri() . '/assets/images/');
	$cssArgs = 'col-lg-4 col-md-6';
	$focus = filter_input(INPUT_POST, 'focus', FILTER_SANITIZE_STRING);
	$type1 = filter_input(INPUT_POST, 'type1', FILTER_SANITIZE_STRING);
	//$type2 = filter_input(INPUT_POST, 'type2', FILTER_SANITIZE_STRING);
	$discover = filter_input(INPUT_POST, 'discover', FILTER_SANITIZE_STRING);
	$location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
	$theme = filter_input(INPUT_POST, 'theme', FILTER_SANITIZE_STRING);
	$yaywall = filter_input(INPUT_POST, 'yaywall', FILTER_SANITIZE_STRING);
	$language = filter_input(INPUT_POST, 'language', FILTER_SANITIZE_STRING);
	$country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
	$query_args = array(
		'post_type' => 'beeart', 'posts_per_page' => -1, 'orderby'   => $orderby,
		'order' => $order,
		'meta_query'    => array(
			'relation' => 'OR',
			array(
				'key'     => 'f_type_of_post_by_user_type',
				'value'   => $focus,
				'compare' => '=',
			),
			array(
				'key'     => 'f_custom_post_format',
				'value'   =>  $type1,
				'compare' => '=',
			),
			array(
				'key'     => 'f_language',
				'value'   => $language,
				'compare' => 'LIKE',
			),
			array(
				'key'     => 'f_country',
				'value'   => $country,
				'compare' => 'LIKE',
			),
			array(
				'key'       => 'is_explisit',
				'value'     => $explicit_content,
				'compare'   => '=',
			),
				
		)
		);
		//echo $query_args.'sfgs';
		$the_query = new WP_Query($query_args);
		//echo '</pre>';print_r($the_query);
		if ( $the_query->have_posts() ) :
		 while ( $the_query->have_posts() ) : $the_query->the_post();
		 //print_r($result)
		 $template_value= get_template_part('template-parts/components/post-cart', '', $cssArgs); 
		 endwhile; 
		wp_reset_postdata();
			else :  ?>
			<p><?php _e('Sorry, no Feed matched your criteria.Please choose another Options'); ?></p>
		<?php endif; 

	 die;
}

add_action('wp_ajax_save_filter_options', 'beesmart_save_filter_options_callback');

/**
 * Update filter options in cookie which will be used to create filter options.
 *
 * @since 1.0.0
 */
function beesmart_save_filter_sorting_options_callback()
{
	define('imgPATH', get_stylesheet_directory_uri() . '/assets/images/');
	$cssArgs = 'col-lg-4 col-md-6';
	$sortby = filter_input(INPUT_POST, 'sortby', FILTER_SANITIZE_STRING);
	if (!empty($sortby)) {
			if ('most-buzz' === $sortby) { // Sort by "most-buzz".
				$order   = 'DESC';
				$orderby = 'comment_count';//Done
				//echo 'd';
			} elseif ('oldest' === $sortby) { // Sort by "oldest".
				$order   = 'ASC';
				$orderby = 'date';//Done
				//echo 'ss';
			} elseif ('most-views' === $sortby) { // Sort by "most-views".
				$order   = 'DESC';
				$orderby  = 'post_views';
				$meta_key = 'views_counter';  //Done
				//echo 'ssss12sssss';
			} elseif ('most-honey' === $sortby) { // Sort by "most-honey".
				$order    = 'DESC';
				//$meta_value='meta_value_num';
				$orderby  = 'meta_value_num';
				$meta_key = 'love_me_like';
				$query = array(
					'key'     => $meta_key,
				);
				//echo '344343434';
			} elseif ('biggest-garden' === $sortby) { // Sort by "biggest-garden".
			} elseif ('freshest' === $sortby) { // Sort by "freshest".
				$order  = 'DESC';
				$orderby = 'date';//Done
				//echo 'ssss1dsdf2sssss';
			}
		}
		
			$query_args = array(
			'post_type' => 'beeart', 'posts_per_page' => -1, 'orderby'   => $orderby,
			'order' => $order,
			'meta_query'    => array(
				'relation' => 'OR',
				$query,
			));
			//echo $query_args.'query_args';
			$the_query = new WP_Query($query_args);
			//echo '<pre>';print_r($the_query);
		if ( $the_query->have_posts() ) :
		 while ( $the_query->have_posts() ) : $the_query->the_post();
		 //print_r($result)
		 get_template_part('template-parts/components/post-cart', '', $cssArgs); 
		 endwhile; 
		 wp_reset_postdata();
			else :  ?>
			<p><?php _e('Sorry, no Feed matched your criteria.Please choose another Options'); ?></p>
		<?php endif; 
	
	die;
}

add_action('wp_ajax_save_filter_sorting_options', 'beesmart_save_filter_sorting_options_callback');

/**
 * Update the post views count.
 *
 * @since 1.0.0
 */
function beesmart_wp_footer_callback()
{
	// If it's the single post page.
	if (is_singular('post')) {
		$post_id    = get_the_ID();
		$post_views = (int) get_post_meta($post_id, 'views_counter', true); // Get the current views counter.
		$post_views++; // Increase the counter.
		update_post_meta($post_id, 'views_counter', $post_views);
	}
}

add_action('wp_footer', 'beesmart_wp_footer_callback');
/**
 * Display the post views counter.
 *
 * @since 1.0.0
 */
function beesmart_post_submitbox_misc_actions_callback()
{
	global $post;

	// Return, if this is not the product page.
	if ('post' !== $post->post_type) {
		return;
	}

	$post_views = (int) get_post_meta($post->ID, 'views_counter', true); // Get the current views counter.
?>
	<div class="misc-pub-section" id="beesmart-post-views-notice">
		<?php esc_html_e('Post Views:', 'beesmart'); ?>
		<strong id="beesmart-post-views-notice-display"><?php echo esc_html($post_views); ?></strong>
	</div>
	<?php
}

add_action('post_submitbox_misc_actions', 'beesmart_post_submitbox_misc_actions_callback');

/**
 * Update filter options in cookie which will be used to create filter options.
 *
 * @since 1.0.0
 */
function addItem($serializedArray, $item)
{

	$a = $serializedArray;
	$a[] = $item;
	return $a;
}
function beesmart_save_filter_user_feed_callback()
{
	$feedname = filter_input(INPUT_POST, 'feedname', FILTER_SANITIZE_STRING);
	$feed_have = filter_input(INPUT_POST, 'feed_have', FILTER_SANITIZE_STRING);
	$visibility = filter_input(INPUT_POST, 'visibility', FILTER_SANITIZE_STRING);

	$focus  = (!empty($_POST['beesmart_user_selected_focus'])) ? $_POST['beesmart_user_selected_focus'] : '';
	$type1  = (!empty($_POST['beesmart_user_selected_type1'])) ? $_POST['beesmart_user_selected_type1'] : '';
	$type2  = (!empty($_POST['beesmart_user_selected_type2'])) ? $_POST['beesmart_user_selected_type2'] : '';
	$discover  = (!empty($_POST['beesmart_user_selected_discover'])) ? $_POST['beesmart_user_selected_discover'] : '';
	$location  = (!empty($_POST['beesmart_user_selected_location'])) ? $_POST['beesmart_user_selected_location'] : '';
	$theme  = (!empty($_POST['beesmart_user_selected_theme'])) ? $_POST['beesmart_user_selected_theme'] : '';
	$yaywall  = (!empty($_POST['beesmart_user_selected_yaywall'])) ? $_POST['beesmart_user_selected_yaywall'] : '';
	$sortby = (!empty($_POST['beesmart_user_selected_sort_option'])) ? $_POST['beesmart_user_selected_sort_option'] : '';
	$sortby = (!empty($_POST['beesmart_user_selected_sort_option'])) ? $_POST['beesmart_user_selected_sort_option'] : '';
	$language = (!empty($_POST['beesmart_user_selected_language'])) ? $_POST['beesmart_user_selected_language'] : '';
	$country = (!empty($_POST['beesmart_user_selected_country'])) ? $_POST['beesmart_user_selected_country'] : 'all';
	$_visibility = (!empty($_POST['beesmart_user_selected_visibility'])) ? $_POST['beesmart_user_selected_visibility'] : '0';
	$explicit_content = (!empty($_POST['beesmart_user_explicit_content'])) ? $_POST['beesmart_user_explicit_content'] : '0';
	$range_value = (!empty($_POST['beesmart_user_explicit_range'])) ? $_POST['beesmart_user_explicit_range'] : '0';
	$_hive_manager = (!empty($_POST['beesmart_user_hive_manager'])) ? $_POST['beesmart_user_hive_manager'] : '0';
	$logged_user_id = (!empty($_POST['beesmart_user_logged_in_user_id'])) ? $_POST['beesmart_user_logged_in_user_id'] : '0';

	$previous_meta_feed = get_user_meta(get_current_user_id(), 'beesmart-filter-feed-options', true);
	$feed_id = rand(10000000, 99999999);
	$feed = array(
		'feed_id' => $feed_id,
		'focus'  => $focus,
		'type1'  => $type1,
		'type2'  => $type2,
		'discover'  => $discover,
		'location'  => $location,
		'theme'  => $theme,
		'paywall'  => $yaywall,
		'sortby' => $sortby,
		'language' => $language,
		'country' => $country,
		'feedname' => $feedname,
		'feed_have' => $feed_have,
		'visibility' => $_visibility,
		'explicit_content' => $explicit_content,
		'range' => $range_value,
		'distribution' => 0,
		'hive_manager_ids' => $_hive_manager,
		'user_id' => $logged_user_id
	);
	if (!empty($previous_meta_feed)) {
		$previous_meta_feed_update =  addItem($previous_meta_feed, $feed);
	} else {
		$previous_meta_feed_update[] = $feed;
	}

	$previous_meta_feed = update_user_meta(get_current_user_id(), 'beesmart-filter-feed-options', $previous_meta_feed_update);


	if ($previous_meta_feed) {
		$response['success'] = 'true';
		$response['feed_id'] = base64_encode($feed_id);
	}
	echo json_encode($response);
	die;
}

add_action('wp_ajax_save_filter_user_feed', 'beesmart_save_filter_user_feed_callback');



function remove_user_from_friend_list()
{
	global $wpdb;
	$user_id = $_POST['user_id'];
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$unfriend = $wpdb->query("delete from wp_um_friends where user_id1=$current_user_id and user_id2=$user_id");
	if (empty($unfriend)) {
		$againunfriend = $wpdb->query("delete from wp_um_friends where user_id1=$user_id and user_id2=$current_user_id");
		if ($againunfriend) {
			$response['success'] = 'true';
			$response['message'] = "You have successfully Unfriend this user";
		}
	} else {
		$response['success'] = 'true';
		$response['message'] = "You have successfully Unfriend this user";
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_remove_user_from_friend_list', 'remove_user_from_friend_list');
add_action('wp_ajax_nopriv_remove_user_from_friend_list', 'remove_user_from_friend_list');



function update_category_icons()
{
	global $wpdb;
	$category_id = $_POST['category_id'];
	$category_icons = $_POST['category_icons'];
	if ($category_icons == "") {
		$response['success'] = 'false';
		$response['message'] = "Please Choose category icons";
	} else {
		$update_category_icons = $wpdb->query($wpdb->prepare("UPDATE wp_category_created_by_author SET category_icons='$category_icons' WHERE category_value=$category_id"));
		if ($update_category_icons) {
			$response['success'] = 'true';
			$response['message'] = "You have Succesfully updated this Category Icons";
		} else {
			$response['success'] = 'false';
			$response['message'] = "Oops something went wrong. Please try again later";
		}
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_update_category_icons', 'update_category_icons');
add_action('wp_ajax_nopriv_update_category_icons', 'update_category_icons');

function my_acf_init()
{
	acf_update_setting('google_api_key', 'AIzaSyCi_8Xy7rzVfcVLoahwP7PJFknxybW8ECM');
}
add_action('acf/init', 'my_acf_init');

add_action('template_redirect', 'wc_custom_redirect_after_purchase');

function wc_custom_redirect_after_purchase()
{
	global $wp;
	if (is_checkout() && !empty($wp->query_vars['order-received'])) {
		$post_create = get_user_meta(get_current_user_id(), 'post_can_create', '0');
		if ($post_create == '') {
			add_user_meta(get_current_user_id(), 'post_can_create', '0', true);
		}
		$order = new WC_Order($wp->query_vars['order-received']);
		$quantity = 0;
		if (count($order->get_items()) > 0) {
			foreach ($order->get_items() as $item) {
				$order_id = $item['order_id'];
				if (!empty($item)) {
					$quantity += $item['qty'];
					if ($item['product_id'] == '6466') {
						update_user_meta(get_current_user_id(), 'post_can_create', '4');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6465') {
						update_user_meta(get_current_user_id(), 'post_can_create', '4');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6464') {
						update_user_meta(get_current_user_id(), 'post_can_create', '4');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6819') {
						update_user_meta(get_current_user_id(), 'post_can_create', '4');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6749') {
						update_user_meta(get_current_user_id(), 'post_can_create', '16');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6480') {
						update_user_meta(get_current_user_id(), 'post_can_create', '16');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6485') {
						update_user_meta(get_current_user_id(), 'post_can_create', '16');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6817') {
						update_user_meta(get_current_user_id(), 'post_can_create', '16');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6469') {
						update_user_meta(get_current_user_id(), 'post_can_create', '8');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6471') {
						update_user_meta(get_current_user_id(), 'post_can_create', '8');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6473') {
						update_user_meta(get_current_user_id(), 'post_can_create', '8');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6818') {
						update_user_meta(get_current_user_id(), 'post_can_create', '8');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6459') {
						update_user_meta(get_current_user_id(), 'post_can_create', '1');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6460') {
						update_user_meta(get_current_user_id(), 'post_can_create', '1');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6462') {
						update_user_meta(get_current_user_id(), 'post_can_create', '1');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					} elseif ($item['product_id'] == '6820') {
						update_user_meta(get_current_user_id(), 'post_can_create', '1');
						wp_redirect(home_url('/account-page/orders/#' . $order_id));
					}
				}
			}
		}
	}
}
function check_user_plan()
{
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$post_count = get_user_meta($current_user_id, 'post_can_create', true);
	if ($post_count == 1) {
		$time_in_days = 30; // 1 means in last day
		$count = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT COUNT(*) 
				FROM $wpdb->posts 
				WHERE post_status = 'publish' 
				AND post_type = %s 
				AND post_author = %s
				AND post_date >= DATE_SUB(CURDATE(),INTERVAL %s DAY)",
				'post',
				$current_user_id,
				$time_in_days
			)
		);
		if (0 < $count)
			$count = number_format($count);
		if (1 < $count) {
			$response['success'] = 'false';
			$response['message'] = "Your subscription plan is not valid to posts more them one posts in a month";
		} else {
			$response['success'] = 'true';
			$response['message'] = "Congratulation you have successfully create your post";
		}
	} else if ($post_count == 4) {
		$time_in_days = 30; // 1 means in last day
		$count = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT COUNT(*) 
				FROM $wpdb->posts 
				WHERE post_status = 'publish' 
				AND post_type = %s 
				AND post_author = %s
				AND post_date >= DATE_SUB(CURDATE(),INTERVAL %s DAY)",
				'post',
				$current_user_id,
				$time_in_days
			)
		);
		if (0 < $count)
			$count = number_format($count);
		if (3 < $count) {
			$response['success'] = 'false';
			$response['message'] = "Your subscription plan is not valid to posts more them one posts in a month";
		} else {
			$response['success'] = 'true';
			$response['message'] = "Congratulation you have successfully create your post";
		}
	} else if ($post_count == 8) {
		$time_in_days = 30; // 1 means in last day
		$count = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT COUNT(*) 
				FROM $wpdb->posts 
				WHERE post_status = 'publish' 
				AND post_type = %s 
				AND post_author = %s
				AND post_date >= DATE_SUB(CURDATE(),INTERVAL %s DAY)",
				'post',
				$current_user_id,
				$time_in_days
			)
		);
		if (0 < $count)
			$count = number_format($count);
		if (7 < $count) {
			$response['success'] = 'false';
			$response['message'] = "Your subscription plan is not valid to posts more them one posts in a month";
		} else {
			$response['success'] = 'true';
			$response['message'] = "Congratulation you have successfully create your post";
		}
	} else if ($post_count == 16) {
		$time_in_days = 30; // 1 means in last day
		$count = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT COUNT(*) 
				FROM $wpdb->posts 
				WHERE post_status = 'publish' 
				AND post_type = %s 
				AND post_author = %s
				AND post_date >= DATE_SUB(CURDATE(),INTERVAL %s DAY)",
				'post',
				$current_user_id,
				$time_in_days
			)
		);
		if (0 < $count)
			$count = number_format($count);
		if (15 < $count) {
			$response['success'] = 'false';
			$response['message'] = "Your subscription plan is not valid to posts more them one posts in a month";
		} else {
			$response['success'] = 'true';
			$response['message'] = "Congratulation you have successfully create your post";
		}
	} else {
		$time_in_days = 30; // 1 means in last day
		$count = $wpdb->get_var(
			$wpdb->prepare(
				"
				SELECT COUNT(*) 
				FROM $wpdb->posts 
				WHERE post_status = 'publish' 
				AND post_type = %s 
				AND post_author = %s
				AND post_date >= DATE_SUB(CURDATE(),INTERVAL %s DAY)",
				'post',
				$current_user_id,
				$time_in_days
			)
		);
		if (0 < $count)
			$count = number_format($count);
		if (15 < $count) {
			$response['success'] = 'false';
			$response['message'] = "Your subscription plan is not valid to posts more them one posts in a month";
		} else {
			$response['success'] = 'true';
			$response['message'] = "Congratulation you have successfully create your post";
		}
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_check_user_plan', 'check_user_plan');
add_action('wp_ajax_nopriv_check_user_plan', 'check_user_plan');



/*New Design with pointing System*/
function add_to_points_functionality()
{
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$post_id = $_POST['post_id'];
	$honey_points = $_POST['honey_points'];
	$coins_points = get_user_meta($current_user_id, 'mycred_default', true);
	$coins_pointss=intval($coins_points);
	$get_like_count=get_post_meta($post_id, 'love_me_like', true);
	$honey_percentage=($coins_points/100)*$honey_points;/*Get Percentage according to user donation*/
	$honey_percentage_coins=intval($honey_percentage);/*Percentage in integer form*/
	$goes_to_user_profile=($honey_percentage_coins/100)*25;/*Get 25% Percentage*/
	$goes_to_post=$honey_percentage;//Go to post
	$final_post_amount=$get_like_count+$goes_to_post;
	$get_like_count=update_post_meta($post_id, 'love_me_like', $final_post_amount);/*Update honey Post amount*/
	$after_final_honey=get_post_meta($post_id, 'love_me_like', true);/*Get honey Post amount*/
	$author_id = get_post_field( 'post_author', $post_id );/*Get Post author Id*/
	$created_post_author = get_user_meta($author_id, 'mycred_default', true);
	$new_author_honey_count=$created_post_author+$goes_to_user_profile;
	$check = update_user_meta($author_id, 'mycred_default', $new_author_honey_count);
	$reduction_points = ($coins_points / 100) * $honey_points;
	$after_reduct = intval($reduction_points);
	$update_value = $coins_points - $reduction_points;

	$Check_post_exist = get_post_meta($post_id, 'post_points_after_like', true);
	if ($Check_post_exist == "" || $Check_post_exist == "null") {
		add_post_meta($post_id, 'post_points_after_like', $after_reduct);
	}
	$check = update_user_meta($current_user_id, 'mycred_default', $update_value);
	$find = get_post_meta($post_id, 'post_points_after_like', true);
	$updated = $find + $reduction_points;
	update_post_meta($post_id, 'post_points_after_like', $updated);
	$after_points = get_user_meta($current_user_id, 'mycred_default', true);
	$one_percentage = ($after_points / 100) * 1;
	$tenth_percentage = ($after_points / 100) * 10;
	$precision = 1;
	// function number_format_short($n, $precision = 1 ) {
	if ($after_final_honey < 900) {
		// 0 - 900
		$n_format = number_format($love, $precision);
		$n_format=intval($n_format);
		$suffix = '';
	} else if ($after_final_honey < 900000) {
		// 0.9k-850k
		$n_format = number_format($after_final_honey / 1000, $precision);
		$suffix = 'K';
	} else if ($after_final_honey < 900000000) {
		// 0.9m-850m
		$n_format = number_format($love / 1000000, $precision);
		$suffix = 'M';
	} else if ($after_final_honey < 900000000000) {
		// 0.9b-850b
		$n_format = number_format($after_final_honey / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($after_final_honey / 1000000000000, $precision);
		$suffix = 'T';
	}
	if ( $precision > 0 ) {
		$dotzero = '.' . str_repeat( '0', $precision );
		$n_format = str_replace( $dotzero, '', $n_format );
	}
			$get_new_data=$n_format . $suffix;
	if ($check) {
		$response['success'] = 'true';
		$response['message'] = "You have spend $honey_points % on this post";
		$response['one_percentage'] = intval($one_percentage);
		$response['tenth_percentage'] = intval($tenth_percentage);
		$response['total_honey'] = intval($after_points);
		$response['after_final_honey'] = $get_new_data;
	} else {
		$response['success'] = 'false';
		$response['message'] = "Oops Something went Wrong.Please Try again later";
	}

	echo json_encode($response);
	die;
}
add_action('wp_ajax_add_to_points_functionality', 'add_to_points_functionality');
add_action('wp_ajax_nopriv_add_to_points_functionality', 'add_to_points_functionality');
add_filter("um_builder_input_map", "um_020422_change_options_sanitization");
function um_020422_change_options_sanitization($arr)
{
	$arr['_options']['sanitize'] = 'wp_kses';
	return $arr;
}
add_action('wp_ajax_bees_get_list', 'bees_get_list');
add_action('wp_ajax_nopriv_bees_get_list', 'bees_get_list');
function bees_get_list()
{
	global $wpdb;
	$query = $wpdb->get_results("SELECT user_email FROM wp_users");
	foreach ($query as $email) {
		echo $email;
	}
	die;
}
function reducted_points_after_use_like()
{
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$post_id = $_POST['post_id'];
	$previous_value = $_POST['previous_value'];
	$new_post_id = explode('post_', $post_id);
	$new_like_count = get_post_meta($new_post_id[1], 'love_me_like', true);
	if ($new_like_count == '' || $new_like_count == "null") {
		add_post_meta($new_post_id[1], 'love_me_like', '0');
	}
	$new_like_count = get_post_meta($new_post_id[1], 'love_me_like', true);
	if ($new_like_count > $previous_value) {
		$coins_points = get_user_meta($current_user_id, 'mycred_default', true);
		$update_coins = $coins_points - 2;
		$update_user_points = update_user_meta($current_user_id, 'mycred_default', $update_coins);
		if ($update_user_points) {
			$response['success'] = 'true';
			$response['message'] = "Your are spending 2 Coins on this Post";
		}
	} else if ($new_like_count < $previous_value) {
		$coins_points = get_user_meta($current_user_id, 'mycred_default', true);
		$update_coins = $coins_points + 2;
		$update_user_points = update_user_meta($current_user_id, 'mycred_default', $update_coins);
		$response['success'] = 'false';
		$response['message'] = "Your 2 coins for this post refunded succesfully";
	} else {
		if ($new_like_count == $previous_value) {
			$response['success'] = 'true';
			$response['message'] = "Oops Something went wrong.Please try again later";
		}
	}
	echo json_encode($response);
	die;
}

add_action('wp_ajax_reducted_points_after_use_like', 'reducted_points_after_use_like');
add_action('wp_ajax_nopriv_reducted_points_after_use_like', 'reducted_points_after_use_like');
function onhover_like_functionality()
{
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$post_id = $_POST['post_id'];
	$like_value = $_POST['like_value'];
	if ($like_value > 100) {
		$response['success'] = 'false';
		$response['message'] = "You can only add 100 Points";
	} else if (!is_numeric($like_value)) {
		$response['success'] = 'false';
		$response['message'] = "Please enter only numeric value";
	} else {
		$coins_points = get_user_meta($current_user_id, 'mycred_default', true);
		$update_value = $coins_points - $like_value;
		$Check_post_exist = get_post_meta($post_id, 'post_points_after_like', true);
		if ($Check_post_exist == "" || $Check_post_exist == "null") {
			add_post_meta($post_id, 'post_points_after_like', $like_value);
		}
		$check = update_user_meta($current_user_id, 'mycred_default', $update_value);
		$find = get_post_meta($post_id, 'post_points_after_like', true);
		$updated = $find + $like_value;
		update_post_meta($post_id, 'post_points_after_like', $updated);

		if ($check) {
			$response['success'] = 'true';
			$response['message'] = "You have spend $like_value Points on this post";
		}
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_onhover_like_functionality', 'onhover_like_functionality');
add_action('wp_ajax_nopriv_onhover_like_functionality', 'onhover_like_functionality');
function onclick_like_functionality()
{
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$post_id = $_POST['post_id'];
	$like_value = $_POST['like_value'];
	$honey_points = $_POST['honey_points'];
	$coins_points = get_user_meta($current_user_id, 'mycred_default', true);
	$update_value = $coins_points - $like_value;
	$Check_post_exist = get_post_meta($post_id, 'post_points_after_like', true);
	if ($Check_post_exist == "" || $Check_post_exist == "null") {
		add_post_meta($post_id, 'post_points_after_like', $like_value);
	}
	$check = update_user_meta($current_user_id, 'mycred_default', $update_value);
	$find = get_post_meta($post_id, 'post_points_after_like', true);
	$updated = $find + $like_value;
	update_post_meta($post_id, 'post_points_after_like', $updated);

	if ($check) {
		$response['success'] = 'true';
		$response['message'] = "You have spend $honey_points on this post";
	}

	echo json_encode($response);
	die;
}

add_action('wp_ajax_onclick_like_functionality', 'onclick_like_functionality');
add_action('wp_ajax_nopriv_onclick_like_functionality', 'onclick_like_functionality');
add_action('wp_ajax_bees_unique_get_list', 'bees_unique_get_list');
add_action('wp_ajax_nopriv_bees_unique_get_list', 'bees_unique_get_list');
function bees_unique_get_list()
{
	global $wpdb;
	$email_value = $_POST['email_value'];
	$resulted_data = $wpdb->get_results("SELECT * FROM `wp_users` WHERE `user_email` LIKE '$email_value'");

	if (empty($resulted_data)) {
		$response['success'] = 'false';
		$response['message'] = "Email not found in database";
	} else {
		$response['success'] = 'true';
		$response['message'] = "You have already an account on our website please login";
	}

	echo json_encode($response);
	die;
}

function enable_comments_custom_post_type()
{
	add_post_type_support('beeart', 'comments');
}
add_action('init', 'enable_comments_custom_post_type', 11);
add_post_type_support('beeart', array('comments'));
add_action('init', 'beeart');




function load_more_category_in_savefeed()
{
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$results_per_page = 15;
	$page = $_POST['page'];
	$page_first_result = ($page - 1) * $results_per_page;
	$number_of_result = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where `author_id` =$current_user_id");
	$own_category_results = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where `author_id` =$current_user_id LIMIT " . $page_first_result . ',' . $results_per_page);
	$gmw_icons = get_option('gmw_icons');
	$image_link = $gmw_icons['pt_category_icons']['url'];
	if (!empty($own_category_results)) {
		$loop = 1;
		foreach ($own_category_results as $results) {
			$category_ids = $results->category_value;
			$category_icons = $results->category_icons;
			$category_name = get_cat_name($category_ids);
			if ($category_name != "") {
				if ($category_icons == "") {
					$category_icons = '1.png';
				} else {
					$category_icons = $category_icons;
				}
				$response['success'] = 'true';
				$response['message'][] = '<div class="item icon_item" data-id="' . $results->id . '"><img src="' . $image_link . '' . $category_icons . '"></div>';
				$loop++;
			}
		}
	} else {
		$response['success'] = 'false';
		$response['message'] = 'No more Save feed Image found';
	}
	echo  json_encode($response);
	die;
}
add_action('wp_ajax_load_more_category_in_savefeed', 'load_more_category_in_savefeed');
add_action('wp_ajax_nopriv_load_more_category_in_savefeed', 'load_more_category_in_savefeed');

function edit_feed_listing()
{
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$feed_id = $_POST['edit_feed_function'];
	$edit_feed_name = $_POST['edit_feed_name'];
	$edit_feed_stickers = $_POST['edit_feed_stickers'];
	$edit_visibility = $_POST['edit_visibility'];
	$explicit_content = $_POST['explicit_content'];
	$user_edit_feed = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
	$update_list = array();
	foreach ($user_edit_feed as $key => $edit_listing) {
		if ($feed_id == $edit_listing['feed_id']) {
			$feed_ids = $edit_listing['feed_id'];
			$focus = $edit_listing['focus'];
			$type1 = $edit_listing['type1'];
			$type2 = $edit_listing['type2'];
			$location = $edit_listing['location'];
			$theme = $edit_listing['theme'];
			$yaywall = $edit_listing['paywall'];
			$sortby = $edit_listing['sortby'];
			$language = $edit_listing['language'];
			$country = $edit_listing['country'];
			$language = $edit_listing['language'];
			$user_edit_feed[$key]['feedname'] = $edit_feed_name;
			$user_edit_feed[$key]['feed_have'] = $edit_feed_stickers;
			$user_edit_feed[$key]['visibility'] = $edit_visibility;
			$user_edit_feed[$key]['explicit_content'] = $explicit_content;
		}
	}
	$updated_feed_data = update_user_meta($current_user_id, 'beesmart-filter-feed-options', $user_edit_feed);
	if ($edit_visibility != '') {
		foreach ($user_edit_feed as $key => $edit_listing) {
			if ($feed_id == $edit_listing['feed_id']) {
				$userids[] = $edit_listing['user_id'];
			}
		}
		$useridss = explode(',', strval($userids[0]));
		$clone_count = count($useridss);
		for ($clone = 1; $clone <= $clone_count; $clone++) {
			$user_id = $useridss[$clone];
			$final_list = get_user_meta($user_id, 'beesmart-filter-feed-options', true);

			foreach ($final_list as $key => $edit_listing1) {
				if ($feed_id == $edit_listing1['feed_id']) {
					$edit_listing1['parent_visibility_feed_id'] = $edit_visibility;
					$final_list[$key] = $edit_listing1;
					break;
				}
			}
			$updated_feed_data1 = update_user_meta($user_id, 'beesmart-filter-feed-options', $final_list);
		}
	}
	if ($updated_feed_data) {
		$response['success'] = 'true';
		$response['message'] = "You have updated this Feed";
	} else {
		$response['success'] = 'true';
		$response['message'] = "You have updated this Feed";
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_edit_feed_listing', 'edit_feed_listing');
add_action('wp_ajax_nopriv_edit_feed_listing', 'edit_feed_listing');

function delete_feed_listing()
{
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$delete_feed_id = $_POST['delete_feed_id'];
	$user_edit_feed = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);

	if ($delete_feed_id != '') {
		foreach ($user_edit_feed as $key => $delete_listing) {
			if ($delete_feed_id == $delete_listing['feed_id']) {
				$userids[] = $delete_listing['user_id'];
			}
		}
		$useridss = explode(',', strval($userids[0]));
		$clone_count = count($useridss);
		for ($clone = 0; $clone <= $clone_count; $clone++) {
			$user_id = $useridss[$clone];
			$final_list = get_user_meta($user_id, 'beesmart-filter-feed-options', true);

			foreach ($final_list as $key => $edit_listing1) {
				if ($delete_feed_id == $edit_listing1['feed_id']) {
					unset($final_list[$key]);
					break;
				}
			}
			$other_feed_listing = array_values($final_list);
			$updated_feed_data1 = update_user_meta($user_id, 'beesmart-filter-feed-options', $other_feed_listing);
			if ($updated_feed_data1) {
				$new_arry = array();
				foreach ($user_edit_feed as $key => $edit_listing) {
					if ($delete_feed_id == $edit_listing['feed_id']) {
						unset($user_edit_feed[$key]);
						break;
					}
				}
				$update_feed_listing = array_values($user_edit_feed);
				$user_feed = update_user_meta($current_user_id, 'beesmart-filter-feed-options', $update_feed_listing);
			}
		}
	}

	if ($user_feed) {
		$response['success'] = 'true';
		$response['message'] = "You have updated this Feed";
	} else {
		$response['success'] = 'false';
		$response['message'] = "Something went wrong.Please Try again later";
	}
	echo json_encode($response);
	die;
}

add_action('wp_ajax_delete_feed_listing', 'delete_feed_listing');
add_action('wp_ajax_nopriv_delete_feed_listing', 'delete_feed_listing');


function save_other_user_feed()
{
	$feed_id = $_POST['feed_id'];
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$userId = $_POST['profile_id'];
	$user_edit_feed = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
	foreach ($user_edit_feed as $key => $edit_listing) {
		if ($feed_id == $edit_listing['feed_id']) {
			$feed_ids = $edit_listing['feed_id'];
			$user_edit_feed[$key]['distribution'] = $edit_listing['distribution'] + 1;
			$user_edit_feed[$key]['user_id'] = $edit_listing['user_id'] . ',' . $userId;
		}
	}
	$updated_feed_data = update_user_meta($current_user_id, 'beesmart-filter-feed-options', $user_edit_feed);
	$user_profile_feed = get_user_meta($userId, 'beesmart-filter-feed-options', true);
	$child_id = rand(100000000, 999999999);
	foreach ($user_edit_feed as $key => $edit_listing) {
		if ($feed_id == $edit_listing['feed_id']) {
			$edit_listing['child_feed_id'] = $child_id;
			$edit_listing['user_id'] = $current_user_id;
			$edit_listing['parent_visibility_feed_id'] = $edit_listing['visibility'];
			unset($edit_listing['focus']);
			unset($edit_listing['type1']);
			unset($edit_listing['type2']);
			unset($edit_listing['discover']);
			unset($edit_listing['location']);
			unset($edit_listing['theme']);
			unset($edit_listing['paywall']);
			unset($edit_listing['sortby']);
			unset($edit_listing['language']);
			unset($edit_listing['country']);
			unset($edit_listing['hive_manager_ids']);
			unset($edit_listing['range']);
			unset($edit_listing['distribution']);
			$update_save_feed = $edit_listing;
			break;
		}
	}
	if (!empty($user_profile_feed)) {
		$previous_meta_feed_update =  addItem($user_profile_feed, $update_save_feed);
	} else {
		$previous_meta_feed_update[] = $update_save_feed;
	}
	$save_feed = update_user_meta($userId, 'beesmart-filter-feed-options', $previous_meta_feed_update);
	if ($save_feed) {
		$response['success'] = 'true';
		$response['message'] = "Feed save successfully";
	} else {
		$response['success'] = 'true';
		$response['message'] = "Feed not saved";
	}
	echo json_encode($response);
	die;
}

add_action('wp_ajax_save_other_user_feed', 'save_other_user_feed');
add_action('wp_ajax_nopriv_save_other_user_feed', 'save_other_user_feed');
function save_hive_data()
{
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	
	foreach ($_POST as $key => $value) {
		unset ($_POST[count($_POST)-1]);
		$new_value = explode('_', $key);
		$user_id = $new_value[2];
		$post_ids = implode(',', $value);
		
		$update_category_icons=$wpdb->query($wpdb->prepare("UPDATE wp_um_set_priority_by_follower SET follower_cat_id='$post_ids' WHERE follower_id=$user_id AND user_id=$current_user_id"));
		$find_selected_category = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE follower_id=$user_id AND user_id=$current_user_id");

		foreach ($find_selected_category as $selected_categories) {
			$new_images .= '<div class="post_category_' . $user_id . '">';
			$categories_id = $selected_categories->follower_cat_id;
			$selected_ids = explode(',', $categories_id);
			for ($i = 1; $i < count($selected_ids); $i++) {
				$find_images = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $selected_ids[$i] . "' And author_id='" . $current_user_id . "'");
				foreach ($find_images as $selected_image) {
					$final_category_stickers = $selected_image->category_icons;
				}
				$resulted_stickers[] = $final_category_stickers;
			}
			if (empty($resulted_stickers)) {
				$site_url = site_url();

				$url = $site_url . '/wp-content/uploads/2022/05/Hives-Sort-later.png';
				$new_images .= '<div class="slides" style="width:100%"><img src="' . $url . '"></div>';
			} else {
				for ($i = 0; $i < count($resulted_stickers); $i++) {
					$new_images .= '<div class="slides" style="width:100%"><img src="/images/' . $resulted_stickers[$i] . '"></div>';
				}
			}
			$new_images .= '</div>';
		}



		if ($update_category_icons) {
			$response['success'] = 'true';
			$response['message'] = "Hive Category updated Successfully";
			$response['new_images'] = $new_images;
		} else {
			$response['success'] = 'true';
			$response['message'] = "Hive Category updated Successfully";
			$response['new_images'] = $new_images;
		}
	}
echo json_encode($response);
die;
}
add_action('wp_ajax_save_hive_data', 'save_hive_data');
add_action('wp_ajax_nopriv_save_hive_data', 'save_hive_data');

function email_validation($email) {
    return (!preg_match(
"^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email))
        ? FALSE : TRUE;
}

function login_user_by_website(){
	global $wpdb;
	$login_email=$_POST['login_email'];
	$login_password=$_POST['login_password'];
	if($login_email==""){
		$response['success'] = 'false';
		$response['message'] = "Email is required";
	}else if($login_password==""){
		$response['success'] = 'false';
		$response['message'] = "Password is required";
	}else if(!email_validation($login_email)) {
		$response['success'] = 'false';
		$response['message'] = "Invalid email format.";
	}else if(!email_exists($login_email)) {
		$response['success'] = 'false';
		$response['message'] = "Please signin to our website your email is not exist in our website";
	}else{
		$user = get_user_by( 'email', $login_email);
		$login=wp_check_password($login_password, $user->user_pass, $user->ID);
		if(!$login){
		  $response['success'] = false;
		  $response['message'] = "Password not correct";
		}else{
			$user_info = array();
			$user_info['user_login'] = $user->user_login;
			$user_info['user_password'] =  $login_password;
			$user_info['remember'] = true;
			$user_login = wp_signon( $user_info, true );
			if (is_wp_error( $user_login )) { 
				$response['success'] = false;
				$response['message'] = $user_login->get_error_message();	
			}else{
				$userID = $user_login->ID;
				$user_name = $user_login->data->user_login;
				$user_email = $user_login->data->user_email;
				wp_set_current_user( $userID, $user_login );
				wp_set_auth_cookie( $userID, true );
				$response['success'] = "true";
				$response['message'] = "Logged in Successfully";	
			}
		}
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_login_user_by_website', 'login_user_by_website');
add_action('wp_ajax_nopriv_login_user_by_website', 'login_user_by_website');
function sort_by_bio(){
	$sorting_value=$_POST['sorting_value'];
	if($sorting_value=="0"){
		$order="DESC";
	}else{
		$order="ASC";
	}
	//echo $order.'order';
	$user_id = um_profile_id();
  $userInfo = new WP_Query([
    'post_type' => 'info',
    'post_status' => 'publish',
    'author' => $user_id,
	  'orderby'   => array(
		  'date' =>$order
	  )
  ]);
  if ($userInfo->have_posts()) {
    while ($userInfo->have_posts()) {
      $userInfo->the_post();
      global $post;
      $post_id = get_the_ID();
		$url=get_field('image_by_url');
      $meta = get_post_meta($post_id);
	$url = "https://iframe.ly/api/oembed?url=$url&api_key=9aab64aeb3ff8937967473";
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  //for debug only!
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);
  curl_close($curl);
  $new_value = json_decode($resp, true);
 
  ?>
      <div class="profile_single_info">
        <div class="post-thumbnail">
          <input type="text" class="meta-preview" value="<?php echo get_field('image_by_url');  ?>">
          <div class="loading"></div>
          <div class="container-resposne">
           <?php echo htmlspecialchars_decode($new_value['html']); ?>

          </div>
        </div>
        <div class="post-content">
          <div class="btn-group dropright">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            </button>
            <div class="dropdown-menu">
              <?php if ($post->post_author == $current_user->ID) { ?>
                <p><a onclick="return confirm('Are you SURE you want to delete this post?')" href="<?php echo get_delete_post_link($post->ID); ?>">Delete post</a></p>
              <?php } ?>
            </div>
          </div>
          <div class="top-wrapper">
            <h2 class="post-title"><?php echo get_the_title(); ?></h2>

            <?php
            the_content();

            ?>

          </div>
        </div>
      </div>
  <?php
    }
  }
	die;
}
add_action('wp_ajax_sort_by_bio', 'sort_by_bio');
add_action('wp_ajax_nopriv_sort_by_bio', 'sort_by_bio');
function get_delete_old_jobs1()
{
	// Set our query arguments
	$args = [
		'fields'         => 'ids', // Only get post ID's to improve performance
		'post_type'      => 'beeart',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'date_query'    => array(
			'before' => date('Y-m-d', strtotime('-28 days'))
		)
	];
	$q = get_posts($args);

	// Check if we have posts to delete, if not, return false
	if (!$q)
		return false;

	// OK, we have posts to delete, lets delete them
	foreach ($q as $id)
		wp_trash_post($id);
}

// expired_post_delete hook fires when the Cron is executed
add_action('old_job_delete', 'get_delete_old_jobs1');


// Add function to register event to wp
add_action('wp', 'register_daily_jobs_delete_event1');

function register_daily_jobs_delete_event1()
{
	// Make sure this event hasn't been scheduled
	if (!wp_next_scheduled('old_job_delete')) {
		// Schedule the event
		wp_schedule_event(time(), 'every_three_minutes', 'old_job_delete');
	}
}


add_filter('um_permalink_base_after_filter', 'my_permalink_base_after', 10, 2);
function my_permalink_base_after($value, $raw_permalink)
{
	if (!empty($value) && strrpos($value, "_") > -1 && substr($value, "_") == 1) {
		$value = str_replace('_', '-', $value);
	}
	return base64_encode($value);
}

// define the um_permalink_base_after_filter callback 
function custom_um_permalink_base_after_filter($value, $raw_value)
{
	//custom code here
	return base64_encode($value);
}

//add the action 
add_filter('um_permalink_base_after_filter', 'custom_um_permalink_base_after_filter', 10, 2);


//add the action 
add_filter('um_permalink_base_after_filter', 'custom_um_permalink_base_after_filter', 10, 2);

function redirect_user() {
  if ( ! is_user_logged_in() && ! is_page( 'login' ) && ! is_page( 'signup' ) && ! is_page('new-sign-up') ) {
    $return_url = esc_url( home_url( '/login/' ) );
    wp_redirect( $return_url );
    exit;
  }
}
add_action( 'template_redirect', 'redirect_user' );

// query for checking does you followed the user or not
function isFollowed($current_user_id, $follower_id){
    global $wpdb;
    return $wpdb->get_results("SELECT follower_cat_id FROM wp_um_set_priority_by_follower WHERE `user_id`= ". $current_user_id ." AND `follower_id`= " . $follower_id . " ");
}
function data_move_top(){
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$db_id=explode(',',$_POST['move_to_top']);
	$get_count=$wpdb->get_results("SELECT COUNT(category_value) as counted FROM wp_category_created_by_author WHERE `author_id`= $current_user_id" );
	$counted=$get_count[0]->counted;
	$decreamented=$counted;
	foreach($db_id as $k=>$updated_id){
		$wpdb->query($wpdb->prepare("UPDATE wp_category_created_by_author SET position_order=$decreamented WHERE `id`= $updated_id and author_id=$current_user_id"));
		$decreamented--;
	}
	die;
}
add_action('wp_ajax_data_move_top', 'data_move_top');
add_action('wp_ajax_nopriv_data_move_top', 'data_move_top');
function own_feed_move_top(){
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$feed_move_id=$_POST['move_to_top'];
	$user_edit_feed = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
	$total_count=count($user_edit_feed);
	$update_list = array();
	foreach($feed_move_id as $k=>$updated_id){
		foreach ($user_edit_feed as $key => $edit_listing) {
			if ($updated_id == $edit_listing['feed_id']) {
				$user_edit_feed[$key]['position_order'] = $total_count;
				$total_count--;
			}
		}
	}
	$updated_feed_data = update_user_meta($current_user_id, 'beesmart-filter-feed-options', $user_edit_feed);
	if($updated_feed_data){
		$response['success'] = "true";
		$response['message'] = "Feed Moved successfully";
	}
	echo json_encode($response);
	die;
}
add_action('wp_ajax_own_feed_move_top', 'own_feed_move_top');
add_action('wp_ajax_nopriv_own_feed_move_top', 'own_feed_move_top');

function array_sort($array, $on, $order=SORT_ASC){
	$new_array = array();
	$sortable_array = array();
	if (count($array) > 0) {
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				foreach ($v as $k2 => $v2) {
					if ($k2 == $on) {
						$sortable_array[$k] = $v2;
					}
				}
			} else {
				$sortable_array[$k] = $v;
			}
		}

		switch ($order) {
			case SORT_ASC:
				asort($sortable_array);
				break;
			case SORT_DESC:
				arsort($sortable_array);
				break;
		}

		foreach ($sortable_array as $k => $v) {
			$new_array[$k] = $array[$k];
		}
	}

	return $new_array;
}
function sort_feed_order(){
	define('imgPATH', get_stylesheet_directory_uri() . '/assets/images/');
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	//print_r($_POST);
	 $userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
	 if($_POST['sorting_order_value']=='asc'){
		 $order_format='SORT_ASC';
		 $userfeeds_1 = array_sort($userfeeds, 'feedname', SORT_ASC);
	 }else{
		  $order_format='SORT_DESC';
		  $userfeeds_1 = array_sort($userfeeds, 'feedname', SORT_DESC);
	 }
	 
	// echo '<pre>';print_r($userfeeds_1);echo '</pre>';
	 get_template_part( 'template-parts/profile-page/tabs/find-feed-order',null,$userfeeds_1);
	die;
}
add_action('wp_ajax_sort_feed_order', 'sort_feed_order');
add_action('wp_ajax_nopriv_sort_feed_order', 'sort_feed_order');

function feed_val_search(){
	define('imgPATH', get_stylesheet_directory_uri() . '/assets/images/');
	global $wpdb;
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	$feed_val_search=$_POST['feed_val_search'];
	$userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
	$resulted_value = searchForFeed($feed_val_search, $userfeeds);
	$final_value[]=$resulted_value;
	get_template_part( 'template-parts/profile-page/tabs/find-feed-order',null,$final_value);
	die;
}
add_action('wp_ajax_feed_val_search', 'feed_val_search');
add_action('wp_ajax_nopriv_feed_val_search', 'feed_val_search');
function searchForFeed($id, $userfeeds) {
					
   foreach ($userfeeds as $val) {
	   if ($val['feedname'] === $id) {
		   return $val;
	   }
   }
   return null;
}



function delete_feed_from_listing(){
	global $wpdb;
	$selected_option=$_POST['option_name'];
	$cat_name=$_POST['cat_name'];
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID;
	
	if($selected_option=="1"){
		$wpdb->query($wpdb->prepare("UPDATE wp_category_created_by_author SET visibility =0,position_order = 0 WHERE `id`= $cat_name and author_id=$current_user_id"));
	}else{
		$wpdb->query($wpdb->prepare("UPDATE wp_category_created_by_author SET visibility =1,position_order = 0 WHERE `id`= $cat_name and author_id=$current_user_id"));
	}
	die;
}
add_action('wp_ajax_delete_feed_from_listing', 'delete_feed_from_listing');
add_action('wp_ajax_nopriv_delete_feed_from_listing', 'delete_feed_from_listing');
