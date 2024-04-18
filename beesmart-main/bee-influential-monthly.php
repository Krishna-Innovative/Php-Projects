<?php
/*Template name: bee-influential-monthly*/
get_header();
?>

<div class="inner_main_page_section_cls">
	<div class="subscription_page">
		<div class="container">
			<div class="progress custom_progress">
				<img src="<?php echo imgPATH; ?>Bee.png" class="progress_icon" />
				<div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
			</div>
			<!-- third step -->
			<div class="step well">
				<div class="step_heading">
					<h2>Membership</h2>
					<div class="step_subheading">
						<p>Step 3 of 3</p>
						<p>Review</p>
					</div>
				</div>
				<div class="section_cart cart_page">
					<!-- <h2>Your members</h2> -->
					<div class="select_membership">
						<h4 class="influ">Bee <br /> Influential</h4>
						<p class="plan_name">
							<span>$8 per months</span>
							<span>Discount: 0%</span>
							<span>(Every 1 month)</span>
						</p>
						<p>Total: <span class="total_price "><?php $price = $_GET['add-to-cart']; ?>
								<?php $_product = wc_get_product($price);
								global  $woocommerce;
								echo get_woocommerce_currency_symbol() . '' . $_product->regular_price;
								?>
							</span></p>
					</div>
					<div class="text-center">
						<a type="button" class="confirm_btn" href="<?php site_url(); ?>/payment/?add-to-cart=<?php echo $_GET['add-to-cart']; ?>&quantity=1">
							<img src="/wp-content/uploads/2022/02/Confirm-button.png">
						</a>
					</div>
					<!-- <div class="setup_payment">
					  <h2>Set up Payment</h2>
						<p>Your membership starts as soon as you set up payment.</p>
						<p>No commitments, Cancel online at any time.</p>
					</div> -->

				</div>
				<!-- <div class="next_step click-t step_btns_group">
					    <button type="button" class="back-btn">
                                <img src="/wp-content/uploads/2022/01/Back-Button.png" />
                            </button>
                            <button type="button" class="next-btn action next">
                                <img src="/wp-content/uploads/2022/02/Confirm-button.png" />
                            </button>
                        </div> -->
			</div>
		</div>
	</div>
</div>
<?php
get_footer(); ?>