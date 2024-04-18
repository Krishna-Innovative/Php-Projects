<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-S5EMMEVMWQ"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'G-S5EMMEVMWQ');
	</script>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:url" content="<?php echo esc_url(get_post_permalink()); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo esc_html(get_the_title()); ?>" />
	<meta property="og:image" content="<?php the_post_thumbnail_url('full'); ?>" />
	<!--<link rel="profile" href="https://gmpg.org/xfn/11">-->
	<link rel="icon" type="image/x-icon" href="https://bonjourtutors.com/wp-content/themes/ms-lms-starter-theme/favicon.png?version">
    <link rel="stylesheet" href="https://bonjourtutors.com/wp-content/plugins/masterstudy-lms-learning-management-system/_core/assets/vendors/font-awesome.min.css?ver=3.1.19">
    	<?php wp_head(); ?>



</head>

<style>
	body,
	p span,
	li,
	a,
	button {
		font-family: "Karla", Sans-serif !important;
	}

	h1,
	h1,
	h3,
	h4,
	h5,
	h6 {
		font-family: "Inter", Sans-serif !important;
	}
    body .container {
    	width: 100%! important;
    	max-width: 1200px;
	}

</style>

<body <?php body_class(); ?>>
	<?php wp_body_open();




	get_template_part('templates/header/index');