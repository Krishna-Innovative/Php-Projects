<?php /* Template Name: load more */ 
    get_header();
?>
<div class="feed-page">
	<div class="container">
		<div class="gmw-results-wrapper grid-gray gmw-pt-grid-gray-results-wrapper pt" data-id="7" data-prefix="pt" id="postdynamic">
			<div class="gmw-results">
<?php echo do_shortcode('[ajax_load_more container_type="ul" css_classes="posts-list-wrapper" post_type="post" posts_per_page="12"  scroll="false" button_label="Find More"]');?>
			
</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
										 <script type="text/javascript">
											$(document).ready(function(){  

											function makeTimer() {

											var endTime = new Date("<?php echo $add_date; ?>");
														endTime.setDate(endTime.getDate() + 28);
											var endTime = (Date.parse(endTime)) / 1000;
											// console.log(endTime);
											var now = new Date();
											var now = (Date.parse(now) / 1000);

											var timeLeft = endTime - now;

											var days = Math.floor(timeLeft / 86400); 
											var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
											var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
											var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

											if (hours < "10") { hours = "0" + hours; }
											if (minutes < "10") { minutes = "0" + minutes; }
											if (seconds < "10") { seconds = "0" + seconds; }    

											$("#days_<?php echo $post->ID; ?>").html(days + "<span>d:</span>");
											$("#hours_<?php echo $post->ID; ?>").html(hours + "<span>h:</span>");
											$("#minutes_<?php echo $post->ID; ?>").html(minutes + "<span>m</span>");

											}  

											setInterval(function() { makeTimer(); }, 1000);

											});  

										   </script>
<style>
/**
 * Posts Locator search results stylesheet "grid-gray"
 */
 .sr-item-description > p , .cont-flg , a , span, div, input#gmw-keywords-4{
	font-family: 'Nunito';
}
div.gmw-results-wrapper.grid-gray select {
	border: 1px solid #ccc;
	height: 25px;
	color:#555;
	max-width: 150px;
}

div.gmw-results-wrapper.grid-gray .pagination-per-page-wrapper {}

div.gmw-results-wrapper.grid-gray .pagination-per-page-wrapper.bottom {}

/* pagination */

div.gmw-results-wrapper.grid-gray ul.gmw-pagination {
	float: right;
	text-align: center;
	margin:0px;
	list-style:none;
	padding:0px;
}

div.gmw-results-wrapper.grid-gray select.gmw-orderby-dropdown {
	float: right;
}

/* list of results */

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper {
	list-style:none;
	margin-bottom: 1px;
	padding:0px;
	/* border-top: 10px solid #e1e1e1;
	border-bottom: 10px solid #e1e1e1; */
	margin:1px 0 10px 0;
	padding-bottom: 10px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post {
	margin:0px;
	border-bottom: 10px solid #e1e1e1;
	width:31.6%;
	display:inline-block;
	border:1px solid #eee;
	background: #FFFFFF;
	-o-box-shadow: 0px 0px 3px #eee;
	-moz-box-shadow: 0px 0px 3px #e1e1e1;
	-webkit-box-shadow: 0px 0px 3px #e1e1e1;
	box-shadow: 0px 0px 3px #e1e1e1;
	border:1px solid #e5e5e5;
	-webkit-transition: all 0.2s linear;
	-o-transition: all 0.2s linear;
	-moz-transition: all 0.2s linear;
	-ms-transition: all 0.2s linear;
	-kthtml-transition: all 0.2s linear;
	transition: all 0.2s linear;
	vertical-align: top;
	padding:0px;
	margin:15px 0.5% 5px;
	min-width: 190px;
	border-radius: 10px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:hover {
    -webkit-box-shadow: 0 0px 10px #ddd;
    -moz-box-shadow: 0 0px 10px #ddd;
    box-shadow: 0 0px 10px #ddd;
    -webkit-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    -moz-transition: all 0.2s linear;
    -ms-transition: all 0.2s linear;
    -kthtml-transition: all 0.2s linear;
    transition: all 0.2s linear;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(3n+1)  { 
 	margin:15px 0;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(3n+2) { 
 	margin:15px 0.5% 5px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(3n+3) { 
 	float:right;
 	margin:15px 0.5% 5px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .wrapper-inner {
	display: inline-block;
	width: 100%
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(even) {
	background:#fdfdfd;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper {
	color: #363636;
	font-size: 14px;
	display: inline-block;
	width: 100%;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	background: white;
	padding: 1px 3px;
	position: relative;
	/* line-height: 10px; */
}

.top-wrapper>p {
	text-align: left;
	line-height: 18px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper span.distance {
	font-style: italic;
	font-size: 10px;
	color: #333;
	padding: 1px 4px;
	background: #f5f5f5;
	display: inline-block;
	box-sizing: border-box;
	vertical-align: top;
	border: 1px solid #f1f1f1;
	line-height: 16px;
	margin-left: 5px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper h2.post-title {
	margin: 0px;
	display: inline-block;
	font-size: 15px;
	text-decoration: none;
	margin-right: 10px;
	text-transform: capitalize;
	font-weight: 500;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper h2.post-title a {
	text-decoration:none;
	font-weight: 800;
	font-size: 18px;
	color: #141414;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .top-wrapper span.address {
	font-size: 9px;
	width:100%;
	/* display: inline-block; */
	display: flex;
	justify-content: flex-end;
	text-align: center
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content {
	display: inline-block;
	width:100%;
	/* padding:10px; */
	-webkit-box-sizing: border-box; 
	-moz-box-sizing: border-box;    
	box-sizing: border-box;
	font-size: 14px;
	line-height: 20px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .post-thumbnail,
div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
	width:100%;
	height:100%;
	overflow:hidden;
	/* background:#f7f7f7; */
	/* border:1px solid #ddd */
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
	text-align: center;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .post-thumbnail img {
	width:100%;
	border-radius: 15px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
	color: rgb(179, 223, 193) !important;
	font-size:40px !important;
	margin: 0;
	padding-top: 28px;
	box-sizing: border-box;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .right-col {
	width:58%;
	float:right;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .right-col h4 {
	font-size:14px;
	font-weight:bold;
	margin:0px 0 5px 0px;
	color:#555;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .gmw-taxes {
	font-size: 12px;
	line-height: 17px;
	color: #777;
	margin-left: 12px;
}

div.gmw-results-wrapper.grid-gray ul.gmw-terms-wrapper {
	list-style: none;
	padding:0px;
	margin:0px;
	display: inline-block;
}

div.gmw-results-wrapper.grid-gray div.post-content h3 {
	font-size: 14px;
	font-weight: normal;
	padding: 0;
	font-weight: bold;
}

div.gmw-results-wrapper.grid-gray ul.opening-hours-wrapper {
	list-style:none;
	margin:0;
	padding:0;
	padding-bottom:15px;
}

div.gmw-results-wrapper.grid-gray ul.opening-hours-wrapper li {
	list-style:none;
	margin:0;
	padding:0;
}

div.gmw-results-wrapper.grid-gray .bottom-wrapper {
	background-color: #9BDFC3;
	color: white;
	min-height: 30px;
	position: relative;
	padding: 6px 10px;
	box-sizing: border-box;
	line-height: 18px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-icon {
	color: white;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-icon:before {
	padding: 0;
	margin: 0;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .get-directions-wrapper a {
	
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .get-directions-wrapper {
	margin: 5px 0px 0px;
	font-size: 320;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper {
	display: inline-block;
	width: 100%;
	box-sizing: border-box;
	line-height: 18px;
	font-size: 12px;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:link,
div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:visited {
	color: white;
}

div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:hover,
div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:active {
	text-decoration: underline;
}

div.gmw-results-wrapper.grid-gray div.gmw-no-results-wrapper {
	max-width: 960px;
	margin:15px auto;
	background: white;
}

div.gmw-results-wrapper.grid-gray div.gmw-no-results-wrapper p {
	background:white;
}

@media (max-width:800px) {
	
	div.gmw-results-wrapper.grid-gray select {
		width:100%;
		max-width:100%;
	}

	div.gmw-results-wrapper.grid-gray .pagination-per-page-wrapper,
	div.gmw-results-wrapper.grid-gray div.gmw-results-message {
		padding: 15px;
	}

	div.gmw-results-wrapper.grid-gray div.gmw-results-message span {
		text-align: center;
		display: block;
		margin-bottom: 5px;
	}

	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper {
		display:inline-block;
	}

	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper {
		/* text-align:center; */
		padding:10px;
	}
	
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post {
		width:48%;
	}
	
	div.gmw-results-wrapper.grid-gray select,
	div.gmw-results-wrapper.grid-gray select.gmw-per-page {
		width: 100%;
		max-width: 100%;
	}
	
	div.gmw-results-wrapper.grid-gray ul.gmw-pagination {
		float:none;
		width:100%;
		margin-top:10px;
		display: inline-block;
	}
					
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .left-col,
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .right-col {
		width:100%;
		float:none;
		padding-top:10px
	}
}

@media (max-width:520px) {
			
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .get-directions,
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper {
		max-width: 100%;
	}
			
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post {
		width:100%;
		margin:15px 0px;
	}
	
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .post-thumbnail,
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
		height:200px;
	}
	
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
		margin: 60px 0 0 -55px;
		font-size:80px !important;
	}
}

/* custom */

.author-wrapper {
	display: flex;
	justify-content: space-between;
	padding: 8px 10px 0px 5px;
	height: 45px;
}

.author-block{
	display: flex;
}

.author-name {
	line-height: 30px;
	margin-left: 5px;
	font-size: 15px;
	font-weight: 800;
}


.taxonomies-list-wrapper {
	text-align: left;
	border-bottom: 1px solid #E5E5E5;
	width: 107.7%;
	margin-left: -4%;
}

.title-wrapper{
	display: flex;
	position: absolute;
}

img{
	height: inherit;
}

.gmw-taxonomy-terms.gmw-taxes.tag {
	margin-bottom: 5px;
}

.card-wrapper {
	display: flex;
	justify-content: space-between;
	align-items: baseline;
	border-top: 1px solid #E5E5E5;
	margin: 0 7px;
}
.author-img>img {
	border-radius: 50px;
}
.author-img {
	width: 35px;
}
.post_type_icon{
	width: 35px;
	height: 95%;
}

/* saved queries */

.the_buddyforms_form .form_wrapper .col-xs-12.bf-start-row .bf_field_group .bf-input input, .the_buddyforms_form .form_wrapper .col-xs-12.bf-start-row .bf_field_group .bf-input .select2-selection, .the_buddyforms_form .form_wrapper .col-xs-12.bf-start-row .bf_field_group .bf-input #wp-buddyforms_form_content-editor-container, .the_buddyforms_form .form_wrapper .col-xs-12.bf-start-row .bf_field_group .bf-input #featured_image{
  border:none!important;
}


.et-db #et-boc .et-l .the_buddyforms_form .buddyforms-save-search-query .bf-input input[type="checkbox"], .et-db #et-boc .et-l .the_buddyforms_form .buddyforms-save-search-query .bf-input input[type="radio"], .the_buddyforms_form .buddyforms-save-search-query .bf-input input[type="checkbox"], .the_buddyforms_form .buddyforms-save-search-query .bf-input input[type="radio"] {
    width: 40px!important;
    height: 40px!important;
}
.bf-submission{
  display:flex;
}
.bf-submission:after {
    content: '';
    background-image: url('https://beesm.art/wp-content/uploads/2021/11/radio.svg');
    width: 20px;
    height: 20px;
    position: absolute;
    right: 10px;
    z-index: 9999;
    top: 50%;
    background-size: cover;
    transform: translateY(-50%);
		background-size: 100%;
}
ul.buddyforms-list {
    margin: 0;
    padding: 0;
    list-style: none outside none;
}
ul.buddyforms-list li.bf-submission{
  padding:10px 5px 0!important;
	border-bottom: none!important;
}
.icon_for_saved_query {
    width: 28px;
    /* transform: translate(0px, 30px); */
}
#saved_queries_block {
	padding: 0;
	width: 100%;
	margin-top: 0.5rem;
}
a.query-link {
	font-size: 18px;
	line-height: 24px;
	letter-spacing: 0.02em;
	color: #363636;
	margin-left: 30px;
	font-weight: 600;
	width: 60vw;
	display: inline-flex;
}
.bf-submission:hover{
	background: linear-gradient(180deg, #F0F0F0 0%, #ECECEC 100%);
	border-radius: 10px;
}
.bf-submission:hover:after {
	background-image: url('https://beesm.art/wp-content/uploads/2021/11/radioActive.svg');
	background-size: 100%;
}
.active-saved-search:after {
	content: '';
	background-image: url('https://beesm.art/wp-content/uploads/2021/11/radioActive.svg');
	width: 20px;
	height: 20px;
	position: absolute;
	right: 20px;
	top: 50%;
	transform: translateY(-50%);
	background-size: 100%;
	z-index: 10000;
}
.LoveCheck:not(:checked) + .LoveLabel {
  color: none;
  background: url(https://beesm.art/wp-content/uploads/2021/11/Honey.svg);
  height: 51px;
	width: 38px;
	background-size: cover;
}
label.dashicons.dashicons-heart.LoveLabel {
	background: url(https://beesm.art/wp-content/uploads/2021/11/Honey.svg)no-repeat;
	height: 31px;
	width: 26px;
	background-size: 90%;
}
.LoveLabel::before{
  display: none;
}
.LoveLabel::after{
  display: none;
}
iframe.post_popup {
  width: 70%;
  height: 80%;
  position: fixed;
  top: 15%;
  left: 15%;
}
button.close_iFrame {
  position: fixed;
  top: 140px;
  right: 200px;
  background: #DB9B36;
  border: none;
  color: #fff;
  width: 50px;
  height: 50px;
  border-radius: 50px;
  z-index: 1000000;
}

/* popap */
div#custom-bg {
	background: #fff;
}
.description_block {
	background: #fff;
}
div#custom-bg {
	background: #fff;
	display: flex;
	justify-content: center;
}
/* div#custom-bg>img {
	height: 70vh!important;
} */
span.cp_close {
	font-size: 30px;
	width: 40px;
	height: 40px;
	background: #DB9B36;
	padding: 10px;
	right: -20px;
	top: -15px;
}
.cp_title_div>h3 {
	color: #000!important;
	margin-left: 20px;
	margin-bottom: 0;
	padding-bottom: 0;
	margin-top: 0;
}
.view-more-btn {
    width: 257px;
    height: 94px;
    background: url(<?php echo site_url();?>/wp-content/uploads/2022/02/open_btn.png)no-repeat;
    border-radius: 10px;
    padding: 10px;
    color: #fff;
    display: block;
    border: none;
    margin: 0 auto;
    text-align: center;
}
a.view-more-btn {
	color: #fff;
	text-decoration: none;
}
.popup-card-wrapper {
	display: flex;
	justify-content: space-between;
}
.popup-card-wrapper>.honey-block {
	margin-left: 20px;
}
.popup-card-wrapper>.right-side-block>.bees-block {
	margin-right: 20px;
	font-size: 25px;
}
.popup-card-wrapper>.right-side-block>.bees-block>img {
	height: 51px;
}
.popup-card-wrapper>.honey-block>.love>span.LoveCount {
	font-size: 25px;
}
.popup-author-name{
	color: #000;
}
.popup-author-wrapper {
	display: flex;
	justify-content: space-between;
}
.author-name-block {
	display: flex;
}
.popup-author-img{
    margin: 5px;
}
.popup-author-img>img {
	width: 50px;
	border-radius: 50px;
}
.popup-type-of-post{
	font-size: 30px;
	margin-right: 20px;
	display: none;
}
.popup-type-of-post>img{
	width: 60px;
}
.view-more-block {
	background: #fff;
	padding: 15px;
	border-radius: 20px;
}
.cp_btn_div.custom {
	position: absolute;
}
.popup-title-section {
	background: #fff;
}
span.popup-address {
	margin-left: 20px;
	font-size: 26px;
	letter-spacing: 0.02em;
	color: #DB9B36;
}
.gmw-no-results {
	text-align: center;
	border: none;
	border-top: 1px solid #E5E5E5;
	font-family: 'Nunito';
	font-weight: 600;
	font-size: 18px;
	line-height: 28px;
	letter-spacing: 0.02em;
	color: #929292;
}
img.no_result_img {
	display: block;
	margin: 0 auto;
	width: 40%;
}
.page-id-2654 div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .post-thumbnail, div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
	padding-right: 0!important;
}
.edit_links>li>.bf_edit_post {
	display: none!important;
}
input.select2-search__field {
	height: 33px;
	border: none!important;
}
span.select2-selection.select2-selection--multiple {
	border: none!important;
}
/* post desctiption  */

.gmw-excerpt.excerpt>p {
	font-size: 14px;
	line-height: 13px;
	color: #363636;
	margin-top: 13px;
	margin-bottom: 0;
}
.gmw-excerpt.excerpt>.um-clear {
	display: none;
}
/* timer */
.timer_block {
	font-size: 16px;
	color: #929292;
}

/* comments count */
.bees-block {
	font-size: 15px;
}
/* img  */
@media screen and (max-width: 479px){
	.bf_delete_post {
		position: relative;
		left: -50px;
	}
	div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .single-post .post-thumbnail {
		width: 100%!important;
	}
	label.dashicons.dashicons-heart.LoveLabel {
    background: url(https://beesm.art/wp-content/uploads/2021/11/Honey.svg);
    height: 23px;
    width: 17px;
    background-size: cover;
	}
	.timer_block {
    font-size: 12px;
    color: #929292;
	}
	button.cp_btn {
    width: 90%;
    height: 400px;
    opacity: 0;
	}
}</style>