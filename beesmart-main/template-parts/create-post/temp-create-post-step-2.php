<?php acf_form_head(); ?>
<?php
$post_id = get_current_user_id();
$UserPostMeta  = $wpdb->prefix . 'users';
$SelectPostMeta = $wpdb->get_row("SELECT * FROM $UserPostMeta WHERE ID = '$post_id' ");
$all_meta_for_users = get_user_meta($post_id);
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
?>



<section class="post-form-fields post-form-fields2">
  <!--     <div class="step-desctiption-block">
      
      <div class="step-desctiption-item">
        <div class="info">
          <h6>STEP 1</h6>
          <p>Paste a share link of your content from your social media account or a website</p>
        </div>
        <div class="info">
          <h6>LINK PREVIEW:</h6>
          <p>This is how your link will appear to others. If you can't see your link, 
            <a href="#">here is a guide.</a>
          </p>
        </div>
      </div>
      <div class="step-desctiption-item">
        <div class="info">
          <h6>STEP 3</h6>
          <p>Write a title or header. <br>(100 characters max)</p>
        </div>
        <div class="info">
          <h6>STEP 4</h6>
          <p>Write a description or comment. <br>(300 characters max)</p>
        </div>
      </div>
    </div> -->
  <main class="step-2-section w-100">
    <!--       <header class="user-data">
        <div class="profile-item left">
          <?php do_action('current_user_url_avatar') ?>
            <h4><?php do_action('current_user_full_name'); ?></h4>
          </div>
        <div class="profile-item right">
          <?php
          do_action('is_current_user_verified');
          do_action('current_user_type_icon');
          ?>
        </div>
      </header> -->
    <div class="wrapper2">
      <div class="step-2-form">
        <div class="container ">
          <form id="step-2" action="#">
            <div class="form-group">
              <input type="hidden" id="f_type_of_post_by_user_type" value="<?php do_action('current_user_type'); ?>">
              <input type="hidden" id="f_custom_post_format">
              <input type="hidden" id="f_premium_custom_post_format">
              <input type="hidden" id="f_user_id" value="<?php echo $current_user_id; ?>">
            </div>
            <div class="form-group">
              <div class="posturl_group custom_frominput">
                <img width="70" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/05/Shared-tab.png">
                <input name="f_url" type="text" class="form-control" placeholder="Url Link (embed)" id="f_url">
              </div>
              <div class="container-resposne">
                <img width="70" src="<?php echo esc_url(imgPATH); ?>Bee.png" class="defult_image">
              </div>
            </div>
            <div class="form-group custom_frominput">
              <textarea rows="1" name="title" type="text" class="form-control" placeholder="Title" id="posttitle"></textarea>
            </div>
            <div class="form-group custom_frominput">
              <textarea rows="5" cols="45" name="fulltext" type="text" class="form-control" placeholder="Description" id="description"></textarea>
            </div>
            <!-- <button type="button" class="btn btn-primary" id="post_creation">Submit</button> -->
          </form>
          <!--           <div class="time-block">
            <span class="red-time">
              <div id="timer_<?php echo $post->ID; ?>" class="timer_block">
                <span id="days_<?php echo $post->ID; ?>">28D:</span>
                <span id="hours_<?php echo $post->ID; ?>">23H:</span>
                <span id="minutes_<?php echo $post->ID; ?>">58M</span>
              </div>
            </span>
          </div> -->
        </div>
      </div>
    </div>
    <div class="steps-navigation">
      <button class="step-btn previes-step__button" data-id="step-2-prev"><img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Back-Button.png" alt="previes step" data-type="shadow"></button>
      <button class="step-btn next_to_3_step next-step__button hover_hue" data-id="step-2-next" data-type="shadow"><img width="70" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Check1.png" alt="next step" data-type="shadow"></button>
    </div>
  </main>

</section>