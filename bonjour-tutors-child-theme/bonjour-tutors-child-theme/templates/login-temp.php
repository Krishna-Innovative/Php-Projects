<?php
/* Template Name: Login */
get_header();
?>

<div class="fontWrp">

  <div class="LogInOuter">
      <div id="loginFrom" class="loginFromWrp cmnpd-60">  
        <h2>Log In</h2>
        <div class="logIntop">
            <div class="rw">
                <a href="" class="btnCstm"><span class="icnWrp"><img src="https://bonjourtutors.com/wp-content/uploads/2023/01/fbcon.png" alt="Apple icon"></span> <span>Continue with Facebook  </span></a>
            </div>
            <div class="rw">            
                  <a href="https://bonjourtutors.com/wp-login.php?loginSocial=google" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600" class="btnCstm"><span class="icnWrp"><img src="/wp-content/uploads/2023/01/gcon.png" alt="A Google logo representing search"> </span> <span>Continue with Google  </span></a>            
            </div>
            <!--<div class="rw">
                <a href="" class="btnCstm"><span class="icnWrp"><img src="https://bonjourtutors.com/wp-content/uploads/2023/01/aplcon-1.png" alt="A Facebook logo representing social media"> </span> <span>Continue with Apple </span></a>
            </div>-->
        </div>
        <div class="logInmiddle">
            <p class="text-center">or log in with email </p>
        </div>
        <div class="logInBtm">
            <?php echo do_shortcode('[ultimatemember form_id="4616"]');?>
			<p style="text-align:center"><a href="/my-account/lost-password/"> Forget password</a></p>
            <p style="text-align:center"><strong>Don't have an Bonjour Tutors account? <a href="/signup"> Sign up</a></strong></p>
        </div>
      </div> 
  </div>

  <div class="footerTp">
    <div class="container">
      <div class="InrWrp">
        <div class="fLgo">
          <a href="/"><img src="/wp-content/uploads/2023/01/logo_small.png" alt="The Bonjour Tutors logo"></a>
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