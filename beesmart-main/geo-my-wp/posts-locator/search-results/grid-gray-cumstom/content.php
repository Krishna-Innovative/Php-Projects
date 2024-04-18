<?php
/**
 * Posts locator "grid-gray" search results template file.
 *
 * This file outputs the search results.
 *
 * You can modify this file to apply custom changes. However, it is not recomended
 * to make the changes directly in this file,
 * because your changes will be overwritten with the next update of the plugin.
 *
 * Instead you can copy-paste this template ( the "gray" folder contains this file
 * and the "css" folder ) into the theme's or child theme's folder of your site,
 * and apply your changes from there.
 *
 * The custom template folder will need to be placed under:
 * your-theme's-or-child-theme's-folder/geo-my-wp/posts-locator/search-results/
 *
 * Once the template folder is in the theme's folder, you will be able to select
 * it in the form editor. It will show in the "Search results" dropdown menu labed with "Custom: ".
 *
 * @param $gmw  ( array ) the form being used
 *
 * @param $gmw_form ( object ) the form object
 *
 * @param $post ( object ) post object in the loop
 *
 * @package geo-my-wp
 */
$post_id = get_current_user_id();

$all_meta_for_users = get_user_meta( $post_id );
$country = $all_meta_for_users['country'][0];

?>
<!--  Main results wrapper - wraps the paginations, map and results -->
<div class="gmw-results-wrapper grid-gray gmw-pt-grid-gray-results-wrapper <?php echo esc_attr( $gmw['prefix'] ); ?>" data-id="<?php echo absint( $gmw['ID'] ); ?>" data-prefix="<?php echo esc_attr( $gmw['prefix'] ); ?>" id="postdynamic">


	<?php if ( $gmw_form->has_locations() ) : ?>
		<div class="gmw-results">
			

			<?php do_action( 'gmw_search_results_start', $gmw ); ?>

			<!-- sort by -->
			<!-- <div class="gmw-results-message">
				<?php// do_action( 'gmw_search_results_after_results_message', $gmw ); ?>
			</div> -->

			<span><?php gmw_results_message( $gmw ); ?></span>

			<?php do_action( 'gmw_search_results_before_top_pagination', $gmw ); ?>

			<!-- <div class="pagination-per-page-wrapper top">
				<?php // gmw_per_page( $gmw ); ?>
				<?php // gmw_pagination( $gmw ); ?>
			</div>  -->

			<?php gmw_results_map( $gmw ); ?>

			<?php do_action( 'gmw_search_results_before_loop', $gmw ); ?>

			<ul class="posts-list-wrapper">

				<?php
				while ( $gmw_query->have_posts() ) :
					$gmw_query->the_post();
					?>

					<?php global $post; ?>

					<li id="single-post-<?php echo absint( $post->ID ); ?>" class="<?php echo esc_attr( $post->location_class ); ?>">
						<div class="wrapper-inner">
							<?php do_action( 'gmw_search_results_loop_item_start', $gmw, $post ); ?>
							
							<div class="post-content"> 

								<?php do_action( 'gmw_posts_loop_before_image', $gmw, $post ); ?>
								
								<?php oc_popup_post_button(); ?>

								<div class="author-wrapper">
									<div class="author-block">
										<div class="author-img">
										<?php echo get_avatar( get_the_author_email(), '60' ); ?>
										</div>
										<h3 class="author-name">
											<?php the_author() ?>
										</h3>
									</div>
									<div class="type-of-post">

										<?php the_field('the_use_type'); ?>
									</div>
								</div>

								<?php gmw_search_results_featured_image( $post, $gmw ); ?>
								<?php// echo get_field('Url'); ?>
								<input type="text" class="meta-preview" value="<?php echo get_field('Url'); ?>"> 
								<div class="loading"></div>
								<div class="container-resposne"></div>
								<?php do_action( 'gmw_posts_loop_before_excerpt', $gmw, $post ); ?>


								<?php do_action( 'gmw_search_results_before_hours_of_operation', $post, $gmw ); ?>

								<?php gmw_search_results_hours_of_operation( $post, $gmw ); ?>

								<?php gmw_search_results_taxonomies( $post, $gmw ); ?>

								<?php do_action( 'gmw_posts_loop_before_get_directions', $gmw, $post ); ?>
								<div class="top-wrapper">	
									<div class="title-wrapper">
										<h2 class="post-title">
											<a href="<?php gmw_search_results_permalink( get_permalink(), $post, $gmw ); ?>">
												<?php gmw_search_results_title( get_the_title(), $post, $gmw ); ?> 
											</a>
											<?php // oc_popup_post_button(); ?>
										</h2>
									</div>
									<span class="address">
										<?php gmw_search_results_linked_address( $post, $gmw ); ?>
										<?php gmw_search_results_distance( $post, $gmw ); ?>
										<div class="cont-flg"><?php echo $country ?><span><img src="https://beesm.art/wp-content/uploads/2021/11/Flag_of_Ukraine_pantone_colors-1.png"></span>
										</div>
									</span>
									<div class="sr-item-description">
										<?php gmw_search_results_taxonomies( $post, $gmw ); ?>
										<?php// the_excerpt(); ?>
										<?php gmw_search_results_post_excerpt( $post, $gmw ); ?>
									</div>
								</div>
								<div class="get-directions-link">
									<?php gmw_search_results_directions_link( $post, $gmw ); ?>
								</div>
							</div>

							<?php do_action( 'gmw_posts_loop_before_bottom_wrapper', $gmw, $post ); ?>

							<!-- <div class="bottom-wrapper">
								<div class="address-wrapper">
									<span class="address"><?php  gmw_search_results_linked_address( $post, $gmw ); ?></span>
								</div>
							</div> -->

							<?php do_action( 'gmw_search_results_loop_item_end', $gmw, $post ); ?>
							<div class="card-wrapper">
								<div class="honey-block">
									<?php echo do_shortcode('[love_me]'); ?>
								</div>
								<div class="time-block">
									<span class="red-time">
										<div id="timer_<?php echo $post->ID; ?>" class="timer_block">
										  <span id="days_<?php echo $post->ID; ?>"></span>
										  <span id="hours_<?php echo $post->ID; ?>"></span>
										  <span id="minutes_<?php echo $post->ID; ?>"></span>
										</div>
										<span>
											<?php $add_date =  get_the_date('F j, Y G:i:s',  $post->ID ); ?>
										</span>
										
										 <script type="text/javascript">
											$(document).ready(function(){  

											function makeTimer() {

											var endTime = new Date("<?php echo $add_date; ?>");
														endTime.setDate(endTime.getDate() + 28);
											var endTime = (Date.parse(endTime)) / 1000;
											// console.log(endTime);
											var now = new Date();
											var now = (Date.parse(now) / 1000);

											var timeLeft = endTime - now;

											var days = Math.floor(timeLeft / 86400); 
											var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
											var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
											var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

											if (hours < "10") { hours = "0" + hours; }
											if (minutes < "10") { minutes = "0" + minutes; }
											if (seconds < "10") { seconds = "0" + seconds; }    

											$("#days_<?php echo $post->ID; ?>").html(days + "<span>d:</span>");
											$("#hours_<?php echo $post->ID; ?>").html(hours + "<span>h:</span>");
											$("#minutes_<?php echo $post->ID; ?>").html(minutes + "<span>m</span>");

											}  

											setInterval(function() { makeTimer(); }, 1000);

											});  

										   </script>
										<?php 
										 echo "<div id='timer'>
													  <span id='days'></span>
													  <span id='hours'></span>
													  <span id='minutes'></span>
												</div>";
										?>
										<?php //echo do_shortcode('[post_cowndowns]'); ?>
										<!-- <?php  _e( 'in', 'ultimate-member' ); ?>: <?php the_category( ', ', '', $post->ID ); ?> -->
									</span>
								</div>
								<div class="bees-block">
									<?php echo get_comments_number(); ?>
									<img src="https://beesm.art/wp-content/uploads/2021/12/Bee.svg" alt="comments">
								</div>
						</div>
							</div>
					</li><!-- #post -->

				<?php endwhile; ?>
			</ul>

			<?php do_action( 'gmw_search_results_after_loop', $gmw ); ?>

			<div class="pagination-per-page-wrapper bottom">
				<?php gmw_per_page( $gmw ); ?>
				<?php gmw_pagination( $gmw ); ?>
			</div> 

			<?php do_action( 'gmw_search_results_end', $gmw ); ?>

		</div>

	<?php else : ?>

		<div class="gmw-no-results">
			<?php do_action( 'gmw_no_results_start', $gmw ); ?>

			<?php gmw_no_results_message( $gmw ); ?>

			<?php do_action( 'gmw_no_results_end', $gmw ); ?> 
		</div>

	<?php endif; ?>

</div>
<script type="text/javascript">
   $( document ).ready(function() {

	var sendRequestEachValue = function (values, containers) {
		var newMetas = values,
				meta = newMetas[0]
		newMetas.splice(0,1)

		var newContainers = containers,
				container = newContainers[0]
		newContainers.splice(0,1)	
		$.ajax({
			type:'post',
			url:'<?php echo get_stylesheet_directory_uri().'/get-data.php'?>',
			data:{
				link:meta
			},
			cache: false,
			success:function(response) {
				$('#loading').text('');
				$(container).show();
				$(container).html(response);
				console.log('handle', response)
			}
		});
	}
	var metas = document.querySelectorAll('.meta-preview');
	var containerResposnes = document.querySelectorAll('.container-resposne');


	var metasArray= [] 
	var containerResponsesArray = []

	containerResposnes.forEach(container =>{
		containerResponsesArray.push(container)
	})

	metas.forEach(meta =>{
		metasArray.push(meta.value)
	})

	console.log(metasArray)
	console.log(containerResponsesArray)

	metas.forEach(m =>{
		console.log('handle')
		sendRequestEachValue(metasArray,containerResponsesArray)
	})



});
        </script> 
<?php
	get_footer();
?>