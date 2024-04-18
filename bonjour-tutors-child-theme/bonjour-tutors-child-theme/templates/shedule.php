<?php
/* Template Name: shedule-temp */
get_header();
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <style>
    .fa, .far, .fas {
        /*font-family: "FontAwesome" ! important;*/
    }
    </style>
<?php

 $current_user_id=get_current_user_id();
 $firstname=get_user_meta($current_user_id,'first_name',true);
 $user = get_user_by( 'id', $current_user_id ); 
 $user_name=$user->data->user_login;
 if($firstname==""){
	 $firstname=$user_name;
 }else{
	 $firstname=$firstname;
 }

?>
<div class="container">
	<div class="row">
	<h4><b>Shared meeting schedule by Admin to <?php echo $firstname;?></b></h4>
	<table class="table">
	  <thead>
	    <tr>
		  <th scope="col">#</th>
		  <th scope="col" width="40%">Meeting course name</th>
		  <th scope="col" width="10%">Meeting Date</th>
		  <th scope="col" width="10%">Meeting Links</th>
		  <th scope="col" width="40%">Meeting Registered Users</th>
		</tr>
	  </thead>
	  <tbody>
		<?php
		$args = array(
			 'post_type' => 'product',
		);
		$result = new WP_Query( $args );
		$countedloop=1;
		
		if ($result-> have_posts()) {
			$meeting=0;
			while ($result->have_posts()){
				$result->the_post();
					if( have_rows('assign_tutor',get_the_ID()) ){
						while( have_rows('assign_tutor',get_the_ID()) ) { the_row();
							$tutor_id=get_sub_field('tutor_name',get_the_ID());
							if($tutor_id==$current_user_id){
								$meeting=1;
								$products = wc_get_product(get_the_ID());
								$variations = $products->get_available_variations();
								$variations_id = wp_list_pluck( $variations, 'variation_id' );
							
							?>
							 <tr>
								  <td scope="row"><?php echo $countedloop;?></td>
								  <td scope="row">
								      <a href="<?php the_permalink();?>"><?php echo the_title();?></a>
								       <div class="user_time_slot">
								           	<?php foreach($variations as $variant){
                                                //echo '<pre>';print_r($variant);echo '</pre>';
								           	    ?>
								           	   <div class="user_data">
								           	       <?php
								    	    echo 'Courses Availability :- '.$variant['attributes']['attribute_time-availabilty'].'-'.$variant['attributes']['attribute_time-slot'].' '.$variant['attributes']['attribute_timing'];?>
								    	    </div>
								       <?php }?>
								       </div>
								        
								      
								  </td>
								  <td scope="row"><?php echo get_sub_field('tutor_time_availability',get_the_ID());?></td>
								  <td scope="row"><b>Shared Link</b>
								   <div class="user_time_slot">
								           	<?php foreach($variations as $variant){
								           	    $varaiant_id=$variant['variation_id'];
								           	    $downloaded_files=get_post_meta($varaiant_id,'_downloadable_files',true);
								           	    ?>
								           	   <div class="user_data">
								           	       <?php
								           	       
								           	       
								           	       foreach($downloaded_files as $view_class){
                    									$zoom_meeting=$view_class['file'];
                    								} 
                    								?>
                    							<a href="<?php echo $zoom_meeting;?>">Meeting Link</a>
								    	    
								    	    
								    	    </div>
								       <?php }?>
								       </div>
								    </td>
								    <td> <b>Enrolled Students</b>
								     <div class="user_time_slot"> <?php
								    foreach($variations as $variant){
								           	    $product_id=$variant['variation_id'];
                                            global $wpdb;
                                            $statuses = array_map( 'esc_sql', wc_get_is_paid_statuses() );
                                            $customer_details =  $wpdb->get_results("
                                               SELECT DISTINCT pm.meta_value, pm1.meta_value as meta_value_1, pm2.meta_value as meta_value_2, i.order_id FROM {$wpdb->posts} AS p
                                               INNER JOIN {$wpdb->postmeta} AS pm ON p.ID = pm.post_id
                                               INNER JOIN {$wpdb->postmeta} AS pm1 ON p.ID = pm1.post_id
                                               INNER JOIN {$wpdb->postmeta} AS pm2 ON p.ID = pm2.post_id
                                               INNER JOIN {$wpdb->prefix}woocommerce_order_items AS i ON p.ID = i.order_id
                                               INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS im ON i.order_item_id = im.order_item_id
                                               WHERE p.post_status IN ( 'wc-" . implode( "','wc-", $statuses ) . "' )
                                               AND pm1.meta_key IN ( '_billing_first_name' ) 
                                               AND pm2.meta_key IN ( '_billing_last_name' )
                                               AND pm.meta_key IN ( '_billing_email' )
                                               AND im.meta_key IN ( '_product_id', '_variation_id' )
                                               AND im.meta_value = $product_id
                                            ");
                                            
                                                 ?>
                                                  <div class="user_data">
                                                 <?php
                                            if(count($customer_details)==0){
                                                 echo '<span style="color:#ff0000">No student enrolled this course'.'<span>';
                                            }else{
                                                $customer_name = '';
                                                foreach($customer_details as $customer){
                                                  $customer_name.=$customer->meta_value_1.', ';
                                                  
                                                }
                                                $rage = rtrim($customer_name,', ');
                                                  echo $rage;
                                            }
                                            ?>
                                            </div>
                                            <?php
                                            
                                            
                                    }
                                            

?>
</div></td>
							</tr>
							<?php
								$countedloop++;
							}
						}
					}
			}
		}
		
		?>
		</tbody>
	</table>
</div>
</div>

  <!--<div class="parrent-content schedule-page-wapper">
    <div class="extra-text">
      <h4>For completed classes, see Your transcripts</h4>
      <h4>Nothing scheduled yet.<br>
        Enroll in classes to see them <a href="/search">here.</a></h4>
      </div>
    </div>-->
  <?php //} ?>
  <div class="fontWrp">
	  <div class="footerTp">
		<div class="container">
		  <div class="InrWrp">
			<div class="fLgo">
			  <a href="https://bonjourtutors.com"><img src="https://bonjourtutors.com/wp-content/uploads/2023/01/logo_small.png" alt=""></a>
			</div>
			<div class="cstmFmenu">
			  <ul class="dFlx">
				<li><a href="https://bonjourtutors.com/">Home</a></li>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>