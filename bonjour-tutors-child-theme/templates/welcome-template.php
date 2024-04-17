<?php
/* Template Name: welcome */
get_header();
?>
<style>
    .fa, .far, .fas {
        /*font-family: "FontAwesome" ! important;*/
    }
    </style>
<div class="fontWrp">

	<div class="welcomeTopSec cmnBnr">
		<div class="container">
			<div class="inrwrp text-center dFlx">
				<div class="bnrLeft">
					<div class="imgWrp">
						<img src="/wp-content/uploads/2023/01/test.jpg" alt="">
					</div>
				</div>
				<?php global $current_user; wp_get_current_user(); ?>
				<div class="BrnRight">
					<h1 class="">Welcome, <?php echo $current_user->display_name;?>!</h1>
					<div class="btnWrp">
						<a href="<?php echo site_url('/courses-catalogs/');?>" class="newBtn">Explore Classes </a>
					</div>
				</div>			
			</div>
		</div>	
	</div>

	


		<div class="poppularClass pt-50">
			<div class="container">
				<h2 class="text-center"> 
					Introducing Bonjour Tutors Groups!
				</h2>
				<div class="inrwrp course01Wrp">
					<div class="owl-carousel course03 cmnSlider">

					<?php  $loop = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    /*'tax_query'      => array(
      'relation' => 'AND',

     array(
        'taxonomy' => 'product_cat', // The taxonomy name
        'field'    => 'term_id', // Type of field ('term_id', 'slug', 'name' or 'term_taxonomy_id')
        'terms'    => 80, // can be an integer, a string or an array
    )*/
    /* array(
       'taxonomy' => 'product_types',
       'field' => 'name',
       'terms' => $cat->name,
     )*/
    // ),
) );

    while ( $loop->have_posts() ) : $loop->the_post();?>
					    <div class="item">
						    <div class="slidItem">
								<a href="<?php echo get_the_permalink();?>" class="crseItem">
									<div class="topImg">
										<img src="<?php echo get_the_post_thumbnail_url();?>" alt="">
									</div>
									<div class="crseInfo">
										<!--<div class="starInfo dFlx">
											<div class="strRatng dFlx">
												<div class="starWrp">
													<img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/star.png" alt="">
												</div>
											</div>
											<div class="strLike">
												<div class="like">
													<img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/like.png" alt="">
												</div>
											</div>
										</div>-->
										<div class="txtWrap">
											<h4><?php the_title();?></h4>	
										</div>	
									</div>
								</a>	
							</div>
					    </div>
					   		<?php   endwhile;

    wp_reset_query();
?>
					    
					 </div>						
				</div>		

			</div>		
		</div>
	</div>





		



	

	<!--<div class="BrowseClasses pt-50">
		<div class="container">
			<h2 class="text-center">Browse Classes</h2>
			<div class="inrwrp dFlx text-center">

				<div class="clw30">
					<div class="brwtpRw">
						<h3><a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/4Img-2.png" alt=""></span> Next Week </a></h3>
					</div>
					<div class="brwbtnRw dFlx">
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/1Img-2.png" alt=""></span> Morning</a>
						</div>
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/2Img-2.png" alt=""></span> Afternoon</a>
						</div>
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/3Img-2.png" alt=""></span> Evening</a>
						</div>
					</div>
				</div>

				<div class="clw30">
					<div class="brwtpRw">
						<h3><a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/5Img-2.png" alt=""></span> Next Month </a></h3>
					</div>
					<div class="brwbtnRw dFlx">
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/1Img-2.png" alt=""></span> Morning</a>
						</div>
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/2Img-2.png" alt=""></span> Afternoon</a>
						</div>
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/3Img-2.png" alt=""></span> Evening</a>
						</div>
					</div>
				</div>

				<div class="clw30">
					<div class="brwtpRw">
						<h3><a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/6Img-3.png" alt=""></span> Semester Courses </a></h3>
					</div>				
					<div class="brwbtnRw dFlx">
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/1Img-2.png" alt=""></span> Morning</a>
						</div>
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/2Img-2.png" alt=""></span> Afternoon</a>
						</div>
						<div class="clsTime">
							<a href=""><span class="icnWrp"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/3Img-2.png" alt=""></span> Evening</a>
						</div>
					</div>
				</div>
					
			</div>
		</div>
	</div>

	<div class="CoursesType pb-50">
		<div class="container">
			<div class="inrWrp dFlx">

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/art.png" alt=""> </span> Arts</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg1.png" alt=""> </span> English</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg2.png" alt=""> </span> Life Skills</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg3.png" alt=""> </span> Music</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg4.png" alt=""> </span> Social Studies</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg9.png" alt=""> </span> Coding & Tech</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg5.png" alt=""> </span> Health & Wellness</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg10-1.png" alt=""> </span> Math</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg6-1.png" alt=""> </span> Science & Nature</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg8.png" alt=""> </span> World Languages</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

				<div class="CoursesBx">
					<h2><span class="icnTxt"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/simg7.png" alt=""> </span> Learner Favorites</h2>
					<ul class="dFlx">
						<li><a href="">Drawing </a></li>
						<li><a href="">Art </a></li>
						<li><a href="">Painting </a></li>
						<li><a href="">Beginner Drawing </a></li>
						<li><a href="">Anime </a></li>
						<li><a href="">Procreate </a></li>
						<li><a href="">Art Classes </a></li>
						<li><a href="">Watercolor </a></li>
						<li><a href="">Christmas </a></li>
						<li><a href="">Animation </a></li>
						<li><a href="">All Arts Classes </a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>-->
<!-- 
	<div class="recentView pb-50 pt-50">
		<div class="container">
			<h2 class="text-center"> You recently viewed</h2>
			<div class="inrwrp dFlx">
				<div class="viewItem">
					<div class="slidItem">
						<a href="" class="crseItem">
							<div class="topImg">
								<img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/image01.jpg" alt="">
							</div>
							<div class="crseInfo">
								<div class="starInfo dFlx">
									<div class="strRatng dFlx">
										<div class="starWrp">
											<img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/star.png" alt="">
										</div>
										<div class="rateInfo">
											<span class="points"><strong>4.56 </strong></span>
											<span class="Nmbrs"><strong>(25) </strong></span>
										</div>											
									</div>
									<div class="strLike">
										<div class="like">
											<img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/like.png" alt="">
										</div>
									</div>
								</div>
								<div class="txtWrap">
									<h4>Hello Friends!- An Ongoing Preschool / Kindergarten Class (2x a Week)</h4>	
								</div>								

								<div class="tutrInfo dFlx">
									<div class="imgWrp">
										<img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/usr.png" alt="">
									</div>
									<span class="qlfy">Meg Billings, B.S.Ed.</span>
								</div>

								<div class="tutingInfo dFlx">
									<div class="infoDtls">
										<div class="topInfo"><strong>4-6</strong></div>
										<div class="BtmInfo">Ages</div>
									</div>
									<div class="infoDtls">
										<div class="topInfo"><strong>25</strong></div>
										<div class="BtmInfo">Mins</div>
									</div>
									<div class="infoDtls">
										<div class="topInfo"><strong>₹814</strong></div>
										<div class="BtmInfo">per class</div>
									</div>
								</div>
							</div>
						</a>	
					</div>
				</div>						
			</div>
		</div>
	</div> -->

	<!--<div class="interestParticular pt-50 pb-50">
		<div class="container">
			<div class="inrWrp text-center">
				<h2>Interested in something in particular?</h2>
				<div class="btnWrp">
					<a href="" class="newBtn01"> Request a Topic </a>
				</div>
			</div>
		</div>
	</div>-->

	<div class="footerTp">
	    <div class="container">
	      <div class="InrWrp">
	        <div class="fLgo">
	          <a href="https://devassists.com/dev/bonjourtutors/"><img src="https://devassists.com/dev/bonjourtutors/wp-content/uploads/2023/01/logo_small.png" alt=""></a>
	        </div>
	        <div class="cstmFmenu">
	          <ul class="dFlx">
	            <li><a href="https://devassists.com/dev/bonjourtutors/">Home</a></li>
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