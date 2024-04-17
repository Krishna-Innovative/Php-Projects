<footer class="footer">
	<div class="container">
		<div class="copyright">
			<?php
				// Translators: %s: name
				echo sprintf( esc_html__( '&copy; %s, Copyright by Bonjour Tutors', 'starter-text-domain' ), esc_html( gmdate( 'Y' ) ) ) . "\n\n";
			?>
		</div>
	</div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  jQuery('.client').owlCarousel({
    margin: 15,
    loop: false,
    nav: true,
    dots: false,
    navText: [
      "<i class='fa fa-angle-left' ></i>",
      "<i class='fa fa-angle-right'></i>"
    ],
    autoplay: false,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 2
      },
      1000: {
        items: 4
      }
    }
  })
  jQuery(document).ready(function() {
    jQuery(".speeddetails h6").html('<p>Click on the following link to test the speed of your Internet connection, and enter the results below. <i class="fa fa-external-link"></i> <a href="http://www.speedtest.net" target="_blank" rel="noopener">www.speedtest.net</a></p><p>Speed test results</p>');
  })
</script>
<style>
  div#loader_footer {
    position: fixed;
    top: 50%;
    left: 50%;
    z-index: 999999;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>
<div id='loader_footer' style='display: none;'>
  <img src='<?php echo get_stylesheet_directory_uri(); ?>/loader.gif' width='60px' height='60px'>
</div>

<style>
.single-product h1.product_title.entry-title {
    font-size: 25px;
}
.woocommerce-additional-fields h3,.woocommerce-additional-fields__field-wrapper,tr.shipping.recurring-total,.woocommerce-edit-address .u-column2.col-2.woocommerce-Address,.woocommerce-MyAccount-navigation-link--dashboard,.nsl-container.nsl-container-block,form.woocommerce-ordering,.woocommerce-variation-add-to-cart .quantity,p#wc-stripe-payment-request-button-separator,div#wc-stripe-payment-request-wrapper,a.button.wp-element-button.product_type_variable-subscription.add_to_cart_button,.woocommerce-MyAccount-navigation-link--downloads {
    display: none! important;
}
span.from,.price_cnt span.subscription-details,ul.tabs.wc-tabs,.woocommerce-variation-price,li#tab-title-additional_information,li#tab-title-reviews,div#tab-additional_information,table.variations tbody {
    display: none! important;
}
.search-bar-page .crseDtl .rightCnt {
    padding-left: 20px;
    width: 70%;
    text-align: left;
}
</style>