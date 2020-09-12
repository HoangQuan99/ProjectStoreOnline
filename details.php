
<?php
 include 'include/header.php';
?>
<?php if(!isset($_GET['proid']) || $_GET['proid']==NULL){
        echo "<script>window.location='404.php'</script>";
    }else
    {
        $id= $_GET['proid'];
    }
    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
    	$soluong = $_POST['soluong'];
        $addtocart= $ct->add_to_cart($soluong,$id);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    			$get_product_details = $pd->get_details($id); 
    			if($get_product_details)
    			{
    				while ($result=$get_product_details->fetch_assoc()) {
    							
    		?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result['image'] ?>" alt="" style="width: 250px;" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $result['mota'] ?></p>					
					<div class="price">
						<p>Gía: <span><?php echo $result['price'] ?></span></p>
						<p>Danh mục: <span><?php echo $result['catName'] ?></span></p>
						<p>Thương Hiệu:<span><?php echo $result['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="soluong" value="1" min="1" />
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						
					</form>		
						<?php
						if(isset($addtocart))
						{
							echo '<span style="color:red;font-size:18px">Sản Phẩm Đã Tồn Tại Trong Giỏ Hàng!!!</span>';
						}
					 ?>	
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['mota'] ?></p>
	    </div>			
	</div>
	<?php
	 }
    			}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>Danh mục</h2>
					<?php
						$get_cat_fontend = $cat->get_cat_fontend();
						{
							if($get_cat_fontend)
								while($result_cat = $get_cat_fontend->fetch_assoc()){

								
					 ?>
					<ul>
				      <li><a href="productbycat.php?catid=<?php  echo $result_cat['catId'] ?>"><?php echo $result_cat['catName'] ?></a></li> 
    				</ul>
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

