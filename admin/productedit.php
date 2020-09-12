<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php' ?>
<?php
    include '../classes/danhmuc.php';
?>
<?php
    include '../classes/product.php';
?>
<?php
    $pd = new product();

    if(!isset($_GET['productid']) || $_GET['productid']==NULL){
        echo "<script>window.location='productlist.php'</script>";
    }else
    {
        $id= $_GET['productid'];
    }

    if($_SERVER['REQUEST_METHOD']== 'POST' && isset($_POST['submit'])){
       
        

        $updatetProduct= $pd->update_product($_POST,$_FILES,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa Sản Phẩm</h2>
        <div class="block"> 

         <?php
                    if(isset($updatetProduct))
                        echo $updatetProduct;
                ?>      
                <?php
                    $get_product_by_id = $pd->getproductbyid($id);
                    if($get_product_by_id){
                    
                        while ($result_product = $get_product_by_id->fetch_assoc()) {   
                ?>          
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_product['productName']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh Mục</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>---Chọn Danh Mục---</option>
                            <?php
                                $cat= new danhmuc();
                                $catlist = $cat->show_danhmuc();
                                if($catlist){
                                    while ($result=$catlist->fetch_assoc()) {
   
                            ?>

                            <option
                            <?php
                                if($result['catId']==$result_product['catId']){ echo 'selected';      }

                             ?>
                             value="<?php echo $result['catId'] ?>"><?php echo $result['catName']?></option>
                            
                           <?php
                             }
                                } 
                           ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Thương Hiệu</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>---Chọn Thương Hiệu---</option>
                            <?php
                                $brand = new brand();
                                $brandlist = $brand->show_thuonghieu();
                                if($brandlist){
                                    while ($result=$brandlist->fetch_assoc()) {
                                        
                                    
                            ?>
                            <option
                            <?php
                                if($result['brandId']==$result_product['brandId']) { echo 'selected';  }
                            ?>
    
                             value="<?php echo $result['brandId']?>"><?php echo $result['brandName'] ?></option>
                          <?php
                                }
                            } 
                          ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="mota" class="tinymce"><?php echo $result_product['mota']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input  type="text" name="price" value="<?php echo $result_product['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_product['image'] ?>" width="60" height="60"><br>
                        <input type="file"  name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                            if($result_product['type']==1){
                                ?>
                            
                            <option selected value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</option>
                            <?php
                            }
                            else{
                                ?>
                            <option selected value="0">Không Nổi bật</option>
                            <option value="1">Nổi bật</option>
                            <?php
                            }
                            ?>
                            
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
                } 
            }
             
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


