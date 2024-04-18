<!-- STEP 4 -->
<div class="tab-pane fade show active" id="buzz" role="tabpanel" aria-labelledby="buzz-tab">
    <transition name="fade" mode="out-in" appear appear-active-class="element-apear">
        <div v-show="currentStep == 4" class="step-4">
            <div class="news_body">
                <h6>Term and Polocies</h6>
                <div class="feture-1 feture">
                    <img src="<?php echo imgPATH; ?>Cookies1.png" alt="img" width="70" />
                    <span>Cookies Policy</span>
                </div>
                <div class="feture-2 feture">
                    <span>Data Policy</span>
                    <img src="<?php echo imgPATH; ?>Feeds1b.png" alt="News 2" width="70" />
                </div>
                <div class="feture-3 feture">
                    <img src="<?php echo imgPATH; ?>TCs.png" alt="News 3" width="70" />
                    <span>Terms and Conditions</span>
                </div>
            </div>

            <div class="terms-block">
                <p>By clicking Sign Up, you agree to our Cookies Policy, Data Policy and Terms and Conditions</p>
                <button @click="this.step4.agreeBtn = true" :class="formReady(this.step4) ? 'signup_btn' : 'not-accepted'">Sign Up</button>
                <div class="check_btn text-center">
                    <transition name="btn">
                        <button :class="formReady(this.step4) ? 'heartBeat-animation' : '' " v-show="formReady(this.step4)" @click="stepHandler" :disabled="!formReady(this.step4)" data-type="shadow" type="button" class="click_animation">
                            <img data-type="shadow" src="<?php echo imgPATH; ?>Check.png" width="60" data-step="step-4">
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
<!-- STEP 4 END -->