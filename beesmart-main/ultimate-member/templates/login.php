<?php if ( ! defined( 'ABSPATH' ) ) exit; 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);

 $first_part = $components[1]; 
?>
<!-- <div class="reg-header">
	<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2021/11/Bees.svg" alt="logo">
</div>
 <div class="reg-header__title">
	<h2>BEE<span class="orange">SMART</span></h2>
	<?php //echo $first_part; ?>
</div> 
 <div class="navigation">
	<a href="/sign-up-2/" ><button class="signup-btn <?php if ($first_part=="register") {echo "active_log"; }?>">Sign Up</button></a>
	<a href="/login/"><button  class="login-btn <?php if ($first_part=="login") {echo "active_log"; }?>">Log In</button></a>
</div> -->
  <div class="signup_navigation">
          <div class="row">
              <div class="col-6">
                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2021/11/Bees.svg" class="bee_icon" alt="icon">
                <a href="/signup/" class="">Sign Up</a>
              </div>
              <div class="col-6">
                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Pay.png" class="log_icon active" alt="icon">
                <a href="/login/" class="active">Log In</a>
              </div>
          </div>
  </div>
<div class="signup_form">
<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">

	<div class="um-form">

		<form method="post" action="" autocomplete="off">

			<?php
			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_before_form
			 * @description Some actions before login form
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_form', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_form', 'my_before_form', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_before_form', $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_before_{$mode}_fields
			 * @description Some actions before login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_before_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_main_{$mode}_fields
			 * @description Some actions before login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_before_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_before_{$mode}_fields', 'my_before_fields', 10, 1 );
			 * function my_before_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_main_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_form_fields
			 * @description Some actions after login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_form_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_form_fields', 'my_after_form_fields', 10, 1 );
			 * function my_after_form_fields( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_after_form_fields', $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_{$mode}_fields
			 * @description Some actions after login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_{$mode}_fields', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_{$mode}_fields', 'my_after_form_fields', 10, 1 );
			 * function my_after_form_fields( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( "um_after_{$mode}_fields", $args );

			/**
			 * UM hook
			 *
			 * @type action
			 * @title um_after_form
			 * @description Some actions after login form fields
			 * @input_vars
			 * [{"var":"$args","type":"array","desc":"Login form shortcode arguments"}]
			 * @change_log
			 * ["Since: 2.0"]
			 * @usage add_action( 'um_after_form', 'function_name', 10, 1 );
			 * @example
			 * <?php
			 * add_action( 'um_after_form', 'my_after_form', 10, 1 );
			 * function my_after_form( $args ) {
			 *     // your code here
			 * }
			 * ?>
			 */
			do_action( 'um_after_form', $args ); ?>

		</form>

	</div>

</div>
</div>
<style>
.um-field-error {
    background: #fbefeb;
    margin-top: 0;
    color: #D98602;
}
.um-field-arrow{
	color: #D98602;
}
button.login-btn {
    color: #db9b36;
}
.et_pb_module.et_pb_text.et_pb_text_0.et_pb_text_align_left.et_pb_bg_layout_light {
    display: none;
}
button.signup-btn {
    color: #000;
}
.um-right.um-half > a {
    display: none;
}
.um-field {
    padding: 0px 0 0;
}
.um-field-area {
    padding: 5px 10px;
}
.um-col-alt {
    padding: 0px 0 0px 0;
}
.signin_page .um.um-login.um-72 {
    opacity: 1;
	max-width: 100%;
}
body.page-id-76.um-page-login {
    background: #eff0f0;
}
.signin_page .um-form .um-half input.um-button {
    background-color: #c17514 !important;
    box-shadow: none;
}
.signin_page .um-form .um-half{
	margin: auto;
    float: none;	
}
</style>