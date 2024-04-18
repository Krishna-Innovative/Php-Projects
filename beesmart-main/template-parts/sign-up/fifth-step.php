<!-- STEP 5 -->
<div class="tab-pane fade show active" id="hiveinfo" role="tabpanel" aria-labelledby="hive-tab">
   <transition name="fade" mode="out-in" appear appear-active-class="element-apear"> 
        <div v-show="currentStep == 5" class="step-5">
            <field 
                v-for="field,i in info"
                :key="field.label"
                :label="field.label"
                :value="field.value"
                :valid="field.valid"
                :src="field.icon"
                :type="field.type"
                @updated="onUpdate(i, $event)"
            >
            <input v-if="field.label == 'Password'" v-model="confirmPassword" @paste.prevent name="user-confirm-password" id="user-confirm-password" type="password" class="form-control" placeholder="Confirm Password">
            </field>
            <div id="message" class="mt-3 mb-3">
                <div class="pass-validation-item">
                    <div v-if="this.info[1].value.length >= 8">✅</div>
                    <div v-else>❌</div>
                    <p :class="this.info[1].value.length >= 8 ? 'valid' : '' ">
                        <b>8 Charsets</b>
                    </p>
                </div>
                <div class="pass-validation-item">
                    <div v-if="this.info[1].value.match(/[A-Z]/)">✅</div>
                    <div v-else>❌</div>
                    <p :class="this.info[1].value.match(/[A-Z]/) ? 'valid' : '' ">
                        <b>1 Capital letter</b>
                    </p>
                </div>
                <div class="pass-validation-item">
                    <div v-if="this.info[1].value.match(/[0-9]/)">✅</div>
                    <div v-else>❌</div>
                    <p :class="this.info[1].value.match(/[0-9]/) ? 'valid' : '' ">
                        <b>1 Number</b>
                    </p>
                </div>
            </div>
            <div class="verify_block">
                <img src="<?php echo imgPATH; ?>/Sign up email.png" width="80">
                <h4>Verify Email</h4>
                <button :disabled="confirmPassword.length < 3" @click="registrationHandler"  data-step="step-5" class="signup_btn">Sign Up</button>
            </div>
        </div>
    </transition> 
</div>
<!-- STEP 5 END -->
