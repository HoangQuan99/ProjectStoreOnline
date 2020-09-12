
<?php
 include 'include/header.php';
?>
 <?php if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
       
        $customer_id=Session::get('customer_id');
        $insertOrder = $ct->insertOrder($customer_id);
        $delcart = $ct->del_all_data_cart();
        header('Location:success.php');
    }
    
?>
<style type="text/css">
	.box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 4px;	

	}
 	.box_right {
    width: 47%;
    border: 1px solid #666;
    float: right;
    padding: 4px;
	}
	.a_order {
    background: #653092;
    color: aliceblue;
    padding: 10px;
    font-size: 25px;
    border-radius: none;
    cursor: pointer;
	}
}
</style>
 <form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="heading">
    		<h3>Thanh Toán Khi Nhận Hàng</h3>
    		</div>     
    		<div class="clear"></div>
    		<div class="box_left">
    			<div class="cartpage">
			    	<!-- <h2>Giỏ Hàng</h2> -->
			    	<?php
			    		if(isset($delcart))
			    		 echo $delcart; 
			    	?>
						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Tên Sản Phẩm</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
							</tr>
							<?php
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart)
								{
									$subtotal =0;
									$sl=0;
									$i=0;
									while ($result=$get_product_cart->fetch_assoc()){
									$i++;
							 ?>

							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td>Tk. <?php echo $result['price'] ?></td>
								
									<!-- <form action="" method="post"> -->
										<!-- <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/> -->
										<td><?php echo $result['soluong'] ?></td>
										<!-- <input type="submit" name="submit" value="Update"/> -->
									<!-- </form> -->

								
								<td><?php
								$total = $result['price'] * $result['soluong'];
								echo $total;

								 ?></td>

								<!-- <td><a href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td> -->
							</tr>
							<?php 
							$subtotal +=$total;
							$sl = $sl + $result['soluong'];
								}
							}
							?>

							<?php
								$check_cart = $ct->check_cart();
									if($check_cart){
										
							?>

						</table>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Thanh Toán : </th>
								<td><?php echo $subtotal;
								Session::set('sum',$subtotal);
								Session::set('sl',$sl);							
								 ?> VND

								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10% (<?php echo $vat=$subtotal *0.1 ?>)</td>
							</tr>
							<tr>
								<th>Tổng Thanh Toán :</th>
								<td><?php
								 $vat=$subtotal *0.1;
								 $gtotal= $subtotal + $vat;
								 echo $gtotal .''.' VND ';
								 ?> </td>
							</tr>
					   </table>
					   <?php
					}
					   else{
					   	 echo 'Giỏ Hàng Của Bạn Trống. Hãy Shopping đi nào!!!';
					   } 
					   	
					   ?>

					</div>
    		</div>
    		<div class="box_right">
    			<table class="tblone" >
    		<?php
    			$id = Session::get('customer_id');
    			$get_customer = $cs->show_customer($id);
    			if($get_customer)
    			{
    				while ($result=$get_customer->fetch_assoc()) {
    						
    		 ?>
    		<tr>
		    			<td>Tên</td>
		    			<td>:</td>
		    			<td><?php echo $result['username']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Thành Phố</td>
		    			<td>:</td>
		    			<td><?php echo $result['city']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Số điện thoại</td>
		    			<td>:</td>
		    			<td><?php echo $result['phone']; ?></td>
		    		</tr>
		    		<!-- <tr>
		    			<td>Country</td>
		    			<td>:</td>
		    			<td><?php echo $result['country']; ?></td>
		    		</tr> -->
		    		<tr>
		    			<td>Mã bưu điện</td>
		    			<td>:</td>
		    			<td><?php echo $result['zipcode']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Email</td>
		    			<td>:</td>
		    			<td><?php echo $result['email']; ?></td>
		    		</tr>
		    		<tr>
		    			<td>Địa chỉ</td>
		    			<td>:</td>
		    			<td><?php echo $result['address']; ?></td>
		    		</tr>
		            <tr>
		                <td colspan="3"><a href="editprofile.php">Cập nhật thông tin</a></td>
		               
		            </tr>
		    		
		    		<?php 
		    		}
		    		}
		    		 ?>
		    	</table>	

    		</div>

 		</div>
 		<center style="padding-bottom: 20px; margin-top: 20px"><a href="?orderid=order" class="a_order">Đặt hàng ngay</a></center>
 	</div>
 	</form>
 <?php
 include 'include/footer.php';
?>

