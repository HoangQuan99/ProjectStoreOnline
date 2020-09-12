
<?php
 include 'include/header.php';
 // include 'include/slider.php';
?>
<!-- <?php
   
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $tukhoa= $_POST['tukhoa'];
        $seach_product= $pd->seach_product($tukhoa);
    }
  
?> -->
 <!-- <div class="main">
    <div class="content">
    	<?php
		    if($_SERVER['REQUEST_METHOD']== 'POST'){
	       	 	$tukhoa= $_POST['tukhoa'];
	        	$seach_product= $pd->seach_product($tukhoa);
	    }
	      	?>
    	<div class="content_top">
    		
    		<div class="heading">
    			<h3>Từ Khóa Tìm Kiếm:<?php echo $tukhoa ?></h3>
    		</div>
    			
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		
	      		if($seach_product)
	      		{
	      			while ($result = $seach_product->fetch_assoc()) {
	
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.html"><img src="admin/uploads/<?php echo $result['image'] ?>"  alt=""  /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $result['mota'] ?></p>
					 <p><span class="price"><?php echo $result['price'] ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
			</div>
			<?php
				}
			}
			else{
				echo 'Danh mục hiện chưa có sản phẩm!!!';
			}  
			?>

    </div>
 </div>
</div>
   <div class="footer">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#"><span>Advanced Search</span></a></li>
						<li><a href="#">Orders and Returns</a></li>
						<li><a href="#"><span>Contact Us</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.html">About Us</a></li>
						<li><a href="faq.html">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.html"><span>Site Map</span></a></li>
						<li><a href="preview-2.html"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.html">Sign In</a></li>
							<li><a href="index.html">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="faq.html">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Contact</h4>
						<ul>
							<li><span>+91-123-456789</span></li>
							<li><span>+00-123-000000</span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li class="facebook"><a href="#" target="_blank"> </a></li>
							      <li class="twitter"><a href="#" target="_blank"> </a></li>
							      <li class="googleplus"><a href="#" target="_blank"> </a></li>
							      <li class="contact"><a href="#" target="_blank"> </a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>
			<div class="copy_right">
				<p>Compant Name © All rights Reseverd </p>
		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>
</html> -->

 <div class="main">
    <div class="content">
    	<?php
		    if($_SERVER['REQUEST_METHOD']== 'POST'){
	       	 	$tukhoa= $_POST['tukhoa'];
	        	$seach_product= $pd->seach_product($tukhoa);
	    }
	      	?>
    	<div class="content_top">
    
    		<div class="heading">
    		<h3>Từ Khóa Tìm Kiếm:<?php echo $tukhoa ?></h3>
    		</div>
    		
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      	if ($seach_product) {
	      		while ($result = $seach_product->fetch_assoc()) {
	      			# code...
	      		
	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image'] ?>" width="200" height="200" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['mota'],50) ?></p>
					 <p><span class="price"><?php echo $result['price'].' VND' ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php 
				}
	      	}else {
	      		echo "Sản phẩm này hiện chưa có trong danh mục";
	      	}
				 ?>
			</div>

	
	
    </div>
 </div>

<?php 
	include 'include/footer.php';
 ?>


