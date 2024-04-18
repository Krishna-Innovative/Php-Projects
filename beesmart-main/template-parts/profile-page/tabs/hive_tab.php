<?php if ($userId == $current_user_id) { ?>
<div class="tab-pane fade" id="hiveinfo" role="tabpanel" aria-labelledby="hive-tab">
    <div class="add-info-updated">
        <div class="feeds-tab_add">
            <div class="row">
                <div class="col-5">
                    <div class="search_feld">
                        <input type="text" class="form-control" value="" id="search_hive_value">
                        <img src="<?php echo imgPATH;  ?>Search.png" class="search_icon" id="hive_search">
						<input type="hidden" value="search" id="hidden_search_value">
                    </div>
                </div>
                <div class="col-2">
                    <a href="#" class="showhide_sticker"><img src="<?php echo imgPATH; ?>Visibility.png" alt="img"></a>
                </div>
                <div class="col-5">
                    <div class="sorting_feed">
                       <select class="custom_select" id="hive_order">
                            <option selected="" disabled="">Sort by</option>
                            <option value="last">Last activity</option>
                            <option value="most">Most followers</option>
                            <option value="asc">A-Z</option>
                            <option value="dsc">Z-A</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#edit_hive">
            <img src="<?php echo  imgPATH; ?>Create1.png" alt="add info">
        </button>
    </div>
    <div class="manager_list_profile">
        <?php  get_template_part('template-parts/components/hive/single_follower'); ?>
    </div>
    <div class="hive_extended_footer d-flex justify-content-between align-items-center">
        <div class="load_more text-center" id="reset_all_form">
            <img width="60" class="disable" src="<?php echo imgPATH; ?>Check1.png">
            <span class="d-block">Reset</span>
        </div>
        <div class="save_hive text-center add_hive_link save_hive_category">
            <img width="60" class="disable" src="<?php echo  imgPATH; ?>Check.png">
            <span class="d-block">Save</span>
        </div>
    </div>


    <div class="tab_info_sec">
        <a href="#" data-target="#hives_info" data-toggle="modal">
            <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Info.png" alt="img">
        </a>
    </div>
</div>
<?php } ?>
