<div class="gmw-form-wrapper default gmw-pt-default-form-wrapper pt">
    <form class="gmw-form" name="gmw_form" action="" method="get" data-id="7" data-prefix="pt">

        <div id="search_navigation" class="">
            <div class="search-nav-block">
                <button type="button" class="search-nav-btn" data-toggle="modal" data-target="#search_filters">
                    <img src="<?php echo imgPATH; ?>Blue-tools.png">
                    <span>Tools</span>
                </button>

            </div>

            <div class="search-nav-block">
                <button type="button" class="search-nav-btn" data-toggle="modal" data-target="#search_sorts_by">
                    <img src="<?php echo imgPATH; ?>Blue-Sort.png">
                    <span>Sort</span>
                </button>

            </div>

            <div id="sample-feed-save" class="search-nav-block text-left">
                <button type="button" class="search-nav-btn save heartBeat-animation" data-toggle="modal" data-target="#saves_query" data-step="sample-saveFeedPopup">
                    <img src="<?php echo imgPATH; ?>Blue-save.png">
                    <span>Save</span>
                </button>
            </div>



        </div>

        <div class="sreachinput_group">
            <div class="search_by_keyword_block test_block_example">
                <img src="<?php echo imgPATH; ?>Tags.png" class="tag_icon" alt="img">
                <input type="text" name="customkeywords" id="search_by_keyword_input">
                <button type="button" name="customsubmitbtn" id="custo_submit_btm_sample"></button>
            </div>
        </div>

    </form>



    <!-- END SAVE FEED  -->
    <div class="modal fade custom_trsparent_modal search_filter edit_category_modal edit_feed_modal" id="saves_query" style="display: none;" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                </div>
                <div class="modal-body pt-0">
                    <div class="search_filter_steps">
                        <div class="saved_feed_search">
                            <input value="Happy!" disabled type="text" class="form-control" placeholder="Enter your feed name" id="name-feed" name="name-feed">
                        </div>
                        <div class="saved_feed_block">
                            <div class="select_sticker save_icons_block ml-0">
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/019-chat.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/033-disabled%20sign.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/020-chalice.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/026-ribbon.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/038-kayak.png"> </div>
                                <div class="item icon_item active special"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/046-pride.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/019-palm.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/020-microphone.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/042-Watercolor.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/027-clarinet.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/047-clothes.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/029-Blindness.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/014-plant.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/016-snowy.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/010-jack.png"> </div>
                                <div class="item icon_item"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/022-maple%20leaf.png"> </div>
                            </div>
                            <button type="button" class="sample-reload_btn" id="">
                                <img src="<?php echo imgPATH; ?>Check1.png" alt="check">
                            </button>
                            <button disabled="disabled" type="button" data-step="sample-goToSideBat" class="locked sample-saveFeed">
                                <img src="<?php echo imgPATH; ?>Check.png" alt="check">
                            </button>
                        </div>
                        <div class="edit_feeds_btns">
                            <a href="#" class="visibility_btn_add disable"> <img src="<?php echo imgPATH; ?>Visibility.png">
                                <p>Sharing</p>
                            </a>
                        </div>
                        <input type="hidden" value="0" id="visibility_type">
                        <input type="hidden" value="" id="feed_have" name="feed_have">
                        <input type="hidden" value="142" id="logged_in_user_id" name="logged_in_user_id">
                        <input type="hidden" id="pagecount" name="pagecount" value="1">
                    </div>
                </div>
                <div class="modal-footer justify-content-center tool_modal_footer sample-closeSaveFeed">
                    <a class="" data-dismiss="modal">
                        <img src="<?php echo imgPATH;?>X.png" width="40px">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END SAVE FEED  -->



</div>
<div style="opacity: 0.5;" class="mt-5 gmw-results-wrapper grid-gray gmw-pt-grid-gray-results-wrapper pt sample-post" data-id="7" data-prefix="pt" id="postdynamic">
    <div class="gmw-results">
        <style type="text/css">
            .alm-btn-wrap {
                display: block;
                text-align: center;
                padding: 10px 0;
                margin: 0 0 15px;
                position: relative
            }

            .alm-btn-wrap:after {
                display: table;
                clear: both;
                height: 0;
                content: ''
            }

            .alm-btn-wrap .alm-load-more-btn {
                font-size: 15px;
                font-weight: 500;
                width: auto;
                height: 43px;
                line-height: 1;
                background: #ed7070;
                -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                color: #fff;
                border: none;
                border-radius: 4px;
                margin: 0;
                padding: 0 20px;
                display: inline-block;
                position: relative;
                -webkit-transition: all .3s ease;
                transition: all .3s ease;
                text-align: center;
                text-decoration: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                cursor: pointer
            }

            .alm-btn-wrap .alm-load-more-btn.loading,
            .alm-btn-wrap .alm-load-more-btn:hover {
                background-color: #e06161;
                -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .09);
                box-shadow: 0 1px 3px rgba(0, 0, 0, .09);
                color: #fff;
                text-decoration: none
            }

            .alm-btn-wrap .alm-load-more-btn:active {
                -webkit-box-shadow: none;
                box-shadow: none;
                text-decoration: none
            }

            .alm-btn-wrap .alm-load-more-btn.loading {
                cursor: wait;
                outline: 0;
                padding-left: 44px
            }

            .alm-btn-wrap .alm-load-more-btn.done {
                cursor: default;
                opacity: .15;
                background-color: #ed7070;
                outline: 0 !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important
            }

            .alm-btn-wrap .alm-load-more-btn.done:before,
            .alm-btn-wrap .alm-load-more-btn:before {
                background: 0 0;
                width: 0
            }

            .alm-btn-wrap .alm-load-more-btn.loading:before {
                background: #fff url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/ajax-loader.gif) no-repeat center center;
                width: 30px;
                height: 31px;
                margin: 6px;
                border-radius: 3px;
                display: inline-block;
                z-index: 0;
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                overflow: hidden;
                -webkit-transition: width .5s ease-in-out;
                transition: width .5s ease-in-out
            }

            .alm-btn-wrap .alm-elementor-link {
                display: block;
                font-size: 13px;
                margin: 0 0 15px
            }

            @media screen and (min-width:768px) {
                .alm-btn-wrap .alm-elementor-link {
                    position: absolute;
                    left: 0;
                    top: 50%;
                    -webkit-transform: translateY(-50%);
                    -ms-transform: translateY(-50%);
                    transform: translateY(-50%);
                    margin: 0
                }
            }

            .ajax-load-more-wrap.white .alm-load-more-btn {
                background-color: #fff;
                color: #787878;
                border: 1px solid #e0e0e0;
                overflow: hidden;
                -webkit-transition: none;
                transition: none;
                outline: 0
            }

            .ajax-load-more-wrap.white .alm-load-more-btn.loading,
            .ajax-load-more-wrap.white .alm-load-more-btn:focus,
            .ajax-load-more-wrap.white .alm-load-more-btn:hover {
                background-color: #fff;
                color: #333;
                border-color: #aaa
            }

            .ajax-load-more-wrap.white .alm-load-more-btn.done {
                background-color: #fff;
                color: #444;
                border-color: #ccc
            }

            .ajax-load-more-wrap.white .alm-load-more-btn.loading {
                color: rgba(255, 255, 255, 0) !important;
                outline: 0 !important;
                background-color: transparent;
                border-color: transparent !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
                padding-left: 20px
            }

            .ajax-load-more-wrap.white .alm-load-more-btn.loading:before {
                margin: 0;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: transparent;
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/ajax-loader-lg.gif);
                background-size: 25px 25px;
                background-position: center center
            }

            .ajax-load-more-wrap.light-grey .alm-load-more-btn {
                background-color: #efefef;
                color: #787878;
                border: 1px solid #e0e0e0;
                overflow: hidden;
                -webkit-transition: all 75ms ease;
                transition: all 75ms ease;
                outline: 0
            }

            .ajax-load-more-wrap.light-grey .alm-load-more-btn.done,
            .ajax-load-more-wrap.light-grey .alm-load-more-btn.loading,
            .ajax-load-more-wrap.light-grey .alm-load-more-btn:focus,
            .ajax-load-more-wrap.light-grey .alm-load-more-btn:hover {
                background-color: #f1f1f1;
                color: #222;
                border-color: #aaa
            }

            .ajax-load-more-wrap.light-grey .alm-load-more-btn.loading {
                color: rgba(255, 255, 255, 0) !important;
                outline: 0 !important;
                background-color: transparent;
                border-color: transparent !important;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
                padding-left: 20px
            }

            .ajax-load-more-wrap.light-grey .alm-load-more-btn.loading:before {
                margin: 0;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: transparent;
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/ajax-loader-lg.gif);
                background-size: 25px 25px;
                background-position: center center
            }

            .ajax-load-more-wrap.blue .alm-load-more-btn {
                background-color: #1b91ca
            }

            .ajax-load-more-wrap.blue .alm-load-more-btn.done,
            .ajax-load-more-wrap.blue .alm-load-more-btn.loading,
            .ajax-load-more-wrap.blue .alm-load-more-btn:hover {
                background-color: #1b84b7
            }

            .ajax-load-more-wrap.green .alm-load-more-btn {
                background-color: #80ca7a
            }

            .ajax-load-more-wrap.green .alm-load-more-btn.done,
            .ajax-load-more-wrap.green .alm-load-more-btn.loading,
            .ajax-load-more-wrap.green .alm-load-more-btn:hover {
                background-color: #81c17b
            }

            .ajax-load-more-wrap.purple .alm-load-more-btn {
                background-color: #b97eca
            }

            .ajax-load-more-wrap.purple .alm-load-more-btn.done,
            .ajax-load-more-wrap.purple .alm-load-more-btn.loading,
            .ajax-load-more-wrap.purple .alm-load-more-btn:hover {
                background-color: #a477b1
            }

            .ajax-load-more-wrap.grey .alm-load-more-btn {
                background-color: #a09e9e
            }

            .ajax-load-more-wrap.grey .alm-load-more-btn.done,
            .ajax-load-more-wrap.grey .alm-load-more-btn.loading,
            .ajax-load-more-wrap.grey .alm-load-more-btn:hover {
                background-color: #888
            }

            .ajax-load-more-wrap.infinite>.alm-btn-wrap .alm-load-more-btn {
                width: 100%;
                background-color: transparent !important;
                background-position: center center;
                background-repeat: no-repeat;
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner.gif);
                border: none !important;
                opacity: 0;
                -webkit-transition: opacity .2s ease;
                transition: opacity .2s ease;
                -webkit-box-shadow: none !important;
                box-shadow: none !important;
                overflow: hidden;
                text-indent: -9999px;
                cursor: default !important;
                outline: 0 !important
            }

            .ajax-load-more-wrap.infinite>.alm-btn-wrap .alm-load-more-btn:before {
                display: none !important
            }

            .ajax-load-more-wrap.infinite>.alm-btn-wrap .alm-load-more-btn:active,
            .ajax-load-more-wrap.infinite>.alm-btn-wrap .alm-load-more-btn:focus {
                outline: 0
            }

            .ajax-load-more-wrap.infinite>.alm-btn-wrap .alm-load-more-btn.done {
                opacity: 0
            }

            .ajax-load-more-wrap.infinite>.alm-btn-wrap .alm-load-more-btn.loading {
                opacity: 1
            }

            .ajax-load-more-wrap.infinite.skype>.alm-btn-wrap .alm-load-more-btn {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-skype.gif)
            }

            .ajax-load-more-wrap.infinite.ring>.alm-btn-wrap .alm-load-more-btn {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-ring.gif)
            }

            .ajax-load-more-wrap.infinite.fading-blocks>.alm-btn-wrap .alm-load-more-btn {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/loader-fading-blocks.gif)
            }

            .ajax-load-more-wrap.infinite.fading-circles>.alm-btn-wrap .alm-load-more-btn {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/loader-fading-circles.gif)
            }

            .ajax-load-more-wrap.infinite.chasing-arrows>.alm-btn-wrap .alm-load-more-btn {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-chasing-arrows.gif)
            }

            .ajax-load-more-wrap.alm-horizontal .alm-btn-wrap {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: center;
                -ms-flex-align: center;
                align-items: center;
                padding: 0;
                margin: 0
            }

            .ajax-load-more-wrap.alm-horizontal .alm-btn-wrap button {
                margin: 0
            }

            .ajax-load-more-wrap.alm-horizontal .alm-btn-wrap button.done {
                display: none
            }

            .alm-btn-wrap--prev {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                width: 100%;
                -webkit-box-pack: center;
                -ms-flex-pack: center;
                justify-content: center;
                clear: both;
                padding: 0;
                margin: 0
            }

            .alm-btn-wrap--prev:after {
                display: table;
                clear: both;
                height: 0;
                content: ''
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev {
                line-height: 1;
                font-size: 14px;
                font-weight: 500;
                padding: 5px;
                display: inline-block;
                position: relative;
                margin: 0 0 15px;
                text-decoration: none
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev:focus,
            .alm-btn-wrap--prev a.alm-load-more-btn--prev:hover {
                text-decoration: underline
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.loading,
            .alm-btn-wrap--prev a.alm-load-more-btn--prev.loading:focus {
                cursor: wait;
                text-decoration: none
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.loading:before,
            .alm-btn-wrap--prev a.alm-load-more-btn--prev.loading:focus:before {
                content: '';
                display: block;
                position: absolute;
                left: -18px;
                top: 50%;
                -webkit-transform: translateY(-50%);
                -ms-transform: translateY(-50%);
                transform: translateY(-50%);
                width: 16px;
                height: 16px;
                background: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/ajax-loader-lg.gif) no-repeat left center;
                background-size: 16px 16px
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.skype.loading:before {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-skype.gif)
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.ring.loading:before {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-ring.gif)
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.fading-blocks.loading:before {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-fading-blocks.gif)
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.circles.loading:before {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-circles.gif)
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.chasing-arrows.loading:before {
                background-image: url(https://test2.local/wp-content/plugins/ajax-load-more/core/img/spinner-chasing-arrows.gif)
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev button:not([disabled]),
            .alm-btn-wrap--prev a.alm-load-more-btn--prev:not(.disabled) {
                cursor: pointer
            }

            .alm-btn-wrap--prev a.alm-load-more-btn--prev.done {
                display: none !important
            }

            .alm-listing .alm-reveal {
                outline: 0
            }

            .alm-listing .alm-reveal:after {
                display: table;
                clear: both;
                height: 0;
                content: ''
            }

            .alm-listing {
                margin: 0;
                padding: 0
            }

            .alm-listing .alm-paging-content>li,
            .alm-listing .alm-reveal>li,
            .alm-listing>li {
                position: relative
            }

            .alm-listing .alm-paging-content>li.alm-item,
            .alm-listing .alm-reveal>li.alm-item,
            .alm-listing>li.alm-item {
                background: 0 0;
                margin: 0 0 30px;
                padding: 0 0 0 80px;
                position: relative;
                list-style: none
            }

            @media screen and (min-width:480px) {

                .alm-listing .alm-paging-content>li.alm-item,
                .alm-listing .alm-reveal>li.alm-item,
                .alm-listing>li.alm-item {
                    padding: 0 0 0 100px
                }
            }

            @media screen and (min-width:768px) {

                .alm-listing .alm-paging-content>li.alm-item,
                .alm-listing .alm-reveal>li.alm-item,
                .alm-listing>li.alm-item {
                    padding: 0 0 0 135px
                }
            }

            @media screen and (min-width:1024px) {

                .alm-listing .alm-paging-content>li.alm-item,
                .alm-listing .alm-reveal>li.alm-item,
                .alm-listing>li.alm-item {
                    padding: 0 0 0 160px
                }
            }

            .alm-listing .alm-paging-content>li.alm-item h3,
            .alm-listing .alm-reveal>li.alm-item h3,
            .alm-listing>li.alm-item h3 {
                margin: 0
            }

            .alm-listing .alm-paging-content>li.alm-item p,
            .alm-listing .alm-reveal>li.alm-item p,
            .alm-listing>li.alm-item p {
                margin: 10px 0 0
            }

            .alm-listing .alm-paging-content>li.alm-item p.entry-meta,
            .alm-listing .alm-reveal>li.alm-item p.entry-meta,
            .alm-listing>li.alm-item p.entry-meta {
                opacity: .75
            }

            .alm-listing .alm-paging-content>li.alm-item img,
            .alm-listing .alm-reveal>li.alm-item img,
            .alm-listing>li.alm-item img {
                position: absolute;
                left: 0;
                top: 0;
                border-radius: 2px;
                max-width: 65px
            }

            @media screen and (min-width:480px) {

                .alm-listing .alm-paging-content>li.alm-item img,
                .alm-listing .alm-reveal>li.alm-item img,
                .alm-listing>li.alm-item img {
                    max-width: 85px
                }
            }

            @media screen and (min-width:768px) {

                .alm-listing .alm-paging-content>li.alm-item img,
                .alm-listing .alm-reveal>li.alm-item img,
                .alm-listing>li.alm-item img {
                    max-width: 115px
                }
            }

            @media screen and (min-width:1024px) {

                .alm-listing .alm-paging-content>li.alm-item img,
                .alm-listing .alm-reveal>li.alm-item img,
                .alm-listing>li.alm-item img {
                    max-width: 140px
                }
            }

            .alm-listing .alm-paging-content>li.no-img,
            .alm-listing .alm-reveal>li.no-img,
            .alm-listing>li.no-img {
                padding: 0
            }

            .alm-listing.products li.product {
                padding-left: inherit
            }

            .alm-listing.products li.product img {
                position: static;
                border-radius: inherit
            }

            .alm-listing.stylefree .alm-paging-content>li,
            .alm-listing.stylefree .alm-reveal>li,
            .alm-listing.stylefree>li {
                padding: inherit;
                margin: inherit
            }

            .alm-listing.stylefree .alm-paging-content>li img,
            .alm-listing.stylefree .alm-reveal>li img,
            .alm-listing.stylefree>li img {
                padding: inherit;
                margin: inherit;
                position: static;
                border-radius: inherit
            }

            .alm-listing.rtl .alm-paging-content>li,
            .alm-listing.rtl .alm-reveal>li {
                padding: 0 170px 0 0;
                text-align: right
            }

            .alm-listing.rtl .alm-paging-content>li img,
            .alm-listing.rtl .alm-reveal>li img {
                left: auto;
                right: 0
            }

            .alm-listing.rtl.products li.product {
                padding-right: inherit
            }

            .alm-masonry {
                display: block;
                overflow: hidden;
                clear: both
            }

            .alm-placeholder {
                opacity: 0;
                -webkit-transition: opacity .2s ease;
                transition: opacity .2s ease;
                display: none
            }

            .ajax-load-more-wrap.alm-horizontal {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: nowrap;
                flex-wrap: nowrap;
                width: 100%
            }

            .ajax-load-more-wrap.alm-horizontal .alm-listing,
            .ajax-load-more-wrap.alm-horizontal .alm-listing .alm-reveal {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: nowrap;
                flex-wrap: nowrap;
                -webkit-box-orient: horizontal;
                -webkit-box-direction: normal;
                -ms-flex-direction: row;
                flex-direction: row
            }

            .ajax-load-more-wrap.alm-horizontal .alm-listing .alm-reveal>li.alm-item,
            .ajax-load-more-wrap.alm-horizontal .alm-listing>li.alm-item {
                padding: 0;
                text-align: center;
                margin: 0 2px;
                padding: 20px 20px 30px;
                height: auto;
                background-color: #fff;
                border: 1px solid #efefef;
                border-radius: 4px;
                width: 300px
            }

            .ajax-load-more-wrap.alm-horizontal .alm-listing .alm-reveal>li.alm-item img,
            .ajax-load-more-wrap.alm-horizontal .alm-listing>li.alm-item img {
                position: static;
                border-radius: 100%;
                max-width: 125px;
                margin: 0 auto 15px;
                border-radius: 4px;
                -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, .075);
                box-shadow: 0 2px 10px rgba(0, 0, 0, .075)
            }

            .ajax-load-more-wrap.alm-horizontal .alm-listing .alm-reveal:after {
                display: none
            }

            .alm-toc {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                width: auto;
                padding: 10px 0
            }

            .alm-toc button {
                background: #f7f7f7;
                border-radius: 4px;
                -webkit-transition: all .15s ease;
                transition: all .15s ease;
                outline: 0;
                border: 1px solid #efefef;
                -webkit-box-shadow: none;
                box-shadow: none;
                color: #454545;
                cursor: pointer;
                font-size: 14px;
                font-weight: 500;
                padding: 7px 10px;
                line-height: 1;
                margin: 0 5px 0 0;
                height: auto
            }

            .alm-toc button:focus,
            .alm-toc button:hover {
                border-color: #ccc;
                color: #222
            }

            .alm-toc button:hover {
                text-decoration: underline
            }

            .alm-toc button:focus {
                -webkit-box-shadow: 0 0 0 3px rgba(0, 0, 0, .05);
                box-shadow: 0 0 0 3px rgba(0, 0, 0, .05)
            }
        </style>
        <div class="ajax-load-more-wrap default alm-0" data-alm-id="0" data-canonical-url="" data-slug="home" data-post-id="0" data-localized="ajax_load_more_vars" data-total-posts="73">
            <ul aria-live="polite" aria-atomic="true" class="alm-listing alm-ajax posts-list-wrapper" data-container-type="ul" data-loading-style="default" data-repeater="default" data-post-type="beeart" data-order="DESC" data-orderby="date" data-offset="0" data-posts-per-page="12" data-scroll="false" data-pause="false" data-button-label="Find More">
                <div class="alm-reveal" style="opacity: 1; height: auto; outline: none;">
                    <li class="single-post gmw-single-item gmw-single-post gmw-object-5599 gmw-location-221 first-location">
                        <div class="wrapper-inner">
                            <div class="post-content">
                                <div class="author-wrapper">
                                    <div class="addHive-block">
                                        <button>
                                            <img src="<?php echo imgPATH ?>Add-to-hive.png">
                                        </button>
                                    </div>
                                    <div class="author-block">
                                        <div class="author-img">
                                            <img class="author-avatar" src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg">
                                        </div>
                                        <div class="author_block_cnt mb-2">
                                            <h3 class="author-name mb-0"></h3>
                                        </div>
                                    </div>
                                    <div class="type-of-post">
                                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2021/11/Career.svg">
                                    </div>
                                </div>
                                <div class="loading"></div>
                                <div class="container-resposne_main">
                                    <div class="container-resposne"><img style="max-height:250px; max-width:100%;" src="https://preview.redd.it/6ssoivp0yq191.gif?format=png8&amp;s=a8ebaf948687b1b94ca9aaa0fb18754f1a5a86a2">
                                        <h2 class="title">such quality : memes</h2>
                                    </div>
                                </div>
                                <input type="text" class="meta-preview" value="https://www.reddit.com/r/memes/comments/uxzc6y/such_quality/">
                                <div class="top-wrapper">
                                    <div class="title-wrapper">
                                        <h2 class="post-title">
                                            <a href="https://test2.local/beeart/this-is-how-your-link-will-appear-to-others-if-you-cant-see-your-link-here-is-a-guide/">
                                                This is how your link will appear to others. If you can’t see your link, here is a guide.
                                            </a>
                                        </h2>
                                    </div>

                                    <div class="card-wrapper">
                                        <div class="honey-block">
                                            <div class="love"><input id="post_6907" type="checkbox" class="LoveCheck">
                                                <label for="post_6907" class="dashicons dashicons-heart LoveLabel" aria-label="like this"></label><span class="LoveCount">0</span>
                                            </div>
                                            <!--/love-->
                                        </div>
                                        <div class="honey_pot">
                                            <img src="<?php echo imgPATH; ?>03/Most-Honey.png" alt="">

                                            <div class="honey_pot_detail animate__animated animate__zoomInLeft">
                                                <ul>
                                                    <li>
                                                        <img src="<?php echo imgPATH; ?>03/Most-Honey.png" alt="">
                                                        <span class="total_honey_percentage">52225</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">1%</div>
                                                            <input type="hidden" value="1" name="one_value">
                                                        </div>
                                                        <span class="one_percentage"> 522</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">10%</div>
                                                            <input type="hidden" value="10" name="ten_value">
                                                        </div>
                                                        <span class="tenth_percentage"> 5222</span>
                                                    </li>
                                                    <li class="honey_input select_item_background">
                                                        <input type="number" data-id="6907" class="form-control percentage_coins" id="" onkeypress="if(this.value.length==2) return false;">
                                                        <p class="inputlabel">%</p>
                                                        <input type="hidden" class="exact_honey_amount" value="52225">
                                                        <span id="postt_6907">0</span>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="honey_check verify_percentage" data-post="6907">
                                                            <img src="<?php echo imgPATH ?>Check1.png" alt="check">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="time-block">
                                            <span class="red-time">
                                                <div id="timer_6907" class="timer_block">
                                                    <span id="days_6907">26<span>d:</span></span>
                                                </div>
                                                <span>
                                                </span>
                                                <div id="timer">
                                                    <span id="days">26</span>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="bees-block">
                                            113K <img src="<?php echo imgPATH; ?>Most-Views.png" alt="comments">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li><!-- #post -->
                    <li class="single-post gmw-single-item gmw-single-post gmw-object-5599 gmw-location-221 first-location">
                        <div class="wrapper-inner">
                            <div class="post-content">
                                <div class="author-wrapper">
                                    <div class="addHive-block">
                                        <button>
                                            <img src="<?php echo imgPATH ?>Add-to-hive.png">
                                        </button>
                                    </div>
                                    <div class="author-block">
                                        <div class="author-img">
                                            <img class="author-avatar" src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg">
                                        </div>
                                        <div class="author_block_cnt mb-2">
                                            <h3 class="author-name mb-0"></h3>






                                        </div>
                                    </div>
                                    <div class="type-of-post">
                                        <img src="<?php echo site_url(); ?>/wp-content/uploads/2021/11/Career.svg">
                                    </div>

                                </div>


                                <div class="loading"></div>
                                <div class="container-resposne_main">
                                    <div class="container-resposne"><img style="max-height:250px; max-width:100%;" src="https://preview.redd.it/6ssoivp0yq191.gif?format=png8&amp;s=a8ebaf948687b1b94ca9aaa0fb18754f1a5a86a2">
                                        <h2 class="title">such quality : memes</h2>
                                    </div>
                                </div>
                                <input type="text" class="meta-preview" value="https://www.reddit.com/r/memes/comments/uxzc6y/such_quality/">

                                <div class="top-wrapper">
                                    <div class="title-wrapper">
                                        <h2 class="post-title">
                                            <a href="https://test2.local/beeart/safsagasg/">
                                                safsagasg
                                            </a>
                                        </h2>
                                    </div>

                                    <div class="card-wrapper">
                                        <div class="honey-block">
                                            <div class="love"><input id="post_6906" type="checkbox" class="LoveCheck">
                                                <label for="post_6906" class="dashicons dashicons-heart LoveLabel" aria-label="like this"></label><span class="LoveCount">0</span>
                                            </div>
                                            <!--/love-->
                                        </div>
                                        <div class="honey_pot">
                                            <img src="<?php echo imgPATH; ?>Most-Honey.png" alt="">

                                            <div class="honey_pot_detail animate__animated animate__zoomInLeft">
                                                <ul>
                                                    <li>
                                                        <img src="<?php echo imgPATH; ?>Most-Honey.png" alt="">
                                                        <span class="total_honey_percentage">52225</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">1%</div>
                                                            <input type="hidden" value="1" name="one_value">
                                                        </div>
                                                        <span class="one_percentage"> 522</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">10%</div>
                                                            <input type="hidden" value="10" name="ten_value">
                                                        </div>
                                                        <span class="tenth_percentage"> 5222</span>
                                                    </li>
                                                    <li class="honey_input select_item_background">
                                                        <input type="number" data-id="6906" class="form-control percentage_coins" id="" onkeypress="if(this.value.length==2) return false;">
                                                        <p class="inputlabel">%</p>
                                                        <input type="hidden" class="exact_honey_amount" value="52225">
                                                        <span id="postt_6906">0</span>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="honey_check verify_percentage" data-post="6906">
                                                        <img src="<?php echo imgPATH; ?>Check1.png" alt="check">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="time-block">
                                            <span class="red-time">
                                                <div id="timer_6906" class="timer_block">
                                                    <span id="days_6906">25<span>d:</span></span>
                                                    <span id="hours_6906">23<span>h:</span></span>
                                                    <span id="minutes_6906">34<span>m</span></span>
                                                </div>
                                                <span>
                                                </span>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
                                                <script type="text/javascript">
                                                    $(document).ready(function() {

                                                        function makeTimer() {

                                                            var endTime = new Date("May 30, 2022 19:11:51");
                                                            endTime.setDate(endTime.getDate() + 28);
                                                            var endTime = (Date.parse(endTime)) / 1000;
                                                            // console.log(endTime);
                                                            var now = new Date();
                                                            var now = (Date.parse(now) / 1000);

                                                            var timeLeft = endTime - now;

                                                            var days = Math.floor(timeLeft / 86400);
                                                            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                                                            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                                                            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                                                            if (hours < "10") {
                                                                hours = "0" + hours;
                                                            }
                                                            if (minutes < "10") {
                                                                minutes = "0" + minutes;
                                                            }
                                                            if (seconds < "10") {
                                                                seconds = "0" + seconds;
                                                            }

                                                            $("#days_6906").html(days + "<span>d:</span>");
                                                            $("#hours_6906").html(hours + "<span>h:</span>");
                                                            $("#minutes_6906").html(minutes + "<span>m</span>");

                                                        }

                                                        setInterval(function() {
                                                            makeTimer();
                                                        }, 1000);

                                                    });
                                                </script>
                                                <div id="timer">
                                                    <span id="days"></span>
                                                    <span id="hours"></span>
                                                    <span id="minutes"></span>
                                                </div> <!-- in:  -->
                                            </span>
                                        </div>

                                        <div class="bees-block">
                                            25K<img src="<?php echo imgPATH; ?>Most-Views.png" alt="comments">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="single-post gmw-single-item gmw-single-post gmw-object-5599 gmw-location-221 first-location">
                        <div class="wrapper-inner">
                            <div class="post-content">
                                <div class="author-wrapper">
                                    <div class="addHive-block">
                                        <button>
                                            <img src="<?php echo imgPATH ?>Add-to-hive.png">
                                        </button>
                                    </div>
                                    <div class="author-block">
                                        <div class="author-img">
                                            <img class="author-avatar" src="https://icon-library.com/images/avatar-icon-images/avatar-icon-images-4.jpg">
                                        </div>
                                        <div class="author_block_cnt mb-2">
                                            <h3 class="author-name mb-0"></h3>






                                            <!--<a href="#">https://beesmartdev.wpengine.com</a>-->
                                        </div>
                                    </div>
                                    <div class="type-of-post">
                                        <img src="<?php echo imgPATH; ?>Type-Professional.png">
                                    </div>

                                </div>


                                <div class="loading"></div>
                                <div class="container-resposne_main">
                                    <div class="container-resposne"><img style="max-height:250px; max-width:100%;" src="https://preview.redd.it/6ssoivp0yq191.gif?format=png8&amp;s=a8ebaf948687b1b94ca9aaa0fb18754f1a5a86a2">
                                        <h2 class="title">such quality : memes</h2>
                                    </div>
                                </div>
                                <input type="text" class="meta-preview" value="https://www.reddit.com/r/memes/comments/uxzc6y/such_quality/">

                                <div class="top-wrapper">
                                    <div class="title-wrapper">
                                        <h2 class="post-title">
                                            <a href="https://test2.local/beeart/safsagasg/">
                                                safsagasg
                                            </a>
                                        </h2>
                                    </div>

                                    <div class="card-wrapper">
                                        <div class="honey-block">
                                            <div class="love"><input id="post_6906" type="checkbox" class="LoveCheck">
                                                <label for="post_6906" class="dashicons dashicons-heart LoveLabel" aria-label="like this"></label><span class="LoveCount">0</span>
                                            </div>
                                            <!--/love-->
                                        </div>
                                        <div class="honey_pot">
                                            <img src="<?php echo imgPATH; ?>03/Most-Honey.png" alt="">

                                            <div class="honey_pot_detail animate__animated animate__zoomInLeft">
                                                <ul>
                                                    <li>
                                                        <img src="<?php echo imgPATH; ?>03/Most-Honey.png" alt="">
                                                        <span class="total_honey_percentage">52225</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">1%</div>
                                                            <input type="hidden" value="1" name="one_value">
                                                        </div>
                                                        <span class="one_percentage"> 522</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">10%</div>
                                                            <input type="hidden" value="10" name="ten_value">
                                                        </div>
                                                        <span class="tenth_percentage"> 5222</span>
                                                    </li>
                                                    <li class="honey_input select_item_background">
                                                        <input type="number" data-id="6906" class="form-control percentage_coins" id="" onkeypress="if(this.value.length==2) return false;">
                                                        <p class="inputlabel">%</p>
                                                        <input type="hidden" class="exact_honey_amount" value="52225">
                                                        <span id="postt_6906">0</span>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="honey_check verify_percentage" data-post="6906">
                                                            <img src="<?php echo imgPATH; ?>Check1.png" alt="check">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="time-block">
                                            <span class="red-time">
                                                <div id="timer_6906" class="timer_block">
                                                    <span id="days_6906">25<span>d:</span></span>
                                                    <span id="hours_6906">23<span>h:</span></span>
                                                    <span id="minutes_6906">34<span>m</span></span>
                                                </div>
                                                <span>
                                                </span>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
                                                <script type="text/javascript">
                                                    $(document).ready(function() {

                                                        function makeTimer() {

                                                            var endTime = new Date("May 30, 2022 19:11:51");
                                                            endTime.setDate(endTime.getDate() + 28);
                                                            var endTime = (Date.parse(endTime)) / 1000;
                                                            // console.log(endTime);
                                                            var now = new Date();
                                                            var now = (Date.parse(now) / 1000);

                                                            var timeLeft = endTime - now;

                                                            var days = Math.floor(timeLeft / 86400);
                                                            var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                                                            var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                                                            var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                                                            if (hours < "10") {
                                                                hours = "0" + hours;
                                                            }
                                                            if (minutes < "10") {
                                                                minutes = "0" + minutes;
                                                            }
                                                            if (seconds < "10") {
                                                                seconds = "0" + seconds;
                                                            }

                                                            $("#days_6906").html(days + "<span>d:</span>");
                                                            $("#hours_6906").html(hours + "<span>h:</span>");
                                                            $("#minutes_6906").html(minutes + "<span>m</span>");

                                                        }

                                                        setInterval(function() {
                                                            makeTimer();
                                                        }, 1000);

                                                    });
                                                </script>
                                                <div id="timer">
                                                    <span id="days"></span>
                                                    <span id="hours"></span>
                                                    <span id="minutes"></span>
                                                </div> <!-- in:  -->
                                            </span>
                                        </div>

                                        <div class="bees-block">
                                            42K <img src="<?php echo imgPATH; ?>Most-Views.png" alt="comments">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</div>


<div style="display:none" class="mt-5 gmw-results-wrapper grid-gray gmw-pt-grid-gray-results-wrapper pt sample-postSpunchBob" data-id="7" data-prefix="pt">
    <div class="gmw-results">
        <div class="ajax-load-more-wrap sample default alm-0" data-alm-id="0" data-canonical-url="" data-slug="home" data-post-id="0" data-localized="ajax_load_more_vars" data-total-posts="73">
            <ul aria-live="polite" aria-atomic="true" class="alm-listing alm-ajax posts-list-wrapper" data-container-type="ul" data-loading-style="default" data-repeater="default" data-post-type="beeart" data-order="DESC" data-orderby="date" data-offset="0" data-posts-per-page="12" data-scroll="false" data-pause="false" data-button-label="Find More">
                <div class="alm-reveal" style="opacity: 1; height: auto; outline: none;">
                    <li class="single-post gmw-single-item gmw-single-post gmw-object-5599 gmw-location-221 first-location">
                        <div class="wrapper-inner">
                            <div class="post-content">
                                <div class="author-wrapper">
                                    <div class="addHive-block">
                                        <div class="dropdown dropdown-forFeed">
                                            <button class="btn btn-secondary dropdown-toggle add-hiveFromPost" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img src="<?php echo imgPATH ?>Add-to-hive.png">
                                                <span>...</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <img src="<?php echo imgPATH; ?>001-pizza.png" alt="flower">
                                                    <span>Food hive</span>
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <img src="<?php echo imgPATH; ?>002-graduation cap.png" alt="Fantastic">
                                                    <span>Graduation hive</span>
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <img src="<?php echo imgPATH; ?>005-DJ.png" alt="Fantastic">
                                                    <span>Music hive</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="author-block">
                                        <div class="author-img">
                                            <img class="author-avatar" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/spongebob-1592135040.jpeg?crop=0.839xw:1.00xh;0.0984xw,0&resize=640:*">
                                            <img class="is-verified" src="<?php echo imgPATH; ?>Verified.png">
                                        </div>
                                        <div class="author_block_cnt mb-2">
                                            <h3 class="author-name mb-0"></h3>
                                        </div>
                                    </div>
                                    <div class="type-of-post">
                                        <img src="<?php echo imgPATH; ?>Type-Professional.png">
                                    </div>
                                </div>
                                <div class="loading"></div>
                                <div class="container-resposne_main">
                                    <div class="container-resposne">
                                        <img style="max-width: 100%;width: 100%;object-fit: contain; max-height:250px;" src="<?php echo imgPATH; ?>spunch-bob.png">
                                        <h2 class="title">such quality : memes</h2>
                                    </div>
                                </div>
                                <input type="text" class="meta-preview" value="">
                                <div class="top-wrapper">
                                    <div class="title-wrapper">
                                        <h2 class="post-title">
                                            <a href="javascript:void(0)">
                                                School computers be like
                                            </a>
                                        </h2>
                                    </div>
                                    <div class="card-wrapper">
                                        <div class="honey-block">
                                            <div class="love"><input id="post_6907" type="checkbox" class="LoveCheck">
                                                <label for="post_6907" class="dashicons dashicons-heart LoveLabel" aria-label="like this"></label><span class="LoveCount">27.1K</span>
                                            </div>
                                            <!--/love-->
                                        </div>
                                        <div class="honey_pot">
                                            <img src="<?php echo imgPATH; ?>Most-Honey.png" alt="">

                                            <div class="honey_pot_detail animate__animated animate__zoomInLeft">
                                                <ul>
                                                    <li>
                                                        <img src="<?php echo imgPATH; ?>Most-Honey.png" alt="">
                                                        <span class="total_honey_percentage">52225</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">1%</div>
                                                            <input type="hidden" value="1" name="one_value">
                                                        </div>
                                                        <span class="one_percentage"> 522</span>
                                                    </li>
                                                    <li class="select_item_background select_item">
                                                        <div class="select_group">
                                                            <div class="select">10%</div>
                                                            <input type="hidden" value="10" name="ten_value">
                                                        </div>
                                                        <span class="tenth_percentage"> 5222</span>
                                                    </li>
                                                    <li class="honey_input select_item_background">
                                                        <input type="number" data-id="6907" class="form-control percentage_coins" id="" onkeypress="if(this.value.length==2) return false;">
                                                        <p class="inputlabel">%</p>
                                                        <input type="hidden" class="exact_honey_amount" value="52225">
                                                        <span id="postt_6907">0</span>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="honey_check verify_percentage" data-post="6907">
                                                            <img src="<?php echo imgPATH; ?>Check1.png" alt="check">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="time-block">
                                            <span class="red-time">
                                                <div id="timer_6907" class="timer_block">
                                                    <span id="days_6907">26<span>d:</span></span>
                                                </div>
                                                <span>
                                                </span>
                                                <div id="timer">
                                                    <span id="days">26</span>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="bees-block">
                                            113K <img src="<?php echo imgPATH; ?>Most-Views.png" alt="comments">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>


                </div>
            </ul>
        </div>
    </div>
</div>