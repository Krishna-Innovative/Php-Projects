<div class="profile_tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item locked">
            <a class="nav-link" id="shared-tab" data-toggle="tab" href="#shared" role="tab" aria-controls="shared" aria-selected="false">
                <img src="<?php echo imgPATH; ?>Shared-tab.png">
                <span>Shared</span>
            </a>
        </li>
        <li class="nav-item locked">
            <a class="nav-link" id="backpack-tab" data-toggle="tab" href="#backpack" role="tab" aria-controls="backpack" aria-selected="true">
                <img src="<?php echo imgPATH; ?>Backpack.png">
                <span>Backpack</span>
            </a>
        </li>
        <li class="nav-item locked">
            <a class="nav-link" id="feeds-tab" data-toggle="tab" href="#feeds" role="tab" aria-controls="feeds" aria-selected="false">
                <img src="<?php echo imgPATH; ?>Feeds1.png">
                <span>Feeds</span>
            </a>
        </li>
        <li class="nav-item locked">
            <a class="nav-link" id="buzz-tab" data-toggle="tab" href="#buzz" role="tab" aria-controls="buzz" aria-selected="false">
                <img src="<?php echo imgPATH; ?>User-Profile-Buzz-tab.png">
                <span>Buzz</span>
            </a>
        </li>
        <li class="nav-item locked">
            <a class="nav-link" id="hive-tab" data-toggle="tab" href="#hiveinfo" role="tab" aria-controls="info" aria-selected="false">
                <img src="<?php echo imgPATH; ?>Hive.png">
                <span>Hives</span>
            </a>
        </li>
        <li class="nav-item locked">
            <a class="nav-link" id="friends-tab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">
                <img src="<?php echo imgPATH; ?>Find1-1.png">
                <span>Friends</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">
                <img src="<?php echo imgPATH; ?>Bio.png">
                <span>Bio</span>
            </a>
        </li>
    </ul>
    <div class="profile_inner_box"></div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="shared" role="tabpanel" aria-labelledby="shared-tab">
        </div>
        <div class="tab-pane fade " id="backpack" role="tabpanel" aria-labelledby="backpack-tab">
        </div>




        <!-- TAB FEED  -->
        <div class="tab-pane fade" id="feeds" role="tabpanel" aria-labelledby="feeds-tab">
            <div class=" add-info-updated">
                <div class="locked feeds-tab_add">
                    <div class="row">
                        <div class="col-5">
                            <div class="search_feld">
                                <input disabled type="text" class="form-control">
                                <img src="<?php echo imgPATH; ?>Search.png" class="search_icon">
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-5">
                            <div class="sorting_feed">
                                <select disabled class="custom_select">
                                    <option selected="" disabled="">Sort by</option>
                                    <option>Last activity</option>
                                    <option>Most followers</option>
                                    <option>A-Z</option>
                                    <option>Z-A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary add_btn" data-step="sample-feedPage">
                    <img class="heartBeat-animation" src="<?php echo imgPATH; ?>Create1.png" alt="add info">
                </button>
            </div>
            <div class="step-navigation">
                <button class="step-btn" data-step="sample-feedStepBack">
                    <img src="<?php echo imgPATH; ?>Back-Button.png" alt="previous step" />
                </button>
            </div>
            <div class="tab_info_sec">
                <a href="#" data-target="#feeds_info" data-toggle="modal">
                    <img src="<?php echo imgPATH; ?>Info.png" alt="img">
                </a>
            </div>
        </div>
        <div class="tab-pane fade" id="buzz" role="tabpanel" aria-labelledby="buzz-tab">
        </div>
        <!-- TAB FEED  -->





        <!-- HIVE TAB -->
        <div class="tab-pane fade" id="hiveinfo" role="tabpanel" aria-labelledby="hive-tab">
            <div class="locked add-info-updated">
                <div class="feeds-tab_add">
                    <div class="row">
                        <div class="col-5">
                            <div class="search_feld">
                                <input disabled type="text" class="form-control">
                                <img src="<?php echo imgPATH; ?>Search.png" class="search_icon">
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="#" class="showhide_sticker"><img src="<?php echo imgPATH; ?>Visibility.png" alt="img"></a>
                        </div>
                        <div class="col-5">
                            <div class="sorting_feed">
                                <select disabled class="custom_select">
                                    <option selected="" disabled="">Sort by</option>
                                    <option>Last activity</option>
                                    <option>Most followers</option>
                                    <option>A-Z</option>
                                    <option>Z-A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button disabled="disabled" type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#edit_hive">
                    <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
                </button>
            </div>
            <div class="manager_list_profile">
                <div class="single_following">
                    <div class="prof" data-url="<?php echo imgPATH; ?>Feeds3f.png">
                        <img src="<?php echo imgPATH; ?>Feeds3f.png" size="150">
                        <span>Taylor Rainbow TV</span>
                    </div>
                    <div class="select_group_manager">
                        <div class="dropdown">
                            <div class="group_manager_img">
                                <img src="<?php echo imgPATH; ?>Hives-Sort-later.png">
                            </div>
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                            </button>
                            <div data-done="first" class="dropdown-menu hiveSample" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>001-home.png" alt="flower">
                                    <span>Home hive</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>001-shopping basket.png" alt="Fantastic">
                                    <span>Shopping hive</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>001-woman.png" alt="Fantastic">
                                    <span>beauty hive</span>
                                </a>
                            </div>
                        </div>
                        <!-- <select data-done="second" name="post_name" class="sample-postname">
                            <option>Sort later</option>
                            <option selected="">...</option>
                            <option>Some</option>
                        </select> -->
                    </div>
                    <div class="p_drop">
                        <div class="dropdown sample-dropdown">
                            <a class="" href="#" role="button" id="ab123293055" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                    </path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ab123293055"><a class="dropdown-item user-remove" data-target="#removeconfirmation221" data-toggle="modal" data-userid="221">Delete</a>
                                <a class="dropdown-item user-hide" data-target="#confirmation221" data-toggle="modal" data-userid="221">
                                    Hide
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single_following">
                    <div class="prof" data-url="<?php echo imgPATH; ?>Bio3.png">
                        <img src="<?php echo imgPATH; ?>Bio3.png" size="150">
                        <span>Charli D'Unicorio</span>
                    </div>
                    <div class="select_group_manager">
                        <div class="dropdown ">
                            <div class="group_manager_img">
                                <img src="<?php echo imgPATH; ?>Hives-Sort-later.png">
                            </div>
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                            </button>
                            <div data-done="second" class="dropdown-menu hiveSample" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>001-flower.png" alt="flower">
                                    <span>Flower hive</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>001-hat.png" alt="Fantastic">
                                    <span>Fantastic hive</span>
                                </a>
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>001-rainy.png" alt="Fantastic">
                                    <span>Lovely hive</span>
                                </a>
                            </div>
                        </div>
                        <!-- <select data-done="second" name="post_name" class="sample-postname">
                            <option>Sort later</option>
                            <option selected="">...</option>
                            <option>Some</option>
                        </select> -->
                    </div>
                    <div class="locked p_drop">
                        <div class="dropdown sample-dropdown">
                            <a class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                    </path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ab123293055"><a class="dropdown-item user-remove" data-target="#removeconfirmation221" data-toggle="modal" data-userid="221">Delete</a>
                                <a class="dropdown-item user-hide" data-target="#confirmation221" data-toggle="modal" data-userid="221">
                                    Hide
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single_following">
                    <div class="prof" data-url="<?php echo imgPATH; ?>Feeds3e.png">
                        <img src="<?php echo imgPATH; ?>Feeds3e.png" size="150">
                        <span>Univia Rodrigo</span>
                    </div>
                    <div class="select_group_manager">
                        <div class="dropdown">
                            <div class="group_manager_img">
                                <img src="<?php echo imgPATH; ?>Hives-Sort-later.png">
                            </div>
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                            </button>
                            <div data-done="third" class="dropdown-menu hiveSample" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>001-pizza.png" alt="flower">
                                    <span>Food hive</span>
                                </a>
                                <a class="dropdown-item hiveSample" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>002-graduation cap.png" alt="Fantastic">
                                    <span>Graduation hive</span>
                                </a>
                                <a class="dropdown-item hiveSample" href="javascript:void(0);">
                                    <img src="<?php echo imgPATH; ?>005-DJ.png" alt="Fantastic">
                                    <span>Music hive</span>
                                </a>
                            </div>
                        </div>
                        <!-- <select data-done="second" name="post_name" class="sample-postname">
                            <option>Sort later</option>
                            <option selected="">...</option>
                            <option>Some</option>
                        </select> -->
                    </div>
                    <div class="p_drop">
                        <div class="dropdown">
                            <a class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                    </path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="ab123293055"><a class="dropdown-item user-remove" data-target="#removeconfirmation221" data-toggle="modal" data-userid="221">Delete</a>
                                <a class="dropdown-item user-hide" data-target="#confirmation221" data-toggle="modal" data-userid="221">
                                    Hide
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="step-navigation">
                <button class="step-btn" data-step="sample-profileNavifation">
                    <img src="<?php echo imgPATH; ?>Back-Button.png" alt="next step" />
                </button>
                <button disabled="disabled" class="step-btn" data-step="sample-feed">
                    <img src="<?php echo imgPATH; ?>Check.png" alt="next step" />
                </button>
            </div>
            <div class="tab_info_sec">
                <a href="#" data-target="#hives_info" data-toggle="modal">
                    <img src="<?php echo imgPATH; ?>Info.png" alt="img">
                </a>
            </div>
            <div class="manager_list_profile">
                <script>
                    $(".postname option").each(function() {
                        $(this).siblings('[data-id="' + this.value + '_dfghsthrt"]').remove();
                    });
                </script>
            </div>
        </div>
        <!-- HIVE TAB END -->

        <!-- FRIEND TAB -->
        <div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friends-tab">
        </div>
        <!-- FRIEND TAB END -->


        <!-- BIO TAB -->
        <div class="tab-pane fade ergrg active show" id="info" role="tabpanel" aria-labelledby="info-tab">
            <!-- Button trigger modal -->
            <div class="add-info-block d-block mt-0 add-info-updated">
                <div class="add_bio_inner">
                    <div class="locked bio_icon icon_1">
                        <a href="#" class=""><img src="<?php echo imgPATH; ?>Verified.png" alt="img"></a>
                    </div>
                    <div class="locked bio_icon icon_2">
                        <a href="#"><img src="<?php echo imgPATH; ?>Verified.png" alt="img"></a>
                    </div>
                    <div class="locked bio_icon icon_3">
                        <a href="/subscriptions" class=""><img src="<?php echo imgPATH; ?>Verified.png" alt="img"></a>
                    </div>
                    <div class="bio_icon icon_4">
                        <!-- <a href="#"><img src="<?php //echo imgPATH; ?>Types-Personal.png" alt="img"></a> -->
                        <?php do_action('user_type'); ?>
                        <div class="dropdown">
                            <a class="" href="#" role="button" id="xyz" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xyz">
                                <a class="dropdown-item">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ADD BIO BTN -->
                <button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add-info-popup" id="show_form_btn">
                    <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
                </button>
                <!-- ADD BIO BTN END -->


                <div class="step-navigation">
                    <button class="step-btn" data-step="sample-coverPhoto">
                        <img src="<?php echo imgPATH; ?>Back-Button.png" alt="next step" />
                    </button>
                    <button disabled class="step-btn" data-step="sample-saveToHive">
                        <img src="<?php echo imgPATH; ?>Check.png" alt="next step" />
                    </button>
                </div>
                <div class="tab_info_sec">
                    <a href="#" data-target="#bio_info" data-toggle="modal">
                        <img src="<?php echo imgPATH; ?>Info.png" alt="img">
                    </a>
                </div>
            </div>

            <?php get_template_part('/template-parts/components/add-bio-popup'); ?>

        </div>
        <!-- BIO TAB END -->
    </div>
</div>