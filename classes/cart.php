<?php
	$filepath = realpath(dirname(__FILE__));  
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class cart
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db= new Database();
			$this->fm= new Format();
		}
		public function add_to_cart($soluong,$id)
		{
			$soluong=$this->fm->validation($soluong);
			$soluong= mysqli_real_escape_string($this->db->link, $soluong);
			$id= mysqli_real_escape_string($this->db->link, $id);
			$sId = session_id();

			$query = " SELECT * from tbl_sanpham where productId ='$id' ";
			$result = $this->db->select($query)->fetch_assoc();

			$image = $result['image'];
			$price = $result['price'];
			$productName = $result['productName'];
			$soluongton = $result['soluongton'];

			

			$check = "SELECT * FROM tbl_cart WHERE productId='$id' AND sId ='$sId'";
			$check_cart = $this->db->select($check);
			if($check_cart)
			{
				$msg ="Sản phẩm đã tồn tại trong giỏ hàng!!!";
				return $msg;
			}
			else{
				$query_insert="INSERT INTO tbl_cart(productId,soluong,sId,image,price,productName) VALUES ('$id','$soluong','$sId','$image','$price','$productName') ";
				$insert_cart = $this->db->insert($query_insert);
				if($result)
				{
					header('Location:cart.php');
				}
				else
				{
					header('Location:404.php');
				}
			}
		}
		public function get_product_cart()
		{
			$sId = session_id();
			$query = " SELECT * From tbl_cart where sId ='$sId' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_soluong($soluong,$cartId)
		{	
			$soluong= mysqli_real_escape_string($this->db->link, $soluong);
			$cartId= mysqli_real_escape_string($this->db->link, $cartId);
			if($soluong>100)
			{
				$msg ="Số lượng không được vượt quá 100";
				return $msg;
			}
			else if($soluong<0)
			{
				$msg ="Số lượng phải lớn hơn 1";
				return $msg;
			}
			else
			{

			$query = "UPDATE tbl_cart SET
					soluong='$soluong'

					WHERE cartId ='$cartId' ";
			$result=$this->db->update($query);
			if($result)
			{
				header('Location:cart.php');
			}
			else
			{
				$alert ="<span class='error'>Upload Sản Phẩm Không Thành Công</span>";
					return $alert;
			}
		}

		}
		public function del_cart($cartid)
		{
			$cartid = mysqli_real_escape_string($this->db->link, $cartid);
			$query = "DELETE  FROM tbl_cart where cartId ='$cartid'";
				$result = $this->db->delete($query);
				if($result)
				{
					header('Location:cart.php');
				}
				else{
					$alert ="<span class='error'>Xóa Sản Phẩm Không Thành Công</span>";
					return $alert;
				}
		}
		public function check_cart()
		{
			$sId = session_id();
			$query = " SELECT * From tbl_cart where sId ='$sId' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function check_order($customer_id)
		{
			$sId = session_id();
			$query = " SELECT * From tbl_thanhtoan where customer_id ='$customer_id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_all_data_cart()
		{
			$sId = session_id();
			$query= "DELETE  FROM tbl_cart where sId ='$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function insertOrder($customer_id)
		{
			$sId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sId ='$sId'";
			$get_result=$this->db->select($query);
			if($get_result)
			{
				while ($result = $get_result->fetch_assoc() ) {
					$productId = $result['productId'];
					$productName = $result['productName'];
					$soluong = $result['soluong'];
					$price = $result['price'] * $soluong;
					$image = $result['image'];
					$customer_id= $customer_id;
					$query_order="INSERT INTO tbl_thanhtoan(productId,productName,soluong,price,image,customer_id) VALUES ('$productId','$productName','$soluong','$price','$image','$customer_id') ";
				$insert_order = $this->db->insert($query_order);

				}
			}
		}
		public function getAmountPrice($customer_id)
		{
			
			$query = "SELECT price FROM tbl_thanhtoan WHERE customer_id ='$customer_id'";
			$get_price = $this->db->select($query);
			return $get_price;
		}
		public function get_cart_order($customer_id)
		{
			$query = "SELECT * FROM tbl_thanhtoan WHERE customer_id ='$customer_id'";
			$get_cart_order = $this->db->select($query);
			return $get_cart_order;
		}
		public function get_ibox_cart()
		{
			$query = "SELECT * FROM tbl_thanhtoan order by date_order ";
			$get_ibox_cart = $this->db->select($query);
			return $get_ibox_cart;
		}
		public function shifted($id,$time,$price)
		{
			$id= mysqli_real_escape_string($this->db->link, $id);
			$time= mysqli_real_escape_string($this->db->link, $time);
			$price= mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE tbl_thanhtoan SET
					status='1'

					WHERE id ='$id' AND date_order='$time' AND price='$price' ";
			$result=$this->db->update($query);
			if($result)
			{
				$alert ="<span class='success'>Upload Sản Phẩm Thành Công</span>";
					return $alert;
			}
			else
			{
				$alert ="<span class='error'>Upload Sản Phẩm Không Thành Công</span>";
					return $alert;
			}

		}
		public function del_shifted($id,$time,$price)
		{
			$id= mysqli_real_escape_string($this->db->link, $id);
			$time= mysqli_real_escape_string($this->db->link, $time);
			$price= mysqli_real_escape_string($this->db->link, $price);
			$query = "DELETE FROM tbl_thanhtoan 
					WHERE id ='$id' AND date_order='$time' AND price='$price' ";
			$result=$this->db->update($query);
			if($result)
			{
				$alert ="<span class='success'>Xóa Sản Phẩm Thành Công</span>";
					return $alert;
			}
			else
			{
				$alert ="<span class='error'>Xóa Sản Phẩm Không Thành Công</span>";
					return $alert;
			}
		}

		
	}
?>
