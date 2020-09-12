﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/danhmuc.php' ?>
<?php
    $cat = new danhmuc();
    if(isset($_GET['delid']))
    {
        $id= $_GET['delid'];
        $delcat = $cat->del_danhmuc($id);
    }
    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">
                <?php
                    if(isset($delcat))
                        echo $delcat;
                ?>        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$show = $cat->show_danhmuc();
							if($show)
							{
								$i=0;
								while ($result=$show->fetch_assoc()) {
									$i++;
								
							
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['catName']?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Edit</a> || <a onclick="return confirm('Bạn có muốn xóa không?')" href="?delid=<?php echo $result['catId'] ?>">Delete</a></td>
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
