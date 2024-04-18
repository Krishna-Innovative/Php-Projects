<?php /* Template Name: Reviews Template */ ?>
<?php get_header();
   $post_id = get_the_ID(); /*current post id get in wp*/
   ?>
<div class="inner_main_page_section_cls" id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
   <div id="tab-outer">
      <div class="container">
         <div class="all_main_reviews">
            <ul id="tab-wrapper">
               <li><a href="#tab1">Reviews</a></li>
               <li><a href="#tab2">Activity</a></li>
               <li><a href="#tab3">Hive</a></li>
            </ul>
            <div id="tab-body">
               <div id="tab1">
                  <div class="main_rev">
                     <div class="offer_cls">
                        <img alt="image" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/Ellipse-17.png">
                        <p>Ewa  added a new offer. 2h</p>
                     </div>
                     <div class="sale_image">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/Ellipse-17.png" alt="image">
                     </div>
                  </div>
                  <div class="main_rev">
                     <div class="offer_cls">
                        <img alt="image" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/Ellipse-17.png">
                        <p>Ewa posted in Sale: “Hello. The House is for sale. The details in the message.”. 6h</p>
                     </div>
                     <div class="sale_image">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/Ellipse-17.png" alt="image">
                     </div>
                  </div>
                  <div class="main_rev">
                     <div class="offer_cls">
                        <img alt="image" src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/Ellipse-17.png">
                        <p>Andreas mentioned you in comment @max.fitel. 2h</p>
                     </div>
                     <div class="sale_image">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2021/10/Ellipse-17.png" alt="image">
                     </div>
                  </div>
               </div>
               <div id="tab2">
                  <h2>Tab 2</h2>
               </div>
               <div id="tab3">
                  <h2>Tab 3</h2>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $( document ).ready(function() {
   $('#tab-wrapper li:first').addClass('active');
   $('#tab-body > div').hide();
   $('#tab-body > div:first').show();
   $('#tab-wrapper a').click(function() {
       $('#tab-wrapper li').removeClass('active');
       $(this).parent().addClass('active');
       var activeTab = $(this).attr('href');
       $('#tab-body > div:visible').hide();
       $(activeTab).show();
       return false;
   });
   });
</script>
<?php get_footer(); ?>