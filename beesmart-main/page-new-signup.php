<?php
/*Template name:new-signup*/
get_header();
$sPATH = 'template-parts/sign-up/';
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/user.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/signup.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

<div class="inner_main_page_section_cls bg_light inner_main_page_wapper" id="signUp-page">
    <div v-if="isSignUpFinish == false" class="container">
        <div class="profile_page">
            <header class="profile-header">
                <div class="dummy_icon">
                    <img class="img-fluid" src="<?php echo imgPATH; ?>Bee.png" alt="img">
                </div>
                <div class="cover_img">
                    <img class="user-coverImage" src="<?php echo imgPATH; ?>Placeholder-LP-image-scaled.jpg" alt="img">
                </div>
                <div class="user-detail mt-0">
                    <div class="user-name">
                        <p></p>
                    </div>
                    <div class="user_icon">
                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/dont.png" class="d-none">
                        <transition name="btn" mode="in-out">
                            <img v-show="step2.img" :src="step2.img" class="focus_icon" alt="type">
                        </transition>
                        <!-- <img src="<?php //echo site_url(); 
                                        ?>/wp-content/uploads/2022/02/dont.png" alt="img"> -->

                    </div>
                </div>
                <h4 class="text-center">{{ isValidNickname }}</h4>
            </header>
            <div class="profile_tabs signup_tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <button :class="currentStep == 1 ? 'active' : '' " @click="currentStep = 1" data-type="shadow" class="nav-link click_animation" id="shared-tab" data-toggle="tab" href="#shared" role="tab" aria-controls="shared" aria-selected="false">
                            <img data-type="shadow" src="<?php echo imgPATH; ?>Bee.png">
                            <span data-type="shadow">Name</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button :class="currentStep == 2 ? 'active' : '' " data-type="shadow" class="nav-link click_animation" id="backpack-tab" data-toggle="tab" href="#backpack" role="tab" aria-controls="backpack" aria-selected="false">
                            <img data-type="shadow" src="<?php echo imgPATH; ?>Bio.png">
                            <span data-type="shadow">Focus</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button :class="currentStep == 3 ? 'active' : '' " data-type="shadow" class="nav-link click_animation" id="feeds-tab" data-toggle="tab" href="#feeds" role="tab" aria-controls="feeds" aria-selected="false">
                            <img data-type="shadow" src="<?php echo imgPATH; ?>Metadata-National-1.png">
                            <span data-type="shadow">Language</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button :class="currentStep == 4 ? 'active' : '' " data-type="shadow" class="nav-link click_animation" id="buzz-tab" data-toggle="tab" href="#buzz" role="tab" aria-controls="buzz" aria-selected="false">
                            <img data-type="shadow" src="<?php echo imgPATH; ?>Sign up unicorn.png">
                            <span data-type="shadow">Email</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button :class="currentStep == 5 ? 'active' : '' " data-type="shadow" class="nav-link click_animation" id="hive-tab" data-toggle="tab" href="#hiveinfo" role="tab" aria-controls="info" aria-selected="true">
                            <img data-type="shadow" src="<?php echo imgPATH; ?>Sign up email.png">
                            <span data-type="shadow">Details</span>
                        </button>
                    </li>
                </ul>
                <div class="profile_inner_box">
                    <transition-group name="fade ? currentStep++ : Appearance" mode="out-in" appear appear-active-class="element-apear">
                        <div class="stepsform_progressbar  steps-bar">
                            <div class="progress">
                                <span class="progress-bar" :style="progressHandler"></span>
                            </div>
                            <!-- 
                            <li class="step-item active"></li>
                            <li :class="currentStep > 1 ? 'active' : '' " class="step-item"></li>
                            <li :class="currentStep > 2 ? 'active' : '' " class="step-item "></li>
                            <li :class="currentStep > 3 ? 'active' : '' " class="step-item "></li>
                            <li :class="currentStep > 4 ? 'active' : '' " class="step-item"></li> -->
                        </div>
                    </transition-group>
                </div>
                <transition-group name="fade" appear appear-active-class="element-apear">
                    <div class="tab-content mt-5 multi_stepsform" id="myTabContent">

                        <?php get_template_part($sPATH . 'first-step'); ?>

                        <?php get_template_part($sPATH . 'second-step'); ?>

                        <?php get_template_part($sPATH . 'third-step'); ?>

                        <?php get_template_part($sPATH . 'fourth-step'); ?>

                        <?php get_template_part($sPATH . 'fifth-step'); ?>

                    </div>
                </transition-group>
            </div>
        </div>
        <div :class="currentStep == 4 ? 'offTop' : '' " class="navigation-footer">
            <transition name="btnFromBottom" mode="in-out">
                <button v-show="currentStep > 1" @click="currentStep--" class="transparent">
                    <img src="<?php echo imgPATH; ?>Back-Button.png" alt="previes step" data-type="shadow">
                </button>
            </transition>
            <button type="button" data-type="shadow" data-target="#buzz_info" data-toggle="modal" class="click_animation">
                <img data-type="shadow" src="<?php echo imgPATH; ?>Info.png">
            </button>
        </div>
    </div>
</div>
<?php
get_template_part('template-parts/profile-page/info_popups');
echo do_shortcode('[ultimatemember form_id="2757"]');
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

<script>
    // $(function() {
    //     $('.selectpicker').selectpicker();
    // });
    document.addEventListener("load", function(event) {
        document.querySelectorAll(".niceCountryInputSelector").forEach(element => new NiceCountryInput(element).init());

        function listen(tr, rec) {
            tr.addEventListener("change", function() {
                rec.value = tr.value;
            });
        }



        listen(document.querySelector("input#Email"), document.querySelector("input[data-key=user_email]"));

        listen(document.querySelector("input#Password"), document.querySelector("input[data-key=user_password]"));

        listen(document.querySelector("input#user-confirm-password"), document.querySelector("input[data-key=confirm_user_password]"));

    });
    // $("#registration_process").click(function() {
    //     var nick_name = $("#nick-name").val();
    //     var user_type = $("#user_post_registration").val();
    // })
    // $("div#backpack a.single-sorting-item.content_item").click(function() {
    //     var user_type = $(this).attr('title');
    //     $("#user_post_registration").val(user_type);
    //     $(this).removeClass('disable');
    //     $(this).find('img').removeClass('disable');
    // })
</script>
<script>
    const field = {
        props: {
            label: {
                type: String,
                required: true
            },
            value: {
                type: String,
                required: true
            },
            type: {
                type: String,
                required: true
            },
            valid: {
                type: Boolean,
                required: true
            },
            src: {
                type: String,
                required: true
            },
        },
        data() {
            return {
                activated: this.value != ''
            }
        },
        methods: {
            onInput(e) {
                this.activated = true;
                this.$emit('updated', e.target.value)
            }
        },
        template: `
            <div class="name-block">
                <img  width="80" :src="this.src" alt="img" />
                <input  
                @input="onInput"  
                :value="value" 
                :name="label" 
                :id="label" 
                :placeholder="label" 
                :type="type" 
                class="form-control" />
                <slot></slot>
            </div>
            
        `
    }
    // <div class="form-group">
    //      <label>
    //          {{ label }}
    //          <fa-icon v-if="activated"
    //              :class="valid ? 'text-success' : 'text-danger'"
    //              :icon="valid ? 'check-circle' : 'exclamation-circle'"
    //          />
    //      </label>
    //      <input type="text" class="form-control" :value="value" @input="onInput">
    //  </div>


    const typeCircle = {
        props: {
            title: {
                type: String,
                required: true
            },
            image: {
                type: String,
                required: true
            },
            Class: {
                type: String,
                required: true
            },

        },
        data() {
            return {
                isForDone: false,
                typeActive : false
            }
        },
        methods: {
            onClicke(e) {
                this.typeActive = true;
                // this.isForDone = true
                this.$emit('clickede', e.target)
                console.log(e.target)
            },
            // onInput(e) {
            //     this.activated = true;
            //     this.$emit('updated', e.target.value)
            // }
        },
        computed: {
            isTypeActive(){
                return this.typeActive == true ? 'active' : ''

            }
        },
        template: `<a  v-bind:class='Class' href="javascript:void(0);" :title="title"  class="content_item item">
                    <img @click="onClicke" :src='image' >
                </a>`
    };
    // <?php //echo site_url(); 
        ?>/wp-content/uploads/2022/05/Bee.png

    let app = Vue.createApp({
        components: {
            typeCircle,
            field
        },
        data: () => ({
            isSearchPart: window.location.search,
            alertType: 'yes',
            isActive: false,
            currentStep: 1,
            step1: {
                nickname: '',
                nValid: true,
                agreeBtn: false,
                message: ''
            },
            step2: {
                title: 'Chose your type',
                img: '',
                desc: 'and we will help you to find your dream',
            },
            step3: {
                country: '',
                lang: '',
            },
            step4: {
                agreeBtn: false,
            },
            step5: {
                email: '',
                password: '',
                confirmPassword: '',
            },
            step2Ready: false,
            stepDone: false,

            types: [{
                    title: 'Business',
                    img: '<?php echo imgPATH; ?>types-Business.png',
                    desc: 'lorem ipsum dolor sit amet consectetur adipisci ng elit ',
                    className: 'item1'
                },
                {
                    title: 'Hobby',
                    img: '<?php echo imgPATH; ?>Type-Hobby.png',
                    desc: 'lorem ipsum dolor sit iusmod tempoagna aliqua ',
                    className: 'item2'
                },
                {
                    title: 'Location',
                    img: '<?php echo imgPATH; ?>Type-Location.png',
                    desc: 'lorem ng elit sed eiusmod tempor incididunt ut ',
                    className: 'item3'
                },
                {
                    title: 'Career',
                    img: '<?php echo imgPATH; ?>Type-Professional.png',
                    desc: ' incididunt ut labore et dolore magna aliqua ',
                    className: 'item4'
                },
                {
                    title: 'Personal',
                    img: '<?php echo imgPATH; ?>Types-Personal.png',
                    desc: 'lorem ipsum dolor sit iusmod tempor ',
                    className: 'item5'
                },
                {
                    title: 'community',
                    img: '<?php echo imgPATH; ?>Types-Community.png',
                    desc: 'lorem tempor incididunt ut labore et dolore magna aliqua ',
                    className: 'item6'
                },
            ],

            info: [{
                    label: 'Email',
                    value: '',
                    icon: '<?php echo imgPATH; ?>Email1.png',
                    type: 'text',
                    pattern: /^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/
                },
                {
                    label: 'Password',
                    value: '',
                    icon: '<?php echo imgPATH; ?>Password1.png',
                    type: 'password',
                    pattern: /(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{8,}/
                },
            ],
            confirmPassword: '',
        }),
        computed: {
            // step 1 accept next step btn
            step1Ready(){
                return this.step1.nickname.length > 3 && this.step1.agreeBtn == true
            },
            // Start=================
            fullName() {
                if (this.step1.nickname.length < 1) {
                    return 'Your name'
                } else {
                    return this.step1.nickname
                }
            },
            // check is correct nicknale length
            isValidNickname() {
                let reg = /%|=|<|>|\+|\*|{|}|\/|&|'|"/
                let newStr = null
                this.step1.nValid = true
                if (this.step1.nickname.length > 140) {
                    this.step1.nValid = false
                    this.step1.message = 'characters count must be less than 140'
                    newStr = this.stripStr()
                    // this.replaceStr()
                    this.step1.nickname = newStr
                    return this.step1.nickname
                }
                else if(this.step1.nickname.match(reg)){
                    this.step1.nValid = false
                    this.step1.message = 'symbols does not allowed'

                    // this.step1.nickname.
                    // toastr.error('This chars are not allowed')
                    newStr = this.stripStr()

                    this.step1.nickname = newStr
                    return this.step1.nickname
                }
                else {
                    return this.fullName
                }
                return
            },
            // End=============


            isAgeMore16() {
                return step1.agreeBtn ? 'green' : ''
            },
            fieldDone() {
                // return this.info.reduce((total, field) => total + (field.valid ? 1 : 0), 0)
                return this.info.filter(field => field.valid).length;
            },

            isSignUpFinish() {
                return this.isSearchPart ? true : false
            },
            progressHandler() {
                return 'width:' + this.currentStep * 100 / 5   + '%'
            }
        },
        methods: {
            replaceStr(str){
                return str = this.stripStr
            },
            stripStr(){
                let newStr = this.step1.nickname.substr(0, this.step1.nickname.length - 1)
                return newStr
            },
            transmitNickname(e) {
                document.querySelector('input[data-key=nickname]').value = e.target.value
            },
            transmitEmail(e) {
                document.querySelector('input[data-key=user_email]').value = e.target.value
            },
            transmitPassword(e) {
                document.querySelector('input[data-key=user_password]').value = e.target.value
            },
            transmitConfirmPassword(e) {
                document.querySelector('input[data-key=confirm_user_password]').value = e.target.value
            },
            registrationHandler(e) {
                if (this.info[1].value.lengh == 0){
                    toastr['warning']('Passwords is to short')
                }
                else if (this.info[1].value != this.confirmPassword) {
                        toastr['warning']('Passwords do not match')
                    } 
                    else{
                        $.ajax({
                            type: 'POST',
                            url: '/wp-admin/admin-ajax.php',
                            data: {
                                action: 'bees_unique_get_list',
                                "email_value": this.info[0].value, // email
                            },
                            beforeSend: function() {
                                $(".loader").show();
                            },
                            success: function(response) {
                                response = jQuery.parseJSON(response);
                                console.log(response);
                                if (response.success == 'false') {
                                    $(".loader").hide();
                                    document.querySelector('input#um-submit-btn').click()
                                    // else {
                                        // toastr.success('Registration successfull')
                                        // document.querySelector('input#um-submit-btn').click()
                                        // currentStep++
                                    // }
                                } else {
                                    toastr["warning"](response.message)
                                    $(".loader").hide();
                                }
                            },
                            // complete: function(response) {
                            //     $(".loader").hide();
                            //     toastr["warning"](response.message)
                            //     console.log(response)
                            // }
                        })
                    }
            },
            onUpdate(i, val) {
                let field = this.info[i];
                field.value = val.trim();
                field.valid = field.pattern.test(field.value);
            },
            formReady(stepNumber) {
                return Object.values(stepNumber).every(val => val);
            },
            agree() {
                this.step1.agreeBtn = true
                console.log('click')
            },
            unAgree() {
                this.step1.agreeBtn = false
                console.log('click')
            },

            sendForm() {
                if (this.formReady) {
                    this.formDone = true;
                }
            },
            // onclick increase step
            stepHandler(e, callBack) {
                this.currentStep++
                this.isActive = true
                callBack ? callBack() : null
            },
            setActive(i, val) {
                this.step2Ready = true
                let field = this.types[i];
                document.querySelector('input[data-key=account_type]').value = this.types[i].title
                this.step2.title = field.title;
                this.step2.img = field.img;
                this.step2.desc = field.desc;
            },

            countryDropdown(e) {
                // e.path[0].textContent its DOM node where place choosed country
                if (e.path[0].textContent != 'All') {
                    countryValue = e.path[0].textContent
                    this.step3.country = countryValue
                    let countryRecipient = document.querySelector('#select2-country-container')
                    countryRecipient.title = countryValue
                    countryRecipient.innerHTML = countryValue

                }
            },
            alert(e) {
                // languege dropdown handler
                let btn = e.target.closest('.dropdown-toggle')
                let dropdown = btn?.nextSibling
                let languageRecipient = document.querySelector('span.select2-selection.select2-selection--multiple[aria-owns=select2-languages-results] .select2-selection__rendered')
                if (languageRecipient) {
                    languageRecipient.innerHTML = btn.textContent
                }
                if (btn.title) {
                    console.dir(btn.title)
                    this.step3.lang = btn.title
                }
            },
            appendStyle(e) {
                e.target.ClassList.add('jump-to-type')
            }
        }
    })
    app.mount('#signUp-page');
</script>
<style>
    .jump-to-type {
        position: absolute;
        top: -620px;
        transform: rotate(360deg);
        transition: 2s ease;
    }

    .progress {
        width: 100%;
        height: 40px;
        background: #E1E4E8;
        border-radius: 20px;
        overflow: hidden;
    }


    .progress-bar {

        display: block;
        height: 100%;
        background: linear-gradient(80deg, #FFE596, #FFA9DD 17%, #DBBAFF 34%, #A9FFEF 51%, #FFE596 68%, #FFA9DD 85%, #DBBAFF);
        background-size: 300% 100%;
        animation: progress-animation 6s linear infinite;
    }

    @keyframes progress-animation {
        0% {
            background-position: 100%;

        }

        100% {

            background-position: 0;
        }
    }
    .icon-enter-active{
		animation: iconIn 0.5s;
	}

	.icon-leave-active{
		animation: iconOut 0.5s;
	}

	.icon-appear{
		animation: iconAppear 0.5s;
	}

	@keyframes iconIn {
		from{ transform: rotateY(-90deg); }
		to{ transform: rotateY(0); }
	}

	@keyframes iconOut {
		from{ transform: rotateY(0); }
		to{ transform: rotateY(90deg); }
	}

	@keyframes iconAppear {
		from{ opacity: 0; }
		to{ opacity: 1; }
	}
</style>


<?php
get_footer();
?>
