<?php
/* Template Name: user profile */
get_header();
$current_user = wp_get_current_user();
//print_r($current_user);
$user_id = get_current_user_id();
?>

<div class="fontWrp">
	
	<div class="parentWrp">

		<div class="container">

			<div class="prfileEdit">

				<div class="WhiteRw">

					<h3>Profile</h3>
					
						


	<?php 
	global $current_user, $wpdb;
    $user_id = get_current_user_id();
    $cur_name = $current_user->display_name;
    ?>

    <div class="rw dFlx">		
        <div class="clwHalf">
			<div class="lblTxt"> 
				<h5>Parent name</h5>
			</div>
			<div class="lblInpt">
				<input type="text" name="cur_name" value="<?php echo $cur_name; ?>">
			</div>	
		</div>
	</div>

    <?php
    $kid_id = $_GET["kid_id"];
	$resultts = $wpdb->get_results( "SELECT * FROM uDO_usermeta WHERE meta_key = 'is_child_id' and meta_value = '".$kid_id."' and user_id = ".$user_id, OBJECT );
	if(isset($resultts["0"])) { 
   
        $results = $wpdb->get_results( "SELECT * FROM uDO_usermeta WHERE user_id = ".$kid_id, OBJECT );
        foreach ($results as $key => $result) 
        {
            if($result->meta_key == "first_name")
            {
                $first_name = $result->meta_value;
            }   
            if($result->meta_key == "kid_img")
            {
                $kid_img = $result->meta_value;
            }
            if($result->meta_key == "grade")
            {
                $grade = $result->meta_value;
            }
            if($result->meta_key == "age")
            {
                $age = $result->meta_value;
            }
            if($key == "3")
            {
            ?>
            <div class="rw dFlx">
						
				<div class="clwHalf">
					<div class="lblTxt"> 
						<h5>Photo</h5>
					</div>
					<div class="lblInpt">
						<div class="mainImg ">

							<?php if(empty($kid_img))
                { ?>
                  <img style='max-width: 100px;' src='/wp-content/uploads/2023/01/pic01.png' alt=''>
                  
                <?php } else { ?>
               <img src="<?php echo $kid_img; ?>" alt="">
              <?php } ?>
              
							
							 
						</div> 
					</div>	
				</div>
			</div>

			<div class="rw dFlx">		
	            <div class="clwHalf">
					<div class="lblTxt"> 
						<h5>First name</h5>
					</div>
					<div class="lblInpt">
						<input type="text" name="firstname" value="<?php echo $first_name; ?>">
					</div>	
				</div>
				<div class="clwHalf">
					<div class="lblTxt"> 
						<h5>Age</h5>
					</div>
					<div class="lblInpt">
						<input type="text" name="firstname" value="<?php echo $age; ?>">
					</div>	
				</div>
				<div class="clwHalf">
					<div class="lblTxt"> 
						<h5>Grade</h5>
					</div>
					<div class="lblInpt">
						<input type="text" name="firstname" value="<?php echo $grade; ?>">
					</div>	
				</div>
			</div>

			<?php
			}
        }
    }


    ?>        
    </div>
    </div>
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


<?php
get_footer();
?>