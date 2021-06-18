<?php
 include 'include/header.php';
 include 'include/slider.php';
?>
 <div class="main">
 	
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Sản Phẩm Nổi Bật</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$getproduct = $pd->getproductnoibat();
	      		if($getproduct)
	      		{
	      			while ($result=$getproduct->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" width="150px" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['mota'], 50) ?></p>
					 <p><span class="price"><?php echo $result['price']." VND " ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php
					} 
				}
				?>

			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>Sản Phẩm Mới</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php
					$getproduct_new =$pd->getproductnew();
					if($getproduct_new){
						while ($result_new=$getproduct_new->fetch_assoc()) {
						
				 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['image'] ?>" width="150" height="150" alt="" /></a>
					 <h2><?php echo $result_new['productName'] ?></h2>
					 <p><span class="price"><?php echo $result_new['price']." VND " ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php
				 }
					}
				?>
			</div>
    </div>
 </div>
 <?php
 include 'include/footer.php';
?>


<style type="text/css">
	.images_1_of_4 {
	height: 400px;
	width: 280px;
	padding:2%;
	margin-left: 15px;
	text-align:center;
	position:relative; 
}
.images_1_of_4  img{
	max-width:100%;
}
</style>