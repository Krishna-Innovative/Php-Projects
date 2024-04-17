<?php
/*Template name: Beepopular*/
get_header();
?>

<div class="inner_main_page_section_cls">
    <div class="subscription_page">
        <div class="container">
            <div class="progress custom_progress">
                <img src="<?php echo imgPATH; ?>Bee.png" class="progress_icon" />
                <div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 67%;"></div>
            </div>
            <!-- secound step -->
            <div class="step well">
                <div class="step_heading">
                    <h2>Membership</h2>
                    <div class="step_subheading">
                        <h4 class="popular"> Bee Popular</h4>
                        <p>Step 2 of 3</p>
                        <p>Select discount and payment frequency</p>
                    </div>
                </div>


                <div class="section_plans select_discount_section">
                    <div class="plans">


                        <div class="sub_headings_section">
                            <h4 class="sub1">Payment frequency</h4>
                            <h4 class="sub2">Cancel any time</h4>
                        </div>
                        <label class="plan new_plan_list plan-list bee-smart-plan" for="bee-smart" id="">
                            <a href="/bee-popular-monthly/?add-to-cart=6469">
                                <input type="radio" name="plan" id="bee-smart">
                                <div class="plan-content">
                                    <span><i>0%</i></span>
                                </div>

                                <div class="inner_paln smart_inner_plan">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Payment frequency</h4>
                                            <span>Monthly</span>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Cancel any time</h4>
                                            <span><i class="right"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </label>

                        <label class="plan new_plan_list plan-list bee-seen-plan" for="bee-smart" id="">
                            <a href="/bee-popular-quarterly/?add-to-cart=6471">
                                <input type="radio" name="plan" id="bee-seen">
                                <div class="plan-content">
                                    <span><i>10%</i></span>
                                </div>

                                <div class="inner_paln seen_inner_plan">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Payment frequency</h4>
                                            <span>Every 3 months</span>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Cancel any time</h4>
                                            <span>
                                                <i class="right"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </label>

                        <label class="plan new_plan_list plan-list bee-popular-plan" for="bee-smart" id="">
                            <a href="/bee-popular-biannual/?add-to-cart=6473">
                                <input type="radio" name="plan" id="bee-popular">
                                <div class="plan-content">
                                    <span><i>20%</i></span>
                                </div>

                                <div class="inner_paln popular_inner_plan">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Payment frequency</h4>
                                            <span>Every 6 months</span>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Cancel any time</h4>
                                            <span>
                                                <i class="right"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </label>

                        <label class="plan new_plan_list plan-list bee-influential-plan" for="bee-smart" id="">
                            <a href="/bee-popular-yearly/?add-to-cart=6818">
                                <input type="radio" name="plan" id="bee-influential">
                                <div class="plan-content">
                                    <span><i>30%</i></span>
                                </div>

                                <div class="inner_paln inf_inner_plan">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Payment frequency</h4>
                                            <span>Yearly</span>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="mobile_sub_heading">Cancel any time</h4>
                                            <span>
                                                <i class="right"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </label>

                    </div>
                </div>
                <!--<div class="next_step butt step_btns_group">
					  		<button type="button" class="back-btn">
                                <img src="/wp-content/uploads/2022/01/Back-Button.png" />
                            </button>
                            <button type="button" class="next-btn action next">
                                <img src="/wp-content/uploads/2022/01/Next-button-1.png" />
                            </button>
                        </div> -->
            </div>
        </div>
    </div>
</div>
<?php
get_footer(); ?>