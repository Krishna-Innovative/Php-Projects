<?php
?>
<header class="profile-header">
    <?php
    $current_user_meta =  get_user_meta(idCurrentUser);
    ?>
    <div class="cover_img">
        <?php apply_filters('previewRender', $current_user_meta['user_cover_image_url'][0]); ?>
    </div>
    <div class="user-detail">
        <div class="user-photo">
            <?php do_action('current_user_url_avatar'); ?>
        </div>
        <div class="user-name">
            <p><?php //echo $some_user_full_name; 
                ?></p>
        </div>
        <div class="user_icon">
            <?php
            // do_action('is_current_user_verified');
            do_action('current_user_type_icon');
            ?>
        </div>
    </div>
</header>