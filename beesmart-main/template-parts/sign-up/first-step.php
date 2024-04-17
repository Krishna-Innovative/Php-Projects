<!-- STEP 1 -->
<div class="tab-pane fade show active" id="shared" role="tabpanel" aria-labelledby="shared-tab">
    <transition name="fade" mode="out-in" appear appear-active-class="element-apear">
        <div class="step-1" v-show="currentStep === 1">
            <div class="name-block">
                <img src="<?php echo imgPATH; ?>Buzz1.png">
                <input @change="transmitNickname" v-model="step1.nickname" :class="step1.nValid  ? 'okay' : 'input-non-valid' " type="text" class="form-control" id="user-nickname" placeholder="Choose a name...">
                <span v-if="step1.nValid == false"> {{ step1.message }} </span>
            </div>
            <div class="agree-block">
                <transition name="ease">
                    <img v-if="step1.agreeBtn" :src=`<?php echo imgPATH; ?>Safe-1.png`>
                    <img v-else :src=`<?php echo imgPATH; ?>Warning.png`>
                </transition>
                <h6 class="text-center">Are you 16 or older?</h6>
                <p>You need to be 16 or older to make a profile and use this website.</p>
                <div class="button-area">
                    <button :class=" step1.agreeBtn ? 'grey' : '' " v-model="" @click="unAgree" type="button" id="reject-button">Exit</button>
                    <button :class=" step1.agreeBtn ? 'green' : '' " v-model="alertType" type="button" @click="agree" id="agree-button">Yes</button>
                </div>
            </div>
            <div class="check_btn text-center mt-3">
                <transition name="btn">
                <button :class="formReady(this.step1) ? 'heartBeat-animation' : '' " v-show="step1Ready"  @click="stepHandler" data-type="shadow" type="button" class="click_animation" data-step="1">
                        <img data-type="shadow" src="<?php echo imgPATH; ?>Check.png" width="60" data-step="step-1">
                    </button>
                </transition>
            </div>
        </div>
    </transition>
</div>
<!-- STEP 1 END -->