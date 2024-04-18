<?php /* Template Name: User Post Filter Template */ ?>
<?php get_header(); ?>
<div class="main_filter_cls">
   <?php
      $user_id = get_current_user_id();
      $currentPage = get_query_var('paged');
      $posts = new WP_Query(array(
      'post_type' => 'post', 
      'posts_per_page' => 6,
      'post_status' => 'publish', 
      'paged' => $currentPage,
      'author' => $user_id
      )); 
      ?>
   <div class="main_user_filter">
      <div class="container">
         <?php 
            if ($posts->have_posts()) :
                while ($posts->have_posts()) :
                    $posts->the_post(); ?>
         <div class='post-wrap'>
            <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a>
            <?php the_post_thumbnail('single-post-thumbnail'); ?>
            <?php the_content(); ?>
         </div>
         <?php  endwhile;
            endif;
            ?>
      </div>
   </div>
   <div class="pagenation_cls">
      <?php 
         echo "<div class='page-nav-container'>" . paginate_links(array(
             'total' => $posts->max_num_pages,
             'prev_text' => __('<'),
             'next_text' => __('>')
         )) . "</div>";
         ?>
   </div>
</div>
<?php get_footer(); ?>