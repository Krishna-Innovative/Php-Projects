<?php
/* Template Name: Product Page Template 
Template Post Type: product */
get_header();
?>
<div id="primary" class="content-area"><main id="main" class="site-main" role="main">
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
		<h4> 2-6<?php //echo $value = get_field( "learner_info", get_the_ID());?></h4>
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
<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="">
<?php
the_content();
?>
</div>
</section>
</div>
<?php
get_footer();
?>