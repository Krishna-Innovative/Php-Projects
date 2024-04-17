<?php
/*Template name:Peacekeeper */
get_header();
?>
	
<div class="inner_main_page_section_cls">
 <div class="container">
	 <div class="peacekeeper_detail_page"> 
		 
		  <div class="progress custom_progress details_progress">
			<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Create1.png" class="progress_icon"/>
			<div class="progress-bar active" role="progressbar" aria-valuemin="50" aria-valuemax="100"></div>
		  </div>
		 
		 <!-- First step -->
       <div class="step well first-step">
		 <div class="pec-head">
			 <div class="pec-head_img">
			    <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Peacekeeper.png" alt="img"/>
			 </div>
			 <div class="pec-head_cont">
				 <h4>Peacekeeper</h4>
				 <p>What are you sharing</p>
				 <small>(You can select multiple)</small>
			 </div>
		 </div>
		 
		  <div class="peacekeeper_items ctmm-prementer">

		 <form action="/bee/peacekeeper/" id="ctmmform_create-post-form" method="post" class="ctmmbuddyforms-active-form">
			   <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/1-soldier.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Soldier">Soldier</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/2-terrorist.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Terrorist">Terrorist</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/3-Leader.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Corruption">Corruption</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/4-live-combat.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Live Combat">Live Combat</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/5-Civilian-danger.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Civilian danger">Civilian danger</span>
			 </div>
			 <div class="pec_item ">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/6-Truck.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Truck">Truck</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/7-tank.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Tank">Tank</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/8-helicopter.png">
					<span><input type="checkbox" name="icons[]" value="Helicopter">Helicopter</span>
			 </div>
			 <div class="pec_item ">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/9-plane.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Plane">Plane</span>
			 </div>	
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/10-boat.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Boat">Boat</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/11-drone.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Drone">Drone</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/12-Missile.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Missile">Missile</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/13-explosives.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Explosives">Explosives</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/14-base.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Base">Base</span>
			 </div>
			 <div class="pec_item">
					<img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/15-supplies.png">
					<span id="pec_item_inner"><input type="checkbox" name="icons[]" value="Supplies">Supplies</span>
			 </div>
			 <input type="submit" value="submit" name="sub_menus_icons" style="display:none">
			 </form>
		 </div> 
	</div>
		 
		  <!-- Second step -->
       <div class="step well second-step">
		 <div class="visibility_sec">
		   <form action="/bee/peacekeeper/" id="ctmmform_create-post-form_next" method="post" class="ctmmbuddyforms-active-form_next">
			 <h5>Visibility</h5>
			 <div class="row">
				<div class="col-md-6">
					 <div class="visibility_block pec_item ">
						 <div class="vc_img">
							  <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Anonymous.png" alt="img"/>
							 <span><input type="checkbox" name="icons_next[]" value="Hidden">Hidden</span>
						</div> 
						  <div class="vc_cont">
							 <p>Be anonomous to help protect your identity.<br> 
							  Your profile will be hidden on this content
							  </p>
						 </div>
					</div>
					</div>
				 <div class="col-md-6">
					<div class="visibility_block pec_item">
						 <div class="vc_img">
							  <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/ultimatemember/4/profile_photo.jpg" alt="img" class="user_img"/>
							 <span><input type="checkbox" name="icons_next[]" value="Public">Public</span>
						</div> 
						  <div class="vc_cont">
							 <p>Your profile will be seen with this content.</p>
						 </div>
					</div>
				 </div>
			 </div>
			  <input type="submit" value="submit" name="sub_menus_icons_next" style="display:none">
		 
		 </form>
		 </div>
		   
		   <div class="share_sec">
			   <h5>Share Content</h5> 
			   <div class="share_single_post">
						     <div class="share-wrapper custom-form-submitedd">
			                  <?php echo do_shortcode( '[bf form_slug="create-post-link"]' ); ?>

							 </div>
									
						 
						  </div>
					  </div>
							  


		   </div>
		 
		 <!-- Third step -->
       <div class="step well third-step">
		   <div class="date_group">
			   <div class="row">
				 <div class="col-md-6">
					 <div class="left_date">
						 <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Date-and-time.png" alt="img">
						 <p>When was this taken?</p>
					 </div>
				   </div>
				    <div class="col-md-6">
					   
						    <?php echo do_shortcode( '[bf form_slug="time"]' ); ?>
				
				   </div>
			   </div>
		   </div>
		    <span class="line"></span>
		   <div class="date_group location_group">
			   <div class="row">
				    <div class="col-md-6">
					 <div class="left_date">
						  <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/02/Location.png" alt="img">
						 <p>Where was this taken?</p>
					 </div>
				    </div>
				    <div class="col-md-6">
					    <div class="right_date">
						     <?php echo do_shortcode('[gmw_current_location elements="formatted_address,address,location_form"]');?>
						  <div class="checkbox_group">
							  <input type="checkbox" id="a" name="a" value="abc">
                              <label for="a">I understand that exact location will be shown shared publicly</label>

							</div>
						</div>
				   </div>
			   </div>
		   </div>
		   <span class="line"></span>
		   
		   <div class="share_sec cost_sec">
			   <div class="select_group">
			   	<div class="row">
				    <?php echo do_shortcode( '[bf form_slug="language_tags"]' ); ?>
			   </div>	
				</div>
			   <div class="cost_inner">
				   <div class="row align-items-center">
				      <div class="col-md-6">
					     <div class="honey_cost">
							 <h4>Cost</h4>
							 <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Honey64A.png" alt="img">
							 <h4>-100</h4>
						  </div>
					   </div>
					   <div class="col-md-6">
					      <div class="disclam">
							<p>DISCLAIMER:</p>
							  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
							   <div class="checkbox_group">
								    <label for="b">I accept the terms and conditions</label>
								    <input type="checkbox" id="b" name="b" value="bcc">
							   </div>
						  </div>
					   </div>
				   </div>
			   </div>
			   
			</div>
		    
		   </div>
		 
		 <!-- step navigation -->	 
		 <div class="steps-navigation my-3">
              <button class="step-btn action back previes-step__button">
                <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Back-Button.png" alt="previes step">
			 </button>
              <button class="step-btn action next next-step__button" data-id="step-2-next">
               <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Next-Button.png" alt="next-step">
			 </button>
			 <button class="step-btn action submit"> <img src="<?php echo esc_url( home_url( '' ) ); ?>/wp-content/uploads/2022/01/Check1.png" alt="next-step"></button>
        </div>
            
		 
		 
  </div>
	 
	 
 </div>
</div>

<script>
		$(document).ready(function(){
			$(".pec_item").click(function(){
				//alert();
			 $(this).closest(".pec_item").toggleClass("active");
			  $(this).toggleClass("active");
			   $(this).addClass("activee");
		  });
		});
	
</script>


<script>
$(document).ready(function(){
  var current = 1;
	
	widget      = $(".step");
	btnnext     = $(".next");
	btnback     = $(".back"); 
	btnsubmit   = $(".submit");

	// Init buttons and UI
	widget.not(':eq(0)').hide();
	hideButtons(current);
	setProgress(current);

	// Next button click action
	btnnext.click(function(){
	    if(current < widget.length) { 			
            widget.show(); 			
            widget.not(':eq('+(current++)+')').hide();
  	        setProgress(current); 
  	        window.location.href= redirect_url;
            //alert("I was called from btnNext");
        } 		
       hideButtons(current); 	
   });
   
  // Back button click action 	
  btnback.click(function(){ 		
      if(current > 1){
		    current = current - 2;
		    btnnext.trigger('click');
	    }
        hideButtons(current);
    });		
});

// Change progress bar action
setProgress = function(currstep){
	var percent = parseFloat(100 / widget.length) * currstep;
	percent = percent.toFixed();
	$(".progress-bar")
        .css("width",percent+"%")
        .html(percent+"%");		
}

// Hide buttons according to the current step
hideButtons = function(current){
	var limit = parseInt(widget.length); 

	$(".action").hide();

	if(current < limit) btnnext.show(); 	
  if(current > 1) btnback.show();
	if(current == limit) { btnnext.hide(); btnsubmit.show(); }
}
</script>


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->



<script>
$(document).ready(function(){

	

// 	$('#change').click(function() {
//   $('li.select2-selection__choice')
//     // get the span inside, and use `[0]` to get dom object
//     .find('span')[0]
//     // get next node after span, which is text node
//     .nextSibling
//     // update the text content with new value
//     .textContent = 'text';
// })

	$('li.select2-selection__choice').each(function() {
  var $t = $(this);
  $t.attr({
      newTitleName: $t.attr('hh')
    })
    .removeAttr('title');
});
//	if ($(".step.well.second-step")[0]){

	//	if ($(".step.well.second-step").attr('style') == 'display: none;')
	//	//{ 
			//if ($(".step.well.second-step").attr('style') == 'display: none;')
			//if ($('.step.well.second-step').css('display') != 'none')
			//{
 $("button.step-btn.action.submit").click(function(event){
	 var site_url=document.URL+'bee/peacekeeper-search/';

 	 event.preventDefault();
 	//setTimeout(function() {
 		alert("form Submitted");
 			window.open(site_url, '_blank');
//}, 5000);
 		//  $("form#buddyforms_form_create-post-link").bind('submit', function () {
    

//          $.ajax({
// type: "POST",
// url: "site_url",
// data: $('form#buddyforms_form_create-post-link').serialize(),
// cache: false,
// success: function(result){
// alert(result);
// }
//   });
$('form').each(function(){
         $.ajax({
type: "POST",
url: site_url,
data: $(this).serialize(),
cache: false,
success: function(data) {
//alert(data);
}
});
});
//    $.ajax({
// type: "POST",
// url: "site_url",
// data: $("form#buddyforms_form_create-post-link").serialize(),
// cache: false,
// success: function(data) {
// alert(data);
// }
// });

//          $.ajax({
// type: "POST",
// url: "https://beesmartstg.wpengine.com/bee/peacekeeper/",
// data: $("form#buddyforms_form_language_tags").serialize(),
// cache: false,
// success: function(data) {
// alert(data);
// }
// });




//             $.ajax({
// type: "POST",
// url: "site_url",
// datastring: $("form#buddyforms_form_language_tags").serialize(),
// cache: false,
// success: function(datastring) {
// alert(datastring);
// }
// });
//  	$('form#buddyforms_form_create-post-link').bind('submit', function () {
//           $.ajax({
//             type: 'post',
//             url: site_url,
//             data: $('form#buddyforms_form_create-post-link').serialize(),
//             success: function () {
//               alert('form was submitted');
//             }
//           });
//           return false;
//         });
//  }
//});
 });

 });





</script>
		 
<?php
global $wpdb;

 if(isset($_POST['Description'] )){
 
 $Url = $_POST['Url'];
$Description = $_POST['Description'];
$message = $_POST['message'];
$wpdb->insert('peacekeeper', array(
	  'Url' => $Url,
    'Title' => $Description,
    'Desc' => $message
));
$wpdb->query($query);
}


if(isset($_POST['time_select'] )){
 
$Date = $_POST['data_select']; 
$Time = $_POST['time_select']; 

$result = $wpdb->get_results ( "SELECT * FROM `peacekeeper`  ORDER BY id DESC LIMIT 1" );
echo $valye = $result[0]->id;

$wpdb->update('peacekeeper', array('Datepost'=>$Date, 'Timepost'=>$Time), array('id'=>$valye));

$wpdb->query($query);

}

if(isset($_POST['gmw_cl_address'] )){
 
$address = $_POST['gmw_cl_address']; 

$result = $wpdb->get_results ( "SELECT * FROM `peacekeeper`  ORDER BY id DESC LIMIT 1" );
echo $valye = $result[0]->id;


$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyBFixsT8qI8FNdRuQr74IrF-JhoxKqypro';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$responseJson = curl_exec($ch);
curl_close($ch);

$response = json_decode($responseJson);
 $latitude = $response->results[0]->geometry->location->lat;
    $longitude = $response->results[0]->geometry->location->lng;
	
$wpdb->update('peacekeeper', array('Location'=>$address , 'latitude'=>$latitude, 'longitude'=>$longitude), array('id'=>$valye));

$wpdb->query($query);

}

if(isset($_POST['icons']))  
{ 
 
	$checkbox1=$_POST['icons'];  
	$chk="";  
	$values_check = array();
 foreach($checkbox1 as $chk1)  
   {  
       $chk .= $chk1;  
	  $values_check[] =$chk;
   }  
   $values_check_main = implode(",",$values_check);
   echo $values_check_main;
  $result = $wpdb->get_results ( "SELECT * FROM `peacekeeper`  ORDER BY id DESC LIMIT 1" );
echo $valye = $result[0]->id;
   $wpdb->update('peacekeeper', array('icons'=>$values_check_main ), array('id'=>$valye));
   $wpdb->query($query);

} 

if(isset($_POST['icons_next']))  
{ 
 
 	$checkbox1_next=$_POST['icons_next'];  
	$chk="";  
	$values_check_next = array();
 foreach($checkbox1_next as $chk1)  
   {  
       $chk .= $chk1;  
	  $values_check_next[] =$chk;
   }  
   $values_check_main_next = implode(",",$values_check_next);
   echo $values_check_main_next;
  $result = $wpdb->get_results ( "SELECT * FROM `peacekeeper`  ORDER BY id DESC LIMIT 1" );
echo $valye = $result[0]->id;
   $wpdb->update('peacekeeper', array('visibility'=>$values_check_main_next ), array('id'=>$valye));
   $wpdb->query($query);
 
} 

 if(isset($_POST['Language'] )){
 
$Language = $_POST['Language']; 
$Tags = $_POST['Tags']; 
$Tags_main = implode(',',$Tags);
$tags_data_count = count($Tags);
$tags_data_final = $Tags_main;

$taggname = array();
$keys = explode(",", $tags_data_final);
//foreach ($tags as $page) {
	for($i=0; $i<$tags_data_count; $i++)
	{
  $taggdata= get_tag($keys[$i]);
$taggname[] = $taggdata->name;

}
 $tag_data = implode(",",$taggname);
//echo $tag_data;
$result = $wpdb->get_results ( "SELECT * FROM `peacekeeper`  ORDER BY id DESC LIMIT 1" );
echo $valye = $result[0]->id;

$wpdb->update('peacekeeper', array('Language'=>$Language, 'Tags'=>$Tags ), array('id'=>$valye));

$wpdb->query($query);

$result = $wpdb->get_results ( "SELECT * FROM `peacekeeper`  ORDER BY id DESC LIMIT 1" );
print_r($result);

$icons = $result[0]->icons;
$visibility = $result[0]->visibility;
 $Url_main = $result[0]->Url;
 $Title_main= $result[0]->Title;
 $Desc_main= $result[0]->Desc;
 $Date_main= $result[0]->Datepost;
$Time_main = $result[0]->Timepost;
 $Location_main= $result[0]->Location;
 $Language_main= $result[0]->Language;
$Tags_main = $tag_data;

$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($Location_main).'&key=AIzaSyBFixsT8qI8FNdRuQr74IrF-JhoxKqypro';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
$responseJson = curl_exec($ch);
curl_close($ch);

$response = json_decode($responseJson);
 $latitude = $response->results[0]->geometry->location->lat;
    $longitude = $response->results[0]->geometry->location->lng;

$Peacekeepervalues ="\n". $icons."</br>"." \n".$visibility."</br>"."\nUrl :". $Url_main."</br>"." \nTitle :".$Title_main."</br>"." \nDesc :".$Desc_main."</br>".$Date_main ."</br>". $Time_main."\nLanguage</br>\n". $Language_main."</br>"."\nTags :". $Tags_main;
//sleep(10);
    $post_id = wp_insert_post( array(
                    'post_status' => 'publish',
                    'post_type' => 'beeart',
                    'post_title' =>  $Title_main,
                    'post_content' => $Peacekeepervalues
                ) );


$post_url = get_permalink( $post_id );

$result = $wpdb->get_results ( "SELECT * FROM `peacekeeper`  ORDER BY id DESC LIMIT 1" );
echo $valye = $result[0]->id;

$wpdb->update('peacekeeper', array('post_url'=>$post_url,'post_id'=>$post_id), array('id'=>$valye));


$post_type = 'custom_type';
}







?>
<?php
get_footer();
?>