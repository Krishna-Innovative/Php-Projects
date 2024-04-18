<li id="single-post-<?php echo absint($post->ID); ?>" class="single-post <?php echo $args; ?>">
    <div class="wrapper-inner">
        <?php //do_action('gmw_search_results_loop_item_start', $gmw, $post); 
        ?>
        <div class="post-content">
            <?php //do_action('gmw_posts_loop_before_image', $gmw, $post); 
            ?>
            <?php oc_popup_post_button(); ?>
            <div class="author-wrapper ">
                <div class="addHive-block">
                    <?php global $wpdb;
					$user_id = get_post_field( 'post_author', $post->ID );
                    //$user_id = $post->post_author;
					//echo $user_id.'sdafgreg';



                    
			$current_user_id = idCurrentUser;
                    if ($user_id != $current_user_id) { ?>
                        <button data-type="addhive" type="button" @click="toggle" class="click_animation hover_hue hivvdropdown_button" data-feed-id="<?php echo absint($post->ID); ?>">
                            <img data-type="addhive" src="<?php echo imgPATH ?>Add-to-hive.png">
                        </button>
                        <div class="hivvdropdown hive_option_<?php echo absint($post->ID); ?> hidden">
                            <div class="hivvdropdown_search">
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" class="hive_icon">
                                <input type="text" class="form-control">
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/search.png" class="search_icon">
                            </div>
                            <ul class="hivvdropdown_list" id="list_of_checkbox<?php echo absint($post->ID); ?>" data-id="<?php echo $user_id;?>">
                                <?php
                                // do_action('the_own_hive_list');
                                ?>
                                <?php
                                $find_selected_category = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower WHERE user_id=$current_user_id");
								//echo '<pre>';print_r($find_selected_category);
                                foreach ($find_selected_category as $selected_categories) {
                                    $categories_id = $selected_categories->follower_cat_id;
                                    $selected_ids = explode(',', $categories_id);
                                    for ($i = 0; $i < count($selected_ids); $i++) {
                                        $find_images = $wpdb->get_results("SELECT * FROM wp_category_created_by_author WHERE `category_value`='" . $selected_ids[$i] . "' And author_id='" . $current_user_id . "'");
                                        //echo '<pre>';print_r($find_images);
                                        foreach ($find_images as $selected_image) {
                                            $final_category_stickers = $selected_image->category_icons;
                                            $category_value = $selected_image->category_value;
                                        }
                                        $resulted_stickers[] = $final_category_stickers;
                                        $resulted_category_value[] = $category_value;
                                    }
                                    if (empty($resulted_stickers)) {
										//echo '<pre>';print_r($resulted_stickers);
                                        $site_url = site_url();

                                        $url = $site_url . '/wp-content/uploads/2022/05/Hives-Sort-later.png';
                                        $new_images = '<img src="' . $url . '">';
                                ?>
                                        <li class="nav-item">
                                            <input type="checkbox" id="hive_<?php echo $post->ID.''.$resulted_category_value[$i];?>" name="" value="<?php echo $resulted_category_value[$i];?>">
                                            <label for="hive<?php echo $post->ID.''.$resulted_category_value[$i];?>">
                                                <?php echo $new_images; ?>
                                                <span><?php echo $category_name1; ?></span>
                                            </label>
                                            <input type="checkbox" id="<?php echo $resulted_category_value[$i];?>" name="" value="<?php echo $resulted_category_value[$i];?>">
                                        </li>
                                        <?php
                                    } else {
										//echo '<pre>';print_r($resulted_stickers);
                                        for ($i = 0; $i < count($resulted_stickers); $i++) {
                                            $new_images = '<img src=/images/' . $resulted_stickers[$i] . '>';
                                            $resulted_category_name =  get_cat_name($resulted_category_value[$i]);
                                        ?>

                                            <li class="nav-item">
                                                <input type="checkbox" id="hive<?php echo $post->ID.''.$resulted_category_value[$i];?>" name="<?php echo $resulted_category_value[$i];?>" value="<?php echo $resulted_category_value[$i];?>">
                                                <label for="hive<?php echo $post->ID.''.$resulted_category_value[$i];?>">
                                                    <?php echo $new_images; ?>
                                                    <span><?php echo $resulted_category_name; ?></span>
                                                </label>
                                                <input type="checkbox" id="<?php echo $resulted_category_value[$i];?>" name="<?php echo $resulted_category_value[$i];?>" value="<?php echo $resulted_category_value[$i];?>">
                                            </li>
                                <?php
                                        }
                                    }
                                }
                                ?>

                            </ul>
							<button class="hover_hue click_animation p-0 hivedrop_down_button" data-type="shadow" >
								<img src="<?php echo site_url();?>/wp-content/themes/beesmart-main/assets/images/Check.png" data-type="shadow" width="60" data-id="<?php echo absint($post->ID); ?>">
							</button>
                        </div>
                    <?php } ?>
                </div>

                <div class="author_block_cnt addHive-block d-none">
                    <!--<h3 class="author-name mb-0"></h3> -->
                    <?php
                   // $author_id = $post->post_author;
                    global $wpdb;
                    $current_user = wp_get_current_user();
                    $current_user_id = $current_user->ID;
                    $new_listing = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower where follower_id =$user_id and user_id=$current_user_id");
                    $follower_cat_id = $new_listing[0]->follower_cat_id;

                    if ($user_id != $current_user_id) {
                        $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
                        if (!empty($author_category_listing)) {
                            $category = array();
                            foreach ($author_category_listing as $category_listing) {
                                $category[] = $category_listing->category_value;
                            } ?>
                            <select class="add_select selected_category_value custom_select">
                            <?php
                            $category_data = '<option value="0" data-u-id="' . $selected_id . '" selected>....</option>';
                            foreach ($category as $category) {
                                if ($follower_cat_id == $category) {
                                    $selected = 'selected';
                                    $category_detail = get_cat_name($category);
                                    $category_data .= '<option value="' . $category . '" data-id="' . $author_id . '" ' . $selected . '>' . $category_detail . '</option>';
                                } else {
                                    $category_detail = get_cat_name($category);
                                    $category_data .= '<option value="' . $category . '" data-u-id="' . $author_id . '">' . $category_detail . '</option>';
                                }
                            }
                        }
                        echo $category_data;
                            ?>
                            </select>
                        <?php
                    }
                        ?>
                </div>
                <div class="author-block">
                    <?php //echo get_user_meta( $author_id, 'user_avatar_url', true ); ?>
                    <div class="author-img">
                        <?php
                        global $post;
                        $author_id = $post->post_author;
						$authorname=get_the_author_meta('user_nicename');
                        $author_meta = get_user_meta($author_id);
                        $author_avatar = get_user_meta( $author_id, 'user_avatar_url', true );
                        ?>
                         <a href='<?php echo site_url(); ?>/author/<?php echo $authorname; ?>' target='_blank'>
                            <?php $arg_for_author_avatar = ['someField' => $author_avatar,'type' => 'html' ]; ?>
                            <?php 
                            if ($author_avatar){
                                do_action('previewRenderTest', $arg_for_author_avatar);
                            }
                            else{
                                echo "<img  src='https://cdn1.iconfinder.com/data/icons/user-pictures/100/unknown-512.png'>";
                            }
                            ?>
                        </a> 
                    </div>
                </div>
                <div class="type-of-post">
                    <?php
                    //do_action('is_author_verified');
                    do_action('author_type');
                    ?>
                </div>
            </div>
            <div class="loading"></div>

            <div class="container-resposne_main">
                <div class="container-resposne">
                    <?php 
                    $post_meta = get_post_meta(get_the_ID());
                    $arg_for_post_preview = ['someField' => $post_meta['f_url'][0],'type' => 'html' ];
                    do_action('previewRenderTest', $arg_for_post_preview);
                    ?>
                </div>
            </div>

            <div class="top-wrapper">
                <div class="title-wrapper">
                    <h2 class="post-title">

                        <a href="<?php echo get_the_title(); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                        <?php // oc_popup_post_button(); 
                        ?>
                    </h2>
                </div>

                <div class="card-wrapper">
                    <div class="honey-block">
                        <?php echo do_shortcode('[love_me]'); ?>
                    </div>
                    <?php get_template_part('template-parts/components/timer'); ?>

                    <div class="bees-block">
                        <?php //echo get_comments_number(); 
                        ?>
                        <?php echo do_shortcode('[post-views]'); ?>
                        <img src="/wp-content/uploads/2022/02/Most-Views.png" alt="comments">
                    </div>
                </div>
            </div>
</li><!-- #post -->
