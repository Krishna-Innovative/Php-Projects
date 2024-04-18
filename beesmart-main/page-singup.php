<?php /* Template Name: sign-up page */ 
    get_header();
//die;
?>

<div class="signup_page">
<div class="container">
<div class="signup_inner">
<?php echo do_shortcode( '[ultimatemember form_id="2757"]' ); ?>
	<?php //echo do_shortcode('[signup_referral]');?>
<div class="um-row _um_row_1 step_btns">
	<div class="um-col-1">
		<button  class="next-step__continue" id="step_two_btn">
			NEXT
		</button>
	</div>
</div>
<!-- step2 -->
<div id="categories_block">
	<div class="categories-items">
		<div id="category_business" class="category_item">
			<img src="/wp-content/uploads/2022/02/types-Business.png" alt="Personal">
			<span>Business</span>
		</div>
		<div id="category_career" class="category_item">
			<img src="/wp-content/uploads/2022/02/Type-Professional.png" alt="Personal">
			<span>Career</span>
		</div>
		<div id="category_personal" class="category_item">
			<img src="/wp-content/uploads/2022/02/Types-Personal.png" alt="Personal">
			<span>Personal</span>
		</div>
		<div id="category_hobby" class="category_item">
			<img src="/wp-content/uploads/2022/02/Type-Hobby.png" alt="Personal">
			<span>Hobby</span>
		</div>
		<div id="category_location" class="category_item">
			<img src="/wp-content/uploads/2022/02/Type-Location.png" alt="Personal">
			<span>Location</span>
		</div>
		<div id="category_community" class="category_item">
			<img src="/wp-content/uploads/2022/02/Types-Community.png" alt="Personal">
			<span>Community</span>
		</div>
	</div>
	<div id="join-block">
		<div class="join-to">
			<div class="join-to-desc">
				<div class="join-img-wrap">
					<img class="join-icon" src="https://beesm.art/wp-content/uploads/2021/11/bee-color.png">
			</div>
				<p class="desc-text">
					At the heart of our success are our people, so taking care of them is a priority for us. 
				</p>
			</div>
		</div>
		<div class="next-step">
			<button id="back_to_first_step" class="next-step__back">BACK</button>
			<button id="step_three_btn" class="next-step__continue">CONTINUE</button>
		</div>
	</div>
</div>
<!-- step3 -->
<div id="step_four_block" class="next-step">
	<button id="back_to_two_step" class="next-step__back">BACK</button>
	<button  id="step_four_btn" class="next-step__continue">CONTINUE</button>
</div>
<!-- step4 -->
<!--<div id="step_five_block" class="next-step">
	<button id="back_to_three_step" class="next-step__back">BACK</button>
	<button  id="step_five_btn" class="next-step__continue">CONTINUE</button>
</div>-->
</div>	
	</div>
</div>
</div>
</section>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/custom_registration.js"></script>
<?php 
	get_footer();
?>