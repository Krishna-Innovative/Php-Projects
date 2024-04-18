<?php
// for author 
global $post;
$author_id = $post->post_author;
$author_meta = get_user_meta($author_id);
// for user
$user_meta = get_user_meta($author_id);

$current_user_meta = get_user_meta(get_current_user_id());
$feed_owner_meta = get_user_meta($args);
$user_meta = get_user_meta($args);
$user = get_user_by( 'id', $args );
$user_other_meta = get_user_meta($args);
$other_user_name=$user_other_meta['nickname'][0];
$usernicename=$user->user_nicename;
 $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = parse_url($actual_link);
//echo $parts.'parts';
parse_str($parts['query'], $query);
?>
<?php //get_template_part('template-parts/profile-page/info_popups'); ?>
<header class="profile-header">
    <?php //debug(get_user_meta(get_current_user_id())); ?>
    <?php
    get_template_part('template-parts/components/dropdown_hive') ?>

    <div class="user-photo">
        <?php if ($query['um_action']=='edit' || is_page_template('landing-after-email-verification.php')) { ?>
            <button type="button" class="btn btn-primary change-avatar" data-toggle="modal" data-target="#upload-url-avatar">
                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="add" />
            </button>
        <?php } ?>
        
        <div class="user-avatar">
            <?php
            // var_dump($avatar_data);
            $avatar_data = get_user_meta(get_current_user_id(), 'user_avatar_url', true );
            ?>
            <div data-append="user_avatar_url" style="transform:<?php echo $avatar_data['position']; ?>">
                <?php apply_filters('previewRender', $avatar_data['link']); ?>
            </div>
        </div>
    </div>
    <div class="cover_img">
        <?php if ($query['um_action']=='edit' || is_page_template('landing-after-email-verification.php')) { ?>
            <button type="button" class="btn btn-primary change-cover-photo " data-toggle="modal" data-target="#upload-cover-image">
                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="add" />
            </button>
        <?php } ?>
        <div class="cover-container user-coverImage">
        <?php 
        $cover_data = get_user_meta(get_current_user_id(), 'user_cover_image_url', true );
        // var_dump($cover_data);
        ?>
            <div data-append="user_cover_image_url" style="transform:<?php echo $cover_data['position']; ?>">
                <?php apply_filters('previewRender', $cover_data['link']); ?>
            </div>
            <!-- <?php
                // apply_filters('previewRender', $user_meta['user_cover_image_url'][0]);
              ?>  -->
        </div>
    </div>
    <div class="user-detail">
        <div class="user_icon">
            <?php
            if (is_single()) {
                // do_action('is_author_verified');
                do_action('author_type');
            } else {
                // do_action('is_user_verified');
                do_action('the_user_type', umID);
            }
            ?>
        </div>
    </div>
    <?php if (is_single()) { ?>
        <h4 class="text-center"><?php do_action('author_nickname'); ?></h4>
    <?php } else { ?>
        <h4 class="text-center"><?php echo $other_user_name; ?></h4>
    <?php } ?>
</header>
<?php if (um_is_on_edit_profile()) { ?>
<style>
    .profile_page .um-profile .um-header, .profile_page .um.um-profile {
        display: block!important;
    }
    .um-profile-body.main.main-default {
        display: block!important;
    }
    span.um-cover-overlay{
        display: none!important;
    }
</style>
<div class="edit_porfile_buttons">
    <div class="text-center">
       <a href="<?php echo esc_url(home_url('')); ?>/user/<?php echo get_current_user_id(); ?>/#info" class="hover_hue" data-type="shadow">
		  <img src="<?php echo imgPATH; ?>Check.png" data-type="shadow" width="65">
       </a>
    </div>
     <div class="tab_info_sec mt-3">
        <a href="#" data-target="#hives_info" data-toggle="modal">
            <img src="<?php echo imgPATH; ?>Info.png" alt="img">
        </a>
    </div>
</div>
<?php } ?>

