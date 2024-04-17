<?php /*Template Name: Payment Template*/ ?>
<?php get_header(); 
   $post_id = get_the_ID();
   ?>
   <div class="inner_main_page_section_cls" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
      <section class="main-banner">
         <div class="main-banner-image">
            <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'alignleftfull' ) ); ?>
            <div class="main-banner-content">
               <h1><?php the_title(); ?></h1>
               <div class="breadcrumb"><?php //get_breadcrumb(); ?></div>
            </div>
         </div>
      </section>
      <?php if ( is_user_logged_in() ) { ?> <!-- user login check conditions -->
      <div class="login_page">
         <div class="container">
            <?php echo do_shortcode('[asp_product id="2136"]'); ?>
         </div>
      </div>
      <?php } else {  ?> <!-- user login check in wp -->
      <?php $url = site_url('/login'); wp_redirect( $url );  exit; ?>
      <script> $(document).ready(function() { window.location="<?php echo $url; ?>"; }); </script>
      <?php } ?> <!-- end login check conditions -->
   </div>
<?php get_footer() ;?>