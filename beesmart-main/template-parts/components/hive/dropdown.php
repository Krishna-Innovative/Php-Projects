<div class="hivvdropdown  hive_option_<?php echo absint($args); ?> hidden">
    <div class="hivvdropdown_search">
        <img src="<?php echo imgPATH; ?>Hive.png" class="hive_icon">
        <input type="text" class="form-control">
        <img src="<?php echo imgPATH; ?>search.png" class="search_icon">
    </div>
    <ul class="hivvdropdown_list other-profile list_of_checkbox<?php echo absint($follower_ids); ?>" data-id="<?php echo absint($follower_ids); ?>">
        <?php do_action('the_own_hive_list'); ?>
    </ul>
    <button class="hover_hue click_animation p-0 hivedrop_down_button" data-type="shadow" data-hive="">
        <img src="<?php echo imgPATH; ?>Check.png" data-type="shadow" width="60" data-id="<?php echo absint($user_id); ?>">
    </button>
</div>
