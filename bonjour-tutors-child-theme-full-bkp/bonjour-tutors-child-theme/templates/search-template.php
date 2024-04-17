<?php
/* Template Name: search-temp */
get_header();
?>
<style>
form.searchandfilter input[type="submit"] {
    background: #e01239! important;
    border: transparent! important;
}
section.crseDtlSec.pb-50 .container {
    text-align: center;
}
</style>
<div class="fontWrp search-bar-page">
	<section class="searchBnr">
		<div class="container">
			<h2 style="text-align:center;">Find classes </h2>

			<!--<div class="searchbr">
				<form role="search" method="get"  action="<?php //echo esc_url( home_url( '/' ) ); ?>">
	            	<div class="frmRw">
	                	<input  type="text" placeholder="<?php //esc_html_e( 'Search Courses...', 'text-domain' ); ?>" value="<?php //echo esc_html( get_search_query() ); ?>" name="s" />
      <input type="hidden" name="post_type" value="product" />
	                    <div class="sbmt">
	                        <input type="submit" name="" value="send" id="search-courses">	
	                    </div>	
	                </div>							
				</form>
			</div>-->
		</div>
	</section>
		<section class="crseDtlSec pb-50">
			<div class="container">
			<?php echo do_shortcode('[searchandfilter fields="subject,grade,format"]');?>
		</div>
		</section>
	<section class="crseDtlSec pb-50">
		<div class="container">
		    <?php  
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => -1,
    );

    $loop = new WP_Query( $args );

   while ( $loop->have_posts() ) : $loop->the_post();
   global $product;
	$category_detail=get_the_category();//$post->ID
	$products = wc_get_products( $args );
	
	 ?>
	
			<div class="crseDtl_grid">
				 
				<a href="<?php echo get_permalink();?>" class="left_Img">
					<?php echo woocommerce_get_product_thumbnail(get_the_ID());?>

				</a>
				<div class="centerCnt ">
				
					<h4><a href="<?php echo get_permalink();?>"><?php the_title();?></a></h4>
					<p><?php the_excerpt();?></p>
					
				</div>
				<div class="right_content">
				  <div class="cjoppm">
					 <div class="price_cnt">
					   <h3> <?php 
					   $_product = wc_get_product(get_the_ID());

                           $variations = $_product->get_available_variations();
                          // echo '<pre>';print_r($variations);echo '</pre>';
							echo get_woocommerce_currency_symbol().''.$variations[0]['display_price'];?></h3>
					   <span>per class</span>
					 </div>
					 <a href="<?php echo get_permalink();?>" class="charged_link">Charged weekly</a>
				  </div>
				  <div class="meets_list">
					<ul>
					  <li><i class="fas fa-calendar-alt"></i> Meets 1x per week</li>
					  <li><i class="fa fa-refresh" aria-hidden="true"></i> Runs week after week</li>
					</ul>
				  </div>
				</div>
				
			</div>
		<?php  
					
	endwhile;

    wp_reset_query();
?>
		</div>
	</section>

	<div class="footerTp">
	    <div class="container">
	      <div class="InrWrp">
	        <div class="fLgo">
	          <a href="/"><img src="/wp-content/uploads/2023/01/logo_small.png" alt=""></a>
	        </div>
	        <div class="cstmFmenu">
	          <ul class="dFlx">
	            <li><a href="/">Home</a></li>
	            <li><a href="">About Us </a></li>
	            <li><a href="">Programs </a></li>
	            <li><a href="">Why Choose us </a></li>
	            <li><a href="">FAQ </a></li>
	            <li><a href="">Contact Us</a></li>
	          </ul>
	        </div>
	        <h3 class="text-center">Have questions? Call us now: +1 (647) 956-1104 </h3>
	        <div class="socialWrp">
	          <ul class="dFlx">
	            <li><a href=""><i class="fab fa-facebook"></i> </a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	</div> 

</div>

<?php
get_footer();
?>
<script>
	jQuery(document).ready(function(){
		//alert('xx');
		jQuery.ajax({
			type : "get",
			url : "/update-grade.php",
			beforeSend: function(){
				jQuery("#loader_footer").show();
			},
			success: function(response) {
				response = jQuery.parseJSON(response);
				var appendto='';
				 if(response.success==true){
					 appendto+='<option class="level-0" selected="selected"> All Grades</option>';
					  jQuery.each(response.grade,function(key, value){
							var name=value.name;
							var tax_id=value.id;
							 appendto+='<option class="level-0" value="'+tax_id+'">'+name+'</option>';
					  })
					  jQuery("#ofgrade").html(appendto);
				 }
			 },
			complete:function(data){
				jQuery("#loader_footer").hide();
			}
		})
	})
</script>