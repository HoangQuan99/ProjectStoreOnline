<?php
	$filepath = realpath(dirname(__FILE__));  
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class brand
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db= new Database();
			$this->fm= new Format();
		}
		public function insert_thuonghieu($brandName)
		{
			$brandName = $this->fm->validation($brandName);

			$brandName= mysqli_real_escape_string($this->db->link, $brandName);


			if(empty($brandName))
			{
				$alert ="<span class='error'>Dữ liệu không được trống</span>";
				return $alert;
			}
			else
			{
				$query = "INSERT INTO tbl_thuonghieu(brandName) VALUES('$brandName')";
				$result = $this->db->insert($query);
				if($result)
				{
					$alert ="<span class='success'>Thêm Thương Hiệu Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Thêm Thương Hiệu Không Thành Công</span>";
					return $alert;
				}
			}
		}
		public function update_thuonghieu($brandName,$id)
		{
			$brandName = $this->fm->validation($brandName);

			$brandName= mysqli_real_escape_string($this->db->link, $brandName);
			$id= mysqli_real_escape_string($this->db->link, $id);

			if(empty($brandName))
			{
				$alert ="<span class='error'>Dữ liệu không được trống</span>";
				return $alert;
			}
			else
			{
				$query = "UPDATE tbl_thuonghieu SET brandName = '$brandName' WHERE brandId='$id'";
				$result = $this->db->insert($query);
				if($result)
				{
					$alert ="<span class='success'>Sửa Thương Hiệu Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Sửa Thương Hiệu Không Thành Công</span>";
					return $alert;
				}
			}

		}
		public function del_thuonghieu($id)
		{
			$query = "DELETE  FROM tbl_thuonghieu where brandId ='$id'";
				$result = $this->db->delete($query);
				if($result)
				{
					$alert ="<span class='success'>Xóa Thương Hiệu Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Xóa Thương Hiệu Không Thành Công</span>";
					return $alert;
				}

				
		}
		public function show_thuonghieu()
		{
			$query = "SELECT * FROM tbl_thuonghieu order by brandId desc ";
				$result = $this->db->select($query);
				return $result;
		}
		
		public function getbrandbyId($id)
		{
			$query = "SELECT * FROM tbl_thuonghieu where brandId ='$id'";
				$result = $this->db->select($query);
				return $result;
		}
		public function get_name_bybrand1($id)
		{
			$query = "SELECT tbl_sanpham.*, tbl_thuonghieu.brandName, tbl_thuonghieu.brandId FROM tbl_thuonghieu, tbl_sanpham where tbl_sanpham.brandId =tbl_thuonghieu.brandId AND tbl_sanpham.brandId='$id' LIMIT 1";
				$result = $this->db->select($query);
				return $result;
		}
		public function get_name_bybrand($id)
		{
			$query = "SELECT tbl_sanpham.*, tbl_thuonghieu.brandName, tbl_thuonghieu.brandId FROM tbl_thuonghieu, tbl_sanpham where tbl_sanpham.brandId =tbl_thuonghieu.brandId AND tbl_sanpham.brandId='$id'";
				$result = $this->db->select($query);
				return $result;
		}
	}
?>
