<style>
    #slider-distance {
        position: relative;
        height: 80px;
        border-radius: 10px;
        text-align: left;
        margin: 45px 50px 10px 50px;
    }

    #slider-distance>div {
        position: absolute;
        left: 13px;
        right: 15px;
        height: 14px;
    }

    #slider-distance>div>[inverse-left] {
        position: absolute;
        left: 0;
        height: 14px;
        border-radius: 10px;
        background-color: whitesmoke;
        margin: 0 7px;
        border: 1px solid #e1e2e7;
    }

    #slider-distance>div>[inverse-right] {
        position: absolute;
        right: 0;
        height: 14px;
        border-radius: 10px;
        background-color: whitesmoke;
        margin: 0 7px;
        border: 1px solid #e1e2e7;
    }

    #slider-distance>div>[range] {
        position: absolute;
        left: 0;
        height: 14px;
        border-radius: 14px;
        background-color: #ffd834;
    }

    #slider-distance>div>[thumb] {
        position: absolute;
        top: -7px;
        z-index: 2;
        height: 28px;
        width: 28px;
        text-align: left;
        margin-left: -11px;
        cursor: pointer;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.4);
        background-color: #FFF;
        border-radius: 50%;
        outline: none;
    }

    #slider-distance>input[type=range] {
        position: absolute;
        pointer-events: none;
        -webkit-appearance: none;
        z-index: 3;
        height: 14px;
        top: -2px;
        width: 100%;
        -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
        filter: alpha(opacity=0);
        -moz-opacity: 0;
        -khtml-opacity: 0;
        opacity: 0;
    }

    #slider-distance>input[type=range]::-ms-track {
        -webkit-appearance: none;
        background: transparent;
        color: transparent;
    }

    #slider-distance>input[type=range]::-moz-range-track {
        -moz-appearance: none;
        background: transparent;
        color: transparent;
    }

    #slider-distance>input[type=range]:focus::-webkit-slider-runnable-track {
        background: transparent;
        border: transparent;
    }

    #slider-distance>input[type=range]:focus {
        outline: none;
    }

    #slider-distance>input[type=range]::-ms-thumb {
        pointer-events: all;
        width: 28px;
        height: 28px;
        border-radius: 0px;
        border: 0 none;
        background: red;
    }

    #slider-distance>input[type=range]::-moz-range-thumb {
        pointer-events: all;
        width: 28px;
        height: 28px;
        border-radius: 0px;
        border: 0 none;
        background: red;
    }

    #slider-distance>input[type=range]::-webkit-slider-thumb {
        pointer-events: all;
        width: 28px;
        height: 28px;
        border-radius: 0px;
        border: 0 none;
        background: red;
        -webkit-appearance: none;
    }

    #slider-distance>input[type=range]::-ms-fill-lower {
        background: transparent;
        border: 0 none;
    }

    #slider-distance>input[type=range]::-ms-fill-upper {
        background: transparent;
        border: 0 none;
    }

    #slider-distance>input[type=range]::-ms-tooltip {
        display: none;
    }

    #slider-distance>div>[sign] {
        position: absolute;
        margin-left: -11px;
        top: -7px;
        z-index: 3;
        /* background-color: #1ABC9C; */
        color: #444;
        width: 28px;
        height: 28px;
        border-radius: 28px;
        -webkit-border-radius: 28px;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        text-align: center;
    }

    #slider-distance>div>[sign]>span {
        font-size: 12px;
        font-weight: 700;
        line-height: 28px;
    }

    .main_age_slider .age_text {
        position: relative;
    }

    .main_age_slider .min-age_text {
        position: absolute;
        bottom: -50px;
        left: 40px;
    }

    .main_age_slider .max-age_text {
        position: absolute;
        bottom: -50px;
        right: 40px;
    }

    @media screen and (max-width: 991px) {
        #slider-distance {
            position: relative;
            height: 50px;
            border-radius: 10px;
            text-align: left;
            margin: 45px 20px 10px 20px;
        }

        .main_age_slider .min-age_text {
            left: 10px;
        }

        .main_age_slider .max-age_text {
            right: 10px;
        }
    }
</style>

<div class="inner_main_page_section_cls news_details_main">
    <div class="container">

        <section id="premium-step-form" class="news_details_section">
            <form>
                <div class="warpper">
                    <div class="details_heading">
                        <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Create-Button-News.png" class="right_icon" />
                        <h2>News</h2>
                        <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/sunflower1.png" class="left_icon" />
                    </div>
                    <div class="main_checkboxes">
                        <div class="row">
                            <!-- by found -->
                            <div class="acf-field acf-field-checkbox acf-field-6242b46338a96 elem-Befound" data-name="f_be_found" data-type="checkbox" data-key="field_6242b46338a96">
                                <!-- <div class="acf-label">
                                    <label for="acf-field_6242b46338a96">Be found</label>
                                </div> -->
                                <div class="acf-input">
                                    <input type="hidden" name="acf[field_6242b46338a96]">
                                    <ul class="acf-checkbox-list acf-hl">
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Music" name="acf[field_6242b46338a96][]" value="Music"> Music</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Dance" name="acf[field_6242b46338a96][]" value="Dance"> Dance</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Fashion" name="acf[field_6242b46338a96][]" value="Fashion"> Fashion</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Art" name="acf[field_6242b46338a96][]" value="Art"> Art</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Celebrity" name="acf[field_6242b46338a96][]" value="Celebrity"> Celebrity</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Health" name="acf[field_6242b46338a96][]" value="Health"> Health</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Fun" name="acf[field_6242b46338a96][]" value="Fun"> Fun</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Influencer" name="acf[field_6242b46338a96][]" value="Influencer"> Influencer</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Travel" name="acf[field_6242b46338a96][]" value="Travel"> Travel</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Motivation" name="acf[field_6242b46338a96][]" value="Motivation"> Motivation</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Sport" name="acf[field_6242b46338a96][]" value="Sport"> Sport</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Gaming" name="acf[field_6242b46338a96][]" value="Gaming"> Gaming</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Trolling" name="acf[field_6242b46338a96][]" value="Trolling"> Trolling</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Comedy" name="acf[field_6242b46338a96][]" value="Comedy"> Comedy</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Resume-(CV)" name="acf[field_6242b46338a96][]" value="Resume (CV)"> Resume (CV)</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Expert" name="acf[field_6242b46338a96][]" value="Expert"> Expert</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Business" name="acf[field_6242b46338a96][]" value="Business"> Business</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Finance" name="acf[field_6242b46338a96][]" value="Finance"> Finance</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Stonks" name="acf[field_6242b46338a96][]" value="Stonks"> Stonks</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Technology" name="acf[field_6242b46338a96][]" value="Technology"> Technology</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b46338a96-Religion" name="acf[field_6242b46338a96][]" value="Religion"> Religion</label></li>
                                    </ul>
                                </div>


                            </div>

                            <!-- find some one -->
                            <div class="acf-field acf-field-checkbox acf-field-6242b51838a97 elem-Findsomeone" data-name="f_find_someone" data-type="checkbox" data-key="field_6242b51838a97">
                                <!-- <div class="acf-label">
                                    <label for="acf-field_6242b51838a97">Find someone</label>
                                </div> -->
                                <div class="acf-input">
                                    <input type="hidden" name="acf[field_6242b51838a97]">
                                    <ul class="acf-checkbox-list acf-hl">
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Friends" name="acf[field_6242b51838a97][]" value="Friends"> Friends</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Hobby-partner" name="acf[field_6242b51838a97][]" value="Hobby partner"> Hobby partner</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Business-associate" name="acf[field_6242b51838a97][]" value="Business associate"> Business associate</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Teammate" name="acf[field_6242b51838a97][]" value="Teammate"> Teammate</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Romance" name="acf[field_6242b51838a97][]" value="Romance"> Romance</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Travel-buddy" name="acf[field_6242b51838a97][]" value="Travel buddy"> Travel buddy</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Faith-mate" name="acf[field_6242b51838a97][]" value="Faith mate"> Faith mate</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Band-member" name="acf[field_6242b51838a97][]" value="Band member"> Band member</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Fling/casual" name="acf[field_6242b51838a97][]" value="Fling/casual"> Fling/casual</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Study-buddy" name="acf[field_6242b51838a97][]" value="Study buddy"> Study buddy</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Group-member" name="acf[field_6242b51838a97][]" value="Group member"> Group member</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b51838a97-Other" name="acf[field_6242b51838a97][]" value="Other"> Other</label></li>
                                    </ul>
                                </div>
                                <div class="acf-field acf-field-text acf-field-625361291f481" data-name="f_about_me" data-type="text" data-key="field_625361291f481">
                                    <div class="acf-label">
                                        <label for="acf-field_625361291f481">About me</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap"><input type="text" id="acf-field_625361291f481" name="acf[field_625361291f481]"></div>
                                    </div>
                                </div>
                                <div class="acf-field acf-field-text acf-field-6253614e1f482" data-name="f_im_looking_for" data-type="text" data-key="field_6253614e1f482">
                                    <div class="acf-label">
                                        <label for="acf-field_6253614e1f482">I'm looking for</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap"><input type="text" id="acf-field_6253614e1f482" name="acf[field_6253614e1f482]"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sell and Buy -->
                            <div class="acf-field acf-field-checkbox acf-field-6242b58338a98 elem-SellandBuy" data-name="f_sell_and_buy" data-type="checkbox" data-key="field_6242b58338a98">
                                <!-- <div class="acf-label">
                                    <label for="acf-field_6242b58338a98">Sell and Buy</label>
                                </div> -->
                                <div class="acf-input">
                                    <input type="hidden" name="acf[field_6242b58338a98]">
                                    <ul class="acf-checkbox-list acf-hl">
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Fashion" name="acf[field_6242b58338a98][]" value="Fashion"> Fashion</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Art" name="acf[field_6242b58338a98][]" value="Art"> Art</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Business" name="acf[field_6242b58338a98][]" value="Business"> Business</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Cart-and-vehicles" name="acf[field_6242b58338a98][]" value="Cart and vehicles"> Cart and vehicles</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Books" name="acf[field_6242b58338a98][]" value="Books"> Books</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Digital-products" name="acf[field_6242b58338a98][]" value="Digital products"> Digital products</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Beauty" name="acf[field_6242b58338a98][]" value="Beauty"> Beauty</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Food" name="acf[field_6242b58338a98][]" value="Food"> Food</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Health" name="acf[field_6242b58338a98][]" value="Health"> Health</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Houses/homes" name="acf[field_6242b58338a98][]" value="Houses/homes"> Houses/homes</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Media/music" name="acf[field_6242b58338a98][]" value="Media/music"> Media/music</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Household-items" name="acf[field_6242b58338a98][]" value="Household items"> Household items</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Kitchen" name="acf[field_6242b58338a98][]" value="Kitchen"> Kitchen</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Services" name="acf[field_6242b58338a98][]" value="Services"> Services</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Tech" name="acf[field_6242b58338a98][]" value="Tech"> Tech</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Venue-hire" name="acf[field_6242b58338a98][]" value="Venue hire"> Venue hire</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Coupons" name="acf[field_6242b58338a98][]" value="Coupons"> Coupons</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b58338a98-Tradesman-services" name="acf[field_6242b58338a98][]" value="Tradesman services"> Tradesman services</label></li>
                                    </ul>
                                </div>
                                <div class="block_title">
                                    <h4 class="">Info</h4>
                                </div>
                                <!-- price type -->
                                <div class="acf-field acf-field-select acf-field-6253630e1f484 -c0" style="width: 50%; min-height: 140px;" data-name="f_price_type" data-type="select" data-key="field_6253630e1f484" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_6253630e1f484">Price type</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_6253630e1f484" class="" name="acf[field_6253630e1f484]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value=""></option>
                                            <option value="Fixed">Fixed</option>
                                            <option value="Negotiable">Negotiable</option>
                                            <option value="Free">Free</option>
                                            <option value="Swap/Trade">Swap/Trade</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- booking -->
                                <div class="acf-field acf-field-select acf-field-625363521f485" style="width: 50%; min-height: 140px;" data-name="f_booking" data-type="select" data-key="field_625363521f485" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_625363521f485">Booking</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_625363521f485" class="" name="acf[field_625363521f485]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value="Is a booking required?">Is a booking required?</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Events -->
                            <div class="acf-field acf-field-checkbox acf-field-6242b60838a99 elem-Checkbox" data-name="f_events" data-type="checkbox" data-key="field_6242b60838a99">
                                <!-- <div class="acf-label">
                                    <label for="acf-field_6242b60838a99">Events</label>
                                </div> -->
                                <div class="acf-input">
                                    <input type="hidden" name="acf[field_6242b60838a99]">
                                    <ul class="acf-checkbox-list acf-hl">
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Holiday" name="acf[field_6242b60838a99][]" value="Holiday"> Holiday</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Art" name="acf[field_6242b60838a99][]" value="Art"> Art</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Business" name="acf[field_6242b60838a99][]" value="Business"> Business</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Celebrity" name="acf[field_6242b60838a99][]" value="Celebrity"> Celebrity</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Community" name="acf[field_6242b60838a99][]" value="Community"> Community</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Family" name="acf[field_6242b60838a99][]" value="Family"> Family</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Fashion" name="acf[field_6242b60838a99][]" value="Fashion"> Fashion</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Festival" name="acf[field_6242b60838a99][]" value="Festival"> Festival</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Food" name="acf[field_6242b60838a99][]" value="Food"> Food</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Health" name="acf[field_6242b60838a99][]" value="Health"> Health</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Movies" name="acf[field_6242b60838a99][]" value="Movies"> Movies</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Music" name="acf[field_6242b60838a99][]" value="Music"> Music</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Politics" name="acf[field_6242b60838a99][]" value="Politics"> Politics</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Religion" name="acf[field_6242b60838a99][]" value="Religion"> Religion</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Live" name="acf[field_6242b60838a99][]" value="Live"> Live</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Science" name="acf[field_6242b60838a99][]" value="Science"> Science</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Tech" name="acf[field_6242b60838a99][]" value="Tech"> Tech</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Inspiring" name="acf[field_6242b60838a99][]" value="Inspiring"> Inspiring</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Funny" name="acf[field_6242b60838a99][]" value="Funny"> Funny</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Wholesome" name="acf[field_6242b60838a99][]" value="Wholesome"> Wholesome</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b60838a99-Kids" name="acf[field_6242b60838a99][]" value="Kids"> Kids</label></li>
                                    </ul>
                                </div>
                                <div class="block_title">
                                    <h4 class="">Info</h4>
                                </div>
                                <div class="acf-field acf-field-select acf-field-62536d5b56e79 -c0" style="width: 50%; min-height: 140px;" data-name="f_suitible" data-type="select" data-key="field_62536d5b56e79" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_62536d5b56e79">Suitible for all ages?</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_62536d5b56e79" class="" name="acf[field_62536d5b56e79]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value="Suitible for all ages?">Suitible for all ages?</option>
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="acf-field acf-field-select acf-field-62536db756e7a" style="width: 50%; min-height: 140px;" data-name="f_is_special_offer" data-type="select" data-key="field_62536db756e7a" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_62536db756e7a">Is this a special offer ?</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_62536db756e7a" class="" name="acf[field_62536db756e7a]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value="Is this a special offer ?">Is this a special offer ?</option>
                                            <option value="yes">yes</option>
                                            <option value="no">no</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="acf-field acf-field-date-time-picker acf-field-62536e0856e7b -c0" style="width: 50%; min-height: 121px;" data-name="f_date_selecter" data-type="date_time_picker" data-key="field_62536e0856e7b" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_62536e0856e7b">Date selector</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-date-time-picker acf-input-wrap" data-date_format="dd/mm/yy" data-time_format="h:mm tt" data-first_day="1">
                                            <input type="hidden" id="acf-field_62536e0856e7b" class="input-alt" name="acf[field_62536e0856e7b]" value=""> <input type="text" class="input" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="acf-field acf-field-text acf-field-62536e3f56e7c" style="width: 50%; min-height: 121px;" data-name="f_ticket_cost" data-type="text" data-key="field_62536e3f56e7c" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_62536e3f56e7c">Ticket cost</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap"><input type="text" id="acf-field_62536e3f56e7c" name="acf[field_62536e3f56e7c]"></div>
                                    </div>
                                </div>
                            </div>


                            <!-- news -->
                            <div class="acf-field acf-field-checkbox acf-field-6242b6af38a9a elem-News" data-name="f_news" data-type="checkbox" data-key="field_6242b6af38a9a">
                                <!-- <div class="acf-label">
                                    <label for="acf-field_6242b6af38a9a">News</label>
                                </div> -->
                                <div class="acf-input">
                                    <input type="hidden" name="acf[field_6242b6af38a9a]">
                                    <ul class="acf-checkbox-list acf-hl">
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Breaking" name="acf[field_6242b6af38a9a][]" value="Breaking"> Breaking</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Art" name="acf[field_6242b6af38a9a][]" value="Art"> Art</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Business" name="acf[field_6242b6af38a9a][]" value="Business"> Business</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Community" name="acf[field_6242b6af38a9a][]" value="Community"> Community</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Family" name="acf[field_6242b6af38a9a][]" value="Family"> Family</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Fashion" name="acf[field_6242b6af38a9a][]" value="Fashion"> Fashion</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-World" name="acf[field_6242b6af38a9a][]" value="World"> World</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Finance" name="acf[field_6242b6af38a9a][]" value="Finance"> Finance</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Health" name="acf[field_6242b6af38a9a][]" value="Health"> Health</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Medicine" name="acf[field_6242b6af38a9a][]" value="Medicine"> Medicine</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Music" name="acf[field_6242b6af38a9a][]" value="Music"> Music</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Politics" name="acf[field_6242b6af38a9a][]" value="Politics"> Politics</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Weather" name="acf[field_6242b6af38a9a][]" value="Weather"> Weather</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Science" name="acf[field_6242b6af38a9a][]" value="Science"> Science</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Tech" name="acf[field_6242b6af38a9a][]" value="Tech"> Tech</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Inspiring" name="acf[field_6242b6af38a9a][]" value="Inspiring"> Inspiring</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Funny" name="acf[field_6242b6af38a9a][]" value="Funny"> Funny</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b6af38a9a-Kids" name="acf[field_6242b6af38a9a][]" value="Kids"> Kids</label></li>
                                    </ul>
                                </div>
                                <div class="block_title">
                                    <h4 class="">Info</h4>
                                </div>
                                <div class="acf-field acf-field-select acf-field-625363d31f486 -c0" style="width: 50%; min-height: 140px;" data-name="f_theme" data-type="select" data-key="field_625363d31f486" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_625363d31f486">Theme</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_625363d31f486" class="" name="acf[field_625363d31f486]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value="Positive">Positive</option>
                                            <option value="Negative">Negative</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="acf-field acf-field-select acf-field-625364161f487" style="width: 50%; min-height: 140px;" data-name="f_paywall" data-type="select" data-key="field_625364161f487" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_625364161f487">Paywall</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_625364161f487" class="" name="acf[field_625364161f487]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value="Does the content  have a paywall?">Does the content have a paywall?</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Hire some one -->
                            <div class="acf-field acf-field-checkbox acf-field-6242b72d38a9b elem-Hiresomeone" data-name="f_hire_someone" data-type="checkbox" data-key="field_6242b72d38a9b">
                                <!-- <div class="acf-label">
                                    <label for="acf-field_6242b72d38a9b">Hire someone</label>
                                </div> -->
                                <div class="acf-input">
                                    <input type="hidden" name="acf[field_6242b72d38a9b]">
                                    <ul class="acf-checkbox-list acf-hl">
                                        <li><label><input type="checkbox" id="acf-field_6242b72d38a9b-One-off-job" name="acf[field_6242b72d38a9b][]" value="One-off job"> One-off job</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b72d38a9b-Casual" name="acf[field_6242b72d38a9b][]" value="Casual"> Casual</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b72d38a9b-Full-time" name="acf[field_6242b72d38a9b][]" value="Full-time"> Full-time</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b72d38a9b-Volunteer" name="acf[field_6242b72d38a9b][]" value="Volunteer"> Volunteer</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b72d38a9b-Part-time" name="acf[field_6242b72d38a9b][]" value="Part-time"> Part-time</label></li>
                                        <li><label><input type="checkbox" id="acf-field_6242b72d38a9b-Contract" name="acf[field_6242b72d38a9b][]" value="Contract"> Contract</label></li>
                                    </ul>
                                </div>
                                <div class="block_title">
                                    <h4 class="">Skill</h4>
                                </div>
                                <div class="acf-field acf-field-select acf-field-625364981f488 -c0" style="width: 50%; min-height: 140px;" data-name="f_skill_level" data-type="select" data-key="field_625364981f488" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_625364981f488">Skill level</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_625364981f488" class="" name="acf[field_625364981f488]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value="Skill level">Skill level</option>
                                            <option value="Novice">Novice</option>
                                            <option value="Advanced">Advanced</option>
                                            <option value="Expert">Expert</option>
                                            <option value="Hobby">Hobby</option>
                                            <option value="Any">Any</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="acf-field acf-field-select acf-field-625364e71f489" style="width: 50%; min-height: 140px;" data-name="f_pay_visibility" data-type="select" data-key="field_625364e71f489" data-width="50">
                                    <div class="acf-label">
                                        <label for="acf-field_625364e71f489">Pay visibility</label>
                                    </div>
                                    <div class="acf-input">
                                        <select id="acf-field_625364e71f489" class="" name="acf[field_625364e71f489]" data-ui="0" data-ajax="0" data-multiple="0" data-placeholder="Select" data-allow_null="0">
                                            <option value="Pay visibility">Pay visibility</option>
                                            <option value="Shown">Shown</option>
                                            <option value="Hidden">Hidden</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="block_title">
                                    <h4 class="">About</h4>
                                </div>
                                <div class="acf-field acf-field-text acf-field-625361291f481" data-name="f_about_me" data-type="text" data-key="field_625361291f481">
                                    <div class="acf-label">
                                        <label for="aboutForHire">About me</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap"><input type="text" id="aboutForHire" name="acf[field_625361291f481]"></div>
                                    </div>
                                </div>
                                <div class="acf-field acf-field-text acf-field-6253614e1f482" data-name="f_im_looking_for" data-type="text" data-key="field_6253614e1f482">
                                    <div class="acf-label">
                                        <label for="aboutForHire">I'm looking for</label>
                                    </div>
                                    <div class="acf-input">
                                        <div class="acf-input-wrap"><input type="text" id="lookingForHire" name="acf[field_6253614e1f482]"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-xs-12  bf-start-row">
                                <div class="bf_field_group elem-Befound"><label for="Befound">Be found</label>
                                    <div class="bf-input">
                                        <div class="checkbox"><label class="settings-input form-control  music"><input id="Befound-0" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Music" class="garlic-auto-save"><span> Music</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  dance"><input id="Befound-1" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Dance" class="garlic-auto-save"><span> Dance</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  fashion"><input id="Befound-2" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Fashion" class="garlic-auto-save"><span> Fashion</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  art"><input id="Befound-3" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Art" class="garlic-auto-save"><span> Art</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  celebrity"><input id="Befound-4" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Celebrity" class="garlic-auto-save"><span> Celebrity</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  health"><input id="Befound-5" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Health" class="garlic-auto-save"><span> Health</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  fun"><input id="Befound-6" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Fun" class="garlic-auto-save"><span> Fun</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  influencer"><input id="Befound-7" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Influencer" class="garlic-auto-save"><span> Influencer</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  travel"><input id="Befound-8" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Travel" class="garlic-auto-save"><span> Travel</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  motivation"><input id="Befound-9" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Motivation" class="garlic-auto-save"><span> Motivation</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  sport"><input id="Befound-10" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Sport" class="garlic-auto-save"><span> Sport</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  gaming"><input id="Befound-11" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Gaming" class="garlic-auto-save"><span> Gaming</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  trolling"><input id="Befound-12" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Trolling" class="garlic-auto-save"><span> Trolling</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  comedy"><input id="Befound-13" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Comedy" class="garlic-auto-save"><span> Comedy</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  resume-cv"><input id="Befound-14" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Resume (CV)" class="garlic-auto-save"><span> Resume (CV)</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  expert"><input id="Befound-15" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Expert" class="garlic-auto-save"><span> Expert</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  business"><input id="Befound-16" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Business" class="garlic-auto-save"><span> Business</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  finance"><input id="Befound-17" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Finance" class="garlic-auto-save"><span> Finance</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  stonks"><input id="Befound-18" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Stonks" class="garlic-auto-save"><span> Stonks</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  technology"><input id="Befound-19" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Technology" class="garlic-auto-save"><span> Technology</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  religion"><input id="Befound-20" type="checkbox" name="Be-found[]" field_id="2f02d77ef8" data-form="create-post" frontend_reset="" value="Religion" class="garlic-auto-save"><span> Religion</span>
                                            </label></div>
                                        <div class="checkbox"></div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- by found -->

                            <!-- find someone -->

                            <!-- <div class="col-xs-12  bf-start-row">
                                <div class="bf_field_group elem-Findsomeone"><label for="Findsomeone">Find
                                        someone</label>
                                    <div class="bf-input">
                                        <div class="checkbox"><label class="settings-input form-control  friends"><input id="Findsomeone-0" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Friends" class="garlic-auto-save"><span> Friends</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  hobby-partner"><input id="Findsomeone-1" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Hobby partner" class="garlic-auto-save"><span> Hobby partner</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  business-associate"><input id="Findsomeone-2" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Business associate" class="garlic-auto-save"><span> Business associate</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  teammate"><input id="Findsomeone-3" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Teammate" class="garlic-auto-save"><span> Teammate</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  romance"><input id="Findsomeone-4" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Romance" class="garlic-auto-save"><span> Romance</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  travel-buddy"><input id="Findsomeone-5" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Travel buddy" class="garlic-auto-save"><span> Travel buddy</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  faith-mate"><input id="Findsomeone-6" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Faith mate" class="garlic-auto-save"><span> Faith mate</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  band-member"><input id="Findsomeone-7" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Band member" class="garlic-auto-save"><span> Band member</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  fling-casual"><input id="Findsomeone-8" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Fling/casual" class="garlic-auto-save"><span> Fling/casual</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  study-buddy"><input id="Findsomeone-9" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Study buddy" class="garlic-auto-save"><span> Study buddy</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  group-member"><input id="Findsomeone-10" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Group member" class="garlic-auto-save"><span> Group member</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  other"><input id="Findsomeone-11" type="checkbox" name="Find-someone[]" field_id="b03acb8c83" data-form="create-post" frontend_reset="" value="Other" class="garlic-auto-save"><span> Other</span>
                                            </label></div>
                                        <div class="checkbox"></div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- find someone -->


                            <!-- sell and buy -->

                            <!-- <div class="col-xs-12  bf-start-row">
                                <div class="bf_field_group elem-SellandBuy"><label for="SellandBuy">Sell and Buy</label>
                                    <div class="bf-input">
                                        <div class="checkbox"><label class="settings-input form-control  fashion"><input id="SellandBuy-0" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Fashion" class="garlic-auto-save"><span> Fashion</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  art"><input id="SellandBuy-1" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Art" class="garlic-auto-save"><span> Art</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  business"><input id="SellandBuy-2" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Business" class="garlic-auto-save"><span> Business</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  cart-and-vehicles"><input id="SellandBuy-3" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Cart and vehicles" class="garlic-auto-save"><span> Cart and vehicles</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  books"><input id="SellandBuy-4" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Books" class="garlic-auto-save"><span> Books</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  digital-products"><input id="SellandBuy-5" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Digital products" class="garlic-auto-save"><span> Digital products</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  beauty"><input id="SellandBuy-6" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Beauty" class="garlic-auto-save"><span> Beauty</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  food"><input id="SellandBuy-7" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Food" class="garlic-auto-save"><span> Food</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  health"><input id="SellandBuy-8" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Health" class="garlic-auto-save"><span> Health</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  houses-homes"><input id="SellandBuy-9" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Houses/homes" class="garlic-auto-save"><span> Houses/homes</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  media-music"><input id="SellandBuy-10" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Media/music" class="garlic-auto-save"><span> Media/music</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  household-items"><input id="SellandBuy-11" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Household items" class="garlic-auto-save"><span> Household items</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  kitchen"><input id="SellandBuy-12" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Kitchen" class="garlic-auto-save"><span> Kitchen</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  services"><input id="SellandBuy-13" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Services" class="garlic-auto-save"><span> Services</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  tech"><input id="SellandBuy-14" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Tech" class="garlic-auto-save"><span> Tech</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  venue-hire"><input id="SellandBuy-15" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Venue hire" class="garlic-auto-save"><span> Venue hire</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  coupons"><input id="SellandBuy-16" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Coupons" class="garlic-auto-save"><span> Coupons</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  tradesman-services"><input id="SellandBuy-17" type="checkbox" name="Sell-and-Buy[]" field_id="e710e571cb" data-form="create-post" frontend_reset="" value="Tradesman services" class="garlic-auto-save"><span> Tradesman services</span>
                                            </label></div>
                                        <div class="checkbox"></div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- sell and buy -->

                            <!-- event  -->

                            <!-- <div class="col-xs-12  bf-start-row">
                                <div class="bf_field_group elem-Checkbox"><label for="Checkbox">Events</label>
                                    <div class="bf-input">
                                        <div class="checkbox"><label class="settings-input form-control  holiday"><input id="Checkbox-0" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Holiday" class="garlic-auto-save"><span> Holiday</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  art"><input id="Checkbox-1" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Art" class="garlic-auto-save"><span> Art</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  business"><input id="Checkbox-2" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Business" class="garlic-auto-save"><span> Business</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  celebrity"><input id="Checkbox-3" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Celebrity" class="garlic-auto-save"><span> Celebrity</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  community"><input id="Checkbox-4" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Community" class="garlic-auto-save"><span> Community</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  family"><input id="Checkbox-5" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Family" class="garlic-auto-save"><span> Family</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  fashion"><input id="Checkbox-6" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Fashion" class="garlic-auto-save"><span> Fashion</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  festival"><input id="Checkbox-7" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Festival" class="garlic-auto-save"><span> Festival</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  food"><input id="Checkbox-8" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Food" class="garlic-auto-save"><span> Food</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  health"><input id="Checkbox-9" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Health" class="garlic-auto-save"><span> Health</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  movies"><input id="Checkbox-10" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Movies" class="garlic-auto-save"><span> Movies</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  music"><input id="Checkbox-11" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Music" class="garlic-auto-save"><span> Music</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  politics"><input id="Checkbox-12" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Politics" class="garlic-auto-save"><span> Politics</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  religion"><input id="Checkbox-13" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Religion" class="garlic-auto-save"><span> Religion</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  live"><input id="Checkbox-14" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Live" class="garlic-auto-save"><span> Live</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  science"><input id="Checkbox-15" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Science" class="garlic-auto-save"><span> Science</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  tech"><input id="Checkbox-16" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Tech" class="garlic-auto-save"><span> Tech</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  inspiring"><input id="Checkbox-17" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Inspiring" class="garlic-auto-save"><span> Inspiring</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  funny"><input id="Checkbox-18" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Funny" class="garlic-auto-save"><span> Funny</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  wholesome"><input id="Checkbox-19" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Wholesome" class="garlic-auto-save"><span> Wholesome</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  kids"><input id="Checkbox-20" type="checkbox" name="Checkbox[]" field_id="3c44db1a55" data-form="create-post" frontend_reset="" value="Kids" class="garlic-auto-save"><span> Kids</span>
                                            </label></div>
                                        <div class="checkbox"></div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- event  -->


                            <!-- news -->

                            <!-- <div class="col-xs-12  bf-start-row">
                                <div class="bf_field_group elem-News"><label for="News">News</label>
                                    <div class="bf-input">
                                        <div class="checkbox"><label class="settings-input form-control  breaking"><input id="News-0" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Breaking" class="garlic-auto-save"><span> Breaking</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  art"><input id="News-1" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Art" class="garlic-auto-save"><span> Art</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  business"><input id="News-2" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Business" class="garlic-auto-save"><span> Business</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  community"><input id="News-3" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Community" class="garlic-auto-save"><span> Community</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  family"><input id="News-4" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Family" class="garlic-auto-save"><span> Family</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  fashion"><input id="News-5" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Fashion" class="garlic-auto-save"><span> Fashion</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  world"><input id="News-6" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="World" class="garlic-auto-save"><span> World</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  finance"><input id="News-7" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Finance" class="garlic-auto-save"><span> Finance</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  health"><input id="News-8" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Health" class="garlic-auto-save"><span> Health</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  medicine"><input id="News-9" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Medicine" class="garlic-auto-save"><span> Medicine</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  music"><input id="News-10" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Music" class="garlic-auto-save"><span> Music</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  politics"><input id="News-11" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Politics" class="garlic-auto-save"><span> Politics</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  weather"><input id="News-12" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Weather" class="garlic-auto-save"><span> Weather</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  science"><input id="News-13" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Science" class="garlic-auto-save"><span> Science</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  tech"><input id="News-14" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Tech" class="garlic-auto-save"><span> Tech</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  insriring"><input id="News-15" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Insriring" class="garlic-auto-save"><span> Insriring</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  funny"><input id="News-16" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Funny" class="garlic-auto-save"><span> Funny</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  kids"><input id="News-17" type="checkbox" name="News[]" field_id="77a7d97a89" data-form="create-post" frontend_reset="" value="Kids" class="garlic-auto-save"><span> Kids</span> </label></div>
                                        <div class="checkbox"></div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- news -->


                            <!-- hire someone -->

                            <div class="col-xs-12  bf-start-row">
                                <div class="bf_field_group elem-Hiresomeone"><label for="Hiresomeone">Hire
                                        someone</label>
                                    <div class="bf-input">
                                        <div class="checkbox"><label class="settings-input form-control  one-off-job"><input id="Hiresomeone-0" type="checkbox" name="Hire-someone[]" field_id="a1893333a6" data-form="create-post" frontend_reset="" value="One-off job" class="garlic-auto-save"><span> One-off job</span> </label>
                                        </div>
                                        <div class="checkbox"><label class="settings-input form-control  casual"><input id="Hiresomeone-1" type="checkbox" name="Hire-someone[]" field_id="a1893333a6" data-form="create-post" frontend_reset="" value="Casual" class="garlic-auto-save"><span> Casual</span>
                                            </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  full-time"><input id="Hiresomeone-2" type="checkbox" name="Hire-someone[]" field_id="a1893333a6" data-form="create-post" frontend_reset="" value="Full-time" class="garlic-auto-save"><span> Full-time</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  volunteer"><input id="Hiresomeone-3" type="checkbox" name="Hire-someone[]" field_id="a1893333a6" data-form="create-post" frontend_reset="" value="Volunteer" class="garlic-auto-save"><span> Volunteer</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  part-time"><input id="Hiresomeone-4" type="checkbox" name="Hire-someone[]" field_id="a1893333a6" data-form="create-post" frontend_reset="" value="Part-time" class="garlic-auto-save"><span> Part-time</span> </label></div>
                                        <div class="checkbox"><label class="settings-input form-control  contract"><input id="Hiresomeone-5" type="checkbox" name="Hire-someone[]" field_id="a1893333a6" data-form="create-post" frontend_reset="" value="Contract" class="garlic-auto-save"><span> Contract</span>
                                            </label></div>
                                        <div class="checkbox"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- hire someone -->

                            <?php //get_template_part( 'popups-items/check-boxes' ); 
                            ?>
                            <!-- <div class="col-md-4 col-6">
                                <div class="checkboxes">
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="1" name="" value="" checked>
                                         <label class="" for="1">Breaking</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="2" name="" value="">
                                       <label class="" for="2">Art</label>
                                     </div>
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="3" name="" value="">
                                         <label class="" for="3">Business</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="4" name="" value="">
                                       <label class="" for="4">Community</label>
                                     </div>
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="5" name="" value="">
                                         <label class="" for="5">Family</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="6" name="" value="">
                                       <label class="" for="6">Fashion</label>
                                     </div>
                              </div>
                               </div>
                            <div class="col-md-4 col-6">
                                <div class="checkboxes">
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="7" name="" value="" checked>
                                         <label class="" for="7">World</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="8" name="" value="">
                                       <label class="" for="8">Finance</label>
                                     </div>
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="9" name="" value="">
                                         <label class="" for="9">Health</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="10" name="" value="">
                                       <label class="" for="10">Medicine</label>
                                     </div>
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="11" name="" value="">
                                         <label class="" for="11">Music</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="12" name="" value="">
                                       <label class="" for="12">Politics</label>
                                     </div>
                              </div>
                               </div>
                                 <div class="col-md-4 col-6">
                                <div class="checkboxes">
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="13" name="" value="" checked>
                                         <label class="" for="13">Weather</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="14" name="" value="">
                                       <label class="" for="14">Science</label>
                                     </div>
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="15" name="" value="">
                                         <label class="" for="15">Tech</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="16" name="" value="">
                                       <label class="" for="16">Insriring</label>
                                     </div>
                                     <div class="form-check">
                                         <input type="checkbox" class="" id="17" name="" value="">
                                         <label class="" for="17">Funny</label>
                                     </div>
                                     <div class="form-check">
                                       <input type="checkbox" class="" id="18" name="" value="">
                                       <label class="" for="18">Kids</label>
                                     </div>
                              </div>
                           </div> -->
                        </div>
                    </div>

                    <div class="main_audience">
                        <h4 class="">Audience</h4>
                        <div class="audience_inner">
                            <label class="single_audience" for="local">
                                <input checked type="radio" name="audience" id="local" value="local" />
                                <div class="audience-content">
                                    <img loading="lazy" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Metadata-local.png" alt="local" />
                                    <span>Local</span>
                                </div>
                            </label>

                            <label class="single_audience" for="national">
                                <input type="radio" name="audience" id="national" value="national" />
                                <div class="audience-content">
                                    <img loading="lazy" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Metadata-National.png" alt="national" />
                                    <span>National</span>
                                </div>
                            </label>

                            <label class="single_audience" for="global">
                                <input type="radio" name="audience" id="global" value="global" />
                                <div class="audience-content">
                                    <img loading="lazy" src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Metadata-Global.png" alt="global" />
                                    <span>Global</span>
                                </div>
                            </label>
                            <label class="single_audience" for="online">
                                <input type="radio" name="audience" id="online" value="online" />
                                <div class="audience-content">
                                    <img loading="lazy" src="<?php echo  site_url();?>/wp-content/uploads/2022/03/Metadata-Online.png" alt="online" />
                                    <span>Online</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- <div class="block_title">
                        <h4 class="">Info</h4>
                    </div> -->
                    <!-- <div class="about_fields">
                        <h4 class="">About</h4>
                        <div class="form-group">
                            <input type="email" class="form-control" id="" placeholder="About me (text field)">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="" placeholder="I'm looking for (text field)">
                        </div>
                    </div> -->


                    <!-- <div class="main_age_slider">
                        <h4 class="">Age range</h4>
                        <div class="age_text">
                            <span class="min-age_text">18</span>
                            <span class="max-age_text">20</span>
                        </div>
                        <div slider id="slider-distance">
                            <div>
                                <div inverse-left style="width:70%;"></div>
                                <div inverse-right style="width:70%;"></div>
                                <div range style="left:30%;right:40%;"></div>
                                <span thumb style="left:30%;"></span>
                                <span thumb style="left:60%;"></span>
                                <div sign style="left:30%;">
                                    <span id="value">30</span>
                                </div>
                                <div sign style="left:60%;">
                                    <span id="value">60</span>
                                </div>
                            </div>

                            <input type="range" tabindex="0" value="30" max="100" min="0" step="1" oninput="
							  this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
							  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
							  var children = this.parentNode.childNodes[1].childNodes;
							  children[1].style.width=value+'%';
							  children[5].style.left=value+'%';
							  children[7].style.left=value+'%';children[11].style.left=value+'%';
							  children[11].childNodes[1].innerHTML=this.value;" />

                            <input type="range" tabindex="0" value="60" max="100" min="0" step="1" oninput="
							  this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
							  var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
							  var children = this.parentNode.childNodes[1].childNodes;
							  children[3].style.width=(100-value)+'%';
							  children[5].style.right=(100-value)+'%';
							  children[9].style.left=value+'%';children[13].style.left=value+'%';
							  children[13].childNodes[1].innerHTML=this.value;" />

                        </div>
                    </div> -->
                </div>
                <div class="steps-navigation premium-navigation">
                    <button class="step-btn" data-id="step-premium-prev">
                        <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Back-Button.png" alt="previes step"></button>
                    <button class="step-btn next-step__button" data-id="step-premium-next">
                        <img src="<?php echo esc_url(home_url('')); ?>/wp-content/uploads/2022/01/Next-Button.png" alt=""></button>
                </div>

            </form>
        </section>
    </div>
</div>
