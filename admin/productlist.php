<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/brand.php';
?>
<?php
    include '../classes/danhmuc.php';
?>
<?php
    include '../classes/product.php';
?>

<?php
	$pd = new product();
	 if(isset($_GET['productid']))
    {
        $id= $_GET['productid'];
        $delpro = $pd->del_product($id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sản Phẩm</h2>
        <div class="block">  
        	<?php
                if(isset($delpro))
                	echo $delpro;
             ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tên Sản Phẩm</th>
					<th>Giá</th>
					<th>Hình Ảnh</th>
					<th>Mô Tả</th>
					<th>Danh Mục</th>
					<th>Thương Hiệu</th>
					<th>Loại</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$pdlist = $pd->show_product();
					if($pdlist)
					{
						$i=0;
						while ($result=$pdlist->fetch_assoc()) {
							$i++;			
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><img src="uploads/<?php echo $result['image'] ?>" width="60" height="60"></td>
					<td><?php echo $result['mota'] ?></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><?php
						if($result['type']==0)
							echo "Không nổi bật";
						else
							echo "Nổi Bật";
					?></td>
					
					<td><a href="productedit.php?productid=<?php echo $result['productId']?>">Edit</a> || <a href="?productid=<?php echo $result['productId']?>">Delete</a></td>
				</tr>
				<?php
				 	}
				} 
				?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
