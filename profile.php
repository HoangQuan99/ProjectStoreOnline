
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
<!-- <?php if(!isset($_GET['proid']) || $_GET['proid']==NULL){
        echo "<script>window.location='404.php'</script>";
    }else
    {
        $id= $_GET['proid'];
    }
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
    	$soluong = $_POST['soluong'];
        $addtocart= $ct->add_to_cart($soluong,$id);
    }
?> -->

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Thông Tin Khách Hàng</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<table class="tblone" >
    		<?php
    			$id = Session::get('customer_id');
    			$get_customer = $cs->show_customer($id);
    			if($get_customer)
    			{
    				while ($result=$get_customer->fetch_assoc()) {
    						
    		 ?>
    		<tr>
    			<td>Tên KH</td>
    			<td>:</td>
    			<td><?php echo $result['username'] ?></td>
    		</tr>
    		<tr>
    			<td>Address</td>
    			<td>:</td>
    			<td><?php echo $result['address'] ?></td>
    		</tr>
    		<tr>
    			<td>City</td>
    			<td>:</td>
    			<td><?php echo $result['city'] ?></td>
    		</tr>
    	
    		<tr>
    			<td>Zipcode</td>
    			<td>:</td>
    			<td><?php echo $result['zipcode'] ?></td>
    		</tr>
    		<tr>
    			<td>Phone</td>
    			<td>:</td>
    			<td><?php echo $result['phone'] ?></td>
    		</tr>
    		<tr>
    			<td>Email</td>
    			<td>:</td>
    			<td><?php echo $result['email'] ?></td>
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
 <?php
 include 'include/footer.php';
?>

