<?php /* Template Name: User Dashboard Template */ ?>
<?php get_header();
$post_id = get_the_ID(); /*current post id get in wp*/

?>


<?php echo do_shortcode('[fed_dashboard]'); ?>


<?php get_footer(); ?>