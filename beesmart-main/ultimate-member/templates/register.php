<?php if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! is_user_logged_in() ) {
	um_reset_user();
} 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);

 $first_part = $components[1]; 

?>

<div class="signup_form">
	
	<div class="um <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?>">

		<div class="um-form" data-mode="<?php echo esc_attr( $mode ) ?>">

			<form method="post" action="">

				<?php
				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_before_form
				 * @description Some actions before register form
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
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
				do_action( "um_before_form", $args );

				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_before_{$mode}_fields
				 * @description Some actions before register form fields
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
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
				 * @title um_before_{$mode}_fields
				 * @description Some actions before register form fields
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
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
				 * @description Some actions after register form fields
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
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
				 * @description Some actions after register form fields
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
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
				 * @description Some actions after register form fields
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Register form shortcode arguments"}]
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
label[for=user_password-2757] {
    display: none;
}
a.um-hide-terms {
    display: none;
}
div#um_field_2757_account_type{
	display:none;
}
div#um_field_2757_country {
    padding: 0!important;
}
.um-field-error {
    background: #dc9e3f;
    border-radius: 10px;
}
span.um-field-arrow {
    color: #dc9e3f;
}
.url-language-duble {
    margin: 0;
}
.um-field-area {
    padding: 0px;
}
div#um_field_2757_user_password>.um-field-label>label {
    padding: 10px 0 15px 0;
    /* text-align: center; */
    margin-bottom: 0px;
    font-size: 16px!important;
    color: #aaaaaa;
}
div#um_field_2757_confirm_user_password {
    padding: 0;
}
span.et_pb_image_wrap>img {
    width: 100px!important;
    height: 100px;
}
.url-language-duble{
	border-top:none;
}
.um-field-label>label {
    margin-bottom: 0;
}
.reg-header>img {
	margin-top: 1rem;
}
p,a,span,label{
	font-family: 'Nunito';
}
h1,h2,h3,input#um-submit-btn,button,button#step_two_btn,input,button.signup-btn,button.login-btn {
	font-family: 'Nunito';
	font-weight: 900;
}
.reg-header>h2 {
	 font-weight: 800;
    font-size: 26px;
    font-family: 'Nunito';
    color: #000;
    margin-bottom: 2rem;
}
.et_pb_main_blurb_image {
    margin-bottom: 5px;
}
	.et_pb_section.et_pb_section_0.et_section_regular::before {
    content: '';
    background: url(https://beesm.art/wp-content/uploads/2021/11/bg-top-honey.png);
    width: 211px;
    height: 133px;
    display: block;
    position: absolute;
    top: 0;
}
.et_pb_section.et_pb_section_0.et_section_regular::after {
    content: '';
    display: block;
    background: url(https://beesm.art/wp-content/uploads/2021/11/bg.png);
    position: absolute;
    width: 100%;
    height: 250px;
    background-repeat: no-repeat;
    background-size: cover;
    bottom: 0;
}
.reg_second_part{
  display:none;
}
.reg_third_part{
 display:none; 
}
.um-field-type_terms_conditions{
  display:none!important;
}
.um-col-alt{
  display:none;
}
#categories_block{
  display:none;
}
#join-block{
  display:none;
  margin-top: 2rem;
}
#um_field_2757_Choose_Category{
  display:none;
}
#step_four_block{
  display:none;
}
#step_five_block{
  display:none;
}
.title-block{
  margin-top:10px;
}
#page_title{
  display:none;
}
.um-field-area{
  background-color:#fff0;
}
h4.et_pb_module_header {
    text-align: center;
}
.et-waypoint {
    width: 30%;
}
img.join-icon {
    width: 110px;
}
.et_pb_row.et_pb_row_3 {
    z-index: 1;
}

/* inputs */

input {
  background-color: #F8F8F8!important;
	border-radius: 5px!important;
	border: 1px solid #DFDFDF!important;
}
	.um{opacity:1!important}

#main-footer{
	margin-left: 0!important;
	max-width: initial!important;
}
/* styles from divi */
.reg-header {
	display: grid;
	justify-items: center;
	background: #F3F3F3;
	transform: scale(1.15);
	z-index: -1;
	position: relative;
}

.orange{
  color:#DB9B36;
}

/* steps */

.steps-section {
  display: flex;
  justify-content: center;
  width: 100%;
  margin-top: 2rem;
  position:relative;
}
.steps-wrapper {
  display: flex;
  justify-content: space-evenly;
  width: 100%;
  margin-left: -11px;
}
/*.img-steps{
  border: 25px solid #fff;
  background: #fff;
}*/
.steps-line{
  position: absolute;
  width: 54%;
  height: 1px;
  background: #929292;
  top: 3rem;
  z-index: -1;
  overflow: hidden;
}
/* buttons */
.navigation {
  margin-top: 2rem;
  margin-bottom: 1rem;
	padding: 0rem 7vw;
}
/* step 2 */

/* join-to block */
.join-to {
    background: #F8EBD7;
    border: 1px solid #666666;
    box-sizing: border-box;
    box-shadow: 0px 4px 4px rgba(0,0,0,0.25),inset 0px 4px 30px #FFFFFF;
    height: 120px;
    border-radius: 10px;
    margin-bottom: 1rem;
}
.join-to-desc{
  display: flex;
  justify-content: center;
  margin-bottom: 1rem;
}
.desc-text{
  width: 100%;
  font-weight: 600;
  font-size: 16px !important;
  color: #000000;
  text-align: left;
  margin-left: 1rem;
  display: grid;
  align-items: center;
}
.join-to-desc > img {
  object-fit: contain;
}

/* contineu/back btns */

div#step_four_block{
	margin-top: 3rem;
	grid-template-columns: 1fr 1fr;
	margin-bottom: 2rem;
	justify-items: center;

}
.next-step {
	display: grid;
	margin-top: 3rem;
	grid-template-columns: 1fr 1fr;
	margin-bottom: 2rem;
	justify-items: center;
}
.next-step__back{
  background: url(/wp-content/uploads/2021/11/back-btn.png);
  background-repeat: no-repeat;
  background-size: contain;
  color: #000;
  font-weight: bold!important;
  font-size: 18px;
  border: none;
  width: 180px;
  height: 43px;
  margin-right: 6px;
}
.next-step__continue{
  background: url(/wp-content/uploads/2021/11/continue.png);
  background-repeat: no-repeat;
  background-size: contain;
  color: #fff;
  font-weight: bold!important;
  font-size: 18px;
  border: none;
  width: 180px;
  height: 43px;
  cursor:pointer;
  transition: 0.5s ease;
  margin: 0 auto;
  display: table;
}
.next-step__continue[disabled] {
    filter: grayscale(1);
}
.category_item{
  transition: ease .5s;
  border-radius: 10px;
	width: 100px;
	height: 100px;
}
.category_item>img {
	width: 70px;
	height: 70px;
}
.category_item>span {
	font-size: 16px;
	line-height: 2;
}
.category_item:hover {
  background: rgba(219, 156, 55, 0.301);
  border-radius: 10px;
}
.CodeMirror-lines {
    text-align: left;
}
#page-container{
	overflow:hidden;
}
#form-step_3{
	display:none;
}
.join-to {
	display:none;
}
.orange_bg{
	background:rgba(219, 156, 55, 0.301);
}
.bf_field_group.elem-post_excerpt{
	display:none;
}
div#buddyforms_form_hero_save-search-query {
    display: none;
}
.signup-form {
	box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.25);
	border-radius: 20px 20px 0 0;
	padding: 1px 40px;
	background: #fff;
}
.categories-items {
	display: grid;
	grid-template-columns: 1fr 1fr 1fr;
	justify-items: center;
	grid-template-rows: 100px;
}
.category_item,.category_item>img  {
	display: grid;
	justify-items: center;
}
button.signup-btn {
	border-bottom: 2px solid #DB9B36;
}
button.login-btn {
	border-bottom: 2px solid #E5E5E5;
}
div#et-main-area {
    overflow-x: hidden;
}
.step-item {
    width: 20%;
    text-align: center;
    padding: 10px;
}
.step-item .img-steps {
    background: #fff;
    padding: 0 15px;
    max-width: 60px;
	border: none;
}
.um-register{
	max-width: 100% !important;
}
}
.category_item>img {
	margin-top:20px;
}
#page_title {
    font-size: 24px;
}
.join-img-wrap img.join-icon {
    max-width: 60px;
    width: auto;
    margin-top: 13px;
    margin-left: 10px;
}
#um_field_2757_languages {
    padding-top: 0;
}	
.step_btns .um-col-1 {
    text-align: center;
}
	
@media (min-width:1200px) {
	.signup-form {
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.25);
    border-radius: 20px 20px 0 0;
    padding: 1px 10rem;
    background: #fff;
}
.category_item{
  transition: ease .5s;
  border-radius: 10px;
	width: 100%;
	height: 170px;
}
/* .category_item>img {
	width: 100px;
	height: 100px;
} */
.categories-items{
	grid-template-rows: 200px;
}
}
@media (max-width: 1199px) {
	.category_item{
		transition: ease .5s;
		border-radius: 10px;
		width: 200px;
		height: 200px;
	}
	.category_item>img {
		width: 130px;
		height: 130px;
	}
	.categories-items{
		grid-template-rows: 200px;
	}
}

@media (max-width: 767px) {
	.categories-items{
		grid-template-rows: 170px;
	}
	.category_item {
    width: 150px;
    height: 150px;
	}
	.category_item>img {
    width: 80px;
    height: 80px;
	}
}
/* media queries for reg page */

@media (max-width: 680px){
  .signup_form {
    padding: 25px 15px;
}
	.steps-wrapper {
    width: 100%;
  }
  .step-item {
    z-index: 2;
  }
  .step-item > h4 {
    font-size: 14px;
	letter-spacing: -0.1px;
	display: none;
  }
  .steps-line{
    z-index: 0;
    width: 75%;
  }
	.steps-wrapper {
    width: 100%;
    z-index: 3;
	margin-left: 0;
}
.reg-header__title>h2 {
    font-size: 1.5rem;
}
.steps-line {
    width: 75%;
    top: 36px;
}
div#categories_block>.et_pb_column {
    width: 33%!important;
}
.et_pb_column.et_pb_column_4_4.et_pb_column_4.et_pb_css_mix_blend_mode_passthrough.et-last-child {
    width: 100%;
}
.et_pb_column .et_pb_row_inner, .et_pb_row {
    padding: 0px;
}
.desc-text {
    width: 50%;
    font-size: 14px!important;
    line-height: 16px!important;
    color: #000000;
    text-align: left;
    margin-left: 1rem;
}
.join-img-wrap {
    display: grid;
    align-content: center;
}
.et-waypoint {
    width: 60px;
}
h4.et_pb_module_header>span {
    font-size: 15px;
}
.next-step{
  margin-top:0px!important;
}
.next-step__back{
  height:35px!important;
  background: #D8D8D8;
  box-shadow: inset 0px 4px 10px rgba(236, 236, 236, 0.55);
  border-radius: 10px;
  font-size: 14px;
}
.next-step__continue{
  height:35px!important;
  background: #DB9B36;
  box-shadow: inset 0px 4px 12px rgba(255, 255, 255, 0.54);
  border-radius: 10px;
  font-size: 14px;
}
button#step_two_btn {
    height: 46px!important;
}
h1#page_title {
    font-size: 22px;
    font-weight: bold;
    text-align: center;
    margin-bottom: -15px;
    padding-bottom: 15px;
}
span.et_pb_image_wrap>img {
    width: 50px!important;
    height: 50px;
}
.signup_navigation {
    position: relative;
    margin: 0 20px;
}
.step-item .img-steps {
    max-width: 40px;
    padding: 3px;
}
.step-item{
	width:auto;
}
#join-block {
    margin-top: 5rem;
}
}

@media(min-width:681px){
	.step-item>h4 {
		font-size: 14px;
		margin-top: 5px;
	}
	.steps-line {
    width: 75%;
    top: 30px;
	}
}
@media (max-width: 530px){
	.next-step>button {
    width: 100%;
	}
	.category_item {
		width: 75px;
    height: 75px;
	}
	button#step_two_btn {
    width: 100%;
	}
}
</style>