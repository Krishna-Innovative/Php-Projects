<?php /* Template Name: Sample page */
get_header();
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/sample.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/scss/user.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/styles/feed-page.css">

<main id="sample-page">
    <div class="container">
        <section id="sample-coverPhoto">
            <div class="profile_page" id="preview-js">
                <?php
                get_template_part('template-parts/sample/header');
                ?>
                <div class="step-navigation">
                    <button disabled class="step-btn locked" data-step="sample-profileNavifation">
                        <img src="<?php echo imgPATH; ?>Check.png" alt="next step" />
                    </button>
                </div>
                <div class="tab_info_sec mb-5">
                    <a href="#" data-target="#cover_profile" data-toggle="modal">
                        <img src="<?php echo imgPATH; ?>Info.png" alt="img">
                    </a>
                </div>
        </section>
        <!-- step 2-4 -->
        <section id="sample-profileNavifation">
            <div class="profile_page">
                <?php get_template_part('template-parts/profile-page/profile_header', '', idCurrentUser);
					  get_template_part('template-parts/sample/navigation');
                ?>
            </div>
        </section>
        <!-- END step 2-4 -->

        <!-- step 5 -->
        <section id="sample-feedPage">
            <?php get_template_part('template-parts/sample/feed'); ?>
            <div class="step-navigation">
                <button class="step-btn " data-step="sample-feed">
                    <img src="<?php echo imgPATH; ?>Back-Button.png" alt="next step" />
                </button>
                <button disabled class="step-btn locked" data-step="sample-finish">
                    <img src="<?php echo imgPATH; ?>Check.png" alt="next step" />
                </button>
            </div>
        </section>
    </div>
</main>



<?php
get_template_part('template-parts/profile-page/upload-photo-popups');
get_template_part('template-parts/profile-page/info_popups');


get_footer();
?>

<style>
    /* div#cutom_frontend_sidebar {
  display: none;
} */
    .header-footer-custom {
        background: #F8F8F8;
    }
</style>

<style>
    .um-72.um {
        max-width: 70% !important;
    }

    .signup_navigation {
        display: none;
    }

    /**
 * Posts Locator search results stylesheet "grid-gray"
 */
    .sr-item-description>p,
    .cont-flg,
    a,
    span,
    div,
    input#gmw-keywords-4 {
        font-family: 'Nunito';
    }

    div.gmw-results-wrapper.grid-gray select {
        border: 1px solid #ccc;
        height: 25px;
        color: #555;
        max-width: 150px;
    }

    div.gmw-results-wrapper.grid-gray .pagination-per-page-wrapper {}

    div.gmw-results-wrapper.grid-gray .pagination-per-page-wrapper.bottom {}

    /* pagination */

    div.gmw-results-wrapper.grid-gray ul.gmw-pagination {
        float: right;
        text-align: center;
        margin: 0px;
        list-style: none;
        padding: 0px;
    }

    div.gmw-results-wrapper.grid-gray select.gmw-orderby-dropdown {
        float: right;
    }

    /* list of results */

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper {
        list-style: none;
        margin-bottom: 1px;
        padding: 0px;
        /* border-top: 10px solid #e1e1e1;
	border-bottom: 10px solid #e1e1e1; */
        margin: 1px 0 10px 0;
        padding-bottom: 10px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post {
        margin: 0px;
        border-bottom: 10px solid #e1e1e1;
        width: 31.6%;
        display: inline-block;
        border: 1px solid #eee;
        background: #FFFFFF;
        -o-box-shadow: 0px 0px 3px #eee;
        -moz-box-shadow: 0px 0px 3px #e1e1e1;
        -webkit-box-shadow: 0px 0px 3px #e1e1e1;
        box-shadow: 0px 0px 3px #e1e1e1;
        border: 1px solid #e5e5e5;
        -webkit-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -ms-transition: all 0.2s linear;
        -kthtml-transition: all 0.2s linear;
        transition: all 0.2s linear;
        vertical-align: top;
        padding: 0px;
        margin: 15px 0.5% 5px;
        min-width: 190px;
        border-radius: 10px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:hover {
        -webkit-box-shadow: 0 0px 10px #ddd;
        -moz-box-shadow: 0 0px 10px #ddd;
        box-shadow: 0 0px 10px #ddd;
        -webkit-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -ms-transition: all 0.2s linear;
        -kthtml-transition: all 0.2s linear;
        transition: all 0.2s linear;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(3n+1) {
        margin: 15px 0;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(3n+2) {
        margin: 15px 0.5% 5px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(3n+3) {

        margin: 15px 0.5% 5px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .wrapper-inner {
        display: inline-block;
        width: 100%
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post:nth-child(even) {
        background: #fdfdfd;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper {
        color: #363636;
        font-size: 14px;
        display: inline-block;
        width: 100%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        background: white;
        padding: 1px 3px;
        position: relative;
        /* line-height: 10px; */
    }

    .top-wrapper>p {
        text-align: left;
        line-height: 18px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper span.distance {
        font-style: italic;
        font-size: 10px;
        color: #333;
        padding: 1px 4px;
        background: #f5f5f5;
        display: inline-block;
        box-sizing: border-box;
        vertical-align: top;
        border: 1px solid #f1f1f1;
        line-height: 16px;
        margin-left: 5px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper h2.post-title {
        margin: 0px;
        display: inline-block;
        font-size: 15px;
        text-decoration: none;
        margin-right: 10px;
        text-transform: capitalize;
        font-weight: 500;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper h2.post-title a {
        text-decoration: none;
        font-weight: 800;
        font-size: 18px;
        color: #141414;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .top-wrapper span.address {
        font-size: 9px;
        width: 100%;
        /* display: inline-block; */
        display: flex;
        justify-content: flex-end;
        text-align: center
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content {
        display: inline-block;
        width: 100%;
        /* padding:10px; */
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        font-size: 14px;
        line-height: 20px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .post-thumbnail,
    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
        width: 100%;
        height: 100%;
        overflow: hidden;
        /* background:#f7f7f7; */
        /* border:1px solid #ddd */
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
        text-align: center;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .post-thumbnail img {
        width: 100%;
        border-radius: 15px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
        color: rgb(179, 223, 193) !important;
        font-size: 40px !important;
        margin: 0;
        padding-top: 28px;
        box-sizing: border-box;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .right-col {
        width: 58%;
        float: right;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .right-col h4 {
        font-size: 14px;
        font-weight: bold;
        margin: 0px 0 5px 0px;
        color: #555;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .gmw-taxes {
        font-size: 12px;
        line-height: 17px;
        color: #777;
        margin-left: 12px;
    }

    div.gmw-results-wrapper.grid-gray ul.gmw-terms-wrapper {
        list-style: none;
        padding: 0px;
        margin: 0px;
        display: inline-block;
    }

    div.gmw-results-wrapper.grid-gray div.post-content h3 {
        font-size: 14px;
        font-weight: normal;
        padding: 0;
        font-weight: bold;
    }

    div.gmw-results-wrapper.grid-gray ul.opening-hours-wrapper {
        list-style: none;
        margin: 0;
        padding: 0;
        padding-bottom: 15px;
    }

    div.gmw-results-wrapper.grid-gray ul.opening-hours-wrapper li {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    div.gmw-results-wrapper.grid-gray .bottom-wrapper {
        background-color: #9BDFC3;
        color: white;
        min-height: 30px;
        position: relative;
        padding: 6px 10px;
        box-sizing: border-box;
        line-height: 18px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-icon {
        color: white;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-icon:before {
        padding: 0;
        margin: 0;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .get-directions-wrapper a {}

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .get-directions-wrapper {
        margin: 5px 0px 0px;
        font-size: 320;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper {
        display: inline-block;
        width: 100%;
        box-sizing: border-box;
        line-height: 18px;
        font-size: 12px;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:link,
    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:visited {
        color: white;
    }

    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:hover,
    div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper .address a:active {
        text-decoration: underline;
    }

    div.gmw-results-wrapper.grid-gray div.gmw-no-results-wrapper {
        max-width: 960px;
        margin: 15px auto;
        background: white;
    }

    div.gmw-results-wrapper.grid-gray div.gmw-no-results-wrapper p {
        background: white;
    }

    @media (max-width:800px) {

        div.gmw-results-wrapper.grid-gray select {
            width: 100%;
            max-width: 100%;
        }

        div.gmw-results-wrapper.grid-gray .pagination-per-page-wrapper,
        div.gmw-results-wrapper.grid-gray div.gmw-results-message {
            padding: 15px;
        }

        div.gmw-results-wrapper.grid-gray div.gmw-results-message span {
            text-align: center;
            display: block;
            margin-bottom: 5px;
        }

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper {
            display: inline-block;
        }

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li .top-wrapper {
            /* text-align:center; */
            padding: 10px;
        }

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post {
            width: 48%;
        }

        div.gmw-results-wrapper.grid-gray select,
        div.gmw-results-wrapper.grid-gray select.gmw-per-page {
            width: 100%;
            max-width: 100%;
        }

        div.gmw-results-wrapper.grid-gray ul.gmw-pagination {
            float: none;
            width: 100%;
            margin-top: 10px;
            display: inline-block;
        }

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .left-col,
        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper .post-content .right-col {
            width: 100%;
            float: none;
            padding-top: 10px
        }
    }

    @media (max-width:520px) {

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .get-directions,
        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .address-wrapper {
            max-width: 100%;
        }

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post {
            width: 100%;
            margin: 15px 0px;
        }

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .post-thumbnail,
        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
            height: 200px;
        }

        div.gmw-results-wrapper.grid-gray ul.posts-list-wrapper li.single-post .no-post-thumbnail {
            margin: 60px 0 0 -55px;
            font-size: 80px !important;
        }
    }

    /* custom */

    .author-wrapper {
        display: flex;
        justify-content: space-between;
        padding: 8px 10px 0px 5px;
        height: 45px;
    }

    .author-block {
        display: flex;
    }

    .author-name {
        line-height: 30px;
        margin-left: 5px;
        font-size: 15px;
        font-weight: 800;
    }


    .taxonomies-list-wrapper {
        text-align: left;
        border-bottom: 1px solid #E5E5E5;
        width: 107.7%;
        margin-left: -4%;
    }

    .title-wrapper {
        display: flex;
        position: absolute;
    }

    img {
        height: inherit;
    }

    .gmw-taxonomy-terms.gmw-taxes.tag {
        margin-bottom: 5px;
    }

    .card-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        border-top: 1px solid #E5E5E5;
        margin: 0 7px;
    }

    .author-img>img {
        border-radius: 50px;
    }

    .author-img {
        position: relative;
    }

    .post_type_icon {
        width: 35px;
        height: 95%;
    }
</style>