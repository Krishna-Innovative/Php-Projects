<!-- STEP 3 -->
<div class="tab-pane fade show active" id="feeds" role="tabpanel" aria-labelledby="feeds-tab">
    <transition name="fade" mode="out-in" appear appear-active-class="element-apear">
        <div class="step-3" v-show="currentStep == 3">
            <div class="lang_boxes">
                <div class="row">
                    <div class="col-6">
                        <div  class="item item7">
                            <div class="d-flex justify-content-center">
                                <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Metadata-National-1.png" title="Country" class="" />
                            </div>
                            <?php // if ( ! empty( $country_list ) && is_array( $country_list ) ) { ?>
                           <div @click.prevent="countryDropdown" class="info_select info_country">
							  <select class="selectpicker countrypicker" data-flag="true"  data-live-search="true" multiple >
								<?php
								get_template_part('template-parts/sign-up/country-dropdown');
								?>
							</select>
		
							</div>
                            <?php //} 
                            ?>
                        </div>
                    </div>
                    <div class="col-6">
				<div class="language_dropdown">
					<?php
					get_template_part('template-parts/components/language-dropdown');
					?>
			     </div>
                    </div>
                </div>
            </div>

            <div class="check_btn text-center mt-3">
                <transition name="btn">
                    <!-- v-show="formReady(this.step3)" :disabled="!formReady(this.step3)" -->
                    <button  :class="formReady(this.step3) ? 'heartBeat-animation' : '' " @click="stepHandler" data-type="shadow" type="button" class="click_animation">
                        <img data-type="shadow" src="<?php echo imgPATH; ?>Check.png" width="60" data-step="step-3">
                    </button>
                </transition>
            </div>
            <!-- <div class="tab_info_sec mt-3">
                <button type="button" data-type="shadow" data-target="#bio_info" data-toggle="modal" class="click_animation">
                    <img data-type="shadow" src="<?php //echo imgPATH; 
                                                    ?>Info.png">
                </button>
            </div> -->
        </div>
    </transition>
</div>
<!-- STEP 3 END -->
<script>
    window.addEventListener('load', function(){

        let stgingsToReplace = {
            country : {
                el :  'button.btn.dropdown-toggle.btn-light.bs-placeholder',
                word: 'Nothing selected',
                to :  'All'
            },
            // language :{
            //     el : '.dropdown.bootstrap-select.show-tick.form-control.info_select.info_language',
            //     word: 'Nothing selected',
            //     to: 'All'
            // },
        }
        function strReplaces(objsToReplace){
            for (let obj in objsToReplace){
                console.log(document.querySelectorAll(objsToReplace[obj]['el']))
                document.querySelectorAll(objsToReplace[obj]['el']).forEach(el => {
                    el.innerHTML = document.querySelector(objsToReplace[obj]['el']).innerHTML.replace(objsToReplace[obj]['word'], objsToReplace[obj]['to'])
                })
            }
            console.log('done')
        }
        strReplaces(stgingsToReplace)
    })
</script>