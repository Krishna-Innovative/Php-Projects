<!-- STEP 2 -->

<div class="tab-pane fade show active" id="backpack" role="tabpanel" aria-labelledby="backpack-tab">
    <transition name="fade" mode="out-in" appear appear-active-class="element-apear">
        <div class="step-2" v-show="currentStep == 2">
            <div class="createpost_steps justify-content-center">
                <div class="single_step text-center active">
                    <div class="main_filter_btn">
                        <button type="button" class="filter_btn">
                            <img src="<?php echo imgPATH; ?>Button-Focus.png">
                        </button>
                    </div>
                    <type-circle v-for="field,i in types" :key="field.title" :title="field.title" :image="field.img" :Class="[field.className, isTypeActive]"  @clickede="setActive(i, $event)"></type-circle>
                    <input type="hidden" id="user_post_registration" value="">
                </div>
            </div>
            <div class="focus-description">
                <transition name="fade">
                        <!-- <img src="<?php //echo imgPATH; ?>Bee.png" class="d-none"> -->
                        <img v-show="step2.img" :src="step2.img" class="focus_icon" alt="type">
                    <!-- <img :src="step2.img" class="focus_icon" alt="type"> -->
                </transition>
                <p><b>{{ step2.title }}</b></p>
                <p>{{ step2.desc }}</p>
                <div class="check_btn text-center">
                    <transition name="btn">
                    <button :class="step2Ready ? 'heartBeat-animation' : '' " v-show="step2Ready" :disabled="!step2Ready" @click="stepHandler(appendStyle)" data-type="shadow" type="button" class="click_animation">
                        <img data-type="shadow" src="<?php echo imgPATH; ?>Check.png" width="60" data-step="step-2">
                    </button>
                </transition>
                </div>
            </div>
            <!-- <div class="tab_info_sec">
                <button type="button" data-type="shadow" data-target="#bio_info" data-toggle="modal" class="click_animation">
                    <img data-type="shadow" src="<?php //echo imgPATH; ?>Info.png">
                </button>
            </div> -->
        </div>
    </transition>
</div>
<!-- STEP 2 END -->