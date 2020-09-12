<?php
	$filepath = realpath(dirname(__FILE__));  
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	/**
	 * 
	 */
	class danhmuc
	{
		private $db;
		private $fm;
		public function __construct()
		{
			$this->db= new Database();
			$this->fm= new Format();
		}
		public function insert_danhmuc($catName)
		{
			$catName = $this->fm->validation($catName);

			$catName= mysqli_real_escape_string($this->db->link, $catName);


			if(empty($catName))
			{
				$alert ="<span class='error'>Dữ liệu không được trống</span>";
				return $alert;
			}
			else
			{
				$query = "INSERT INTO tbl_danhmuc(catName) VALUES('$catName')";
				$result = $this->db->insert($query);
				if($result)
				{
					$alert ="<span class='success'>Thêm Danh Mục Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Thêm Danh Mục Không Thành Công</span>";
					return $alert;
				}
			}
		}
		public function update_danhmuc($catName,$id)
		{
			$catName = $this->fm->validation($catName);

			$catName= mysqli_real_escape_string($this->db->link, $catName);
			$id= mysqli_real_escape_string($this->db->link, $id);

			if(empty($catName))
			{
				$alert ="<span class='error'>Dữ liệu không được trống</span>";
				return $alert;
			}
			else
			{
				$query = "UPDATE tbl_danhmuc SET catName = '$catName' WHERE catId='$id'";
				$result = $this->db->insert($query);
				if($result)
				{
					$alert ="<span class='success'>Sửa Danh Mục Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Sửa Danh Mục Không Thành Công</span>";
					return $alert;
				}
			}

		}
		public function del_danhmuc($id)
		{
			$query = "DELETE  FROM tbl_danhmuc where catId ='$id'";
				$result = $this->db->delete($query);
				if($result)
				{
					$alert ="<span class='success'>Xóa Danh Mục Thành Công</span>";
					return $alert;
				}
				else{
					$alert ="<span class='error'>Xóa Danh Mục Không Thành Công</span>";
					return $alert;
				}

				
		}
		public function show_danhmuc()
		{
			$query = "SELECT * FROM tbl_danhmuc order by catId desc ";
				$result = $this->db->select($query);
				return $result;
		}
		
		public function getcatbyId($id)
		{
			$query = "SELECT * FROM tbl_danhmuc where catId ='$id'";
				$result = $this->db->select($query);
				return $result;
		}
		public function get_cat_fontend()
		{
			$query = "SELECT * FROM tbl_danhmuc order by catId desc ";
				$result = $this->db->select($query);
				return $result;
		}
		public function get_pro_bycat($id)
		{
			$query = "SELECT * FROM tbl_sanpham where catId ='$id' order by catId desc LIMIT 8";
				$result = $this->db->select($query);
				return $result;
		}
		public function get_name_bycat($id)
		{
			$query = "SELECT tbl_sanpham.*, tbl_danhmuc.catName, tbl_danhmuc.catId FROM tbl_danhmuc, tbl_sanpham where tbl_sanpham.catId =tbl_danhmuc.catId AND tbl_sanpham.catId='$id' LIMIT 1";
				$result = $this->db->select($query);
				return $result;
		}
	}
?>
