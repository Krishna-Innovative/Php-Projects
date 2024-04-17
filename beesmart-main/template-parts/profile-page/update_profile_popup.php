<?php 
    // $current_user_meta =  get_user_meta(get_current_user_id());
    $avatar_data = get_user_meta(get_current_user_id(), 'user_avatar_url', true );
    $cover_data = get_user_meta(get_current_user_id(), 'user_cover_image_url', true );
?>
<!-- base -->
<div class="modal fade custom_trsparent_modal upload_modal" id="update-profile-popup" tabindex="-1" aria-labelledby="update-profile-popup" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <?php //get_template_part('template-parts/profile-page/profile_header'); ?>
                <header class="profile-header">
                    <div class="user-photo">
                        <!--  -->
                        <button type="button" class="btn btn-primary change-avatar" data-field="user_avatar_url" data-toggle="modal" data-target="#pull_preview_popup">
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="add" />
                        </button>
                        <!--  -->
                        <?php
                        ?>
                        <div class="user-avatar">
                            <div data-append="user_avatar_url" style="transform:<?php echo $avatar_data['position']; ?>">
                                <?php apply_filters('previewRender', $avatar_data['link']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="cover_img">
                        <button type="button" class="btn btn-primary change-cover-photo" data-field="user_cover_image_url" data-toggle="modal" data-target="#pull_preview_popup" >
                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="add" />
                        </button>
                        <div class="cover-container user-coverImage">
                            <div data-append="user_cover_image_url" style="transform:<?php echo $cover_data['position']; ?>">
                                <?php apply_filters('previewRender', $cover_data['link']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="user-detail">
                        <div class="user_icon">
                            <?php
                                do_action('current_user_type_icon');
                            ?>
                        </div>
                    </div>
                    <h4 class="text-center"><?php do_action('user_nickname'); ?></h4>
                </header>
                <?php get_template_part('template-parts/components/profile_types_circly'); ?>

                <div class="modal-footer justify-content-center position-relative">
                    <a class="close_sticker close-update-profile-popup" data-dismiss="modal" aria-label="Close">
                        <img class="hover_hue" src="<?php echo imgPATH; ?>X.png" />
                    </a>
                    <button type="button" class="update-profile-btn click_animation">
                        <img class="hover_hue" src="<?php echo imgPATH; ?>Check.png" width="70" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
