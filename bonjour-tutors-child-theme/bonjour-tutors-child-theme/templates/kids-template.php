<?php
/* Template Name: kids */
get_header();
?>
  
<style>
.profileTxt p {
    position: absolute;
    left: 16px;
}
.profileTxt input {
    opacity: 0;
    z-index: 999;
    cursor: pointer;
}

#table_kidPrfl {
    flex-wrap: unset;
}

</style>
 



<div class="fontWrp">
  <div class="yourKids pt-100 pb-100">
    <div class="container">
      <h2 class="text-center">Tell us about your kids! </h2>
      <p class="text-center">
        <strong>We’ll recommend classes they’ll love.</strong>
      </p>

      <div class="cstm_Row">
        <div class="fullRwInfo">
          <div class="saveLearnerWrp dFlx">

  <?php $user_id = get_current_user_id(); ?> 

    <input type="hidden" value="<?php echo get_current_user_id(); ?>" name="current_user_idd" >


    <?php 

    global $wpdb;
    $meta_data = $wpdb->get_results("SELECT meta_value FROM `uDO_usermeta` WHERE (`meta_key` = 'is_child_id' AND `user_id` = '".$user_id."') ORDER BY meta_value DESC");




    //echo "<pre>"; print_r($meta_data); echo "</pre>"; die;

    if(empty($meta_data)) { ?>

      <form method="POST" action="" class="add_kids4" id="add_kids4">
            <div class="kidsWrap">
              <div class="tpRw dFlx">              

                <div class="LftSide dFlx cmnSelect">
                  <div class="clw-70">
                    <div class="rw0">

<input type="hidden" value="<?php echo get_current_user_id(); ?>" name="current_user_id" >
 
 

                      <p><strong>First Name </strong></p>
                      <input type="text" name="first_name" id="first_name">
                      
                    </div>
                      
                    <div class="rw0">
                      <p><strong>Age </strong></p>
                      <div class="select select_age">
                        <select id="age" name="age">
                          <option value="">Age</option>
							<?php
							  $terms = get_terms([
								'taxonomy' => 'age',
								'hide_empty' => false,
							]);
						
							foreach ($terms as $term){ ?> 
							<option value="<?php echo $term->name; ?>"><?php echo $term->name; ?></option>
							  <?php } ?>     
					</select>
                      </div>
                    </div>

                    <div class="rw0">
                      <p><strong>Grade </strong></p>
                      <div class="select select_grade">
					   <?php
						   $gradeterms1 = get_terms([
								'taxonomy' => 'grade',
								'hide_empty' => false,
							]);
							$gradeterms1 = json_decode( json_encode( $gradeterms1 ), true );
							asort($gradeterms1);
						?>
                        <select id="grade" name="grade">
                          <option value="">Grade</option>
						 
                          <?php foreach ($gradeterms1 as $term){?>
							  <option value="<?php echo $term['slug'];?>"><?php echo $term['name'];?></option>
						  <?php } ?>
                        </select>
                      </div>
                    </div>

                  </div> 

                  <div class="clw-30">
                    <div class="profileImgWrp">
                      <div class="profileImg show_img_add">
                        <img src="/wp-content/uploads/2023/01/pic01.png">

                        <input type="hidden" name="show_img_add_img" id="show_img_add_img" value="/wp-content/uploads/2023/01/pic01.png">
                      </div>
                      <div class="profileTxt">

                        <button type="button" class="btn btn-info btn-lg add_some_cus_popup" data-toggle="modal" data-target="#openImagePop">Edit</button>

                          
                      </div>
                    </div>
                  </div>
                </div>

              <div class="RghtSide">
                <div class="imgeWrp">
                    <img src="/wp-content/uploads/2023/02/studentImg.png" alt="">
                  </div>
                </div>
              </div>

              <div class="btmRw">
                <div class="clw100 ">
                  <div class="btnWrp dFlx">
                    <button class="btn saveLearner add_kids" >Save Learner</button>
                  </div>
                </div>
              </div>            
            </div>  
          </form> 


      <div class="kidPrfl" id="table_kidPrfl" style="display: none;">
      <div class="kidPrflRw dFlx">
        <div class="leftInfo dFlx">
          <div class="iconWrp"></div>
            <div class="namecl">
            <p><strong id="names"> </strong></p>
            </div>
            <div class="agecl"> <p id="ages"></p> </div>
            <div class="agecld">  <p id="grades"></p> </div> 
        <table id="dat_table">
          <thead> 
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Age</th>
            <th>Grade</th>
            <th>Action</th>
          </tr>
        </thead> 

          <tbody>
             
          </tbody>

        </table>
        
        </div>
      </div>       
    </div>

     <?php  }  
       elseif(!empty($meta_data)) {
        foreach ($meta_data as $key => $valval) {
          $kid_idd = $valval->meta_value;

          $kid_first_name = get_user_meta( $kid_idd, 'first_name', true );
          $kid_age = get_user_meta( $kid_idd, 'age', true );
          $kid_grade = get_user_meta( $kid_idd, 'grade', true );
          $kid_img = get_user_meta( $kid_idd, 'kid_img', true );


          if($key == "0") {
      ?>



      <div class="kidPrfl" id="table_kidPrfl"  style="display: block;">
      <div class="kidPrflRw dFlx">
        <div class="leftInfo dFlx">
          <div class="iconWrp"></div>
            <div class="namecl">
            <p><strong id="names"> </strong></p>
            </div>
            <div class="agecl"> <p id="ages"></p> </div>
            <div class="agecld">  <p id="grades"></p> </div> 
          <div class="table_responsive">   
        <table id="dat_table">
          <thead> 
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Age</th>
            <th>Grade</th>
            <th>Action</th>
          </tr>
        </thead> 
         <tbody>
      <?php } ?>

         

            <tr id="<?php echo "kid_".$kid_idd; ?>" class='show_data_table'>

              <td> 
               <?php if(empty($kid_img))
                { ?>
                  <img style='max-width: 100px;' src='/wp-content/uploads/2023/01/pic01.png' alt=''>
                  
                <?php } else { ?>
                <img style='max-width: 100px;' src='<?php echo $kid_img; ?>' alt=''>
              <?php } ?>

            
              </td>
              
              <td class='tble_names'><?php echo $kid_first_name; ?></td>
              <td class='tble_ages'><?php echo $kid_age; ?></td>
              <td class='tble_grades'><?php echo $kid_grade; ?></td>

              <td> 
                <div class="action_div">
                <span onclick="deletekid(<?php echo get_current_user_id().','.$kid_idd; ?>)" class='delTxt tble_delete'>Delete</span>

                <span onclick="editkid(<?php echo get_current_user_id().','.$kid_idd; ?>)" class='btn EditBtn tble_edit'>Edit</span>
                </div>  
              </td> 
            </tr> 
         <?php  } ?>    
          </tbody>

        </table>
        </div>
        
        </div>
      </div>       
    </div>



          
      <?php  }  
      else { ?>





      <div class="kidPrfl" id="table_kidPrfl">
      <div class="kidPrflRw dFlx">
        <div class="leftInfo dFlx">
          <div class="iconWrp"></div>
            <div class="namecl">
            <p><strong id="names"> </strong></p>
            </div>
            <div class="agecl"> <p id="ages"></p> </div>
            <div class="agecld">  <p id="grades"></p> </div> 
        <table id="dat_table">
          <thead> 
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Age</th>
            <th>Grade</th>
          </tr>
        </thead> 

          <tbody>
             
          </tbody>

        </table>
        
        </div>
      </div>       
    </div>

  <?php  } ?>


 
 



   <form method="POST" action="" class="edit_kids4" id="edit_kids4" style="display:none;">
            <div class="kidsWrap">
              <div class="tpRw dFlx">              

                <div class="LftSide dFlx cmnSelect">
                  <div class="clw-70">
                    <div class="rw0">

<input type="hidden" value="<?php echo get_current_user_id(); ?>" name="current_user_id" >

<input type="hidden" value="" name="current_kid_id" id="current_kid_id">


                      <p><strong>First Name </strong></p>
                      <input type="text" name="edit_first_name" id="edit_first_name" value="">
                    </div>
                      
                    <div class="rw0">
                      <p><strong>Age </strong></p>
                      <div class="select">
                        <select id="edit_age" name="edit_age">
                          <option value="">Age</option>
                          <?php for($i=6;$i<=18;$i++) { ?> 
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                          <?php } ?>     
                        </select>
                      </div>
                    </div>

                    <div class="rw0">
                      <p><strong>Grade </strong></p>
                      <div class="select">
                        <select id="edit_grade" name="edit_grade">
                          <option value="">Grade</option>
                          <option value="GRADE I">GRADE I</option>
                          <option value="GRADE II">GRADE II</option>
                          <option value="GRADE III">GRADE III</option>
                          <option value="GRADE IV">GRADE IV</option>
                          <option value="GRADE V">GRADE V</option>
                          <option value="GRADE VI">GRADE VI</option>
                          <option value="GRADE VII">GRADE VII</option>
                          <option value="GRADE VIII">GRADE VIII</option>
                          <option value="GRADE IX">GRADE IX</option>
                          <option value="GRADE X">GRADE X</option>
                          <option value="GRADE XI">GRADE XI</option>
                          <option value="GRADE XII">GRADE XII</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="clw-30">
                    <div class="profileImgWrp">
                      <div class="profileImg show_img_add">
                        <img src="/wp-content/uploads/2023/01/pic01.png">
                        <input type="hidden" name="show_img_add_img" id="show_img_add_img" value="/wp-content/uploads/2023/01/pic01.png">
                      </div>
                      <div class="profileTxt">
                           <button type="button" class="btn btn-info btn-lg add_some_cus_popup" data-toggle="modal" data-target="#openImagePop">Edit</button>
                      </div>
                    </div>
                  </div>
                </div>

              <div class="RghtSide">
                <div class="imgeWrp">
                    <img src="/wp-content/uploads/2023/02/studentImg.png" alt="">
                  </div>
                </div>
              </div>

              <div class="btmRw">
                <div class="clw100 ">
                  <div class="btnWrp dFlx">
                    <button class="btn saveLearner edit_kids" >Save Learner</button>
                  </div>
                </div>
              </div>            
            </div>  
          </form> 


          <div id="add_new_data"><div> 



              </div>

          </div>



          



          <div class="anotherKid">
            <div class="kidadd">
                <button id="adddmore">+ Another Kid</button>
             <!-- <a href="javascript:void(0)">+ Another Kid </a>-->
            </div>
            <div class="AllDn">
              <a href="../welcome" class="btn allDOne">All Done!</a>
            </div>
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



 <div class="modal fade" id="openImagePop" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="remove_pop_fot close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select avatar</h4>
        </div>
        <div class="modal-body">
          <div class="image-check">

            <img alt="" src="../wp-content/uploads/2023/04/car-toy.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/toy.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/rock-horse.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/toy-train.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/rubber-duck.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/plane.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/hand-print.png" class="image_icon choose_avatar">
			<img alt="" src="../wp-content/uploads/2023/04/rocking-horse.png" class="image_icon choose_avatar">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="remove_pop_fot btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>
   
 
  
  
 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

 
 <script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>


 <script src='../wp-content/themes/ms-lms-starter-theme/assets/js/admin-ajax.js?ver=1.1'></script>
<script>

</script>
<?php
get_footer();
?>

