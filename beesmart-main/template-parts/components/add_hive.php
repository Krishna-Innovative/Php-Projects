<?php
$author_id = $post->post_author;
global $wpdb;
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
$new_listing = $wpdb->get_results("SELECT * FROM wp_um_set_priority_by_follower where follower_id =$author_id and user_id=$current_user_id");
$follower_cat_id = $new_listing[0]->follower_cat_id;

?>

<?php
if ($author_id != $current_user_id) {
?>

    <?php
    $author_category_listing = $wpdb->get_results("SELECT * FROM wp_category_created_by_author where author_id =$current_user_id");
    if (!empty($author_category_listing)) {
        $category = array();
        foreach ($author_category_listing as $category_listing) {
            $category[] = $category_listing->category_value;
        } ?>
       
    <div class="add_single_post">
       <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Hive.png" class="add_to_img">
        <select class="add_select selected_category_value custom_select">
		
        <?php
        $category_data = '<option value="0" data-u-id="' . $selected_id . '" selected>Add to...</option>';
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
    </div>
    <?php
}
?>