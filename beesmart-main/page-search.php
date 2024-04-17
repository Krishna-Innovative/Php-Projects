<?php /* Template Name: search page */ 
    get_header();
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/feed-page.css">
<div class="feed-page">
  <div class="container">
      <?php echo do_shortcode( '[gmw search_form="8"]' ); ?>
      <?php echo do_shortcode( '[bf form_slug="save-search-query"]' ); ?>
      <div id="saved_queries">
        <button type="button" id="saved_queries_block">My Feeds</button>
      </div>
      <?php echo apply_shortcodes( '[bf_user_posts_list form_slug="save-search-query"]' ); ?>
      
      <?php echo do_shortcode( '[gmw search_results="8"]' ); ?>
  </div>
</div>




<?php get_footer(); ?>

<style>
/* div#cutom_frontend_sidebar {
  display: none;
} */
.header-footer-custom {
    background: #F8F8F8;
}
</style>