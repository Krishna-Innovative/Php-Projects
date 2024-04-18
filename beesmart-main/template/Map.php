<?php /*Template Name: Map Template*/ ?>
<?php get_header(); 
   $post_id = get_the_ID();
   ?>
<div class="inner_main_page_section_cls" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
   <!-------------------------------------------------- Banner html start in wp-------------------------------------------------->
   <section class="main-banner">
      <div class="main-banner-image">
         <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'alignleftfull' ) ); ?>
         <div class="main-banner-content">
            <h1><?php the_title(); ?></h1>
            <div class="breadcrumb"><?php //get_breadcrumb(); ?></div>
         </div>
      </div>
   </section>
   <!-------------------------------------------------- Map search shodrt code start-------------------------------------------------->
   <!--[search_api] shortcode all code include in  "map-locations" custom plugin  -->
   <!-- File url => map-locations/public/partials/  "map-location-public-display"  -->
   <div class="login_page">
      <?php echo do_shortcode('[search_api]'); ?>
   </div>
</div>
<?php get_footer() ;?>