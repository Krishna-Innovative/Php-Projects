<header id="main-header">
    <div class="container clearfix et_menu_container">
        <div class="header-custom-inner">
            <?php
            $logo = the_custom_logo();

            // Get logo image size based on attachment URL.
            $logo_size = $logo;
            $logo_width = (!empty($logo_size) && is_numeric($logo_size[0]))
                ? $logo_size[0]
                : '93'; // 93 is the width of the default logo.
            $logo_height = (!empty($logo_size) && is_numeric($logo_size[1]))
                ? $logo_size[1]
                : '43'; // 43 is the height of the default logo.

            //	ob_start();
            ?>
            <div class="logo_container">
                <div class="hamburger">
                    <button class="hamburger-btn">
                        <img src="https://img.icons8.com/material-outlined/24/000000/menu--v3.png" />
                    </button>
                </div>
                <div class="logo-block">
                    <a href="<?php echo esc_url(home_url('')); ?>">
                        <button data-type="shadow" class="click_animation" onclick="window.location.href='<?php echo esc_url(home_url('')); ?>'" data="11">
                            <img data-type="shadow" src="<?php echo imgPATH; ?>Bee.png" width="50" height="50" alt="BeeSmart" id="logo" data-height-percentage="100" data-actual-width="307" data-actual-height="307" style="width: 50px! important;">
                            <!-- <h3>BEE<span>SMART</span></h3> -->
                        </button>
                    </a>
                </div>
            </div>
            <?php if (is_user_logged_in()) { ?>
                <div class="user-picture">
                    <div class="left">
                        <button data-type="shadow" class="menu-item honey click_animation" data-target="#honey" data-toggle="modal">
                            <img data-type="shadow" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Honey64A.png" alt="">
                        </button>
                        <button data-type="shadow" class="menu-item messeges click_animation" data-target="#share" data-toggle="modal">
                            <img data-type="shadow" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Share2.png" alt="">
                        </button>
                        <button data-type="shadow" class="menu-item notifications click_animation">
                            <img data-type="shadow" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Notif1.png" alt="">
                        </button>
                    </div>
                    <div class="right">
                        <div class="user_image_get profile_toggle_main">
                            <a data-append="user_avatar_url" data-type="shadow" class="um-profile-photo-img profile_toggle bees-a click_animation" title="user">
                                <?php
                                $avatar_data = get_user_meta(get_current_user_id(), 'user_avatar_url', true );
                                ?>
                                <div class="user_avatar_url-containet">
                                    <div data-append="user_avatar_url" style="transform:<?php echo $avatar_data['position']; ?>">
                                        <?php apply_filters('previewRender', $avatar_data['link']); ?>
                                    </div>
                                </div>
                                <?php
                                // $arg_for_current_user_avatar = ['someField' => get_user_meta( get_current_user_id(), 'user_avatar_url', true ),'type' => 'thumbnail_url' ];
                                // ?><!--<img src="<?php //do_action('previewRenderTest', $arg_for_current_user_avatar); ?>" alt="avatar" /> -->
                            </a>
                            <div id="profile_target">
                                <ul>
                                    <?php $user = wp_get_current_user(); ?>
                                    <li class="nav-item">
                                        <?php $loginuser = wp_get_current_user(); ?>
                                        <?php if ($loginuser->user_login) {
                                        } ?>
                                        <a data-append="user_avatar_url" class="nav-link um-profile-photo-img bees-a" href="<?php echo esc_url(home_url('')); ?>/author/<?php echo $loginuser->user_nicename ?>/#info">
                                            <div class="user_avatar_url-containet">
                                                <div data-append="user_avatar_url" style="transform:<?php echo $avatar_data['position']; ?>">
                                                    <?php apply_filters('previewRender', $avatar_data['link']); ?>
                                                </div>
                                            </div>                                            
                                            <span>My Bio</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-toggle="modal" data-target="#hive_manager">
                                            <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/02/Hive.png" class="menu_icons">
                                            Hive
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo esc_url(home_url('/account-page/')); ?>">
                                            <img src="/wp-content/uploads/2022/01/settings.png" class="menu_icons settings_icon">
                                            Options
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="<?php echo esc_url(add_query_arg('redirect_to', site_url('/signup'), um_get_core_page('logout'))); ?>">
                                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2021/11/logout-1.png" class="menu_icons logout_icons">
                                            Log Out
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="honey-popup">

                    </div>
                </div>
                <?php
            } else {
                if (is_page('login')) {
                    //echo 'sfssd';
                ?>
                    <div class="login_tab">
                        <!-- <a href="/login/" class="signup_btn">Login</a> -->
                        <a href="/signup/" class="signup_btn" data-type="shadow">Sign Up</a>
                    </div>
                <?php
                } elseif (is_page('signup')) {
                    //echo 'fdvdf';
                ?>
                    <div class="login_tab">
                        <a href="/login/" class="signup_btn" data-type="shadow">Login</a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="login_tab">
                        <!-- <a href="/login/" class="signup_btn">Login</a> -->
                        <a href="/signup/" class="signup_btn" data-type="shadow">Sign Up</a>
                    </div>
            <?php
                }
            }
            ?>

        </div>
    </div>

</header>
