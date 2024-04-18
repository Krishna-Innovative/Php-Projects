<?php
// for author 
global $post;
$author_id = $post->post_author;
$author_meta = get_user_meta($author_id);
// for user
$user_meta = get_user_meta(um_profile_id());
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($actual_link);
//echo $parts.'parts';
parse_str($parts['query'], $query);
// for feed owner

?>

<header class="profile-header">
    <?php //debug($user_meta);  ?>
    <div class="cover_img">
        <?php if ($query['um_action']== 'edit' || is_page_template('landing-after-email-verification.php') || is_page_template('main-sample.php')) { ?>
            <button type="button" class="btn_addcover change-cover-photo" data-toggle="modal" data-target="#upload-cover-image">
                <img data-image="upload-url-avatar" class="add-icon" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="add" />
            </button>
        <?php } ?>
        <div class="cover-container user-coverImage">
            <?php
            if (is_single()) {
                apply_filters('previewRender', $author_meta['user_cover_image_url'][0]);
            } else {
                if($user_meta['user_cover_image_url'][0] != ''){
                    apply_filters('previewRender', $user_meta['user_cover_image_url'][0]);
                }
                else {
                    echo '<img src="'.imgPATH.'giphy.gif" alt="avatar" />';
                }
            }
            ?>
        </div>
    </div>

    <div class="user-detail">
        <div class="user-photo">
            <?php if ($query['um_action']=='edit' || is_page_template('landing-after-email-verification.php') || is_page_template('main-sample.php')) { ?>
                <button type="button" class="btn_addavatar change-avatar" data-toggle="modal" data-target="#upload-url-avatar">
                    <img data-image="upload-cover-image" class="add-icon" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="add" />
                </button>
            <?php } ?>
            <div class="user-avatar">
                <?php
                if (is_single()) {
                    apply_filters('previewRender', $author_meta['user_avatar_url'][0]);
                } 
                else {
                    if($user_meta['user_avatar_url'][0] == ''){
                        echo '<img src="'.imgPATH.'giphy.gif" alt="avatar" />';
                    } 
                    else {
                        // apply_filters('previewRender', $user_meta['user_avatar_url'][0]);

                        $arg = [
                            'someField' => $user_meta['user_avatar_url'][0],
                            'type' => 'thumbnail_url' 
                        ];
                        // var_dump(apply_filters('previewRender', $user_meta['user_avatar_url'][0]));
                        // debug($args);
                        do_action('previewRenderTest', $arg);
                       } 
                    }
                ?>
            </div>
        </div>
        <div class="user_icon">
            <?php
            if (is_single()) {
                // do_action('is_author_verified');
                do_action('author_type');
            } else {
                // do_action('is_user_verified', umID);
                do_action('user_type', umID);
            }
            ?>
        </div>
    </div>
    <?php if (is_single()) { ?>
        <h4 class="text-center"><?php do_action('author_nickname'); ?></h4>
    <?php } else { ?>
        <h4 class="text-center"><?php do_action('user_nickname', umID); ?></h4>
    <?php } ?>
</header>
