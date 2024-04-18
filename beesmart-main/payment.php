<?php
/*Template name: payment*/
get_header();
?>
<div class="container">
	<?php echo do_shortcode('[woocommerce_cart]'); ?>
</div>
<!--<div class="inner_main_page_section_cls">
   <div class="subscription_page payment_page">
	<div class="container">	
	        <div class="progress custom_progress">
                <img src="<?php echo imgPATH; ?>Bee.png" class="progress_icon"/>
                <div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
            <div class=" step well">
				<div class="step_heading">
					<h2>Membership</h2>
					<div class="step_subheading">
						 <p>Step 3 of 3</p> 
						 <p>Checkout</p> 
					</div>
				</div>
				<form class="" id="" >
				<div class="section_plans member_detail_sec mb-5 p-4">
					<h4>Member details</h4>
					<div class="row mt-3">
						 <div class="col-md-6">
							 <div class="form-group">
								 <label>First name</label>
								 <input type="text" class="form-control"/>
							 </div>
						</div>
						<div class="col-md-6">
							 <div class="form-group">
								 <label>Last name</label>
								 <input type="text" class="form-control"/>
							 </div>
						</div>
					</div>
				</div>
					<div class="section_plans mb-5 p-4 member_ship_detail">
					   <div class="ship_detail_data"> 
						<div class="row"> 
							<div class="col-md-6">
							 <label>Membership</label>
								<h4>Bee Seen</h4>
							</div>
							 <div class="col-md-6">
							 <label>Details</label>
								<h4>$4/ month</h4>
							</div>
						</div><div class="row mt-2 discount_ct"> 
							<div class="col-md-6">
							 <label>Total</label>
								<h4>$24</h4>
							</div>
							 <div class="col-md-6">
							 <p>25% discount paid every 6 months</p>
								<label>First renewal: <span>September 2022</span></label>
							</div>
						</div>
						 </div>
						 <div class="agree">
						  <p>Bee Seen membership, By ticking the box below, you agree to our Terms of Use, Privacy Statement, and that you are over 18.Beesmart will automatically continue your membership and charge your selected membership fee to your payment method until you cancel at any time to avoid future charges. privacy policy.</p>

					<label>
							  <input type="checkbox" checked="checked" name="sameadr"><span>I agree  </span>       </label>    

						 </div>
					</div>
					
					<div class="section_plans p-4">
						<button class="btn w-100 btn-paypal">
							<img src="/wp-content/uploads/2022/02/paypal-logo-png-3.png" />
						</button>
						<button class="btn w-100 btn-card">
							<img src="/wp-content/uploads/2022/02/card-2.png"/> <span>Debit or Credit Card</span>
						</button>
					</div>
					
			   </form>
		</div>
	   </div>
	</div>
</div>-->
<?php
get_footer(); ?>