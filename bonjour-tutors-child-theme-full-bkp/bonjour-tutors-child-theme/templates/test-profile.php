<?php
/*Template Name:Test profile*/
get_header();
?>
<!-- TODO 
-- form validation
-- behavior on buttons
-- progress bar optimization
-->


<!--
<div class="container">
    <h2>Sign up</h2>

   

    <form id="signUpForm" action="#">
        <label for="first-name">First Name</label>
        <input required type="text" id="first-name" name="first-name"/>

        <label for="last-name">Last Name</label>
        <input required type="text" id="last-name" name="last-name"/>

        <label for="email">Email</label>
        <input required type="email" id="email" name="email"/>

        <label for="confirm-email">Confirm Email</label>
        <input required type="email" id="confirm-email" name="confirm-email"/>
    </form>
    
    <div class="buttons">
        <button id="reset" type="reset">Clear</button>
        <button id="submit" type="submit" disabled>Submit</button>
    </div>
</div>
-->

    <div class="container">
            
            
            <div class="fontWrp">
	
 
	<div class="parentWrp">

		<div class="container">
             <div class="progressbar">
        <progress max="100" value="60" id="progress"></progress>
        <span class="prog-value">60%</span>
    </div>

			<?php //echo do_shortcode('[ultimatemember form_id="4617"]');?>

			<form action="" method="" id="profile_form_data">
			<div class="prfileEdit">

				<div class="WhiteRw">

					<h3>Edit Profile</h3>
					
 
					<div class="rw dFlx">
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>First name of parent</h5>
							</div>
							<div class="lblInpt">
								<input required type="text" name="firstname" id= "firstname" value="<?php echo esc_html( $current_user->user_firstname );?>">
							</div>	
						</div>
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>Last name of parent</h5>
							</div>
							<div class="lblInpt">
								<input required type="text" name="lastname" id= "lastname" value="<?php echo esc_html( $current_user->user_lastname );?>">
							</div>	
						</div>	
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>Email address of parent (Not Changeable)</h5>
							</div>
							<div class="lblInpt">
								<input required type="email" name="email" value="<?php echo esc_html( $current_user->user_email );?>" readonly>
							</div>	
						</div>
 
						<div class="clwHalf">
							<div class="lblTxt"> 
								<h5>Visibility</h5>				
							</div>
							<div class="lblInpt">
								<div class="form-group">
							      <input type="checkbox" id="parentsee">
							      <label for="parentsee">Classmates and their parents can see my name as "An parent"</label>
							    </div> 
							</div>	
						</div>

						<div class="clwFull">							
							<div class="lblTxt"> 
								<h5>About Me</h5>	
								<p>Introduce yourself to other parents and teachers. What is your family’s approach to learning? </p>			
							</div>
							<div class="lblInpt">
								<textarea required name="bio" id="author_bio">
									
								</textarea> 
							</div>
						</div>

					</div>
				</div>


				<!--<div class="WhiteRw">

					<h3>Learner Preferences</h3>
					<p>Please fill these out, to help us emphasize the best classes for you.</p>

					<div class="rw dFlx">
						<div class="clwFull"> 
							<h5>My Learners</h5>	
							<p>We'll show you classes that match your learner ages. Learner names are only shared with teachers and classmates after you enroll in a class.</p>						
						</div>

						<div class="clwFull">
						   
							<div class="myLearner dFlx">
								<div class="myLearnerInfo">
									<div class="RwLearn dFlx">
										<div class="ChldPic"><img src="/wp-content/uploads/2023/01/childpic-1.png" alt=""></div>
										<div class="ChldNme"><?php //the_title();?></div>
										<div class="ChldAge">Age <?php //echo get_field('age_learner');?> </div>
									</div>
									
								</div>
								
							</div>
							<div class="btnWrp">
								<a href="/learner/" class="newBtn01">+ Add learner...</a>
							</div>
						</div>	

					</div>
				</div>-->

		
				<div class="WhiteRw ">

					<h3>Private Settings</h3>

					<div class="rw dFlx">
						<div class="clw-30"> 
							<h5>How did you hear about us?</h5>					
						</div>
						<div class="clw-70">
							<div class="selectCstm">
							  <select required>
							    <option value="1">Online</option>
							    <option value="2">From a friend</option>
							    <option value="3">Others</option>
							  </select>
							</div>
						</div>	
					</div>

					<div class="rw dFlx">
						<div class="clw-30"> 
							<h5>Education Approach</h5>					
						</div>
						<div class="clw-70">
							<div class="selectCstm">
							  <select required>
							    <option value="1">Local public/charter school</option>
							    <option value="2">Local private/parochial school</option>
							    <option value="3">Others</option>
							  </select>
							</div>
						</div>	
					</div>

					<div class="rw dFlx">
						<div class="clw-30"> 
							<h5>Phone</h5>				
							<p>For customer support. We won't share it with anyone else.</p>	
						</div>
						<div class="clw-70">
							<input type="text" name="" required>
						</div>	
					</div>				

					<div class="rw dFlx">
						<div class="clw-30"> 
							<h5>Primary Email</h5>				
							<p>You will receive all email notifications here.</p>	
						</div>
						<div class="clw-70">
							<input type="email" name="" required>
						</div>	
					</div>
					

				</div>
                <div class="edit-form-btn-groups">
                <div class="logoutRw">
					<a href="#" class="newBtn01" id="update_user_profile">Update Profile </a>
				</div>

				<div class="logoutRw">
					<a href="<?php echo wp_logout_url( home_url() ); ?>" class="newBtn01">Log out </a>
				</div>
                    </div>
				
			</div>
			</form>
			
		</div>

	</div>














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
            
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"> </script>

<script>
var progress = $("#progress");
var resetButton = $(".newBtn01");
var submitButton = $("#update_user_profile");
var form = $("#profile_form_data");

$("#profile_form_data input").keyup(function() {
    
    var value = parseInt(progress.attr("value"));
    var numValid = 0;
    
    $("#profile_form_data input[required],#profile_form_data select[required],#profile_form_data textarea[required]").each(function() {
        if (this.validity.valid) {
            numValid++;
        }
    });
    
    if (numValid === 0) {
        progress.attr("value", 0);
    } else if (numValid === 1) {
        progress.attr("value", 10);
    } else if (numValid === 2) {
        progress.attr("value", 20);
    } else if (numValid === 3) {
        progress.attr("value", 30);
    } else if (numValid === 4) {
		progress.attr("value", 40);
	} else if (numValid === 5) {
		progress.attr("value", 50);
	} else if (numValid === 6) {
		progress.attr("value", 60);
	} else if (numValid === 7) {
		progress.attr("value", 70);
	} else if (numValid === 8) {
		progress.attr("value", 80);
	} else if (numValid === 9) {
		progress.attr("value", 90);
		submitButton.removeAttr("disabled");
	}
    
    $(".prog-value").html(value + '%');
    
});



</script>
<?php
get_footer();
?>