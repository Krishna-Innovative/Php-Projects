<div class="header-footer-custom">
    <?php $directoryURI = $_SERVER['REQUEST_URI'];
    $path = parse_url($directoryURI, PHP_URL_PATH);
    $components = explode('/', $path);

    $first_part = $components[1];
    /* echo $disname = "https://staging2.beesm.art/user/$current_user->display_name/?profiletab=messages&conversation_id=3";
            echo $booknark = "https://staging2.beesm.art/user/$current_user->display_name/?profiletab=bookmarks"; */ ?>


    <div id="cutom_frontend_sidebar" class="cutom_frontend-sidebar cols-custom-toggle">
        <div class="menu-dashboard-container">
            <ul class="dashboard_menu">
                <li class="menu-item <?php if ($first_part == "post-form") {
                                            echo "active_custom_menu";
                                        } ?>">
                    <a href="<?php echo esc_url(home_url('')); ?>/create-post/">
                        <button data-type="shadow" onclick="window.location.href='/create-post/'" class="click_animation pb-2">
                            <img data-type="shadow" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Create1.png">
                            <span data-type="shadow">Create</span>
                        </button>
                    </a>
                </li>
                <li class="menu-item dynamic_feed" style="padding-bottom:20px;">
                    <?php
                    global $wpdb;
                    $current_user = wp_get_current_user();
                    $current_user_id = $current_user->ID;
                    //echo $current_user_id.'++';
                    $resulted_feed = $wpdb->get_results("SELECT * FROM wp_um_followers where user_id1 =$current_user_id");
                    ?>
                    <div class="adminActions">
                        <!--<input type="checkbox" name="adminToggle" class="adminToggle" />-->
                        <a href="<?php echo esc_url(home_url('')); ?>/user/<?php echo $current_user->ID; ?>/#feeds">
                            <button data-type="shadow" class="click_animation pb-1" onclick="window.location.href='<?php echo esc_url(home_url('')); ?>/user/<?php echo $current_user->ID; ?>/#feeds'"><img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Feeds1.png"> <span data-type="shadow">Feeds</span></button>
                        </a>
                        <div class="adminButtons">
                            <?php
                            $feed = 1;
                            foreach ($resulted_feed as $assigned_feed) {
                                $user_id2 = $assigned_feed->user_id2;
                                $other_feed = $wpdb->get_results("SELECT * FROM wp_save_feed where user_id =$user_id2");


                                foreach ($other_feed as $listed_feed) {
                                    $user_decode_id = $listed_feed->save_feed_id;
                                    $new_user_listing = $listed_feed->other_id;
                                    $i = 0;
                                    //echo '<pre>';print_r(unserialize($new_user_listing));
                                    foreach (unserialize($new_user_listing) as $new_fields) {
                                        //echo '<pre>';print_r($new_fields);
                                        if ($current_user_id == $new_fields['user_id']) {
                                            $i++;
                                            $base64 = base64_encode($user_decode_id);
                            ?>
                                            <button data-type="shadow" class="click_animation pb-1" onclick="window.location.href='<?php echo site_url() . '/search-result/?query=' . $base64; ?>'" title="#Feed <?php echo $i; ?>"><img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/image_2022_03_11T10_02_05_006Z.png"></button>
                            <?php
                                        }
                                    }
                                    $feed++;
                                }
                            }

                            ?>
                        </div>
                    </div>
                </li>
            </ul>
			<div class="subchild">
            <?php
            $current_user = wp_get_current_user();
            $current_user_id = $current_user->ID;
            $userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
			$userfeeds=array_sort($userfeeds, 'position_order', SORT_DESC);
				if(empty($userfeeds)){
					$userfeeds = get_user_meta($current_user_id, 'beesmart-filter-feed-options', true);
				}
            foreach ($userfeeds as $user_feed) {
                $feed_have = $user_feed['feed_have'];
                $feed_id = $user_feed['feed_id'];
                $parent_visibility_feed_id = $user_feed['parent_visibility_feed_id'];
                if ($parent_visibility_feed_id == "1") {
                    $non_clickable = "disable not_clickable";
                    $decoded_id = site_url();
                } else {
                    $non_clickable = "";
                    $decoded_id = site_url() . '/feeds/?feed_id=' . base64_encode($feed_id);
                }
            ?>
                <div class="sidebar_custom_submenu" id="side_feed<?php echo $feed_id;?>">
                    <div class="show_feed_btn">
                        <a href="<?php echo $decoded_id; ?>">
                            <button data-type="shadow" onclick="window.location.href='<?php echo $decoded_id; ?>'" class="p-0 click_animation <?php echo $non_clickable; ?>">
                                <img data-type="shadow" width="30" src="<?php echo get_template_directory_uri() . '/images/' . $feed_have; ?>">
                                <span data-type="shadow" class="highlight_custom_menu"><?php echo $user_feed['feedname']; ?></span>
                            </button>
                        </a>
                    </div>
                </div>
            <?php } ?>
			</div>
        </div>
    </div>
</div>