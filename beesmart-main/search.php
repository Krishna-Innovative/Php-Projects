<?php
/*Template name:search*/
get_header();
global $wpdb; 
$query=$_GET['query'];
$cssArgs = 'col-lg-4 col-md-6';
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/feed-page.css">
<div class="feed-page">
	<div class="container">
		<div class="gmw-results-wrapper grid-gray gmw-pt-grid-gray-results-wrapper pt" data-id="7" data-prefix="pt">
			<div class="gmw-results">		
				<ul class="posts-list-wrapper row justify-content-center">
					<?php
					$args = array(
						'post_type'=> 'beeart',
						's' => $query, 
						'orderby'    => 'ID',
						'post_status' => 'publish,draft,trash',
						'posts_per_page' => -1,
					);
					$result = new WP_Query( $args );
					if ( $result->have_posts() ) :
					 while ( $result->have_posts() ) : $result->the_post();
					 //print_r($result)
					 get_template_part('template-parts/components/post-cart', '', $cssArgs) 
					 ?>
					 <?php endwhile; ?>
							<div class="mt-5 pagination_row col-12">
							<?php else :  ?>
								<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
							<?php endif; ?>
						
						 <div class="mb-5 content_detail__pagination">
							<?php
							$big = 999999999; // need an unlikely integer
							$translated = __('Page', 'mytextdomain'); // Supply translatable string
							echo paginate_links(array(
								'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
								'format' => '?paged=%#%',
								'prev_text' => __('PREV'),
								'next_text' => __('NEXT'),
								'current' => max(1, $paged),
								'total' => $the_query->max_num_pages,
								'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>'
							));
							wp_reset_postdata();
							?>
						</div>

						</div>
				</ul>
			</div>
		</div>
	</div>
</div>
 <script>
 	let hive = Vue.createApp({
 		data: () => ({
 			isOpen: false,
			hi: 'test wqdqw wqd wqd '
 		}),
 		methods: {
 			toggle(e) {
 				// this.isOpen = !this.isOpen;
				console.log(e.target.closest('button[data-feed-id]'))
				let btn = e.target.closest('button[data-feed-id]')
				let dropDown = btn.nextSibling;
				if (dropDown.classList.contains('hidden')) {
					let prevActive = document.querySelector('.hivvdropdown.visible')
						prevActive?.classList.remove('visible');
						prevActive?.classList.add('hidden');
						
					dropDown.classList.remove('hidden');
					dropDown.classList.add('visible');
				} else {
					dropDown.classList.add('hidden');
					dropDown.classList.remove('visible');

				}
				console.log(btn.nextSibling)
 				// alert('toggle');
 			}
 		},
 	})
 	hive.mount('.inner_main_page_section_cls');
 </script>
<script>
	var langArray = [];
	$('.vodiapicker option').each(function() {
		var img = $(this).attr("data-thumbnail");
		var text = this.innerText;
		var value = $(this).val();
		var item = '<li><img src="' + img + '" alt="" value="' + value + '"/><span>' + text + '</span></li>';
		langArray.push(item);
	})

	$('.a').html(langArray);

	//Set the button value to the first el of the array
	$('.btn-select').html(langArray[0]);
	$('.btn-select').attr('value', 'en');

	//change button stuff on click
	$('.a li').click(function() {
		var img = $(this).find('img').attr("src");
		var value = $(this).find('img').attr('value');
		var text = this.innerText;
		var item = '<li><img src="' + img + '" alt="" /><span>' + text + '</span></li>';
		$('.btn-select').html(item);
		$('.btn-select').attr('value', value);
		$(".b").toggle();
		//console.log(value);
	});

	$(".btn-select").click(function() {
		$(".b").toggle();
	});

	//check local storage for the lang
	var sessionLang = localStorage.getItem('lang');
	if (sessionLang) {
		//find an item with value of sessionLang
		var langIndex = langArray.indexOf(sessionLang);
		$('.btn-select').html(langArray[langIndex]);
		$('.btn-select').attr('value', sessionLang);
	} else {
		var langIndex = langArray.indexOf('ch');
		console.log(langIndex);
		$('.btn-select').html(langArray[langIndex]);
		//$('.btn-select').attr('value', 'en');
	}
</script>
<?php get_footer(); ?>