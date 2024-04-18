<?php
/*Template name:post create template*/
get_header();
?>

<div class="inner_main_page_section_cls">
    <div class="subscription_page">
        <div class="container">
            <div class="progress custom_progress">
                <img src="<?php echo imgPATH; ?>Bee.png" class="progress_icon" />
                <div class="progress-bar active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <!-- first step -->
            <div class="step well">
                <div class="step_heading">
                    <h2><?php echo get_field('product_heading'); ?></h2>
                    <div class="step_subheading">
                        <p>Step 1 of 3</p>
                        <p><?php echo get_field('product_subheading'); ?></p>
                    </div>
                </div>
                <div class="section_plans">
                    <!--                 <h2><?php echo get_field('membership_heading'); ?></h2> -->
                    <ul class="goals_list">
                        <?php echo get_field('membership_description'); ?>
                    </ul>

                    <form id="" class="">
                        <div class="plans">
                            <div class="sub_headings_section">
                                <h4 class="sub1">Membership (per month)</h4>
                                <h4 class="sub2">Exact location</h4>
                                <h4 class="sub3">Honey earnings</h4>
                                <h4 class="sub4">Monthly flowers</h4>
                            </div>


                            <label class="plan bee-smart-plan" for="bee-smart">
                                <a href="/beesmart">
                                    <input type="radio" name="plan" id="bee-smart" />
                                    <div class="plan-content">
                                        <span>Bee <br /> Smart</span>
                                    </div>

                                    <div class="inner_paln smart_inner_plan">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Membership (per month)</h4>
                                                <span>$2</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Exact location</h4>
                                                <span>
                                                    <i class="false"></i>
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Honey earnings</h4>
                                                <span>50%</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Monthly flowers</h4>
                                                <span>1</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </label>

                            <label class="plan bee-seen-plan" for="bee-seen">
                                <a href="/beeseen">
                                    <input type="radio" id="bee-seen" name="plan" />
                                    <div class="plan-content">
                                        <span>Bee <br /> Seen</span>
                                    </div>
                                    <div class="inner_paln seen_inner_plan">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Membership (per month)</h4>
                                                <span>$4</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Exact location</h4>
                                                <span>
                                                    <i class="right"></i>
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Honey earnings</h4>
                                                <span>60%</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Monthly flowers</h4>
                                                <span>4</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </label>

                            <label class="plan bee-popular-plan" for="bee-popular">
                                <a href="/beepopular">
                                    <input type="radio" id="bee-popular" name="plan" />
                                    <div class="plan-content">
                                        <span>Bee <br /> Popular</span>
                                    </div>

                                    <div class="inner_paln popular_inner_plan">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Membership (per month)</h4>
                                                <span>$6</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Exact location</h4>
                                                <span>
                                                    <i class="right"></i>
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Honey earnings</h4>
                                                <span>70%</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Monthly flowers</h4>
                                                <span>8</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </label>

                            <label class="plan bee-influential-plan" for="bee-influential">
                                <a href="/beeinfluential/">
                                    <input type="radio" id="bee-influential" name="plan" />
                                    <div class="plan-content">
                                        <span>Bee <br /> Influential</span>
                                    </div>

                                    <div class="inner_paln inf_inner_plan">
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Membership (per month)</h4>
                                                <span>$8</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Exact location</h4>
                                                <span>
                                                    <i class="right"></i>
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Honey earnings</h4>
                                                <span>80%</span>
                                            </div>
                                            <div class="col-12">
                                                <h4 class="mobile_sub_heading">Monthly flowers</h4>
                                                <span>16</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </label>

                            <!--  <?php
                                    $args = array(
                                        'post_type'      => 'product',
                                        'posts_per_page' => 10,
                                        'order' => 'ASC'
                                    );

                                    $loop = new WP_Query($args);
                                    $class_value = 1;
                                    while ($loop->have_posts()) : $loop->the_post();
                                        global $product;
                                        global  $woocommerce;

                                        // echo 
                                        $_product = wc_get_product(get_the_ID());
                                        $product = new WC_Product_Variable(get_the_ID());
                                        $variations = $product->get_available_variations();
                                        //echo '<pre>';print_r($variations);echo '</pre>';
                                        if ($class_value == 1) {
                                            $class = "bee-smart-plan";
                                            $product_id = "bee-smart";
                                            $innerplan = "smart_inner_plan";
                                        } elseif ($class_value == 2) {
                                            $class = "bee-seen-plan";
                                            $product_id = "bee-seen";
                                            $innerplan = "seen_inner_plan";
                                        } elseif ($class_value == 3) {
                                            $class = "bee-popular-plan";
                                            $product_id = "bee-popular";
                                            $innerplan = "popular_inner_plan";
                                        } elseif ($class_value == 4) {
                                            $class = "bee-influential-plan";
                                            $product_id = "bee-influential";
                                            $innerplan = "inf_inner_plan";
                                        }
                                        $currency_symbol = get_woocommerce_currency_symbol();
                                        echo '<label class="plan new_plan_list plan-list ' . $class . '" for="bee-smart" id=' . get_the_ID() . '>
                            <input checked type="radio" name="plan" id=' . $product_id . ' />
                            <div class="plan-content">
                                <span><i>' . get_the_title() . '</i></span>
                            </div>

                            <div class="inner_paln ' . $innerplan . '">
                                <div class="row">
                                    <div class="col-12">
                                       <h4 class="mobile_sub_heading">Membership (per month)</h4>
                                        <span>' . $currency_symbol . ' ' . $_product->get_price() . '</span>
                                    </div>
                                    ' . $loop->post->post_excerpt . '
                                </div>
                            </div>
                        </label>';
                                        /*echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';*/
                                        $class_value++;
                                    endwhile;

                                    wp_reset_query();
                                    ?> -->




                            <!-- <div class="next_step">
                            <button type="button" class="next-btn action next">
                                <img src="/wp-content/uploads/2022/01/Next-button-1.png" />
                            </button>
                        </div> -->

                        </div>
                    </form>

                </div>
            </div>

            <!-- secound step -->
            <div class="step well">
                <div class="step_heading">
                    <h2><?php echo get_field('product_heading'); ?></h2>
                    <div class="step_subheading">
                        <h4 class="seen"> Bee Seen</h4>
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
                        <label class="plan new_plan_list plan-list bee-smart-plan" for="bee-smart" id="5786">
                            <input checked="" type="radio" name="plan" id="bee-smart">
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
                        </label><label class="plan new_plan_list plan-list bee-seen-plan" for="bee-smart" id="5801">
                            <input checked="" type="radio" name="plan" id="bee-seen">
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
                        </label><label class="plan new_plan_list plan-list bee-popular-plan" for="bee-smart" id="5809">
                            <input checked="" type="radio" name="plan" id="bee-popular">
                            <div class="plan-content">
                                <span><i>25%</i></span>
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
                        </label><label class="plan new_plan_list plan-list bee-influential-plan active" for="bee-smart" id="5814">
                            <input checked="" type="radio" name="plan" id="bee-influential">
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
                        </label>

                    </div>
                </div>
                <!-- 					 <div class="select_discount">
<img src="/wp-content/uploads/2022/01/Pineapple-discount.png" class="discount_img" /> 
                            <div class="inner_discount w-100">
                            <label class="discount-sel">Select discount:</label>
                             <ul id="get_selected">
      <li><a href="#">Home</a></li>
      
    </ul>
    							<input type="hidden" id="tempDiscount" value="">
                                <ul class="select"  id="get_selected">
									<li value="<?php echo $code_list->ID; ?>" class="active"> <span>0%</span></li>
									<?php global $wpdb;

                                    // Get an array of all existing coupon codes
                                    $coupon_codes = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'shop_coupon' AND post_status = 'publish' ORDER BY post_name ASC");

                                    $code = array();
                                    $loop = 0;
                                    foreach ($coupon_codes as $code_list) {
                                        $code[$loop]['coupon_code'] = $code_list->post_title;
                                        $code[$loop]['coupon_code_id'] = $code_list->ID;
                                    ?>
									<li value="<?php echo $code_list->ID; ?>"><span><?php echo $code_list->post_title; ?></span></li>
									<?php
                                        //	print_r($code_list);
                                        $loop++;
                                    }
                                    ?>                     
                                  
                                </ul>
                            </div>
                        </div> -->
                <div class="next_step butt step_btns_group">
                    <button type="button" class="back-btn">
                        <img src="/wp-content/uploads/2022/01/Back-Button.png" />
                    </button>
                    <button type="button" class="next-btn action next">
                        <img src="/wp-content/uploads/2022/01/Next-button-1.png" />
                    </button>
                </div>
            </div>

            <!-- third step -->
            <div class="step well">
                <div class="step_heading">
                    <h2>Membership</h2>
                    <div class="step_subheading">
                        <p>Step 3 of 3</p>
                        <p>Review</p>
                    </div>
                </div>
                <div class="section_cart cart_page">
                    <!-- <h2>Your members</h2> -->
                    <div class="select_membership">
                        <h4 class="seen">Bee <br /> Seen</h4>
                        <p class="plan_name">
                            <span>$4 per month</span>
                            <span>Discount: 20%</span>
                            <span>(Every 6 months)</span>
                        </p>
                        <p>Total: <span class="total_price "></span></p>
                    </div>

                    <!-- <div class="setup_payment">
					  <h2>Set up Payment</h2>
						<p>Your membership starts as soon as you set up payment.</p>
						<p>No commitments, Cancel online at any time.</p>
					</div> -->

                </div>
                <div class="next_step click-t step_btns_group">
                    <button type="button" class="back-btn">
                        <img src="/wp-content/uploads/2022/01/Back-Button.png" />
                    </button>
                    <button type="button" class="next-btn action next">
                        <img src="/wp-content/uploads/2022/02/Confirm-button.png" />
                    </button>
                </div>
            </div>


            <!--  <div class="section_plans bliing_details">
               <!-- <div class="membership_tittle"> 
                  <h2>Your membership</h2>
                </div>-->
            <!-- <form id="" class="">
					 <div class="billing_form"> 
					  <div class="member_image"> 
					   <img src="/wp-content/uploads/ultimatemember/197/profile_photo.jpg" />
					  </div>
						<div class="form-group">
						  <input type="text" class="form-control" id="" placeholder="First name">
						</div>
						 <div class="form-group">
						  <input type="email" class="form-control" id="" placeholder="Last name">
						</div>
						 <div class="form-group">
						   <select class="form-control">
							   <option selected disabled>Country</option>
							   <option>India</option>
							   <option>Australia</option>
							   <option>Canada</option>
							 </select>
						 </div>
						 <div class="agree">
						   <p class="mb-0">Bee Seen membership, $4 etc etc ect,</p>
						   <p class="mb-0">By ticking the box below, you agree to our Terms of Use, Privacy Statement, and that you are over 18.</p>
						   <p class="mb-0">Beesmart will automatically continue your membership and charge your selected membership fee to your payment method until you cancel at any time to avoid future charges.</p>

						   <div class="checkbox"> 
							 <input type="checkbox" id="" name="abc" value="">
							 <label for="abc"> I agree</label>
							</div>
						 </div>
					 </div>

					<div class="payment_btns">
						<div class="secure">Secure server <img src="/wp-content/uploads/2022/01/padlock-1-1.png" class="secure_icon">
						</div>
						<button class="btn w-100">Credit or debit card 
							<img src="/wp-content/uploads/2022/01/visa.png" class="visa_icon">
							<img src="/wp-content/uploads/2022/01/mastercard_PNG23.png" class="master_icon">
							<img src="/wp-content/uploads/2022/01/american-express-1.png" class="american_icon">
						</button>

						<button class="btn w-100">Paypal<img src="/wp-content/uploads/2022/01/paypal.png" class="paypal_icon"></button>
					</div>

				  </form>
				</div>-->
        </div>

        <!--  <div class="next_step center-next">
						<button type="button" class="next-btn action next">
						  <img src="/bee/wp-content/uploads/2022/01/Next-button-1.png" />
						</button>
					</div>
	 -->
    </div>

</div>
</div>

<div style="clear:both"></div>

<? php // echo do_shortcode('[coupon_code_listing]');
?>
<?php
get_footer();
?>
<script>
    $(document).ready(function() {
        $(".new_plan_list").on('click', function(e) {
            e.preventDefault();
            $('.new_plan_list').removeClass("active");
            $(this).addClass("active");
            var product_id = $(this).attr('id');
            // $.ajax({
            //            type : "POST",
            //         // dataType : "json",
            //            url : "/wp-admin/admin-ajax.php",
            //            data : {action: "get_subscription_variation",'product_id':product_id},
            //            success: function(response) {
            // 		response = jQuery.parseJSON(response);

            // 		  var toAppend = '';
            // 		 var dataa=response.data;
            // 	   jQuery.each(dataa,function(key, value){
            // 		  console.log(value)
            // 		     toAppend+='<option value='+value.variation_id+' data-price='+value.display_price+'>'+value.attributes.attribute_pricing+'</option>';

            // 	  });
            // 		 jQuery("#get_selected").html(toAppend);
            //               }
            //       });
        })
    })



    $(document).ready(function() {
        $("#get_selected li").click(function() {
            var tempval = $(this).text();
            // alert(tempval);
            $("#tempDiscount").attr("value", tempval);
        })
        var current = 1;


        widget = $(".step");
        btnnext = $(".next");
        btnback = $(".back");
        btnsubmit = $(".submit");

        // Init buttons and UI
        widget.not(':eq(0)').hide();
        hideButtons(current);
        setProgress(current);
        // Next button click action
        btnnext.click(function() {
            if (current < widget.length) {
                if ($(".new_plan_list.active")[0]) {
                    var product_id = $('.new_plan_list.active').attr('id');
                    var product_variants = $("#tempDiscount").attr("value");
                    $.ajax({
                        type: "POST",
                        // dataType : "json",
                        url: "/wp-admin/admin-ajax.php",
                        data: {
                            action: "get_details_of_variants",
                            'product_id': product_id,
                            'discount': product_variants
                        },
                        success: function(response) {
                            response = jQuery.parseJSON(response);
                            var toAppend = '';
                            var dataa = response.data;
                            //alert(dataa);
                            console.log('data', dataa);
                            var display_price = dataa.display_price;
                            //  var plan_name= dataa.plan_name;
                            var product_name = dataa.product_name;

                            var product_discount = dataa.discount;
                            // alert(product_discount);

                            if (product_discount == '10% Every 3 Month') {
                                display_price = display_price * 3;
                                var display_discount = (display_price - display_price * 10 / 100).toFixed(2);
                            } else if (product_discount == '20% Every 6 month') {
                                display_price = display_price * 6;
                                var display_discount = (display_price - display_price * 20 / 100).toFixed(2);
                            } else if (product_discount == '30% Every 12 Month') {
                                display_price = display_price * 12;
                                var display_discount = (display_price - display_price * 30 / 100).toFixed(2);

                            } else {

                                var display_discount = display_price;
                            }

                            jQuery(".total_price").text('$ ' + display_discount);
                            // jQuery(".plan_name").text(plan_name);
                            jQuery(".first_membership").text(product_name);
                            //jQuery(".plan_name").text(product_discount);
                        }
                    })
                    widget.show();
                    widget.not(':eq(' + (current++) + ')').hide();
                    setProgress(current);
                } else {
                    alert('Please choose one membership plan');
                    return false;

                }
            }
            hideButtons(current);
        });

        // Back button click action 	
        btnback.click(function() {
            // alert('sdfsdg');
            if (current > 1) {
                current = current - 2;
                btnnext.trigger('click');
            }
            hideButtons(current);
        });
    });

    // Change progress bar action
    setProgress = function(currstep) {
        var percent = parseFloat(100 / widget.length) * currstep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
            .html(percent + "%");
    }

    // Hide buttons according to the current step
    hideButtons = function(current) {
        var limit = parseInt(widget.length);

        $(".action").hide();

        if (current < limit) {
            //alert('step2');
            btnnext.show();
        }
        if (current > 1) {
            btnback.show();
        }
        if (current == 3) {
            btnnext.show();
            btnnext.click(function() {
                window.location.href = "<?php echo site_url(); ?>/checkout/?add-to-cart=" + product_id + "&quantity[1]&coupon_code=" + coupon_code;
            })
            //$('.progress.custom_progress').hide();
            var product_id = $(".new_plan_list.active").attr('id');
            var coupon_code = $("#tempDiscount").attr("value");

        }
        if (current == limit) {
            btnsubmit.show();
        }
    }
</script>
<script>
    $(".select li").on("click", function() {
        $(".select li").removeClass("active");
        $(this).addClass("active");
    });
</script>
<style type="text/css">
    .select li {
        /* 	display: inline-flex;
	padding: 5px;
	background: #aee2ff; */
        border-radius: 10px;
        border: 5px solid #fff;
        box-shadow: 0px -0px 2px;
        text-align: center;
        text-transform: uppercase;
        font-size: 20px;
        width: 178px;
        font-weight: 900;
        cursor: pointer;
        justify-content: center;
        list-style: none;
    }

    .select_discount {
        display: flex;
        margin-left: 50px;
        align-items: center;
        padding: 15px 10px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        background: #fff;
        border-radius: 20px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        max-width: 850px;
        margin: 30px auto;
        /* margin-bottom: 30px; */
        margin-bottom: 80px;
    }

    .select .next-btn {
        background: transparent;
        border: none;
        padding: 0;
        position: absolute;
        bottom: 50px;
        right: 101px;
    }

    .step_heading p {
        color: #555555;
    }

    .select_discount .inner_discount label {
        text-align: center;
        font-size: 20px;
        font-weight: 900;
        margin-bottom: 25px;
        color: #000;
    }

    .next_step.butt .next-btn {
        position: absolute;
        bottom: -7px;
        right: 113px;
    }

    .next_step.click-t .next-btn {
        position: absolute;
        bottom: -103px;
        right: 3px;
    }

    .next_step.click-t.step_btns_group button.back-btn {
        position: absolute;
        bottom: -103px;
        left: -91px;
    }

    .step_btns_group button.back-btn {
        position: absolute;
        bottom: -10px;
        left: 114px;
    }

    .next_step.click-t.step_btns_group {
        max-width: 200px;
        width: auto;
        margin: auto;
    }

    @media(max-width: 991px) {

        .select li {
            width: 100%;
            margin-top: 10px;
        }

        .next_step.butt .next-btn {
            position: absolute;
            bottom: 19px;
            right: 0px;
        }

        .step_btns_group button.back-btn {
            bottom: 23px;
            left: 20px;
        }

        .next_step.click-t .next-btn {
            bottom: -120px;
            right: -95px;
        }

        .next_step.click-t.step_btns_group button.back-btn {
            bottom: -122px;
        }
    }
</style>