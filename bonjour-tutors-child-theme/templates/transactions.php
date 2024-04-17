<?php
/*Template name: Transactions*/
get_header();
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
<style>
    .fa, .far, .fas {
        font-family: "FontAwesome" ! important;
    }
    </style>
<div class="container">
    
    <div class="mt-5 transaction-page">
	
	<h3><b>Transaction Table</b></h3>
        
        <div class="transaction-header">
            <div class="row">
            <div class="col-md-1">#</div>
            <div class="col-md-3">Date</div>
            <div class="col-md-3">Amount</div>
            <div class="col-md-5">Details</div>
                </div>
	  </div>
        
	  
	  <div class="transaction-tbody">
	  
	  <?php

	  $current_user_id=get_current_user_id();
	  $orderArg = array(
		'customer_id' => $current_user_id,
		'limit' => -1,
		'orderby' => 'date',
			'order' => 'DESC',
		);
	  $orders = wc_get_orders($orderArg);
		if($orders){
			$order_srno=1;
			foreach($orders as  $orderData) {
			  $order = wc_get_order( $orderData->data['id'] );
			  
			  $kid_user_id = $order->get_meta('kid_profile');
			   $firstname= get_user_meta($kid_user_id,"first_name",true);
			  $items = $order->get_items();
			  
			  $order_id = $orderData->data['id'];
                //echo $order_id.'order_id';
                $order = wc_get_order( $order_id ); //returns WC_Order if valid order 
                $items = $order->get_items();   //returns an array of WC_Order_item or a child class (i.e. WC_Order_Item_Product)
			?>
				  <div class="transaction-box">
                      <div class="row">
				  <div class="col-md-1"><div class="mobile-title">#</div><?php echo $order_srno;?></div>
				  <div class="col-md-3"><div class="mobile-title">Date</div><?php echo date('j/m/Y', strtotime($order->get_date_created()));?></div>
				  <div class="col-md-3"><div class="mobile-title">Amount</div><?php echo '<b>'.get_woocommerce_currency_symbol().'</b>'.' '.$orderData->data['total'];?></div>
				  <!--<td><?php //echo $orderData->data['payment_method'].''.'('.$orderData->data['payment_method_title'].')';?></td>-->
				  <div class="col-md-5"><div class="mobile-title">Details</div><p><?php
				  foreach($items as $key => $value){
						$product_name = $value->get_name();
						$product_id=$value->get_product_id();
						$variation_id = false;
						$product = wc_get_product($product_id);
						$variation_id = $value->get_variation_id();
						$downloaded_files=get_post_meta($variation_id,'_downloadable_files',true);
						foreach($downloaded_files as $view_class){
							$zoom_meeting=$view_class['file'];
						}
						$product_id = get_permalink($value->get_product_id());				
				  }
				  echo '<b>'.$product_name.'</b>';?>
				  </p>
				  <p><?php echo 'Subscription payment for '.'<b>'.$firstname.'</b>';?></p>
				  <a class="receipt_btn" href="<?php echo site_url();?>/my-account/view-order/<?php echo $orderData->data['id'];?>">View Receipt</a> | <a class="classview_btn" href="<?php echo $zoom_meeting;?>">View class</a></div>
          </div>
				  </div>
				  <?php
				  $order_srno++;
			}
		}else{
			echo ' <tr class="no-data"><td colspan="5">No Transaction record founds</td></tr>';
		}
	  ?>
	</div>
        
</div>
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
<?php
get_footer();
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>