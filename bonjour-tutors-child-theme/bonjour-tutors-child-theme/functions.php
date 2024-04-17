<?php
/*
 * This is the child theme for Masterstudy LMS Starter theme, generated with Generate Child Theme plugin by catchthemes.
 *
 * (Please see https://developer.wordpress.org/themes/advanced-topics/child-themes/#how-to-create-a-child-theme)
 */
add_action( 'wp_enqueue_scripts', 'bonjour_tutors_child_theme_enqueue_styles' );
function bonjour_tutors_child_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
/*
 * Your code goes below
 */
 add_filter( 'woocommerce_checkout_fields' , 'hjs_wc_checkout_fields', 30, 1);
 
// This example changes the default placeholder text for the state drop downs to "Select A State"


function hjs_wc_checkout_fields( $fields ) {
 $fields['billing']['billing_state']['label'] = 'Province';
 $fields['billing']['billing_postcode']['label']= 'Postal code';
 $fields['billing']['billing_city']['label']= 'City';
 return $fields;
}


function add_multi_kids($data){

    $user_id = get_current_user_id();
    $first_name = $_REQUEST['first_name'];
    $age = $_REQUEST['age'];
    $grade = $_REQUEST['grade'];
    $kid_img = $_REQUEST['kid_img'];
    
    global $current_user, $wpdb;
    
    $cur_name = $current_user->user_login.rand(10,1000)."-".$first_name;
    $wpdb->insert('uDO_users', array(
        'ID' => NULL,
        'user_login' => $cur_name,
        'user_pass' => '',
        'user_nicename' => $cur_name,
        'user_email' => '',
        'user_url' => '',
        'user_registered' => '',
        'user_activation_key' => '',
        'user_status' => '0',
        'display_name' => ''
    ));
    $lastid = $wpdb->insert_id;

    $wpdb->insert('uDO_usermeta', array(
            'umeta_id' => NULL,
            'user_id' => $user_id,
            'meta_key' => 'is_child_id',
            'meta_value' => $lastid
        )); 

     
    $wpdb->insert('uDO_usermeta', array(
        'umeta_id' => NULL,
        'user_id' => $lastid,
        'meta_key' => 'first_name',
        'meta_value' => $first_name
    ));

    $wpdb->insert('uDO_usermeta', array(
        'umeta_id' => NULL,
        'user_id' => $lastid,
        'meta_key' => 'age',
        'meta_value' => $age
    ));

    $wpdb->insert('uDO_usermeta', array(
        'umeta_id' => NULL,
        'user_id' => $lastid,
        'meta_key' => 'grade',
        'meta_value' => $grade
    ));

    $wpdb->insert('uDO_usermeta', array(
        'umeta_id' => NULL,
        'user_id' => $lastid,
        'meta_key' => 'kid_img',
        'meta_value' => $kid_img
    ));

    echo $lastid;  die;
}

add_action('wp_ajax_addkid', 'add_multi_kids');
add_action('wp_ajax_nopriv_addkid', 'add_multi_kids');


function del_multi_kids($data){
    $user_id = get_current_user_id();
    $kid_id = $_REQUEST['kid_id'];
 
    global $wpdb;

    $table = 'uDO_users';
    $wpdb->delete( $table, array( 'id' => $kid_id ) );

    $table = 'uDO_usermeta';
    $wpdb->delete( $table, array( 'meta_key' => 'is_child_id', 'meta_value' => $kid_id ) );

    $table = 'uDO_usermeta';
    $wpdb->delete( $table, array( 'user_id' => $kid_id ) );
    
    echo "ok";  die;
}

add_action('wp_ajax_delkid', 'del_multi_kids');
add_action('wp_ajax_nopriv_delkid', 'del_multi_kids');


function edit_multi_kids($data){
    $user_id = get_current_user_id();
    $kid_id = $_REQUEST['kid_id'];
 
    global $wpdb;
    $results = $wpdb->get_results( "SELECT * FROM uDO_usermeta WHERE user_id = ".$kid_id, OBJECT );

    $res["kid_id"] = $kid_id;
    $res["user_id"] = $user_id;
    
    foreach ($results as $key => $result) {
        if($result->meta_key == "first_name")
        {
            $res["first_name"] = $result->meta_value;
        }
        if($result->meta_key == "age")
        {
            $res["age"] = $result->meta_value;
        }
        if($result->meta_key == "grade")
        {
            $res["grade"] = $result->meta_value;
        }
        if($result->meta_key == "kid_img")
        {
            $res["kid_img"] = $result->meta_value;
        }
    }

    echo json_encode($res);
    die;
}

add_action('wp_ajax_editkid', 'edit_multi_kids');
add_action('wp_ajax_nopriv_editkid', 'edit_multi_kids');

 

function update_multi_kids($data){

    $user_id = get_current_user_id();
    $first_name = $_REQUEST['first_name'];
    $age = $_REQUEST['age'];
    $grade = $_REQUEST['grade'];
    $kid_img = $_REQUEST['kid_img'];


    $current_kid_id = $_REQUEST['current_kid_id'];

    global $wpdb;    
    $lastid = $current_kid_id;


   $wpdb->update('uDO_usermeta', array('meta_value' => $first_name), array('user_id' => $lastid,'meta_key' => 'first_name'));

   $wpdb->update('uDO_usermeta', array('meta_value' => $age), array('user_id' => $lastid,'meta_key' => 'age'));

   $wpdb->update('uDO_usermeta', array('meta_value' => $grade), array('user_id' => $lastid,'meta_key' => 'grade'));

   $wpdb->update('uDO_usermeta', array('meta_value' => $kid_img), array('user_id' => $lastid,'meta_key' => 'kid_img'));
  
  
    echo $lastid;  die;
}

add_action('wp_ajax_updatekid', 'update_multi_kids');
add_action('wp_ajax_nopriv_updatekid', 'update_multi_kids'); 



add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );
function add_loginout_link( $items, $args ) {
    if (is_user_logged_in()) {

        global $current_user, $wpdb;
        $user_id = get_current_user_id();
        $cur_name = $current_user->user_login;
		//echo '<pre>';print_r($current_user);echo '</pre>';
        $cur_role = $current_user->roles[0];
        $resulttss = $wpdb->get_results( "SELECT * FROM uDO_usermeta WHERE meta_key = 'is_child_id' and user_id = ".$user_id, OBJECT ); 
        if(!empty($resulttss))
        {          
			if($cur_role=="subscriber" || $cur_role=="customer"){
				$items .= '<li id="menu-item-8805" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8805 kid_name_dropdown"><a title="'.$cur_name.'" href="javascript:;"><i class="fa fa-user" aria-hidden="true"></i><span class="kid_user_name">'.$cur_name.'</span></a>';

				$items .= '<ul class="sub-menu">';    
				$resultts = $wpdb->get_results( "SELECT * FROM uDO_usermeta WHERE meta_key = 'is_child_id' and user_id = ".$user_id, OBJECT ); 
				foreach ($resultts as $key => $resultt) {
					$kid_id = $resultt->meta_value;
					$results = $wpdb->get_results( "SELECT * FROM uDO_usermeta WHERE user_id = ".$kid_id, OBJECT );
					foreach ($results as $key => $result) 
					{
						$kid_img = site_url().'/'.$result->meta_value;
						if($result->meta_key == "first_name")
						{
							$first_name = $result->meta_value;
						}   
						if($result->meta_key == "kid_img")
						{
							$kid_img = site_url().'/'.$result->meta_value;
							$items .= '<li id="menu-item-'.$kid_id.'" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-'.$kid_id.'"><a href="#"><img src='.$kid_img.' alt="" /><span class="kidd_name">'.$first_name.'</span></a></li>';
						}
						if($key == "3") 
						{
							//echo $kid_img.'xxxdede';
							//$author_pos = "../../user-profile/".get_the_author_meta('user_nicename', $kid_id)."?kid_id=".$kid_id;

							
						}
					}
				}
			$items.='<hr/>';
			$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item"><a href="/my-account/orders/"><i class="fa fa-dashboard"></i>Dashboard</a></li>';
			$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
<a href="/account"><i class="fa fa-cog" aria-hidden="true"></i>Profile & Settings</a></li>';
			$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
<a href="/transactions"><i class="fa fa-exchange" aria-hidden="true"></i>Transactions</a></li>';
$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
<a href="'.wp_logout_url( home_url()).'"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>';


            $items .= '</ul>';
			}
        }else{
				if($cur_role=="stm_lms_instructor"){
					$items .= '<li id="menu-item-8805" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8805 kid_name_dropdown"><a title="'.$cur_name.'" href="javascript:;"><i class="fa fa-user" aria-hidden="true"></i><span class="kid_user_name">'.$cur_name.'</span></a>';
					$items .= '<ul class="sub-menu">';  
					$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item"><a href="/schedule-dates"><i class="fa fa-dashboard"></i>Meeting info</a></li>';
					$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
		<a href="/account"><i class="fa fa-cog" aria-hidden="true"></i>Profile & Settings</a></li>';
		$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
		<a href="'.wp_logout_url( home_url()).'"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>';
		$items .= '</ul>';  
				}else if($cur_role=="subscriber" || $cur_role=="customer"){
					$items .= '<li id="menu-item-8805" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8805 kid_name_dropdown"><a title="'.$cur_name.'" href="javascript:;"><i class="fa fa-user" aria-hidden="true"></i><span class="kid_user_name">'.$cur_name.'</span></a>';

				$items .= '<ul class="sub-menu">';    
				$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item"><a href="/my-account/orders/"><i class="fa fa-dashboard"></i>Dashboard</a></li>';
				$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
<a href="/account"><i class="fa fa-cog" aria-hidden="true"></i>Profile & Settings</a></li>';
				$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
<a href="/transactions"><i class="fa fa-exchange" aria-hidden="true"></i>Transactions</a></li>';
				$items.='<li id="" class="menu-item menu-item-type-custom menu-item-object-custom menu-item">
<a href="'.wp_logout_url( home_url()).'"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>';


            $items .= '</ul>';
				}
		}

    }
    return $items;
}

function update_user_profile(){
	//update_field
	 global $current_user, $wpdb;
	  $user_id = get_current_user_id();
		$metas = array( 
		'first_name'   => $_POST['firstname'],
		'last_name' => $_POST['lastname'], 
		'visibility'  => $_POST['parentsee'],
		'description'       =>$_POST['author_bio'],
		'how_did_you_hear_about_us'     =>$_POST['hear_about'],
		'education_approach'     =>$_POST['education_approach'],
		'billing_phone'     =>$_POST['phone_numebr'],
	);

	foreach($metas as $key => $value) {
		update_user_meta( $user_id, $key, $value );
	}
	$response['success']=true;
	$response['message']= "User Profile Updated";
	echo json_encode($response);
	die;
}

add_action('wp_ajax_update_user_profile', 'update_user_profile');
add_action('wp_ajax_nopriv_update_user_profile', 'update_user_profile');




add_action('woocommerce_before_order_notes', 'wps_add_select_checkout_field');
function wps_add_select_checkout_field( $checkout ) {
	global $wpdb;
	$user_id = get_current_user_id();
	$meta_data = $wpdb->get_results("SELECT meta_value FROM `uDO_usermeta` WHERE (`meta_key` = 'is_child_id' AND `user_id` = '".$user_id."') ORDER BY meta_value DESC");
		$kid_profile['blank'] ='Select any';
		foreach ($meta_data as $key => $valval) {
          $kid_idd = $valval->meta_value;
          $kid_first_name = get_user_meta( $kid_idd, 'first_name', true );
		  $kid_profile[$kid_idd] = __( $kid_first_name, 'wps' );
		  
		}
		echo '<h2>'.__('Select you kid profile').'</h2>';

		woocommerce_form_field( 'kid_profile', array(
			'type'          => 'select',
			'required'      => true,
			'class'         => array( 'wps-drop' ),
			'label'         => __( 'Kid Profile' ),
			'options'       => $kid_profile
	 ),

		$checkout->get_value( 'kid_profile' ));
	
}
 add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;

    // Check if set, if its not set add an error.
    if ($_POST['kid_profile'] == "blank")
     wc_add_notice( '<strong>Please select kid profile options</strong>', 'error' );

 }
 
  add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
 function wps_select_checkout_field_update_order_meta( $order_id ) {

   if ($_POST['kid_profile']) update_post_meta( $order_id, 'kid_profile', esc_attr($_POST['kid_profile']));

 }
 
 add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );
function wps_select_checkout_field_display_admin_order_meta($order){

	//echo '<p><strong>'.__('Kid Name').':</strong> ' . get_post_meta( $order->id, 'kid_profile', true ) . '</p>';

}

//* Add selection field value to emails
add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys');
function wps_select_order_meta_keys( $keys ) {

	//$keys['kid_profile:'] = 'kid_profile';
	//return $keys;
	
}

function wpza_replace_repeater_field( $where ) {
     $where = str_replace( "meta_key = 'assign_tutor_$", "meta_key LIKE 'assign_tutor_%", $where );
     return $where;
}
add_filter( 'posts_where', 'wpza_replace_repeater_field' );

add_filter('woocommerce_email_downloads_columns', 'custom_email_downloads_columns', 10, 1);
function custom_email_downloads_columns( $columns ){
    $columns['download-file'] = __("Meeting link", "woocommerce");

    return $columns;
}
add_theme_support( 'woocommerce' );

/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}
add_filter( 'woocommerce_product_tabs', 'my_remove_all_product_tabs', 98 );
 
function my_remove_all_product_tabs( $tabs ) {
  unset( $tabs['reviews'] );       // Remove the reviews tab
  unset( $tabs['additional_information'] );    // Remove the additional information tab
  return $tabs;
}

add_action( 'woocommerce_customer_changed_subscription_to_cancelled', 'customer_skip_pending_cancellation' );
/**
 * Change 'pending-cancel' status directly to 'cancelled'.
 *
 * @param WC_Subscription $subscription
 */
function customer_skip_pending_cancellation( $subscription ) {
	$order_items = $subscription->get_items();
	foreach ( $order_items as $item_id => $item ) {
		$product = $item->get_product();
		$product_id = $item->get_product_id();
		$variation_id = $item->get_variation_id();
		$get_stock_qty=get_post_meta($variation_id,'_stock',true);
		update_post_meta($variation_id,'_stock',$get_stock_qty+1);
	}
	if ( 'pending-cancel' === $subscription->get_status() ) {
		$subscription->update_status( 'cancelled', 'Your subscription has been cancelled.' );
	} 
}

add_action( 'woocommerce_variation_options_pricing', 'bbloomer_add_custom_field_to_variations', 10, 3 );
 
function bbloomer_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
'id' => 'time_slot_for_product[' . $loop . ']',
'class' => 'short',
'type'        => 'time',
'label' => __( 'Time Slot', 'woocommerce' ),
'value' => get_post_meta( $variation->ID, 'time_slot_for_product', true )
   ) );
}
 
// -----------------------------------------
// 2. Save custom field on product variation save
 
add_action( 'woocommerce_save_product_variation', 'bbloomer_save_custom_field_variations', 10, 2 );
 
function bbloomer_save_custom_field_variations( $variation_id, $i ) {
   $custom_field = $_POST['time_slot_for_product'][$i];
   if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'time_slot_for_product', esc_attr( $custom_field ) );
}
 
// -----------------------------------------
// 3. Store custom field value into variation data
 
add_filter( 'woocommerce_available_variation', 'bbloomer_add_custom_field_variation_data' );
 
function bbloomer_add_custom_field_variation_data( $variations ) {
   $variations['time_slot_for_product'] = '<div class="woocommerce_custom_field">Time Slot: <span>' . get_post_meta( $variations[ 'variation_id' ], 'time_slot_for_product', true ) . '</span></div>';
   return $variations;
}
function custom_excerpt_length( $length ) {
        return 50;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more($more) {
return '...';
}
 
add_filter('excerpt_more', 'new_excerpt_more');








function wp_get_menu_array($current_menu)
{

	$array_menu = wp_get_nav_menu_items($current_menu);

	// print_r($array_menu);
	// die();
	$menu = array();
	foreach ($array_menu as $m) {
		if (empty($m->menu_item_parent)) {
			$menu[$m->ID] = array();
			$menu[$m->ID]['ID'] 		= 	$m->ID;
			$menu[$m->ID]['title'] 		= 	$m->title;
			$menu[$m->ID]['url'] 		= 	$m->url;
			$menu[$m->ID]['classes'] 		= $m->classes;
			$menu[$m->ID]['target'] 		= $m->target;
			$menu[$m->ID]['children']	= 	array();
		}
	}
	$submenu = array();
	foreach ($array_menu as $m) {
		if ($m->menu_item_parent) {
			$submenu[$m->ID] = array();
			$submenu[$m->ID]['ID'] 		= 	$m->ID;
			$submenu[$m->ID]['title']	= 	$m->title;
			$submenu[$m->ID]['url'] 	= 	$m->url;
			$submenu[$m->ID]['classes'] =   $m->classes;
			$submenu[$m->ID]['target'] 	=   $m->target;
			$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
		}
	}
	/*$subsubmenu = array();
    foreach ($array_menu as $m) {

    }*/
	return $menu;
}

function buildTree(array &$elements, $parentId = 0)
{
	$branch = array();
	foreach ($elements as &$element) {
		if ($element->menu_item_parent == $parentId) {
			$children = buildTree($elements, $element->ID);
			if ($children)
				$element->wpse_children = $children;

			$branch[$element->ID] = $element;
			unset($element);
		}
	}
	return $branch;
}
function wpse_nav_menu_2_tree($menu_id)
{
	$items = wp_get_nav_menu_items($menu_id);
	return  $items ? buildTree($items, 0) : null;
}

/* Restrict Login page to logged-in users and redirect to core user page (user profile) */
add_action( 'template_redirect', 'um_restrict_login_page_logged_in' );
function um_restrict_login_page_logged_in() {
    if ( is_page('user-public-account') && is_user_logged_in() ) {
        wp_redirect( site_url('/account') );
        exit;
    }
}
