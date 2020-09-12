<?php
 include 'include/header.php';
 // include 'include/slider.php';
?>
<?php if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       
        $customer_id=Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delcart = $ct->del_all_data_cart();
        header('Location:success.php');
    }
    
?>
<style type="text/css">
	.h3.succes_order{
	text-align: center;
	color: red;
}	
.p.succes_note
{
	text-align: center;
	padding: 10px;
	font-size: 17px;
}
</style>
<div class="main">
    <div class="content">
    	<div class="section group">		
			    		<h3 class="succes_order" style="text-align: center;color: red; font-size: 20px">Đơn Hàng Của Bạn Đã Được Lưu Lại</h3>
			    		<?php
			    			$customer_id=Session::get('customer_id');
			    			$get_amount = $ct->getAmountPrice($customer_id);
			    			if($get_amount)
			    			{
			    				$amount = 0;
			    				while ($result=$get_amount->fetch_assoc()) {
			    					$price = $result['price'];
			    					$amount += $price;
			    				}
			    			} 
			    		?>
			    		<p class="succes_note" style="text-align: center;padding: 10px;font-size: 17px;">Tổng Giá Trị Đơn Hàng Của Bạn: 
			    		<?php

			    		$vat = $amount * 0.1;
			    		$total =  $vat + $amount;
			    		echo $total. 'VND'; 

			    		 ?></p>
			    		<p class="succes_note" style="text-align: center;padding: 10px;font-size: 17px;">Chúng tôi sẽ liên lạc với bạn sớm nhất có thể. Xem lại đơn hàng của bạn <a href="orderdetails.php">Click Here</a></p>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
 <?php
 include 'include/footer.php';
?>