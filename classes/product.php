<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class product
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db= new Database();
			$this->fm= new Format();
		}
		public function insert_product($data,$files)
		{
			

			$productName= mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId= mysqli_real_escape_string($this->db->link, $data['catId']);
			$brandId= mysqli_real_escape_string($this->db->link, $data['brandId']);
			$mota= mysqli_real_escape_string($this->db->link, $data['mota']);
			$price= mysqli_real_escape_string($this->db->link, $data['price']);
			$type= mysqli_real_escape_string($this->db->link, $data['type']);

			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($productName==""||$catId==""||$brandId==""||$mota==""||$price==""||$type==""||$file_name=="")
			{
				$alert ="<span class='error'>Dữ liệu không được trống</span>";
				return $alert;
			}
			else
			{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_sanpham(productName,catId,brandId,mota,price,type,image)VALUES('$productName','$catId','$brandId','$mota','$price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result)
				{
					$alert ="<span class='success'>Thêm Sản Phẩm Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Thêm Sản Phẩm Không Thành Công</span>";
					return $alert;
				}
			}
		}
		public function update_product($data,$file,$id)
		{
			
			$productName= mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId= mysqli_real_escape_string($this->db->link, $data['catId']);
			$brandId= mysqli_real_escape_string($this->db->link, $data['brandId']);
			$mota= mysqli_real_escape_string($this->db->link, $data['mota']);
			$price= mysqli_real_escape_string($this->db->link, $data['price']);
			$type= mysqli_real_escape_string($this->db->link, $data['type']);

			$permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			

			if($productName==""||$catId==""||$brandId==""||$mota==""||$price==""||$type=="")
			{
				$alert ="<span class='error'>Dữ liệu không được trống</span>";
				return $alert;
			}
			else
			{
				if(!empty($file_name))
				{
					if($file_size>304800)
					{
						$alert ="<span class='error'>Hình ảnh không được lớn quá 30MB</span>";
						return $alert;
					}
					elseif (in_array($file_ext,$permited)==false)
					{
						$alert ="<span class='error'>Bạn chỉ được upload:-".implode(',', $permited)."</span>";
						return $alert;
					}
					move_uploaded_file($file_temp,$uploaded_image);
					$query = "UPDATE tbl_sanpham SET
					productName='$productName',
					brandId='$brandId',
					catId='$catId',
					type='$type',
					price='$price',
					image='$unique_image',
					mota='$mota'
					WHERE productId ='$id' ";
				}
					else{
						$query = "UPDATE tbl_sanpham SET
					productName='$productName',
					brandId='$brandId',
					catId='$catId',
					type='$type',
					price='$price',
					mota='$mota'
					WHERE productId ='$id' ";
					}
				}

				$result = $this->db->update($query);
				if($result)
				{
					$alert ="<span class='success'>Sửa Sản Phẩm Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Sửa Sản Phẩm Không Thành Công</span>";
					return $alert;
				}
			}
		public function del_product($id)
		{
			$query = "DELETE  FROM tbl_sanpham where productId ='$id'";
				$result = $this->db->delete($query);
				if($result)
				{
					$alert ="<span class='success'>Xóa Sản Phẩm Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Xóa Sản Phẩm Không Thành Công</span>";
					return $alert;
				}

				
		}
		public function show_product()
		{
			$query = "SELECT p.*, c.catName,b.brandName FROM tbl_sanpham as p, tbl_thuonghieu as b ,tbl_danhmuc as c where p.catId=c.catId AND p.brandId=b.brandId order by p.productId desc ";

				$result = $this->db->select($query);
				return $result;
		}
		
		public function getproductbyid($id)
		{
			$query = "SELECT * FROM tbl_sanpham where productId ='$id'";
				$result = $this->db->select($query);
				return $result;
		}

		public function getproductnoibat()
		{
			$query = "SELECT * FROM tbl_sanpham where type ='1'";
				$result = $this->db->select($query);
				return $result;
		}
		public function getproductnew()
		{
			$query = "SELECT * FROM tbl_sanpham order by productId desc LIMIT 4";
				$result = $this->db->select($query);
				return $result;
		}
		public function get_details($id)
		{
			// $query = "SELECT p.*, c.catName,b.brandName FROM tbl_sanpham as p, tbl_thuonghieu as b ,tbl_danhmuc as c where p.productId ='$id' LIMIT 1 ";
			// 	$result = $this->db->select($query);
			// 	return $result;
			$query = "
			
			SELECT tbl_sanpham.*, tbl_danhmuc.catName, tbl_thuonghieu.brandName

			FROM tbl_sanpham INNER JOIN tbl_danhmuc ON tbl_sanpham.catId = tbl_danhmuc.catId

			INNER JOIN tbl_thuonghieu ON tbl_sanpham.brandId = tbl_thuonghieu.brandId WHERE tbl_sanpham.productId = '$id'

			";
			$result = $this->db->select($query);
			return $result;

		}
		public function getDell()
		{
			$query = "SELECT * FROM tbl_sanpham where brandId ='8' and type ='1'";
				$result = $this->db->select($query);
				return $result;
		}
		public function getIP()
		{
			$query = "SELECT * FROM tbl_sanpham where brandId ='6'and type ='1'";
				$result = $this->db->select($query);
				return $result;
		}
		public function getSS()
		{
			$query = "SELECT * FROM tbl_sanpham where brandId ='5'and type ='1'";
				$result = $this->db->select($query);
				return $result;
		}
		public function getXM()
		{
			$query = "SELECT * FROM tbl_sanpham where brandId ='7' and type ='1'";
				$result = $this->db->select($query);
				return $result;
		}
		public function seach_product($tukhoa)
		{
	
			$tukhoa = $this->fm->validation($tukhoa);

			$query = "SELECT * FROM tbl_sanpham WHERE productName LIKE '%$tukhoa%' ";
				$result = $this->db->select($query);
				return $result;
			
		}
	}
?>
