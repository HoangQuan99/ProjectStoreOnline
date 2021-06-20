
<?php
 include 'include/header.php';
 // include 'include/slider.php';
?>
<?php
     
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        echo "<script> window.location = '404.php' </script>";
        
    }else {
        $id = $_GET['brandid']; // Lấy brandid trên host
    }
    // gọi class category
    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    //     $catName = $_POST['catName'];
    //     $updateCat = $cat -> update_category($catName,$id); // hàm check catName khi submit lên
    // }
    
  ?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<?php 
	      	$name_brand = $br->get_name_bybrand1($id);
	      	if ($name_brand) {
	      		while ($result_name = $name_brand->fetch_assoc()) {
	      			# code...
	      		
	      	 ?>
    		<div class="heading">
    		<h3>Thương hiệu: <?php echo $result_name['brandName'] ; ?></h3>
    		</div>
    		<?php 
				}
	      	}
			?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      	$productbybrand = $br->get_name_bybrand($id);
	      	if ($productbybrand) {
	      		while ($result = $productbybrand->fetch_assoc()) {
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
