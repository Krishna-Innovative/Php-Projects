<?php /*Template Name: Members Template*/ ?>
<?php get_header(); 
   $post_id = get_the_ID();
   ?>
<!-------------------------------------------------- Banner html start in wp-------------------------------------------------->
<div class="inner_main_page_section_cls" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
   <section class="main-banner">
      <div class="main-banner-image">
         <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'alignleftfull' ) ); ?>
         <div class="main-banner-content">
            <h1><?php the_title(); ?></h1>
            <div class="breadcrumb"><?php// get_breadcrumb(); ?></div>
         </div>
      </div>
   </section>
   <!-------------------------------------------------- End banner html section in wp---------------------------------------------->
   <!-------------------------------------------------- Member shortcode start in wp----------------------------------------------->
   <div class="reg_form_cls">
      <div class="container">
         <?php echo do_shortcode('[ultimatemember form_id="74"]'); ?>
      </div>
   </div>
   <!----------------------------------------------------- End-------------------------------------------------------------------->
</div>
<?php get_footer() ;?>