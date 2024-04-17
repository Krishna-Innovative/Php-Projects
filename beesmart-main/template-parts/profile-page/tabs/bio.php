<?php
$current_user = wp_get_current_user();
$current_user_id = $current_user->ID;
get_template_part( 'template-parts/profile-page/update_profile_popup' );
?>

<div class="tab-pane fade ergrg show active" id="info" role="tabpanel" aria-labelledby="info-tab">
  <div class="add-info-block d-block mt-0 add-info-updated">
    <div class="add_bio_inner">
      <div class="bio_icon icon_1">
        <a href='#' class=""><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Verified.png" alt="img"></a>
      </div>
      <div class="bio_icon icon_2">
        <a href='#'><img src="<?php echo imgPATH; ?>023-sunflower.png" alt="img" width="65"/></a>
      </div>
      <div class="bio_icon icon_3">
        <a href="" class="disable"><img src="<?php echo imgPATH; ?>Find1-1.png" alt="img" width="70"/></a>
      </div>
      <div class="bio_icon icon_4">
        <a href='#'><img src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/Types-Personal.png" alt="img"></a>
        <div class="dropdown">
          <a class="" href="#" role="button" id="xyz" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
            </svg>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xyz">
            <a class="dropdown-item">Edit</a>
            <a type="button" class="dropdown-item open-update-profile-popup" data-toggle="modal" data-target="#update-profile-popup">
              Update Profile
            </a>
            <?php $userId = get_the_author_ID();
            if ($userId == $current_user_id) { ?>
                <a class="dropdown-item" data-toggle="modal" data-target="#create-info-categorypopup">Add Category</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#edit-info-categorypopup">Edits Category</a>
                <?php
                }
                ?>
          </div>
        </div>
      </div>
    </div>
    <!--<select id="Sortingfunctionality" class="form-control custom_select w-auto pr-5 pl-3">
      <option value="1">Newest</option>
      <option value="0">Oldest</option>
    </select>-->
	<?php $userId = get_the_author_ID();
	if ($userId == $current_user_id) { ?>
<!--
    <button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add-info-popup" id="show_form_btn">
      <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Create1.png" alt="add info">
    </button>
-->
	<?php
	}
	?>
  </div>
<div class="bio_subtab mb-5">
  <p class="text-center body_text">Body Text: This is a description area of the page. It can be used for RICH text, emoji's and social links and would push down the below contianer.</p>
  <ul class="nav nav-tabs" id="myTab1" role="tablist">
    <li class="nav-item col">
        <button class="nav-link active" data-rel="tab-1">
            <img src="<?php echo imgPATH; ?>003-laws.png" alt="img" width="70"/>
            <span>News</span>
        </button>
    </li>
    <li class="nav-item col">
        <button class="nav-link" data-rel="tab-2">
            <img src="<?php echo imgPATH; ?>map.png" alt="img" width="70"/>
            <span>Location</span>
        </button>
    </li>
    <li class="nav-item col">
        <button class="nav-link" data-rel="tab-3">
          <p class="position-relative d-inline-block mb-0"><img src="<?php echo imgPATH; ?>Create1.png" alt="img" width="70"/>
            <span>Add</span>
           <img src="<?php echo imgPATH; ?>Verified.png" alt="img" class="verify_icon disable"/> 
</p>
        </button>
    </li>
</ul>
<div class="tab-content mt-0" id="subtab_content">
 <div class="tab-box" id="tab-1" style="display:block;"> 
 <div class="profile_inner_box position-relative">
  <div class="subtab_inner_box">
    <p class="text-center">News</p>
    <div class="tabs_drodown">
    <div class="dropdown">
          <a class="d-block text-center" href="#" role="button" id="abc" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
            </svg>
            <span class="d-block">0/4</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="abc">
            <a class="dropdown-item">Edit Name</a>
            <a class="dropdown-item">Sticker</a>
            <a class="dropdown-item">Visibility</a>
            <a class="dropdown-item">Safety of current sub-tab</a>
          </div>
          </div>
    </div>
</div>
    <button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add-info-popup">
      <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
    </button>
  </div>
 </div>
 <div class="tab-box" id="tab-2"> 
 <div class="profile_inner_box position-relative">
    <div class="subtab_inner_box">
      <p class="text-center">Location</p>
        <div class="tabs_drodown">
    <div class="dropdown">
          <a class="d-block text-center" href="#" role="button" id="abb" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
            </svg>
            <span class="d-block">0/4</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="abb">
            <a class="dropdown-item">Edit Name</a>
            <a class="dropdown-item">Sticker</a>
            <a class="dropdown-item">Visibility</a>
            <a class="dropdown-item">Safety of current sub-tab</a>
          </div>
          </div>
    </div>
    </div>
       <button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add-info-popup">
      <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
     </button>
 </div>
 </div>
 <div class="tab-box" id="tab-3"> 
 <div class="profile_inner_box position-relative">
 <div class="subtab_inner_box">
   <p class="text-center">Add</p>
     <div class="tabs_drodown">
    <div class="dropdown">
          <a class="d-block text-center" href="#" role="button" id="abca" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
            </svg>
            <span class="d-block">0/4</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="abca">
            <a class="dropdown-item">Edit Name</a>
            <a class="dropdown-item">Sticker</a>
            <a class="dropdown-item">Visibility</a>
            <a class="dropdown-item">Safety of current sub-tab</a>
          </div>
          </div>
    </div>
</div>
     <button type="button" class="btn btn-primary add_btn" data-toggle="modal" data-target="#add-info-popup">
      <img src="<?php echo imgPATH; ?>Create1.png" alt="add info">
    </button>
   </div>
 </div>

</div>
</div>

 <ul class="nav nav-tabs" id="nav_bar_navigation" role="tablist">
<?php global $wpdb;
	$table = $wpdb->prefix.'save_bio_info';
	$list_of_category = $wpdb->get_results ( "SELECT * FROM  $table WHERE bio_userid = $current_user_id", ARRAY_A);
	$count=0;
	foreach($list_of_category as $key=>$category_listing){
		$bio_userinfo=$category_listing['bio_userinfo'];
		$bio_userid=$category_listing['bio_userid'];
		if($key==0){
			$box_id='active';
		}else{
			$box_id='active'.$key;
		}
		?> 
	 <li class="nav-item" role="presentation">
    <a class="nav-link <?php echo $box_id;?>" id="<?php echo str_replace(' ', '_', $bio_userinfo);?>-tab" data-toggle="tab" href="#<?php echo str_replace(' ', '_', $bio_userinfo);?>" role="tab" aria-controls="<?php echo str_replace(' ', '_', $bio_userinfo);?>" aria-selected="true"><?php echo $bio_userinfo;?></a>
     </li>
	 
		
		<?php
		$count++;
	}
	?>
</ul>
	<div class="tab-content list_of_bios" id="myTabContent1">

<?php foreach($list_of_category as $key=>$category_listing){
		if($key==0){
			$box_id='active show fade';
		}else{
			$box_id='active'.$key;
		}?>
		<div class="tab-pane <?php echo $box_id;?>" id="<?php echo str_replace(' ', '_', $category_listing['bio_userinfo']);?>" role="tabpanel" aria-labelledby="<?php echo str_replace(' ', '_', $category_listing['bio_userinfo']);?>-tab">

<?php 
$category_value=$category_listing['bio_userinfo'];
$args = array(  'post_type' => 'info',
    'posts_per_page' => 4,
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'category_sections',
            'value' => $category_value,
			'compare'=>'='
        ),
    ),
);
$query = new WP_Query($args);
if ($query->have_posts()):
      global $post;
	 
    while ($query->have_posts() ) : $query->the_post();
	 $post_id = get_the_ID();
      $meta = get_post_meta($post_id);
		// echo get_the_title();
		//echo '<pre>';print_r($query);
		?>
		<div class="profile_single_info">
        <div class="post-thumbnail">
          <input type="text" class="meta-preview" value="<?php echo get_field('image_by_url');  ?>">
          <div class="loading"></div>
          <div class="container-resposne">
            <?php //debug($meta);
            apply_filters('previewRender', $meta['image_by_url'][0]); ?>
            </div>
          </div>
          <div class="post-content">
            <div class="btn-group dropright">
              <button type="button" class="btn btn-secondary dropdown-toggle edit-bio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo imgPATH; ?>3-dots.png" alt="">
              </button>
              <div class="dropdown-menu">
                <?php if ($post->post_author == $current_user->ID) { ?>
                  <p><a onclick="return confirm('Are you SURE you want to delete this post?')" href="<?php echo get_delete_post_link($post->ID); ?>">Delete post</a></p>
                <?php } ?>
              </div>
            </div>
            <div class="top-wrapper">
              <h2 class="post-title"><?php echo get_the_title(); ?></h2>

              <?php
              the_content();

              ?>

            </div>
          </div>
        </div>
		<?php
	endwhile;
else :  ?>
			<p><?php _e('Sorry, no Feed matched your criteria.Please choose another Options'); ?></p>
		<?php endif; wp_reset_postdata();

?>
</div>
<?php }?>


  </div>
  <!-- Button trigger modal -->
  <div class="tab_info_sec">
    <a href="#" data-target="#bio_info" data-toggle="modal">
      <img src="<?php echo site_url(); ?>/wp-content/uploads/2022/05/Info.png" alt="img">
    </a>
  </div>

  <!-- Modal -->
  <div class="modal fade addinfo_updatedpopup" id="add-info-popup" tabindex="-1" aria-labelledby="addInfo" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="text-center">
          <img src="<?php echo imgPATH; ?>003-laws.png" alt="img" width="70"/>
          <span class="d-block text-white mt-1">News</span>
        </div>
        <div class="modal-body">
          <form id="bees_add_info_form">
            <input id="bees_info_user_id" type="text" hidden value="<?php echo $current_user_id; ?>">
            <div class="form-group">
              <div class="url_embed">
              <img src="<?php echo imgPATH; ?>Shared-tab.png" alt="img" />
              <input name="info_preview_by_link" type="text" class="form-control" id="info_post_type_image_by_url" placeholder="Url Link (embed)">
              </div>
              <div class="bio-container-resposne">
                <img style="max-height:100%; max-width:100%; width: 100%; object-fit: cover;" src="<?php echo site_url(); ?>/wp-content/uploads/2022/02/New-Project-48.png">
              </div>
            </div>
            <!-- <div class="form-group">
              <input name="info_title" type="text" class="form-control" id="info_post_type_title" aria-describedby="emailHelp" placeholder="Title">
            </div>
            <div class="form-group">
              <textarea name="info_content" class="form-control" id="info_post_type_description" rows="3" placeholder="Content"></textarea>
            </div> -->
          </form>
		   <!-- <div class="form-group">
              <select name="post_select_option" class="form-control" id="post_select_option" >
				 <?php 
					$list_of_category = $wpdb->get_results ( "SELECT * FROM  $table WHERE bio_userid = $current_user_id");
					foreach($list_of_category as $category_listing){
						$bio_userinfo=$category_listing->bio_userinfo;
						$bio_userid=$category_listing->bio_userid;
						?> <option value="<?php echo $bio_userinfo;?>"><?php echo $bio_userinfo;?></option>
						<?php
					}
				  ?>
			  </select>
            </div> 
          <button id="bees_create_info" type="button" class="btn btn-primary" data-type="shadow">
            <img width="65" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Check1.png" data-type="shadow" alt="add">
          </button> -->
        </div>
        <div class="close-block">
          <button type="button" id="close-addInfo-popup" class="btn btn-secondary" data-dismiss="modal">
            <img width="60" src="<?php echo imgPATH; ?>X.png" alt="close">
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade custom_trsparent_modal" id="create-info-categorypopup" tabindex="-1" aria-labelledby="addInfo" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
			<h3>
				Add Your Info Category
			</h3>
          <form id="bees_add_info_form1">
           
            <div class="form-group">
              <!-- <label for="info_post_type_image_by_url">Image by url</label> -->
              <input name="info_preview_by_link" type="text" class="form-control" id="category_name_of_bio" placeholder="Category Name">
            <input type="hidden" value="<?php echo $current_user_id;?>" id="current_user_login">
            </div>
          </form>
          <button type="button" id="save_bio" class="btn btn-secondary p-0 click_animation border-0" data-type="shadow">
            <img width="60" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Check1.png" data-type="shadow" alt="add" >
          </button>
        </div>
        <div class="close-block text-center">
        <button type="button" class="btn btn-secondary p-0 click_animation border-0" data-dismiss="modal">
          <img width="50" src="<?php echo imgPATH; ?>X.png" alt="close">
        </button>
      </div>
      </div>

      

    </div>
  </div>
</div>
<div class="modal fade custom_trsparent_modal" id="edit-info-categorypopup" tabindex="-1" aria-labelledby="addInfo" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
			<h3>
				Edit Your Info Category
			</h3>
          <form id="bees_add_info_form2" name="bees_add_info_form2">
            	<input type="hidden" id="current_user_login" value="<?php echo $current_user_id;?>">
				<?php
              foreach($list_of_category as $category_listing){
		$bio_userinfo=$category_listing->bio_userinfo;
		$bio_userid=$category_listing->bio_userid;
				  $bio_id=$category_listing->id;
		?>
				 <div class="form-group">
					<input name="category_name_of_bio[]" type="text" class="form-control dropped" data-id="<?php echo $bio_id;?>" id="category_name_of_bio<?php echo $bio_id;?>" value="<?php echo $bio_userinfo;?>"> </div>
		<?php
	}
				?>
                      
          </form>
          <button type="button" id="edit_bio" class="btn btn-secondary p-0 click_animation border-0" data-type="shadow">
            <img width="60" src="<?php echo site_url(); ?>/wp-content/uploads/2022/01/Check1.png" data-type="shadow" alt="add" >
          </button>
        </div>
        <div class="close-block text-center">
        <button type="button" class="btn btn-secondary p-0 click_animation border-0" data-dismiss="modal">
          <img width="50" src="<?php echo imgPATH; ?>X.png" alt="close">
        </button>
      </div>
      </div>

      

    </div>
  </div>
  
</div>
<style>
.tablink {
  background-color: #555;
  color: white;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  font-size: 17px;
  width: 25%;
}

.tablink:hover {
  background-color: #777;
}
.tabcontent {
  color: white;
  display: none;
  padding: 100px 20px;
  height: 100%;
}
</style>
<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<script>

$('.bio_subtab li .nav-link').on('click', function(){
		   	var target = $(this).attr('data-rel');
			$('.bio_subtab li .nav-link').removeClass('active');
		   	$(this).addClass('active');
		   	$("#"+target).fadeIn('slow').siblings(".tab-box").hide();
		   	return false;
  });
</script>
