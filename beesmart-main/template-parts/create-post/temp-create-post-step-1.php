<section class="create-post_type">
<div class="container">
  <div class="post-types-block">
    <span class="create-post_type__title">Free</span>
    <div class="post-types"  data-name="basic-formats">
      <div class="post-item" data-post-id="post-type-text">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/write1.png" alt="text">
        <span>Text</span>
      </div>
      <div class="post-item" data-post-id="post-type-image">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Image1.png" alt="text">
        <span>Image</span>
      </div>
      <div class="post-item" data-post-id="post-type-video">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/VideoA.png" alt="text">
        <span>Video</span>
      </div>
      <div class="post-item" data-post-id="post-type-audio">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Audio1.png" alt="text">
        <span>Audio</span>
      </div>
      <div class="post-item" data-post-id="post-type-streaming">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Gaming.png" alt="text">
        <span>Streaming</span>
      </div>
	  <div class="post_items_peacekeeper" data-post-id="peacekeeper_modal" data-target="#peacekeeper_modal" data-toggle="modal">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Peacekeeper.png" alt="text">
        <span>Peacekeeper</span>
      </div>
       <!--<div class="post-item" data-post-id="post-type-other">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/other.png" alt="text">
        <span>Other</span>
      </div> -->
    </div>
    <!-- premium -->
    <span class="create-post_type__title">Premium</span>
    <div class="post-types">
      <div class="post-item" data-post-id="be-found" data-target="#premium" data-toggle="modal">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Be-found1.png" alt="text">
        <span>Be found</span>
      </div>
      <div class="post-item" data-post-id="find-someone" data-target="#find_someone" data-toggle="modal">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Find1.png" alt="text">
        <span>Find someone</span>
      </div>
      <div class="post-item" data-post-id="buy-and-sell" data-target="#buy_and_sell" data-toggle="modal">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Buy-and-sell1.png" alt="text">
        <span>Buy and sell</span>
      </div>
      <div class="post-item" data-post-id="host-event" data-target="#host_event" data-toggle="modal">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Event1.png" alt="text">
        <span>Host event</span>
      </div>
      <div class="post-item" data-post-id="post-news" data-target="#news_modal" data-toggle="modal">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/News1.png" alt="text">
        <span>Post news</span>
      </div>
      <div class="post-item" data-post-id="hire-someone" data-target="#hire_someone" data-toggle="modal">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Hire1.png" alt="text">
        <span>Hire someone</span>
      </div>
		<?php get_template_part( 'template-parts/create-post/temp-create-post-popups' )?>
    </div>
    <div class="steps-navigation">
      <button style="opacity:0" class="step-btn" id="previes-step__button" data-id="step-1-prev">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Back-Button.png"
          alt="previes step"></button>
      <button class="step-btn" id="next-step__button" data-id="step-1-next">
        <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Next-Button.png" alt=""></button>
    </div>
  </div>
</div>
  </section>