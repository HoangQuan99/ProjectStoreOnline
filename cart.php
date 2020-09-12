<?php
 include 'include/header.php';
 // include 'include/slider.php';
?>
<?php 

	if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
    	$cartId = $_POST['cartId'];
    	$soluong = $_POST['soluong'];
        $update_soluong= $ct->update_soluong($soluong,$cartId);
        if($soluong==0)
        {
        	$delcart = $ct->del_cart($cartId);
        }
    }
    // if($soluong<=0)
    // {
    // 	 $delcart = $ct->del_cart($cartId);
    // }
    if(isset($_GET['cartid']))
    {
        $cartid= $_GET['cartid'];
        $delcart = $ct->del_cart($cartid);
    }
    // if($soluong<=0)
    // {
    // 	  $delcart = $ct->del_cart($cartId);
    // }
    // 
?>
<?php
	if(!isset($_GET['id']))
	{
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	} 
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Giỏ Hàng</h2>
			    	<?php
			    		if(isset($delcart))
			    		 echo $delcart; 
			    	?>
			    	<?php
						if(isset($update_soluong))
						{
							echo $update_soluong;
							// echo '<span style="color:red;font-size:15px">Số lượng mua không hợp lệ!!!</span>';
						}
					 ?>	
						<table class="tblone">
							<tr>
								<th width="20%">Tên Sản Phẩm</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart)
								{
									$subtotal =0;
									$sl=0;
									while ($result=$get_product_cart->fetch_assoc()){
									
							 ?>

							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td>Tk. <?php echo $result['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
										<input type="number" name="soluong" value="<?php echo $result['soluong'] ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
									

								</td>
								<td><?php
								$total = $result['price'] * $result['soluong'];
								echo $total;

								 ?></td>

								<td><a href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
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
										<th>Sub Total : </th>
										<td><?php echo $subtotal;
										Session::set('sum',$subtotal);
										Session::set('sl',$sl);							
										 ?> VND

										</td>
									</tr>
									<tr>
										<th>VAT : </th>
										<td>10%</td>
									</tr>
									<tr>
										<th>Grand Total :</th>
										<td><?php
										 $vat=$subtotal *0.1;
										 $gtotal= $subtotal + $vat;
										 echo $gtotal .''.' VND ';
										 ?> </td>
									</tr>
							   </table>
					   <?php
						}
					   else
					   {

					   	 echo 'Giỏ Hàng Của Bạn Trống. Hãy Shopping đi nào!!!';
					   	 
					   	
					   } 
					   	
					   ?>

					</div>

					<!-- <div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<?php><?>
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
       <div class="clear"></div>
    </div>
 </div>
 <?php
 include 'include/footer.php';
?>