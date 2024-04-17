<?php
$args = 'col-12';
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/feed-page.css">
<div class="tab-pane fade" id="shared" role="tabpanel" aria-labelledby="shared-tab">
    <?php 
	$author_id = get_the_author_ID();
	$current_user = wp_get_current_user();
    $current_user_id = $current_user->ID;
	if ($author_id == $current_user_id) { ?>
	<div class="add-info-updated">
		<div class="feeds-tab_add shared-post_add">
				<div class="row align-items-center">
					<div class="col-5">
						<div class="shared_tab_left_icon">
							<div class="shared_tab_honey mr-4">
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Honey64A.png" />
								<span>54.2k</span>
							</div>
							<div class="shared_tab_bee">
								<img src="<?php echo imgPATH; ?>Bee.png" />
								<span>33.9k</span>
							</div>
						</div>
					</div>
					<div class="col-2"></div>
					<div class="col-5">
						<div class="sorting_feed">
							<select class="custom_select">
								<option selected="" disabled="">Sort by</option>
								<option>Last activity</option>
								<option>Most followers</option>
								<option>A-Z</option>
								<option>Z-A</option>
							</select>
						</div>
					</div>
				</div>
			</div>
	</div>
        <div class="profile-posts-section">
            <ul class="posts-list-wrapper row">
                <?php
                $current_user = wp_get_current_user();
                $current_user_id = $current_user->ID;
                
                $myId = get_current_user_id();
                $userPosts = new WP_Query([
                    'post_type' => 'beeart',
                    'post_status' => 'publish',
                    'author' => $author_id
                ]);
                if ($userPosts->have_posts()) {
                    while ($userPosts->have_posts()) {
                        $userPosts->the_post();
                        get_template_part('template-parts/components/post-cart', '', $args); 
                    }
                } else {
                    echo 'No User Feed Found';
                }
                wp_reset_postdata();
                ?>
            </ul>
        </div>
        <?php
    }  else {
        $results = $wpdb->get_results("SELECT * FROM wp_um_followers where user_id1 =$current_user_id And user_id2=$author_id");
        if (empty($results)) { ?>
		<div class="feeds-tab_add shared-post_add disable unfollowed_user add-info-updated">
				<div class="row align-items-center">
					<div class="col-5">
						<div class="shared_tab_left_icon">
							<div class="shared_tab_honey mr-4">
								<img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Honey64A.png" />
								<span class="color-gray text-bold">###</span>
							</div>
							<div class="shared_tab_bee">
								<img src="<?php echo imgPATH; ?>Bee.png" />
								<span class="text-bold">###</span>
							</div>
						</div>
					</div>
					<div class="col-2"></div>
					<div class="col-5">
						<div class="sorting_feed">
							<select class="custom_select" disabled>
								<option selected="" disabled="">Sort by</option>
								<option>Last activity</option>
								<option>Most followers</option>
								<option>A-Z</option>
								<option>Z-A</option>
							</select>
						</div>
					</div>
				</div>
			</div>
                <div class="follow-block followblock_section">
                    <?php get_template_part( 'template-parts/components/dropdown_hive' ); ?>
				</div>            
            <?php  } else {
				?>
          <div class="add-info-updated ">
			<div class="feeds-tab_add shared-post_add">
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="shared_tab_left_icon">
                        <div class="shared_tab_honey mr-4">
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Honey64A.png" />
                            <span>54.2k</span>
                        </div>
                        <div class="shared_tab_bee">
                            <img src="<?php echo imgPATH; ?>Bee.png" />
                            <span>33.9k</span>
                        </div>
                    </div>
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <div class="sorting_feed">
                        <select class="custom_select">
                            <option selected="" disabled="">Sort by</option>
                            <option>Last activity</option>
                            <option>Most followers</option>
                            <option>A-Z</option>
                            <option>Z-A</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
		</div>
			<?php
            $current_user = wp_get_current_user();
            $current_user_id = $current_user->ID;
            $userId = um_profile_id();
            $myId = get_current_user_id();
            $userPosts = new WP_Query([
                'post_type' => 'beeart',
                'post_status' => 'publish',
                'author' => $userId
            ]);
            if ($userPosts->have_posts()) {
                while ($userPosts->have_posts()) {
                    $userPosts->the_post();
            ?>
                    <div class="profile_single_post">

                        <div class="author-wrapper">
                            <div class="author-block">
                                <div class="author-img">
                                    <?php $user_meta = get_user_meta(um_profile_id()); ?>
                                    <a href="<?php echo site_url(); ?>/user/<?php the_author() ?>"> <?php apply_filters('previewRender', $user_meta['user_avatar_url'][0]); ?></a>
                                </div>
                                <div class="author_block_cnt">
                                    <h3 class="author-name"><a href="<?php echo site_url(); ?>/user/<?php the_author() ?>"><?php the_author() ?></a></h3>
                                    <a href="<?php echo get_field('f_url'); ?>"><?php echo get_field('f_url'); ?></a>
                                </div>
                            </div>
                            <div class="type-of-post">
                                <?php
                                global $wpdb;
                                $current_user = wp_get_current_user();
                                $current_user_id = $current_user->ID;
                                $user_verified = get_user_meta($current_user_id, '_um_verified', true);
                                if ($user_verified == "verified") {
                                    do_action('is_current_user_verified');
                                    do_action('current_user_type_icon');
                                } else {
                                    do_action('is_some_user_verified');
                                    do_action('some_user_type');
                                }
                                //  do_action('some_user_type');
                                ?>
                            </div>
                        </div>
                        <div class="post-thumbnail">
                            <input type="text" class="meta-preview" value="<?php echo get_field('f_url'); ?>">
                            <div class="loading"></div>
                            <div class="container-resposne">
                                <a href="<?php echo get_permalink(); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/not-fond.jpg" alt="loading"></a>

                            </div>
                        </div>
                        <div class="post-content">
                            <div class="top-wrapper">
                                <h2 class="post-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                                <p class="description">
                                    <?php
                                    if (the_excerpt()) {
                                        the_excerpt();
                                    } else {
                                        the_content();
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="card-wrapper">
                                <div class="honey-block">
                                    <?php echo do_shortcode('[love_me]'); ?>
                                </div>
                                <?php get_template_part('template-parts/components/timer'); ?>
                                <div class="bees-block">
                                    <?php echo do_shortcode('[post-views]'); ?>
                                    <div class="bee_icon">
                                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Most-Views.png" alt="bee" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <?php
                }
            }
        }
    }
    wp_reset_postdata();
    ?>
    <div class="tab_info_sec">
        <a href="#" data-target="#shared_info" data-toggle="modal">
            <img src="<?php echo imgPATH; ?>Info.png" alt="img">
        </a>
    </div>

</div>
