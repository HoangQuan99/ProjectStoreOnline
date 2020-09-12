
<?php
 include 'include/header.php';
?>
<?php
	$login_check = Session::get('customer_login');
		if($login_check==FALSE)
			{
				header('Location:login.php');
			}
		
?>
 <?php if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       
        $customer_id=Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delcart = $ct->del_all_data_cart();
        header('Location:success.php');
    }
    
?>
<?php
// if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
//     	$cartId = $_POST['cartId'];
//     	$soluong = $_POST['soluong'];
//         $update_soluong= $ct->update_soluong($soluong,$cartId);
//         if($soluong<=0)
//         {
//         	$delcart = $ct->del_cart($cartId);
//         }
//     }
//     // if($soluong<=0)
//     // {
//     // 	 $delcart = $ct->del_cart($cartId);
//     // }
//     if(isset($_GET['cartid']))
//     {
//         $cartid= $_GET['cartid'];
//         $delcart = $ct->del_cart($cartid);
//     }
//     // if($soluong<=0)
//     // {
//     // 	  $delcart = $ct->del_cart($cartId);
//     // }

 ?>


 <style>
 	.box_left{
 		width: 100%;
 		border: 1px solid #666; 
 		padding: 4px;
 		height: 280px;
 		
 	}
 	/*a.a_order
 	{
 		padding: 7px 40px;
 		color: #fff;
 		font-size: 21px;
 		background: red;
 		
 	}*/
 </style>
 <form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		<h3>Chi tiết đơn hàng</h3>
    		</div>     
    		<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
    				<!-- <?php
			    		if(isset($delcart))
			    		 echo $delcart; 
			    	?> -->
			    	<!-- <h2>Giỏ Hàng</h2> -->
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Tên Sản Phẩm</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="15%">Date</th>
								<th width="10%">Status</th>
								<th width="15%">Action</th>
								
							</tr>
							<?php
								$customer_id=Session::get('customer_id');
								$get_cart_order = $ct->get_cart_order($customer_id);
								if($get_cart_order)
								{
									
									$sl=0;
									$i=0;
									while ($result=$get_cart_order->fetch_assoc()){
									$i++;
							 ?>

							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="100px"/></td>
								<td><?php echo $result['price'].' VND' ?></td>
								<td><?php echo $result['soluong'] ?></td>
								<td><?php echo $fm->formatDate($result['date_order'])  ?></td>
								<td>
								<?php 
									if ($result['status'] == '0') {
										echo "Đang chờ xử lý";
									}elseif($result['status'] == 1) {
								?>
								<span>Đã gửi hàng</span>
								
								<?php

									}elseif($result['status']==2){
										echo 'Đã nhận';
									}
								 ?>	

								</td>
								<?php 
								if ($result['status'] == '0') {
								 ?>

								<td><?php echo 'N/A'; ?></td>

								 <?php 
								 }elseif($result['status']==1) {
								 ?>	
								 <td>
								 	<a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xác nhận</a>
								 </td>
								 <?php 
								}else{
								  ?>
								  
								<td><?php echo 'Đã nhận'; ?></td>
								<?php 
								}
								 ?>
							</tr>
							<?php 							
								}
							}
							 ?>
	
						</table>
						

					</div>
					<!-- <div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div> -->
					<?php
							$check_cart = $ct->check_cart();
							if($check_cart){			
							?>
						<div class="shopping">
							<div class="shopleft">
								<a href="index.php"> <img src="images/shop.png" alt="" /></a>
							</div>
							<div class="shopright">
								<a href="payment.php"> <img src="images/check.png" alt="" /></a>
							</div>
						</div>	
					   <?php
						}
						else{			
							?>
						<div class="shopping">
							<div class="shopleft">
								<a href="index.php"> <img src="images/shop.png" alt="" /></a>
							</div>
							<div class="shopright">
								<a href="index.php"> <img src="images/check.png" alt="" /></a>
							</div>
						</div>	
					   <?php
						}
					   
					   ?>
    		</div> 
 	</form>
 	<div class="clear"></div>
 <?php
 include 'include/footer.php';
?>

