<?php /*Template Name: User Resume Download Template*/ ?>
<?php get_header();  ?>
<?php
$user = wp_get_current_user();
$um_profile = UM()->profile();
$um_user = UM()->user();
// 17.01.2022
$full_name = $um_user->id;
$user_email = $um_user->user_email;
global $wpdb;

// !17.01
//$post_id = get_the_ID();
	$post_id = get_current_user_id();

$all_meta_for_users = get_user_meta( $post_id );
$country = $all_meta_for_users['country'][0];
$meta = get_post_meta($post_id);
$UserPostMeta  = $wpdb->prefix . 'userpostdata';
$SelectPostMeta = $wpdb->get_row("SELECT * FROM $UserPostMeta WHERE post_id = '$post_id' ");

$PostUserID = $SelectPostMeta->userid;
$UserLanguage = $SelectPostMeta->language;

$the_user = get_user_by( 'id', $PostUserID );
$AuthorName =  $the_user->display_name;
$UserCurrentLocation = $SelectPostMeta->address;
$work_position = $all_meta_for_users['position'][0];
$work_company = $all_meta_for_users['work_company'][0];
$work_period = $all_meta_for_users['work_period'][0];
$work_periods = $all_meta_for_users['work_periods'][0];
$languages = $all_meta_for_users['languages'][0];
$wservices = $all_meta_for_users['services'][0];
$employments = $all_meta_for_users['employments'][0];
$University = $all_meta_for_users['institute'][0];
$GraduationDate = $all_meta_for_users['graduation_date'][0];
$qualification = $all_meta_for_users['qualification'][0];
$carrer_location = $all_meta_for_users['carrer_location'][0];
$month_salary = $all_meta_for_users['month_salary'][0];
$year = preg_split("#/#", $work_period);
		$seyear = preg_split("#/#", $work_periods);
		$years = $year[0];
		$setyears = $seyear[0];
        $yearcal = $years - $setyears;
		$seyears = preg_split("#-#", $yearcal);
		$calyears = $seyears[1];
		$decoded = unserialize($employments);  
		$parttime = $decoded['0']; 
		$parttimez = $decoded['1']; 
		$parttimes = $decoded['2']; 
		$parttimen = $decoded['3']; 


$country_new = $wpdb->get_results( "SELECT * FROM country WHERE countryname = '$country'");
/* echo "<pre>";
		print_r($employments);
		echo "</pre>";
		die('123'); */

 ?>
<!DOCTYPE html>
<html>
<head>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
	<script src="https://unpkg.com/html2canvas@1.4.0/dist/html2canvas.js"></script>
	<style>
        *{box-sizing:border-box}body{margin:0}.main{float:left;width:100%}.main_body{max-width:595px;margin:0 auto;display:table;padding:24px}.header{float:left;width:100%;border-bottom:1px solid #dcdcdc;margin:10px}.header .header_left_content{float:left;width:auto}.header .header_left_content img{float:left;margin:8px}.header .header_left_content h2{float:left;font-style:normal;font-weight:800;font-size:18px;line-height:24px;text-align:center;letter-spacing:.02em;color:#141414}.header .header_left_content span{color:#db9b36}.header .header_right{float:right;width:auto}.header .header_right h3{font-style:normal;font-weight:400;font-size:14px;line-height:20px;text-align:right;color:#363636}.header_profile_section{float:left;width:100%;margin:17px}.header_profile_section .header_account_section{float:left;width:auto}.header_profile_section .header_account_section img{float:left;margin:15px;max-width:40px;border-radius:50px}.header_profile_section .header_account_section2{float:left;width:auto}.header_profile_section .header_account_section2 h3{font-style:normal;font-weight:800;font-size:26px;line-height:10px;letter-spacing:.02em;color:#141414}.header_profile_section .header_account_section2 h4{font-style:normal;font-weight:800;font-size:20px;line-height:10px;letter-spacing:.06em;text-transform:uppercase;color:#db9b36}.header_profile_section .header_account_section2 h5{font-style:normal;font-weight:800;font-size:18px;line-height:0;letter-spacing:.02em;color:#363636}.header_scanner{float:right;width:auto;margin:15px}.contact_section{float:left;width:100%;border-top:1px solid #dcdcdc}.contact_section h3{font-style:normal;font-weight:800;font-size:26px;line-height:35px;letter-spacing:.02em;color:#141414}.mail_profile{float:left;width:auto}.contact_section .mail_icon{float:left;width:100%}.contact_section .mail_link_icon{float:left;width:100%;margin:12px 0}.contact_section .mail_link_icon img{float:left;width:auto;margin:2px 2px}.contact_section .mail_link_icon span{font-style:normal;font-weight:400;font-size:18px;line-height:24px;letter-spacing:.02em;color:#363636}.contact_language{float:right;width:auto}.contact_language .contact_country_logo{float:right;width:auto}.contact_language .contact_country_logo span{font-style:italic;font-weight:400;font-size:18px;line-height:24px;text-align:right;letter-spacing:.02em;color:#363636}.contact_language .contact_language_2{float:right;width:auto;padding:10px 0;margin:0;clear:both}.contact_language .contact_language_2 h2{font-style:normal;font-weight:800;font-size:18px;line-height:24px;text-align:right;letter-spacing:.02em;color:#363636;margin:0;width:100%;float:right}.Work.Experience{float:left;width:100%;border-top:1px solid #dcdcdc}.Work.Experience .experince_section{float:left;width:100%;margin-top:12px}.Work.Experience .experince_section .work_team_lead{float:left;width:auto}.Work.Experience .experince_section .work_team_lead img{float:left;width:auto}.Work.Experience .experince_section span{font-style:normal;font-weight:800;font-size:26px;line-height:35px;letter-spacing:.02em;color:#141414}.Work.Experience .experince_section .work_img_section{margin:0;padding:11px}.teamsection{display:flex;align-items:center;width:100%}.team_lead_section h3{font-style:normal;font-weight:800;font-size:14px;line-height:19px;letter-spacing:.02em;color:#363636}.skill_section{float:left;width:100%}.skill_section span{font-style:normal;font-weight:800;font-size:26px;line-height:35px;letter-spacing:.02em;color:#141414}li{font-style:normal;font-weight:400;font-size:23px;line-height:24px;letter-spacing:.02em;color:#363636} 
	.countryy i {background: url(https://dl.dropboxusercontent.com/s/izcyieh1iatr4n5/flags.png) no-repeat;display: inline-block;width: 16px;height: 11px;}
	</style>
	
</head>

<body>
<?php if ( is_user_logged_in() ) { ?>

	<?php if( current_user_can('career') || current_user_can('administrator') ) {  ?>
	<div id="html-content-holder" class="inner_main_page_section_cls" style="float:left;width: 100%;">
		<div class="main">
		<div class="main_body">
		<div class="header">
			<div class="header_left_content">
			 <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2021/11/Beesmart-menu.png">
			 <h2>BEE<span>SMART</span></h2>
			</div>
			<div class="header_right">
			  <h3>@2022.All rights Reserved</h3>
			</div>
		</div>
		<div class="header_profile_section">
            <div class="header_account_section">
			  <?php if ( ! $default_size || $default_size == 'original' ) {
										$profile_photo = UM()->uploader()->get_upload_base_url() . um_user( 'ID' ) . "/" . um_profile( 'profile_photo' );

										$data = um_get_user_avatar_data( um_user( 'ID' ) );
										echo $overlay . sprintf( '<img src="%s" class="%s" alt="%s" data-default="%s" onerror="%s" />',
											esc_url( $profile_photo ),
											esc_attr( $data['class'] ),
											esc_attr( $data['alt'] ),
											esc_attr( $data['default'] ),
											'if ( ! this.getAttribute(\'data-load-error\') ){ this.setAttribute(\'data-load-error\', \'1\');this.setAttribute(\'src\', this.getAttribute(\'data-default\'));}'
										);
									} else {
										echo $overlay . get_avatar( um_user( 'ID' ), $default_size );
									} ?>
              <div class="header_account_section2">
                <h3 style="text-transform: capitalize;"><?php $user = wp_get_current_user();
								if ($user): ?>
										<?php $loginuser = wp_get_current_user(); ?>
										<?php if($loginuser->user_login){ ?>
										 <?php echo $loginuser->user_login; ?>
										<?php } ?>
							<?php endif; ?></h3>
                <h4><?php echo $work_position; ?></h4>
                <h5>$<?php echo $month_salary; ?> | <?php if ( $parttime ) { print $parttime; ?>, &nbsp; <?php } ?> <?php if ( $parttimez ) { print $parttimez; ?> &nbsp; <?php } ?> <br> <?php if ( $parttimes ) { print $parttimes;?>, &nbsp; <?php } ?> <br> <?php if ( $parttimen ) { print $parttimen; ?>&nbsp; <?php } ?></h5>
             </div>
             </div>
             <div class="header_scanner">
			 <?php global $current_user; 
					  get_currentuserinfo();    ?>
			    <img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo "https://beesm.art/user/$current_user->display_name"; ?>&amp;size=50x50" alt="<?php echo $current_user->display_name; ?>" title="<?php echo $current_user->display_name; ?>" width="50" height="50" />
    
            </div>
	    </div>
		<div class="About_your_business">
		    <p><?php if($loginuser->About_your_business){ ?><?php echo $loginuser->About_your_business; ?><?php } ?></p>
		</div>
        <div class="contact_section">
            <h3>Contacts</h3>
            <div class="mail_profile">
				 <div class="mail_icon">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/mail-1.png">
					<span><?php if($loginuser->user_email){ ?><?php echo $loginuser->user_email; ?><?php } ?></span>
				 </div>
				 <div class="mail_link_icon">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2021/11/url-3-1.png">
					<span><?php if($loginuser->user_url){ ?><?php echo $loginuser->user_url; ?><?php } ?></span>
			   </div>
		    </div>
			<div class="contact_language">
			  <div class="contact_country_logo">
			    <input type='hidden' id='code_cn' value='<?php print_r($country_new[0]->code); ?>'>
				<div class='cont-flg um-field'><span class='countryy'><i style='background-position: 0px -300px;'></i></span></div>
				<span><?php if($loginuser->Currency_picker){ ?><?php echo $loginuser->Currency_picker; ?><?php } ?></span>
			  </div>
			  <div class="contact_language_2">
				<h2>Languages: <span class="languages"><?php if($loginuser->languages[0]){ ?><?php echo $loginuser->languages[0]; ?><?php } ?>&nbsp;<?php echo $loginuser->languages[1]; ?>&nbsp;<?php echo $loginuser->languages[2]; ?><?php echo $loginuser->languages[3]; ?></span></h2>
				
			  </div>
			</div>
	    </div>
    <div class="Work Experience">
        <div class="experince_section">
            <span>Work Experience</span>
              <div class="teamsection">
            <div class="work_img_section">
                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2021/12/Work_Experience.png">
            </div>
            <div class="team_lead_section">
                <h3><?php echo $work_position; ?><br><?php echo $work_company; ?><br><?php echo $years; ?>-<?php echo $setyears; ?> • <?php echo $calyears; ?>yrs</h3>
            </div>
        </div>
           <div class="teamsection">
            <div class="work_img_section">
                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2021/12/Work_Experience.png">
            </div>
            <div class="team_lead_section">
			    <h3><?php echo $work_position; ?><br><?php echo $work_company; ?><br><?php echo $years; ?>-<?php echo $setyears; ?> • <?php echo $calyears; ?>yrs</h3>
                
            </div>
        </div>
        </div>
    </div> 
    <div class="Work Experience">
        <div class="experince_section">
            <span>Eduction</span>
              <div class="teamsection">
            <div class="work_img_section">
                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2021/12/cil_education.png">
            </div>
            <div class="team_lead_section">
                <h3><?php echo $University; ?><br> <?php echo $GraduationDate; ?><br> <?php echo $qualification; ?><br> <?php echo $carrer_location; ?></h3>
            </div>
        </div>
    </div>	
    </div>
     <div class="skill_section">
        <span>Skills</span>
            <ul>
                <li><?php echo $wservices; ?></li>    
            </ul>
     </div>
     <div class="skill_section">
        <span>Employment</span>
            <ul>
				<?php if ( $parttime ) { ?>
				<li><?php print $parttime; ?></li>
				<?php } ?>
				<?php if ( $parttimez ) { ?>
				<li><?php print $parttimez; ?></li>
				<?php } ?>
                <?php if ( $parttimes ) { ?>				
				<li><?php print $parttimes; ?></li> 
				<?php } ?>
                <?php if ( $parttimen ) { ?>				
				<li><?php print $parttimen; ?></li>  
				<?php } ?>
            </ul>
     </div>
   </div>
   </div>
		
	</div>
	<div class="inner_main_page_section_cls">
        <input style="text-align:center;" id="btn-Preview-Image" type="button" value="Download" /> 

	</div>
	<div id="previewImage" style="display: none;"></div>	
	
	<script>
		$(document).ready(function() {
			// Global variable
			var element = $("#html-content-holder");
			// Global variable
			var getCanvas;

			$("#btn-Preview-Image").on('click', function() {

				html2canvas(document.getElementById("html-content-holder"),{
					allowTaint: true,
					useCORS: true
				}).then(function (canvas) {                   
                   var anchorTag = document.createElement("a");
                    document.body.appendChild(anchorTag);
                    document.getElementById("previewImage").appendChild(canvas);
                    anchorTag.download = "filename.jpg";
                    anchorTag.href = canvas.toDataURL();
                    anchorTag.target = '_blank';
                    anchorTag.click();
                });
			});
		});
	</script>
	<script>
/*(function ($) {
    // size = flag size + spacing
    var default_size = {
        w: 20,
        h: 15
    };

    function calcPos(letter, size) {
        return -(letter.toLowerCase().charCodeAt(0) - 97) * size;
    }

    $.fn.setFlagPosition = function (iso, size) {
        size || (size = default_size);
        
        var x = calcPos(iso[1], size.w),
            y = calcPos(iso[0], size.h);

        return $(this).css('background-position', [x, 'px ', y, 'px'].join(''));
    };
})(jQuery);

// USAGE:

(function ($) {
    $(function () {
        var $target = $('.countryy');
        
        // on load:
        //$target.find('i').setFlagPosition('es');

        var cn_code = $('input#code_cn').val();
        console.log(cn_code);
            $target.find('i').setFlagPosition(cn_code);    
    });
})(jQuery);*/

</script>
	
	<?php } ?>
	<?php } ?>
</body>

</html>					
<?php get_footer() ;?> 