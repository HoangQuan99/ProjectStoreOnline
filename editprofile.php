
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

 <?php 
        $id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['save'])){
    	
        $updatecustomer= $cs->update_customer($_POST,$id);
    }
?> 
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Cập Nhật Thông Tin Khách Hàng</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <form action="" method="POST">
    	<table class="tblone" >
    		<?php
    			$id = Session::get('customer_id');
    			$get_customer = $cs->show_customer($id);
    			if($get_customer)
    			{
    				while ($result=$get_customer->fetch_assoc()) {			
    		 ?>
             <tr>
                
                     <?php
                        if(isset($updatecustomer))
                        {
                            echo '<td colspan="3">'.$updatecustomer.'</td>';
                            // header('Location:offlinepay.php');
                        }
                      ?>
                
             </tr>
    		<tr>
    			<td>Tên KH</td>
    			<td>:</td>
                <td><input type="text" name="username" value="<?php echo $result['username'] ?>"></td>
    		</tr>
    		<tr>
    			<td>Address</td>
    			<td>:</td>
                <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
    			
    		</tr>
    		<!-- <tr>
    			<td>City</td>
    			<td>:</td>
                <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
    		</tr> -->
    	
    		<tr>
    			<td>Zipcode</td>
    			<td>:</td>
                <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
    		</tr>
    		<tr>
    			<td>Phone</td>
    			<td>:</td>
                <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
    		</tr>
    		<tr>
    			<td>Email</td>
    			<td>:</td>
                <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
    		</tr>
    		<tr>
    			<td colspan="3"><input type="submit" name="save" value="Save" class="grey" ></td>

    		</tr>
    		<?php
    			 }
    			}
    		?>
         
    	</table>
        </form>
 	</div>
 <?php
 include 'include/footer.php';
?>

