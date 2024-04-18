<?php
add_filter( 'woocommerce_get_breadcrumb', '__return_empty_array' );

/**
 * @snippet       Rename "Product Description" @ Single Product Page Tabs - WooCommerce
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=21711
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.5.3
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
 
add_filter( 'woocommerce_product_description_heading', 'bbloomer_rename_description_tab_heading' );
 
function bbloomer_rename_description_tab_heading() {
return 'Scholar Biography';
}

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'wp_enqueue_scripts', 'FLChildTheme::enqueue_scripts', 1000 );
function newscat()
{
	ob_start();
    $terms = get_terms("newsroom_category");
	$count = count($terms); 
	if ( $count > 0 ){ 
		foreach ( $terms as $term ) { 
		$term_link = get_term_link( $term );
		echo '<p><a href="' .esc_url( $term_link ) . '">' . $term->name . '</a></p> ';
	} 
	return ob_get_clean();																	 
  }
}
add_shortcode( 'news_category_listing', 'newscat' );


