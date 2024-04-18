<?php /* Template Name: create post */
get_header();
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/page-create-post.css">
<style>
  div#cutom_frontend_sidebar {
    display: block;
  }
</style>


<main class="create-post px-2" id="create-post-page">
  <!-- <div class="wrapper"> -->
  <div class="inner_main_page_section_cls">

    <div class="container">
      <div class="progress custom_progress details_progress">
        <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Create1.png" class="progress_icon" />
     <div class="progress-bar active" role="progressbar" aria-valuemin="50" aria-valuemax="100" style="width: 25%">	</div>
      </div>
    </div>
    <?php get_template_part('template-parts/create-post/test-temp-create-post-step-1'); ?>
    <!-- first step free and premium types -->
    <?php get_template_part('template-parts/create-post/news-details'); ?>
    <!-- two step buddy form and read meta -->

    <?php get_template_part('template-parts/create-post/temp-create-post-step-2'); ?>
    <section class="additiona-form-fields">
      <?php get_template_part('template-parts/create-post/step3'); ?>
      <div class="steps-navigation step-3">
        <button class="step-btn previes-step__button" data-id="step-3-prev">
          <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Back-Button.png" alt="previes step">
        </button>
        <button class="step-btn step-submit__button" data-id="step-3-next" disabled="disabled" data-type="shadow">
          <img width="70" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Check1.png" alt="" data-type="shadow">
        </button>
      </div>
    </section>
  </div>
</main>
<script type="text/javascript">
  $(document).ready(function() {
    $('div#main-content .woocommerce').addClass('billinginfo');
  });
</script>

<?php get_footer(); ?>
