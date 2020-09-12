<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/danhmuc.php';
?>
<?php 
    $filepath = realpath(dirname(__FILE__));  
    include_once ($filepath.'/../classes/customer.php');
?>
<?php
    $cs = new customer();
    if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
        echo "<script>window.location='inbox.php'</script>";
    }else
    {
        $id= $_GET['customerid'];
    }
    // if($_SERVER['REQUEST_METHOD']== 'POST'){
    //     $catName= $_POST['catName'];
    //     $updateCat= $cat->update_danhmuc($catName,$id);
    // }
  
?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thông Tin Khách Hàng</h2>
               <div class="block copyblock"> 
                <!-- <?php
                    if(isset($updateCat))
                        echo $updateCat;
                ?> -->
                <?php
                    $get_customer = $cs->show_customer($id);
                    if($get_customer)
                    {
                        while ($result = $get_customer->fetch_assoc()) {
                            
                        
                ?>
                 <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>Name:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['username'] ?>" name="username" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>" name="address" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" name="city" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" name="phone" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" name="email" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode:</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" name="zipcode" class="medium" />
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
<?php include 'inc/footer.php';?>