<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!--<section class="single_product">
<h2>Hello Friends!- An Ongoing Preschool</h2>

<div class="MuiBox_row">
  <div class="MuiBox_left">
      <div class="single_product_img">
	     <div class="img">
		    <img src="https://bonjourtutors.krishnais.com/wp-content/uploads/2023/02/image04-1-470x408.jpg" />
		 </div>
		 <div class="discription">
		  <p>
Together we will solve logic puzzles and various other brain teasers. This is a continuation of the class "Logic Puzzles for Beginners". I will provide new puzzles for us to solve in each class.</p>
		 </div>
	  </div>
	  <div class="user_deail">
		   <img src="https://bonjourtutors.krishnais.com/wp-content/uploads/2023/02/image04-1-470x408.jpg" />
		   <h5>Amanda Manzke, M.S. Ed.</h5>
	  </div>
	  <a href="#variation_sec" class="Schedule_btn">See Class Schedule</a>
  </div>
  <div class="MuiBox_right">
    <div class="learners_list">
	  <div class="list-item">
	     <i class="fa fa-birthday-cake" aria-hidden="true"></i>
	    <h4>8-11</h4>
		<p>year old learners</p>
	  </div>
	  <div class="list-item">
	    <i class="fa fa-users" aria-hidden="true"></i>
	    <h4>1-4</h4>
		<p>learners per class</p>
	  </div>
	</div>
 <div class="price-box">
				  <div class="cjoppm">
					 <div class="price_cnt">
					   <h3> $50</h3>
					 </div>
					 <a href="https://bonjourtutors.krishnais.com/product/hello-friends-an-ongoing-preschool/" class="charged_link">Charged weekly</a>
				  </div>
				  <div class="meets_list">
					<ul>
					  <li><i class="fas fa-calendar-alt"></i> Meets 1x per week</li>
					  <li><i class="fa fa-refresh" aria-hidden="true"></i> Runs week after week</li>
					  <li><i class="fa fa-clock-o" aria-hidden="true"></i> 45 minutes per class</li>
					  <li><i class="fa fa-credit-card" aria-hidden="true"></i> Cancel anytime</li>
					</ul>
				  </div>
				</div>
 </div>
</div>
</section>-->

<section class="variation products" id="variation_sec">
	<h2 style="margin-bottom:0px">Available Times </h2>
	<h4><i class="fa fa-clock-o"></i> Eastern Time</h4>
<?php $product = wc_get_product(get_the_ID());
$variations = $product->get_available_variations();
//echo '<pre>';print_r($variations);echo '</pre>';
$terms = wp_get_post_terms( get_the_ID(), array( 'format' ) );
$resultage = '';
foreach ( $terms as $term ) :
$resultage .=$term->name.'-'; endforeach;
$rage = rtrim($resultage,'-');
 // echo '<pre>';print_r($rage);echo '</pre>';
?>
<div class="client owl-carousel owl-theme">
	<?php
	foreach($variations as $list_of_variations){
	    //echo '<pre>';print_r($list_of_variations);echo '</pre>';
		$time_availabilities=$list_of_variations['attributes']['attribute_time-availabilty'];
		$is_in_stock=$list_of_variations['max_qty'];
		$variation_id=$list_of_variations['variation_id'];
		$time_slot_for_product=get_post_meta( $variation_id, 'time_slot_for_product', true );
		$time_slot_available=date("d-m-Y", strtotime($time_availabilities));
		$today=strtotime(date("d-m-Y"));
		if($is_in_stock>0){
		    //echo 'Yes Hi';
		?>
		<div class="item">
			<div class="times-grid"> 
				<h3>Next on <?php echo date("l", strtotime($time_availabilities));?></h3>
				<ul>
				  <li>Meets Once per week</li>
				  <li><?php echo date("l", strtotime($time_availabilities));?></li>
				  <li><?php echo date('h:i a', strtotime($time_slot_for_product)).' - ';
				  if($rage=="1 Hour"){
					$timestamp = strtotime($time_slot_for_product) + 60*60;
					$time = date('h:i a', $timestamp);
					echo $time;
				}else{
					$timestamp = strtotime($time_slot_for_product) + 30*60;
					$time = date('h:i a', $timestamp);
					echo $time;
				}
				  
				  ?></li>
				</ul>
				
				<div class="remaining-text">Only <?php echo $is_in_stock;?> spots remaining</div>
				<a href="<?php echo site_url();?>/?add-to-cart=<?php echo $variation_id;?>&quantity=1" class="btn subscribe_btn">Subscribe</a>
			</div>
		</div>
				<?php
		}
	}
	?>
</div>
<div class="MuiBox_row schedule-class-btn"><a href="http://bonjourtutors.com/contact-us" class="Schedule_btn">Request Another Time</a></div>
</section>
<?php
if ( $related_products ) : ?>

	<section class="related products">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related courses', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>
	<?php
endif;

wp_reset_postdata();