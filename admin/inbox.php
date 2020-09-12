<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath = realpath(dirname(__FILE__));  
	include_once ($filepath.'/../classes/cart.php');
	
?>
<!-- <?php
    $ct = new cart();
    if(isset($_GET['shiftid'])){
       $id = $_GET['shiftid'];
       $time = $_GET['time'];
       $price =$_GET['price'];
       $shifted = $ct->shifted($id,$time,$price);
    }
    // if($_SERVER['REQUEST_METHOD']== 'POST'){
    //     $catName= $_POST['catName'];
    //     $updateCat= $cat->update_danhmuc($catName,$id);
    // }
  
?> -->
<?php
	$ct = new cart();
    if(isset($_GET['shiftid'])){
       $id= $_GET['shiftid'];
       $time = $_GET['time'];
       $price =$_GET['price'];
       $shifted = $ct->shifted($id,$time,$price);
    }

     if(isset($_GET['delid'])){
       $id= $_GET['delid'];
       $time = $_GET['time'];
       $price =$_GET['price'];
       $del_shifted = $ct->del_shifted($id,$time,$price);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">  
                <?php
                	 if(isset($shifted)) 
                	 {
                	 	echo $shifted;
                	 }
                ?>  
                <?php
                	 if(isset($del_shifted)) 
                	 {
                	 	echo $del_shifted;
                	 }
                ?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Thời Gian</th>
							<th>Sản Phẩm</th>
							<th>Số Lượng</th>
							<th>Giá</th>
							<th>ID Khách Hàng</th>
							<th>Địa Chỉ</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$ct = new cart();
							$i=0;
							$get_ibox_cart = $ct->get_ibox_cart();
							if($get_ibox_cart)
							{
								while ($result=$get_ibox_cart->fetch_assoc()) {
									$i++;
							
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['date_order'] ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['soluong'] ?></td>
							<td><?php echo $result['price'] ?></td>
							<td><?php echo $result['customer_id'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Địa Chỉ Khách Hàng</a></td>
							<td>
								<?php
									if($result['status']=='0'){
									?>	
										<a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Pending</a>
								<?php
								}else{
									?>
										<a href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Remove</a>
								<?php
									} 
								?>
							</td>
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
