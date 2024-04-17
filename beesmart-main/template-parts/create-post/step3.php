<?php get_template_part('template-parts/create-post/popups-items/location'); ?>
<section class="step_3_area">
    <div class="container">
        <?php
        acf_form(array(
            'post_id'        => 'new_post',
            'new_post'        => array(
                'post_type'        => 'beeart',
                'post_status'    => 'publish'
            )
        ));
        ?>
        <div class="top_area lang_boxes">
            <div class="row">
                <div class="col-12 tag_area">
                    <!-- content going via js -->
                </div>
                <div class="col d-flex flex-column align-items-center align-self-end location-popup-triger">
                    <!-- <button type="button" class="btn btn-primary map-button" data-toggle="modal" data-target="#map-popup"> -->
                    <img src="<?php echo  site_url(); ?>/wp-content/uploads/2022/02/Location-1.png" alt="location">
                    <!-- </button> -->
					<div @click.prevent="countryDropdown" id="page-create-post-niceCountryInputSelector" class="info_select info_country" >
						<select class="selectpicker countrypicker" data-flag="true"  data-live-search="true" multiple >
							<?php
							get_template_part('template-parts/sign-up/country-dropdown');
							?>
						</select>
						</div>
                    <!-- <div class="user-location">
                        <?php
                        // user country 
                        //echo get_user_meta(get_current_user_id(), 'country', true);
                        ?>
                    </div> -->
                </div>
                <div class="col d-flex flex-column align-items-center align-self-end language_area">
                   
                  <div class="language_dropdown">
					<?php
					get_template_part('template-parts/components/language-dropdown');
					?>
			     </div>
                </div>
                <div class="col d-flex flex-column align-items-center align-self-end" id="explicit_area">
                    <img v-if="isExp == false" src="<?php echo imgPATH; ?>Safe-1.png" alt="is">
                    <img v-else-if="isExp == true" src="<?php echo imgPATH; ?>Warning.png" alt="is">
                    <img v-else src="<?php echo imgPATH; ?>Unselected.png" alt="is">
                    <b :class="checkExplicit"><ins>Is this explicit?</ins></b>
                    <div class="btn-group explicit-btns" role="group" aria-label="Basic example">
                        <button @click="isExp = false" :class="[darkSafe, safe]" type="button" class="">No</button>
                        <button @click="isExp = true" :class="[darkDanger, danger]" type="button" class="">Yes</button>
                    </div>
                </div>
                <div class="col-12 additional_area">
                    <!-- content going via js -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 left-area">
                <div class="user_data">
                    <?php do_action('current_user_url_avatar'); ?>
                    <h4><?php do_action('current_user_full_name'); ?></h4>
                </div>
                <div class="meta">
                    <div class="resources">
                        <div class="honey">
                            <img src="<?php echo  site_url(); ?>/wp-content/uploads/2022/01/Honey64A.png" alt="honey">
                            <h4><?php echo do_shortcode('[mycred_total_balance types="mycred_default,mycustomtype" total=1]'); ?></h4>
                        </div>
                        <div class="flower">
                            <img src="<?php echo  site_url(); ?>/wp-content/uploads/2022/01/sunflower1.png" alt="flower">
                            <h4>7</h4>
                        </div>
                        <div class="hives">
                            <img src="<?php echo imgPATH; ?>Bee.png" alt="img" />
                            <h4><?php global $wpdb;
                                $current_user = wp_get_current_user();
                                $current_user_id = $current_user->ID;
                                $results = $wpdb->get_results("SELECT count(user_id1) as total FROM wp_um_followers where `user_id1` =$current_user_id");
                                echo $results[0]->total;
                                //$query = $wpdb->query("SELECT count(user_id1) FROM `wp_um_followers` where user_id1=");
                                ?></h4>
                        </div>
                    </div>
                    <!-- <div class="type">
                        <?php
                        //do_action('current_user_type_icon');
                        //do_action('is_current_user_verified');
                        ?>
                    </div> -->
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 right-area">
                <div class="cost_create">
                    <!--                     <span>Cost to share:</span> -->
                    <div class="price-block">
                        <div class="honey-cost">
                            <img src="<?php echo  site_url(); ?>/wp-content/uploads/2022/01/Honey64A.png" alt="honey">
                            100
                        </div>
                        <div class="flower-cost">
                            <img src="<?php echo  site_url(); ?>/wp-content/uploads/2022/01/sunflower1.png" alt="flower">
                            0
                        </div>
                    </div>
                </div>
                <div class="agreement">
                    <span>If you click Accept, you accept this site's
                        <a href="#">terms</a>.
                    </span>
                    <label for="accept-terms">Accept</label>
                    <input id="accept-terms" type="checkbox">
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    let createPostPage = Vue.createApp({
        data() {
            return {
                // isExcplicit
                isExp: null
            }
        },
        computed: {
            checkExplicit() {
                if (this.isExp == true) {
                    return 'danger'
                } else if (this.isExp == false) {
                    return 'safe'
                } else {
                    return ''
                }
                // return this.isExp == true ? 'danger' : 'safe';
            },
            // black font color 
            danger() {
                if (this.isExp == true) return 'danger';
                else return '';

            },
            safe() {
                if (this.isExp == false) return 'safe';
                else return '';

            },
            darkSafe() {
                if (this.isExp == true) return 'dark';
                else return '';

            },
            darkDanger() {
                if (this.isExp == false) return 'dark';
                else return '';

            }
        }
    })
    createPostPage.mount('.step_3_area')
</script>