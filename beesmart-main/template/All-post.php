<?php /*Template Name: All Post Template*/ ?>
<?php get_header(); 
   $post_id = get_the_ID();
   ?>

<div class="inner_main_page_section_cls" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
   <div class="search_option">
      <div class="container">
         <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
      </div>
   </div>
   <div class="inner_mainsection">
      <div class="container">
         <div class="again_inner_section">
            <?php include('header-design.php' ); ?>
            <!-- header icon include in wp  -->
            <div class="search_by_tag_option">
               <!--     <div class="search_h1">
                  <div class="search_h1-left">
                     <span>#</span> 
                     <h4>Search by tags</h4>
                  </div>
                  <div class="search_h1-right">
                     <h2>Sort by date</h2>
                  </div>
                  </div> -->
               <!--  <p><?php //echo $most_recent_content = get_field('most_recent_content'); ?></p> -->
            </div>
            <!-- listing get in wp with code in wp  -->
            <div class="latest_post_section">
               <?php
                  $currentPage = get_query_var('paged');
                  $posts = new WP_Query(array(
                      'post_type' => 'post', // Default or custom post type
                      'posts_per_page' => 4, // Max number of posts per page
                      'paged' => $currentPage
                  )); ?>
               <div class="latest-post-main">
                  <?php 
                     if ($posts->have_posts()) :
                     while ($posts->have_posts()) :
                     $posts->the_post();
                     $PostID = $post->ID;
                     
                     $authorID = get_the_author_ID(); /*author Id get in wp*/
                     
                     /*value get in meta fileds in wp*/
                     $meta = get_post_meta($PostID);
                     $PostPrice =  $meta['Price'][0];
                     
                     /*With PostID get the post data in wp*/
                     $UserPostMeta  = $wpdb->prefix . 'userpostdata';
                     $SelectPostMeta = $wpdb->get_row("SELECT * FROM $UserPostMeta WHERE post_id = $PostID");
                     $UserCurrentLocation = $SelectPostMeta->address;
                     /*End*/
                     ?>
                  <div class="loop_cls_img">
                     <div class="author_image">
                        <img alt="user image" src="<?php echo esc_url(get_avatar_url($authorID)); ?>" />
                        <h4><?php echo get_author_name(); ?></h4>
                     </div>
                     <div class="all_post_feturd_image_cls">
                        <?php the_post_thumbnail(); ?>
                     </div>
                     <div class="right_cls">
                        <div class="post-title">
                           <a href="<?php echo get_permalink(); ?>">
                           <?php the_title(); ?>
                           </a> <img src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/bookmark-1-1.png">
                           <!-- static -->
                        </div>
                        <!-- meta value gte in wp  -->
                        <?php if($PostPrice){ ?>
                        <div class="price">
                           <p>
                              <?php  echo $PostPrice; ?>
                           </p>
                        </div>
                        <?php } ?>
                        <!-- end -->
                        <div class="author_name">
                           <h3><?php echo get_author_name(); ?></h3>
                           <!-- get the loaction in database table name "wp_userpostdata" -->
                           <?php if($UserCurrentLocation){  ?> <span><?php echo $UserCurrentLocation; ?> </span>
                           <?php } ?>
                           <!-- end -->
                        </div>
                        <?php 
                           $authorid = get_the_author_meta('ID'); 
                           $usermeta = $wpdb->prefix . 'userpostdata'; /*table name show*/
                           $StripSelectDatat = $wpdb->get_results( "SELECT * FROM $usermeta WHERE  userid = '$authorid' ");
                           ?>
                        <div class="entrys-content">
                           <?php echo $excerpt = wp_trim_words( get_the_content(), 40, '<a class="more_btn" href="'.get_the_permalink().'"> More </a>'); ?> 
                        </div>
                        <div class="tag_wp">
                           <!-- tag in wp -->
                           <?php 
                              $id = get_the_ID(); 
                              $tags = wp_get_post_tags($id); //this is the adjustment, all the rest is bhlarsen
                              $html = '<div class="post_tags">';
                              
                              foreach ( $tags as $tag ) {
                              $tag_link = get_tag_link( $tag->term_id );
                              
                              $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                              $html .= "# {$tag->name}</a> ";
                              }
                              $html .= '</div>';
                              echo $html;
                              ?>
                           <div class="icon-date">
                              <?php echo get_the_date( get_option('date_format') ); ?>
                           </div>
                        </div>
                        <!-- end tag in wp -->
                     </div>
                  </div>
                  <?php  endwhile; endif;?>
               </div>
               <?php
                  echo "<div class='page-nav-container'>" . paginate_links(array(
                  'total' => $posts->max_num_pages,
                  'prev_text' => __('<'),
                  'next_text' => __('>')
                  )) . "</div>";
                  ?>
               <!-- end listing  -->
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php get_footer() ;?>