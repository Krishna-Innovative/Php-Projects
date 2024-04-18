<?php
/*Template name:homepage login*/
get_header();
$url = site_url();
$logged_user_url = $url . '/login';
if (!is_user_logged_in()) {
	//header("Location: $logged_user_url");
}else{
	header("Location: $url");
}
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/user.css">


<div class="inner_main_page_section_cls bg_light inner_main_page_wapper" id="post-1691">
	<div class="container">
		<div class="profile_page">
			<header class="profile-header">
				<div class="dummy_icon">
					<img class="img-fluid" src="<?php echo imgPATH; ?>Bee.png" alt="img">
				</div>
				<div class="cover_img">
					<img class="user-coverImage" src="<?php echo imgPATH; ?>Placeholder-LP-image-scaled.jpg" alt="img">
				</div>

				<div class="user-detail">
					<div class="user-name">
						<p></p>
					</div>
					<!-- <div class="user_icon">
						<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/dont.png" class="d-none">
						<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/dont.png" alt="img">
					</div> -->
				</div>
				<h4 class="text-center">BEEsmart</h4>
			</header>

			<div class="profile_tabs">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<button data-type="shadow" class="nav-link click_animation" id="shared-tab" data-toggle="tab" href="#shared" role="tab" aria-controls="shared" aria-selected="false">
							<img data-type="shadow" src="<?php echo imgPATH; ?>Shared-tab.png">
							<span data-type="shadow">Shared</span>
						</button>
					</li>
					<li class="nav-item">
						<button data-type="shadow" class="nav-link click_animation" id="backpack-tab" data-toggle="tab" href="#backpack" role="tab" aria-controls="backpack" aria-selected="false">
							<img data-type="shadow" src="<?php echo imgPATH; ?>Backpack.png">
							<span data-type="shadow">Backpack</span>
						</button>
					</li>
					<li class="nav-item">
						<button data-type="shadow" class="nav-link click_animation" id="feeds-tab" data-toggle="tab" href="#feeds" role="tab" aria-controls="feeds" aria-selected="false">
							<img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Feeds1.png">
							<span data-type="shadow">Feeds</span>
						</button>
					</li>
					<li class="nav-item">
						<button data-type="shadow" class="nav-link click_animation" id="buzz-tab" data-toggle="tab" href="#buzz" role="tab" aria-controls="buzz" aria-selected="false">
							<img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/User-Profile-Buzz-tab.png">
							<span data-type="shadow">Buzz</span>
						</button>
					</li>
					<li class="nav-item">
						<button data-type="shadow" class="nav-link active click_animation" id="hive-tab" data-toggle="tab" href="#hiveinfo" role="tab" aria-controls="info" aria-selected="true">
							<img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png">
							<span data-type="shadow">Hives</span>
						</button>
					</li>
					<li class="nav-item">
						<button data-type="shadow" class="nav-link click_animation" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">
							<img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Find1-1.png">
							<span data-type="shadow">Friends</span>
						</button>
					</li>
					<li class="nav-item">
						<button data-type="shadow" class="nav-link click_animation" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">
							<img data-type="shadow" src="<?php echo imgPATH; ?>Bio.png">
							<span data-type="shadow">Bio</span>
						</button>
					</li>
				</ul>

				<div class="profile_inner_box">
					<div class="login_tab p-2">
						<div class="row m-0 align-items-center">
							<div class="col-12 text-center">
								<a href="#" class="signup_btn" data-target="#login-modal" data-toggle="modal" data-type="shadow">Log in</a>
								<a href="/signup" class="signup_btn ml-3" data-type="shadow">Sign up</a>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-content mt-0" id="myTabContent">
					<div class="tab-pane fade" id="shared" role="tabpanel" aria-labelledby="shared-tab">
						<div class="info_body px-4 mt-5">
							<div class="info_post">
								<img src="<?php echo imgPATH; ?>Shared-tab.png" class="postleft_icon" alt="img">
								<div class="container-resposne">
									<img src="https://i.ytimg.com/vi/XZ868t23Pb4/maxresdefault.jpg" alt="img">
								</div>
								<img src="<?php echo imgPATH; ?>Info.png" class="postright_icon" alt="img">
							</div>
							<div class="feture-1 feture">
								<img src="<?php echo imgPATH; ?>Shared1.png" alt="feature 1">
								<span>Your active content</span>
							</div>
							<div class="feture-2 feture">
								<span>Make more content by selecting 'Create' on the left-hand menu</span>
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="feature 2">
							</div>
							<div class="feture-3 feture">
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Share2.png" alt="feature 3">
								<span>Share content form across many platforms</span>
							</div>
						</div>
					</div>
					<div class="tab-pane fade show" id="backpack" role="tabpanel" aria-labelledby="backpack-tab">
						<div class="info_body px-4 mt-5">
							<div class="info_post">
								<img src="<?php echo imgPATH; ?>Backpack.png" class="postleft_icon" alt="img">
								<div class="container-resposne">
									<img src="https://i.ytimg.com/vi/XZ868t23Pb4/maxresdefault.jpg" alt="img">
								</div>
								<img src="<?php echo imgPATH; ?>Info.png" class="postright_icon" alt="img">
							</div>
							<div class="feture-1 feture">
								<img src="<?php echo imgPATH; ?>Backpack.png" alt="feature 1">
								<span>Put stuff in your backpack</span>
							</div>
							<div class="feture-2 feture">
								<span>Share your backpack with others</span>
								<img src="<?php echo imgPATH; ?>Backpack2-Feeds2.png" alt="feature 2">
							</div>
							<div class="feture-3 feture">
								<img src="<?php echo imgPATH; ?>Backpack3.png" alt="feature 3">
								<span>Create folders to organise your backpack</span>
							</div>
						</div>
					</div>
					<div class="tab-pane fade show" id="feeds" role="tabpanel" aria-labelledby="feeds-tab">
						<div class="info_body px-4 mt-5">
							<div class="info_post">
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Feeds1.png" class="postleft_icon" alt="img">
								<div class="container-resposne">
									<img src="https://i.ytimg.com/vi/XZ868t23Pb4/maxresdefault.jpg" alt="img">
								</div>
								<img src="<?php echo imgPATH; ?>Info.png" class="postright_icon" alt="img">
							</div>
							<div class="feture-1 feture">
								<img src="<?php echo imgPATH; ?>Feeds1-1.png" alt="feature 1">
								<span>No algorithm or manipulation</span>
							</div>
							<div class="feture-2 feture">
								<span>Share your feeds with friends</span>
								<img src="<?php echo imgPATH; ?>Backpack2-Feeds2.png" alt="feature 2">
							</div>
							<div class="feture-3 feture">
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Blue-Sort.png" alt="feature 3">
								<span>See what you want, when you wany</span>
							</div>
						</div>
					</div>
					<div class="tab-pane fade show" id="buzz" role="tabpanel" aria-labelledby="buzz-tab">
						<div class="info_body px-4 mt-5">
							<div class="info_post">
								<img src="<?php echo imgPATH; ?>Bee.png" class="postleft_icon" alt="img">
								<div class="container-resposne">
									<img src="https://i.ytimg.com/vi/XZ868t23Pb4/maxresdefault.jpg" alt="img">
								</div>
								<img src="<?php echo imgPATH; ?>Info.png" class="postright_icon" alt="img">
							</div>
							<div class="feture-1 feture">
								<img src="<?php echo imgPATH; ?>Buzz1.png" alt="feature 1">
								<span>Share your thoughts and feelings</span>
							</div>
							<div class="feture-2 feture">
								<span>Gain Honey for leaving Buzz</span>
								<img src="<?php echo imgPATH; ?>Buzz2.png" alt="feature 2">
							</div>
							<div class="feture-3 feture">
								<img src="<?php echo imgPATH; ?>Buzz3.png" alt="feature 3">
								<span>Show your support</span>
							</div>
						</div>
					</div>
					<div class="tab-pane active fade show" id="hiveinfo" role="tabpanel" aria-labelledby="hive-tab">
						<div class="info_body px-4 mt-5">
							<div class="info_post">
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" class="postleft_icon" alt="img">
								<div class="container-resposne">
									<img src="https://i.ytimg.com/vi/XZ868t23Pb4/maxresdefault.jpg" alt="img">
								</div>
								<img src="<?php echo imgPATH; ?>Info.png" class="postright_icon" alt="img">
							</div>
							<div class="feture-1 feture">
								<img src="<?php echo imgPATH; ?>Hives1.png" alt="feature 1">
								<span>Group Similar interests together</span>
							</div>
							<div class="feture-2 feture">
								<span>Sort creators the way you want</span>
								<img src="<?php echo imgPATH; ?>Hives2-1.png" alt="feature 2">
							</div>
							<div class="feture-3 feture">
								<img src="<?php echo imgPATH; ?>Hives3.png" alt="feature 3">
								<span>Use Hives to create dynamic Feeds</span>
							</div>

						</div>
					</div>

					<div class="tab-pane fade show" id="friends" role="tabpanel" aria-labelledby="friends-tab">
						<div class="info_body px-4 mt-5">
							<div class="info_post">
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Find1-1.png" class="postleft_icon" alt="img">
								<div class="container-resposne">
									<img src="https://i.ytimg.com/vi/XZ868t23Pb4/maxresdefault.jpg" alt="img">
								</div>
							</div>
								<img src="<?php echo imgPATH; ?>Info.png" class="postright_icon" alt="img">
							</div>
							<div class="feture-1 feture">
								<img src="<?php echo imgPATH; ?>Friends1-1.png" alt="feature 1">
								<span>Find freinds and add them</span>
							</div>
							<div class="feture-2 feture">
								<span>if they accept, you will be added to one another's lists</span>
								<img src="<?php echo imgPATH; ?>Friends2.png" alt="feature 2">
							</div>
							<div class="feture-3 feture">
								<img src="<?php echo imgPATH; ?>Friends3.png" alt="feature 3">
								<span>If both accounts are verified, you can chat together</span>
							</div>

						</div>
					</div>

					<div class="tab-pane fade show" id="info" role="tabpanel" aria-labelledby="info-tab">
						<div class="info_body px-4 mt-5">
							<div class="info_post">
								<img src="<?php echo imgPATH; ?>Bio.png" class="postleft_icon" alt="img">
								<div class="container-resposne">
									<img src="https://i.ytimg.com/vi/XZ868t23Pb4/maxresdefault.jpg" alt="img">
								</div>
								<img src="<?php echo imgPATH; ?>Info.png" class="postright_icon" alt="img">
							</div>
							<div class="feture-1 feture">
								<img src="<?php echo imgPATH; ?>Bio1.png" alt="feature 1">
								<span>Your bio can show all kinds of content and lasts forever</span>
							</div>
							<div class="feture-2 feture">
								<span>Share here what makes you special</span>
								<img src="<?php echo imgPATH; ?>Bio2.png" alt="feature 2">
							</div>
							<div class="feture-3 feture">
								<img src="<?php echo imgPATH; ?>Bio3.png" alt="feature 3">
								<span>Filling out your bio will show others why they should follow you</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Login Modal -->

<div id="login-modal" class="modal fade custom_trsparent_modal login_modal">
	<div class="modal-dialog">
		<div class="modal-content m-custom">
			<!-- Modal body -->
			<div class="modal-body info_body p-0">
				<div class="login_tabform">
					<h4 class="sign_heading">Sign in</h4>
					<input type="text" class="form-control mb-3" id="login_email" placeholder="Enter Your Email" />
					<input type="password" class="form-control" id="login_password" placeholder="Enter Your Password" />
					<div class="text-center"><a href="#" class="restpwd">Reset Password</a></div>
					<div class="text-center mt-3">
						<button class="btn login_btn p-0" type="button" data-type="shadow" id="submit_login">
							<img width="65" data-type="shadow" src="<?php echo imgPATH; ?>/Check.png" class="hover_hue">
						</button>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-center">
				<a class="close_sticker hover_hue" data-dismiss="modal">
					<img src="<?php echo imgPATH; ?>X.png">
				</a>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
?>