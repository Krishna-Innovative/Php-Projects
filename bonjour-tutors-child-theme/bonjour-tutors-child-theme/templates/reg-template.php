<?php
/* Template Name: signup */
get_header();
?>

<div class="fontWrp">

<section class="createFrmTmpWrp">
	<div id="loginFrom" class="loginFromWrp createFrm createFrmTmp">
	    <h2>Create Account</h2>
	    <div class="logInBtm">
	       <?php echo do_shortcode('[ultimatemember form_id="4615"]');?> 
			<div class="um-col-alt">
				<div class="um-center">
					<a href="/user-account/"  class="um-button">Join Bonjourtutors as a Tutor</a>
				</div>
				<div class="um-clear"></div>
			</div>
	    </div>
	</div>
</section>


 <div class="footerTp">
    <div class="container">
      <div class="InrWrp">
        <div class="fLgo">
          <a href="/"><img src="/wp-content/uploads/2023/01/logo_small.png" alt=""></a>
        </div>
        <div class="cstmFmenu">
          <ul class="dFlx">
            <li><a href="/">Home</a></li>
            <li><a href="">About Us </a></li>
            <li><a href="">Programs </a></li>
            <li><a href="">Why Choose us </a></li>
            <li><a href="">FAQ </a></li>
            <li><a href="">Contact Us</a></li>
          </ul>
        </div>
        <h3 class="text-center">Have questions? Call us now: +1 (647) 956-1104 </h3>
        <div class="socialWrp">
          <ul class="dFlx">
            <li><a href=""><i class="fab fa-facebook"></i> </a></li>
          </ul>
        </div>
      </div>
    </div>
 </div> 

</div>


<?php
get_footer();
?>