<?php
/*Template name:search-result*/
get_header();
global $wpdb; 
$query=$_GET['query'];
//echo $query.'===';
$save_feed_id=base64_decode($query);
$wp_save_feed = $wpdb->get_results( "SELECT * FROM wp_save_feed where save_feed_id ='$save_feed_id'");
//echo '<pre>';print_r($wp_save_feed);echo '</pre>';
$tool_id=$wp_save_feed[0]->tool_id;
$sort_id=$wp_save_feed[0]->sort_id;
$store_feed=$wp_save_feed[0]->store_feed;
$tool_area=explode('-',$tool_id);
$sort_area=explode('-',$sort_id);
//print_r($tool_area);
?>
<div class="container">
<div class="gmw-results-wrapper grid-gray gmw-pt-grid-gray-results-wrapper pt" data-id="7" data-prefix="pt">
<div class="gmw-results">
			
<ul class="posts-list-wrapper row justify-content-center">
<?php
$args = array(
'post_type'=> 'post',
'orderby'    => 'ID',
'post_status' => 'publish,draft,trash',
'category_name' => $tool_area[1],
'order'    => $sort_area[0],
'posts_per_page' => -1,
'meta_query'    => array(
    'relation' => 'OR',
    array(
        'key'       => 'Choose-Type',
        'value'     => $tool_area[0],
        'compare'   => '=',
    ),
    array(
        'key'       => 'Country',
        'value'     => 'India',
        'compare'   => '=',
    ),
)
);
$result = new WP_Query( $args );
if ( $result-> have_posts() ) :
 while ( $result->have_posts() ) : $result->the_post();
 ?>
 <li id="single-post-<?php the_ID();?>" class="single-post gmw-single-item gmw-single-post gmw-object- gmw-location- first-location">
						<div class="wrapper-inner">
													
							<div class="post-content"> 
															
								<div class="cp_btn_div custom"><button class="cp_btn" data-id="<?php the_ID();?>" style="background-color:#000000;font-size:px;color:#000000;">Quick View</button></div>
								<div class="author-wrapper">
									<div class="author-block">
										<div class="author-img">
										<img src="https://beesm.art/wp-content/uploads/ultimatemember/184/profile_photo-80x80.jpg?1646724515" class="gravatar avatar avatar-60 um-avatar um-avatar-uploaded" width="60" height="60" alt="vlad_soad" data-default="https://beesm.art/wp-content/plugins/ultimate-member/assets/img/default_avatar.jpg" onerror="if ( ! this.getAttribute('data-load-error') ){ this.setAttribute('data-load-error', '1');this.setAttribute('src', this.getAttribute('data-default'));}">										</div>
										<h3 class="author-name">
											vlad_soad										</h3>
									</div>
									<div class="type-of-post"><img class="post_type_icon" src="https://beesm.art/wp-content/uploads/2021/11/Hobby.svg" alt="post type"></div>
								</div>

								<div class="post-thumbnail"><img width="100" height="100" src="https://beesm.art/wp-content/uploads/2022/02/hum-aid-100x100.jpg" class="gmw-image wp-post-image" alt="" loading="lazy"></div>
								<div class="top-wrapper">	
									<div class="title-wrapper">
										<h2 class="post-title">
											<a href="https://beesm.art/%d0%b7%d0%b1%d0%b8%d1%80%d0%b0%d1%94%d0%bc%d0%be-%d0%b3%d1%83%d0%bc%d0%b0%d0%bd%d1%96%d1%82%d0%b0%d1%80%d0%bd%d1%83-%d0%b4%d0%be%d0%bf%d0%be%d0%bc%d0%be%d0%b3%d1%83-%d0%b4%d0%bb%d1%8f-%d0%b1%d1%96/">
												<?php  the_title(); ?>
											</a>
																					</h2>
									</div>
									<span class="address">
								<div class="cont-flg">India<span><img src="https://beesm.art/wp-content/uploads/2021/11/Flag_of_Ukraine_pantone_colors-1.png"></span>
										</div>
									</span>
									<div class="sr-item-description">
																				<!--?php// the_excerpt(); ?-->
										<div class="gmw-excerpt excerpt"><p><?php echo wp_trim_words( get_the_content(), 5, '...' );?> <a href="https://beesm.art/%d0%b7%d0%b1%d0%b8%d1%80%d0%b0%d1%94%d0%bc%d0%be-%d0%b3%d1%83%d0%bc%d0%b0%d0%bd%d1%96%d1%82%d0%b0%d1%80%d0%bd%d1%83-%d0%b4%d0%be%d0%bf%d0%be%d0%bc%d0%be%d0%b3%d1%83-%d0%b4%d0%bb%d1%8f-%d0%b1%d1%96/" class="gmw-more-link">…</a></p>
											<div class="um-clear">
												<a href="javascript:void(0);" class="um-user-bookmarks-button um-user-bookmarks-add-button" data-post="5817" data-um_user_bookmarks_id="5817" data-user="197">
													<i class="um-faicon-bookmark-o"></i>
														</a>
											</div>
											</div>									
											</div>
								</div>
								<div class="get-directions-link">
																	</div>
							</div>

							

														<div class="card-wrapper">
								<div class="honey-block">
									<div class="love"><input id="post_5817" type="checkbox" class="LoveCheck">
                <label for="post_5817" class="dashicons dashicons-heart LoveLabel" aria-label="like this"></label><span class="LoveCount">0</span></div><!--/love-->								</div>
								<div class="time-block">
									<span class="red-time">
										<div id="timer_<?php the_ID();?>" class="timer_block">
										  <span id="days_<?php the_ID();?>">27<span>d:</span></span>
										  <span id="hours_<?php the_ID();?>">00<span>h:</span></span>
										  <span id="minutes_<?php the_ID();?>">32<span>m</span></span>
										</div>
										<span>
																					</span>
										 <script type="text/javascript">
											$(document).ready(function(){  

											function makeTimer() {

											var endTime = new Date("March 7, 2022 13:31:32");
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

											$("#days_<?php the_ID();?>").html(days + "<span>d:</span>");
											$("#hours_<?php the_ID();?>").html(hours + "<span>h:</span>");
											$("#minutes_<?php the_ID();?>").html(minutes + "<span>m</span>");

											}  

											setInterval(function() { makeTimer(); }, 1000);

											});  

										   </script>
										<div id="timer">
													  <span id="days"></span>
													  <span id="hours"></span>
													  <span id="minutes"></span>
												</div>																				<!-- in: <a href="https://beesm.art/category/social/" rel="category tag">Social</a> -->
									</span>
								</div>
								<div class="bees-block">
									0									<img src="https://beesm.art/wp-content/uploads/2021/12/Bee.svg" alt="comments">
								</div>
						</div>
							</div>
					</li>
 <?php
 endwhile; 
endif; wp_reset_postdata(); 
?>
</ul>
</div>
</div>
</div>
<?php
get_footer();
?>
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

a.view-more-btn {
	color: #fff;
	text-decoration: none;
}
.cp_popup_content {
	transform: scale(0.8);
	position: relative;
	top: -30px;
	border-radius: 20px;
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
.page-id-6072 div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .single-post .post-thumbnail{
width:100% !important;
}
.page-id-6072 div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post{
width:31%! important;
}
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