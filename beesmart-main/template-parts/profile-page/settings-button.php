<?php if (get_the_author_ID() == get_current_user_id()) { ?>
    <?php if (!um_is_on_edit_profile() || is_page_template('author.php')) {
		$loginuser = wp_get_current_user();
		$username=$loginuser->user_nicename; ?>
        <div class="settings-button-block">
            <a href="<?php echo site_url(); ?>/author/<?php echo $username;?>/?um_action=edit">
                <button class="settings-button">
                    <img src="<?php echo imgPATH; ?>Settings.png">
                </button>
            </a>
        </div>
    <?php } ?>
<?php } ?>