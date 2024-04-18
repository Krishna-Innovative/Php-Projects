<?php
/*Template name:checkout*/
get_header();
?>
<div class="container">
<?php
echo do_shortcode('[woocommerce_checkout]');
?>
</div>
<?php
get_footer();
?>