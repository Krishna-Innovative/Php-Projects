<?php /*Template Name: Header design Template*/ 
   $post_id = get_the_ID();
   ?>
   <!-- repeater loop gte in wp -->
   <?php if( have_rows('services') ): ?>
   <div class="services_section">
      <?php 
         $counter=1;
         while( have_rows('services') ): the_row(); 
         $image = get_sub_field('service_image');
      ?>
      <?php if($counter == 2){?>
      <div class="service_loop_cls active">
         <?php }else{ ?>
         <div class="service_loop_cls">
            <?php } ?>
            <img src="<?php echo $image; ?>" alt="image<?php echo $counter; ?>">
            <h4><?php the_sub_field('service_text'); ?></h4>
         </div>
         <?php $counter++; endwhile; ?>
      </div>
      <?php endif; ?>
<!-- end loop -->