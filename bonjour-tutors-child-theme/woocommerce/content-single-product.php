<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<section id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single_product', $product ); ?>>
<h2><?php the_title();?></h2>

<div class="MuiBox_row">
  <div class="MuiBox_left">
	  <div class="single_product_img">
		 <div class="img">
		 <?php if (has_post_thumbnail()): ?>
		  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' ); ?>
			<img src="<?php echo $image[0]; ?>'" />
		  <?php endif; ?>
			
		 </div>
		 <div class="discription">
		  <p><?php the_excerpt() ?></p>
		 </div>
	  </div>
	  <!--<div class="user_deail">
	 
	  </div>-->
	  <a href="#variation_sec" class="Schedule_btn">See Class Schedule</a>
  </div>
  <div class="MuiBox_right">
	<div class="learners_list">
	  <div class="list-item">
		 <i class="fa fa-birthday-cake" aria-hidden="true"></i>
		<p> <?php $terms = wp_get_post_terms( get_the_ID(), array( 'grade' ) );
						$resultage = '';
						foreach ( $terms as $term ) :
						$resultage .=$term->name.'-'; endforeach;
						$rage = rtrim($resultage,'-');
						echo '&nbsp&nbsp'.$rage;?></p>
		<!--<p>year old learners</p>-->
	  </div>
	  <div class="list-item">
		<i class="fa fa-users" aria-hidden="true"></i>
		<h4> 2-6 <?php //echo $value = get_field( "learner_info", get_the_ID());?></h4>
		<p>learners per class</p>
	  </div>
	</div>
	<div class="price-box">
	  <div class="cjoppm">
		 <div class="price_cnt">
		   <h3>
				<?php $product = wc_get_product(get_the_ID())?>
				<?php echo $product->get_price_html(); ?></h3>
		 </div>
		 <a href="<?php the_permalink()?>" class="charged_link">Charged weekly</a>
	  </div>
	  <div class="meets_list">
		<ul>
		  <li><i class="fas fa-calendar-alt"></i> Meets 1x per week</li>
		  <li><i class="fa fa-refresh" aria-hidden="true"></i> Runs week after week</li>
		  <li><i class="fa fa-clock-o" aria-hidden="true"></i> <?php $terms = wp_get_post_terms( get_the_ID(), array( 'format' ) );
						$resultage = '';
						foreach ( $terms as $term ) :
						$resultage .=$term->name.'-'; endforeach;
						$rage = rtrim($resultage,'-');
						echo $rage;?> per class</li>
		  <li><i class="fa fa-credit-card" aria-hidden="true"></i> Cancel anytime</li>
		</ul>
	  </div>
	</div>
 </div>
</div>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	//do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		//do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</section>

<?php //do_action( 'woocommerce_after_single_product' ); ?>
