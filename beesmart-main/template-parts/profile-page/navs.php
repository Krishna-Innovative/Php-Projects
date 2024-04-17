<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <button data-type="shadow" class="nav-link  click_animation" id="shared-tab" data-toggle="tab" href="#shared" role="tab" aria-controls="shared" aria-selected="true">
            <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Shared-tab.png" />
            <span data-type="shadow">Shared</span>
        </button>
    </li>
    <li class="nav-item">
        <button data-type="shadow" class="nav-link click_animation" id="backpack-tab" data-toggle="tab" href="#backpack" role="tab" aria-controls="backpack" aria-selected="true">
            <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Backpack.png" />
            <span data-type="shadow">Backpack</span>
        </button>
    </li>
    <li class="nav-item">
        <button data-type="shadow" class="nav-link click_animation" id="feeds-tab" data-toggle="tab" href="#feeds" role="tab" aria-controls="feeds" aria-selected="false">
            <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Feeds1.png" />
            <span data-type="shadow">Feeds</span>
        </button>
    </li>
    <li class="nav-item">
        <button data-type="shadow" class="nav-link click_animation" id="buzz-tab" data-toggle="tab" href="#buzz" role="tab" aria-controls="buzz" aria-selected="false">
            <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/User-Profile-Buzz-tab.png" />
            <span data-type="shadow">Buzz</span>
        </button>
    </li>
    <?php 
	$current_user = wp_get_current_user();
	$current_user_id = $current_user->ID; 
	$userId = get_the_author_ID();
	if ($userId == $current_user_id) { ?>
        <li class="nav-item">
            <button data-type="shadow" class="nav-link click_animation" id="hive-tab" data-toggle="tab" href="#hiveinfo" role="tab" aria-controls="info" aria-selected="false">
                <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" />
                <span data-type="shadow">Hives</span>
            </button>
        </li>
        <li class="nav-item">
            <button data-type="shadow" class="nav-link click_animation" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">
                <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Find1-1.png" />
                <span data-type="shadow">Friends</span>
            </button>
        </li>
    <?php }else{
		 $results = $wpdb->get_results("SELECT * FROM wp_um_followers where user_id1 =$current_user_id And user_id2=$userId");
        if (!empty($results)) {
			?>
			<li class="nav-item">
            <button data-type="shadow" class="nav-link click_animation" id="hive-tab" data-toggle="tab" href="#hiveinfo" role="tab" aria-controls="info" aria-selected="false">
                <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" />
                <span data-type="shadow">Hives</span>
            </button>
        </li>
        <li class="nav-item">
            <button data-type="shadow" class="nav-link click_animation" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">
                <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Find1-1.png" />
                <span data-type="shadow">Friends</span>
            </button>
        </li>
			<?php
		}else{
			//echo 'dbfyet';
		}
	} ?>
    <li class="nav-item ">
        <button data-type="shadow" class="nav-link active click_animation" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">
            <img data-type="shadow" src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Bio.png" />
            <span data-type="shadow">Bio</span>
        </button>
    </li>
</ul>